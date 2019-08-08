/*!
 * Media Uploader v1.0
 *
 * 
 * Copyright (c) octagon web studio
 *
 */

(function($) {

	$.octagonMediaUploader = function( con, options ){

		// Store variables in parent class object
		this.$con = $(con);
		this.$input = this.$con.find('input')

		var $con = this.$con,
			uploader_title = ( 'undefined' != typeof( $con.data( 'uploader-title' ) ) ) ? $con.data( 'uploader-title' ) : octagon_core_obj.uploader_title,
			multiple       = ( 'undefined' != typeof( $con.data( 'allow-multiple' ) ) ) ? $con.data( 'allow-multiple' ) : false,
			library        = ( 'undefined' != typeof( $con.data( 'type' ) ) ) ? $con.data( 'type' ) : 'image',
			button_text    = ( 'undefined' != typeof( $con.data( 'button-text' ) ) ) ? $con.data( 'button-text' ) : octagon_core_obj.set_image;

		var defaults = {
			uploader_title : uploader_title,
			multiple : multiple,
			library : library,
			button_text : button_text
		};

		this.MediaFrame;
		this.settings = $.extend( {}, defaults, options );

		this._build();
	};

	$.octagonMediaUploader.prototype = {

		_build: function() {

			this.bindEvent();
		},

		bindEvent: function() {

			var parentClass = this;

        	parentClass.$con.on('click', '.custom-media-upload-btn', function(e) {
        		e.preventDefault();
        		parentClass.createFrame();
        	});

        	parentClass.$con.on('click', '.remove-custom-media', function(e) {
        		e.preventDefault();

        		var attachmentId = $(this).data('id');

        		parentClass.removeAttachment( parentClass.$con, $(this), attachmentId );
        	});
        },

		createFrame: function( $this ) {

			var parentClass = this,
				$con = parentClass.$con,
				$input = parentClass.$input,
				settings = parentClass.settings;

			if ( parentClass.MediaFrame ) {
				parentClass.MediaFrame.open();
				return;
		    }

		    // Initialize wp.media frame
			MediaFrame = parentClass.MediaFrame = wp.media({
				title: settings.uploader_title,
				multiple: settings.multiple,
				library: { 
					type: settings.library
				},
				button: {
					text: settings.button_text
				}					
			});

			MediaFrame.on( 'open', function() {

				var attachmentId = parentClass.$input.val(),
					selection = MediaFrame.state().get('selection');

				// Get the attachment ID from input and make the attachments as selected
				attachmentId = attachmentId.split(',');

				attachmentId.forEach( function(id) {
					attachment = wp.media.attachment(id);
					attachment.fetch();
					selection.add(attachment ? [attachment] : []);
				});

			})

			MediaFrame.on( 'select', function() {

				// Pass the frames to get media attachment id
				var attachmentId = parentClass.getAttachmentId( MediaFrame, settings.multiple );

				// Send the attachment id to hidden input
				$input.val( attachmentId );

				// Pass the attachment ID to ajax function to build preview html 
				parentClass.getPreviewHtml( $con, attachmentId, settings.library );

			});

			MediaFrame.open();
		},

		getAttachmentId: function( MediaFrame, multiple ) {

			// From wp.media frame selection build up attachment id as array
			var selection = MediaFrame.state().get('selection'),
				attachment,
				attachmentId = [];

			if( multiple ) {
				selection.map( function( attachment ) {
					attachment = attachment.toJSON();
					attachmentId.push(attachment.id);
				});
			}
			else {
				attachment = selection.first().toJSON();
				attachmentId.push(attachment.id);
			}

			return attachmentId;

		},

        /* Split the stored attached id as array and rid of the particular attachment id by selection */
        removeAttachment: function( $con, $self, attachmentId ) {

        	var savedAttachmentId = $con.find('input').val();

        	savedAttachmentId = savedAttachmentId.split(',');

        	savedAttachmentId = $.grep( savedAttachmentId, function( value ) {
				return value != attachmentId;
			});

        	$con.find('input').val( savedAttachmentId );

        	$self.closest('div').remove();
        },

        /* It passes the attachment id and get the preview html( <img> <audio> <video> ) and insert into ".media-lists". */
        getPreviewHtml: function( $con, attachmentId, library ) {
        	var result;
        	$.ajax({
				type: 'post',
				url: octagon_core_obj.ajaxurl,
				data: {
					'action' : 'octagon_get_media_preview_ajax',
					'attachment_id' : attachmentId,
					'library' : library
				},
			}).done(function( result ) {
				$con.find('.media-lists').html(result);
			});

			return result;
        }

	};

	$.fn.octagonMediaUploader = function( options ) {

		// Initialize
		return this.each(function() {
			if( ! $( this ).data( 'init-media-uploader' ) ) {
				$( this ).data( 'init-media-uploader', new $.octagonMediaUploader( this, options ) );
			}
		});
	
	};


	/*
	 * octagonMediaUploader allows objects to over-right those objects
	 * 
	 * uploader_title [string]
	 * multiple [bool]
	 * library [string] // image, audio, video, text, application
	 * button_text : [string]
	 */

	$('.custom-media-upload').octagonMediaUploader();

}(jQuery));