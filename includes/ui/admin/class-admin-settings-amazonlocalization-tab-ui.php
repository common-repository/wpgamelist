<?php
/**
 * WPGameList API Settings Tab
 *
 * @author   Jake Evans
 * @category Admin
 * @package  Includes/Classes
 * @version  1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPGameList_Amazon_Localization_Settings', false ) ) :
/**
 * WPGameList_Amazon_Localization_Settings Class.
 */
class WPGameList_Amazon_Localization_Settings {

    public function __construct() {
        require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-admin-ui-template.php');
        require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-amazonlocalization-settings-form.php');
        // Instantiate the class
        $this->template = new WPGameList_Admin_UI_Template;
        $this->form = new WPGameList_Amazon_Localization_Settings_Form;
        $this->output_open_admin_container();
        $this->output_tab_content();
        $this->output_close_admin_container();
        $this->output_admin_template_advert();
    }

    private function output_open_admin_container(){
        $title = __('Amazon Localization','wpgamelist');
        $icon_url = GAMELIST_GAMELIST_ROOT_IMG_ICONS_URL.'game-controller-3.svg';
        echo $this->template->output_open_admin_container($title, $icon_url);
    }

    private function output_tab_content(){
        echo $this->form->output_amazon_localization_settings_form();
    }

    private function output_close_admin_container(){
        echo $this->template->output_close_admin_container();
    }

    private function output_admin_template_advert(){
        echo $this->template->output_template_advert();
    }


}
endif;

// Instantiate the class
$cm = new WPGameList_Amazon_Localization_Settings;