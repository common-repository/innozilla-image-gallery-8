<?php
    /**
    * Description : Very simple Image Gallery with filter and load more
    * Package : Innozilla Image Gallery 8
    * Version : 1.0
    * Author : Innozilla
    */

	// Wordpress admin action hooks
	add_action('admin_menu', 'IIG8_admin_sub_menu');
	add_action('admin_init','IIG8_settings_init');
	

	//  Register Settings Menu

	function IIG8_admin_sub_menu() {
		$parent_slug = 'edit.php?post_type=cs_gallery';
		add_submenu_page( $parent_slug , 'Innozilla Image Gallery 8 - Settings', 'Settings', 'manage_options', 'iig8-settings', 'iIIG8_admin_display_settings');
	}

	// Display Submenu - Callback

	function iIIG8_admin_display_settings() {
	?>
		<div class="wrap">

			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

			<?php
				// Error Settings
				settings_errors();

				// Get options
				$options = get_option('iig8_options');
				
			?>

			 <form action="options.php" method="post">

				<?php
					settings_fields( 'iig8-dir-options' );
					do_settings_sections( 'iig8-dir-options' );
				?>

				<table class="form-table iig8-table">
					<tr valign="top">
						<h2>Instructions</h2>
						<h4>1. Paste this shortcode <span style="font-size:20px;">[isotope_gallery]</span> to the page you want the Image Gallery to be shown. </h4>
					</tr>

					<tr valign="top">
						<th scope="row"><?php echo __('Number of images to show','iig8-text'); ?><br><span style="font-size:12px; font-style: italic;">Default: 9</span>
						<td>
							<input class="regular-text" type="text" name="iig8_options[per_page]"  placeholder="e.g: '9' per page"  value="<?php echo ( isset($options['per_page']) ? esc_attr( $options['per_page'] ) : '' ); ?>" />
						</td>
					</tr>

					<tr valign="top">
						<th scope="row"><?php echo __('Number of images to "load more"','iig8-text'); ?><br><span style="font-size:12px; font-style: italic;">Default: 3</span>
						<td>
							<input class="regular-text" type="text" name="iig8_options[load_more]"  placeholder="e.g: '3' per load more"  value="<?php echo ( isset($options['load_more']) ? esc_attr( $options['load_more'] ) : '' ); ?>" />
						</td>
					</tr>

					<tr valign="top">
						<th scope="row"><?php echo __('"All" Filter overwrite"','iig8-text'); ?>
						<td>
							<input class="regular-text" type="text" name="iig8_options[allover]"  placeholder="e.g: All Categories"  value="<?php echo ( isset($options['allover']) ? esc_attr( $options['allover'] ) : '' ); ?>" />
						</td>
					</tr>

					<tr valign="top">
						<?php $lbox = $options['lbox']; ?>
						<th scope="row"><?php echo __('Enable Lightbox to image','iig8-text'); ?>
						<td>
							<input type="checkbox" name="iig8_options[lbox]" value="1" <?php checked(1, $lbox, true); ?>  />
						</td>
					</tr>

					<tr valign="top">
						<?php $checkbox1 = $options['check1']; ?>
						<th scope="row"><?php echo __('Enable hover effect with Text','iig8-text'); ?>
						<td>
							<input type="checkbox" name="iig8_options[check1]" value="1" <?php checked(1, $checkbox1, true); ?>  />
						</td>
					</tr>

					<tr valign="top">
						<?php $dgrid = $options['dgrid']; ?>
						<th scope="row"><?php echo __('Disable Grid Transition','iig8-text'); ?>
						<td>
							<input type="checkbox" name="iig8_options[dgrid]" value="1" <?php checked(1, $dgrid, true); ?>  />
						</td>
					</tr>

				</table>

				<?php
					// Submit Button
					submit_button('Save Settings');
				?>
			</form>
		</div>
	<?php
	}

	/*  Register Custom Settings */

	function IIG8_settings_init() {
		// Group name, Option Name
		register_setting( 'iig8-dir-options', 'iig8_options' );
	}

?>