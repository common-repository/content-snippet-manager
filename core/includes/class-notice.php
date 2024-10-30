<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if( !class_exists( 'csm_admin_notice' ) ) {

	class csm_admin_notice {

		/**
		 * Constructor
		 */

		public function __construct( $fields = array() ) {

			if ( !get_user_meta( get_current_user_id(), 'csm_notice_user_id_' . get_current_user_id() , TRUE ) ) {

				add_action( 'admin_notices', array(&$this, 'admin_notice') );
				add_action( 'admin_head', array( $this, 'dismiss' ) );

			}

		}

		/**
		 * Dismiss notice.
		 */

		public function dismiss() {

			if ( isset( $_GET['csm-dismiss'] ) ) {

				update_user_meta( get_current_user_id(), 'csm_notice_user_id_' . get_current_user_id() , intval($_GET['csm-dismiss']) );
				remove_action( 'admin_notices', array(&$this, 'admin_notice') );

			}

		}

		/**
		 * Admin notice.
		 */

		public function admin_notice() {

			global $pagenow;
			$redirect = ( 'admin.php' == $pagenow ) ? '?page=csm_panel&csm-dismiss=1' : '?csm-dismiss=1';

		?>

            <div class="update-nag notice csm-notice">

            	<div class="csm-noticedescription">
				
					<strong><?php _e( 'Pay what you want to enable all pro features of Content Snippet Manager plugin, like...', 'content-snippet-manager' ); ?></strong><br/>
					
					<p class="notice-coupon-message">

						<span class="dashicon dashicons dashicons-yes-alt" size="10"></span> <?php esc_html_e( 'Snippets on header, body & footer', 'content-snippet-manager' ); ?><br/>
						<span class="dashicon dashicons dashicons-yes-alt" size="10"></span> <?php esc_html_e( 'Conversion snippets', 'content-snippet-manager' ); ?><br/>
						<span class="dashicon dashicons dashicons-yes-alt" size="10"></span> <?php esc_html_e( 'Dynamic conversion values for conversion snippets', 'content-snippet-manager' ); ?><br/>
						<span class="dashicon dashicons dashicons-yes-alt" size="10"></span> <?php esc_html_e( 'Custom post type support', 'content-snippet-manager' ); ?><br/>
						<span class="dashicon dashicons dashicons-yes-alt" size="10"></span> <?php esc_html_e( 'Custom taxonomies support', 'content-snippet-manager' ); ?><br/>
						<span class="dashicon dashicons dashicons-yes-alt" size="10"></span> <?php esc_html_e( 'Device selection', 'content-snippet-manager' ); ?><br/>
						<span class="dashicon dashicons dashicons-yes-alt" size="10"></span> <?php esc_html_e( 'User Role', 'content-snippet-manager' ); ?><br/>
						
						<span class="csm-subscription-details"><strong><?php _e( 'Subscription details', 'content-snippet-manager' ); ?></strong></span>
						<span class="dashicon dashicons dashicons-yes-alt" size="10"></span> <?php esc_html_e( 'Starting at €1', 'content-snippet-manager' ); ?><br/>
						<span class="dashicon dashicons dashicons-yes-alt" size="10"></span> <?php esc_html_e( 'Lifetime updates', 'content-snippet-manager' ); ?><br/>
						<span class="dashicon dashicons dashicons-yes-alt" size="10"></span> <?php esc_html_e( 'Lifetime support', 'content-snippet-manager' ); ?><br/>
						<span class="dashicon dashicons dashicons-yes-alt" size="10"></span> <?php esc_html_e( '30 days money back guarantee', 'content-snippet-manager' ); ?>

					</p>

				
					<?php printf( '<a href="%1$s" class="dismiss-notice">'. __( 'Dismiss this notice', 'content-snippet-manager' ) .'</a>', esc_url($redirect) ); ?>
				
				</div>

                <a target="_blank" href="<?php echo esc_url( CSM_UPGRADE_LINK . '/?ref=2&campaign=csm-notice' ); ?>" class="button"><?php _e( 'Name your price', 'content-snippet-manager' ); ?></a>
                <div class="clear"></div>

            </div>

		<?php

		}

	}

}

new csm_admin_notice();

?>
