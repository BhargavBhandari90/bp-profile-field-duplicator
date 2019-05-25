/* global bppfc_obj */
( function ( $ ) {

	window.BP_Profile_Field_Duplicator_Script = {

		init: function () {

			this.bppfc_duplicate_profile_field();

		},

		/**
		 * Request duplication on button click.
		 */
		bppfc_duplicate_profile_field: function() {

			$( document ).on( 'click', '.bppfc_duplicator', function() {

				// Ask for confirmation.
				var r = confirm( bppfc_obj.confirmation_string );

				if ( r == false ) {
					return false;
				}

				var spinner = $( this ).next( '.spinner' ),
				    data    = {
						'action'   : 'bppfc_duplicate_field',
						'field_id' : $( this ).data( 'id' ),
						'security' : bppfc_obj.field_duplicate_nounce
					}

				// Show spinner.
				spinner.addClass( 'is-active' );

				// Send post request.
				jQuery.post( ajaxurl, data, function( response ) {

					if ( response.success ) {

						var group_id = response.group_id,
						    original_field_id = response.original_field_id;

						// Add field after the original field.
						$( '#tabs-' + group_id + ' #draggable_field_' + original_field_id ).after( response.duplicate_field );

						// If it's textarea, then initiate the tunyMCE editor.
						if ( 'textarea' === response.field_type ) {

							tinymce.init({
								selector:'#xprofile_textarea_' + response.duplicate_field_id,
								theme: "modern",
								skin: "lightgray",
								toolbar: "bold,italic,underline,blockquote,strikethrough,bullist,numlist,alignleft,aligncenter,alignright,undo,redo,link,fullscreen",
								menubar: false,
								branding: false,
								wpautop: true,
								indent: false,
								tabfocus_elements: ":prev,:next",
							});

						}

						// Hide spinner.
						spinner.removeClass( 'is-active' );

					}

				} );

			} );

		},

	};


	$( document ).on( 'ready', function () {

		BP_Profile_Field_Duplicator_Script.init();

	} );

} )( jQuery );
