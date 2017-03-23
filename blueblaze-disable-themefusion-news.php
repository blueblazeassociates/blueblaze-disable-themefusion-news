<?php
/**
 * Blue Blaze Disable ThemeFusion News Widget
 *
 * @author  Blue Blaze Associates
 * @license GPL-2.0+
 * @link    https://github.com/blueblazeassociates/blueblaze-disable-themefusion-news
 */

/*
 * Plugin Name:       Blue Blaze Disable ThemeFusion News Widget
 * Plugin URI:        https://github.com/blueblazeassociates/blueblaze-disable-themefusion-news
 * Description:       Disables the ThemeFusion News widget.
 * Version:           1.0.1
 * Author:            Blue Blaze Associates
 * Author URI:        http://www.blueblazeassociates.com
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
 * GitHub Plugin URI: https://github.com/blueblazeassociates/blueblaze-disable-themefusion-news
 * GitHub Branch:     master
 * Requires WP:       4.7
 * Requires PHP:      7.0
 */

/**
 * Removes the 'themefusion_news'  meta box from the WordPress dashboard.
 *
 * @since 1.0.0
 */
function blueblaze__disable_themefusion_news() {
  /*
   * Using remove_meta_box() will not work for ThemeFusion News.
   * Avada is pulling some direct manipulation of the dashboard state.
   *
   * Let's fight fire with fire...
   */

  // Get a hold of WordPress internal state for meta boxes.
  global $wp_meta_boxes;

  // Get the dashboard widgets array.
  $dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

  // Remove themefusion_news from the array.
  unset( $dashboard['themefusion_news'] );

  // Save the array back into the original metaboxes.
  $wp_meta_boxes['dashboard']['normal']['core'] = $dashboard;
}
add_action( 'wp_dashboard_setup', 'blueblaze__disable_themefusion_news', 11 ); // Needs to run later than default 10 in order to beat Avada.
