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
        <p><p>'.__('What\'s a','wpgamelist').' <span class="wpgamelist-color-orange-italic">StylePak</span> '.__('you ask?','wpgamelist').' <span class="wpgamelist-color-orange-italic">StylePaks</span> '.__('are the best way to instantly change the look and feel of your','wpgamelist').' <span class="wpgamelist-color-orange-italic">'.__('WPGameList','wpgamelist').'</span> '.__('plugin!','wpgamelist').'</p><br/><br/>
<div class="section group">
  <div class="col span_1_of_2">
     <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg" />'.__('StoreFront Extension','wpgamelist').'</p>
           <a id="wpgamelist-extensions-page-img-link" href="http://wpgamelist.com/index.php/downloads/ultimate-stylepak-bundle/">
            <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-6">
           <img class="wpgamelist-extension-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg"  />
           <p class="wpgamelist-extension-p">'.__('Ultimate StylePak Bundle!','wpgamelist').'</p>
           </div>
           </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span">'.__('Can\'t decide on just one StylePak? Get \'em all with the','wpgamelist').'<span class="wpgamelist-color-orange-italic"> '.__('Ultimate StylePak Bundle!','wpgamelist').'</span></span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="http://wpgamelist.com/index.php/downloads/ultimate-stylepak-bundle/">'.__('More Details','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="http://wpgamelist.com/index.php/downloads/ultimate-stylepak-bundle/">'.__('$16.00 - Purchase Now!','wpgamelist').'</a></div>
  </div>
  <div class="col span_1_of_2">
   <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg" />'.__('Library StylePak 1','wpgamelist').'</p>
          <a id="wpgamelist-extensions-page-img-link" href="http://wpgamelist.com/index.php/downloads/library-stylepak-1/">
            <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-1">
           <img class="wpgamelist-extension-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg"  />
           <p class="wpgamelist-extension-p">'.__('Library StylePak 1','wpgamelist').'</p>
          </div>
          </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span"> '.__('Provides larger images - suited for “portrait-sized" Game Cover Images.','wpgamelist').'</span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="http://wpgamelist.com/index.php/library-stylepak-1/">'.__('View Demo','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="http://wpgamelist.com/index.php/downloads/library-stylepak-1/">'.__('$2.00 - Purchase Now!','wpgamelist').'</a></div>
  </div>
  </div>
  <div class="section group">
  <div class="col span_1_of_2">
   <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg" />'.__('Library StylePak 2','wpgamelist').'</p>
          <a id="wpgamelist-extensions-page-img-link" href="http://wpgamelist.com/index.php/downloads/library-stylepak-2/">
            <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-2">
           <img class="wpgamelist-extension-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg"  />
           <p class="wpgamelist-extension-p">'.__('Library StylePak 2','wpgamelist').'</p>
           </div>
           </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span">'.__('Provides larger images - suited for more “square-sized" Game Cover Images.','wpgamelist').'</span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="http://wpgamelist.com/index.php/library-stylepak-2/">'.__('View Demo','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="http://wpgamelist.com/index.php/downloads/library-stylepak-2/">'.__('$2.00 - Purchase Now!','wpgamelist').'</a></div>
  </div>
  <div class="col span_1_of_2">
    <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg" />'.__('Library StylePak 3','wpgamelist').'</p>
            <a id="wpgamelist-extensions-page-img-link" href="http://wpgamelist.com/index.php/downloads/library-stylepak-3/">
             <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-3">
             <img class="wpgamelist-extension-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg"  />
             <p class="wpgamelist-extension-p">'.__('Library StylePak 3','wpgamelist').'</p>
             </div>
           </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span"> '.__('Larger images that retain their aspect ratio, regardless of platform.','wpgamelist').'</span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="http://wpgamelist.com/index.php/library-stylepak-3/">'.__('View Demo','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="http://wpgamelist.com/index.php/downloads/library-stylepak-3/">'.__('$2.00 - Purchase Now!','wpgamelist').'</a></div>
  </div>
  </div>
  <div class="section group">
   <div class="col span_1_of_2">
   <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg" />'.__('Library StylePak 4','wpgamelist').'</p>
            <a id="wpgamelist-extensions-page-img-link" href="http://wpgamelist.com/index.php/downloads/library-stylepak-4/">
             <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-4">
             <img class="wpgamelist-extension-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg"  />
             <p class="wpgamelist-extension-p">'.__('Library StylePak 4','wpgamelist').'</p>
             </div>
           </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span">'.__('Perfect for sites with colored backgrounds, and for “portrait-sized" Game Cover Images.','wpgamelist').'</span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="http://wpgamelist.com/index.php/library-stylepak-4/">'.__('View Demo','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="http://wpgamelist.com/index.php/downloads/library-stylepak-4/">'.__('$2.00 - Purchase Now!','wpgamelist').'</a></div>
    </div>
    <div class="col span_1_of_2">
   <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg" />'.__('Library StylePak 5','wpgamelist').'</p>
            <a id="wpgamelist-extensions-page-img-link" href="http://wpgamelist.com/index.php/downloads/library-stylepak-5/">
             <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-5">
             <img class="wpgamelist-extension-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg"  />
             <p class="wpgamelist-extension-p">'.__('Library StylePak 5','wpgamelist').'</p>
             </div>
           </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span">'.__('Perfect for sites with colored backgrounds, and for “square-sized" Game Cover Images.','wpgamelist').'</span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="http://wpgamelist.com/index.php/library-stylepak-5/">'.__('View Demo','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="http://wpgamelist.com/index.php/downloads/library-stylepak-5/">'.__('$2.00 - Purchase Now!','wpgamelist').'</a></div>
    </div>
  </div>
  <div class="section group">
   <div class="col span_1_of_2">
   <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg" />'.__('Library StylePak 4','wpgamelist').'</p>
            <a id="wpgamelist-extensions-page-img-link" href="http://wpgamelist.com/index.php/downloads/library-stylepak-6/">
             <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-8">
             <img class="wpgamelist-extension-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg"  />
             <p class="wpgamelist-extension-p">'.__('Library StylePak 6','wpgamelist').'</p>
             </div>
           </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span">'.__('Perfect for sites with colored backgrounds - Game Images also retain original aspect ratios.','wpgamelist').'</span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="http://wpgamelist.com/index.php/library-stylepak-6/">'.__('View Demo','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="http://wpgamelist.com/index.php/downloads/library-stylepak-6/">'.__('$2.00 - Purchase Now!','wpgamelist').'</a></div>
    </div>
    <div class="col span_1_of_2">
   <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg" />'.__('Library StylePak 4','wpgamelist').'</p>
            <a id="wpgamelist-extensions-page-img-link" href="http://wpgamelist.com/index.php/downloads/library-stylepak-7/">
             <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-15">
             <img class="wpgamelist-extension-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg"  />
             <p class="wpgamelist-extension-p">'.__('Library StylePak 7','wpgamelist').'</p>
             </div>
           </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span">'.__('Cropped and rounded images - suited for “portrait-sized" Game Cover Images.','wpgamelist').'</span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="http://wpgamelist.com/index.php/library-stylepak-7/">'.__('View Demo','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="http://wpgamelist.com/index.php/downloads/library-stylepak-7/">'.__('$2.00 - Purchase Now!','wpgamelist').'</a></div>
    </div>

    </div>
    <div class="section group">
   <div class="col span_1_of_2">
   <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg" />'.__('Library StylePak 4','wpgamelist').'</p>
            <a id="wpgamelist-extensions-page-img-link" href="http://wpgamelist.com/index.php/downloads/library-stylepak-8/">
             <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-1">
             <img class="wpgamelist-extension-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg"  />
             <p class="wpgamelist-extension-p">'.__('Library StylePak 8','wpgamelist').'</p>
             </div>
           </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span">'.__('Cropped and rounded images - suited for more “square-sized" Game Cover Images.','wpgamelist').'</span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="http://wpgamelist.com/index.php/library-stylepak-8/">'.__('View Demo','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="http://wpgamelist.com/index.php/downloads/library-stylepak-8/">'.__('$2.00 - Purchase Now!','wpgamelist').'</a></div>
    </div>
    <div class="col span_1_of_2">
   <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg" />'.__('Library StylePak 4','wpgamelist').'</p>
            <a id="wpgamelist-extensions-page-img-link" href="http://wpgamelist.com/index.php/downloads/library-stylepak-9/">
             <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-2">
             <img class="wpgamelist-extension-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg"  />
             <p class="wpgamelist-extension-p">'.__('Library StylePak 9','wpgamelist').'</p>
             </div>
           </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span">'.__('Introduces a fixed-background image of various console controllers.','wpgamelist').'</span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="http://wpgamelist.com/index.php/library-stylepak-9/">'.__('View Demo','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="http://wpgamelist.com/index.php/downloads/library-stylepak-9/">'.__('$2.00 - Purchase Now!','wpgamelist').'</a></div>
    </div>

    </div>
    <div class="section group">
   <div class="col span_1_of_2">
   <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg" />'.__('Library StylePak 4','wpgamelist').'</p>
            <a id="wpgamelist-extensions-page-img-link" href="http://wpgamelist.com/index.php/downloads/library-stylepak-10/">
             <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-3">
             <img class="wpgamelist-extension-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg"  />
             <p class="wpgamelist-extension-p">'.__('Library StylePak 10','wpgamelist').'</p>
             </div>
           </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span">'.__('Introduces a fixed-background image of an Xbox One controller','wpgamelist').'</span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="http://wpgamelist.com/index.php/library-stylepak-10/">'.__('View Demo','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="http://wpgamelist.com/index.php/downloads/library-stylepak-10/">'.__('$2.00 - Purchase Now!','wpgamelist').'</a></div>
    </div>
    <div class="col span_1_of_2">
   <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg" />'.__('Library StylePak 4','wpgamelist').'</p>
            <a id="wpgamelist-extensions-page-img-link" href="http://wpgamelist.com/index.php/downloads/library-stylepak-11/">
             <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-5">
             <img class="wpgamelist-extension-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg"  />
             <p class="wpgamelist-extension-p">'.__('Library StylePak 11','wpgamelist').'</p>
             </div>
           </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span">'.__('Introduces a fixed-background image of the PlayStation 4 reveal.','wpgamelist').'</span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="http://wpgamelist.com/index.php/library-stylepak-11/">'.__('View Demo','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="http://wpgamelist.com/index.php/downloads/library-stylepak-11/">'.__('$2.00 - Purchase Now!','wpgamelist').'</a></div>
    </div>

    </div>
    <div class="section group">
   <div class="col span_1_of_2">
   <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg" />'.__('Library StylePak 4','wpgamelist').'</p>
            <a id="wpgamelist-extensions-page-img-link" href="http://wpgamelist.com/index.php/downloads/library-stylepak-12/">
             <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-6">
             <img class="wpgamelist-extension-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg"  />
             <p class="wpgamelist-extension-p">'.__('Library StylePak 12','wpgamelist').'</p>
             </div>
           </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span">'.__('Introduces a fixed-background image of the Nintendo Switch.','wpgamelist').'</span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="http://wpgamelist.com/index.php/library-stylepak-12/">'.__('View Demo','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="http://wpgamelist.com/index.php/downloads/library-stylepak-12/">'.__('$2.00 - Purchase Now!','wpgamelist').'</a></div>
    </div>
    <div class="col span_1_of_2">
   <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg" />'.__('Library StylePak 4','wpgamelist').'</p>
            <a id="wpgamelist-extensions-page-img-link" href="http://wpgamelist.com/index.php/downloads/library-stylepak-13/">
             <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-15">
             <img class="wpgamelist-extension-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg"  />
             <p class="wpgamelist-extension-p">'.__('Library StylePak 13','wpgamelist').'</p>
             </div>
           </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span">'.__('Introduces a fixed-background image of a PS4 Console and Controller','wpgamelist').'</span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="http://wpgamelist.com/index.php/library-stylepak-13/">'.__('View Demo','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="http://wpgamelist.com/index.php/downloads/library-stylepak-13/">'.__('$2.00 - Purchase Now!','wpgamelist').'</a></div>
    </div>

    </div>
    <div class="section group">
   <div class="col span_1_of_2">
   <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg" />'.__('Library StylePak 4','wpgamelist').'</p>
            <a id="wpgamelist-extensions-page-img-link" href="http://wpgamelist.com/index.php/downloads/library-stylepak-14/">
             <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-4">
             <img class="wpgamelist-extension-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/librarystylepak.svg"  />
             <p class="wpgamelist-extension-p">'.__('Library StylePak 14','wpgamelist').'</p>
             </div>
           </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span">'.__('Introduces a fixed-background image of the Nintendo Switch.','wpgamelist').'</span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="http://wpgamelist.com/index.php/library-stylepak-14/">'.__('View Demo','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="http://wpgamelist.com/index.php/downloads/library-stylepak-14/">'.__('$2.00 - Purchase Now!','wpgamelist').'</a></div>
    </div>
    </div>





</div>

        ';

        return $string1;
  }


}

endif;