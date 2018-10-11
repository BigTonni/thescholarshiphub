/*
 * Frontend
 */

jQuery(document).ready(function ($) {
    $('.searchicon .fa').click(function () {
        $('header .search-form').toggle();
    });

      clippingText('.clippingText_1', 22);
      function clippingText(selector, length) {
        var titles = document.querySelectorAll(selector);
        for (var i = 0; i < titles.length; ++i) {
          if (titles[i].textContent.split('').length > length)
            titles[i].textContent = titles[i].textContent.slice(0, length) + ' ...';
        }
      }

    function change_status_content(elem){
        if(elem=='Educator'){
            $('#others_role_wrapper p select :selected').val("1");
            $('#others_role_wrapper p select[multiple="multiple"] option:eq(0)').attr("selected","selected").val("1");
            $('#others_role_wrapper p input').val("1");
            $('#educator_selected_role_wrapper').show();
            $('#others_role_wrapper').hide();
        }
        else if(elem==''){
            $('#others_role_wrapper p select :selected').val("1");
            $('#others_role_wrapper p select[multiple="multiple"] option:nth-child(1)').attr("selected","selected").val("1");
            $('#others_role_wrapper p input').val("1");
            $('#educator_selected_role_wrapper').hide();
            $('#others_role_wrapper').hide(); 
        }
        else{
            $('#others_role_wrapper p select :selected').val("");
            $('#others_role_wrapper p select[multiple="multiple"] option:nth-child(1)').removeAttr('selected').val("");
            $('#others_role_wrapper p input').val("");         
            $('#educator_selected_role_wrapper').hide();
            $('#others_role_wrapper').show(); 
        }
    }
    change_status_content($('#rcp_status').val());
    $('#rcp_status').on('change',function(){
        change_status_content($(this).val())
        console.log( $('#others_role_wrapper p select :selected').val());
        console.log( $('#others_role_wrapper p input').val());
    });


    $('#rcp_registration_form #rcp_submit').on('click',function(e){
        setTimeout(function() { 
            if( ($('.rcp_message.error').length === 0) && ($('#rcp_additional_newsletter').is(':checked') || $('#rcp_additional_opportunities').is(':checked')) ){
                $('#subscription-constantcontact-form form input[type="email"]').val($('#rcp_registration_form #rcp_user_email').val());
                $('#subscription-constantcontact-form form input[type="text"]').val($('#rcp_registration_form #rcp_user_first').val() + " " + $('#rcp_registration_form #rcp_user_last').val());
                $('#subscription-constantcontact-form form input[type="submit"]').trigger( "click" );
            }
            else{
                $('#subscription-constantcontact-form form input[type="email"]').val('');
                $('#subscription-constantcontact-form form input[type="text"]').val('');
            }
        }, 1000);
    });

    $('#subscription-constantcontact-form form input[type="submit"]').on('click',function(e){
        setTimeout(function() {
        }, 1500);
    });

	$(document).on('click','body.page-template-template-my-account .nav-tabs li a',function(){
		$('.nav-tabs li').removeClass('active');
		$('div.tab').removeClass('active');
		$('.tab'+$(this).data('tab')).addClass('active');
	});
        
        $('#scholarship_form_btn input').on('click',function(){
            if($( "#scholarship_list" ).val() != false ){
                if( $( "#scholarship_list" ).val() == 'register' ){
                    window.location.href = $( 'input[name="redirect_path"]' ).val() + '/register/';
                }else{
                    window.location.href = $( 'input[name="redirect_path"]' ).val() + '?location=' + $( "#scholarship_list" ).val();
                }
            }
        });
});