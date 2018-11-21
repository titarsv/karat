<?php
/*
Plugin Name: Yo-login
Plugin URI: https://yogurt-design.com
Description: Этот плагин обеспечивает возможность создавать формы авторизации/регистрации
Version: 1.0
Author: Tit@r
Author URI: http://vk.com/titarsv
License: GPL2
*/

if(!defined('WP_CONTENT_URL'))
  define('WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
if(!defined('WP_CONTENT_DIR'))
  define('WP_CONTENT_DIR', ABSPATH . 'wp-content');
if(!defined('WP_PLUGIN_URL'))
  define('WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins');
if(!defined('WP_PLUGIN_DIR'))
  define('WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins');

add_action( 'wp_enqueue_scripts', 'yo_frontend_scripts_method' );
//add_action( 'admin_enqueue_scripts', 'my_scripts_method' );
//add_action( 'login_enqueue_scripts', 'my_scripts_method' );
function yo_frontend_scripts_method(){
  wp_enqueue_script( 'yo-form', '/wp-content/plugins/yo-login/js/yo-form.js', array('jquery'));
}

// Шорткод вывода формы регистрации
function yo_register($atts){
  if(!isset($atts['id']))
    return '';

  $form = get_post($atts['id']);
  if(count($form) == 0)
    return '';

  $data = unserialize($form->post_content);

  return $data['html'];
}
add_shortcode('yo-register', 'yo_register');

// Шорткод вывода формы авторизации
function yo_login($atts){
  if(!isset($atts['id']))
    return '';

  $form = get_post($atts['id']);
  if(count($form) == 0)
    return '';

  $data = unserialize($form->post_content);

  return $data['html'];
}
add_shortcode('yo-login', 'yo_login');

// Генератор html формы
function yo_get_html($template, $type, $id){

  $content = '<form action="/wp-admin/admin-ajax.php" method="post" id="yo-'.$type.'-'.$id.'" class="yo-form">'.
    '<input name="action" value="yo_pl" type="hidden">'.
    '<input name="yo-pl" value="'.$type.'" type="hidden">'.
    '<input name="yo-form-id" value="'.$id.'" type="hidden">'.
    yo_get_fields_html($template).
    '<div class="yo-info" id="yo-info"></div>
    </form>';

  return $content;
}

// Генератор html полей формы
function yo_get_fields_html($template){
  preg_match_all('|\[(.+)\]|U', $template, $fields);

  foreach($fields[1] as $field){
    $template = str_replace('['.$field.']', yo_get_field_html($field), $template);
  }

  return $template;
}

// Генератор html поля формы
function yo_get_field_html($field){
  $field_data = yo_get_field($field);

  $html = $field;

  $key = array_keys($field_data);
  if(count($key) == 1){
    $data = $field_data[$key[0]];
    if(isset($data['type'])) {
      if (in_array($data['type'], array('text', 'email', 'password', 'hidden', 'checkbox', 'radio')))
        $html = '<input type="' . $data['type'] . '" name="' . $key[0] . '" value="' . (isset($data['value'])?$data['value']:'') . '" placeholder="' . (isset($data['placeholder'])?$data['placeholder']:'') . '" id="yo-' . $key[0] . '" class="' . (isset($data['class'])?$data['class']:'') . '"' . ($data['required'] ? ' required' : '') . ' />';
      elseif ($data['type'] == 'submit')
        $html = '<input type="submit" value="' . (isset($data['value'])?$data['value']:'') . '" class="' . (isset($data['class'])?$data['class']:'') . '" />';
      elseif ($data['type'] == 'textarea') {
        $html = '<textarea name="' . $key[0] . '" placeholder="' . (isset($data['placeholder'])?$data['placeholder']:'') . '" id="yo-' . $key[0] . '" class="' . (isset($data['class'])?$data['class']:'') . '"' . ($data['required'] ? ' required' : '') . '>' . (isset($data['value'])?$data['value']:'') . '</textarea>';
      } elseif ($data['type'] == 'select') {
        $html = '<select name="' . $key[0] . '" id="yo-' . $key[0] . '" class="' . (isset($data['class'])?$data['class']:'') . '">';
        foreach ($data['value'] as $option_key => $option) {
          $html .= '<option value="' . $option_key . '">' . $option . '</option>';
        }
        $html .= '</select>';
      }
    }
  }

  return $html;
}

// Обработка форм
add_action('wp_ajax_yo_pl', 'yo_pl_callback');
add_action('wp_ajax_nopriv_yo_pl', 'yo_pl_callback');
function yo_pl_callback() {
  if(isset($_POST['yo-pl']) && $_POST['yo-pl'] == 'register'){
    echo yo_register_action();
  }elseif(isset($_POST['yo-pl']) && $_POST['yo-pl'] == 'login'){
    echo yo_login_action();
  }
  wp_die();
}

// Регистрация пользователя
function yo_register_action(){
  if(!empty($_POST['yo-form-id'])) {
    $form = get_post($_POST['yo-form-id']);
    if (count($form) == 0)
      return 'error';

    $data = unserialize($form->post_content);

    $fields = $data['fields'];

    $validate = yo_fields_validation($fields);
    if ($validate === true) {
      $user_data = array();
      $user_meta = array();

      foreach ($fields as $key => $field) {
        if ($field['destination'] == 'users' && !empty($_POST[$key])) {
          $user_data[$field['name']] = esc_sql($_POST[$key]);
          if(isset($field['surrogate']) && !empty($field['surrogate'])){
            $user_data[$field['surrogate']] = esc_sql($_POST[$key]);
          }
        } elseif ($field['destination'] == 'usermeta' && !empty($_POST[$key])) {
          $user_meta[$field['name']] = esc_sql($_POST[$key]);
          if(isset($field['surrogate']) && !empty($field['surrogate'])){
            $user_meta[$field['surrogate']] = esc_sql($_POST[$key]);
          }
        }
      }

      if(!isset($user_data['user_pass']) || empty($user_data['user_pass'])){
        $user_data['user_pass'] = wp_generate_password ( 10, true );
      }

      if(empty($user_data['user_login']) && !empty($user_data['user_email'])){
          $email_parts = explode('@', $user_data['user_email']);
	      $user_data['user_login'] = $email_parts[0];
      }

      $user_id = wp_insert_user($user_data);
      if (!is_wp_error($user_id)) {

        foreach ($user_meta as $key => $param) {
          update_user_meta($user_id, $key, $param);
        }

        update_user_meta($user_id, 'primary_blog', get_current_blog_id());

        wp_new_user_notification($user_id, $user_data['user_pass']);

        return 'success';
      } else {

        do_action('yo_register_errors_action', $user_id, $user_data, $user_meta);

        $errors = array('errors' => array());
        foreach ($user_id->errors as $error) {
          $errors['errors'][] = $error[0];
        }

        return json_encode(apply_filters('yo_register_errors_filter', $errors));
      }

    } else {
      return json_encode($validate);
    }
  }

  return 'error';
}

// Авторизация пользователей
function yo_login_action(){
  if(!empty($_POST['yo-form-id'])){
    $form = get_post($_POST['yo-form-id']);
    if(count($form) == 0)
      return 'error';

    $data = unserialize($form->post_content);

    $validate = yo_fields_validation($data['fields']);
    if($validate){
      $info = array();
      foreach($data['fields'] as $key => $field){
        if(!empty($field['name'])){
          $info[$field['name']] = $_POST[$key];
        }
      }

      $user = wp_signon($info, false);

      if (!is_wp_error($user)) {
        return 'success';
      }else{
        $errors = array('errors'=>array());
        foreach($user->errors as $error){
          $errors['errors'][] = $error[0];
        }
        return json_encode($errors);
      }
    }else{
      return json_encode($validate);
    }
  }

  return 'error';
}

// Валидация полей
function yo_fields_validation($fields){
  $errors = array();

  foreach($fields as $key => $field){
    if($field['required'] && (empty($_POST[$key]) || ($field['destination']=='simile' && (empty($_POST[$field['name']]) || $_POST[$key]!==$_POST[$field['name']])))){
      $errors[] = $key;
    }
  }

  if(count($errors) == 0){
    return true;
  }else{
    return $errors;
  }
}

// Настройки
add_action('admin_menu', 'admin_menu_link');
function admin_menu_link() {
  add_options_page('Yo Login', 'Yo Login', 'manage_options', basename(__FILE__), 'yo_admin_options_page');
}

function yo_admin_options_page() {
  if(!isset($_GET['action'])){
    $forms = get_posts(array(
      'post_type'=>'yo_form'
    ));

    echo '<h1>Формы <a href="/wp-admin/options-general.php?page=yo-login.php&action=new" class="page-title-action">Добавить новую</a></h1>';

    ?>
    <table class="wp-list-table widefat fixed striped posts">
      <thead>
      <tr>
        <td id="cb" class="manage-column column-cb check-column">
          <label class="screen-reader-text" for="cb-select-all-1">Выделить все</label>
          <input id="cb-select-all-1" type="checkbox">
        </td>
        <th scope="col" id="title" class="manage-column column-title column-primary sortable asc">
          <a href="/wp-admin/options-general.php?page=yo-login.php&orderby=title&order=desc">
            <span>Заголовок</span>
            <span class="sorting-indicator"></span>
          </a>
        </th>
        <th scope="col" id="shortcode" class="manage-column column-shortcode">Код вставки</th>
        <th scope="col" id="author" class="manage-column column-author sortable desc">
          <a href="/wp-admin/options-general.php?page=yo-login.php&orderby=author&order=asc">
            <span>Автор</span>
            <span class="sorting-indicator"></span>
          </a>
        </th>
        <th scope="col" id="date" class="manage-column column-date sortable desc">
          <a href="/wp-admin/options-general.php?page=yo-login.php&orderby=date&order=asc">
            <span>Дата</span>
            <span class="sorting-indicator"></span>
          </a>
        </th>
      </tr>
      </thead>

      <tbody id="the-list" data-wp-lists="list:post">
      <?php if(count($forms) == 0){ ?>
        <tr class="no-items">
          <td class="colspanchange" colspan="5">Элементов не найдено.</td>
        </tr>
      <?php }else{ ?>
        <?php foreach($forms as $form){ ?>

          <tr>
            <th scope="row" class="check-column"><input name="post[]" value="<?=$form->ID?>" type="checkbox" title="post"></th>
            <td class="title column-title has-row-actions column-primary" data-colname="Заголовок">
              <strong>
                <a class="row-title" href="/wp-admin/options-general.php?page=yo-login.php&action=edit&id=<?=$form->ID?>" title="Изменить “<?=$form->post_title?>”"><?=$form->post_title?></a>
              </strong>
              <div class="row-actions">
                  <span class="edit">
                    <a href="/wp-admin/options-general.php?page=yo-login.php&action=edit&id=<?=$form->ID?>">Изменить</a>
                  </span>
              </div>
              <button type="button" class="toggle-row">
                <span class="screen-reader-text">Показать больше деталей</span>
              </button>
              <button type="button" class="toggle-row">
                <span class="screen-reader-text">Показать больше деталей</span>
              </button>
            </td>
            <td class="shortcode column-shortcode" data-colname="Код вставки">
                <span class="shortcode">
                  <input onfocus="this.select();" readonly="readonly" value="[yo-<?=$form->post_excerpt?> id=&quot;<?=$form->ID?>&quot; title=&quot;<?=$form->post_title?>&quot;]" class="large-text code" type="text" title="shortcode">
                </span>
            </td>
            <td class="author column-author" data-colname="Автор">
              <?php
              $user = get_userdata($form->post_author);
              echo $user->user_nicename;
              ?>
            </td>
            <td class="date column-date" data-colname="Дата"><abbr title="<?=$form->post_date?>"><?=date('Y/m/d', strtotime($form->post_date))?></abbr></td>
          </tr>
        <?php } ?>
      <?php } ?>
      </tbody>

      <tfoot>
      <tr>
        <td class="manage-column column-cb check-column">
          <label class="screen-reader-text" for="cb-select-all-2">Выделить все</label>
          <input id="cb-select-all-2" type="checkbox">
        </td>
        <th scope="col" class="manage-column column-title column-primary sortable asc">
          <a href="/wp-admin/options-general.php?page=yo-login.php&orderby=title&order=desc">
            <span>Заголовок</span>
            <span class="sorting-indicator"></span>
          </a>
        </th>
        <th scope="col" class="manage-column column-shortcode">Код вставки</th>
        <th scope="col" class="manage-column column-author sortable desc">
          <a href="/wp-admin/options-general.php?page=yo-login.php&orderby=author&order=asc">
            <span>Автор</span>
            <span class="sorting-indicator"></span>
          </a>
        </th>
        <th scope="col" class="manage-column column-date sortable desc">
          <a href="/wp-admin/options-general.php?page=yo-login.php&orderby=date&order=asc">
            <span>Дата</span>
            <span class="sorting-indicator"></span>
          </a>
        </th>
      </tr>
      </tfoot>
    </table>

  <?php
  }elseif($_GET['action'] == 'new'){
    if(isset($_POST['new']) && !empty($_POST['title'])){

      $form = array(
        'type'=>wp_strip_all_tags($_POST['type']),
        'template'=>stripslashes($_POST['template']),
        'fields'=>yo_get_fields(str_replace('\"', '"', $_POST['template']))
      );

      $data = array('post_type' => 'yo_form',
        'post_content'  => serialize($form),
        'post_excerpt'  => wp_strip_all_tags($_POST['type']),
        'post_title'    => wp_strip_all_tags($_POST['title']),
        'post_status'   => 'publish',
        'post_author'   => get_current_user_id()
      );

      $post_id = wp_insert_post($data);
      if($post_id){
        $data['ID'] = $post_id;
        $form['html'] = yo_get_html(str_replace('\"', '"', $_POST['template']), wp_strip_all_tags($_POST['type']), $post_id);
        $data['post_content'] = serialize($form);
        wp_update_post($data);
        echo '<script>';
        echo 'window.location = "' . home_url() . '/wp-admin/options-general.php?page=yo-login.php&action=edit&id='.$post_id.'"';
        echo '</script>';
      }
    }
    ?>
    <form action="" method="post">
      <input type="hidden" name="new" value="new-form">
      <input type="text" name="title" id="title" placeholder="Title"/>
      <select name="type" id="type" title="type">
        <option value="login">Login</option>
        <option value="register">Register</option>
      </select>
      <div class="buttons">
        <button id="email">Email</button>
        <button id="repeat-email">Repeat Email</button>
        <button id="login">Login</button>
        <button id="password">Password</button>
        <button id="repeat-password">Repeat password</button>
        <button id="custom">Custom</button>
      </div>
        <textarea name="template" id="template" rows="20" placeholder="Template" style="width:100%">
[email* email table:users field:user_email placeholder "Email"]
[text* login table:users field:user_login placeholder "Login"]
[password* password placeholder "Password"]
[password* repeat-password simile:password placeholder "Repeat password"]
[submit "Submit"]
        </textarea>
      <input type="submit" value="Submit"/>
    </form>

  <?php
  }elseif($_GET['action'] == 'edit'){
    if(isset($_POST['update']) && !empty($_POST['title'])){

      $form = array(
        'type'=>wp_strip_all_tags($_POST['type']),
        'template'=>stripslashes($_POST['template']),
        'fields'=>yo_get_fields(str_replace('\"', '"', $_POST['template'])),
        'html'=>yo_get_html(str_replace('\"', '"', $_POST['template']), wp_strip_all_tags($_POST['type']), $_GET['id'])
      );

      $data = array('ID' => $_GET['id'],
        'post_type' => 'yo_form',
        'post_content'  => serialize($form),
        'post_excerpt'  => wp_strip_all_tags($_POST['type']),
        'post_title'    => wp_strip_all_tags($_POST['title']),
        'post_status'   => 'publish',
        'post_author'   => get_current_user_id()
      );

      if(wp_update_post($data)){
        $content = $form;
        $form = get_post($_GET['id']);
      }else{
        $form = get_post($_GET['id']);
        $content = unserialize($form->post_content);
      }

    }else{
      $form = get_post($_GET['id']);
      $content = unserialize($form->post_content);
    }
    ?>
    <form action="" method="post">
      <input type="hidden" name="update" value="update-form">
      <input type="text" name="title" id="title" placeholder="Title" value="<?=$form->post_title?>"/>
      <div class="inside">
        <p class="description">
          <label for="yo-shortcode">Copy this shortcode and paste it into your post, page, or text widget content:</label>
            <span class="shortcode wp-ui-highlight">
              <input id="yo-shortcode" onfocus="this.select();" readonly="readonly" class="large-text code" value="[yo-<?=$form->post_excerpt?> id=&quot;<?=$form->ID?>&quot; title=&quot;<?=$form->post_title?>&quot;]" type="text">
            </span>
        </p>
      </div>
      <select name="type" id="type" title="type">
        <option value="login" <?=$content['type']=='login'?'selected':''?>>Login</option>
        <option value="register" <?=$content['type']=='register'?'selected':''?>>Register</option>
      </select>
      <div class="buttons">
        <button id="email">Email</button>
        <button id="repeat-email">Repeat Email</button>
        <button id="login">Login</button>
        <button id="password">Password</button>
        <button id="repeat-password">Repeat password</button>
        <button id="custom">Custom</button>
      </div>
        <textarea name="template" id="template" rows="20" placeholder="Template" style="width:100%">
<?=$content['template']?>
        </textarea>
      <input type="submit" value="Submit"/>
    </form>

  <?php

  }
}

// Парсинг полей
function yo_get_fields($template){
  $form_fields = array();

  preg_match_all('|\[(.+)\]|U', $template, $fields);

  foreach($fields[1] as $field){
    $form_fields = array_merge ($form_fields, yo_get_field($field));
  }

  return $form_fields;
}

// Парсинг отдельного поля
function yo_get_field($field){
  $tables = array('users', 'usermeta');
  $field_data = explode(' ', $field);
  $field_params = array();

  if($field_data[0] != 'submit'){
    $key = $field_data[1];
    yo_remove_from_array($key, $field_data);

    if(substr($field_data[0], -1) == '*'){
      $field_params[$key] = array('required'=>true, 'type'=>str_replace('*', '', $field_data[0]));
    }else{
      $field_params[$key] = array('required'=>false, 'type'=>$field_data[0]);
    }

    array_shift($field_data);

    preg_match('|"(.+?)"|U', $field, $val);

    if(count($val) == 2){
      $field_data = yo_remove_from_array($val[0], $field_data);
      if(in_array('placeholder', $field_data)){
        $field_params[$key]['placeholder'] = $val[1];
        $field_data = yo_remove_from_array('placeholder', $field_data);
      }else{
        if($field_params[$key]['type'] == 'select') {
          $data = explode(';', $val[1]);
          $options = array();
          foreach($data as $option){
            if(strpos($option, ' : ') === false){
              $options[$option] = $option;
            }else{
              $option = explode(' : ', $option);
              $options[$option[0]] = $option[1];
            }
          }
          $field_params[$key]['value'] = $options;
        }else
          $field_params[$key]['value'] = $val[1];
      }
      unset($val);
    }

    foreach($tables as $table){
      if(in_array('table:'.$table, $field_data)){
        $field_params[$key]['destination'] = $table;
        $field_data = yo_remove_from_array('table:'.$table, $field_data);
        break;
      }
    }

    foreach($field_data as $data){
      if(strpos($data, 'field:') !== false){
        $field_params[$key]['name'] = str_replace('field:', '', $data);
        break;
      }
    }

    foreach($field_data as $data){
      if(strpos($data, 'simile:') !== false){
        $field_params[$key]['destination'] = 'simile';
        $field_params[$key]['name'] = str_replace('simile:', '', $data);
        break;
      }
    }

    foreach($field_data as $data){
      if(strpos($data, 'surrogate:') !== false){
        $field_params[$key]['surrogate'] = str_replace('surrogate:', '', $data);
        break;
      }
    }

    foreach($field_data as $data){
      if(strpos($data, 'class:') !== false){
        $field_params[$key]['class'] = str_replace('class:', '', $data);
        break;
      }
    }
  }else{
    preg_match('|"(.+?)"|U', $field, $val);
    if(count($val) == 2) {
      $field_params['submit'] = array('type' => 'submit', 'value' => $val[1]);
    }else{
      $field_params['submit'] = array('type' => 'submit', 'value' => 'Submit');
    }

    foreach($field_data as $data){
      if(strpos($data, 'class:') !== false){
        $field_params['submit']['class'] = str_replace('class:', '', $data);
        break;
      }
    }
  }

  return $field_params;
}

function yo_remove_from_array($value, $array){
  if(($key = array_search($value,$array)) !== FALSE){
    unset($array[$key]);
  }
  return $array;
}