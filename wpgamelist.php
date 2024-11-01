<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/*
Plugin Name: WordPress Game List
Plugin URI: https://www.jakerevans.com
Description: For gamers, developers, and publishers alike – use it to sell your games, record and catalog your game library, and more!
Version: 2.1.6
Author: Jake Evans
Text Domain: wpgamelist
Author URI: https://www.jakerevans.com
License: GPL2
*/ 



global $wpdb;
require_once('includes/wpgamelistfunctions.php');
require_once('includes/wpgamelistajaxfunctions.php');

// Parse the wpgamelistconfig file
$config_array = parse_ini_file("wpgamelistconfig.ini");

// Get the default admin message for inclusion into database 
define('GAMELIST_GAMELIST_GAMELIST_ADMIN_MESSAGE', $config_array['initial_admin_message']);

// Root plugin folder directory
define('WPGAMELIST_VERSION_NUM', '2.1.6');

// Root plugin folder directory
//define('GAMELIST_GAMELIST_ROOT_DIR', ABSPATH.'wp-content/plugins/wpgamelist/');
define('GAMELIST_GAMELIST_ROOT_DIR', plugin_dir_path(__FILE__));

// Root WordPress Plugin Directory
define('GAMELIST_GAMELIST_ROOT_WP_PLUGINS_DIR', str_replace('/wpgamelist', '', plugin_dir_path(__FILE__)));

// Root plugin folder URL
define('GAMELIST_GAMELIST_ROOT_URL', plugins_url().'/wpgamelist/');

// Quotes Directory
define('GAMELIST_GAMELIST_QUOTES_DIR', GAMELIST_GAMELIST_ROOT_DIR.'quotes/');

// Json Directory
define('JSON_DIR', GAMELIST_GAMELIST_ROOT_DIR.'assets/json/');

// Root JavaScript Directory
define('GAMELIST_GAMELIST_GAMELIST_GAMELIST_JAVASCRIPT_URL', GAMELIST_GAMELIST_ROOT_URL.'assets/js/');

// Root Classes Directory
define('GAMELIST_GAMELIST_CLASS_DIR', GAMELIST_GAMELIST_ROOT_DIR.'includes/classes/');

// Root Image URL
define('GAMELIST_GAMELIST_ROOT_IMG_URL', GAMELIST_GAMELIST_ROOT_URL.'assets/img/');

// Root Image Icons URL
define('GAMELIST_GAMELIST_ROOT_IMG_ICONS_URL', GAMELIST_GAMELIST_ROOT_URL.'assets/img/icons/');

// Root CSS URL
define('GAMELIST_GAMELIST_ROOT_CSS_URL', GAMELIST_GAMELIST_ROOT_URL.'assets/css/');

// Root UI directory
define('GAMELIST_GAMELIST_ROOT_INCLUDES_UI', GAMELIST_GAMELIST_ROOT_DIR.'includes/ui/');

// Root UI Admin directory
define('GAMELIST_GAMELIST_GAMELIST_GAMELIST_ROOT_INCLUDES_UI_ADMIN_DIR', GAMELIST_GAMELIST_ROOT_DIR.'includes/ui/admin/');

// Define the Uploads base directory
$uploads = wp_upload_dir();
$upload_path = $uploads['basedir'];
define('GAMELIST_GAMELIST_UPLOADS_BASE_DIR', $upload_path.'/');

$upload_url = $uploads['baseurl'];
define('GAMELIST_GAMELIST_UPLOADS_BASE_URL', $upload_url.'/');

// Define the Library Stylepaks base directory
define('GAMELIST_GAMELIST_LIBRARY_STYLEPAKS_UPLOAD_DIR', GAMELIST_GAMELIST_UPLOADS_BASE_DIR.'wpgamelist/stylepaks/library/');

// Define the Library Stylepaks base url
define('GAMELIST_GAMELIST_LIBRARY_STYLEPAKS_UPLOAD_URL', GAMELIST_GAMELIST_UPLOADS_BASE_URL.'wpgamelist/stylepaks/library/');

// Define the Posts Stylepaks base directory
define('GAMELIST_GAMELIST_POST_TEMPLATES_UPLOAD_DIR', GAMELIST_GAMELIST_UPLOADS_BASE_DIR.'wpgamelist/templates/posts/');

// Define the Posts Stylepaks base url
define('GAMELIST_GAMELIST_POST_TEMPLATES_UPLOAD_URL', GAMELIST_GAMELIST_UPLOADS_BASE_URL.'wpgamelist/templates/posts/');

// Define the Pages Stylepaks base directory
define('GAMELIST_GAMELIST_PAGE_TEMPLATES_UPLOAD_DIR', GAMELIST_GAMELIST_UPLOADS_BASE_DIR.'wpgamelist/templates/pages/');

// Define the Pages Stylepaks base url
define('GAMELIST_GAMELIST_PAGE_TEMPLATES_UPLOAD_URL', GAMELIST_GAMELIST_UPLOADS_BASE_URL.'wpgamelist/templates/pages/');

// Define the Library DB backups base directory
define('GAMELIST_GAMELIST_LIBRARY_DB_BACKUPS_UPLOAD_DIR', GAMELIST_GAMELIST_UPLOADS_BASE_DIR.'wpgamelist/backups/library/db/');

// Define the Library DB backups base directory
define('GAMELIST_GAMELIST_LIBRARY_DB_BACKUPS_UPLOAD_URL', GAMELIST_GAMELIST_UPLOADS_BASE_URL.'wpgamelist/backups/library/db/');

// Define the page templates base directory
define('GAMELIST_GAMELIST_PAGE_POST_TEMPLATES_DEFAULT_DIR', GAMELIST_GAMELIST_ROOT_DIR.'includes/templates/');

// Define the edit page offset
define('GAMELIST_GAMELIST_EDIT_PAGE_OFFSET', 100);

// Loading textdomain
load_plugin_textdomain( 'wpgamelist', false, GAMELIST_GAMELIST_ROOT_DIR.'languages' );

// For admin messages
add_action( 'admin_notices', 'wpgamelist_jre_for_reviews_and_wpgamelist_admin_notice__success' );

// Adding Ajax library
add_action( 'wp_head', 'wpgamelist_jre_prem_add_ajax_library' );

// Adding admin page
add_action( 'admin_menu', 'wpgamelist_jre_my_admin_menu' );

// Registers table names
add_action( 'init', 'wpgamelist_jre_register_table_name', 1 );

// Function to run any code that is needed to modify the plugin between different versions
add_action( 'plugins_loaded', 'wpgamelist_upgrade_function');

// Handles the popup that appears when the user deactivates WPGameList
//add_action( 'admin_footer', 'wpgamelist_exit_survey');

// Creates tables upon activation
register_activation_hook( __FILE__, 'wpgamelist_jre_create_tables' );

// Deletes tables upon plugin deletion
//register_uninstall_hook( __FILE__, 'wpgamelist_jre_delete_tables' );

// Adding the general admin css file
add_action('admin_enqueue_scripts', 'wpgamelist_jre_plugin_general_admin_style' );

// Adding the admin template css file
add_action('admin_enqueue_scripts', 'wpgamelist_jre_plugin_admin_template_style' );

// Adding the posts & pages css file
add_action('wp_enqueue_scripts', 'wpgamelist_jre_posts_pages_default_style' );

// Adding the front-end library ui css file
add_action('wp_enqueue_scripts', 'wpgamelist_jre_frontend_library_ui_default_style');

// Adding Colorbox css file
add_action('wp_enqueue_scripts', 'wpgamelist_jre_plugin_colorbox_style' );
add_action('admin_enqueue_scripts', 'wpgamelist_jre_plugin_colorbox_style' );

// Code for adding the frontend sort/search CSS file
add_action('wp_enqueue_scripts', 'wpgamelist_jre_plugin_sort_search_style' );

// Adding the form check js file
add_action('admin_enqueue_scripts', 'wpgamelist_form_checks_js' );

// Adding the html entities decode js file
//add_action('admin_enqueue_scripts', 'wpgamelist_he_js' );

// Adding the jquery masked js file
add_action('admin_enqueue_scripts', 'wpgamelist_jquery_masked_input_js' );

// Code for adding the jquery readmore file for text blocks like description and notes
add_action('wp_enqueue_scripts', 'wpgamelist_jquery_readmore_js' );

// Adding the front-end library shortcode
add_shortcode('wpgamelist_shortcode', 'wpgamelist_jre_plugin_dynamic_shortcode_function');

// Shortcode that allows a game image to be placed on a page
add_shortcode('showgamecover', 'wpgamelist_game_cover_shortcode');

// Adding colorbox JS file on both front-end and dashboard
add_action('admin_enqueue_scripts', 'wpgamelist_jre_plugin_colorbox_script' );
add_action('wp_enqueue_scripts', 'wpgamelist_jre_plugin_colorbox_script' );

// Adding AddThis sharing JS file
add_action('admin_enqueue_scripts', 'wpgamelist_jre_plugin_addthis_script' );
add_action('wp_enqueue_scripts', 'wpgamelist_jre_plugin_addthis_script' );

// For populating the 'Add a Game' fields from a searched title
add_action( 'admin_footer', 'wpgamelist_populate_add_game_fields_action_javascript' );

// For the REST API update for dashboard messages 
add_action( 'rest_api_init', function () {
  register_rest_route( 'wpgamelist/v1', '/notice/(?P<notice>[a-z0-9\-]+)', array(
    'methods' => 'GET',
    'callback' => 'wpgamelist_jre_rest_api_notice',
  ) );
} );

//For dismissing notice
add_action( 'admin_footer', 'wpgamelist_jre_dismiss_prem_notice_forever_action_javascript' ); // Write our JS below here
add_action( 'wp_ajax_wpgamelist_jre_dismiss_prem_notice_forever_action', 'wpgamelist_jre_dismiss_prem_notice_forever_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_jre_dismiss_prem_notice_forever_action', 'wpgamelist_jre_dismiss_prem_notice_forever_action_callback' );

// For adding a game from the admin dashboard
add_action( 'admin_footer', 'wpgamelist_dashboard_add_game_action_javascript' );
add_action( 'wp_ajax_wpgamelist_dashboard_add_game_action', 'wpgamelist_dashboard_add_game_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_dashboard_add_game_action', 'wpgamelist_dashboard_add_game_action_callback' );

// For editing a game from the admin dashboard
add_action( 'admin_footer', 'wpgamelist_edit_game_show_form_action_javascript' );
add_action( 'wp_ajax_wpgamelist_edit_game_show_form_action', 'wpgamelist_edit_game_show_form_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_edit_game_show_form_action', 'wpgamelist_edit_game_show_form_action_callback' );

// For displaying a game in colorbox
add_action( 'admin_footer', 'wpgamelist_show_game_in_colorbox_action_javascript' );
add_action( 'wp_footer', 'wpgamelist_show_game_in_colorbox_action_javascript' );
add_action( 'wp_ajax_wpgamelist_show_game_in_colorbox_action', 'wpgamelist_show_game_in_colorbox_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_show_game_in_colorbox_action', 'wpgamelist_show_game_in_colorbox_action_callback' );

// For creating/deleting custom libraries
add_action( 'admin_footer', 'wpgamelist_new_lib_shortcode_action_javascript' );
add_action( 'wp_ajax_wpgamelist_new_lib_shortcode_action', 'wpgamelist_new_lib_shortcode_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_new_lib_shortcode_action', 'wpgamelist_new_lib_shortcode_action_callback' );

// For saving library display options
add_action( 'admin_footer', 'wpgamelist_dashboard_save_library_display_options_action_javascript' );
add_action( 'wp_ajax_wpgamelist_dashboard_save_library_display_options_action', 'wpgamelist_dashboard_save_library_display_options_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_dashboard_save_library_display_options_action', 'wpgamelist_dashboard_save_library_display_options_action_callback' );

// For saving post display options
add_action( 'admin_footer', 'wpgamelist_dashboard_save_post_display_options_action_javascript' );
add_action( 'wp_ajax_wpgamelist_dashboard_save_post_display_options_action', 'wpgamelist_dashboard_save_post_display_options_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_dashboard_save_post_display_options_action', 'wpgamelist_dashboard_save_post_display_options_action_callback' );

// For saving page display options
add_action( 'admin_footer', 'wpgamelist_dashboard_save_page_display_options_action_javascript' );
add_action( 'wp_ajax_wpgamelist_dashboard_save_page_display_options_action', 'wpgamelist_dashboard_save_page_display_options_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_dashboard_save_page_display_options_action', 'wpgamelist_dashboard_save_page_display_options_action_callback' );

// To update the saved display option checkboxes when drop-down changes
add_action( 'admin_footer', 'wpgamelist_update_display_options_action_javascript' );
add_action( 'wp_ajax_wpgamelist_update_display_options_action', 'wpgamelist_update_display_options_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_update_display_options_action', 'wpgamelist_update_display_options_action_callback' );

// For handling the pagination of the 'Edit & Delete Games' tab
add_action( 'admin_footer', 'wpgamelist_edit_game_pagination_action_javascript' );
add_action( 'wp_ajax_wpgamelist_edit_game_pagination_action', 'wpgamelist_edit_game_pagination_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_edit_game_pagination_action', 'wpgamelist_edit_game_pagination_action_callback' );

// For switching libraries on the 'Edit & Delete Games' tab
add_action( 'admin_footer', 'wpgamelist_edit_game_switch_lib_action_javascript' );
add_action( 'wp_ajax_wpgamelist_edit_game_switch_lib_action', 'wpgamelist_edit_game_switch_lib_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_edit_game_switch_lib_action', 'wpgamelist_edit_game_switch_lib_action_callback' );

// For searching for a title to edit
add_action( 'admin_footer', 'wpgamelist_edit_game_search_action_javascript' );
add_action( 'wp_ajax_wpgamelist_edit_game_search_action', 'wpgamelist_edit_game_search_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_edit_game_search_action', 'wpgamelist_edit_game_search_action_callback' );

// For the saving of edits to existing games
add_action( 'admin_footer', 'wpgamelist_edit_game_actual_action_javascript' );
add_action( 'wp_ajax_wpgamelist_edit_game_actual_action', 'wpgamelist_edit_game_actual_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_edit_game_actual_action', 'wpgamelist_edit_game_actual_action_callback' );

// For deleting a game
add_action( 'admin_footer', 'wpgamelist_delete_game_action_javascript' );
add_action( 'wp_ajax_wpgamelist_delete_game_action', 'wpgamelist_delete_game_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_delete_game_action', 'wpgamelist_delete_game_action_callback' );

// For saving a user's own API keys
add_action( 'admin_footer', 'wpgamelist_user_apis_action_javascript' );
add_action( 'wp_ajax_wpgamelist_user_apis_action', 'wpgamelist_user_apis_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_user_apis_action', 'wpgamelist_user_apis_action_callback' );

// For handling the pagination of the library
add_action( 'wp_footer', 'wpgamelist_library_pagination_action_javascript' );
add_action( 'wp_ajax_wpgamelist_library_pagination_action', 'wpgamelist_library_pagination_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_library_pagination_action', 'wpgamelist_library_pagination_action_callback' );

// For handling the search of the library on the Frontend
add_action( 'wp_footer', 'wpgamelist_library_search_action_javascript' );
add_action( 'wp_ajax_wpgamelist_library_search_action', 'wpgamelist_library_search_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_library_search_action', 'wpgamelist_library_search_action_callback' );

// For sorting the games on the front-end library from the drop-down
add_action( 'wp_footer', 'wpgamelist_library_sort_select_action_javascript' );
add_action( 'wp_ajax_wpgamelist_library_sort_select_action', 'wpgamelist_library_sort_select_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_library_sort_select_action', 'wpgamelist_library_sort_select_action_callback' );

// For uploading a new StylePak after purchase
add_action( 'admin_footer', 'wpgamelist_upload_new_stylepak_action_javascript' );
add_action( 'wp_ajax_wpgamelist_upload_new_stylepak_action', 'wpgamelist_upload_new_stylepak_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_upload_new_stylepak_action', 'wpgamelist_upload_new_stylepak_action_callback' );

// For uploading a new post StylePak after purchase
add_action( 'admin_footer', 'wpgamelist_upload_new_post_template_action_javascript' );
add_action( 'wp_ajax_wpgamelist_upload_new_post_template_action', 'wpgamelist_upload_new_post_template_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_upload_new_post_template_action', 'wpgamelist_upload_new_post_template_action_callback' );

// For uploading a new page StylePak after purchase
add_action( 'admin_footer', 'wpgamelist_upload_new_page_template_action_javascript' );
add_action( 'wp_ajax_wpgamelist_upload_new_page_template_action', 'wpgamelist_upload_new_page_template_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_upload_new_page_template_action', 'wpgamelist_upload_new_page_template_action_callback' );

// For creating a backup of a Library
add_action( 'admin_footer', 'wpgamelist_create_db_library_backup_action_javascript' );
add_action( 'wp_ajax_wpgamelist_create_db_library_backup_action', 'wpgamelist_create_db_library_backup_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_create_db_library_backup_action', 'wpgamelist_create_db_library_backup_action_callback' );

// For restoring a backup of a Library
add_action( 'admin_footer', 'wpgamelist_restore_db_library_backup_action_javascript' );
add_action( 'wp_ajax_wpgamelist_restore_db_library_backup_action', 'wpgamelist_restore_db_library_backup_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_restore_db_library_backup_action', 'wpgamelist_restore_db_library_backup_action_callback' );

// For creating a .csv file of ISBN/ASIN numbers
add_action( 'admin_footer', 'wpgamelist_create_csv_action_javascript' );
add_action( 'wp_ajax_wpgamelist_create_csv_action', 'wpgamelist_create_csv_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_create_csv_action', 'wpgamelist_create_csv_action_callback' );

// For setting the Amazon Localization
add_action( 'admin_footer', 'wpgamelist_amazon_localization_action_javascript' );
add_action( 'wp_ajax_wpgamelist_amazon_localization_action', 'wpgamelist_amazon_localization_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_amazon_localization_action', 'wpgamelist_amazon_localization_action_callback' );

// For bulk-deleting games
add_action( 'admin_footer', 'wpgamelist_delete_game_bulk_action_javascript' );
add_action( 'wp_ajax_wpgamelist_delete_game_bulk_action', 'wpgamelist_delete_game_bulk_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_delete_game_bulk_action', 'wpgamelist_delete_game_bulk_action_callback' );

// For reordering games
add_action( 'admin_footer', 'wpgamelist_reorder_action_javascript' );
add_action( 'wp_ajax_wpgamelist_reorder_action', 'wpgamelist_reorder_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_reorder_action', 'wpgamelist_reorder_action_callback' );

// For recieving user feedback upon deactivation & deletion
add_action( 'admin_footer', 'wpgamelist_exit_results_action_javascript' );
add_action( 'wp_ajax_wpgamelist_exit_results_action', 'wpgamelist_exit_results_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_exit_results_action', 'wpgamelist_exit_results_action_callback' );

// For searching for a game from the admin dashboard
add_action( 'admin_footer', 'wpgamelist_gamesearch_action_javascript' );
add_action( 'wp_ajax_wpgamelist_gamesearch_action', 'wpgamelist_gamesearch_action_callback' );
add_action( 'wp_ajax_nopriv_wpgamelist_gamesearch_action', 'wpgamelist_gamesearch_action_callback' );




// The function that determines which template to load for WPGameList Pages
add_filter( 'the_content', 'wpgamelist_set_page_post_template' );

// Handles various aestetic functions for the front end
add_action( 'wp_footer', 'wpgamelist_various_aestetic_bits_front_end' );

// Handles various aestetic functions for the back end
add_action( 'admin_footer', 'wpgamelist_various_aestetic_bits_back_end' );
?>
