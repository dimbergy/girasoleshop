jQuery(window).load(function() {
    var upgrade_notice = '<a class="buzzstore-pro" target="_blank" href="https://www.sparklewpthemes.com/wordpress-themes/buzzstorepro">UPGRADE TO BUZZSTORE PRO</a>';
    upgrade_notice += '<a class="buzzstore-pro" target="_blank" href="http://demo.sparklewpthemes.com/buzzstorepro/demos/">BUZZSTORE PRO DEMO</a>';
    jQuery('#customize-info .preview-notice').append(upgrade_notice);
});

jQuery(document).ready(function($){

	var buzzstore_upload;
	var buzzstore_selector;
    function buzzstore_add_file(event, selector) {

		var upload = $(".uploaded-file"), frame;
		var $el = $(this);
		buzzstore_selector = selector;
		event.preventDefault();
		if ( buzzstore_upload ) {
			buzzstore_upload.open();
		} else {
			buzzstore_upload = wp.media.frames.buzzstore_upload =  wp.media({
				title: $el.data('choose'),
				button: {
					text: $el.data('update'),
					close: false
				}
			});
			buzzstore_upload.on( 'select', function() {
				var attachment = buzzstore_upload.state().get('selection').first();
				buzzstore_upload.close();
                buzzstore_selector.find('.upload').val(attachment.attributes.url);
				if ( attachment.attributes.type == 'image' ) {
					buzzstore_selector.find('.screenshot').empty().hide().append('<img src="' + attachment.attributes.url + '"><a class="remove-image">Remove</a>').slideDown('fast');
				}
				buzzstore_selector.find('.upload-button-wdgt').unbind().addClass('remove-file').removeClass('upload-button-wdgt').val(buzzstore_widget_img.remove);
				buzzstore_selector.find('.of-background-properties').slideDown();
				buzzstore_selector.find('.remove-image, .remove-file').on('click', function() {
					buzzstore_remove_file( $(this).parents('.section') );
				});
			});
		}
		buzzstore_upload.open();
	}

	function buzzstore_remove_file(selector) {
		selector.find('.remove-image').hide();
		selector.find('.upload').val('');
		selector.find('.of-background-properties').hide();
		selector.find('.screenshot').slideUp();
		selector.find('.remove-file').unbind().addClass('upload-button-wdgt').removeClass('remove-file').val(buzzstore_widget_img.upload);
		if ( $('.section-upload .upload-notice').length > 0 ) {
			$('.upload-button-wdgt').remove();
		}
		selector.find('.upload-button-wdgt').on('click', function(event) {
			buzzstore_add_file(event, $(this).parents('.section'));
		});
	}

	$('body').on('click','.remove-image, .remove-file', function() {
		buzzstore_remove_file( $(this).parents('.section') );
    });

    $(document).on('click', '.upload-button-wdgt', function( event ) {
    	buzzstore_add_file(event, $(this).parents('.section'));
    });

});