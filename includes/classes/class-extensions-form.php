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
        <p>'.__('Extensions are the easiest way to add additional functionality to your','wpgamelist').'<span class="wpgamelist-color-orange-italic">WPGameList</span> '.__('plugin. Simply purchase the extension of your choice and install it just like you’d install any other WordPress plugin. That’s all there is to it!','wpgamelist').'<br/><br/>
<div class="section group">
  <div class="col span_1_of_2">
     <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="http://www.wpgamelist.com/wp-content/uploads/wpgamelist/icons/goodreads.svg" />'.__('Goodreads Extension','wpgamelist').'</p>
              <a id="wpgamelist-extensions-page-img-link" href="http://wpgamelist.com/index.php/downloads/extensions-bundle/">
                <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-6">
                  <img class="wpgamelist-extension-img-bundle-mult" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/book.svg"><img class="wpgamelist-extension-img-bundle-mult" src="http://wpgamelist.com/wp-content/uploads/2017/08/svgs/profits.svg"><img class="wpgamelist-extension-img-bundle-mult" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/newswhite.svg"><p></p>
                  <p class="wpgamelist-extension-p-bundle-ext">'.__('Extensions Bundle!','wpgamelist').'</p>
                  <p><img class="wpgamelist-extension-img-bundle-mult" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/video-player-white.svg"><img class="wpgamelist-extension-img-bundle-mult" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/video-game-white.svg"><img class="wpgamelist-extension-img-bundle-mult" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/programming-white.svg">
                           </p>
                </div>
             </a>
             <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span">'.__('Can’t decide which Extension to buy? Get ’em all with the','wpgamelist').' <span class="wpgamelist-color-orange-italic">Extensions Bundle!</span></span><span class="wpgamelist-top-line-span"></span></p>
             <div class="wpgamelist-above-purchase-line"></div>
             <p class="wpgamelist-to-download-page"><a href="http://wpgamelist.com/index.php/downloads/extensions-bundle/">'.__('More Details','wpgamelist').'</a></p>
             <div class="wpgamelist-extensions-purchase-button-link"><a href="http://wpgamelist.com/index.php/downloads/extensions-bundle/">'.__('$20.00 - Purchase Now','wpgamelist').'</a></div>
  </div>
  <div class="col span_1_of_2">
   <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="http://www.wpgamelist.com/wp-content/uploads/wpgamelist/icons/affiliate.svg" />'.__('Affiliates Extension','wpgamelist').'</p>
          <a id="wpgamelist-extensions-page-img-link" href="http://wpgamelist.com/index.php/downloads/affiliate-extension/">
            <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-2">
           <img class="wpgamelist-extension-img" src="http://wpgamelist.com/wp-content/uploads/2017/08/svgs/profits.svg"  />
           <p class="wpgamelist-extension-p">'.__('Affiliate','wpgamelist').'</p>
          </div>
          </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span">'.__('Let WPGameList work for you with the','wpgamelist').' <span class="wpgamelist-color-orange-italic">'.__('WPGameList Affiliates Extension!','wpgamelist').'</span></span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="http://wpgamelist.com/index.php/downloads/affiliate-extension/">'.__('More Details','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="http://wpgamelist.com/index.php/downloads/affiliate-extension/">'.__('$5.00 - Purchase Now','wpgamelist').'</a></div>
  </div>
</div>
<div class="section group">
  <div class="col span_1_of_2">
     <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/book.svg" />'.__('StoreFront Extension','wpgamelist').'</p>
           <a id="wpgamelist-extensions-page-img-link" href="http://wpgamelist.com/index.php/downloads/storefront-extension/">
            <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-1">
           <img class="wpgamelist-extension-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/book.svg"  />
           <p class="wpgamelist-extension-p">'.__('StoreFront','wpgamelist').'</p>
           </div>
           </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span">'.__('Got games to sell? Then you need the','wpgamelist').' <span class="wpgamelist-color-orange-italic">'.__('WPGameList StoreFront Extension!','wpgamelist').'</span></span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="http://wpgamelist.com/index.php/downloads/storefront-extension/">'.__('More Details','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="http://wpgamelist.com/index.php/downloads/storefront-extension/">'.__('$8.00 - Purchase Now','wpgamelist').'</a></div>
  </div>
  <div class="col span_1_of_2">
   <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/newswhite.svg" />'.__('NewsFeed Extension','wpgamelist').'</p>
          <a id="wpgamelist-extensions-page-img-link" href="https://wpgamelist.com/index.php/downloads/newsfeed-extension/">
            <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-8">
           <img class="wpgamelist-extension-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/newswhite.svg"  />
           <p class="wpgamelist-extension-p">'.__('NewsFeed','wpgamelist').'</p>
           </div>
           </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span">'.__('Stay Up-to-Date with your games - get the ','wpgamelist').' <span class="wpgamelist-color-orange-italic">'.__('WPGameList NewsFeed Extension!','wpgamelist').'</span></span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="https://wpgamelist.com/index.php/downloads/newsfeed-extension/">'.__('More Details','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="https://wpgamelist.com/index.php/downloads/newsfeed-extension/">'.__('$3.00 - Purchase Now','wpgamelist').'</a></div>
  </div>
</div>
<div class="section group">
  <div class="col span_1_of_2">
   <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/video-player-white.svg" />'.__('NewsFeed Extension','wpgamelist').'</p>
          <a id="wpgamelist-extensions-page-img-link" href="https://wpgamelist.com/index.php/downloads/videos-extension/">
            <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-3">
           <img class="wpgamelist-extension-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/video-player-white.svg"  />
           <p class="wpgamelist-extension-p">'.__('Videos & Trailers','wpgamelist').'</p>
           </div>
           </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span">'.__('Like game trailers? Then get the ','wpgamelist').' <span class="wpgamelist-color-orange-italic">'.__('WPGameList Videos & Trailers Extension!','wpgamelist').'</span></span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="https://wpgamelist.com/index.php/downloads/videos-extension/">'.__('More Details','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="https://wpgamelist.com/index.php/downloads/videos-extension/">'.__('$3.00 - Purchase Now','wpgamelist').'</a></div>
  </div>
  <div class="col span_1_of_2">
    <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/video-game-white.svg" />'.__('Screenshots Extension','wpgamelist').'</p>
            <a id="wpgamelist-extensions-page-img-link" href="https://wpgamelist.com/index.php/downloads/screenshots-extension/">
             <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-4">
             <img class="wpgamelist-extension-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/video-game-white.svg"  />
             <p class="wpgamelist-extension-p">'.__('Screenshots','wpgamelist').'</p>
             </div>
           </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span">'.__('Add some screenshot eye-candy with the','wpgamelist').' <span class="wpgamelist-color-orange-italic">'.__('WPGameList Screenshots Extension!','wpgamelist').'</span></span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="https://wpgamelist.com/index.php/downloads/screenshots-extension/">'.__('More Details','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="https://wpgamelist.com/index.php/downloads/screenshots-extension/">'.__('$3.00 - Purchase Now','wpgamelist').'</a></div>
  </div>
</div>
<div class="section group">
  <div class="col span_1_of_2">
   <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/programming-white.svg" />'.__('Platforms Extension','wpgamelist').'</p>
            <a id="wpgamelist-extensions-page-img-link" href="https://wpgamelist.com/index.php/downloads/platforms-extension/">
             <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-5">
             <img class="wpgamelist-extension-img" src="https://wpgamelist.com/wp-content/uploads/2017/08/svgs/programming-white.svg"  />
             <p class="wpgamelist-extension-p">'.__('Platforms','wpgamelist').'</p>
             </div>
           </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span">'.__('Display your Games by Platform - Optimized for mobile! ','wpgamelist').'</span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="https://wpgamelist.com/index.php/platforms-extension-demo/">'.__('Try the Demo!','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="http://wpgamelist.com/index.php/downloads/platforms-extension/">'.__('$3.00 - Purchase Now','wpgamelist').'</a></div>
  </div>
  <div class="col span_1_of_2">
   <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="http://wpgamelist.com/wp-content/uploads/2017/08/svgs/carousel-white.svg" />'.__('GameFinder Extension','wpgamelist').'</p>
            <a id="wpgamelist-extensions-page-img-link" href="https://wpgamelist.com/index.php/downloads/carousel-extension/">
             <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-11">
             <img class="wpgamelist-extension-img" src="http://wpgamelist.com/wp-content/uploads/2017/08/svgs/carousel-white.svg"  />
             <p class="wpgamelist-extension-p">'.__('Carousel','wpgamelist').'</p>
             </div>
           </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span">'.__('Add Some Movement! Provides yet another way to creatively display your games!','wpgamelist').' </span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="https://wpgamelist.com/index.php/2018/04/24/wpgamelist-carousel-extension-guide/">'.__('Try the Demo!','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="https://wpgamelist.com/index.php/downloads/carousel-extension/">'.__('$5.00 - Purchase Now','wpgamelist').'</a></div>
  </div>
</div>
<div class="section group">
  <div class="col span_1_of_2">
   <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="http://wpgamelist.com/wp-content/uploads/2017/08/svgs/computer-white.svg" />'.__('Branding','wpgamelist').'</p>
            <a id="wpgamelist-extensions-page-img-link" href="https://wpgamelist.com/index.php/downloads/branding-extension/">
             <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-14">
             <img class="wpgamelist-extension-img" src="http://wpgamelist.com/wp-content/uploads/2017/08/svgs/computer-white.svg"  />
             <p class="wpgamelist-extension-p" style="margin-top:33px;">'.__('Branding','wpgamelist').'</p>
             </div>
           </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span">'.__('Proudly display your site\'s logo and motto every time a game is opened!' ,'wpgamelist').' </span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="https://wpgamelist.com/index.php/downloads/branding-extension/">'.__('More Details','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="https://wpgamelist.com/index.php/downloads/branding-extension/">'.__('$5.00 - Purchase Now','wpgamelist').'</a></div>
  </div>
  <div class="col span_1_of_2">
   <p class="wpgamelist-extension-title"><img class="wpgamelist-extension-icon-img" src="http://wpgamelist.com/wp-content/uploads/2017/08/svgs/content-white.svg" />'.__('Stylizer Extension','wpgamelist').'</p>
            <a id="wpgamelist-extensions-page-img-link" href="https://wpgamelist.com/index.php/downloads/stylizer-extension/">
             <div class="wpgamelist-extension-page-ext-div" id="wpgamelist-extension-page-ext-div-10">
             <img class="wpgamelist-extension-img" src="http://wpgamelist.com/wp-content/uploads/2017/08/svgs/content-white.svg"  />
             <p class="wpgamelist-extension-p">'.__('Stylizer','wpgamelist').'</p>
             </div>
           </a>
           <p class="wpgamelist-extension-excerpt"><span class="wpgamelist-excerpt-span">'.__('Easily customize the Look & Feel of your','wpgamelist').' <span class="wpgamelist-color-orange-italic">'.__('WPGameList','wpgamelist').'</span> Game and Library Views!</span><span class="wpgamelist-top-line-span"></span></p>
           <div class="wpgamelist-above-purchase-line"></div>
           <p class="wpgamelist-to-download-page"><a href="https://wpgamelist.com/index.php/downloads/stylizer-extension/">'.__('More Details','wpgamelist').'</a></p>
           <div class="wpgamelist-extensions-purchase-button-link"><a href="https://wpgamelist.com/index.php/downloads/stylizer-extension/">'.__('$5.00 - Purchase Now','wpgamelist').'</a></div>
  </div>
  </div>
  













</div>

        ';

        return $string1;
  }


}

endif;