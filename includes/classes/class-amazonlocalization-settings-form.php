<?php
/**
 * WPGameList Custom Libraries Form Tab Class
 *
 * @author   Jake Evans
 * @category Admin
 * @package  Includes/Classes
 * @version  1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPGameList_Amazon_Localization_Settings_Form', false ) ) :
/**
 * WPGameList_Admin_Menu Class.
 */
class WPGameList_Amazon_Localization_Settings_Form {

  public static function output_amazon_localization_settings_form(){
    global $wpdb;

    $table_name = $wpdb->prefix . 'wpgamelist_jre_user_options';
        $options_row = $wpdb->get_row("SELECT * FROM $table_name");

    $string1 = '<div id="wpgamelist-amazon_localization-settings-container">
            <p>Choose what countries\' Amazon information you\'d like to display below, and<span class="wpgamelist-color-orange-italic">WPGameList</span> will show Amazon Reviews and Links from that country only.</p>';

    $string2 = '<table class="wpgamelist-jre-backend-localization-table">
              <tbody>
                <tr>
                  <td><label>US-Based Amazon Info</label></td>
                  <td><input ';

                  $string3 = '';
                  if($options_row->amazoncountryinfo == 'US'){
                    $string3 = 'checked ';
                  }

                 $string4 = 'class="wpgamelist-localization-checkbox" value="us" type="checkbox" name="us-based-game-info"></td>
                  <td><label>UK-Based Amazon Info</label></td>
                  <td><input ';

                  $string5 = '';
                  if($options_row->amazoncountryinfo == 'uk'){
                    $string5 = 'checked ';
                  }


                $string6 = 'class="wpgamelist-localization-checkbox" value="uk" type="checkbox" name="uk-based-game-info"></td>
                </tr>
                <tr>
                  <td><label>Australia-Based Amazon Info</label></td>
                  <td><input ';

                  $string7 = '';
                  if($options_row->amazoncountryinfo == 'au'){
                    $string7 = 'checked ';
                  }


                $string8 = 'class="wpgamelist-localization-checkbox" value="au" type="checkbox" name="au-based-game-info"></td>
                  <td><label>Brazil-Based Amazon Info</label></td>
                  <td><input ';

                  $string9 = '';
                  if($options_row->amazoncountryinfo == 'br'){
                    $string9 = 'checked ';
                  }

                  $string10 = 'class="wpgamelist-localization-checkbox" value="br" type="checkbox" name="br-based-game-info"></td>
                </tr>
                <tr>
                  <td><label>Canada-Based Amazon Info</label></td>
                  <td><input ';

                  $string11 = '';
                  if($options_row->amazoncountryinfo == 'ca'){
                    $string11 = 'checked ';
                  }

                $string12 = 'class="wpgamelist-localization-checkbox" value="ca" type="checkbox" name="ca-based-game-info"></td>
                  <td><label>China-Based Amazon Info</label></td>
                  <td><input ';

                  $string13 = '';
                  if($options_row->amazoncountryinfo == 'cn'){
                    $string13 = 'checked ';
                  }

                $string14 = 'class="wpgamelist-localization-checkbox" value="cn" type="checkbox" name="cn-based-game-info"></td>
                </tr>
                <tr>
                  <td><label>France-Based Amazon Info</label></td>
                  <td><input ';

                  $string15 = '';
                  if($options_row->amazoncountryinfo == 'fr'){
                    $string15 = 'checked ';
                  }

                  $string16 = 'class="wpgamelist-localization-checkbox" value="fr" type="checkbox" name="fr-based-game-info"></td>
                  <td><label>Germany-Based Amazon Info</label></td>
                  <td><input ';

                  $string17 = '';
                  if($options_row->amazoncountryinfo == 'de'){
                    $string17 = 'checked ';
                  }

                $string18 = 'class="wpgamelist-localization-checkbox" value="de" type="checkbox" name="de-based-game-info"></td>
                </tr>
                <tr>
                  <td><label>India-Based Amazon Info</label></td>
                  <td><input ';

                  $string19 = '';
                  if($options_row->amazoncountryinfo == 'in'){
                    $string19 = 'checked ';
                  }

                  $string20 = 'class="wpgamelist-localization-checkbox" value="in" type="checkbox" name="in-based-game-info"></td>
                  <td><label>Italy-Based Amazon Info</label></td>
                  <td><input ';

                  $string21 = '';
                  if($options_row->amazoncountryinfo == 'it'){
                    $string21 = 'checked ';
                  }

                  $string22 = 'class="wpgamelist-localization-checkbox" value="it" type="checkbox" name="it-based-game-info"></td>
                </tr>
                <tr>
                  <td><label>Japan-Based Amazon Info</label></td>
                  <td><input ';

                  $string23 = '';
                  if($options_row->amazoncountryinfo == 'jp'){
                    $string23 = 'checked ';
                  }

                  $string24 = 'class="wpgamelist-localization-checkbox" value="jp" type="checkbox" name="jp-based-game-info"></td>
                  <td><label>Mexico-Based Amazon Info</label></td>
                  <td><input ';

                  $string25 = '';
                  if($options_row->amazoncountryinfo == 'mx'){
                    $string25 = 'checked ';
                  }

                  $string26 = 'class="wpgamelist-localization-checkbox" value="mx" type="checkbox" name="mx-based-game-info"></td>
                </tr>
                <tr>
                  <td><label>Netherlands-Based Amazon Info</label></td>
                  <td><input ';

                  $string27 = '';
                  if($options_row->amazoncountryinfo == 'nl'){
                    $string27 = 'checked ';
                  }

                  $string28 = 'class="wpgamelist-localization-checkbox" value="nl" type="checkbox" name="nl-based-game-info"></td>
                  <td><label>Spain-Based Amazon Info</label></td>
                  <td><input ';

                  $string29 = '';
                  if($options_row->amazoncountryinfo == 'es'){
                    $string29 = 'checked ';
                  }

                  $string30 = 'class="wpgamelist-localization-checkbox" value="es" type="checkbox" name="es-based-game-info"></td>
                </tr>
              </tbody>
            </table>';

    $string31 = '<button id="wpgamelist-save-localization" name="save-backend-localization" type="button">Save Changes</button><div id="wpgamelist-addamazon_localization-success-div"></div></div>';

    echo $string1.$string2.$string3.$string4.$string5.$string6.$string7.$string8.$string9.$string10.$string11.$string12.$string13.$string14.$string15.$string16.$string17.$string18.$string19.$string20.$string21.$string22.$string23.$string24.$string25.$string26.$string27.$string28.$string29.$string30.$string31;

  }


}

endif;