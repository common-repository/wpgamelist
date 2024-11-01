<?php
/**
 * WPGameList PostTemplates Display Options Form Tab Class
 *
 * @author   Jake Evans
 * @category Admin
 * @package  Includes/Classes
 * @version  1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPGameList_PostTemplates_Display_Options_Form', false ) ) :
/**
 * WPGameList_Admin_Menu Class.
 **/
class WPGameList_PostTemplates_Display_Options_Form {

    public static function output_add_edit_form(){
        global $wpdb;

        $table_name = $wpdb->prefix . 'wpgamelist_jre_user_options';
        $default = $wpdb->get_row("SELECT * FROM $table_name");

        if($default->activeposttemplate == null || $default->activeposttemplate == 'Default'){
            $default->activeposttemplate = 'Default Post Template';
        }

        $default->activeposttemplate = str_replace('Post-', 'Post ', $default->activeposttemplate);
        $default->activeposttemplate = str_replace('Template-', 'Template ', $default->activeposttemplate);

        $string_table = '<div id="wpgamelist-stylepak-table-container">
                            <table>
                                <tr id="wpgamelist-stylepak-heading-row">
                                    <th>
                                        <img class="wpgamelist-stylepak-heading-img" src="'.GAMELIST_GAMELIST_ROOT_IMG_ICONS_URL.'game-controller.svg"><div class="wpgamelist-stylepak-table-heading">Active Post Template</div>
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="wpgamelist-stylepak-table-stylepak">'.ucfirst($default->activeposttemplate).'</div>
                                    </td>
                                </tr>';


        $string_table = $string_table.'</table></div>';



        $string1 = '<p>What\'s a <span class="wpgamelist-color-orange-italic">Post Template</span> you ask? <span class="wpgamelist-color-orange-italic">Post Templates</span> are the best way to instantly change the look and feel of your <span class="wpgamelist-color-orange-italic">WPGameList</span> Posts!</p><p>Simply <a href="https://wpgamelist.com/index.php/templates-2/">Purchase a $2 Post Template Here</a>, upload it using the <span class="wpgamelist-color-orange-italic">\'Upload a New Post Template\'</span>&nbsp;button below, and assign your new Post Template to your WPGameList Posts - it\'s that simple!</p>

            <div id="wpgamelist-stylepak-demo-links">
                <a href="https://wpgamelist.com/index.php/downloads/template-pak-1/">Post Template 1</a>
                <a href="https://wpgamelist.com/index.php/downloads/template-pak-2/">Post Template 2</a>
                <a href="https://wpgamelist.com/index.php/downloads/template-pak-3/">Post Template 3</a>
                <a href="https://wpgamelist.com/index.php/downloads/template-pak-4/">Post Template 4</a>
                <a href="https://wpgamelist.com/index.php/downloads/template-pak-5/">Post Template 5</a>
            </div>

            <div id="wpgamelist-buy-library-stylepaks-div">
                <a id="wpgamelist-stylepak-buy-link" href="https://wpgamelist.com/index.php/templates-2/"><img src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'getposttemplates.png" /></a>
            </div>

            <div id="wpgamelist-upload-stylepaks-div">
                <input id="wpgamelist-add-new-post-template" style="display:none;" type="file" name="files[]" multiple="">
                <button onclick="document.getElementById(\'wpgamelist-add-new-post-template\').click();" name="add-library-stylepak" type="button">Upload a New Post Template</button>
                    <div class="wpgamelist-spinner" id="wpgamelist-spinner-1"></div>
            </div>';

            $string2 = '<div id="wpgamelist-stylepak-select-stylepak-label">Select a Post Template To Apply to Your WPGameList Posts:</div>
                            <select id="wpgamelist-select-post-template">    
                                <option selected disabled>Select a Post Template</option>
                                <option value="Default Template">Default Post Template</option>';

            foreach(glob(GAMELIST_GAMELIST_POST_TEMPLATES_UPLOAD_DIR.'*.*') as $filename){
                $filename = basename($filename);
                if((strpos($filename, '.php') || strpos($filename, '.zip')) && strpos($filename, 'Post') !== false){
                    $display_name = str_replace('.php', '', $filename);
                    $display_name = str_replace('-', ' ', $display_name);
                    $display_name = str_replace('Post-', 'Post ', $display_name);
                    $string2 = $string2.'<option id="'.$filename.'" value="'.$filename.'">'.$display_name.'</option>';
                }
            }

            $string3 = '</select><button disabled id="wpgamelist-apply-post-template">Apply Post Template</button>
                        <div id="wpgamelist-addtemplate-success-div"></div>';


        echo $string1.$string_table.$string2.$string3;
    }


}

endif;