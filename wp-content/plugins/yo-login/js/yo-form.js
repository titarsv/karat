jQuery(document).ready(function($){
    jQuery.browser = {};
    jQuery.browser.mozilla=/mozilla/.test(navigator.userAgent.toLowerCase())&&!/webkit/.test(navigator.userAgent.toLowerCase());
    jQuery.browser.webkit=/webkit/.test(navigator.userAgent.toLowerCase());
    jQuery.browser.opera=/opera/.test(navigator.userAgent.toLowerCase());
    jQuery.browser.msie=/msie/.test(navigator.userAgent.toLowerCase());

    $(".yo-form").submit(function(e){
        $this = $(this);
        e.preventDefault();
        var $that = $(this),
            fData = $that.serializeArray();
        $.ajax({
            url: $that.attr("action"),
            type: $that.attr("method"),
            data: fData,
            dataType: "html",
            success: function(data){
                if(data == "success"){
                    $("#yo-info").append("<p class='success'>Success</p>");
                    $this.trigger('yo-form-success', {});
                }else{
                    var response = $.parseJSON(data);
                    var i;
                    if(typeof response.errors !== "undefined"){
                        var container = $this.find("#yo-info");
                        for(i=0;i<response.errors.length;i++){
                            container.append("<p class='error'>"+response.errors[i]+"</p>");
                        }
                        $this.trigger('yo-form-error', {errors:response.errors});
                    }else{
                        $this.find("input, textarea").removeClass("error");
                        for(i=0;i<response.length;i++){
                            $this.find("#yo-"+response[i]).addClass("error");
                        }
                        $this.trigger('yo-form-error', {errors:response});
                    }
                }
            }
        });
        return false;
    });
    $('#yo-login-803').on('yo-form-success', function(){
        window.location = '/wp-admin/';
    });
    $('#yo-register-834').on('yo-form-success', function(){
        $('#yo-register-834 .login-popup__form-notice').text('You have been sent a letter. Check your email!');
    });
});