<?php
/**
 * WPGameList Admin UI Template Class
 *
 * @author   Jake Evans
 * @category Admin
 * @package  Includes/Classes
 * @version  1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPGameList_Admin_UI_Template', false ) ) :
/**
 * WPGameList_Admin_Menu Class.
 */
class WPGameList_Admin_UI_Template {

    public static function output_open_admin_container($title, $iconurl){
    	return '<div class="wpgamelist-admin-tp-container">
    				<p class="wpgamelist-admin-tp-top-title"><img class="wpgamelist-admin-tp-title-icon" src="'.$iconurl.'" />'.$title.'</p>
    				<div class="wpgamelist-admin-tp-inner-container">';
    }

    public static function output_close_admin_container(){
    	return '</div></div>';
    }

    public static function output_template_advert(){
    	return '<div class="wpgamelist-admin-tp-container">
              <div id="wpgamelist-flex-container">
          			<div id="wpgamelist-admin-tp-advert-site-div">
            				<div id="wpgamelist-admin-tp-advert-visit-me-title">For Everything WPGameList</div>
                    <a target="_blank" id="wpgamelist-admin-tp-advert-visit-me-link" href="http://wpgamelist.com/">
                      <img src="http://wpgamelist.com/wp-content/uploads/2018/04/Screenshot-2018-04-19-10.50.04.png">
                      WPGameList.com
                    </a>
          			</div>
                <div id="wpgamelist-admin-tp-advert-site-div">
                    <div id="wpgamelist-admin-tp-advert-visit-me-title">For Everything WPBookList</div>
                    <a target="_blank" id="wpgamelist-admin-tp-advert-visit-me-link" href="https://wordpress.org/plugins/wpbooklist/">
                      <img src="https://wpbooklist.com/wp-content/uploads/2018/04/Screenshot-2018-04-19-11.01.23.png">
                      WPBookList.com
                    </a>
                </div>
              </div>
        			<p id="wpgamelist-admin-tp-advert-email-me">E-mail with questions, issues, concerns, suggestions, or anything else at <a href="mailto:general@wpgamelist.com">General@wpgamelist.com</a></p>
              <div id="wpgamelist-facebook-link-div">
                <a href="https://www.facebook.com/WPGameList-490463747966630/" target="_blank"><img height="34" style="border:0px;height:34px;" src="https://wpbooklist.com/wp-content/uploads/2017/11/fb-art.png" border="0" alt="Visit WPGameList of facebook!"></a>
              </div>
        			<div id="wpgamelist-admin-tp-advert-money-container">
          				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="VUVFXRUQ462UU">
                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                  </form>

          				<a target="_blank" id="wpgamelist-patreon-link" href="http://patreon.com/user?u=3614120"><img id="wpbooklist-patreon-img" src="https://www.jakerevans.com/wp-content/plugins/wpbooklist/assets/img/patreon.png"></a>
          				<a href="https://ko-fi.com/A8385C9" target="_blank"><img height="34" style="border:0px;height:34px;" src="https://www.jakerevans.com/wp-content/plugins/wpbooklist/assets/img/kofi1.png" border="0" alt="Buy Me a Coffee at ko-fi.com"></a>
          				<p>And be sure to <a target="_blank" href="https://wordpress.org/support/plugin/wpgamelist/reviews/">leave a 5-star review of WPGameList!</a></p>
        			</div>
        		</div>';
    }

}

endif;


