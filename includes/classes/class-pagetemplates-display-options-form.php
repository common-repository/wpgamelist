<?php
/**
 * WPGameList PageTemplates Display Options Form Tab Class
 *
 * @author   Jake Evans
 * @category Admin
 * @package  Includes/Classes
 * @version  1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPGameList_PageTemplates_Display_Options_Form', false ) ) :
/**
 * WPGameList_Admin_Menu Class.
 **/
class WPGameList_PageTemplates_Display_Options_Form {

    public static function output_add_edit_form(){
        global $wpdb;

        $table_name = $wpdb->prefix . 'wpgamelist_jre_user_options';
        $default = $wpdb->get_row("SELECT * FROM $table_name");

        if($default->activepagetemplate == null || $default->activepagetemplate == 'Default'){
            $default->activepagetemplate = 'Default Page Template';
        }

        $default->activepagetemplate = str_replace('Page-', 'Page ', $default->activepagetemplate);
        $default->activepagetemplate = str_replace('Template-', 'Template ', $default->activepagetemplate);

        $string_table = '<div id="wpgamelist-stylepak-table-container">
                            <table>
                                <tr id="wpgamelist-stylepak-heading-row">
                                    <th>
                                        <img class="wpgamelist-stylepak-heading-img" src="'.GAMELIST_GAMELIST_ROOT_IMG_ICONS_URL.'game-controller.svg"><div class="wpgamelist-stylepak-table-heading">Active Page Template</div>
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="wpgamelist-stylepak-table-stylepak">'.ucfirst($default->activepagetemplate).'</div>
                                    </td>
                                </tr>';


        $string_table = $string_table.'</table></div>';



        $string1 = '<p>What\'s a <span class="wpgamelist-color-orange-italic">Page Template</span> you ask? <span class="wpgamelist-color-orange-italic">Page Templates</span> are the best way to instantly change the look and feel of your <span class="wpgamelist-color-orange-italic">WPGameList</span> Pages!</p><p>Simply <a href="https://wpgamelist.com/index.php/templates-2/">Purchase a $2 Page Template Here</a>, upload it using the <span class="wpgamelist-color-orange-italic">\'Upload a New Page Template\'</span>&nbsp;button below, and assign your new Page Template to your WPGameList Pages - it\'s that simple!</p>

            <div id="wpgamelist-stylepak-demo-links">
                <a href="https://wpgamelist.com/index.php/downloads/template-pak-1/">Page Template 1</a>
                <a href="https://wpgamelist.com/index.php/downloads/template-pak-2/">Page Template 2</a>
                <a href="https://wpgamelist.com/index.php/downloads/template-pak-3/">Page Template 3</a>
                <a href="https://wpgamelist.com/index.php/downloads/template-pak-4/">Page Template 4</a>
                <a href="https://wpgamelist.com/index.php/downloads/template-pak-5/">Page Template 5</a>
            </div>

            <div id="wpgamelist-buy-library-stylepaks-div">
                <a id="wpgamelist-stylepak-buy-link" href="https://wpgamelist.com/index.php/templates-2/"><img src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'getpagetemplates.png" /></a>
            </div>

            <div id="wpgamelist-upload-stylepaks-div">
                <input id="wpgamelist-add-new-page-template" style="display:none;" type="file" name="files[]" multiple="">
                <button onclick="document.getElementById(\'wpgamelist-add-new-page-template\').click();" name="add-library-stylepak" type="button">Upload a New Page Template</button>
                    <div class="wpgamelist-spinner" id="wpgamelist-spinner-1"></div>
            </div>';

            $string2 = '<div id="wpgamelist-stylepak-select-stylepak-label">Select a Page Template To Apply to Your WPGameList Pages:</div>
                            <select id="wpgamelist-select-page-template">    
                                <option selected disabled>Select a Page Template</option>
                                <option value="Default Template">Default Page Template</option>';

            foreach(glob(GAMELIST_GAMELIST_PAGE_TEMPLATES_UPLOAD_DIR.'*.*') as $filename){
                $filename = basename($filename);
                if((strpos($filename, '.php') || strpos($filename, '.zip')) && strpos($filename, 'Page') !== false){
                    $display_name = str_replace('.php', '', $filename);
                    $display_name = str_replace('Template-', 'Template ', $display_name);
                    $display_name = str_replace('Page-', 'Page ', $display_name);
                    $string2 = $string2.'<option id="'.$filename.'" value="'.$filename.'">'.$display_name.'</option>';
                }
            }

            $string3 = '</select><button disabled id="wpgamelist-apply-page-template">Apply Page Template</button>
                        <div id="wpgamelist-addtemplate-success-div"></div>';


        echo $string1.$string_table.$string2.$string3;
    }


}

endif;