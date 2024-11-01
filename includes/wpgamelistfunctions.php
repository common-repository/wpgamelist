<?php

/*
 * Adds the WordPress Ajax Library.
*/

// Code for adding the form checks js file
function wpgamelist_form_checks_js() {
    wp_register_script( 'wpgamelist_form_checks_js', GAMELIST_GAMELIST_GAMELIST_GAMELIST_JAVASCRIPT_URL.'formchecks.js', array('jquery'), false, true);
    wp_enqueue_script('wpgamelist_form_checks_js', GAMELIST_GAMELIST_GAMELIST_GAMELIST_JAVASCRIPT_URL.'formchecks.js', array('jquery'), false, true);
}

/*
// Code for adding the html entities decode js file
function wpgamelist_he_js() {
    wp_register_script( 'wpgamelist_he_js', GAMELIST_GAMELIST_GAMELIST_GAMELIST_JAVASCRIPT_URL.'he/he.js', array('jquery') );
    wp_enqueue_script('wpgamelist_he_js');
}
*/

// Code for adding the jquery masked input file
function wpgamelist_jquery_masked_input_js() {
  if(!wp_script_is('wpbooklist_jquery_masked_input_js') && !wp_script_is('wpgamelist_jquery_masked_input_js')){
    wp_register_script( 'wpgamelist_jquery_masked_input_js', GAMELIST_GAMELIST_GAMELIST_GAMELIST_JAVASCRIPT_URL.'jquery-masked-input/jquery-masked-input.js', array('jquery'), false, true);
    wp_enqueue_script('wpgamelist_jquery_masked_input_js', GAMELIST_GAMELIST_GAMELIST_GAMELIST_JAVASCRIPT_URL.'jquery-masked-input/jquery-masked-input.js', array('jquery'), false, true);
  }
}

// Code for adding the jquery readmore file for text blocks like description and notes
function wpgamelist_jquery_readmore_js() {
  if(!wp_script_is('wpbooklist_jquery_readmore_js') && !wp_script_is('wpgamelist_jquery_readmore_js')){
    wp_register_script( 'wpgamelist_jquery_readmore_js', GAMELIST_GAMELIST_GAMELIST_GAMELIST_JAVASCRIPT_URL.'jquery-readmore/readmore.min.js', array('jquery'), false, true);
    wp_enqueue_script('wpgamelist_jquery_readmore_js', GAMELIST_GAMELIST_GAMELIST_GAMELIST_JAVASCRIPT_URL.'jquery-readmore/readmore.min.js', array('jquery'), false, true);
  }
}

// Code for adding the colorbox js file
function wpgamelist_jre_plugin_colorbox_script($hook) {
 
  // If on an admin page, loading this up on just the WPGameList admin pages that need it. Else, load it on the frontend that has a WPGameList Shortcode
  if(is_admin()){
    if(stripos($hook, 'WPGameList-Options') !== false){
      // If we don't already have Colorbox loaded from WPBookList...
      if(!wp_script_is('colorboxjsforwpgamelist') && !wp_script_is('colorboxjsforwpbooklist')){
        wp_register_script( 'colorboxjsforwpgamelist', GAMELIST_GAMELIST_GAMELIST_GAMELIST_JAVASCRIPT_URL.'jquery-colorbox/jquery.colorbox-min.js', array('jquery'), false, true);
        wp_enqueue_script('colorboxjsforwpgamelist', GAMELIST_GAMELIST_GAMELIST_GAMELIST_JAVASCRIPT_URL.'jquery-colorbox/jquery.colorbox-min.js', array('jquery'), false, true);
      }
    }
  } else {
    global $wpdb;
    $id = get_the_ID();
    $post = get_post($id);
    $content = '';
    if($post){
      $content = $post->post_content;
    }

    // If we find any of these in $content, load the colorbox js 
    $shortcode_array = array(
      'showgamecover',
      'wpgamelist_shortcode',
      'wpgamelist_gamefinder',
      'wpgamelist_carousel',
      'wpgamelist_categories',
      'wpgamelist'
    );

    foreach ($shortcode_array as $key => $value) {
      if(stripos($content, $value) !== false){
        // If we don't already have Colorbox loaded from WPBookList...
        if(!wp_script_is('colorboxjsforwpgamelist') && !wp_script_is('colorboxjsforwpbooklist')){
          wp_register_script( 'colorboxjsforwpgamelist', GAMELIST_GAMELIST_GAMELIST_GAMELIST_JAVASCRIPT_URL.'jquery-colorbox/jquery.colorbox-min.js', array('jquery'), false, true);
          wp_enqueue_script('colorboxjsforwpgamelist', GAMELIST_GAMELIST_GAMELIST_GAMELIST_JAVASCRIPT_URL.'jquery-colorbox/jquery.colorbox-min.js', array('jquery'), false, true);
        } 
      }
    }

    // If we're on the homepage or the blog page, just go ahead and load
    if(!wp_script_is('colorboxjsforwpgamelist') && !wp_script_is('colorboxjsforwpbooklist')){
      if (is_front_page() || is_home() ) {
        wp_register_script( 'colorboxjsforwpgamelist', GAMELIST_GAMELIST_GAMELIST_GAMELIST_JAVASCRIPT_URL.'jquery-colorbox/jquery.colorbox-min.js', array('jquery'), false, true);
        wp_enqueue_script('colorboxjsforwpgamelist', GAMELIST_GAMELIST_GAMELIST_GAMELIST_JAVASCRIPT_URL.'jquery-colorbox/jquery.colorbox-min.js', array('jquery'), false, true);
      }
    }
  }
}

// Code for adding the addthis js file
function wpgamelist_jre_plugin_addthis_script($hook) {
    

     // If on an admin page, loading this up on just the WPGameList admin pages that need it. Else, load it on all of the frontend
  if(is_admin()){
    if(stripos($hook, 'WPGameList-Options') !== false){
      if(!wp_script_is('addthisjsforwpgamelist') && !wp_script_is('addthisjsforwpbooklist')){
        wp_register_script( 'addthisjsforwpgamelist', GAMELIST_GAMELIST_GAMELIST_GAMELIST_JAVASCRIPT_URL.'jquery-addthis/addthis.js', array('jquery'), false, true);
        wp_enqueue_script('addthisjsforwpgamelist', GAMELIST_GAMELIST_GAMELIST_GAMELIST_JAVASCRIPT_URL.'jquery-addthis/addthis.js', array('jquery'), false, true);
      }
    }
  } else {
    global $wpdb;
    $id = get_the_ID();
    $post = get_post($id);
    $content = '';
    if($post){
      $content = $post->post_content;
    }

    // If we find any of these in $content, load the addthis js 
    $shortcode_array = array(
      'showgamecover',
      'wpgamelist_shortcode',
      'wpgamelist_gamefinder',
      'wpgamelist_carousel',
      'wpgamelist_categories',
      'wpgamelist'
    );

    foreach ($shortcode_array as $key => $value) {
      if(stripos($content, $value) !== false){
        if(!wp_script_is('addthisjsforwpgamelist') && !wp_script_is('addthisjsforwpbooklist')){
          wp_register_script( 'addthisjsforwpgamelist', GAMELIST_GAMELIST_GAMELIST_GAMELIST_JAVASCRIPT_URL.'jquery-addthis/addthis.js', array('jquery'), false, true);
          wp_enqueue_script('addthisjsforwpgamelist', GAMELIST_GAMELIST_GAMELIST_GAMELIST_JAVASCRIPT_URL.'jquery-addthis/addthis.js', array('jquery'), false, true);
        }
      }
    }

    // If we're on the homepage or the blog page, just go ahead and load
    if(!wp_script_is('addthisjsforwpgamelist')){
      if (is_front_page() || is_home() ) {
        if(!wp_script_is('addthisjsforwpgamelist') && !wp_script_is('addthisjsforwpbooklist')){
          wp_register_script( 'addthisjsforwpgamelist', GAMELIST_GAMELIST_GAMELIST_GAMELIST_JAVASCRIPT_URL.'jquery-addthis/addthis.js', array('jquery'), false, true);
          wp_enqueue_script('addthisjsforwpgamelist', GAMELIST_GAMELIST_GAMELIST_GAMELIST_JAVASCRIPT_URL.'jquery-addthis/addthis.js', array('jquery'), false, true);
        }
      }
    }

    $table_name = $wpdb->prefix . 'wpgamelist_jre_saved_page_post_log';
    $row = $wpdb->get_results("SELECT * FROM $table_name");
    foreach ($row as $key => $value) {
      if($id == $value->post_id){
        if(!wp_script_is('addthisjsforwpgamelist') && !wp_script_is('addthisjsforwpbooklist')){
          wp_register_script( 'addthisjsforwpgamelist', GAMELIST_GAMELIST_GAMELIST_GAMELIST_JAVASCRIPT_URL.'jquery-addthis/addthis.js', array('jquery'), false, true);
          wp_enqueue_script('addthisjsforwpgamelist', GAMELIST_GAMELIST_GAMELIST_GAMELIST_JAVASCRIPT_URL.'jquery-addthis/addthis.js', array('jquery'), false, true);
        }
      }
    }

  }
}

// Code for adding the colorbox CSS file
function wpgamelist_jre_plugin_colorbox_style($hook) {
    
  // If on an admin page, loading this up on just the WPGameList admin pages that need it. Else, load it on all of the frontend
  if(is_admin()){
    if(stripos($hook, 'WPGameList-Options') !== false){
      wp_register_style( 'colorboxcssforwpgamelist', ROOT_CSS_URL.'colorbox.css' );
      wp_enqueue_style('colorboxcssforwpgamelist');
    }
  } else {
    global $wpdb;
    $id = get_the_ID();
    $post = get_post($id);
    $content = '';
    if($post){
      $content = $post->post_content;
    }

    // If we find any of these in $content, load the colorbox.css 
    $shortcode_array = array(
      'showgamecover',
      'wpgamelist_shortcode',
      'wpgamelist_gamefinder',
      'wpgamelist_carousel',
      'wpgamelist_categories',
      'wpgamelist'
    );

    foreach ($shortcode_array as $key => $value) {
      if(stripos($content, $value) !== false){
        wp_register_style( 'colorboxcssforwpgamelist', GAMELIST_GAMELIST_ROOT_CSS_URL.'colorbox.css' );
        wp_enqueue_style('colorboxcssforwpgamelist');
      }
    }

    // If we're on the homepage or the blog page, just go ahead and load
    if(!wp_script_is('colorboxcssforwpgamelist')){
      if (is_front_page() || is_home() ) {
        wp_register_style( 'colorboxcssforwpgamelist', GAMELIST_GAMELIST_ROOT_CSS_URL.'colorbox.css' );
        wp_enqueue_style('colorboxcssforwpgamelist');
      }
    }
  }
}

// Code for adding the frontend sort/search CSS file
function wpgamelist_jre_plugin_sort_search_style() {
    wp_register_style( 'sortsearchcssforwpgamelist', GAMELIST_GAMELIST_ROOT_CSS_URL.'frontend-sort-search-ui.css' );
    wp_enqueue_style('sortsearchcssforwpgamelist');
}

function wpgamelist_jre_rest_api_notice( $data ){
    global $wpdb;
    $table_name = $wpdb->prefix . 'wpgamelist_jre_user_options';
    $options_row = $wpdb->get_results("SELECT * FROM $table_name");
    $newmessage = $data['notice'];
    $dismiss = $options_row[0]->admindismiss;
    if($dismiss == 0){
      $data = array(
          'admindismiss' => 1,
          'adminmessage' => $newmessage
      );
      $format = array( '%d', '%s'); 
      $where = array( 'ID' => 1 );
      $where_format = array( '%d' );
      $wpdb->update( $table_name, $data, $where, $format, $where_format );
    } else {
      $data = array(
          'adminmessage' => $newmessage
      );
      $format = array('%s'); 
      $where = array( 'ID' => 1 );
      $where_format = array( '%d' );
      $wpdb->update( $table_name, $data, $where, $format, $where_format );
    }
}

function wpgamelist_jre_for_reviews_and_wpgamelist_admin_notice__success() {
  global $wpdb;
  $table_name = $wpdb->prefix . 'wpgamelist_jre_user_options';
  $options_row = $wpdb->get_results("SELECT * FROM $table_name");
  $dismiss = $options_row[0]->admindismiss;

  if($dismiss == 1){
    $message = $options_row[0]->adminmessage;
    $url = home_url();
    $newmessage = str_replace('alaainqphpaholeechoaholehomeanusurlalparpascaholeainqara',$url,$message);
    $newmessage = str_replace('asq',"'",$newmessage);
    $newmessage = str_replace("hshmrk","#",$newmessage);
    $newmessage = str_replace("ampersand","&",$newmessage);
    $newmessage = str_replace('adq','"',$newmessage);
    $newmessage = str_replace('aco',':',$newmessage);
    $newmessage = str_replace('asc',';',$newmessage);
    $newmessage = str_replace('aslash','/',$newmessage);
    $newmessage = str_replace('ahole',' ',$newmessage);
    $newmessage = str_replace('ara','>',$newmessage);
    $newmessage = str_replace('ala','<',$newmessage);
    $newmessage = str_replace('anem','!',$newmessage);
    $newmessage = str_replace('dash','-',$newmessage);
    $newmessage = str_replace('akomma',',',$newmessage);
    $newmessage = str_replace('anequal','=',$newmessage);
    $newmessage = str_replace('dot','.',$newmessage);
    $newmessage = str_replace('anus','_',$newmessage);
    $newmessage = str_replace('adollar','$',$newmessage);
    $newmessage = str_replace('ainq','?',$newmessage);
    $newmessage = str_replace('alp','(',$newmessage);
    $newmessage = str_replace('arp',')',$newmessage);
    ?>
    <div class="notice notice-success is-dismissible">
        <p><?php echo $newmessage; ?></p>
    </div>
    <?php
  }
}


// Adding the front-end library ui css file
function wpgamelist_jre_frontend_library_ui_default_style() {
  global $wpdb;
  $id = get_the_ID();
  $post = get_post($id);
  $content = '';
  if($post){
    $content = $post->post_content;
  }
  $stylepak = '';

  $table_name2 = $wpdb->prefix . 'wpgamelist_jre_list_dynamic_db_names';
  $db_row = $wpdb->get_results("SELECT * FROM $table_name2");
   foreach($db_row as $table){
    $shortcode = 'wpgamelist_shortcode table="'.$table->user_table_name.'"';

    if(stripos($content, $shortcode) !== false){
      $stylepak = $table->stylepak;
    }
  }

  if($stylepak == ''){
    if(stripos($content, '[wpgamelist_shortcode') !== false){
        $table_name2 = $wpdb->prefix . 'wpgamelist_jre_user_options';
        $row = $wpdb->get_results("SELECT * FROM $table_name2");
        $stylepak = $row[0]->stylepak;
    }
  }

  if($stylepak == '' || $stylepak == null || $stylepak == 'Default'){
    $stylepak = 'default';
  }

  if($stylepak == 'default' || $stylepak == 'Default StylePak'){
    wp_register_style( 'gamelistfrontendlibraryui', GAMELIST_GAMELIST_ROOT_CSS_URL.'frontend-library-ui.css' );
    wp_enqueue_style('gamelistfrontendlibraryui');
  }

  $library_stylepaks_upload_dir = GAMELIST_GAMELIST_LIBRARY_STYLEPAKS_UPLOAD_URL;

  // Modify the 'GAMELIST_GAMELIST_LIBRARY_STYLEPAKS_UPLOAD_URL' to make sure we're using the right protocol, as it seems that (wp_upload_dir() doesn't return https - introduced in 5.5.2
  $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://"; 
  if($protocol == 'https://' || $protocol == 'https'){
    if(strpos(GAMELIST_GAMELIST_LIBRARY_STYLEPAKS_UPLOAD_URL, 'http://') !== false){
     $library_stylepaks_upload_dir = str_replace('http://', 'https://', GAMELIST_GAMELIST_LIBRARY_STYLEPAKS_UPLOAD_URL);
    }
  }

  if($stylepak == 'StylePak1'){
    wp_register_style( 'StylePak1', $library_stylepaks_upload_dir.'StylePak1.css' );
    wp_enqueue_style('StylePak1');
  }

  if($stylepak == 'StylePak2'){
    wp_register_style( 'StylePak2', $library_stylepaks_upload_dir.'StylePak2.css' );
    wp_enqueue_style('StylePak2');
  }

  if($stylepak == 'StylePak3'){
    wp_register_style( 'StylePak3', $library_stylepaks_upload_dir.'StylePak3.css' );
    wp_enqueue_style('StylePak3');
  }

  if($stylepak == 'StylePak4'){
    wp_register_style( 'StylePak4', $library_stylepaks_upload_dir.'StylePak4.css' );
    wp_enqueue_style('StylePak4');
  }

  if($stylepak == 'StylePak5'){
    wp_register_style( 'StylePak5', $library_stylepaks_upload_dir.'StylePak5.css' );
    wp_enqueue_style('StylePak5');
  }

  if($stylepak == 'StylePak6'){
    wp_register_style( 'StylePak6', $library_stylepaks_upload_dir.'StylePak6.css' );
    wp_enqueue_style('StylePak6');
  }

  if($stylepak == 'StylePak7'){
    wp_register_style( 'StylePak7', $library_stylepaks_upload_dir.'StylePak7.css' );
    wp_enqueue_style('StylePak7');
  }

  if($stylepak == 'StylePak8'){
    wp_register_style( 'StylePak8', $library_stylepaks_upload_dir.'StylePak8.css' );
    wp_enqueue_style('StylePak8');
  }

  if($stylepak == 'StylePak9'){
    wp_register_style( 'StylePak9', $library_stylepaks_upload_dir.'StylePak9.css' );
    wp_enqueue_style('StylePak9');
  }

  if($stylepak == 'StylePak10'){
    wp_register_style( 'StylePak10', $library_stylepaks_upload_dir.'StylePak10.css' );
    wp_enqueue_style('StylePak10');
  }

  if($stylepak == 'StylePak11'){
    wp_register_style( 'StylePak11', $library_stylepaks_upload_dir.'StylePak11.css' );
    wp_enqueue_style('StylePak11');
  }

  if($stylepak == 'StylePak12'){
    wp_register_style( 'StylePak12', $library_stylepaks_upload_dir.'StylePak12.css' );
    wp_enqueue_style('StylePak12');
  }

  if($stylepak == 'StylePak13'){
    wp_register_style( 'StylePak13', $library_stylepaks_upload_dir.'StylePak13.css' );
    wp_enqueue_style('StylePak13');
  }

  if($stylepak == 'StylePak14'){
    wp_register_style( 'StylePak14', $library_stylepaks_upload_dir.'StylePak14.css' );
    wp_enqueue_style('StylePak14');
  }


}


// Code for adding the default posts & pages CSS file
function wpgamelist_jre_posts_pages_default_style() {
  
    global $wpdb;
    $id = get_the_ID();
    $stylepak = '';

    $table_name = $wpdb->prefix . 'wpgamelist_jre_saved_page_post_log';

    $row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE post_id = %d", $id));

    if($row != null){
      if($row->type == 'post'){
        $table_name_post = $wpdb->prefix . 'wpgamelist_jre_post_options';
      } else {
        $table_name_post = $wpdb->prefix . 'wpgamelist_jre_page_options';
      }

      $row = $wpdb->get_row("SELECT * FROM $table_name_post");
      $stylepak = $row->stylepak;
    }

    if($stylepak == '' || $stylepak == null || $stylepak == 'Default StylePak'){
      $stylepak = 'default';
    }

    if($stylepak == 'Default' || $stylepak == 'default' || $stylepak == 'Default StylePak'){
      wp_register_style( 'postspagesdefaultcssforwpgamelist', GAMELIST_GAMELIST_ROOT_CSS_URL.'posts-pages-default.css' );
      wp_enqueue_style('postspagesdefaultcssforwpgamelist');
    }

    if($stylepak == 'Post-StylePak1'){
      wp_register_style( 'Post-StylePak1', POST_STYLEPAKS_UPLOAD_URL.'Post-StylePak1.css' );
      wp_enqueue_style('Post-StylePak1');
    }

    if($stylepak == 'Post-StylePak2'){
      wp_register_style( 'Post-StylePak2', POST_STYLEPAKS_UPLOAD_URL.'Post-StylePak2.css' );
      wp_enqueue_style('Post-StylePak2');
    }

    if($stylepak == 'Post-StylePak3'){
      wp_register_style( 'Post-StylePak3', POST_STYLEPAKS_UPLOAD_URL.'Post-StylePak3.css' );
      wp_enqueue_style('Post-StylePak3');
    }

    if($stylepak == 'Post-StylePak4'){
      wp_register_style( 'Post-StylePak4', POST_STYLEPAKS_UPLOAD_URL.'Post-StylePak4.css' );
      wp_enqueue_style('Post-StylePak4');
    }

    if($stylepak == 'Post-StylePak5'){
      wp_register_style( 'Post-StylePak5', POST_STYLEPAKS_UPLOAD_URL.'Post-StylePak5.css' );
      wp_enqueue_style('Post-StylePak5');
    }

    
}

// Code for adding the general admin CSS file
function wpgamelist_jre_plugin_general_admin_style() {
  if(current_user_can( 'administrator' )){
      wp_register_style( 'wpgamelist_ui_style', GAMELIST_GAMELIST_ROOT_CSS_URL.'admin.css');
      wp_enqueue_style('wpgamelist_ui_style');
  }
}

// Code for adding the general admin CSS file
function wpgamelist_jre_plugin_game_in_colorbox_style() {
      wp_register_style( 'wpgamelist_game_in_colorbox_style', GAMELIST_GAMELIST_ROOT_CSS_URL.'game-in-colorbox.css');
      wp_enqueue_style('wpgamelist_game_in_colorbox_style');
} 

// Code for adding the admin template CSS file
function wpgamelist_jre_plugin_admin_template_style() {
  if(current_user_can( 'administrator' )){
      wp_register_style( 'wpgamelist_admin_template_style', GAMELIST_GAMELIST_ROOT_CSS_URL.'admin-template.css');
      wp_enqueue_style('wpgamelist_admin_template_style');
    }
}


function wpgamelist_jre_prem_add_ajax_library() {
 
    $html = '<script type="text/javascript">';

    // checking $protocol in HTTP or HTTPS
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
        // this is HTTPS
        $protocol  = "https";
    } else {
        // this is HTTP
        $protocol  = "http";
    }
    $tempAjaxPath = admin_url( 'admin-ajax.php' );
    $goodAjaxUrl = $protocol.strchr($tempAjaxPath,':');

    $html .= 'var ajaxurl = "' . $goodAjaxUrl . '"';
    $html .= '</script>';
    echo $html;
    
} // End add_ajax_library

// Function to add table names to the global $wpdb
function wpgamelist_jre_register_table_name() {
    global $wpdb;
    $wpdb->wpgamelist_jre_saved_game_log = "{$wpdb->prefix}wpgamelist_jre_saved_game_log";
    $wpdb->wpgamelist_jre_saved_page_post_log = "{$wpdb->prefix}wpgamelist_jre_saved_page_post_log";
    $wpdb->wpgamelist_jre_saved_games_for_featured = "{$wpdb->prefix}wpgamelist_jre_saved_games_for_featured";
    $wpdb->wpgamelist_jre_user_options = "{$wpdb->prefix}wpgamelist_jre_user_options";
    $wpdb->wpgamelist_jre_page_options = "{$wpdb->prefix}wpgamelist_jre_page_options";
    $wpdb->wpgamelist_jre_post_options = "{$wpdb->prefix}wpgamelist_jre_post_options";
    $wpdb->wpgamelist_jre_list_dynamic_db_names = "{$wpdb->prefix}wpgamelist_jre_list_dynamic_db_names";
    $wpdb->wpgamelist_jre_game_quotes = "{$wpdb->prefix}wpgamelist_jre_game_quotes";
    $wpdb->wpgamelist_jre_purchase_stylepaks = "{$wpdb->prefix}wpgamelist_jre_purchase_stylepaks";
    $wpdb->wpgamelist_jre_color_options = "{$wpdb->prefix}wpgamelist_jre_color_options";
    $wpdb->wpgamelist_jre_active_extensions = "{$wpdb->prefix}wpgamelist_jre_active_extensions";
    $wpdb->wpgamelist_jre_list_platform_names = "{$wpdb->prefix}wpgamelist_jre_list_platform_names";
    $wpdb->wpgamelist_jre_list_company_names = "{$wpdb->prefix}wpgamelist_jre_list_company_names";
    $wpdb->wpgamelist_jre_list_genre_names = "{$wpdb->prefix}wpgamelist_jre_list_genre_names";
}

// Runs once upon plugin activation and creates tables
function wpgamelist_jre_create_tables() {
  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  global $wpdb;
  global $charset_collate; 

$url = home_url(); 
  $plugin  ='WPGameList';
  $date = time();

  $postdata = http_build_query(
      array(
          'url' => $url,
          'plugin' => $plugin,
          'date' => $date
      )
  );

  $opts = array('http' =>
      array(
          'method'  => 'POST',
          'header'  => 'Content-type: application/x-www-form-urlencoded',
          'content' => $postdata
      )
  );

  $context = stream_context_create($opts);
  $result = '';
    $responsecode = '';
    if(function_exists('file_get_contents')){
        error_log('log1');
        file_get_contents('https://jakerevans.com/pmfileforrecord.php', false, $context);
    } else {
      if (function_exists('curl_init')){ 
        error_log('log4');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); 
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); //timeout in seconds
        $url = 'https://jakerevans.com/pmfileforrecord.php';
        curl_setopt($ch, CURLOPT_URL, $url);

        $data = array('url'=>$url, 'plugin'=>$plugin, 'date' => $date);

        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        $result = curl_exec($ch);
        $responsecode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
      }
    }

    error_log('result'.$result);




  // Call this manually as we may have missed the init hook
  wpgamelist_jre_register_table_name();
  //Creating the table

  $default_table = $wpdb->prefix."wpgamelist_jre_saved_game_log";

  $sql_create_table1 = "CREATE TABLE {$wpdb->wpgamelist_jre_saved_game_log} 
  (
        ID bigint(190) auto_increment,
        title varchar(255), 
        image varchar(255), 
        releasedate varchar(255), 
        platforms varchar(255),
        genres varchar(255), 
        developer varchar(255), 
        publisher varchar(255), 
        rating FLOAT, 
        criticrating FLOAT, 
        perspective varchar(255), 
        gamemodes varchar(255), 
        themes varchar(255), 
        series varchar(255),
        franchise varchar(255), 
        igdblink varchar(255), 
        esrb varchar(255), 
        pegi varchar(255), 
        owned varchar(255),
        gamecondition varchar(255),
        finished varchar(255), 
        finishdate varchar(255), 
        altnames MEDIUMTEXT,
        screenshots MEDIUMTEXT, 
        websites MEDIUMTEXT, 
        videos MEDIUMTEXT,
        summary MEDIUMTEXT,
        notes MEDIUMTEXT,
        myrating bigint(255),
        price varchar(255), 
        purchaselink varchar(255),
        page varchar(255), 
        post varchar(255), 
        woocommerce varchar(255), 
        game_uid varchar(255), 
        gamestopurl varchar(255),
        bestbuyurl varchar(255),
        steamurl varchar(255),
        ebayurl varchar(255),
        amazonbuylink varchar(255),
        amazonreviewiframe varchar(255),
        similaramazonproducts MEDIUMTEXT,
        PRIMARY KEY  (ID),
          KEY title (title)
  ) $charset_collate; ";
  dbDelta( $sql_create_table1 );

  $sql_create_table2 = "CREATE TABLE {$wpdb->wpgamelist_jre_user_options} 
  (
        ID bigint(190) auto_increment,
        username varchar(190),
        version varchar(255) NOT NULL DEFAULT '3.3',
        amazonaff varchar(255) NOT NULL DEFAULT 'wpbooklistid-20',
        amazonauth varchar(255),
        enablepurchase bigint(255),
        amazonapipublic varchar(255),
        hidetitlelibrary bigint(255),
        hidetitlegame bigint(255),
        hidesearch bigint(255),
        hidesort bigint(255),
        hidestats bigint(255),
        hidequote bigint(255),
        hidestarsgame bigint(255),
        hidestarslibrary bigint(255),
        hidefacebookshare bigint(255),
        hidefacebookmessenger bigint(255),
        hidegoogleplus bigint(255),
        hidepinterest bigint(255),
        hideemail bigint(255),
        hidetwitter bigint(255),
        hidegamepost bigint(255),
        hidegamepage bigint(255),
        hidefinished bigint(255),
        hidecoverimage bigint(255),
        hidepublisher bigint(255),
        hidedeveloper bigint(255),
        hidegenre bigint(255),
        hidereleasedate bigint(255),
        hideseries bigint(255),
        hidecriticrating bigint(255),
        hideigdblink bigint(255),
        hideplatforms bigint(255),
        hidealtnames bigint(255),
        hideamazonreviews bigint(255),
        hidenotes bigint(255),
        hidedescription bigint(255),
        hidesteampurchase bigint(255),
        hideebaypurchase bigint(255),
        hidegamestoppurchase bigint(255),
        hidebestbuypurchase bigint(255),
        hideamazonpurchase bigint(255),
        hidesimilartitles bigint(255),
        hidefrontendbuyimg bigint(255),
        hidefrontendbuyprice bigint(255),
        hidecolorboxbuyimg bigint(255),
        hidecolorboxbuyprice bigint(255),
        sortoption varchar(255),
        gamesonpage bigint(255) NOT NULL DEFAULT 12,
        amazoncountryinfo varchar(255) NOT NULL DEFAULT 'US',
        stylepak varchar(255) NOT NULL DEFAULT 'Default',
        admindismiss bigint(255) NOT NULL DEFAULT 1,
        activeposttemplate varchar(255),
        activepagetemplate varchar(255),
        adminmessage varchar(10000) NOT NULL DEFAULT '".GAMELIST_GAMELIST_GAMELIST_ADMIN_MESSAGE."',
        PRIMARY KEY  (ID),
          KEY username (username)
  ) $charset_collate; ";

  // If table doesn't exist, create table and add initial data to it
  $test_name = $wpdb->prefix.'wpgamelist_jre_user_options';
  if($wpdb->get_var("SHOW TABLES LIKE '$test_name'") != $test_name) {
    dbDelta( $sql_create_table2 );
    $table_name = $wpdb->prefix . 'wpgamelist_jre_user_options';
    $wpdb->insert( $table_name, array('ID' => 1));
  } 

  $sql_create_table3 = "CREATE TABLE {$wpdb->wpgamelist_jre_page_options} 
  (
        ID bigint(190) auto_increment,
        username varchar(190),
        amazonaff varchar(255) NOT NULL DEFAULT 'wpbooklistid-20',
        amazonauth varchar(255),
        barnesaff varchar(255),
        itunesaff varchar(255) NOT NULL DEFAULT '1010lnPx',
        enablepurchase bigint(255),
        hidetitlegame bigint(255),
        hidestarsgame bigint(255),
        hidequote bigint(255),
        hidefacebookshare bigint(255),
        hidefacebookmessenger bigint(255),
        hidegoogleplus bigint(255),
        hidepinterest bigint(255),
        hideemail bigint(255),
        hidetwitter bigint(255),
        hidegamepost bigint(255),
        hidegamepage bigint(255),
        hidefinished bigint(255),
        hidecoverimage bigint(255),
        hidepublisher bigint(255),
        hidedeveloper bigint(255),
        hidegenre bigint(255),
        hidereleasedate bigint(255),
        hideseries bigint(255),
        hidecriticrating bigint(255),
        hideigdblink bigint(255),
        hideplatforms bigint(255),
        hidealtnames bigint(255),
        hideamazonreviews bigint(255),
        hidenotes bigint(255),
        hidedescription bigint(255),
        hidesteampurchase bigint(255),
        hideebaypurchase bigint(255),
        hidegamestoppurchase bigint(255),
        hidebestbuypurchase bigint(255),
        hideamazonpurchase bigint(255),
        hidesimilartitles bigint(255),
        hidefrontendbuyimg bigint(255),
        hidefrontendbuyprice bigint(255),
        hidecolorboxbuyimg bigint(255),
        hidecolorboxbuyprice bigint(255),
        amazoncountryinfo varchar(255) NOT NULL DEFAULT 'US',
        stylepak varchar(255) NOT NULL DEFAULT 'Default',
        PRIMARY KEY  (ID),
          KEY username (username)
  ) $charset_collate; ";

  // If table doesn't exist, create table and add initial data to it
  $test_name = $wpdb->prefix.'wpgamelist_jre_page_options';
  if($wpdb->get_var("SHOW TABLES LIKE '$test_name'") != $test_name) {
    dbDelta( $sql_create_table3 );
    $table_name = $wpdb->prefix . 'wpgamelist_jre_page_options';
    $wpdb->insert( $table_name, array('ID' => 1)); 
  }

  $sql_create_table4 = "CREATE TABLE {$wpdb->wpgamelist_jre_post_options} 
  (
        ID bigint(190) auto_increment,
        username varchar(190),
        amazonaff varchar(255) NOT NULL DEFAULT 'wpbooklistid-20',
        amazonauth varchar(255),
        barnesaff varchar(255),
        itunesaff varchar(255) NOT NULL DEFAULT '1010lnPx',
        enablepurchase bigint(255),
        hidetitlegame bigint(255),
        hidestarsgame bigint(255),
        hidequote bigint(255),
        hidefacebookshare bigint(255),
        hidefacebookmessenger bigint(255),
        hidegoogleplus bigint(255),
        hidepinterest bigint(255),
        hideemail bigint(255),
        hidetwitter bigint(255),
        hidegamepost bigint(255),
        hidegamepage bigint(255),
        hidefinished bigint(255),
        hidecoverimage bigint(255),
        hidepublisher bigint(255),
        hidedeveloper bigint(255),
        hidegenre bigint(255),
        hidereleasedate bigint(255),
        hideseries bigint(255),
        hidecriticrating bigint(255),
        hideigdblink bigint(255),
        hideplatforms bigint(255),
        hidealtnames bigint(255),
        hideamazonreviews bigint(255),
        hidenotes bigint(255),
        hidedescription bigint(255),
        hidesteampurchase bigint(255),
        hideebaypurchase bigint(255),
        hidegamestoppurchase bigint(255),
        hidebestbuypurchase bigint(255),
        hideamazonpurchase bigint(255),
        hidesimilartitles bigint(255),
        hidefrontendbuyimg bigint(255),
        hidefrontendbuyprice bigint(255),
        hidecolorboxbuyimg bigint(255),
        hidecolorboxbuyprice bigint(255),
        amazoncountryinfo varchar(255) NOT NULL DEFAULT 'US',
        stylepak varchar(255) NOT NULL DEFAULT 'Default',
        PRIMARY KEY  (ID),
          KEY username (username)
  ) $charset_collate; ";

  // If table doesn't exist, create table and add initial data to it
  $test_name = $wpdb->prefix.'wpgamelist_jre_post_options';
  if($wpdb->get_var("SHOW TABLES LIKE '$test_name'") != $test_name) {
    dbDelta( $sql_create_table4 );
    $table_name = $wpdb->prefix . 'wpgamelist_jre_post_options';
    $wpdb->insert( $table_name, array('ID' => 1)); 
  }

  $sql_create_table5 = "CREATE TABLE {$wpdb->wpgamelist_jre_list_dynamic_db_names} 
  (
        ID bigint(190) auto_increment,
        stylepak varchar(190),
        user_table_name varchar(255) NOT NULL,
        PRIMARY KEY  (ID),
          KEY stylepak (stylepak)
  ) $charset_collate; ";
  dbDelta( $sql_create_table5 ); 

  $sql_create_table6 = "CREATE TABLE {$wpdb->wpgamelist_jre_game_quotes} 
  (
        ID bigint(190) auto_increment,
        placement varchar(190),
        quote varchar(255),
        PRIMARY KEY  (ID),
          KEY placement (placement)
  ) $charset_collate; ";
  dbDelta( $sql_create_table6 );

  // Get the default quotes for adding to database
  $quote_string = file_get_contents(GAMELIST_GAMELIST_QUOTES_DIR.'defaultquotes.txt');
  $quote_array = explode(';', $quote_string);
  $table_name = $wpdb->prefix . 'wpgamelist_jre_game_quotes';
  foreach($quote_array as $quote){
    if(strlen($quote) > 100){
      $placement = 'ui';
    } else {
      $placement = 'game';
    }
    if(strlen($quote) > 1){
      $wpdb->insert( $table_name, array('quote' => $quote, 'placement' => $placement)); 
    }
  }

  $sql_create_table7 = "CREATE TABLE {$wpdb->wpgamelist_jre_saved_page_post_log} 
  (
        ID bigint(190) auto_increment,
        game_uid varchar(190),
        game_title varchar(255),
        post_id bigint(255),
        type varchar(255),
        post_url varchar(255),
        author bigint(255),
        active_template varchar(255),
        PRIMARY KEY  (ID),
          KEY game_uid (game_uid)
  ) $charset_collate; ";
  dbDelta( $sql_create_table7 );

  

  //Creating the table
  $sql_create_table8 = "CREATE TABLE {$wpdb->wpgamelist_jre_saved_games_for_featured} 
  (
        ID bigint(190) auto_increment,
        game_title varchar(190),
        isbn varchar(255),
        subject varchar(255),
        country varchar(255),
        author varchar(255),
        authorurl varchar(255),
        purchaseprice varchar(255),
        currentdate varchar(255),
        finishedyes varchar(255),
        finishedno varchar(255),
        gamesignedyes varchar(255),
        gamesignedno varchar(255),
        firsteditionyes varchar(255),
        firsteditionno varchar(255),
        yearfinished bigint(255),
        coverimage varchar(255),
        pagenum bigint(255),
        pubdate bigint(255),
        publisher varchar(255),
        weight bigint(255),
        category varchar(255),
        description MEDIUMTEXT, 
        notes MEDIUMTEXT,
        itunespage varchar(255),
        googlepreview varchar(255),
        amazondetailpage varchar(255),
        gamerating bigint(255),
        reviewiframe varchar(255),
        similarproducts MEDIUMTEXT,
        PRIMARY KEY  (ID),
          KEY game_title (game_title)
  ) $charset_collate; ";
  dbDelta( $sql_create_table8 );

  $sql_create_table9 = "CREATE TABLE {$wpdb->wpgamelist_jre_active_extensions} 
  (
        ID bigint(190) auto_increment,
        active varchar(190),
        extension_name varchar(255),
        PRIMARY KEY  (ID),
          KEY active (active)
  ) $charset_collate; ";
  dbDelta( $sql_create_table9 );

  $sql_create_table10 = "CREATE TABLE {$wpdb->wpgamelist_jre_list_company_names} 
  (
        ID bigint(255) auto_increment,
        matchingcompid bigint(255),
        companyname varchar(255),
        PRIMARY KEY  (ID),
          KEY companyname (companyname)
  ) $charset_collate; ";
  dbDelta( $sql_create_table10 ); 

  $sql_create_table11 = "CREATE TABLE {$wpdb->wpgamelist_jre_list_platform_names} 
  (
        ID bigint(255) auto_increment,
        matchingid bigint(255),
        platformname varchar(255),
        PRIMARY KEY  (ID),
          KEY platformname (platformname)
  ) $charset_collate; ";
  dbDelta( $sql_create_table11 );

    $sql_create_table12 = "CREATE TABLE {$wpdb->wpgamelist_jre_list_genre_names} 
  (
        ID bigint(255) auto_increment,
        matchinggenreid bigint(255),
        genrename varchar(255),
        PRIMARY KEY  (ID),
          KEY genrename (genrename)
  ) $charset_collate; ";
  dbDelta( $sql_create_table12 ); 

/*
  // Reading in platform names into database
  $file = fopen(JSON_DIR.'platform_list.json',"r");
    //Output a line of the file until the end is reached
    $line = fgets($file);
    while(!feof($file)){
        $string = str_replace('\n', '', $line);
        $string = rtrim($string, ',');
        $string = "[" . trim($string) . "]";
        $json = json_decode($string, true);
        $matchingid = (int)$json[0]['matchingid'];
        $platformname = $json[0]['platformname'];
        $table_name = $wpdb->prefix.'wpgamelist_jre_list_platform_names';
        $wpdb->insert( 
                $table_name, 
                array(
                      'matchingid' => $matchingid, 
                      'platformname' => $platformname,
                ),
                array(
                        '%d',
                        '%s'
                )   
        );
        $line = fgets($file);
    }
    fclose($file);

    // Reading in Company names to the database
    $file = fopen(JSON_DIR.'company_names_formatted_backup.json',"r");
    //Output a line of the file until the end is reached
    $line = fgets($file);
    while(!feof($file)){
        $string = str_replace('\n', '', $line);
        $string = rtrim($string, ',');
        $string = "[" . trim($string) . "]";
        $json = json_decode($string, true);
        $matchingcompid = (int)$json[0]['matchingcompid'];
        $companyname = $json[0]['companyname'];
        $table_name = $wpdb->prefix.'wpgamelist_jre_list_company_names';
        $wpdb->insert( 
                $table_name, 
                array(
                      'matchingcompid' => $matchingcompid, 
                      'companyname' => $companyname,
                ),
                array(
                        '%d',
                        '%s'
                )   
        );
        $line = fgets($file);
    }
    fclose($file);

    // Reading in genre names to the database
    $file = fopen(JSON_DIR.'genre_names.json',"r");
    //Output a line of the file until the end is reached
    $line = fgets($file);
    while(!feof($file)){
        $string = str_replace('\n', '', $line);
        $string = rtrim($string, ',');
        $string = "[" . trim($string) . "]";
        $json = json_decode($string, true);
        $matchinggenreid = (int)$json[0]['id'];
        $genrename = $json[0]['name'];
        $table_name = $wpdb->prefix.'wpgamelist_jre_list_genre_names';
        $wpdb->insert( 
                $table_name, 
                array(
                      'matchinggenreid' => $matchinggenreid, 
                      'genrename' => $genrename,
                ),
                array(
                        '%d',
                        '%s'
                )   
        );
        $line = fgets($file);
    }
    fclose($file);

*/
}

// Function for deleting tables upon deletion of plugin
function wpgamelist_jre_delete_tables() {
    global $wpdb;
    $table1 = $wpdb->prefix."wpgamelist_jre_saved_game_log";
    $wpdb->query($wpdb->prepare("DROP TABLE IF EXISTS $table1", $table1));
    
    $table2 = $wpdb->prefix."wpgamelist_jre_saved_page_post_log";
    $wpdb->query($wpdb->prepare("DROP TABLE IF EXISTS $table2", $table2));

    $table4 = $wpdb->prefix."wpgamelist_jre_saved_games_for_featured";
    $wpdb->query($wpdb->prepare("DROP TABLE IF EXISTS $table4", $table4));

    $table5 = $wpdb->prefix."wpgamelist_jre_user_options";
    $wpdb->query($wpdb->prepare("DROP TABLE IF EXISTS $table5", $table5));

    $table6 = $wpdb->prefix."wpgamelist_jre_page_options";
    $wpdb->query($wpdb->prepare("DROP TABLE IF EXISTS $table6", $table6));

    $table7 = $wpdb->prefix."wpgamelist_jre_post_options";
    $wpdb->query($wpdb->prepare("DROP TABLE IF EXISTS $table7", $table7));

    $table8 = $wpdb->prefix."wpgamelist_jre_game_quotes";
    $wpdb->query($wpdb->prepare("DROP TABLE IF EXISTS $table8", $table8));

    $table9 = $wpdb->prefix."wpgamelist_jre_game_quotes";
    $wpdb->query($wpdb->prepare("DROP TABLE IF EXISTS $table9", $table9));
    
    $table3 = $wpdb->prefix."wpgamelist_jre_list_dynamic_db_names";
    $user_created_tables = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table3", $table3), $table3);
    foreach($user_created_tables as $utable){
      $table = $wpdb->prefix."wpgamelist_jre_".$utable->user_table_name;
      $wpdb->query($wpdb->prepare("DROP TABLE IF EXISTS $table", $table));
    }
    $wpdb->query($wpdb->prepare("DROP TABLE IF EXISTS $table3", $table3));
}

//Function to add the admin menu
function wpgamelist_jre_my_admin_menu() {
  add_menu_page( 'WPGameList Options', 'WPGameList', 'manage_options', 'WPGameList-Options', 'wpgamelist_jre_admin_page_function', GAMELIST_GAMELIST_ROOT_IMG_URL.'icon-256x256.png', 6  );

  $submenu_array = array(
    "Games",
    "Display Options",
    "Settings",
    "Extensions",
    "StylePaks",
    //"Template Paks"
  );

  // Filter to allow the addition of a new subpage
  if(has_filter('wpgamelist_add_sub_menu')) {
    $submenu_array = apply_filters('wpgamelist_add_sub_menu', $submenu_array);
  }

  foreach($submenu_array as $key=>$submenu){
    $menu_slug = strtolower(str_replace(' ', '-', $submenu));
    add_submenu_page('WPGameList-Options', 'WPGameList', $submenu, 'manage_options', 'WPGameList-Options-'.$menu_slug, 'wpgamelist_jre_admin_page_function');
  }

  remove_submenu_page('WPGameList-Options', 'WPGameList-Options');


}

function wpgamelist_jre_admin_page_function(){
  global $wpdb;
  require_once(GAMELIST_GAMELIST_GAMELIST_GAMELIST_ROOT_INCLUDES_UI_ADMIN_DIR.'class-admin-master-ui.php');
}


// Function to allow users to specify which table they want displayed by passing as an argument in the shortcode
function wpgamelist_jre_plugin_dynamic_shortcode_function($atts){
  global $wpdb;

  extract(shortcode_atts(array(
          'table' => $wpdb->prefix."wpgamelist_jre_saved_game_log",
          'action' => 'colorbox'
  ), $atts));

  // Set up the table
  if(isset($atts['table'])){
    $which_table = $wpdb->prefix . 'wpgamelist_jre_'.$table;
  } else {
    $which_table = $wpdb->prefix."wpgamelist_jre_saved_game_log";
  }

  // set up the action taken when cover image is clicked on
  if(isset($atts['action'])){
    $action = $atts['action'];
  } else {
    $action = 'colorbox';
  }

  if($atts == null){
    $which_table = $wpdb->prefix.'wpgamelist_jre_saved_game_log';
    $action = 'colorbox';
  }

  $offset = 0;

  ob_start();
  include_once( GAMELIST_GAMELIST_ROOT_INCLUDES_UI . 'class-frontend-library-ui.php');
  $front_end_library_ui = new WPGameList_Front_End_Library_UI($which_table, null, null, null, $action);
  $front_end_library_ui->build_library_actual($offset);
  return ob_get_clean();
}
 

// The function that determines which template to load for WPGameList Pages
function wpgamelist_set_page_post_template( $content ) {
  global $wpdb;

  $id = get_the_id();
  $blog_url = get_permalink( get_option( 'page_for_posts' ) );
  $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  if($blog_url == $actual_link){
  
  }

  $table_name = $wpdb->prefix.'wpgamelist_jre_saved_page_post_log';
  $page_post_row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE post_id = %d", $id));



  // If current page/post is a WPGameList Page or Post...
  if($page_post_row != null){

    if($page_post_row->type == 'page'){
      $table_name = $wpdb->prefix.'wpgamelist_jre_page_options';
      $options_page_row = $wpdb->get_row("SELECT * FROM $table_name");
    }

    if($page_post_row->type == 'post'){
      $table_name = $wpdb->prefix.'wpgamelist_jre_post_options';
      $options_post_row = $wpdb->get_row("SELECT * FROM $table_name");
    }

    $options_table_name = $wpdb->prefix . 'wpgamelist_jre_user_options';
    $options_row = $wpdb->get_row("SELECT * FROM $options_table_name");
    $amazon_country_info = $options_row->amazoncountryinfo;

    $table_name = $wpdb->prefix.'wpgamelist_jre_saved_game_log';
    $game_row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE game_uid = %s", $page_post_row->game_uid));


    // If game wasn't found in default library, loop through and search custom libraries
    if($game_row == null){
      $table_name = $wpdb->prefix . 'wpgamelist_jre_list_dynamic_db_names';
      $db_row = $wpdb->get_results("SELECT * FROM $table_name");
      
      foreach($db_row as $row){
        $table_name = $wpdb->prefix.'wpgamelist_jre_'.$row->user_table_name;
        $game_row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE game_uid = %s", $page_post_row->game_uid));
        if($game_row == null){
          continue;
        } else {
          break;
        }
      }
    }

    switch ($amazon_country_info) {
          case "au":
              $game_row->amazon_detail_page = str_replace(".com",".com.au", $game_row->amazon_detail_page);
              $game_row->$review_iframe = str_replace(".com",".com.au", $this->$review_iframe);
              break;
          case "br":
              $game_row->amazon_detail_page = str_replace(".com",".com.br", $game_row->amazon_detail_page);
              $game_row->review_iframe = str_replace(".com",".com.br", $game_row->review_iframe);
              break;
          case "ca":
              $game_row->amazon_detail_page = str_replace(".com",".ca", $game_row->amazon_detail_page);
              $game_row->review_iframe = str_replace(".com",".ca", $game_row->review_iframe);
              break;
          case "cn":
              $game_row->amazon_detail_page = str_replace(".com",".cn", $game_row->amazon_detail_page);
              $game_row->review_iframe = str_replace(".com",".cn", $game_row->review_iframe);
              break;
          case "fr":
              $game_row->amazon_detail_page = str_replace(".com",".fr", $game_row->amazon_detail_page);
              $game_row->review_iframe = str_replace(".com",".fr", $game_row->review_iframe);
              break;
          case "de":
              $game_row->amazon_detail_page = str_replace(".com",".de", $game_row->amazon_detail_page);
              $game_row->review_iframe = str_replace(".com",".de", $game_row->review_iframe);
              break;
          case "in":
              $game_row->amazon_detail_page = str_replace(".com",".in", $game_row->amazon_detail_page);
              $game_row->review_iframe = str_replace(".com",".in", $game_row->review_iframe);
              break;
          case "it":
              $game_row->amazon_detail_page = str_replace(".com",".it", $game_row->amazon_detail_page);
              $game_row->review_iframe = str_replace(".com",".it", $game_row->review_iframe);
              break;
          case "jp":
              $game_row->amazon_detail_page = str_replace(".com",".co.jp", $game_row->amazon_detail_page);
              $game_row->review_iframe = str_replace(".com",".co.jp", $game_row->review_iframe);
              break;
          case "mx":
              $game_row->amazon_detail_page = str_replace(".com",".com.mx", $game_row->amazon_detail_page);
              $game_row->review_iframe = str_replace(".com",".com.mx", $game_row->review_iframe);
              break;
          case "nl":
              $game_row->amazon_detail_page = str_replace(".com",".nl", $game_row->amazon_detail_page);
              $game_row->review_iframe = str_replace(".com",".nl", $game_row->review_iframe);
              break;
          case "es":
              $game_row->amazon_detail_page = str_replace(".com",".es", $game_row->amazon_detail_page);
              $game_row->review_iframe = str_replace(".com",".es", $game_row->review_iframe);
              break;
          case "uk":
              $game_row->amazon_detail_page = str_replace(".com",".co.uk", $game_row->amazon_detail_page);
              $game_row->review_iframe = str_replace(".com",".co.uk", $game_row->review_iframe);
              break;
          default:
              //$game_row->amazon_detail_page = $saved_game->amazon_detail_page;//filter_var($saved_game->amazon_detail_page, FILTER_SANITIZE_URL);
    }

    

    // Getting/creating quotes
    $quotes = file_get_contents(GAMELIST_GAMELIST_QUOTES_DIR.'defaultquotes.txt');
    $quotes_array = explode(';', $quotes);
    $quote = $quotes_array[array_rand($quotes_array)];
    $quote_array_2 = explode('-', $quote);

    if(sizeof($quote_array_2) == 2){
      $quote = '<span id="wpgamelist-quote-italic">'.$quote_array_2[0].'</span> - <span id="wpgamelist-quote-bold">'.$quote_array_2[1].'</span>';
    }

    // Getting Similar titles
    if($page_post_row->type == 'post'){
      $similar_string = '<span id="wpgamelist-post-span-hidden" style="display:none;"></span>';
    }

    if($page_post_row->type == 'page'){
      $similar_string = '<span id="wpgamelist-page-span-hidden" style="display:none;"></span>';
    }

    $similarproductsarray = explode(';bsp;',$game_row->similaramazonproducts);
    $similarproductsarray = array_unique($similarproductsarray);
    $similar_products_array = array_values($similarproductsarray);
    foreach($similar_products_array as $key=>$prod){
      $arr = explode("---", $prod, 2);
      $asin = $arr[0];

      $image = 'http://images.amazon.com/images/P/'.$asin.'.01.LZZZZZZZ.jpg';
      $url = 'https://www.amazon.com/dp/'.$asin.'?tag='.$options_row->amazonaff;
      if(strlen($image) > 51 ){
        if($page_post_row->type == 'page'){
          $similar_string = $similar_string.'<a class="wpgamelist-similar-link-post" target="_blank" href="'.$url.'"><img class="wpgamelist-similar-image-page" src="'.$image.'" /></a>';
        }
        if($page_post_row->type == 'post'){
          $similar_string = $similar_string.'<a class="wpgamelist-similar-link-post" target="_blank" href="'.$url.'"><img class="wpgamelist-similar-image-post" src="'.$image.'" /></a>';
        }
      }
    }

    $similar_string = $similar_string.'</div>';

    $table_name_options = $wpdb->prefix . 'wpgamelist_jre_user_options';
    $row = $wpdb->get_row("SELECT * FROM $table_name_options");
    $active_post_template = $row->activeposttemplate;
    $active_page_template = $row->activepagetemplate;

    // Double-check that Amazon review isn't expired
    require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-game.php');
    $game = new WPGameList_Game($game_row->ID, $table_name);
    $game->refresh_amazon_review($game_row->ID, $table_name);


    if($page_post_row->type == 'page'){

      switch ($active_page_template) {
        case 'Page-Template-1':
          include(GAMELIST_GAMELIST_PAGE_TEMPLATES_UPLOAD_DIR.'Page-Template-1.php');
          return $content.$string1.$string2.$string3.$string4.$string5.$string6.$string7.$string8.$string9.$string10.$string11.$string12.$string13.$string14.$string15.$string16.$string17.$string18.$string19.$string20.$string21.$string22.$string23.$string24.$string25.$string26.$string27.$string28.$string29.$string30.$string31.$string32.$string33.$string34.$string35.$string36.$string37.$string38.$string39.$string40.$string41.$string42.$string43.$string44.$string45.$string46.$string47;
        break;
        case 'Page-Template-2':
          include(GAMELIST_GAMELIST_PAGE_TEMPLATES_UPLOAD_DIR.'Page-Template-2.php');
          return $content.$string1.$string2.$string3.$string4.$string5.$string6.$string7.$string8.$string9.$string10.$string11.$string12.$string13.$string14.$string15.$string16.$string17.$string18.$string19.$string20.$string21.$string22.$string23.$string24.$string25.$string26.$string27.$string28.$string29.$string30.$string31.$string32.$string33.$string34.$string35.$string36.$string37.$string38.$string39.$string40.$string41.$string42.$string43.$string44.$string45.$string46.$string47;
        break;
        case 'Page-Template-3':
          include(GAMELIST_GAMELIST_PAGE_TEMPLATES_UPLOAD_DIR.'Page-Template-3.php');
          return $content.$string1.$string2.$string3.$string4.$string5.$string6.$string7.$string8.$string9.$string10.$string11.$string12.$string13.$string14.$string15.$string16.$string17.$string18.$string19.$string20.$string21.$string22.$string23.$string24.$string25.$string26.$string27.$string28.$string29.$string30.$string31.$string32.$string33.$string34.$string35.$string36.$string37.$string38.$string39.$string40.$string41.$string42.$string43.$string44.$string45.$string46.$string47;
        break;
        case 'Page-Template-4':
          include(GAMELIST_GAMELIST_PAGE_TEMPLATES_UPLOAD_DIR.'Page-Template-4.php');
          return $content.$string1.$string2.$string3.$string4.$string5.$string6.$string7.$string8.$string9.$string10.$string11.$string12.$string13.$string14.$string15.$string16.$string17.$string18.$string19.$string20.$string21.$string22.$string23.$string24.$string25.$string26.$string27.$string28.$string29.$string30.$string31.$string32.$string33.$string34.$string35.$string36.$string37.$string38.$string39.$string40.$string41.$string42.$string43.$string44.$string45.$string46.$string47;
        break;
        case 'Page-Template-5':
          include(GAMELIST_GAMELIST_PAGE_TEMPLATES_UPLOAD_DIR.'Page-Template-5.php');
          return $content.$string1.$string2.$string3.$string4.$string5.$string6.$string7.$string8.$string9.$string10.$string11.$string12.$string13.$string14.$string15.$string16.$string17.$string18.$string19.$string20.$string21.$string22.$string23.$string24.$string25.$string26.$string27.$string28.$string29.$string30.$string31.$string32.$string33.$string34.$string35.$string36.$string37.$string38.$string39.$string40.$string41.$string42.$string43.$string44.$string45.$string46.$string47;
        break;
        default:
          include(GAMELIST_GAMELIST_PAGE_POST_TEMPLATES_DEFAULT_DIR.'page-template-default.php');
          return $content.$string1.$string2.$string3.$string4.$string5.$string6.$string7.$string8.$string9.$string10.$string11.$string12.$string13.$string52.$string15.$string16.$string17.$string18.$string19.$string20.$string21.$string22.$string23.$string50.$string51.$string24.$string25.$string26.$string27.$string28.$string29.$string30.$string31.$string32.$string33.$string34.$string35.$string36.$string37.$string38.$string39.$string40.$string48.$string49.$string41.$string42.$string43.$string44.$string54.$string14.$string53.$string45.$string46.$string47;
        break;
      }
    }

    if($page_post_row->type == 'post'){

      switch ($active_post_template) {
        case 'Post-Template-1':
          include(GAMELIST_GAMELIST_POST_TEMPLATES_UPLOAD_DIR.'Post-Template-1.php');
          return $content.$string1.$string2.$string3.$string4.$string5.$string6.$string7.$string8.$string9.$string10.$string11.$string12.$string13.$string14.$string15.$string16.$string17.$string18.$string19.$string20.$string21.$string22.$string23.$string24.$string25.$string26.$string27.$string28.$string29.$string30.$string31.$string32.$string33.$string34.$string35.$string36.$string37.$string38.$string39.$string40.$string41.$string42.$string43.$string44.$string45.$string46.$string47;
        break;
        case 'Post-Template-2':
          include(GAMELIST_GAMELIST_POST_TEMPLATES_UPLOAD_DIR.'Post-Template-2.php');
          return $content.$string1.$string2.$string3.$string4.$string5.$string6.$string7.$string8.$string9.$string10.$string11.$string12.$string13.$string14.$string15.$string16.$string17.$string18.$string19.$string20.$string21.$string22.$string23.$string24.$string25.$string26.$string27.$string28.$string29.$string30.$string31.$string32.$string33.$string34.$string35.$string36.$string37.$string38.$string39.$string40.$string41.$string42.$string43.$string44.$string45.$string46.$string47;
        break;
        case 'Post-Template-3':
          include(GAMELIST_GAMELIST_POST_TEMPLATES_UPLOAD_DIR.'Post-Template-3.php');
          return $content.$string1.$string2.$string3.$string4.$string5.$string6.$string7.$string8.$string9.$string10.$string11.$string12.$string13.$string14.$string15.$string16.$string17.$string18.$string19.$string20.$string21.$string22.$string23.$string24.$string25.$string26.$string27.$string28.$string29.$string30.$string31.$string32.$string33.$string34.$string35.$string36.$string37.$string38.$string39.$string40.$string41.$string42.$string43.$string44.$string45.$string46.$string47;
        break;
        case 'Post-Template-4':
          include(GAMELIST_GAMELIST_POST_TEMPLATES_UPLOAD_DIR.'Post-Template-4.php');
          return $content.$string1.$string2.$string3.$string4.$string5.$string6.$string7.$string8.$string9.$string10.$string11.$string12.$string13.$string14.$string15.$string16.$string17.$string18.$string19.$string20.$string21.$string22.$string23.$string24.$string25.$string26.$string27.$string28.$string29.$string30.$string31.$string32.$string33.$string34.$string35.$string36.$string37.$string38.$string39.$string40.$string41.$string42.$string43.$string44.$string45.$string46.$string47;
        break;
        case 'Post-Template-5':
          include(GAMELIST_GAMELIST_POST_TEMPLATES_UPLOAD_DIR.'Post-Template-5.php');
          return $content.$string1.$string2.$string3.$string4.$string5.$string6.$string7.$string8.$string9.$string10.$string11.$string12.$string13.$string14.$string15.$string16.$string17.$string18.$string19.$string20.$string21.$string22.$string23.$string24.$string25.$string26.$string27.$string28.$string29.$string30.$string31.$string32.$string33.$string34.$string35.$string36.$string37.$string38.$string39.$string40.$string41.$string42.$string43.$string44.$string45.$string46.$string47;
        break;
        default:
          include(GAMELIST_GAMELIST_PAGE_POST_TEMPLATES_DEFAULT_DIR.'post-template-default.php');
          return $content.$string1.$string2.$string3.$string4.$string5.$string6.$string7.$string8.$string9.$string10.$string11.$string12.$string13.$string52.$string15.$string16.$string17.$string18.$string19.$string20.$string21.$string22.$string23.$string50.$string51.$string24.$string25.$string26.$string27.$string28.$string29.$string30.$string31.$string32.$string33.$string34.$string35.$string36.$string37.$string38.$string39.$string40.$string48.$string49.$string41.$string42.$string43.$string44.$string54.$string14.$string53.$string45.$string46.$string47;
        break;
      }
    }




    /*
    switch ($page_post_row->active_template) {
      case 'template1':
        if($page_post_row->type == 'page'){
          include(GAMELIST_GAMELIST_PAGE_TEMPLATES_UPLOAD_DIR.'page-template-1.php');
          //return $content;
        } else {
          include(GAMELIST_GAMELIST_PAGE_TEMPLATES_UPLOAD_DIR.'post-template-1.php');
          //return $content;
        }
        break;
      case 'template2':
        if($page_post_row->type == 'page'){
          include(GAMELIST_GAMELIST_PAGE_TEMPLATES_UPLOAD_DIR.'page-template-2.php');
         // return $content;
        } else {
          include(GAMELIST_GAMELIST_PAGE_TEMPLATES_UPLOAD_DIR.'post-template-2.php');
          //return $content;
        }
        break;
      case 'default':
        if($page_post_row->type == 'page'){
          include(PAGE_TEMPLATES_DEFAULT_DIR.'page-template-default.php');

          // Double-check that Amazon review isn't expired
          require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-game.php');
          $game = new WPGameList_Game($game_row->ID, $table_name);
          $game->refresh_amazon_review($game_row->ID, $table_name);

          return $content.$string1.$string2.$string3.$string4.$string5.$string6.$string7.$string8.$string9.$string10.$string11.$string12.$string13.$string14.$string15.$string16.$string17.$string18.$string19.$string20.$string21.$string22.$string23.$string24.$string25.$string26.$string27.$string28.$string29.$string30.$string31.$string32.$string33.$string34.$string35.$string36.$string37.$string38.$string39.$string40.$string41.$string42.$string43.$string44.$string45.$string46.$string47;

        } else {
          include(PAGE_TEMPLATES_DEFAULT_DIR.'post-template-default.php');

          // Double-check that Amazon review isn't expired
          require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-game.php');
          $game = new WPGameList_Game($game_row->ID, $table_name);
          $game->refresh_amazon_review($game_row->ID, $table_name);

          return $content.$string1.$string2.$string3.$string4.$string5.$string6.$string7.$string8.$string9.$string10.$string11.$string12.$string13.$string14.$string15.$string16.$string17.$string18.$string19.$string20.$string21.$string22.$string23.$string24.$string25.$string26.$string27.$string28.$string29.$string30.$string31.$string32.$string33.$string34.$string35.$string36.$string37.$string38.$string39.$string40.$string41.$string42.$string43.$string44.$string45.$string46.$string47;
        }
        break;
      default:
        //return $content;
        break;
    }
    */

  }

  // Making double-sure content gets returned.
  return $content; 
}

// Handles various aestetic functions for the front end
function wpgamelist_various_aestetic_bits_front_end(){
  ?>
  <script type="text/javascript" >
  "use strict";
  jQuery(document).ready(function($) {

    // Handles the saerch functions
    if($('#wpgamelist-search-text').val() != 'Search...'){
      $('#wpgamelist-search-sub-button').prop('disabled', false);
    }
    $(document).on("click","#wpgamelist-search-text", function(event){
      $(this).val('');
      $('#wpgamelist-search-sub-button').prop('disabled', false);
    });



    // Enables the 'Read More' link for the description block in a post utilizing the readmore.js file
    $('#wpbl-posttd-game-description-contents').readmore({
      speed: 175,
      heightMargin: 16,
      collapsedHeight: 100,
      moreLink: '<a href="#">Read more</a>',
      lessLink: '<a href="#">Read less</a>'
    });

    // Enables the 'Read More' link for the notes block in a post utilizing the readmore.js file
    $('#wpbl-posttd-game-notes-contents').readmore({
      speed: 75,
      heightMargin: 16,
      collapsedHeight: 100,
      moreLink: '<a href="#">Read more</a>',
      lessLink: '<a href="#">Read less</a>'
    });

    // Enables the 'Read More' link for the description block in a post utilizing the readmore.js file
    $('#wpbl-pagetd-game-description-contents').readmore({
      speed: 175,
      heightMargin: 16,
      collapsedHeight: 100,
      moreLink: '<a href="#">Read more</a>',
      lessLink: '<a href="#">Read less</a>'
    });

    // Enables the 'Read More' link for the notes block in a post utilizing the readmore.js file
    $('#wpbl-pagetd-game-notes-contents').readmore({
      speed: 75,
      heightMargin: 16,
      collapsedHeight: 100,
      moreLink: '<a href="#">Read more</a>',
      lessLink: '<a href="#">Read less</a>'
    });
  });
  </script>
  <?php
}

// Handles various aestetic functions for the back end
function wpgamelist_various_aestetic_bits_back_end(){
  wp_enqueue_media();
  ?>
  <script type="text/javascript" >
  "use strict";
  jQuery(document).ready(function($) {

    // Making the last active library the viewed library after page reload
    if(window.location.href.includes('library=') && window.location.href.includes('tab=edit-games') && window.location.href.includes('WPGameList')){
          $('#wpgamelist-editgame-select-library').val(window.location.href.substr( window.location.href.lastIndexOf("=")+1));
          $('#wpgamelist-editgame-select-library').trigger("change");
    }

    // Highlight active tab
    console.log(window.location.href);
    if(window.location.href.includes('&tab=')){
      $('.nav-tab').each(function(){
        console.log('<?php echo admin_url();?>'+$(this).attr('href'));
        if(window.location.href == '<?php echo admin_url();?>admin.php'+$(this).attr('href')){

          if(window.location.href.indexOf('WPGameList') != -1){
            $(this).first().css({'background-color':'#36CB40', 'color':'white'})
          }
        }
      })
      console.log('a tab')
    } else {
      if(window.location.href.indexOf('WPGameList') != -1){
        $('.nav-tab').first().css({'background-color':'#36CB40', 'color':'white'})
      }
    }

    // Only allow one localization checkbox to be checked
    $(".wpgamelist-localization-checkbox").change(function(){
      $('[name=us-based-game-info]').attr('checked', false);
      $('[name=uk-based-game-info]').attr('checked', false);
      $('[name=au-based-game-info]').attr('checked', false);
      $('[name=br-based-game-info]').attr('checked', false);
      $('[name=ca-based-game-info]').attr('checked', false);
      $('[name=cn-based-game-info]').attr('checked', false);
      $('[name=fr-based-game-info]').attr('checked', false);
      $('[name=de-based-game-info]').attr('checked', false);
      $('[name=in-based-game-info]').attr('checked', false);
      $('[name=it-based-game-info]').attr('checked', false);
      $('[name=jp-based-game-info]').attr('checked', false);
      $('[name=mx-based-game-info]').attr('checked', false);
      $('[name=es-based-game-info]').attr('checked', false); 
      $('[name=nl-based-game-info]').attr('checked', false);
      $(this).attr('checked', true);
    });

    // Handles the enabling/disabling of the 'Create a Library' button and input placeholder text
    $(".wpgamelist-dynamic-input").on('click', function() { 
      var currentVal = $(".wpgamelist-dynamic-input").val();
      if(currentVal == 'Create a New Library Here...'){
        $(".wpgamelist-dynamic-input").val('');
      }
    });
    $(".wpgamelist-dynamic-input").bind('input', function() { 
      var currentVal = $(".wpgamelist-dynamic-input").val();
      if((currentVal.length > 0) && (currentVal != 'Create a New Library Here...')){
        $("#wpgamelist-dynamic-shortcode-button").attr('disabled', false);
      }
    });

    // Handles the 'check all' and 'uncheck all' function of the display options
    $("#wpgamelist-check-all").on('click', function() { 
      $("#wpgamelist-uncheck-all").prop('checked', false);
      $('#wpgamelist-jre-backend-options-table input').each(function(){
        $(this).prop('checked', true);
      })
    });
    $("#wpgamelist-uncheck-all").on('click', function() { 
      $("#wpgamelist-check-all").prop('checked', false);
      $('#wpgamelist-jre-backend-options-table input').each(function(){
        $(this).prop('checked', false);
      })
    });


    $(document).on("change","#wpgamelist-add-game-select-input-3", function(event){
      var val = $(this).val();

      if(val == 'Yes'){
        $('#wpgamelist-add-game-select-input-4').prop('disabled', false);
      }
      event.preventDefault ? event.preventDefault() : event.returnValue = false;
    });

    $(document).on("change","#wpgamelist-add-game-select-input-5", function(event){
      var val = $(this).val();

      if(val == 'Yes'){
        $('#wpgamelist-add-game-date-input-2').prop('disabled', false);
      }
      event.preventDefault ? event.preventDefault() : event.returnValue = false;
    });
  });
  </script>
  <?php
}


// Shortcode function for displaying game cover image/link
function wpgamelist_game_cover_shortcode($atts) {
  global $wpdb;

  extract(shortcode_atts(array(
          'table' => $wpdb->prefix."saved_game_log",
          'title' => '',
          'width' => '100',
          'align' => 'left',
          'margin' => '5px',
          'action' => 'gameview',
          'display' => 'justimage'
  ), $atts));

  if($atts == null){
    $table = $wpdb->prefix.'wpgamelist_jre_saved_game_log';
    $options_row = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table  LIMIT %d",1));
    $title = $options_row[0]->title;
    $width = '100';
    //echo 'table: '.$table.PHP_EOL.'title: '.$title;
  }

  if(!isset($atts['title']) && !isset($atts['table']) ){
    $table = $wpdb->prefix.'wpgamelist_jre_saved_game_log';
    $options_row = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table LIMIT %d",1));
    $title = $options_row[0]->title;
  }

  if(!isset($atts['title']) && isset($atts['table']) ){
    $table = $wpdb->prefix.'wpgamelist_jre_'.strtolower($table);
    $options_row = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table  LIMIT %d",1));
    $title = $options_row[0]->title;

  }

  if(isset($atts['title']) && !isset($atts['table']) ){
    $table = $wpdb->prefix.'wpgamelist_jre_saved_game_log';
  }

  if(isset($atts['title']) && isset($atts['table'])){
    $table = $wpdb->prefix.'wpgamelist_jre_'.strtolower($table);
  }

  $title = str_replace('-','', $title);
  $titletemp = '';
  $options_row = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table WHERE title = %s", $title));

  if(sizeof($options_row) == 0){
      $titletemp = addslashes($title);
     error_log($titletemp);
      $options_row = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table WHERE title = %s", $titletemp));
  }

  if(sizeof($options_row) == 0){
    if(strpos( $titletemp, "'") !== false){
      $titletemp = str_replace("'", "&#39;",  $titletemp);
    }
    $options_row = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table WHERE title = %s", $titletemp));
  }

  if(sizeof($options_row) == 0){
      $options_row = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table WHERE title LIKE %s", $titletemp));
  }

  if(sizeof($options_row) == 0){
    echo __("This game isn't in your Library! Please check the title you provided.",'wpgamelist');
  } else {
    $image = $options_row[0]->image;
    $link = $options_row[0]->amazonbuylink;
    $table_name_options = $wpdb->prefix . 'wpgamelist_jre_user_options';
    $options_results = $wpdb->get_row("SELECT * FROM $table_name_options");

    // Replace with user's affiliate id, if available
    $amazonaff = $options_results->amazonaff;
    $link = str_replace('wpbooklistid-20', $amazonaff, $link);

    $amazoncountryinfo = $options_results->amazoncountryinfo;
    switch ($amazoncountryinfo) {
        case "au":
            $link = str_replace(".com",".com.au", $link);
            break;
        case "br":
            $link = str_replace(".com",".com.br", $link);
            break;
        case "ca":
            $link = str_replace(".com",".ca", $link);
            break;
        case "cn":
            $link = str_replace(".com",".cn", $link);
            break;
        case "fr":
            $link = str_replace(".com",".fr", $link);
            break;
        case "de":
            $link = str_replace(".com",".de", $link);
            break;
        case "in":
            $link = str_replace(".com",".in", $link);
            break;
        case "it":
            $link = str_replace(".com",".it", $link);
            break;
        case "jp":
            $link = str_replace(".com",".co.jp", $link);
            break;
        case "mx":
            $link = str_replace(".com",".com.mx", $link);
            break;
        case "nl":
            $link = str_replace(".com",".nl", $link);
            break;
        case "es":
            $link = str_replace(".com",".es", $link);
            break;
        case "uk":
            $link = str_replace(".com",".co.uk", $link);
            break;
        default:
            $link;
    }//end switch 

    $class = 'class="wpgamelist_jre_game_cover_shortcode_link wpgamelist-show-game-colorbox"';
    if(isset($atts['action'])){
      switch ($atts['action']) {
        case "amazon":
          $class = 'class="wpgamelist_jre_game_cover_shortcode_link"';
          $link = $link;
        break;
        case "gamestop":
          $class = 'class="wpgamelist_jre_game_cover_shortcode_link"';
          $link = $options_row[0]->gamestopurl;
          if($link == null){
            $link = $options_row[0]->amazonbuylink;
          }
        break;
        case "bestbuy":
          $class = 'class="wpgamelist_jre_game_cover_shortcode_link"';
          $link = $options_row[0]->bestbuyurl;
          if($link == null){
            $link = $options_row[0]->amazonbuylink;
          }
        break;
        case "steam":
          $class = 'class="wpgamelist_jre_game_cover_shortcode_link"';
          $link = $options_row[0]->steamurl;
          if($link == null){
            $link = $options_row[0]->amazonbuylink;
          }
        break;
        case "ebay":
          $class = 'class="wpgamelist_jre_game_cover_shortcode_link"';
          $link = $options_row[0]->ebayurl;
          if($link == null){
            $link = $options_row[0]->amazonbuylink;
          }
        break;
        case "kobo":
          $class = 'class="wpgamelist_jre_game_cover_shortcode_link"';
          $link = $options_row[0]->kobo_link;
          if($link == null){
            $link = $options_row[0]->amazonbuylink;
          }
        break;
        case "gameview":
          $class = 'class="wpgamelist_jre_game_cover_shortcode_link wpgamelist-show-game-colorbox"';
        default:
          $class = 'class="wpgamelist_jre_game_cover_shortcode_link wpgamelist-show-game-colorbox"';
          $link = $link;
        break;
      }
    } else {
      $link = $link;
      $class = 'class="wpgamelist_jre_game_cover_shortcode_link wpgamelist-show-game-colorbox"';
    }

    // If there isn't an Amazon link available, make it open in colorbox instead
    if($link == '' || $link == null){
      $final_link = '<div style="float:'.$align.'; margin:'.$margin.'; margin-bottom:50px;" class="wpgamelist-shortcode-entire-container"><a class="wpgamelist-show-game-colorbox"  style="z-index:9; float:'.$align.'; margin:'.$margin.';" '.$class.' data-gametable="'.$table.'" data-gameid="'.$options_row[0]->ID.'" '.$class.' target="_blank" href="'.$link.'"><img style="min-width:150px; margin-right: 5px; width:'.$width.'px!important" src="'.$image.'"/></a>';

    } else {
      $final_link = '<div style="float:'.$align.'; margin:'.$margin.'; margin-bottom:50px;" class="wpgamelist-shortcode-entire-container"><a  style="z-index:9; float:'.$align.'; margin:'.$margin.';" '.$class.' data-gametable="'.$table.'" data-gameid="'.$options_row[0]->ID.'" '.$class.' target="_blank" href="'.$link.'"><img style="min-width:150px; margin-right: 5px; width:'.$width.'px!important" src="'.$image.'"/></a>';
    }


    $display = '';
    if(isset($atts['display'])){
      switch ($atts['display']) {
        case "justimage":
          $display = '';
        break;
        case "excerpt":

          $final_link = str_replace('float:right', 'float:left', $final_link);
          $final_link = str_replace('float:right', 'float:left', $final_link);

          $text = stripslashes($options_row[0]->summary);

          $text = str_replace('<br />', ' ', html_entity_decode($text));
          $text = str_replace('<br/>', ' ', html_entity_decode($text));
          $text = str_replace('<div>', '', html_entity_decode($text));
          $text = str_replace('</div>', '', html_entity_decode($text));
          //echo highlight_string($text);
          //$text = strip_tags($text);
          
          $limit = 40;
          if (str_word_count($text, 0) > $limit) {
              $words = str_word_count($text, 2);
              $pos = array_keys($words);
              $text = substr($text, 0, $pos[$limit]) . '...';
          }

          $title = stripslashes($options_row[0]->title);
          $limit = 10;
          if (str_word_count($title, 0) > $limit) {
              $words = str_word_count($title, 2);
              $pos = array_keys($words);
              $title = substr($title, 0, $pos[$limit]) . '...';
          }
          
          // if the 'allow_url_fopen' directive is allowed, use getimagesize(), otherwise do the roundabout cUrl way to retrieve the remote image and determine the size
          if( ini_get('allow_url_fopen') ) {
              $size = getimagesize($image);
          }
          else {
              $ch = curl_init();
              $timeout = 5; // set to zero for no timeout
              curl_setopt ($ch, CURLOPT_URL, $image);
              curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
              curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
              $file_contents = curl_exec($ch);
              curl_close($ch);

              $new_image = ImageCreateFromString($file_contents);
              imagejpeg($new_image, "temp.png",100);

              // Get new dimensions
              $size = getimagesize("temp.png");

          }
          
          $origwidth = $size[0];
          $origheight = $size[1];
          $final_height = ($origheight*$width)/$origwidth;

          $descheight = $final_height-50-40;

          $string1 = '';
          $string2 = '';
          $string3 = '';
          $string4 = '';
          $string5 = '';
          $string6 = '';
          $display = '<div style="display:grid; height:'.$final_height.'px" class="wpgamelist-shortcode-below-link-div">
            <h3 class="wpgamelist-shortcode-h3" style="text-align:'.$align.';">'.$title.'</h3>
            <div style="text-align:'.$align.'; position:relative; bottom:5px; class="wpgamelist-shortcode-below-link-excerpt">'.$text.'</div>
            <div class="wpgamelist-shortcode-link-holder-media" style="text-align:'.$align.'; bottom:-10px; class="wpgamelist-shortcode-purchase-links">';

            if($options_row[0]->amazonbuylink != null){
              $string1 = '<a class="wpgamelist-purchase-img" href="'.$options_row[0]->amazonbuylink.'" target="_blank">
                <img src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'amazon.png">
              </a>';
            }

            if($options_row[0]->gamestopurl != null){
            $string2 = '<a class="wpgamelist-purchase-img" href="'.$options_row[0]->gamestopurl.'" target="_blank">
                <img src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'gamestop.png">
              </a>';
            }

            if($options_row[0]->bestbuyurl != null){
              $string3 = '<a class="wpgamelist-purchase-img" href="'.$options_row[0]->bestbuyurl.'" target="_blank">
                <img src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'bestbuy.png">
              </a>';
            }

            if($options_row[0]->steamurl != null){
              $string4 = '<a class="wpgamelist-purchase-img" href="'.$options_row[0]->steamurl.'" target="_blank">
                <img src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'steam.png" id="wpgamelist-itunes-img">
              </a>';
            }

            if($options_row[0]->ebayurl != null){
              $string5 = '<a class="wpgamelist-purchase-img" href="'.$options_row[0]->ebayurl.'" target="_blank">
                <img src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'ebay.png">
              </a>';
            }

            $string7 ='</div>
          </div></div>';

          $display = $display.$string1.$string2.$string3.$string4.$string5.$string6.$string7;

        break;
        default:
          $display = '';
        break;
      }
    }
    return $final_link.$display;
  }
 
}

// Function to run any code that is needed to modify the plugin between different versions
function wpgamelist_upgrade_function(){

  global $wpdb;
  // Get current version #
  $table_name = $wpdb->prefix . 'wpgamelist_jre_user_options';
  $row = $wpdb->get_row("SELECT * FROM $table_name");
  $version = $row->version;

  // If version number does not match the current version number found in wpgamelist.php
  if($version != WPGAMELIST_VERSION_NUM){

    

  }
}


// Handles the popup that appears when the user deactivates WPGameList
function wpgamelist_exit_survey(){
  ?>
  <script type="text/javascript" >
  "use strict";
  jQuery(document).ready(function($) {

    var modalHtml = '<!-- The Modal --><div id="myModal" class="modal"><!-- Modal content --><div class="modal-content"><span class="close">&times;</span><img id="jre-domain-all-zips-loc" width="40" src="<?php echo GAMELIST_GAMELIST_ROOT_IMG_URL ?>icon-256x256.png" /><p id="wpgamelist-modal-title">Whoa, Wait a sec!</p><p id="wpgamelist-modal-desc"><span style="font-weight:bold;font-style:italic;">Tell me why you\'re getting rid of WPGameList</span>, and I\'ll do my best to fix the issue! </p><div id="wpgamelist-modal-reason-div"><div><input type="checkbox" id="wpgamelist-modal-reason1" /><label>It Doesn\'t Work!</label></div><div><input type="checkbox" id="wpgamelist-modal-reason2" /><label>It\'s Ugly!</label>  (<a href="https://wpgamelist.com/index.php/stylepaks-2/">StylePaks</a> - <a href="https://wpgamelist.com/index.php/templates-2/">Template Paks</a> - <a href="https://wpgamelist.com/index.php/downloads/stylizer-extension/">Stylizer Extension</a>)</div><div><input type="checkbox" id="wpgamelist-modal-reason3" /><label>It Doesn\'t Have a Feature I Need!</label><div id="wpgamelist-suggested-feature-div"><label></label><textarea id="wpgamelist-modal-textarea-suggest-feature" placeholder="What kind of feature are you looking for?"></textarea><label>Also, be sure to check out <a href="https://wpgamelist.com/index.php/extensions/">all the available Extensions</a> - chances are the feature you\'re looking for already exists!</label></div></div><div><input type="checkbox" id="wpgamelist-modal-reason4" /><label>It Broke My Website!</label></div><div><input type="checkbox" id="wpgamelist-modal-reason5" /><label>It Doesn\'t Work Right With My Theme!</label></div><div><input type="checkbox" id="wpgamelist-modal-reason6" /><label>The <a href="https://wpgamelist.com/index.php/extensions/" target="_blank">Extensions</a> Are Too Expensive!</label></div><div><input type="checkbox" id="wpgamelist-modal-reason7" /><label>I Prefer a Different Game Plugin!</label></div><div><input type="checkbox" id="wpgamelist-modal-reason8" /><label>This Pop-Up Is Annoying!</label></div><div><input type="checkbox" id="wpgamelist-modal-reason9" /><label>Just Not What I Thought It Was...</label></div><textarea id="wpgamelist-modal-textarea" placeholder="Provide Another Reason & Some Details Here"></textarea></div><div id="wpgamelist-modal-email-div"><label><span style="font-weight:bold;margin-bottom: -9px;display: block;">E-Mail Address (Optional)</span></br>(If provided, I\'ll personally respond to your concern)</label><input id="wpgamelist-modal-email" style="margin-top: 7px;width:200px;" type="text" placeholder="E-Mail Address" /></div><div id="wpgamelist-modal-submit">Submit - And Thanks For Trying WPGameList!</div><div id="wpgamelist-modal-close">Nah - Just Deactivate WPGameList!</div></div></div>';

    $('body').append(modalHtml);
    $('#myModal').css({'display':'none'})

    $(document).on("click",".deactivate", function(event){
      if( $(this).find('a').attr('href').indexOf('wpgamelist.php') != -1){

        // Get and open the modal
        var modal = document.getElementById('myModal');
        modal.style.display = "block";

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            //modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                //modal.style.display = "none";
            }
        }

        event.preventDefault ? event.preventDefault() : event.returnValue = false;

      }
    })

    $(document).on("click","#wpgamelist-modal-reason3", function(event){

      if($(this).prop('checked')){
        $('#wpgamelist-suggested-feature-div').animate({'height':'110px', 'top':'5px'})
      } else {
        $('#wpgamelist-suggested-feature-div').animate({'height':'0px', 'top':'0px'})
      }
    });
    

  });
  </script>
  <?php
}

// For populating the 'Add a Game' fields from a searched title
function wpgamelist_populate_add_game_fields_action_javascript() { 
  ?>
    <script type="text/javascript" >
    "use strict";
    jQuery(document).ready(function($) {
      $(document).on("click",".wpgamelist-add-game-search-column", function(event){
        event.preventDefault ? event.preventDefault() : event.returnValue = false;
      });
  });
  </script>
  <?php
}

/*
// For opening the media library on the Pop-Up creation page
add_action( 'admin_footer', 'targetpop_boilerplate_action_javascript' );

function targetpop_boilerplate_action_javascript() { 
  ?>
    <script type="text/javascript" >
    "use strict";
    jQuery(document).ready(function($) {
      $(document).on("click",".targetpop", function(event){

        event.preventDefault ? event.preventDefault() : event.returnValue = false;
      });
  });
  </script>
  <?php
}
*/





?>