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

if ( ! class_exists( 'WPGameList_Api_Settings_Form', false ) ) :
/**
 * WPGameList_Admin_Menu Class.
 */
class WPGameList_Api_Settings_Form {

	public static function output_api_settings_form(){
		global $wpdb;
		$table_name = $wpdb->prefix . 'wpgamelist_jre_user_options';
		$options_row = $wpdb->get_row("SELECT * FROM $table_name");

		$string1 = '<div id="wpgamelist-api-settings-container">
						<p><span class="wpgamelist-color-orange-italic">WPGameList</span> comes pre-loaded with a default <a href="https://www.igdb.com/discover">IGDB</a> API key, but if you\'d rather use your own, simply enter it in the field below and click <span class="wpgamelist-color-orange-italic">\'Save API Settings\'</span>.</p>';

		$string2 = '<table>
            			<tbody>';

							$string3 = '<tr>
								<td>
									<label for="amazon-api-public">IGDB API Key</label>
									<input placeholder="Paste API Key Here..."';

									$string4 = '';
									if($options_row->amazonapipublic != null){
										$string4 = 'value="'.$options_row->amazonapipublic.'"';
									}

									$string5 = ' id="wpgamelist-amazon-api-public" name="amazon-api-public" type="text" />
									<a href="https://api.igdb.com/" class="wpgamelist-api-get-link">Get IGDB API Key</a>
								</td>
							</tr>';

							$string6 = '<tr>
								<td>
									<label for="amazon-api-secret">Amazon Secret Key</label>
									<input placeholder="Paste API Key Here..."';

									$string7 = '';


									$string8 = 'id="wpgamelist-amazon-api-secret" name="amazon-api-secret" type="text" />
									<a href="https://affiliate-program.amazon.com/assoc_credentials/home?openid.assoc_handle=amzn_associates_us&aToken=Atza%7CIwEBIFY4PNTc_kAMxJJnxo_Ek0gpK6WDvxFLfiHsHYtrwerqfugUKQNvzE_nxCgl9n_x1yRELr8_lQxHcmOjJkUG2zex61d-XYCuP559ilYGVeg47nLxtWLZzso8h9lC_6Ws1SWdYPYr8pJN2iybknX0hBk_XSgshu4MRLf5zYpWjrH2RtbgRs43eISurd7VMy0UGQkYxn1AHEqwEMLEieWQx6PJbr7fFYrItqTDzijc5dsZaPZYWJ4FeX4EzS7hpt_SWs0pcEyzbvbqSa-hUAUoCoTZoG2j3T7uEBeZ7-5UNfsIeqPFfzZtjtRTFbLkaHRUXadfxO3RMmSRdVoC1frvcOIfyWAwxXx1phVssvH3fzhmi7TxT_asfLiJeaEDepf4UcdSu03PBQAQ6HMbb4PFhchX&openid.claimed_id=https%3A%2F%2Fwww.amazon.com%2Fap%2Fid%2Famzn1.account.AH72MNZJ2ZDMZPDOZWUK4KTQBOJA&openid.identity=https%3A%2F%2Fwww.amazon.com%2Fap%2Fid%2Famzn1.account.AH72MNZJ2ZDMZPDOZWUK4KTQBOJA&openid.mode=id_res&openid.ns=http%3A%2F%2Fspecs.openid.net%2Fauth%2F2.0&openid.op_endpoint=https%3A%2F%2Fwww.amazon.com%2Fap%2Fsignin&openid.response_nonce=2017-08-29T21%3A04%3A06Z8240409384152911475&openid.return_to=https%3A%2F%2Faffiliate-program.amazon.com%2Fassoc_credentials%2Fhome&openid.signed=assoc_handle%2CaToken%2Cclaimed_id%2Cidentity%2Cmode%2Cns%2Cop_endpoint%2Cresponse_nonce%2Creturn_to%2Cns.pape%2Cpape.auth_policies%2Cpape.auth_time%2Csigned&openid.ns.pape=http%3A%2F%2Fspecs.openid.net%2Fextensions%2Fpape%2F1.0&openid.pape.auth_policies=http%3A%2F%2Fschemas.openid.net%2Fpape%2Fpolicies%2F2007%2F06%2Fnone&openid.pape.auth_time=2017-08-29T21%3A04%3A06Z&openid.sig=A%2FXU49pRFfJPVL6ToHSqMMqlwfV%2Fr%2BZsLgHVQeNBnE4%3D&serial=&" class="wpgamelist-api-get-link">Get Amazon API Keys</a>
								</td>
							</tr>';

							$string9 = '<tr>
								<td>
									<label for="google-api">Google Games API Key</label>
									<input placeholder="Paste API Key Here..."';

									$string10 = '';


									$string11 = ' id="wpgamelist-google-api" name="google-api" type="text" />
									<a href="https://developers.google.com/games/docs/v1/using#APIKey" class="wpgamelist-api-get-link">Get Google API Keys</a>
								</td>
							</tr>';

							$string12 = '<tr>
								<td>
									<label for="igames-api">Apple iGames API Key</label>
									<input placeholder="Paste API Key Here..."';

									$string13 = '';

									$string14 = ' id="wpgamelist-igames-api" name="igames-api" type="text" />
									<a href="" class="wpgamelist-api-get-link">Get Apple iGames API Keys</a>
								</td>
							</tr>';

							$string15 = '<tr>
								<td>
									<label for="openlibrary-api">Openlibrary API Key</label>
									<input placeholder="Paste API Key Here..."';

									$string16 = '';


									$string17 = ' id="wpgamelist-openlibrary-api" name="openlibrary-api" type="text" />
									<a href="" class="wpgamelist-api-get-link">Get OpenLibrary API Keys</a>
								</td>
							</tr>';

						$string18 = '</tbody>
					</table>
					<div class="wpgamelist-spinner" id="wpgamelist-spinner-api"></div>
					<div id="wpgamelist-api-results"></div>
					<button id="wpgamelist-save-api-settings" type="button">Save API Settings</button>
				</div>';

		echo $string1.$string2.$string3.$string4.$string5.$string18;

	}


}

endif;