<?php
/*
Plugin Name: Gravity Forms - Data Persistence Reloaded - Save Button
Description: Extends the 'Gravity Forms - Data Persistence Reloaded' plugin to add a save button to the form footer - allowing users to instantly save their form, and providing the reassurance that the form has been saved.
Version: 1.1
Author: Adrian Gordon
License: GPL2
*/

add_action('admin_notices', array('ITSP_GF_DPR_Save_Button', 'admin_warnings'), 20);

if (!class_exists('ITSP_GF_DPR_Save_Button')) {
    class ITSP_GF_DPR_Save_Button
    {
		private static $name = 'Gravity Forms - Data Persistence Reloaded - Save Button';
		private static $slug = 'itsp_gp_drp_save_button';
		
		/**
         * the save button template
         */
		public static $save_button =  "<input type='button' value='Save' class='button gform_next_button itsg_gf_save_button' onclick='itsg_gf_save_button_ajax_function();'> "; 

        /**
         * Construct the plugin object
         */
		 public function __construct()
        {
            // register actions
            if ((self::is_gravityforms_installed())) {
			// start the plugin
			add_action('gform_enqueue_scripts', array(&$this,'itsg_gf_save_button_button_ajax'), 90, 3);
			
			}
        } // END __construct
		
		/**
         * Place the save button before the 'Next' button
         */
		function itsg_gf_next_button_markup( $next_button, $form ) {
			$save_button = self::$save_button;
			return $save_button.$next_button;
		} // END my_next_button_markup
		
		/**
         * Place the save button before the 'Submit' button
         */
		function itsg_gf_submit_button_markup( $submit_button, $form ) {
			$save_button = self::$save_button;
			return $save_button.$submit_button;
		} // END my_submit_button_markup

		/**
         * If Ajax data persistence is enabled, user is logged in and current form is not a user registration form - enqueue javascript and buttons
         */
		public function itsg_gf_save_button_button_ajax($form, $is_ajax) {
	
			if($form['ri_gfdp_persist'] == 'ajax' && is_user_logged_in() && !self::is_user_registration_form($form)) {
			
				add_action('wp_footer', array(&$this,'itsg_gf_save_button_ajax'));
				add_filter( 'gform_next_button', array(&$this,'itsg_gf_next_button_markup'), 10, 2 );
				add_filter( 'gform_submit_button', array(&$this,'itsg_gf_submit_button_markup'), 10, 2 );
				
			}
		} // END itsg_gf_save_button_button_ajax
		
		/**
         * Ajax to handle button press - 
		 *     activates the 'save' command, 
		 *     sets the button value to 'Saving ...' whilst being saved, 
		 *     sets the button value to 'Saved' for three seconds to confirm to the user that the save completed,
		 *     sets the button value back to 'Save'
         */
		public static function itsg_gf_save_button_ajax() {
		?>
				<script type="text/javascript" >
				function itsg_gf_save_button_ajax_function() {
				jQuery('.gform_body').find('.itsg_gf_save_button').prop('value', '<?php _e('Saving ...', self::$slug); ?>');
				
					changed = true; 
					gfdp_ajax();
					jQuery(document).ajaxComplete(function(event, request, settings ) {
						if ( settings.url === '<?php echo admin_url('admin-ajax.php'); ?>' && request.responseText === 'Saved' ) {
							itsg_gf_save_button_ajax_reset_button_function();
						}
					});
				}
								
				function itsg_gf_save_button_ajax_reset_button_function() {
					jQuery('.gform_body').find('.itsg_gf_save_button').prop('value', '<?php _e('Saved', self::$slug); ?>');
					setTimeout(function(){
						jQuery('.gform_body').find('.itsg_gf_save_button').prop('value', '<?php _e('Save', self::$slug); ?>');
					}, 3000);
				}
				
				</script> <?php
		} // END itsg_gf_save_button_ajax

		/*
         * Warning message if Gravity Forms is not installed and enabled
         */
		public static function admin_warnings() {
			if ( !self::is_gravityforms_installed() ) {
				$gf_message = __('Requires Gravity Forms to be installed.', self::$slug);
			}
			if ( !self::is_dpr_installed() ) {
				$gfdpr_message = __('Requires Gravity - Data Persistence Reloaded to be installed.', self::$slug);
			}
			
			if (!empty($gf_message)) {
			?>
			<div class="error">
				<p>
					<?php _e('The plugin ', self::$slug); ?><strong><?php echo self::$name; ?></strong> <?php echo $gf_message; ?><br />
					<?php _e('Please ',self::$slug); ?><a href="http://www.gravityforms.com/"><?php _e(' download the latest version',self::$slug); ?></a><?php _e(' of Gravity Forms and try again.',self::$slug) ?>
				</p>
			</div>
			<?php
			}
			
			if (!empty($gfdpr_message)) {
			?>
			<div class="error">
				<p>
					<?php _e('The plugin ', self::$slug); ?><strong><?php echo self::$name; ?></strong> <?php echo $gfdpr_message; ?><br />
					<?php _e('Please ',self::$slug); ?><a href="https://wordpress.org/plugins/gravity-forms-data-persistence-add-on-reloaded/"><?php _e(' download the latest version',self::$slug); ?></a><?php _e(' of Gravity Forms Data Persistence Add-On Reloaded and try again.',self::$slug) ?>
				</p>
			</div>
			<?php
			} 
			
		} // END admin_warnings

		/*
         * Check if GF is installed
         */
        private static function is_gravityforms_installed()
        {
            return class_exists('GFAPI');
        } // END is_gravityforms_installed
		
		/*
         * Check if Gravity Forms - Data Persistence Reloaded is installed
         */
        private static function is_dpr_installed() 
        {
            return function_exists('ri_gfdp_ajax');
        } // END is_dpr_installed
		
		private static function is_user_registration_form($form)
		{
		global $wpdb;
		
		$form_id = $form[id];
		$table_user_reg = $wpdb->prefix . "rg_userregistration";
		
		$sql = "SELECT userreg.form_id
		FROM $table_user_reg as userreg 
		WHERE userreg.form_id = $form_id";
		
		$results = $wpdb->get_results($sql);
		
		if (!empty($results)) {
			return true;
			} 
		}
		
	}
    $ITSP_GF_DPR_Save_Button = new ITSP_GF_DPR_Save_Button();
}

?>