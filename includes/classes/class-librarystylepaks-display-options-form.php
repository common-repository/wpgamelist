<?php
/**
 * WPGameList LibraryStylePaks Display Options Form Tab Class
 *
 * @author   Jake Evans
 * @category Admin
 * @package  Includes/Classes
 * @version  1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPGameList_LibraryStylePaks_Display_Options_Form', false ) ) :
/**
 * WPGameList_Admin_Menu Class.
 **/
class WPGameList_LibraryStylePaks_Display_Options_Form {

    public static function output_add_edit_form(){
        global $wpdb;

        $table_name = $wpdb->prefix . 'wpgamelist_jre_list_dynamic_db_names';
        $db_row = $wpdb->get_results("SELECT * FROM $table_name");

        $table_name = $wpdb->prefix . 'wpgamelist_jre_user_options';
        $default = $wpdb->get_row("SELECT * FROM $table_name");

        if($default->stylepak == null || $default->stylepak == 'Default StylePak'){
            $default->stylepak = 'Default StylePak';
        }

        $string_table = '<div id="wpgamelist-stylepak-table-container">
                            <table>
                                <tr id="wpgamelist-stylepak-heading-row">
                                    <th>
                                        <img class="wpgamelist-stylepak-heading-img" src="'.GAMELIST_GAMELIST_ROOT_IMG_ICONS_URL.'library-options.svg"><div id="wpgamelist-stylepak-heading-left" class="wpgamelist-stylepak-table-heading">'.__('Library Name','wpgamelist').'</div>
                                    </th>
                                    <th>
                                        <img class="wpgamelist-stylepak-heading-img" src="'.GAMELIST_GAMELIST_ROOT_IMG_ICONS_URL.'librarystylepak.svg"><div class="wpgamelist-stylepak-table-heading">'.__('Active Library StylePak','wpgamelist').'</div>
                                    </th>
                                </tr>
                                <tr>
                                    <td class="wpgamelist-stylepaks-col1">
                                        <div class="wpgamelist-stylepak-table-lib"><span class="wpgamelist-stylepak-table-num">#1:</span>'.__('Default Library','wpgamelist').'</div>
                                    </td>
                                    <td>
                                        <div class="wpgamelist-stylepak-table-stylepak">'.ucfirst($default->stylepak).'</div>
                                    </td>
                                </tr>';

        foreach($db_row as $key=>$db){

            if($db->stylepak == null){
                $db->stylepak = ''.__('Default Library StylePak','wpgamelist').'';
            }

            $string_table = $string_table.'<tr>
                                            <td class="wpgamelist-stylepaks-col1">
                                                <div class="wpgamelist-stylepak-table-lib"><span class="wpgamelist-stylepak-table-num">#'.($key+2).':</SPAN> '.ucfirst($db->user_table_name).' '.__('Library','wpgamelist').'</div>
                                            </td>
                                            <td>
                                                <div class="wpgamelist-stylepak-table-stylepak">'.ucfirst($db->stylepak).'</div>
                                            </td>
                                        </tr>';
        }

        $string_table = $string_table.'</table></div>';



        $string1 = '<p class="wpgamelist-stylepak-page-center" style="text-align:center;">What\'s a <span class="wpgamelist-color-orange-italic">'.__('Library StylePak','wpgamelist').'</span> you ask? <span class="wpgamelist-color-orange-italic">'.__('Library StylePaks','wpgamelist').'</span> '.__('are the best way to instantly change the look and feel of your','wpgamelist').' <span class="wpgamelist-color-orange-italic">WPGameList</span> '.__('Libraries!','wpgamelist').'</p><p class="wpgamelist-stylepak-page-center">'.__('Simply','wpgamelist').' <a href="http://wpgamelist.com/index.php/stylepaks-2/">'.__('Purchase a $2 Library StylePak here','wpgamelist').'</a>, '.__('upload it using the','wpgamelist').' <span class="wpgamelist-color-orange-italic">\''.__('Upload a New Library StylePak','wpgamelist').'\'</span> '.__('button below, and assign your new Library StylePak to a Library - it\'s that simple!','wpgamelist').'</p>

            <div id="wpgamelist-stylepak-demo-links">
                <a href="http://wpgamelist.com/index.php/downloads/library-stylepak-1/">'.__('StylePak1 Demo','wpgamelist').'</a>
                <a href="http://wpgamelist.com/index.php/downloads/library-stylepak-2/">'.__('StylePak2 Demo','wpgamelist').'</a>
                <a href="http://wpgamelist.com/index.php/downloads/library-stylepak-3/">'.__('StylePak3 Demo','wpgamelist').'</a>
                <a href="http://wpgamelist.com/index.php/downloads/library-stylepak-4/">'.__('StylePak4 Demo','wpgamelist').'</a>
                <a href="http://wpgamelist.com/index.php/downloads/library-stylepak-5/">'.__('StylePak5 Demo','wpgamelist').'</a>
                <a href="http://wpgamelist.com/index.php/downloads/library-stylepak-6/">'.__('StylePak6 Demo','wpgamelist').'</a>
                <a href="http://wpgamelist.com/index.php/downloads/library-stylepak-7/">'.__('StylePak7 Demo','wpgamelist').'</a>
                <a href="http://wpgamelist.com/index.php/downloads/library-stylepak-8/">'.__('StylePak8 Demo','wpgamelist').'</a>
                <a href="http://wpgamelist.com/index.php/downloads/library-stylepak-9/">'.__('StylePak9 Demo','wpgamelist').'</a>
                <a href="http://wpgamelist.com/index.php/downloads/library-stylepak-10/">'.__('StylePak10 Demo','wpgamelist').'</a>
                <a href="http://wpgamelist.com/index.php/downloads/library-stylepak-11/">'.__('StylePak11 Demo','wpgamelist').'</a>
                <a href="http://wpgamelist.com/index.php/downloads/library-stylepak-12/">'.__('StylePak12 Demo','wpgamelist').'</a>
                <a href="http://wpgamelist.com/index.php/downloads/library-stylepak-13/">'.__('StylePak13 Demo','wpgamelist').'</a>
                <a href="http://wpgamelist.com/index.php/downloads/library-stylepak-14/">'.__('StylePak14 Demo','wpgamelist').'</a>
            </div>

            <div id="wpgamelist-stylepak-advert-cont">
                <div id="wpgamelist-buy-library-stylepaks-div">
                    <a id="wpgamelist-stylepak-buy-link" href="https://wpgamelist.com/index.php/downloads/stylepak-bundle-1/"><img src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'stylepakadvert1.jpg" /></a>
                </div>
                <div id="wpgamelist-buy-library-stylepaks-div">
                    <a id="wpgamelist-stylepak-buy-link" href="https://wpgamelist.com/index.php/downloads/stylepak-bundle-2/"><img src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'stylepakadvert2.jpg" /></a>
                </div>
                <div id="wpgamelist-buy-library-stylepaks-div">
                    <a id="wpgamelist-stylepak-buy-link" href="https://wpgamelist.com/index.php/downloads/ultimate-stylepak-bundle/"><img src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'stylepakadvert3.jpg" /></a>
                </div>
            </div>

            <div id="wpgamelist-upload-stylepaks-div">
                <input id="wpgamelist-add-new-library-stylepak" style="display:none;" type="file" name="files[]" multiple="">
                <button id="wpgamelist-add-new-library-stylepak-button" onclick="document.getElementById(\'wpgamelist-add-new-library-stylepak\').click();" name="add-library-stylepak" type="button">'.__('Upload a New Library StylePak','wpgamelist').'</button>
                    <div class="wpgamelist-spinner" id="wpgamelist-spinner-1"></div>
            </div>';

            $string2 = '<div id="wpgamelist-stylepak-select-stylepak-label">'.__('Select a Library StylePak:','wpgamelist').'</div>
                            <select id="wpgamelist-select-library-stylepak">    
                                <option selected disabled>'.__('Select a Library StylePak','wpgamelist').'</option>
                                <option value="Default StylePak">'.__('Default StylePak','wpgamelist').'</option>';

            foreach(glob(GAMELIST_GAMELIST_LIBRARY_STYLEPAKS_UPLOAD_DIR.'*.*') as $filename){
                $filename = basename($filename);
                $display_name = str_replace('.css', '', $filename);
                $display_name = str_replace('.zip', '', $display_name);
                if(strpos($filename, '.css') || strpos($filename, '.zip')){
                    $filename = str_replace('.zip', '', $filename);
                    $string2 = $string2.'<option id="'.$filename.'" value="'.$filename.'">'.$display_name.'</option>';
                }
            }

            $string2 = $string2.'</select>';

            $string3 = '<div id="wpgamelist-stylepak-select-library-label" for="wpgamelist-stylepak-select-library">Select a Library to Apply This StylePak to:</div>
                    <select class="wpgamelist-stylepak-select-default" id="wpgamelist-stylepak-select-library">
                        <option value="'.$wpdb->prefix.'wpgamelist_jre_saved_game_log">'.__('Default Library','wpgamelist').'</option> ';

                    $string4 = '';
                    foreach($db_row as $db){
                        if(($db->user_table_name != "") || ($db->user_table_name != null)){
                            $string4 = $string4.'<option value="'.$wpdb->prefix.'wpgamelist_jre_'.$db->user_table_name.'">'.ucfirst($db->user_table_name).'</option>';
                        }
                    }
            $string5 = '</select>
                        <button disabled id="wpgamelist-apply-library-stylepak">'.__('Apply Library StylePak','wpgamelist').'</button>
                        <div id="wpgamelist-addstylepak-success-div"></div>';


        echo $string1.$string_table.$string2.$string3.$string4.$string5;
    }


}

endif;