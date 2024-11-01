<?php
/**
 * WPGameList Add-Edit-Game-Form Tab Class
 *
 * @author   Jake Evans
 * @category Admin
 * @package  Includes/Classes
 * @version  1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPGameList_Add_Game_Form', false ) ) :
/**
 * WPGameList_Admin_Menu Class.
 */
class WPGameList_Add_Game_Form {

  public static function output_add_game_form(){

    // Perform check for previously-saved Amazon Authorization
    global $wpdb;
    $table_name = $wpdb->prefix . 'wpgamelist_jre_user_options';
    $opt_results = $wpdb->get_row("SELECT * FROM $table_name");

    $table_name = $wpdb->prefix . 'wpgamelist_jre_list_dynamic_db_names';
    $db_row = $wpdb->get_results("SELECT * FROM $table_name");

    // For grabbing an image from media library
    wp_enqueue_media();
    $string1 = '<div id="wpgamelist-addgame-container">
        <p><p>'.__('What\'s a','wpgamelist').' <span class="wpgamelist-color-orange-italic">Template Pak</span> '.__('you ask?','wpgamelist').' <span class="wpgamelist-color-orange-italic">Template Paks</span> '.__('are the best way to instantly change the look and feel of your','wpgamelist').' <span class="wpgamelist-color-orange-italic">'.__('WPGameList','wpgamelist').'</span> '.__('Pages and Posts!','wpgamelist').'</p><br/><br/>
<div class="section group">
  <div class="col span_1_of_2">
     <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="http://wpgamelist.com/wp-content/uploads/2017/08/svgs/seo-template-white.svg" />'.__('StoreFront Extension','wpgamelist').'</p>
           <a id="wpgamelist-extensions-page-img-link" href="https://wpgamelist.com/index.php/downloads/template-pak-bundle/">
            <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-6">
           <img class="wpgamelist-extension-img" src="http://wpgamelist.com/wp-content/uploads/2017/08/svgs/seo-template-white.svg"  />
           <p class="wpgamelist-extension-p">'.__('Template Pak Bundle!','wpgamelist').'</p>
           </div>
           </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span">'.__('Can\'t decide on just one Template Pak? Get \'em all with the','wpgamelist').'<span class="wpgamelist-color-orange-italic"> '.__('Template Pak Bundle!','wpgamelist').'</span></span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="https://wpgamelist.com/index.php/downloads/template-pak-bundle/">'.__('More Details','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="https://wpgamelist.com/index.php/downloads/template-pak-bundle/">'.__('$8.00 - Purchase Now!','wpgamelist').'</a></div>
  </div>
  <div class="col span_1_of_2">
   <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="http://wpgamelist.com/wp-content/uploads/2017/08/svgs/seo-template-white.svg" />'.__('Template Pak 1','wpgamelist').'</p>
          <a id="wpgamelist-extensions-page-img-link" href="https://wpgamelist.com/index.php/downloads/template-pak-1/">
            <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-1">
           <img class="wpgamelist-extension-img" src="http://wpgamelist.com/wp-content/uploads/2017/08/svgs/seo-template-white.svg"  />
           <p class="wpgamelist-extension-p">'.__('Template Pak 1','wpgamelist').'</p>
          </div>
          </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span"> '.__('Moves Game Details and Purchase Links to the left side, placing focus on the Game Description and Amazon Reviews.','wpgamelist').'</span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="https://wpgamelist.com/index.php/downloads/template-pak-1/">'.__('More Details','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="https://wpgamelist.com/index.php/downloads/template-pak-1/">'.__('$2.00 - Purchase Now!','wpgamelist').'</a></div>
  </div>
  </div>
  <div class="section group">
  <div class="col span_1_of_2">
   <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="http://wpgamelist.com/wp-content/uploads/2017/08/svgs/seo-template-white.svg" />'.__('Template Pak 2','wpgamelist').'</p>
          <a id="wpgamelist-extensions-page-img-link" href="https://wpgamelist.com/index.php/downloads/template-pak-2/">
            <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-2">
           <img class="wpgamelist-extension-img" src="http://wpgamelist.com/wp-content/uploads/2017/08/svgs/seo-template-white.svg"  />
           <p class="wpgamelist-extension-p">'.__('Template Pak 2','wpgamelist').'</p>
           </div>
           </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span">'.__('Features a larger cover image, a horizontal Game Details section, and a centered left column.','wpgamelist').'</span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="https://wpgamelist.com/index.php/downloads/template-pak-2/">'.__('More Details','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="https://wpgamelist.com/index.php/downloads/template-pak-2/">'.__('$2.00 - Purchase Now!','wpgamelist').'</a></div>
  </div>
  <div class="col span_1_of_2">
    <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="http://wpgamelist.com/wp-content/uploads/2017/08/svgs/seo-template-white.svg" />'.__('Template Pak 3','wpgamelist').'</p>
            <a id="wpgamelist-extensions-page-img-link" href="https://wpgamelist.com/index.php/downloads/template-pak-3/">
             <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-3">
             <img class="wpgamelist-extension-img" src="http://wpgamelist.com/wp-content/uploads/2017/08/svgs/seo-template-white.svg"  />
             <p class="wpgamelist-extension-p">'.__('Template Pak 3','wpgamelist').'</p>
             </div>
           </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span"> '.__('Places the Social icons vertically, moves the purchase links to the right, and aligns the left column under the cover image','wpgamelist').'</span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="https://wpgamelist.com/index.php/downloads/template-pak-3/">'.__('More Details','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="https://wpgamelist.com/index.php/downloads/template-pak-3/">'.__('$2.00 - Purchase Now!','wpgamelist').'</a></div>
  </div>
  </div>
  <div class="section group">
   <div class="col span_1_of_2">
   <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="http://wpgamelist.com/wp-content/uploads/2017/08/svgs/seo-template-white.svg" />'.__('Template Pak 4','wpgamelist').'</p>
            <a id="wpgamelist-extensions-page-img-link" href="https://wpgamelist.com/index.php/downloads/template-pak-4/">
             <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-4">
             <img class="wpgamelist-extension-img" src="http://wpgamelist.com/wp-content/uploads/2017/08/svgs/seo-template-white.svg"  />
             <p class="wpgamelist-extension-p">'.__('Template Pak 4','wpgamelist').'</p>
             </div>
           </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span">'.__('Larger images, vertical social icons, aligns the Game Details, Description, and Amazon reviews further right.','wpgamelist').'</span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="https://wpgamelist.com/index.php/downloads/template-pak-4/">'.__('More Details','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="https://wpgamelist.com/index.php/downloads/template-pak-4/">'.__('$2.00 - Purchase Now!','wpgamelist').'</a></div>
    </div>
    <div class="col span_1_of_2">
   <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="http://wpgamelist.com/wp-content/uploads/2017/08/svgs/seo-template-white.svg" />'.__('Template Pak 5','wpgamelist').'</p>
            <a id="wpgamelist-extensions-page-img-link" href="https://wpgamelist.com/index.php/downloads/template-pak-5/">
             <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-5">
             <img class="wpgamelist-extension-img" src="http://wpgamelist.com/wp-content/uploads/2017/08/svgs/seo-template-white.svg"  />
             <p class="wpgamelist-extension-p">'.__('Template Pak 5','wpgamelist').'</p>
             </div>
           </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span">'.__('Takes a cue from <a href="https://wpgamelist.com/index.php/downloads/library-stylepak-5/" class="targetpop-predictions-link-tracker-class">Library StylePak 5</a>, sporting white text and a fixed wood-grain background.  </p>','wpgamelist').'</span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="https://wpgamelist.com/index.php/downloads/template-pak-5/">'.__('More Details','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="https://wpgamelist.com/index.php/downloads/template-pak-5/">'.__('$2.00 - Purchase Now!','wpgamelist').'</a></div>
    </div>
  </div>
  





</div>

        ';

        return $string1;
  }


}

endif;