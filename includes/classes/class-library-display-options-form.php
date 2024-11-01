<?php
/**
 * WPGameList Library Display Options Form Tab Class
 *
 * @author   Jake Evans
 * @category Admin
 * @package  Includes/Classes
 * @version  1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPGameList_Library_Display_Options_Form', false ) ) :
/**
 * WPGameList_Admin_Menu Class.
 */
class WPGameList_Library_Display_Options_Form {

    public static function output_add_edit_form(){
        global $wpdb;
        // Getting all user-created libraries
        $table_name = $wpdb->prefix . 'wpgamelist_jre_list_dynamic_db_names';
        $db_row = $wpdb->get_results("SELECT * FROM $table_name");

        // Getting the settings for the Default library
        $table_name = $wpdb->prefix . 'wpgamelist_jre_user_options';
        $options_row = $wpdb->get_row("SELECT * FROM $table_name");


        # All settings properties
        $hidetitlelibrary = $options_row->hidetitlelibrary;
        $hidetitlegame = $options_row->hidetitlegame;
        $hidesearch = $options_row->hidesearch;
        $hidesort = $options_row->hidesort;
        $hidestats = $options_row->hidestats;
        $hidequote = $options_row->hidequote;
        $hidestarsgame = $options_row->hidestarsgame;
        $hidestarslibrary = $options_row->hidestarslibrary;
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
        $sortoption = $options_row->sortoption;
        $gamesonpage = $options_row->gamesonpage;

       

        $string1 = '<div id="wpgamelist-custom-libraries-container">
                        <p id="wpgamelist-library-display-p">Select a Library to Apply These Display Options to</p>
                        <select id="wpgamelist-library-settings-select">
                            <option value="'.$wpdb->prefix.'wpgamelist_jre_saved_game_log">Default Library</option>';

        $string2 = '';
        foreach($db_row as $db){
            if(($db->user_table_name != "") || ($db->user_table_name != null)){
                $string2 = $string2.'<option value="'.$wpdb->prefix.'wpgamelist_jre_'.$db->user_table_name.'">'.ucfirst($db->user_table_name).'</option>';
            }
        }

        $string3 = '</select>
    <div class="wpgamelist-spinner" id="wpgamelist-spinner-2"></div>
        <table id="wpgamelist-jre-backend-options-table">
            <tbody>
              <tr>
                <td><label>Hide the Search area</label></td>
                <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-1"';

                $string4 = '';
                        if($hidesearch != null && $hidesearch != 0){
                            $string4 = esc_attr('checked="checked"');
                        }

                $string5 = '></input></td>
                <td><label>Hide the Sort Area</label></td>
                <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-2"';

                $string6 = '';
                if($hidesort != null && $hidesort != 0){
                    $string6 = esc_attr('checked="checked"');
                } 

               $string7 = '></input></td>
              </tr>
              <tr>
                <td><label>Hide the Stats Area</label></td>
                <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-3"';

                $string8 = '';
                if($hidestats != null && $hidestats != 0){
                    $string8 = esc_attr('checked="checked"');
                }
                
               $string9 = '></input></td>
            <td><label>Hide the Game Title (Library View)</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-4"';

            $string10 = '';
            if($hidetitlelibrary != null && $hidetitlelibrary != 0){
                $string10 = esc_attr('checked="checked"');
            }

            $string11 = '></input></td>
              </tr>
              <tr>
             <td><label>Hide the Game Title (Game View)</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-5"';

            $string12 = '';
            if($hidetitlegame != null && $hidetitlegame != 0){
                $string12 = esc_attr('checked="checked"');
            }

            $string13 ='></input></td>
            <td><label>Hide the Review Stars (Library View)</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-6"';

            $string14 = '';
            if($hidestarslibrary != null && $hidestarslibrary != 0){
                $string14 = esc_attr('checked="checked"');
            }

            $string15 = '></input></td>
            </tr>
              <tr>
            <td><label>Hide the Review Stars (Game View)</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-7"';

            $string16 = '';
            if($hidestarsgame != null && $hidestarsgame != 0){
                $string16 = esc_attr('checked="checked"');
            }

            $string17 = '></input></td>
            <td><label>Hide the Facebook Share icon</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-8"';

            $string18 = '';
            if($hidefacebookshare != null && $hidefacebookshare != 0){
                $string18 = esc_attr('checked="checked"');
            }

            $string19 = '></input></td>
            </tr>
              <tr>
            <td><label>Hide the Facebook Messenger icon</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-9"';

            $string20 = '';
            if($hidefacebookmessenger != null && $hidefacebookmessenger != 0){
                $string20 = esc_attr('checked="checked"');
            }
            

            $string21 = '></input></td>
            <td><label>Hide the Twitter Share icon</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-10"';

            $string22 = '';
            if($hidetwitter != null && $hidetwitter != 0){
                $string22 = esc_attr('checked="checked"');
            }

            $string23 = '></input></td>
            </tr>
              <tr>
            <td><label>Hide the Google+ icon</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-11"';

            $string24 = '';
            if($hidegoogleplus != null && $hidegoogleplus != 0){
                $string24 = esc_attr('checked="checked"');
            }

            $string25 = '></input></td>
            <td><label>Hide the Pinterest icon</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-12"';

            $string26 = '';
            if($hidepinterest != null && $hidepinterest != 0){
                $string26 = esc_attr('checked="checked"');
            }

            $string27 = '></input></td>
            </tr>
              <tr>
            <td><label>Hide the E-Mail Share icon</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-13"';

            $string28 = '';
            if($hideemail != null && $hideemail != 0){
                $string28 = esc_attr('checked="checked"');
            }

            $string29 = '></input></td>
            <td><label>Hide Game Page link</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-14"';

            $string30 = '';
            if($hidegamepage != null && $hidegamepage != 0){
                $string30 = esc_attr('checked="checked"');
            }

            $string31 = '></input></td>
            </tr>
              <tr>
            <td><label>Hide the Game Post link </label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-15"';

            $string32 = '';
            if($hidegamepost != null && $hidegamepost != 0){
                $string32 = esc_attr('checked="checked"');
            }

            $string33 = '></input></td>
            <td><label>Hide Game Finished</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-16"';

            $string34 = '';
            if($hidefinished != null && $hidefinished != 0){
                $string34 = esc_attr('checked="checked"');
            }

            $string35 = '></input></td>
            </tr>
            <tr>
            <td><label>Hide the Box Art image (Game View)</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-17"';

            $string36 = '';
            if($hidecoverimage != null && $hidecoverimage != 0){
                $string36 = esc_attr('checked="checked"');
            }

            $string37 = '></input></td>
            <td><label>Hide the Publisher</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-18"';

            $string38 = '';
            if($hidepublisher != null && $hidepublisher != 0){
                $string38 = esc_attr('checked="checked"');
            }

            $string39 = '></input></td>
            </tr>
             <tr>
            <td><label>Hide the Developer</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-19"';

            $string40 = '';
            if($hidedeveloper != null && $hidedeveloper != 0){
              $string40 = esc_attr('checked="checked"');
            }

            $string41 = '></input></td>
            <td><label>Hide the Genre</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-20"';

            $string42 = '';
            if($hidegenre != null && $hidegenre != 0){
              $string42 = esc_attr('checked="checked"');
            }

            $string43 = '></input></td>
            </tr>
             <tr>
            <td><label>Hide the Release Date</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-21"';

            $string44 = '';
            if($hidereleasedate != null && $hidereleasedate != 0){
              $string44 = esc_attr('checked="checked"');
            }

            $string45 = '></input></td>
            <td><label>Hide Series</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-22"';

            $string46 = '';
            if($hideseries != null && $hideseries != 0){
              $string46 = esc_attr('checked="checked"');
            }

            $string47 = '></input></td>
            </tr>
             <tr>
            <td><label>Hide Critic Rating</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-23"';

            $string48 = '';
            if($hidecriticrating != null && $hidecriticrating != 0){
              $string48 = esc_attr('checked="checked"');
            }

            $string49 = '></input></td>
            <td><label>Hide the IGDB Link</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-24"';

            $string50 = '';
            if($hideigdblink != null && $hideigdblink != 0){
              $string50 = esc_attr('checked="checked"');
            }

            $string51 = '></input></td>
            </tr>
             <tr>
            <td><label>Hide the Platform(s)</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-25"';

            $string52 = '';
            if($hideplatforms != null && $hideplatforms != 0){
              $string52 = esc_attr('checked="checked"');
            }

            $string53 = '></input></td>
            <td><label>Hide the Alt. Names</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-26"';

            $string54 = '';
            if($hidealtnames != null && $hidealtnames != 0){
              $string54 = esc_attr('checked="checked"');
            }

            $string55 = '></input></td>
            </tr>
             <tr>
            <td><label>Hide the Amazon Reviews</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-27"';

            $string56 = '';
            if($hideamazonreviews != null && $hideamazonreviews != 0){
              $string56 = esc_attr('checked="checked"');
            }

            $string253 = '></input></td>
            <td><label>Hide the Notes</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-28"';

            $string254 = '';
            if($hidenotes != null && $hidenotes != 0){
              $string254 = esc_attr('checked="checked"');
            }

            $string255 = '></input></td>
            </tr>
             <tr>
            <td><label>Hide the Description</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-29"';

            $string256 = '';
            if($hidedescription != null && $hidedescription != 0){
              $string256 = esc_attr('checked="checked"');
            }

            $string57 = '></input></td>
            <td><label>Hide Steam Link</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-30"';

            $string58 = '';
            if($hidesteampurchase != null && $hidesteampurchase != 0){
              $string58 = esc_attr('checked="checked"');
            }

            $string59 = '></input></td>
            </tr>
              <tr>
            <td><label>Hide the eBay Link</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-31"';

            $string60 = '';
            if($hideebaypurchase != null && $hideebaypurchase != 0){
                $string60 = esc_attr('checked="checked"');
            }

            $string61 = '></input></td>
            <td><label>Hide the Gamestop Link</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-32"';

            $string62 = '';
            if($hidegamestoppurchase != null && $hidegamestoppurchase != 0){
                $string62 = esc_attr('checked="checked"');
            }

            $string63 = '></input></td>
            </tr>
              <tr>
            <td><label>Hide the Best Buy Link</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-33"';

            $string64 = '';
            if($hidebestbuypurchase != null && $hidebestbuypurchase != 0){
                $string64 = esc_attr('checked="checked"');
            }

            $string65 = '></input></td>
            <td><label>Hide the Amazon Link</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-34"';

            $string66 = '';
            if($hideamazonpurchase != null && $hideamazonpurchase != 0){
                $string66 = esc_attr('checked="checked"');
            }

            $string67 = '></input></td>
            </tr>
            <tr>';

            $string100 = '<td><label>Hide Similar Title & Products</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-35"';
            if($hidesimilartitles != null && $hidesimilartitles != 0){
                $string100 = $string100.esc_attr('checked="checked"');
            }

            $string101 = '></input></td>';

            $string102 = '<td><label>Hide the Quote Area</label></td>
            <td class="wpgamelist-margin-right-td"><input type="checkbox" name="wpgamelist-input-36"';

            $string103 = '';
            if($hidequote != null && $hidequote != 0){
                $string103 = $string103.esc_attr('checked="checked"');
            }
            
            $string103 = $string103.'></input></td>
            </tr>
            <tr>';
 

            $hide_array = array($hidefrontendbuyimg,$hidefrontendbuyprice,$hidecolorboxbuyimg,$hidecolorboxbuyprice);

            $string77 = '';
            if(has_filter('wpgamelist_add_to_library_display_options')) {
                $string77 = $string77.apply_filters('wpgamelist_add_to_library_display_options', $hide_array);
            }

/*
            if(has_filter('wpgamelist_add_to_library_display_options_kindle')) {
                $string77 = $string77.apply_filters('wpgamelist_add_to_library_display_options_kindle', $hidekindle);
            }

            if(has_filter('wpgamelist_add_to_library_display_options_google')) {
                $string77 = $string77.apply_filters('wpgamelist_add_to_library_display_options_google', $hidegoogle);
            }
*/
            $string78 = '</tbody></table>';

            $string79 = '<div id="wpgamelist-display-opt-check-div">
                            <label>Check All</label>
                            <input id="wpgamelist-check-all" type="checkbox" name="wpgamelist-input-37"/>
                            <label>Uncheck All</label>
                            <input id="wpgamelist-uncheck-all" type="checkbox" name="wpgamelist-input-38"/>
                        </div>';

            $string80 ='<table id="wpgamelist-library-options-lower-table"><tbody><tr>';

            if(has_filter('wpgamelist_append_to_display_options_library_enable_purchase')) {
                $string80 = apply_filters('wpgamelist_append_to_display_options_library_enable_purchase', $string80);
            }

              $string83 = '</tr><tr>
              <td class="wpgamelist-display-bottom-4"><label>Set Default Sorting</label></td>
              <td class="wpgamelist-display-bottom-4">
                <select name="wpgamelist-input-39" id="wpgamelist-jre-sorting-select"><option ';

                  $string84 = '';
                  if ($sortoption == 'default'){ 
                    $string84 = 'selected="selected"'; 
                  }   

                  $string85 = 'value="default">Default</option>
                  <option ';

                  $string86 = '';
                  if ($sortoption == 'alphabetically'){
                   $string86 = 'selected="selected"'; 
                  }   

                  $string87 = 'value="alphabetically">Alphabetically</option>
                  <option ';

                  $string88 = '';
                  if ($sortoption == 'year_read'){
                   $string88 = 'selected="selected"'; 
                  }

                  $string89 = 'value="year_read">Year Finished</option>
                  <option ';

                  $string90 = '';
                  if ($sortoption == 'pages_desc'){
                   $string90 = 'selected="selected"'; 
                  }   

                  $string91 = 'value="pages_desc">Pages (Descending)</option>
                  <option ';

                  $string92 = '';
                  if ($sortoption == 'pages_asc'){
                   $string92 = 'selected="selected"'; 
                  }   

                  $string93 = 'value="pages_asc">Pages (Ascending)</option>
                  <option '; 

                  $string94 = '';
                  if ($sortoption == 'signed'){
                    $string94 = 'selected="selected"'; 
                  }

                  $string95 = 'value="signed">Signed</option>
                  <option ';

                  $string96 = '';
                  if ($sortoption == 'first_edition'){
                   $string96 = 'selected="selected"'; 
                  }

                  $string97 = 'value="first_edition">First Edition</option>
                </select><br/>
              </td>
            </tr>';


            $string98 = '<tr>
                <td class="wpgamelist-display-bottom-4"><label>Set Games Per Page</label></td>
                <td class="wpgamelist-display-bottom-4"><input class="wpgamelist-dynamic-input" id="wpgamelist-game-control" type="text" name="wpgamelist-input-40" value="'.esc_attr($gamesonpage).'"></input></td>
            </tr></tbody></table>';

            $string99 = '<button id="wpgamelist-save-backend" name="wpgamelist-input-41" type="button">Save Changes</button></div>';


        echo $string1.$string2.$string3.$string4.$string5.$string6.$string7.$string8.$string9.$string10.$string11.$string12.$string13.$string14.$string15.$string16.$string17.$string18.$string19.$string20.$string21.$string22.$string23.$string24.$string25.$string26.$string27.$string28.$string29.$string30.$string31.$string32.$string33.$string34.$string35.$string36.$string37.$string38.$string39.$string40.$string41.$string42.$string43.$string44.$string45.$string46.$string47.$string48.$string49.$string50.$string51.$string52.$string53.$string54.$string55.$string56.$string253.$string254.$string255.$string256.$string57.$string58.$string59.$string60.$string61.$string62.$string63.$string64.$string65.$string66.$string67.$string100.$string101.$string102.$string103.$string78.$string79.$string80.$string83.$string84.$string85.$string86.$string87.$string88.$string89.$string90.$string91.$string92.$string93.$string94.$string95.$string96.$string97.$string98.$string99;
        
    }

//$string53.$string54.$string55.$string56
}

endif;