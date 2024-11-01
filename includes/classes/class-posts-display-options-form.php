<?php
/**
 * WPGameList Posts Display Options Form Tab Class
 *
 * @author   Jake Evans
 * @category Admin
 * @package  Includes/Classes
 * @version  1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPGameList_Posts_Display_Options_Form', false ) ) :
/**
 * WPGameList_Admin_Menu Class.
 */
class WPGameList_Posts_Display_Options_Form {

    public static function output_add_edit_form(){
        global $wpdb;

        // Getting the settings for posts
        $table_name = $wpdb->prefix . 'wpgamelist_jre_post_options';
        $options_row = $wpdb->get_row("SELECT * FROM $table_name");

        // Getting the settings for the Default library
        $table_name = $wpdb->prefix . 'wpgamelist_jre_user_options';
        $default_options_row = $wpdb->get_row("SELECT * FROM $table_name");

        # All settings properties
        $hidetitlegame = $options_row->hidetitlegame;
        $hidequote = $options_row->hidequote;
        $hidestarsgame = $options_row->hidestarsgame;
        $hidefacebookshare = $options_row->hidefacebookshare;
        $hidefacebookmessenger = $options_row->hidefacebookmessenger;
        $hidegoogleplus = $options_row->hidegoogleplus;
        $hidepinterest = $options_row->hidepinterest;
        $hideemail = $options_row->hideemail;
        $hidetwitter = $options_row->hidetwitter;
        $hidegamepost = $options_row->hidegamepost;
        $hidegamepage = $options_row->hidegamepage;
        $hidefinished = $options_row->hidefinished;
        $hidecoverimage = $options_row->hidecoverimage;
        $hidepublisher = $options_row->hidepublisher;
        $hidedeveloper = $options_row->hidedeveloper;
        $hidegenre = $options_row->hidegenre;
        $hidereleasedate = $options_row->hidereleasedate;
        $hideseries = $options_row->hideseries;
        $hidecriticrating = $options_row->hidecriticrating;
        $hideigdblink = $options_row->hideigdblink;
        $hideplatforms = $options_row->hideplatforms;
        $hidealtnames = $options_row->hidealtnames;
        $hideamazonreviews = $options_row->hideamazonreviews;
        $hidenotes = $options_row->hidenotes;
        $hidedescription = $options_row->hidedescription;
        $hidesteampurchase = $options_row->hidesteampurchase;
        $hideebaypurchase = $options_row->hideebaypurchase;
        $hidegamestoppurchase = $options_row->hidegamestoppurchase;
        $hidebestbuypurchase = $options_row->hidebestbuypurchase;
        $hideamazonpurchase = $options_row->hideamazonpurchase;
        $hidesimilartitles = $options_row->hidesimilartitles;
        $hidefrontendbuyimg = $options_row->hidefrontendbuyimg;
        $hidefrontendbuyprice = $options_row->hidefrontendbuyprice;
        $hidecolorboxbuyimg = $options_row->hidecolorboxbuyimg;
        $hidecolorboxbuyprice = $options_row->hidecolorboxbuyprice;
        $enablepurchase = $options_row->enablepurchase;
        $amazoncountryinfo = $options_row->amazoncountryinfo;
        $amazonaff = $options_row->amazonaff;



        $string1 = '<div id="wpgamelist-custom-libraries-container">
    <div class="wpgamelist-spinner" id="wpgamelist-spinner-2"></div>
        <table id="wpgamelist-jre-backend-options-table">
            <tbody>
              <tr>
                <td><label>Hide the Game Title</label></td>
                <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-1"';

                $string2 = '';
                if($hidetitlegame != null && $hidetitlegame != 0){
                    $string2 = esc_attr('checked="checked"');
                }

                $string3 = '></input></td>
                <td><label>Hide the Review Stars</label></td>
                <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-2"';

                $string4 = '';
                if($hidestarsgame != null && $hidestarsgame != 0){
                    $string4 = esc_attr('checked="checked"');
                } 

               $string5 = '></input></td>
              </tr>
              <tr>';

              $string63 = '<td><label>Hide the Facebook Share icon</label></td>
              <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-3"';
              if($hidefacebookshare != null && $hidefacebookshare != 0){
                $string63 = $string63.esc_attr('checked="checked"');
              }

              $string64 = '></input></td>';
  
              $string65 = '<td><label>Hide the Facebook Messenger icon</label></td>
              <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-4"';
              if($hidefacebookmessenger != null && $hidefacebookmessenger != 0){
                $string65 = $string65.esc_attr('checked="checked"');
              }

              $string66 = '></input></td>
              </tr>
              <tr>';

              $string6 = '<td><label>Hide the Twitter Share icon</label></td>
                <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-5"';
                if($hidetwitter != null && $hidetwitter != 0){
                    $string6 = $string6.esc_attr('checked="checked"');
                }

               $string7 = '></input></td>
            <td><label>Hide the Google+ Share icon</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-6"';

            $string8 = '';
            if($hidegoogleplus != null && $hidegoogleplus != 0){
                $string8 = esc_attr('checked="checked"');
            }

            $string9 = '></input></td>
              </tr>
              <tr>
             <td><label>Hide the Pinterest icon</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-7"';

            $string10 = '';
            if($hidepinterest != null && $hidepinterest != 0){
                $string10 = esc_attr('checked="checked"');
            }

            $string11 ='></input></td>
            <td><label>Hide the E-Mail Share icon</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-8"';

            $string12 = '';
            if($hideemail != null && $hideemail != 0){
                $string12 = esc_attr('checked="checked"');
            }

            $string13 = '></input></td>
            </tr>
              <tr>
            <td><label>Hide Game Page Link</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-9"';

            $string14 = '';
            if($hidegamepage != null && $hidegamepage != 0){
                $string14 = esc_attr('checked="checked"');
            }

            $string15 = '></input></td>
            <td><label>Hide Game Post Link</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-10"';

            $string16 = '';
            if($hidegamepost != null && $hidegamepost != 0){
                $string16 = esc_attr('checked="checked"');
            }

            $string17 = '></input></td>
            </tr>
              <tr>
            <td><label>Hide Game Finished</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-11"';

            $string18 = '';
            if($hidefinished != null && $hidefinished != 0){
                $string18 = esc_attr('checked="checked"');
            }
            $string19 = '></input></td>
            <td><label>Hide the Box Art Image</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-12"';

            $string20 = '';
            if($hidecoverimage != null && $hidecoverimage != 0){
                $string20 = esc_attr('checked="checked"');
            }

            $string21 = '></input></td>
            </tr>
              <tr>
            <td><label>Hide the Publisher</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-13"';

            $string22 = '';
            if($hidepublisher != null && $hidepublisher != 0){
                $string22 = esc_attr('checked="checked"');
            }

            $string23 = '></input></td>
            <td><label>Hide the Developer</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-14"';

            $string24 = '';
            if($hidedeveloper != null && $hidedeveloper != 0){
                $string24 = esc_attr('checked="checked"');
            }

            $string25 = '></input></td>
            </tr>
              <tr>
            <td><label>Hide the Genre</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-15"';

            $string26 = '';
            if($hidegenre != null && $hidegenre != 0){
                $string26 = esc_attr('checked="checked"');
            }

            $string27 = '></input></td>
            <td><label>Hide the Release Date</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-16"';

            $string28 = '';
            if($hidereleasedate != null && $hidereleasedate != 0){
                $string28 = esc_attr('checked="checked"');
            }
            
            $string29 = '></input></td>
            </tr>
              <tr>
            <td><label>Hide Series</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-17"';

            $string30 = '';
            if($hideseries != null && $hideseries != 0){
                $string30 = esc_attr('checked="checked"');
            }

            $string31 = '></input></td>
            <td><label>Hide Critic Rating</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-18"';

            $string32 = '';
            if($hidecriticrating != null && $hidecriticrating != 0){
                $string32 = esc_attr('checked="checked"');
            }

            $string33 = '></input></td>
            </tr>
            <tr>
            <td><label>Hide the IGDB Link</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-19"';

            $string34 = '';
            if($hideigdblink != null && $hideigdblink != 0){
                $string34 = esc_attr('checked="checked"');
            }

            $string35 = '></input></td>
            <td><label>Hide the Platform(s)</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-20"';

            $string36 = '';
            if($hideplatforms != null && $hideplatforms != 0){
                $string36 = esc_attr('checked="checked"');
            }

            $string37 = '></input></td>
            </tr>
             <tr>
            <td><label>Hide the Alt. Names</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-21"';

            $string38 = '';
            if($hidealtnames != null && $hidealtnames != 0){
              $string38 = esc_attr('checked="checked"');
            }

            $string39 = '></input></td>
            <td><label>Hide the Amazon Reviews</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-22"';

            $string40 = '';
            if($hideamazonreviews != null && $hideamazonreviews != 0){
              $string40 = esc_attr('checked="checked"');
            }

            $string41 = '></input></td>
            </tr>
             <tr>
            <td><label>Hide the Notes</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-23"';

            $string42 = '';
            if($hidenotes != null && $hidenotes != 0){
              $string42 = esc_attr('checked="checked"');
            }

            $string43 = '></input></td>
            <td><label>Hide the Description</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-24"';

            $string44 = '';
            if($hidedescription != null && $hidedescription != 0){
              $string44 = esc_attr('checked="checked"');
            }

            $string45 = '></input></td>
            </tr>
             <tr>
            <td><label>Hide Steam Link</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-25"';

            $string46 = '';
            if($hidesteampurchase != null && $hidesteampurchase != 0){
              $string46 = esc_attr('checked="checked"');
            }

            $string47 = '></input></td>
            <td><label>Hide eBay Link</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-26"';

            $string48 = '';
            if($hideebaypurchase != null && $hideebaypurchase != 0){
              $string48 = esc_attr('checked="checked"');
            }

            $string49 = '></input></td>
            </tr>
             <tr>
            <td><label>Hide Gamestop Link</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-27"';

            $string50 = '';
            if($hidegamestoppurchase != null && $hidegamestoppurchase != 0){
              $string50 = esc_attr('checked="checked"');
            }

            $string51 = '></input></td>
            <td><label>Hide Best Buy Link</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-28"';

            $string52 = '';
            if($hidebestbuypurchase != null && $hidebestbuypurchase != 0){
              $string52 = esc_attr('checked="checked"');
            }

            $string53 = '></input></td>
            </tr>
             <tr>
            <td><label>Hide Amazon Link</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-29"';

            $string54 = '';
            if($hideamazonpurchase != null && $hideamazonpurchase != 0){
              $string54 = esc_attr('checked="checked"');
            }

            $string55 = '';

            $string56 = '';

            $string67 = '></input></td><td><label>Hide Similar Titles & Products</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-30"';

            $string68 = '';
            if($hidesimilartitles != null && $hidesimilartitles != 0){
              $string68 = esc_attr('checked="checked"');
            }

            $string69 = '></input></td></tr><tr><td><label>Hide the Quote Area</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-31"';

            $string70 = '';
            if($hidequote != null && $hidequote != 0){
              $string70 = esc_attr('checked="checked"');
            }


            $string57 = '></input></td>';

            $hide_array = array($hidefrontendbuyimg,$hidefrontendbuyprice,$hidecolorboxbuyimg,$hidecolorboxbuyprice);

            if(has_filter('wpgamelist_add_to_post_display_options')) {
                $string57 = $string57.apply_filters('wpgamelist_add_to_post_display_options', $hide_array);
            }
            
            $string58 = '';

            $string59 = '</tbody></table>';

            $string60 = '<div id="wpgamelist-display-opt-check-div">
                            <label>Check All</label>
                            <input id="wpgamelist-check-all" type="checkbox" name="wpgamelist-input-32"/>
                            <label>Uncheck All</label>
                            <input id="wpgamelist-uncheck-all" type="checkbox" name="wpgamelist-input-33"/>
                        </div>';

            $string61 = '';
            if(has_filter('wpgamelist_append_to_display_options_post_enable_purchase')) {
                $string61 = apply_filters('wpgamelist_append_to_display_options_post_enable_purchase', $string61);
            }
        

        $string62 = '<button id="wpgamelist-save-post-backend" name="wpgamelist-input-34" type="button">Save Changes</button></div>';


        echo $string1.$string2.$string3.$string4.$string5.$string63.$string64.$string65.$string66.$string6.$string7.$string8.$string9.$string10.$string11.$string12.$string13.$string14.$string15.$string16.$string17.$string18.$string19.$string20.$string21.$string22.$string23.$string24.$string25.$string26.$string27.$string28.$string29.$string30.$string31.$string32.$string33.$string34.$string35.$string36.$string37.$string38.$string39.$string40.$string41.$string42.$string43.$string44.$string45.$string46.$string47.$string48.$string49.$string50.$string51.$string52.$string53.$string54.$string55.$string56.$string67.$string68.$string69.$string70.$string57.$string58.$string59.$string60.$string61.$string62;
        
    }


}

endif;