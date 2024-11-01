<?php
/**
 * WPGameList Show Game In Colorbox Class
 *
 * @author   Jake Evans
 * @category Admin
 * @package  Includes/Classes
 * @version  1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPGameList_Show_Game_In_Colorbox', false ) ) :
/**
 * WPGameList_Admin_Menu Class.
 */
class WPGameList_Show_Game_In_Colorbox {

	// The final html output for the colorbox
	public $output;

	# All saved game properties
	public $amazon_auth_yes;
	public $library;
	public $settings_library;
	public $use_amazon_yes;

	// Game data
	public $title;
	public $image;
	public $platforms;
	public $genres;
	public $developer;
	public $publisher;
	public $rating;
	public $criticrating;
	public $perspective;
	public $gamemodes;
	public $themes;
	public $series;
	public $franchise;
	public $igdblink;
	public $releasedate;
	public $finisheddate;
	public $esrb;
	public $pegi;
	public $owned;
	public $gamecondition;
	public $finished;
	public $myrating;
	public $summary;
	public $notes;
	public $videos;
	public $websites;
	public $screenshots;
	public $altnames;
	public $woocommerce;
	public $saleprice;
	public $regularprice;
	public $stock;
	public $length;
	public $width;
	public $height;
	public $weight;
	public $sku;
	public $virtual;
	public $download;
	public $woofile;
	public $salebegin;
	public $saleend;
	public $purchasenote;
	public $productcategory;
	public $reviews;
	public $crosssells;
	public $upsells;
	public $page;
	public $post;
	public $amazonbuylink;
	public $amazonreviewiframe;
	public $similaramazonproducts;
	public $gamestopurl;
	public $bestbuyurl;
	public $steamurl;
	public $ebayurl;
	public $game_uid;
	public $purchaselink;
	/*
	public $isbn;
	public $title;
	public $author;
	public $purchaselink;
	public $category;
	public $price;
	public $pages;
	public $pub_year;
	public $publisher;
	public $description;
	public $subject;
	public $country;
	public $notes;
	public $rating;
	public $image;
	public $finished;
	public $date_finished;
	public $signed;
	public $first_edition;
	public $page_yes;
	public $post_yes;
	public $google_preview;
	public $amazonbuylink;
	public $amazonreviewiframe;
	public $similaramazonproducts;
	public $kobo_link;
	public $bam_link;
	*/

	# All settings properties
	public $enablepurchase;
	public $hidetitlelibrary;
	public $hidetitlegame;
	public $hidesearch;
	public $hidesort;
	public $hidestats;
	public $hidequote;
	public $hidestarsgame;
	public $hidestarslibrary;
	public $hidefacebookshare;
	public $hidefacebookmessenger;
	public $hidegoogleplus;
	public $hidepinterest;
	public $hideemail;
	public $hidetwitter;
	public $hidegamepost;
	public $hidegamepage;
	public $hidefinished;
	public $hidecoverimage;
	public $hidepublisher;
	public $hidedeveloper;
	public $hidegenre;
	public $hidereleasedate;
	public $hideseries;
	public $hidecriticrating;
	public $hideigdblink;
	public $hideplatforms;
	public $hidealtnames;
	public $hideamazonreviews;
	public $hidenotes;
	public $hidedescription;
	public $hidesteampurchase;
	public $hideebaypurchase;
	public $hidegamestoppurchase;
	public $hidebestbuypurchase;
	public $hideamazonpurchase;
	public $hidesimilartitles;
	public $hidefrontendbuyimg;
	public $hidefrontendbuyprice;
	public $hidecolorboxbuyimg;
	public $hidecolorboxbuyprice;

	# All color data
	public $addgamecolor;
	public $backupcolor;
	public $searchcolor;
	public $statscolor;
	public $quotecolor;
	public $titlecolor;
	public $editcolor;
	public $deletecolor;
	public $pricecolor;
	public $purchasecolor;
	public $pagenumcolor;
	public $pagebackcolor;
	public $purchasegamecolor;
	public $titlegamecolor;
	public $quotegamecolor;
	public $storefront_active;

	// Array for the GameFinder Extension
	public $game_array = array();


	public function __construct($game_id = null, $game_table = null, $game_array = array()) {


		// Get active plugins to see if any extensions are in play
        $this->active_plugins = (array) get_option('active_plugins', array());
        if (is_multisite()) {
            // On the one multisite I have troubleshot, all plugins were merged into the $this->active_plugins variable, but the multisite plugins had an int value, not the actual name of the plugin, so, I had to build an array composed of the keys of the array that get_site_option('active_sitewide_plugins', array()) returned, and merge that.
            $multi_plugin_actual_name = array();
            $temp = get_site_option('active_sitewide_plugins', array());
            foreach ($temp as $key => $value) {
                array_push($multi_plugin_actual_name, $key);
            }

            $this->active_plugins = array_merge($this->active_plugins, $multi_plugin_actual_name);
        }

        // Checking to see if the StoreFront extension is active
		foreach ($this->active_plugins as $key => $plugin) {
			if(strpos($plugin, 'wpgamelist-storefront.php') !== false){
				$this->storefront_active = true;
			}
		}


		global $wpdb;
		// Construct the settings table name
		if(strpos($game_table, 'wpgamelist_jre_saved_game_log') !== false || $game_table == null){
			$this->settings_library = $wpdb->prefix . 'wpgamelist_jre_user_options';
		} else {
			$temp_lib = explode('_', $game_table);
			$this->settings_library = $wpdb->prefix.'wpgamelist_jre_settings_'. array_pop($temp_lib);
		}

		
		// If class is being called from the GameFinder extension, otherwise...
		if($game_id == null && $game_table == null){
			$this->game_array = $game_array;
			$this->gather_user_options();
			$this->gather_gamefinder_data();
			$this->set_amazon_localization();
			$this->modify_purchaselink();
			$this->create_similaramazonproducts();
			$this->dynamic_amazon_aff();
			$this->output_saved_game();
			//$this->output_plain_html();
		} else {
			$this->library = $game_table;
			$this->game_id = $game_id;

			$this->gather_user_options();
			$this->gather_game_info();
			$this->set_amazon_localization();
			$this->modify_purchaselink();
			//$this->gather_color_options();
			$this->create_similaramazonproducts();
			$this->dynamic_amazon_aff();
			$this->output_saved_game();
		}

		
	}

	private function gather_game_info(){

		global $wpdb;
  		$saved_game = $wpdb->get_row($wpdb->prepare("SELECT * FROM $this->library WHERE ID = %d", $this->game_id));

  		$this->title = $saved_game->title;
		$this->image = $saved_game->image;
		$this->platforms = $saved_game->platforms;
		$this->genres = $saved_game->genres;
		$this->developer = $saved_game->developer;
		$this->publisher = $saved_game->publisher;
		$this->myrating = $saved_game->myrating;
		$this->criticrating = $saved_game->criticrating;
		$this->perspective = $saved_game->perspective;
		$this->gamemodes = $saved_game->gamemodes;
		$this->themes = $saved_game->themes;
		$this->series = $saved_game->series;
		$this->franchise = $saved_game->franchise;
		$this->igdblink = $saved_game->igdblink;
		$this->releasedate = $saved_game->releasedate;
		$this->finishdate = $saved_game->finishdate;
		$this->esrb = $saved_game->esrb;
		$this->pegi = $saved_game->pegi;
		$this->owned = $saved_game->owned;
		$this->gamecondition = $saved_game->gamecondition;
		$this->finished = $saved_game->finished;
		$this->myrating = $saved_game->myrating;
		$this->summary = stripslashes($saved_game->summary);
		$this->notes = $saved_game->notes;
		$this->videos = $saved_game->videos;
		$this->websites = $saved_game->websites;
		$this->screenshots = $saved_game->screenshots;
		$this->altnames = $saved_game->altnames;
		$this->woocommerce = $saved_game->woocommerce;
		$this->page = $saved_game->page;
		$this->post = $saved_game->post;
		$this->amazonbuylink = $saved_game->amazonbuylink;
		$this->amazonreviewiframe = $saved_game->amazonreviewiframe;
		$this->similaramazonproducts = $saved_game->similaramazonproducts;
		$this->gamestopurl = $saved_game->gamestopurl;
		$this->bestbuyurl = $saved_game->bestbuyurl;
		$this->steamurl = $saved_game->steamurl;
		$this->ebayurl = $saved_game->ebayurl;
		$this->game_uid = $saved_game->game_uid;
		$this->purchaselink = $saved_game->purchaselink;
		$this->price = $saved_game->price;
		$this->similaramazonproducts_array = array();

  		/*
		$this->isbn = $saved_game->isbn;
		$this->id = $saved_game->ID;
		$this->title = $saved_game->title;
		$this->author = $saved_game->author;
		$this->purchaselink = $saved_game->purchaselink;
		$this->category = $saved_game->category;
		$this->price = $saved_game->price;
		$this->pages = $saved_game->pages;
		$this->pub_year = $saved_game->pub_year;
		$this->publisher = $saved_game->publisher;
		$this->description = $saved_game->description;
		$this->subject = $saved_game->subject;
		$this->country = $saved_game->country;
		$this->notes = $saved_game->notes;
		$this->myrating = $saved_game->rating;
		$this->image = $saved_game->image;
		$this->finished = $saved_game->finished;
		$this->date_finished = $saved_game->date_finished;
		$this->signed = $saved_game->signed;
		$this->first_edition = $saved_game->first_edition;
		$this->page_yes = $saved_game->page_yes;
		$this->post_yes = $saved_game->post_yes;
		$this->google_preview = $saved_game->google_preview;
		$this->bn_link = $saved_game->bn_link;
		$this->amazonbuylink = $saved_game->amazonbuylink;
		$this->amazonreviewiframe = $saved_game->amazonreviewiframe;
		$this->similaramazonproducts = $saved_game->similaramazonproducts;
		$this->page_id = $saved_game->page_yes;
		$this->post_id = $saved_game->post_yes;
		$this->similaramazonproducts_array = array();
		$this->featured_results  = array();
		$this->kobo_link = $saved_game->kobo_link;
		$this->bam_link = $saved_game->bam_link;
		*/

		if($this->amazonreviewiframe == 'https'){
			$this->amazonreviewiframe = null;
		}

	}

	private function gather_user_options(){
		global $wpdb;
		$options_results = $wpdb->get_row($wpdb->prepare("SELECT * FROM $this->settings_library", $this->settings_library));
		$default_opt_table = $wpdb->prefix.'wpgamelist_jre_user_options';
		$default_options_results = $wpdb->get_row($wpdb->prepare("SELECT * FROM $default_opt_table", $default_opt_table));
		$this->enablepurchase = $options_results->enablepurchase;
		$this->hidetitlelibrary = $options_results->hidetitlelibrary;
		$this->hidetitlegame = $options_results->hidetitlegame;
		$this->hidesearch = $options_results->hidesearch;
		$this->hidesort = $options_results->hidesort;
		$this->hidestats = $options_results->hidestats;
		$this->hidequote = $options_results->hidequote;
		$this->hidestarsgame = $options_results->hidestarsgame;
		$this->hidestarslibrary = $options_results->hidestarslibrary;
		$this->hidefacebookshare = $options_results->hidefacebookshare;
		$this->hidefacebookmessenger = $options_results->hidefacebookmessenger;
		$this->hidegoogleplus = $options_results->hidegoogleplus;
		$this->hidepinterest = $options_results->hidepinterest;
		$this->hideemail = $options_results->hideemail;
		$this->hidetwitter = $options_results->hidetwitter;
		$this->hidegamepost = $options_results->hidegamepost;
		$this->hidegamepage = $options_results->hidegamepage;
		$this->hidefinished = $options_results->hidefinished;
		$this->hidecoverimage = $options_results->hidecoverimage;
		$this->hidepublisher = $options_results->hidepublisher;
		$this->hidedeveloper = $options_results->hidedeveloper;
		$this->hidegenre = $options_results->hidegenre;
		$this->hidereleasedate = $options_results->hidereleasedate;
		$this->hideseries = $options_results->hideseries;
		$this->hidecriticrating = $options_results->hidecriticrating;
		$this->hideigdblink = $options_results->hideigdblink;
		$this->hideplatforms = $options_results->hideplatforms;
		$this->hidealtnames = $options_results->hidealtnames;
		$this->hideamazonreviews = $options_results->hideamazonreviews;
		$this->hidenotes = $options_results->hidenotes;
		$this->hidedescription = $options_results->hidedescription;
		$this->hidesteampurchase = $options_results->hidesteampurchase;
		$this->hideebaypurchase = $options_results->hideebaypurchase;
		$this->hidegamestoppurchase = $options_results->hidegamestoppurchase;
		$this->hidebestbuypurchase = $options_results->hidebestbuypurchase;
		$this->hideamazonpurchase = $options_results->hideamazonpurchase;
		$this->hidesimilartitles = $options_results->hidesimilartitles;
		$this->hidefrontendbuyimg = $options_results->hidefrontendbuyimg;
		$this->hidefrontendbuyprice = $options_results->hidefrontendbuyprice;
		$this->hidecolorboxbuyimg = $options_results->hidecolorboxbuyimg;
		$this->hidecolorboxbuyprice = $options_results->hidecolorboxbuyprice;
		$this->amazoncountryinfo = $default_options_results->amazoncountryinfo;
		$this->amazonaff = $default_options_results->amazonaff;
	}

	private function gather_color_options(){
		global $wpdb;
		$color_table_name = $wpdb->prefix . 'wpgamelist_jre_color_options';
  		$colors_row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $color_table_name WHERE ID = %d", 1));

  		$this->addgamecolor = $color_row->addgamecolor;
		$this->backupcolor = $color_row->backupcolor;
		$this->searchcolor = $color_row->searchcolor;
		$this->statscolor = $color_row->statscolor;
		$this->quotecolor = $color_row->quotecolor;
		$this->titlecolor = $color_row->titlecolor;
		$this->editcolor = $color_row->editcolor;
		$this->deletecolor = $color_row->deletecolor;
		$this->pricecolor = $color_row->pricecolor;
		$this->purchasecolor = $color_row->purchasecolor;
		$this->pagenumcolor = $color_row->pagenumcolor;
		$this->pagebackcolor = $color_row->pagebackcolor;
		$this->purchasegamecolor = $color_row->purchasegamecolor;
		$this->titlegamecolor = $color_row->titlegamecolor;
		$this->quotegamecolor = $color_row->quotegamecolor;

	}

	private function set_amazon_localization(){
		switch ($this->amazoncountryinfo ) {
	        case "au":
	            $this->amazonbuylink = str_replace(".com",".com.au", $this->amazonbuylink);
	            $this->amazonreviewiframe = str_replace(".com",".com.au", $this->amazonreviewiframe);
	            break;
	        case "br":
	            $this->amazonbuylink = str_replace(".com",".com.br", $this->amazonbuylink);
	            $this->amazonreviewiframe = str_replace(".com",".com.br", $this->amazonreviewiframe);
	            break;
	        case "ca":
	            $this->amazonbuylink = str_replace(".com",".ca", $this->amazonbuylink);
	            $this->amazonreviewiframe = str_replace(".com",".ca", $this->amazonreviewiframe);
	            break;
	        case "cn":
	            $this->amazonbuylink = str_replace(".com",".cn", $this->amazonbuylink);
	            $this->amazonreviewiframe = str_replace(".com",".cn", $this->amazonreviewiframe);
	            break;
	        case "fr":
	            $this->amazonbuylink = str_replace(".com",".fr", $this->amazonbuylink);
	            $this->amazonreviewiframe = str_replace(".com",".fr", $this->amazonreviewiframe);
	            break;
	        case "de":
	            $this->amazonbuylink = str_replace(".com",".de", $this->amazonbuylink);
	            $this->amazonreviewiframe = str_replace(".com",".de", $this->amazonreviewiframe);
	            break;
	        case "in":
	            $this->amazonbuylink = str_replace(".com",".in", $this->amazonbuylink);
	            $this->amazonreviewiframe = str_replace(".com",".in", $this->amazonreviewiframe);
	            break;
	        case "it":
	            $this->amazonbuylink = str_replace(".com",".it", $this->amazonbuylink);
	            $this->amazonreviewiframe = str_replace(".com",".it", $this->amazonreviewiframe);
	            break;
	        case "jp":
	            $this->amazonbuylink = str_replace(".com",".co.jp", $this->amazonbuylink);
	            $this->amazonreviewiframe = str_replace(".com",".co.jp", $this->amazonreviewiframe);
	            break;
	        case "mx":
	            $this->amazonbuylink = str_replace(".com",".com.mx", $this->amazonbuylink);
	            $this->amazonreviewiframe = str_replace(".com",".com.mx", $this->amazonreviewiframe);
	            break;
	        case "nl":
	            $this->amazonbuylink = str_replace(".com",".nl", $this->amazonbuylink);
	            $this->amazonreviewiframe = str_replace(".com",".nl", $this->amazonreviewiframe);
	            break;
	        case "es":
	            $this->amazonbuylink = str_replace(".com",".es", $this->amazonbuylink);
	            $this->amazonreviewiframe = str_replace(".com",".es", $this->amazonreviewiframe);
	            break;
	        case "uk":
	            $this->amazonbuylink = str_replace(".com",".co.uk", $this->amazonbuylink);
	            $this->amazonreviewiframe = str_replace(".com",".co.uk", $this->amazonreviewiframe);
	            break;
	        default:
	            //$this->amazonbuylink = $saved_game->amazonbuylink;//filter_var($saved_game->amazonbuylink, FILTER_SANITIZE_URL);
	    }
	}

	private function modify_purchaselink(){
		if($this->purchaselink != null){
	        if(strpos($this->purchaselink, 'http://') === false && strpos($this->purchaselink, 'https://') === false){
	            $this->purchaselink = 'http://'.$this->purchaselink;
	        } else {
	            $this->purchaselink = $this->purchaselink;
	        }
    	}
	}

	private function create_similaramazonproducts(){
		// If no similar products were found, set array to null and return
		if($this->similaramazonproducts == ';bsp;1---1;bsp;G---G'){
			$this->similaramazonproducts_array  = null;
			return;
		}

		$similarproductsarray = explode(';bsp;',$this->similaramazonproducts);
        $similarproductsarray = array_unique($similarproductsarray);
        $this->similaramazonproducts_array = array_values($similarproductsarray);
	}

	private function dynamic_amazon_aff(){
		$this->amazonbuylink = str_replace('wpbooklistid-20', $this->amazonaff, $this->amazonbuylink);
	}

	private function gather_featured_titles(){
		global $wpdb;
		$table_name_featured = $wpdb->prefix . 'wpgamelist_jre_saved_games_for_featured';
		$this->featured_results = $wpdb->get_results("SELECT * FROM $table_name_featured");
	}

	private function output_saved_game(){
		$string1 = '<div id="wpgamelist_top_top_div">
    			<div id="wpgamelist_top_display_container">
			    	<table>
			            <tbody>
			                <tr>
			                    <td id="wpgamelist_image_saved_border">
			                        <div id="wpgamelist_display_image_container">';

			                        // Determine which image to use for the title
			                       if($this->hidecoverimage == null || $this->hidecoverimage == 0){
			                            if($this->image == null){
											$string2 = '<img id="wpgamelist_cover_image_popup" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'image_unavaliable.png"/>';
			                            } else {
			                            	$string2 = '<img id="wpgamelist_cover_image_popup" src="'.$this->image.'"/>';
			                            }
		                        	}
		      
		                            $string3 = '<input type="submit" id="wpgamelist_desc_button" value="Description, Notes & Reviews"></input>';

		                            if(($this->hiderating == null || $this->hiderating == 0) && ($this->esrb != '')){ 


										if($this->esrb == 'Rating Pending'){
										    $string98 = '<img style="width: 40px;" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'rp_esrb.png'.'" />';
										}    

										if($this->esrb == 'Early Childhood'){
										    $string98 = '<img style="width: 40px;" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'ec_esrb.png'.'" />';
										}    

										if($this->esrb == 'Everyone'){
										    $string98 = '<img style="width: 40px;" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'e_esrb.png'.'" />';
										}    

										if($this->esrb == 'Everyone 10+'){
										    $string98 = '<img style="width: 40px;" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'ep_esrb.png'.'" />';
										}    

										if($this->esrb == 'Teen'){
										    $string98 = '<img style="width: 40px;" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'t_esrb.png'.'" />';
										}

										if($this->esrb == 'Mature'){
										    $string98 = '<img style="width: 40px;" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'m_esrb.png'.'" />';
										}    

										if($this->esrb == 'Adults Only'){
										    $string98 = '<img style="width: 40px;" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'ao_esrb.png'.'" />';
										}    
									} else {
										$string98 = '';
									}

									if(($this->hiderating == null || $this->hiderating == 0) && ($this->pegi != '')){ 


										if($this->pegi == 'Age 3+'){
										    $string99 = '<img style="width: 40px; height:53px; margin-left:5px;" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'3_pegi.jpg'.'" />';
										}    

										if($this->pegi == 'Age 7+'){
										    $string99 = '<img style="width: 40px; height:53px; margin-left:5px;" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'7_pegi.jpg'.'" />';
										}    

										if($this->pegi == 'Age 12+'){
										    $string99 = '<img style="width: 40px; height:53px; margin-left:5px;" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'12_pegi.jpg'.'" />';
										}    

										if($this->pegi == 'Age 16+'){
										    $string99 = '<img style="width: 40px; height:53px; margin-left:5px;" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'16_pegi.jpg'.'" />';
										}    

										if($this->pegi == 'Age 18+'){
										    $string99 = '<img style="width: 40px; height:53px; margin-left:5px;" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'18_pegi.jpg'.'" />';
										}
   
									} else {
										$string99 = '';
									}

									if(($this->hidestarsgame == null || $this->hidestarsgame == 0) && ($this->myrating != 0)){ 
							            $string4 = '<p class="wpgamelist-share-text">My Rating</p>
							            <div class="wpgamelist-line-7"></div>';

										if($this->myrating == 5){
										    $string5 = '<img style="width: 50px;" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'5star.png'.'" />';
										}    

										if($this->myrating == 4){
										    $string5 = '<img style="width: 50px;" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'4star.png'.'" />';
										}    

										if($this->myrating == 3){
										    $string5 = '<img style="width: 50px;" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'3star.png'.'" />';
										}    

										if($this->myrating == 2){
										    $string5 = '<img style="width: 50px;" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'2star.png'.'" />';
										}    

										if($this->myrating == 1){
										    $string5 = '<img style="width: 50px;" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'1star.png'.'" />';
										}    
									} else {
										$string4 = '';
										$string5 = ''; 
									}

									if(($this->hidefacebook == null || $this->hidefacebook == 0) || ($this->hidetwitter == null || $this->hidetwitter == 0) || ($this->hidegoogleplus == null || $this->hidegoogleplus == 0) || ($this->hidemessenger == null || $this->hidemessenger == 0) || ($this->hidepinterest == null || $this->hidepinterest == 0) || ($this->hideemail == null || $this->hideemail == 0)){ 

						                $string6 = '<p class="wpgamelist-share-text">Share This Game</p>
						                <div class="wpgamelist-line-4"></div>';


						                if($this->hidefacebookshare == null || $this->hidefacebookshare == 0){
						                	$string7 = '<div class="addthis_sharing_toolbox addthis_default_style" style="cursor:pointer"><a style="cursor:pointer;" href="" addthis:title="'.$this->title.'" addthis:description="'.htmlspecialchars(addslashes($this->description)).'"addthis:url="'.$this->amazonbuylink.'" class="addthis_button_facebook"></a></div>';
						            	} else {
						            		$string7 = '';
						            	}

						            	if($this->hidetwitter == null || $this->hidetwitter == 0){
						                	$string8 = '<div class="addthis_sharing_toolbox addthis_default_style" style="cursor:pointer"><a style="cursor:pointer;" href="" addthis:title="'.$this->title.'" addthis:description="'.htmlspecialchars(addslashes($this->description)).'"addthis:url="'.$this->amazonbuylink.'" class="addthis_button_twitter"></a></div>';
						            	} else {
						            		$string8 = '';
						            	}

						            	if($this->hidegoogleplus == null || $this->hidegoogleplus == 0){
						                	$string9 = '<div class="addthis_sharing_toolbox addthis_default_style" style="cursor:pointer"><a style="cursor:pointer;" href="" addthis:title="'.$this->title.'" addthis:description="'.htmlspecialchars(addslashes($this->description)).'"addthis:url="'.$this->amazonbuylink.'" class="addthis_button_google_plusone_share"></a></div>';
						            	} else {
						            		$string9 = '';
						            	}

						            	if($this->hidepinterest == null || $this->hidepinterest == 0){
						                	$string10 = '<div class="addthis_sharing_toolbox addthis_default_style" style="cursor:pointer"><a style="cursor:pointer;" href="" addthis:title="'.$this->title.'" addthis:description="'.htmlspecialchars(addslashes($this->description)).'"addthis:url="'.$this->amazonbuylink.'" class="addthis_button_pinterest_share"></a></div>';
						            	} else {
						            		$string10 = '';
						            	}

						            	if($this->hidefacebookmessenger == null || $this->hidefacebookmessenger == 0){
						                	$string11 = '<div class="addthis_sharing_toolbox addthis_default_style" style="cursor:pointer"><a style="cursor:pointer;" href="" addthis:title="'.$this->title.'" addthis:description="'.htmlspecialchars(addslashes($this->description)).'"addthis:url="'.$this->amazonbuylink.'" class="addthis_button_messenger"></a></div>';
						            	} else {
						            		$string11 = '';
						            	}

						            	if($this->hideemail == null || $this->hideemail == 0){ 
						                	$string12 = '<div class="addthis_sharing_toolbox addthis_default_style" style="cursor:pointer"><a style="cursor:pointer;" href="" addthis:title="'.$this->title.'" addthis:description="'.htmlspecialchars(addslashes($this->description)).'"addthis:url="'.$this->amazonbuylink.'" class="addthis_button_gmail"></a></div>';
						            	} else {
						            		$string12 = '';
						            	}
						            } else {
						            	$string6 ='';
						            	$string7 ='';
						            	$string8 ='';
						            	$string9 ='';
						            	$string10 ='';
						            	$string11 ='';
						            	$string12 ='';
						            }

						            $string13 = '</div></div></td></table></div></td></tr></tbody><a name="desc_scroll"></a></table>';

						            $string14 = '<div id="wpgamelist_display_table">
                            						<table id="wpgamelist_display_table_2">';

                            						$string15 = '';
                            						$string16 = '';
                            						$string17 = '';
                            						if($this->hidetitlegame != 1){
						                            	$string15 = '<tr>
						                                    <td id="wpgamelist_title"><div';
							                                    if($this->titlegamecolor != null){ 
							                            			$string16 = 'data-modifycolor=false style="color:#'.$this->titlegamecolor.'"';
							                                 	} else {
							                                 		$string16 = '';
							                                 	}

						                                    $string17 = ' id="wpgamelist_title_div">'.htmlspecialchars_decode(stripslashes($this->title)).'</div>
						                                    </td>
						                                </tr>';
						                            }

						                            $string18 = '';
						                            if($this->hidereleasedate != 1){
						                            	if($this->releasedate != ''){
							                            	$string18 = '<tr>
							                                    <td>
							                                        <span class="wpgamelist-bold-stats-class" id="wpgamelist_bold">Initial Release Date: </span><span class="wpgamelist-bold-stats-value">'.$this->releasedate.'</span>
							                                    </td>   
							                                </tr>
							                                ';
						                            	} else {
						                            		$string18 = '<tr>
						                                    <td>
						                                        <span class="wpgamelist-bold-stats-class" id="wpgamelist_bold">Initial Release Date: </span><span class="wpgamelist-bold-stats-value">N/A</span>
						                                    </td>   
						                                </tr>
						                                ';
						                            	}
						                            }

						                            $string19 = '';
													if(($this->enablepurchase != null && $this->enablepurchase != 0) && $this->price != null && $this->hidecolorboxbuyprice != 1){
														// TODO: Add filter:  $string19 = '<tr><td><span class="wpgamelist-bold-stats-class" id="wpgamelist_bold">Price:</span> '.$this->price.'</td>   </tr>';
														if(has_filter('wpgamelist_append_to_colorbox_price')) {
            												$string19 = apply_filters('wpgamelist_append_to_colorbox_price', $this->price);
        												}
													} 

						                            $string20 = '';
						                            $string21 = '';
						                            $string22 = '';
						                            if($this->hidegenre != 1){
							                            $string20 = '<tr>
							                                    <td>';

														if($this->genres == null){
							                            	$string21 = '<span class="wpgamelist-bold-stats-class" id="wpgamelist_bold">Genre(s): </span><span class="wpgamelist-bold-stats-value">Not Available</span>';
							                            } else {
							                            	$string21 = '<span class="wpgamelist-bold-stats-class" id="wpgamelist_bold">Genre(s): </span><span class="wpgamelist-bold-stats-value">'.$this->genres.'</span>';
							                            }

							                            $string22 = '</td>
							                                </tr>';
						                            }

						                            $string23 = '';
						                            $string24 = '';
						                            $string25 = '';
						                            if($this->hideplatforms != 1){
							                            $string23 = '<tr>
							                                    <td>';

							                            if($this->platforms == null){
							                            	$string24 = '<span class="wpgamelist-bold-stats-class" id="wpgamelist_bold">Platform(s): </span><span class="wpgamelist-bold-stats-value">Not Available</span>';
							                            } else {
							                            	$string24 = '<span class="wpgamelist-bold-stats-class" id="wpgamelist_bold">Platform(s): </span><span class="wpgamelist-bold-stats-value">'.$this->platforms.'</span>';
							                            }
													
														$string25 = '</td>
						                                	</tr>';
						                            }

						                            $string26 = '';
						                            $string27 = '';
						                            $string28 = '';
						                            if($this->hidepublisher != 1){
							                            $string26 = '<tr>
							                                    <td>';

							                            if($this->publisher == null){
							                            	$string27 = '<span class="wpgamelist-bold-stats-class" id="wpgamelist_bold">Publisher: </span><span class="wpgamelist-bold-stats-value">Not Available</span>';
							                            } else {
							                            	$string27 = '<span class="wpgamelist-bold-stats-class" id="wpgamelist_bold">Publisher: </span><span class="wpgamelist-bold-stats-value">'.stripslashes(stripslashes($this->publisher)).'</span>';
							                            }

							                            $string28 = '</td>
							                                </tr>';
							                        }

							                        $string92 = '';
						                            $string93 = '';
						                            $string94 = '';
						                            if($this->hidedeveloper != 1){
							                            $string92 = '<tr>
							                                    <td>';

							                            if($this->developer == null){
							                            	$string93 = '<span class="wpgamelist-bold-stats-class" id="wpgamelist_bold">Developer: </span><span class="wpgamelist-bold-stats-value">Not Available</span>';
							                            } else {
							                            	$string93 = '<span class="wpgamelist-bold-stats-class" id="wpgamelist_bold">Developer: </span><span class="wpgamelist-bold-stats-value">'.stripslashes(stripslashes($this->developer)).'</span>';
							                            }

							                            $string94 = '</td>
							                                </tr>';
							                        }

							                        $string95 = '';
						                            $string96 = '';
						                            $string97 = '';
						                            if($this->hidecriticrating != 1){
							                            $string95 = '<tr>
							                                    <td>';

							                            if($this->criticrating == null){
							                            	$string96 = '<span class="wpgamelist-bold-stats-class" id="wpgamelist_bold">Avg. Critic Rating: </span><span class="wpgamelist-bold-stats-value">Not Available</span>';
							                            } else {

							                            	if($this->criticrating == 0){
							                            		$this->criticrating = 'N/A';
							                            	}

							                            	$string96 = '<span class="wpgamelist-bold-stats-class" id="wpgamelist_bold">Avg. Critic Rating: </span><span class="wpgamelist-bold-stats-value">'.stripslashes(stripslashes($this->criticrating)).'</span>';
							                            }

							                            $string97 = '</td>
							                                </tr>';
							                        }

							                        $string29 = '';
						                            $string30 = '';
						                            $string31 = '';
							                        if($this->hideseries != 1){
							                        	$string29 = '<tr>
							                                    <td>';
							                            if($this->series == null){
							                            	$string30 = '<span class="wpgamelist-bold-stats-class" id="wpgamelist_bold">Series: </span><span class="wpgamelist-bold-stats-value">Not Available</span>';
							                            } else {
							                            	$string30 = '<span class="wpgamelist-bold-stats-class" id="wpgamelist_bold">Series: </span><span class="wpgamelist-bold-stats-value">'.$this->series.'</span>';
							                            }

							                            $string31 = '</td>
							                                </tr>';
							                        }

							                        $string32 = '';
						                            $string33 = '';
						                            $string34 = '';
						                            $string35 = '';
							                        if($this->hidefinished != 1){
							                        	$string32 = '<tr>
							                                    <td>';

						                            	if($this->finished == 'Yes'){
								                            if($this->finishdate == null){
								                            	$string33 = '<span class="wpgamelist-bold-stats-class" id="wpgamelist_bold">Finished? </span><span class="wpgamelist-bold-stats-value">Yes</span>';
								                            } else {
								                            	$string33 = '<span class="wpgamelist-bold-stats-class" id="wpgamelist_bold">Finished? </span><span class="wpgamelist-bold-stats-value">Yes, on '.$this->finishdate.'</span>';
								                            }
							                        	} else {
							                        		$string34 = '<span class="wpgamelist-bold-stats-class" id="wpgamelist_bold">Finished? </span><span class="wpgamelist-bold-stats-value">Not Yet</span>';
							                        	}

							                        	$string35 = '</td>
							                                </tr>';
							                        }

							                        $string36 = '';
						                            $string37 = '';
						                            $string38 = '';
													if($this->hideigdblink != 1){			
														$string36 = '<tr>
							                                    <td>';		

							                            if($this->igdblink != null){
								                            $string37 = '<span class="wpgamelist-bold-stats-class" id="wpgamelist_bold">IGDB Link: </span><a href="'.$this->igdblink.'">Click Here</a>';
							                        	} else {
							                        		$string37 = '<span class="wpgamelist-bold-stats-class" id="wpgamelist_bold">IGDB Link: </span><span class="wpgamelist-bold-stats-value">N/A</span>';
							                        	}
                        	
							                     
							                        	$string38 = '</td>
							                                </tr>';
							                        }

							                        $string39 = '';
						                            $string40 = '';
						                            $string41 = '';
							                        if($this->hidealtnames != 1){
						                        		$string39 = '<tr>
						                                    <td>';	

						                                if($this->altnames == '' || $this->altnames == null){
								                            $string40 = '<span class="wpgamelist-bold-stats-class" id="wpgamelist_bold">Alternative Names: </span><span class="wpgamelist-bold-stats-value">N/A</span>';
							                        	} else {
							                        		$string40 = '<span class="wpgamelist-bold-stats-class" id="wpgamelist_bold">Alternative Names: </span><span class="wpgamelist-bold-stats-value">'.$this->altnames.'</span>';
							                        	}

							                        	$string41 = '</td>
							                                </tr>';
							                        }

							                        $string42 = '';
							                        if($this->hidegamepage != 1 && $this->page_id != null && $this->page_id != 'false'){
							                        	$string42 = '<tr>
						                                    <td>
						                                    	<span class="wpgamelist-bold-stats-class" id="wpgamelist_bold"><a id="wpgamelist-purchase-game-view" href="'.get_permalink( $this->page_id ).'"><span class="wpgamelist-bold-stats-page">Game Page</span></a></span>
																</td>
                            							</tr>';
							                        }

							                        $string43 = '';
							                        if($this->hidegamepost != 1 && $this->post_id != null && $this->post_id != 'false'){
							                        	$string43 = '<tr>
						                                    <td>
						                                    	<span class="wpgamelist-bold-stats-class" id="wpgamelist_bold"><a id="wpgamelist-purchase-game-view" href="'.get_permalink( $this->post_id ).'"><span class="wpgamelist-bold-stats-page">Game Post</span></a></span>
																</td>
                            							</tr>';

							                        }

							                        $string44 = '';
						                            $string45 = '';
						                            $string46 = '';
						                        	if(($this->enablepurchase != null && $this->enablepurchase != 0) && $this->price != null && $this->purchaselink != ''){
						                        		$string44 = '
						                        		<tr>
                                							<td>
                                								<span class="wpgamelist-bold-stats-class" id="wpgamelist_bold"><a';

															if($this->purchasegamecolor != null){
																$string45 = 'data-modifycolor=false style="color:#'.$this->purchasegamecolor.'"';

															}

															// TODO: Add filter $string46 = ' id="wpgamelist-purchase-game-view" href="'.$this->purchaselink.'">Purchase Now!</a></td></tr>';
															if(($this->enablepurchase != null && $this->enablepurchase != 0) && $this->purchaselink != null && $this->purchaselink != '' && $this->hidecolorboxbuyprice != 1){
																$string46 = '';
																if(has_filter('wpgamelist_append_to_colorbox_purchase_text_link')) {
	        														$string46 = apply_filters('wpgamelist_append_to_colorbox_purchase_text_link', $this->purchaselink);
	    														}
    														}
						                        	}

						                        	$string46 = $string46.'</a>';

						                        	if(($this->hidekobopurchase == null || $this->hidekobopurchase == 0 && ($this->kobo_link != null && $this->kobo_link != 'http://store.kobogames.com/en-ca/Search?Query=')) || ($this->hidebampurchase == null || $this->hidebampurchase == 0 ) || ($this->hideamazonpurchase == null || $this->hideamazonpurchase == 0 && ($this->amazonbuylink != null)) || ($this->hidebnpurchase == null || $this->hidebnpurchase == 0 ) || ($this->hidegooglepurchase == null || $this->hidegooglepurchase == 0 && ($this->google_preview != null)) || ($this->hideitunespurchase == null || $this->hideitunespurchase == 0 ) || (($this->storefront_active == true) &&  ($this->hidecolorboxbuyimg == null || $this->hidecolorboxbuyimg == 0) && ($this->purchaselink != null && $this->purchaselink != '') )){

						                        		$string47 = '</td></tr><tr>
                        									<td><div class="wpgamelist-line-2"></div></td>
						                                </tr>
						                                <tr>
						                                    <td class="wpgamelist-purchase-title" colspan="2">Purchase This Game At:</td>
						                                </tr>
						                                <tr>
						                                    <td><div class="wpgamelist-line"></div></td>
						                                </tr>
						                                <tr>
						                                	<td>
						                                		<a';
						                                } else {
						                                	$string47 = '<a';
						                                }

						                                $string48 = '';
														if (($this->amazonbuylink == null) || ($this->hideamazonpurchase != null && $this->hideamazonpurchase != 0 )){
															$string48 = ' style="display:none;"';
														} 
														
														$string49 = ' class="wpgamelist-purchase-img" href="'.$this->amazonbuylink.'" target="_blank">
																<img src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'amazon.png" /></a>
																<a ';


														

														$string50 = '';
														if (($this->hidegamestoppurchase != null && $this->hidegamestoppurchase != 0 )){
															$string50 = ' style="display:none;"';
														} 
															
														$string51 = ' class="wpgamelist-purchase-img" href="'.$this->gamestopurl.'" target="_blank">
														<img src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'gamestop.png" /></a>
														<a ';

														$string52 = '';
														if (($this->hidebestbuypurchase != null && $this->hidebestbuypurchase != 0 )){
															$string52 = ' style="display:none;"';
														}

														$string53 = ' class="wpgamelist-purchase-img" href="'.$this->bestbuyurl.'" target="_blank">
														<img src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'bestbuy.png" /></a><a ';

														$string54 = '';
														if (($this->hidesteampurchase != null && $this->hidesteampurchase != 0 )){
															$string54 = ' style="display:none;"';
														}

														$string55 = ' class="wpgamelist-purchase-img" href="'.$this->steamurl.'" target="_blank">
																<img src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'steam.png" id="wpgamelist-itunes-img" /></a><a ';

														$string100 = '';
														if (($this->hideebaypurchase != null && $this->hideebaypurchase != 0 )){
															$string100 = ' style="display:none;"';
														}

														$string101 = ' class="wpgamelist-purchase-img" href="'.$this->ebayurl.'" target="_blank">
																<img src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'ebay.png" id="wpgamelist-itunes-img" /></a><a ';

														$string56 = '';
														if (($this->purchaselink == null) || ($this->hidecolorboxbuyimg != null && $this->hidecolorboxbuyimg != 0 )){
															$string56 = ' style="display:none;"';
														}
															
														//TODO: Add filter $string57 = ' class="wpgamelist-purchase-img" href="'.$this->purchaselink.'" target="_blank"><img src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'author-icon.png" /></a>';
														$string57 = '></a>';


														$string84 = '<a ';
														if ($this->hidekobopurchase != null && $this->hidekobopurchase != 0 || $this->kobo_link == null || ($this->kobo_link == 'http://store.kobogames.com/en-ca/Search?Query=')){
															$string84 = $string84.' style="display:none;"';
														}
														$string85 = ' class="wpgamelist-purchase-img" href="'.$this->kobo_link.'" target="_blank">
																<img src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'kobo-icon.png" /></a>';

														$string86 = '<a ';
														if ($this->hidebampurchase != null && $this->hidebampurchase != 0 || $this->bam_link == null || ($this->bam_link == 'http://www.gamesamillion.com/p/')){
															$string86 = $string86.' style="display:none;"';
														}
														$string87 = ' class="wpgamelist-purchase-img" href="'.$this->bam_link.'" target="_blank">
																<img src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'bam-icon.jpg" /></a>';



														if(($this->enablepurchase != null && $this->enablepurchase != 0) && $this->purchaselink != null && $this->purchaselink != '' && $this->hidecolorboxbuyimg != 1){
															if(has_filter('wpgamelist_append_to_colorbox_purchase_image_link')) {
	            												$string57 = $string57.apply_filters('wpgamelist_append_to_colorbox_purchase_image_link', $this->purchaselink);
	        												}
        												}

														$string58 = '</td>   
                        										</tr>
								                                <tr>';

								                        $string59 = '';
														if(($this->hidekobopurchase == null || $this->hidekobopurchase == 0 && ($this->kobo_link != null && $this->kobo_link != 'http://store.kobogames.com/en-ca/Search?Query=')) || ($this->hidebampurchase == null || $this->hidebampurchase == 0 && ($this->bam_link != null && $this->bam_link != 'http://www.gamesamillion.com/p/')) || ($this->hideamazonpurchase == null || $this->hideamazonpurchase == 0 && ($this->amazonbuylink != null)) || ($this->hidebnpurchase == null || $this->hidebnpurchase == 0 && ($this->isbn != null)) || ($this->hidegooglepurchase == null || $this->hidegooglepurchase == 0 && ($this->google_preview != null)) || ($this->hideitunespurchase == null || $this->hideitunespurchase == 0 ) || (($this->storefront_active == true) &&  ($this->hidecolorboxbuyimg == null || $this->hidecolorboxbuyimg == 0) && ($this->purchaselink != null && $this->purchaselink != '') )){
															
															$string59 = '</td>   
                    										</tr>
							                                <tr>
							                                    <td><div class="wpgamelist-line-3"></div></td>
							                                </tr>
							                                <tr>';
							                        	}

														$string61 = '</tr>
															    </table>
															    </div>
															         </div>         
															        <div id="wpgamelist_desc_id">';

														$string62 = '';
														$string63 = '';
														$string64 = '';
														if(($this->hidesimilartitles == null || $this->hidesimilartitles == 0) && $this->similaramazonproducts_array != null){
													        if($this->similaramazonproducts == null){

													    	} else {
													            $string62 = '<div class="wpgamelist-similar-featured-div">
													                <p id="wpgamelist-similar-titles-id" class="wpgamelist_description_p">Similar Titles & Products:</p> 
																		<table class="wpgamelist-similar-titles-table"> <tr>';

																$string63 = '';
													            foreach($this->similaramazonproducts_array as $key=>$prod){
											                        $arr = explode("---", $prod, 2);
											                        $asin = $arr[0];

											                        $image = 'http://images.amazon.com/images/P/'.$asin.'.01.LZZZZZZZ.jpg?rand='.uniqid();
											                        $url = 'https://www.amazon.com/dp/'.$asin.'?tag='.$this->amazonaff;
											                        if($asin != null && $asin != ''){
												                        if(strlen($image) > 51 ){
												                            if($key == 6){
												                                $string63 = $string63.'</tr><tr><td><a class="wpgamelist-similar-link" target="_blank" href="'.$url.'"><img class="wpgamelist-similar-image" src="'.$image.'" /></a></td>';
												                            } else {
												                               $string63 = $string63.'<td><a class="wpgamelist-similar-link" target="_blank" href="'.$url.'"><img class="wpgamelist-similar-image" src="'.$image.'" /></a></td>';
												                            }
												                        }
											                    	}
													            }
													                    
													            $string64 = '</tr>
																	    </table>
																	</div>';
															} 
														}

														$string65 = '';
														$string66 = '';
														$string67 = '';
														if($this->hidefeaturedtitles == null || $this->hidefeaturedtitles == 0){
													        if($this->featured_results == null){
													            
													        } else {
													            $string65 = '<div class="wpgamelist-similar-featured-div" style="margin-left:5px">
													                <p id="wpgamelist-similar-titles-id" class="wpgamelist_description_p">Featured Titles:</p> 
													                <table class="wpgamelist-similar-titles-table"> <tr>';
													                $string66 = '';
												                    foreach($this->featured_results as $key=>$featured){
												                        $image = $featured->coverimage;
												                        $url = $featured->amazondetailpage;
												                        if(strlen($image) > 51 ){
												                            if($key == 5){
												                                $string66 = $string64.'</tr><tr><td><a class="wpgamelist-similar-link" target="_blank" href="'.$url.'"><img class="wpgamelist-similar-image" src="'.$image.'" /></a></td>';
												                            } else {
												                               $string66 = $string64.'<td><a class="wpgamelist-similar-link" target="_blank" href="'.$url.'"><img class="wpgamelist-similar-image" src="'.$image.'" /></a></td>';
												                            }
												                        }
												                    }
													                 $string67 = '</tr>
													                </table>
													            </div>';
													        }
													    }

													    $string103 = '';
														if(has_filter('wpgamelist_add_to_colorbox_screenshots')) {
												
																//array_push($saved_game, $this->library);
            													$string103 = apply_filters('wpgamelist_add_to_colorbox_screenshots', $this->screenshots);
        												}



        												$string102 = '';
														//if($this->hidekindleprev == null || $this->hidekindleprev == 0){
															if(has_filter('wpgamelist_video_add_to_colorbox')) {
            													$string102 = apply_filters('wpgamelist_video_add_to_colorbox', $this->videos);
        													}
        												//}

        												//if($this->hidegoogleprev == null || $this->hidegoogleprev == 0){
															if(has_filter('wpgamelist_add_to_colorbox_google')) {
            													$string68 = $string68.apply_filters('wpgamelist_add_to_colorbox_google', $this->igdblink.'---'.$this->image);
        													}
        												//}
									
														$string69 = '';
														if($this->hidedescription == null || $this->hidedescription == 0){
														     $string68 = $string68.'<p class="wpgamelist_description_p" id="wpgamelist-desc-title-id">Summary:</p>'; 

														    if($this->summary == null){
													        	$string69 = '<p class="wpgamelist_desc_p_class">Not Available</p>';
													        } else {
													        	$string69 = '<div class="wpgamelist_desc_p_class">'.stripslashes(html_entity_decode($this->summary)).'</div>';
													        } 
														}

														if(($this->hideamazonreviews == null || $this->hideamazonreviews == 0) && ($this->amazonreviewiframe != null)){
													            $string70 = '<p class="wpgamelist_description_p" id="wpgamelist-amazon-review-title-id">Amazon Reviews:</p> 
													            <p class="wpgamelist_desc_p_class"><iframe id="wpgamelist-review-iframe" src="'.$this->amazonreviewiframe.'"></iframe></p>';
													    }

													    $string71 = '';
													    $string72 = '';
													    if($this->hidenotes == null || $this->hidenotes == 0){
													         $string71 = '<p class="wpgamelist_description_p" id="wpgamelist-notes-title-id">Notes:</p>';

												            if($this->notes == null){
												                $string72 = '<p class="wpgamelist_desc_p_class">None Provided</p>';
												            } else {
												                $string72 = '<p class="wpgamelist_desc_p_class">'.stripslashes(html_entity_decode($this->notes)).'</p>';
												            } 
													    }

													    $string73 = '';
														if(($this->hidekobopurchase == null || $this->hidekobopurchase == 0 && ($this->kobo_link != null && $this->kobo_link != 'http://store.kobogames.com/en-ca/Search?Query=')) || ($this->hidebampurchase == null || $this->hidebampurchase == 0 && ($this->bam_link != null && $this->bam_link != 'http://www.gamesamillion.com/p/')) || ($this->hideamazonpurchase == null || $this->hideamazonpurchase == 0 && ($this->amazonbuylink != null)) || ($this->hidebnpurchase == null || $this->hidebnpurchase == 0 && ($this->isbn != null)) || ($this->hidegooglepurchase == null || $this->hidegooglepurchase == 0 && ($this->google_preview != null)) || ($this->hideitunespurchase == null || $this->hideitunespurchase == 0 ) || (($this->storefront_active == true) &&  ($this->hidecolorboxbuyimg == null || $this->hidecolorboxbuyimg == 0) && ($this->purchaselink != null && $this->purchaselink != ''))){

														} else {
															$string73 = '<div style="display:none;" >';
														}



           
														$string74 = '<div class="wpgamelist-line-5"></div>
											            <p id="wpgamelist-purchase-title-id-bottom" class="wpgamelist-purchase-title">
											                Purchase This Game At:
											            </p>
											            <div class="wpgamelist-line-6"></div>
											            <a';
			
														$string75 = '';
														if (($this->amazonbuylink == null) || ($this->hideamazonpurchase != null && $this->hideamazonpurchase != 0 )){
															$string75 = ' style="display:none;"';
														} 
														
														$string76 = ' class="wpgamelist-purchase-img" href="'.$this->amazonbuylink.'" target="_blank">
														<img src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'amazon.png" /></a>
														<a ';


														if(preg_match("/[a-z]/i", $this->isbn)){
															$string77 = '/></a>
																<a ';
														} else {
															$string77 = '/></a>
																<a ';
														}

														$string78 = '';
														if (($this->hidegamestoppurchase != null && $this->hidegamestoppurchase != 0 )){
															$string78 = ' style="display:none;"';
														} 
															
														$string79 = ' class="wpgamelist-purchase-img" href="'.$this->gamestopurl.'" target="_blank">
														<img src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'gamestop.png" /></a>
														<a ';

														$string80 = '';
														if (($this->hidebestbuypurchase != null && $this->hidebestbuypurchase != 0 )){
															$string80 = ' style="display:none;"';
														}

														$string81 = ' class="wpgamelist-purchase-img" href="'.$this->bestbuyurl.'" target="_blank">
														<img src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'bestbuy.png" /></a><a ';

														$string82 = '';
														if (($this->hidesteampurchase != null && $this->hidesteampurchase != 0 )){
															$string82 = ' style="display:none;"';
														}

														$string88 = ' class="wpgamelist-purchase-img" href="'.$this->steamurl.'" target="_blank">
																<img src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'steam.png" id="wpgamelist-itunes-img" /></a><a ';

														$string89 = '';
														if (($this->hideebaypurchase != null && $this->hideebaypurchase != 0 )){
															$string89 = ' style="display:none;"';
														}

														$string90 = ' class="wpgamelist-purchase-img" href="'.$this->ebayurl.'" target="_blank">
																<img src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'ebay.png" id="wpgamelist-itunes-img" /></a><a ';

														$string91 = '';
														if(($this->enablepurchase != null && $this->enablepurchase != 0) && $this->purchaselink != null && $this->purchaselink != '' && $this->hidecolorboxbuyimg != 1){
															if(has_filter('wpgamelist_append_to_colorbox_purchase_image_link')) {
	            												$string91 = $string91.apply_filters('wpgamelist_append_to_colorbox_purchase_image_link', $this->purchaselink);
	        												}
        												}

        												$string83 = '';
														if(($this->hidekobopurchase == null || $this->hidekobopurchase == 0 && ($this->kobo_link != null && $this->kobo_link != 'http://store.kobogames.com/en-ca/Search?Query=')) || ($this->hidebampurchase == null || $this->hidebampurchase == 0 && ($this->bam_link != null && $this->bam_link != 'http://www.gamesamillion.com/p/')) || ($this->hideamazonpurchase == null || $this->hideamazonpurchase == 0 && ($this->amazonbuylink != null)) || ($this->hidebnpurchase == null || $this->hidebnpurchase == 0 && ($this->isbn != null)) || ($this->hidegooglepurchase == null || $this->hidegooglepurchase == 0 && ($this->google_preview != null)) || ($this->hideitunespurchase == null || $this->hideitunespurchase == 0 ) || (($this->storefront_active == true) &&  ($this->hidecolorboxbuyimg == null || $this->hidecolorboxbuyimg == 0) && ($this->purchaselink != null && $this->purchaselink != ''))){

														} else {
															$string83 = '</div>';
														}


		$this->output = $string1.$string2.$string3.$string98.$string99.$string4.$string5.$string6.$string7.$string8.$string9.$string10.$string11.$string12.$string13.$string14.$string15.$string16.$string17.$string18.$string19.$string20.$string21.$string22.$string23.$string24.$string25.$string26.$string27.$string28.$string92.$string93.$string94.$string95.$string96.$string97.$string29.$string30.$string31.$string32.$string33.$string34.$string35.$string36.$string37.$string38.$string39.$string40.$string41.$string42.$string43.$string44.$string45.$string46.$string47.$string48.$string49.$string50.$string51.$string52.$string53.$string54.$string55.$string100.$string101.$string56.$string57.$string84.$string85.$string86.$string87.$string58.$string59.$string61.$string62.$string63.$string64.$string65.$string66.$string67.$string103.$string102.$string68.$string69.$string70.$string71.$string72.$string73.$string74.$string75.$string76.$string77.$string78.$string79.$string80.$string81.$string82.$string83.$string88.$string89.$string90.$string91;

   
	}

	private function gather_gamefinder_data(){
		$this->title = $this->game_array['title'];
		$this->author = $this->game_array['author'];
		$this->category = $this->game_array['category'];
		$this->pages = $this->game_array['pages'];
		$this->pub_year = $this->game_array['pub_year'];
		$this->publisher = $this->game_array['publisher'];
		$this->description = $this->game_array['description'];
		$this->image = $this->game_array['image'];
		$this->similaramazonproducts_array = array();
		$this->amazonreviewiframe = $this->game_array['reviews'];
		$this->isbn = $this->game_array['isbn'];
		$this->amazonbuylink = $this->game_array['details'];
		$this->similaramazonproducts = $this->game_array['similaramazonproducts'];
		$this->kobo_link = $this->game_array['kobo_link'];
		$this->bam_link = $this->game_array['bam_link'];
	}



}


endif;