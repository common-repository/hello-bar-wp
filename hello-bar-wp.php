<?php
/*
Plugin Name:  Hello Bar WP
Plugin URI:   
Description:  A simple plugin to show a Hello bar in the top of the page
Version:      1.0.2
Author:       Afterimage Designs
Author URI:   http://afterimagedesigns.com/
Text Domain:  hello-bar-wp
License: GPLv2 or later
 
AI Hello Bar is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
AI Hello Bar is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with AI Hello Bar. If not, see http://www.gnu.org/licenses/gpl-2.0.html.
*/

function hello_bar_wp_register_settings() {
	register_setting( 'hello_bar_wp_options', 'hello_bar_wp_enable' );
	register_setting( 'hello_bar_wp_options', 'hello_bar_wp_bg_color' );
	register_setting( 'hello_bar_wp_options', 'hello_bar_wp_close_btn_color' );
	register_setting( 'hello_bar_wp_options', 'hello_bar_wp_text-color' );
	register_setting( 'hello_bar_wp_options', 'hello_bar_wp_btn_color' );
	register_setting( 'hello_bar_wp_options', 'hello_bar_wp_btn_text_color' );
	register_setting( 'hello_bar_wp_options', 'hello_bar_wp_text' );
	register_setting( 'hello_bar_wp_options', 'hello_bar_wp_btn_text' );
	register_setting( 'hello_bar_wp_options', 'hello_bar_wp_btn_url' );
	register_setting( 'hello_bar_wp_options', 'hello_bar_wp_exclude_page' );
}

function hello_bar_wp_form()
{
    // check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <?php 
        	settings_errors(); 
        	?>
        	<div class="hello-bar-wp-wrap">
	        	<form action="options.php" method="post">
	        		<?php
		            // output security fields for the registered setting "wporg_options"
		            settings_fields('hello_bar_wp_options');
		            // output setting sections and their fields
		            // (sections are registered for "wporg", each field is registered to a specific section)
		            do_settings_sections('hello_bar_wp_options');
		            ?>
		            <p><strong>Customize your Hello Bar. You can always change this later.</strong></p>
		            <hr>
					<table class="hello-bar-wp-main-table">
						<tr valign="top">
							<td>
								<table class="form-table">
									<tr valign="top">
							        	<td>
							        		<label class="field-label" for="hello_bar_wp_text">What should your Hello Bar say?</label>
							        		<input type="text" class="hello-bar-input" name="hello_bar_wp_text" id="hello_bar_wp_text" value="<?php echo esc_attr( get_option('hello_bar_wp_text', 'Check out our latest sale') ); ?>" required />
							        	</td>
							        </tr>
							        <tr>
							        	<td>
							        		<label class="field-label">What should the button say?</label>
							        		<input type="text" class="hello-bar-input" name="hello_bar_wp_btn_text" value="<?php echo esc_attr( get_option('hello_bar_wp_btn_text', 'Shop Now!') ); ?>" required />
							        	</td>
							        </tr>
							        <tr>
							        	<td>
							        		<label class="field-label">What URL should users go to when they click your button?</label>
							        		<input type="text" class="hello-bar-input" name="hello_bar_wp_btn_url" value="<?php echo esc_attr( get_option('hello_bar_wp_btn_url', 'http://yourwebsite.com/landing-page/') ); ?>" required />
							        	</td>
							        </tr>
							        <tr>
							        	<td>
							        		<label class="field-label">ID of the pages you don't want the Hello Bar to display:</label>
							        		<input type="text" class="hello-bar-input" name="hello_bar_wp_exclude_page" value="<?php echo esc_attr( get_option('hello_bar_wp_exclude_page', '') ); ?>" placeholder="Ex: 1,2,3" required />
							        	</td>
							        </tr>
								</table>
							</td>
							<td>
								<table class="form-table">
							
									<tr valign="top">
										<td>
							        		<label class="field-label">Text Color: </label>
							        		<input type="text" class="color-picker" name="hello_bar_wp_text-color" value="<?php echo esc_attr( get_option('hello_bar_wp_text-color', '#333') ); ?>" />
							        	</td>
							        	<td>
							        		<label class="field-label">Background Color:</label>
							        		<input type="text" class="color-picker" data-alpha="true" name="hello_bar_wp_bg_color" value="<?php echo esc_attr( get_option('hello_bar_wp_bg_color', '#f7dc45') ); ?>" />
							        	</td>
							        </tr>
							        <tr valign="top">
							        	<td>
							        		<label class="field-label">Button Text Color: </label>
							        		<input type="text" class="color-picker" name="hello_bar_wp_btn_text_color" value="<?php echo esc_attr( get_option('hello_bar_wp_btn_text_color', '#333') ); ?>" />
							        	</td>
							        	<td>
							        		<label class="field-label">Button Background Color: </label>
							        		<input type="text" class="color-picker" name="hello_bar_wp_btn_color" value="<?php echo esc_attr( get_option('hello_bar_wp_btn_color', '#fff') ); ?>" />
							        	</td>
							        </tr>
							        <tr valign="top">
							        	<td>
							        		<label class="field-label">Close Button Color: </label>
							        		<input type="text" class="color-picker" name="hello_bar_wp_close_btn_color" value="<?php echo esc_attr( get_option('hello_bar_wp_close_btn_color', '#fff') ); ?>" />
							        	</td>
							        	
							        </tr>
								</table>
							</td>
						</tr>
					</table>
					<?php

		            // output save settings button
		            submit_button('Save Settings');
		            ?>
				</form>
			</div>

    <?php
}

function hello_bar_wp_menu_page() {
    add_menu_page(
        __( 'Hello Bar WP', 'hello-bar-wp' ),
        'Hello Bar WP',
        'manage_options',
        'hello-bar-wp',
        'hello_bar_wp_form',
        'dashicons-warning',
        '99.31338'
    );
    add_action( 'admin_init', 'hello_bar_wp_register_settings' );
}
add_action( 'admin_menu', 'hello_bar_wp_menu_page' );

function hello_bar_wp_front_end_appearance(){
	$hello_bar_WP_ids = explode(', ', get_option('hello_bar_wp_exclude_page'));
	if(!is_page($hello_bar_WP_ids)){
		echo '<div class="hello-bar-wp">
				<a class="hello-bar-wp-close" href="" title="Close Bar">×</a>
				<div class="hello-bar-wp-inner-container">
					<div class="hello-bar-wp-content">
						<p>'.esc_attr( get_option('hello_bar_wp_text', 'Edit this text in Dashboard > Hello Bar WP') ).' <a href="'.esc_attr( get_option('hello_bar_wp_btn_url') ).'" target="_self">'.esc_attr( get_option('hello_bar_wp_btn_text', 'Subscribe') ).'</a></p>
					</div>
				</div>
			</div>';
	}
}
add_action('wp_footer','hello_bar_wp_front_end_appearance', 10);

function hello_bar_wp_front_end_appearance_css(){
	
	echo '<style>
			.hello-bar-wp {
				background-color: '.esc_attr( get_option('hello_bar_wp_bg_color', '#f7dc45') ).';
			}
			.hello-bar-wp-close {
				color: '.esc_attr( get_option('hello_bar_wp_close_btn_color', '#fff') ).';
			}
			.hello-bar-wp-content {
			    color: '.esc_attr( get_option('hello_bar_wp_text-color', '#333') ).';
			}
			.hello-bar-wp-content p a {
			    background: '.esc_attr( get_option('hello_bar_wp_btn_color', '#fff') ).';
			    color: '.esc_attr( get_option('hello_bar_wp_btn_text_color', '#333') ).';
			}
		</style>';
}	
add_action('wp_head','hello_bar_wp_front_end_appearance_css', 10);


function hello_bar_wp_frontend_scripts() {
	wp_enqueue_style( 'hello-bar-wp-frontend-css', plugin_dir_url( __FILE__ ) . 'assets/css/frontend.css' );
    wp_enqueue_script( 'hello-bar-wp-frontend-js', plugin_dir_url( __FILE__ ) . 'assets/js/frontend.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'hello_bar_wp_frontend_scripts' );

function hello_bar_wp_backend_scripts( ) {
	wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_style( 'hello-bar-wp-backend-css', plugin_dir_url( __FILE__ ) . 'assets/css/backend.css' );
    wp_enqueue_script( 'wp-color-picker-alpha', plugin_dir_url( __FILE__ ) . 'assets/js/wp-color-picker-alpha.min.js', array( 'wp-color-picker' ), '1.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'hello_bar_wp_backend_scripts' );