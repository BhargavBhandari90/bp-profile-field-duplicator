<?php
/**
 * Exit if accessed directly
 *
 * @package Bp_Profile_Field_Duplicator
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! class_exists( 'BP_Profile_Field_Duplicator_Admin' ) ) {
	/**
	 * Class for Ventures methods.
	 *
	 * @package GCA_Core
	 */
	class BP_Profile_Field_Duplicator_Admin {

		/**
		 * Cunstructor for admin class.
		 */
		public function __construct() {

			if ( ! is_admin() ) {
				return;
			}

			// Add duplicator button.
			add_action( 'xprofile_admin_field_action', array( $this, 'bppfc_add_duplicator_button' ) );

			// Add script in admin head.
			add_action( 'admin_head', array( $this, 'bppfc_admin_head' ) );

			// Enqueue custom script.
			add_action( 'admin_enqueue_scripts', array( $this, 'bppfc_enqueue_script' ) );

			// Duplicate the profile field.
			add_action( 'wp_ajax_bppfc_duplicate_field', array( $this, 'bppfc_duplicate_profile_field' ) );

		}

		/**
		 * Add button for duplication.
		 *
		 * @param  object $field Object of profile field.
		 * @return void
		 */
		public function bppfc_add_duplicator_button( $field ) {

			echo sprintf(
				'<a class="button bppfc_duplicator" href="javascript:void(0)" data-id="%d">%s</a><div class="spinner"></div>',
				esc_attr( $field->id ),
				esc_html__( 'Duplicate This', 'bp-profile-field-duplicator' )
			);

		}

		/**
		 * Add object for adding necessary data to be sued in custom script.
		 */
		public function bppfc_admin_head() {
			?>
			<script type="text/javascript">
				var bppfc_obj = {
					confirmation_string : '<?php echo esc_html__( 'Are you sure you want to duplicate this?', 'bp-profile-field-duplicator' ); ?>'
				};
			</script>
			<?php
		}

		/**
		 * Enqueue custom script for the plugin.
		 *
		 * @param  string $hook Hook name of current page in admin section.
		 * @return void.
		 */
		public function bppfc_enqueue_script( $hook ) {

			// If it's not profile field page, then don't add the script.
			if ( 'users_page_bp-profile-setup' !== $hook ) {
				return;
			}

			wp_enqueue_script( 'bppfc_duplicator_script', BPPFC_URL . 'assets/js/admin-script.js' );

		}

		/**
		 * Duplicate the profile field.
		 */
		public function bppfc_duplicate_profile_field() {

			// Bail, if anything goes wrong.
			if ( ! function_exists( 'bp_is_active' )
				|| empty( $_POST )
				|| ( isset( $_POST['action'] ) && 'bppfc_duplicate_field' !== $_POST['action'] ) ) {
				wp_send_json_error( esc_html__( 'Something went wrong.', 'bp-profile-field-duplicator' ) );
			}

			// Get the profile field ID.
			$field_id = ( isset( $_POST['field_id'] ) && ! empty( $_POST['field_id'] ) )
				? intval( $_POST['field_id'] )
				: 0;

			if ( empty( $field_id ) ) {
				wp_send_json_error( esc_html__( 'Field is not available.', 'bp-profile-field-duplicator' ) );
			}

			// Get field object.
			$field = xprofile_get_field( $field_id );

			if ( empty( $field ) ) {
				wp_send_json_error( esc_html__( 'Field is not available.', 'bp-profile-field-duplicator' ) );
			}

			// Set args for creating new field.
			$field_args = array(
				'field_group_id'    => (int) $field->group_id,
				'parent_id'         => (int) $field->parent_id,
				'type'              => $field->type,
				'name'              => $field->name . __( ' - Copy', 'bp-profile-field-duplicator' ),
				'description'       => $field->description,
				'is_required'       => (bool) $field->is_required,
				'can_delete'        => true,
				'order_by'          => $field->order_by,
				'is_default_option' => (bool) $field->is_default_option,
				'option_order'      => (int) $field->option_order,
				'field_order'       => (int) $field->field_order,
			);

			// Create new duplicate field.
			$duplicate_field_id = xprofile_insert_field( $field_args );

			// If field creation successful, then generate new field element.
			if ( $duplicate_field_id ) {

				$duplicate_field = xprofile_get_field( $duplicate_field_id ); // Get duplicate field object.
				$field_group     = xprofile_get_field_group( $field->group_id ); // Get field group object.

				// Generate the element.
				ob_start();
				xprofile_admin_field( $duplicate_field, $field_group, '' );
				$duplicate_field_element = ob_get_contents();
				ob_end_clean();

				// Create array for sending json response.
				$response = array(
					'success'           => true,
					'original_field_id' => $field_id,
					'group_id'          => $field->group_id,
					'duplicate_field'   => $duplicate_field_element,
				);

				// Send response.
				wp_send_json( $response );

			}

			wp_send_json_error( esc_html__( 'Fail to create duplicate field.', 'bp-profile-field-duplicator' ) );

		}

	}

	new BP_Profile_Field_Duplicator_Admin();

}
