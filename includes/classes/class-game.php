<?php
/**
 * WPGameList Game Class
 * Handles functions for:
 * - Saving a Game to database
 * - Editing existing games
 * - Deleting Existing games
 * @author   Jake Evans
 * @category Root Product
 * @package  Includes/Classes
 * @version  1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPGameList_Game', false ) ) :
/**
 * WPGameList_Game Class.
 */
class WPGameList_Game {

	// General class stuff
	public $searchtitle;
	public $searchresult;
	public $apikey;
	public $tableplatform;
	public $tablecompany;
	public $tablegenres;
	public $maingametable;
	public $addgameresult;
	public $editgameresult;
	public $amazon_array;

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
	public $price;
	public $purchaselink;
	public $releasedate;
	public $finisheddate;
	public $esrb;
	public $pegi;
	public $owned;
	public $gamecondition;
	public $finished;
	public $myrating;
	public $library;
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


	public function __construct($action = null, $game_array = null, $game_title = null, $id = null) {
			
		global $wpdb;

		// Getting API key, if user has provided it
		$table_name_options = $wpdb->prefix . 'wpgamelist_jre_user_options';
		$options_row = $wpdb->get_row("SELECT * FROM $table_name_options");
		if($options_row->amazonapipublic == null || $options_row->amazonapipublic == ''){
			$this->apikey = 'b0898850884833fbda117650e2715b3f';
		} else {
			$this->apikey = $options_row->amazonapipublic;
		}

error_log($this->apikey);

		$this->tableplatform = $wpdb->prefix . 'wpgamelist_jre_list_platform_names';
		$this->tablecompany = $wpdb->prefix . 'wpgamelist_jre_list_company_names';
		$this->tablegenres = $wpdb->prefix . 'wpgamelist_jre_list_company_names';

		$this->maingametable = $wpdb->prefix . 'wpgamelist_jre_saved_game_log';

		if($game_array != null && gettype($game_array) != 'string'){
			$this->title = $game_array['title'];
			$this->image = $game_array['image'];
			$this->platforms = $game_array['platforms'];
			$this->genres = $game_array['genres'];
			$this->developer = $game_array['developer'];
			$this->publisher = $game_array['publisher'];
			$this->rating = $game_array['rating'];
			$this->criticrating = $game_array['criticrating'];
			$this->perspective = $game_array['perspective'];
			$this->gamemodes = $game_array['gamemodes'];
			$this->themes = $game_array['themes'];
			$this->series = $game_array['series'];
			$this->franchise = $game_array['franchise'];
			$this->igdblink = $game_array['igdblink'];
			$this->price = $game_array['price'];
			$this->purchaselink = $game_array['purchaselink'];
			$this->releasedate = $game_array['releasedate'];
			$this->finishdate = $game_array['finishdate'];
			$this->esrb = $game_array['esrb'];
			$this->pegi = $game_array['pegi'];
			$this->owned = $game_array['owned'];
			$this->gamecondition = $game_array['gamecondition'];
			$this->finished = $game_array['finished'];
			$this->myrating = $game_array['myrating'];
			$this->library = $game_array['library'];
			$this->summary = $game_array['summary'];
			$this->notes = $game_array['notes'];
			$this->videos = $game_array['videos'];
			$this->websites = $game_array['websites'];
			$this->screenshots = $game_array['screenshots'];
			$this->altnames = $game_array['altnames'];
			$this->woocommerce = $game_array['woocommerce'];
			$this->saleprice = $game_array['saleprice'];
			$this->regularprice = $game_array['regularprice'];
			$this->stock = $game_array['stock'];
			$this->length = $game_array['length'];
			$this->width = $game_array['width'];
			$this->height = $game_array['height'];
			$this->weight = $game_array['weight'];
			$this->sku = $game_array['sku'];
			$this->virtual = $game_array['virtual'];
			$this->download = $game_array['download'];
			$this->woofile = $game_array['woofile'];
			$this->salebegin = $game_array['salebegin'];
			$this->saleend = $game_array['saleend'];
			$this->purchasenote = $game_array['purchasenote'];
			$this->productcategory = $game_array['productcategory'];
			$this->reviews = $game_array['reviews'];
			$this->crosssells = $game_array['crosssells'];
			$this->upsells = $game_array['upsells'];
			$this->page = $game_array['page'];
			$this->post = $game_array['post'];
		}


		if($action == 'mainsearch'){
			$this->searchtitle = $game_title;
			$this->search_for_game();
		}

		if($action == 'add'){
			$this->add_game();
		}

		if($action == 'edit'){
			$this->id = $id;
			$this->edit_game();
		}

		if($action == 'delete'){
			$this->id = $id;
			$this->delete_game();
		}

		if($action == 'gamefinder-colorbox'){
			$this->gather_google_data();
			$this->gather_open_library_data();
			$this->gather_itunes_data();
			$this->create_buy_links();

			
		}
		
	}

	private function add_game(){
		// First do Amazon Authorization check
		$this->gather_amazon_data();
		$this->create_buy_links();
		$this->set_default_woocommerce_data();
		$this->create_wpgamelist_woocommerce_product();
		$this->add_to_db();
		/*
		$this->set_default_woocommerce_data();
		$this->create_wpgamelist_woocommerce_product();
		$this->add_to_db();
*/
	}

	private function search_for_game(){
		//$this->searchresult = 'hithereyo';

		$result = '';
		$responsecode = '';
		
    		if (function_exists('curl_init')){ 
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				    'user-key: '.$this->apikey,
				    'Accept: application/json'
				));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); 
				curl_setopt($ch, CURLOPT_TIMEOUT, 10); //timeout in seconds
				$url = 'https://api-endpoint.igdb.com/games/?search='.urlencode($this->searchtitle);
				curl_setopt($ch, CURLOPT_URL, $url);
				$this->searchresult = curl_exec($ch);
				$responsecode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				curl_close($ch);
	    	} else {
	        	//#TODO: Log an error here in a log class like maintainme's saying both file_get_contents and cURL aren't available.
	    	}
	    	if($this->searchresult != ''){

	    		$this->searchresult = json_decode($this->searchresult);

	    		$finalsearchresultarray = array();
	    		foreach ($this->searchresult as $key => $gameid) {

	    			$ch = curl_init();
					curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					    'user-key: '.$this->apikey,
					    'Accept: application/json'
					));
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
					curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); 
					curl_setopt($ch, CURLOPT_TIMEOUT, 10); //timeout in seconds
					$url = 'https://api-endpoint.igdb.com/games/'.$gameid->id;
					curl_setopt($ch, CURLOPT_URL, $url);
					$gameidresult = curl_exec($ch);
					$responsecode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
					curl_close($ch);

					$gameidresult = json_decode($gameidresult);
					array_push($finalsearchresultarray, $gameidresult);
	    			
	    		}
	    	}

	    	

	    	# Modify the final array to translate things like platform and company name ids into text
	    	// Translating Genres
	    	$genrestring = '';
	    	$string = file_get_contents(JSON_DIR."genre_names.json");
	    	$jsonIterator = new RecursiveIteratorIterator(
			    new RecursiveArrayIterator(json_decode($string, TRUE)),
			    RecursiveIteratorIterator::SELF_FIRST);

			foreach ($jsonIterator as $key => $val) {
			    if(is_array($val)) {
			        foreach ($finalsearchresultarray as $key1 => $game) {
			        	if(property_exists($game[0], 'genres')){
				        	foreach ($game[0]->genres as $key2 => $genres) {
				        		if($genres == $val['id']){
				        			$finalsearchresultarray[$key1][0]->genres[$key2] = $val['name'];
				        			$genrestring = $genrestring.', '.$val['name'];
				        		}
				        	}
			        	}
			        }
			    }
			}

			// Translating Platforms
	    	$platformstring = '';
	    	$string = file_get_contents(JSON_DIR."platform_list.json");
	    	$jsonIterator = new RecursiveIteratorIterator(
			    new RecursiveArrayIterator(json_decode($string, TRUE)),
			    RecursiveIteratorIterator::SELF_FIRST);

			foreach ($jsonIterator as $key => $val) {
			    if(is_array($val)) {
			        foreach ($finalsearchresultarray as $key1 => $game) {
			        	if(property_exists($game[0], 'platforms')){
				        	foreach ($game[0]->platforms as $key2 => $platforms) {
				        		if($platforms == $val['matchingid']){
				        			$finalsearchresultarray[$key1][0]->platforms[$key2] = $val['platformname'];
				        			$platformstring = $platformstring.', '.$val['platformname'];
				        		}
				        	}
			        	}
			        }
			    }
			}

			// Translating publishers
	    	$publisherstring = '';
	    	$string = file_get_contents(JSON_DIR."company_names_formatted_backup.json");
	    	$jsonIterator = new RecursiveIteratorIterator(
			    new RecursiveArrayIterator(json_decode($string, TRUE)),
			    RecursiveIteratorIterator::SELF_FIRST);

			foreach ($jsonIterator as $key => $val) {
			    if(is_array($val)) {
			        foreach ($finalsearchresultarray as $key1 => $game) {
			        	if(property_exists($game[0], 'publishers')){
				        	foreach ($game[0]->publishers as $key2 => $publishers) {
				        		if($publishers == $val['matchingcompid']){
				        			$finalsearchresultarray[$key1][0]->publishers[$key2] = $val['companyname'];
				        			$publisherstring = $publisherstring.', '.$val['companyname'];
				        		}
				        	}
			        	}
			        }
			    }
			}

			// Translating developers
	    	$developerstring = '';
	    	$string = file_get_contents(JSON_DIR."company_names_formatted_backup.json");
	    	$jsonIterator = new RecursiveIteratorIterator(
			    new RecursiveArrayIterator(json_decode($string, TRUE)),
			    RecursiveIteratorIterator::SELF_FIRST);

			foreach ($jsonIterator as $key => $val) {
			    if(is_array($val)) {
			        foreach ($finalsearchresultarray as $key1 => $game) {
			        	if(property_exists($game[0], 'developers')){
				        	foreach ($game[0]->developers as $key2 => $developers) {
				        		if($developers == $val['matchingcompid']){
				        			$finalsearchresultarray[$key1][0]->developers[$key2] = $val['companyname'];
				        			$developerstring = $developerstring.', '.$val['companyname'];
				        		}
				        	}
			        	}
			        }
			    }
			}

			// Translating game modes
	    	$gamemodestring = '';
	    	$string = file_get_contents(JSON_DIR."igdb_game_modes.json");
	    	$jsonIterator = new RecursiveIteratorIterator(
			    new RecursiveArrayIterator(json_decode($string, TRUE)),
			    RecursiveIteratorIterator::SELF_FIRST);

			foreach ($jsonIterator as $key => $val) {
			    if(is_array($val)) {
			        foreach ($finalsearchresultarray as $key1 => $game) {
			        	if(property_exists($game[0], 'game_modes')){
				        	foreach ($game[0]->game_modes as $key2 => $game_modes) {
				        		if($game_modes == $val['matchingid']){
				        			$finalsearchresultarray[$key1][0]->game_modes[$key2] = $val['gamemodename'];
				        			$gamemodestring = $gamemodestring.', '.$val['gamemodename'];
				        		}
				        	}
			        	}
			        }
			    }
			}

			// Translating player_perspectives
	    	$playerperspectivestring = '';
	    	$string = file_get_contents(JSON_DIR."igdb_perspectives.json");
	    	$jsonIterator = new RecursiveIteratorIterator(
			    new RecursiveArrayIterator(json_decode($string, TRUE)),
			    RecursiveIteratorIterator::SELF_FIRST);

			foreach ($jsonIterator as $key => $val) {
			    if(is_array($val)) {
			        foreach ($finalsearchresultarray as $key1 => $game) {
			        	if(property_exists($game[0], 'player_perspectives')){
				        	foreach ($game[0]->player_perspectives as $key2 => $player_perspectives) {
				        		if($player_perspectives == $val['matchingid']){
				        			$finalsearchresultarray[$key1][0]->player_perspectives[$key2] = $val['perspectivename'];
				        			$playerperspectivestring = $playerperspectivestring.', '.$val['perspectivename'];
				        		}
				        	}
			        	}
			        }
			    }
			}


			// Translating themes
	    	$themesstring = '';
	    	$string = file_get_contents(JSON_DIR."igdb_themes.json");
	    	$jsonIterator = new RecursiveIteratorIterator(
			    new RecursiveArrayIterator(json_decode($string, TRUE)),
			    RecursiveIteratorIterator::SELF_FIRST);

			foreach ($jsonIterator as $key => $val) {
			    if(is_array($val)) {
			        foreach ($finalsearchresultarray as $key1 => $game) {
			        	if(property_exists($game[0], 'themes')){
				        	foreach ($game[0]->themes as $key2 => $themes) {
				        		if($themes == $val['matchingid']){
				        			$finalsearchresultarray[$key1][0]->themes[$key2] = $val['themename'];
				        			$themesstring = $themesstring.', '.$val['themename'];
				        		}
				        	}
			        	}
			        }
			    }
			}

			// Translating Series (collection in the api)
	    	$collectionstring = '';
	    	$string = file_get_contents(JSON_DIR."igdb_series.json");
	    	$jsonIterator = new RecursiveIteratorIterator(
			    new RecursiveArrayIterator(json_decode($string, TRUE)),
			    RecursiveIteratorIterator::SELF_FIRST);

			foreach ($jsonIterator as $key => $val) {
			    if(is_array($val)) {
			        foreach ($finalsearchresultarray as $key1 => $game) {
			        	if(property_exists($game[0], 'collection')){
			        		if($game[0]->collection == $val['matchingid']){
			        			$finalsearchresultarray[$key1][0]->collection = $val['collectionname'];
			        			$collectionstring = $collectionstring.', '.$val['collectionname'];
			        		}
			        	}
			        }
			    }
			}

			// Translating franchise
	    	$franchisestring = '';
	    	$string = file_get_contents(JSON_DIR."igdb_franchises.json");
	    	$jsonIterator = new RecursiveIteratorIterator(
			    new RecursiveArrayIterator(json_decode($string, TRUE)),
			    RecursiveIteratorIterator::SELF_FIRST);

			foreach ($jsonIterator as $key => $val) {
			    if(is_array($val)) {
			        foreach ($finalsearchresultarray as $key1 => $game) {

			        	// If there is a Franchise array
			        	if(property_exists($game[0], 'franchises')){
				        	foreach ($game[0]->franchises as $key2 => $franchise) {
				        		if($franchise == $val['matchingid']){
				        			$finalsearchresultarray[$key1][0]->franchises[$key2] = $val['franchisename'];
				        			$franchisestring = $franchisestring.', '.$val['franchisename'];
				        		}
				        	}
			        	}
			        }
			    }
			}

			



			$this->searchresult = $finalsearchresultarray;

	}




	private function gather_amazon_data(){
		global $wpdb;

		// Get associate tag for creating API call post data
		$table_name_options = $wpdb->prefix . 'wpgamelist_jre_user_options';
  		$this->options_results = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name_options", $table_name_options));

		$params = array();

		# Build Query
		// Determine Amazon region
		$region = '';
		switch ($this->options_results->amazoncountryinfo) {
	        case "au":
	        	$region = 'com';
	            break;
	        case "ca":
	        	$region = 'ca';
	            break;
	        case "fr":
	        	$region = 'fr';
	            break;
	        case "de":
	        	$region = 'de';
	            break;
	        case "in":
	        	$region = 'in';
	            break;
	        case "it":
	        	$region = 'it';
	            break;
	        case "jp":
	        	$region = 'co.jp';
	            break;
	        case "mx":
	        	$region = 'com.mx';
	            break;
	        case "es":
	        	$region = 'es';
	            break;
	        case "uk":
	        	$region = 'co.uk';
	            break;
	        default:
	        	$region = 'com';
	            //$this->amazondetailpage = $saved_game->amazondetailpage;//filter_var($saved_game->amazondetailpage, FILTER_SANITIZE_URL);
	    }

/*
		// If user has saved their own Amazon API Keys
		if($this->options_results->amazonapisecret != null && $this->options_results->amazonapisecret != '' && $this->options_results->amazonapipublic != null && $this->options_results->amazonapipublic != ''){
			$postdata = http_build_query(
			  array(
			      'title' => $this->title,
			      'associate_tag' => $this->options_results->amazonaff,
			      'region' => $region,
			      'api_secret'=>$this->options_results->amazonapisecret,
			      'api_public'=>$this->options_results->amazonapipublic
			  )
			);
		} else {
*/
			$postdata = http_build_query(
			  array(
			      'game_title' => $this->title,
			      'associate_tag' => $this->options_results->amazonaff,
			      'region' => $region,
			  )
			);
		//}
		$opts = array('http' =>
		  array(
		      'method'  => 'POST',
		      'header'  => 'Content-type: application/x-www-form-urlencoded',
		      'content' => $postdata
		  )
		);

		$context = stream_context_create($opts);
		$result = null;


		$result = '';
    	if(function_exists('file_get_contents')){
    		$result = file_get_contents('https://sublime-vine-199216.appspot.com/?'.$postdata);
    	}

    	if($result == ''){
    		if (function_exists('curl_init')){ 
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$url = 'https://sublime-vine-199216.appspot.com/?'.$postdata;
				curl_setopt($ch, CURLOPT_URL, $url);

				if($this->options_results->amazonapisecret != null && $this->options_results->amazonapisecret != '' && $this->options_results->amazonapipublic != null && $this->options_results->amazonapipublic != ''){
					$data = array('api_public'=>$this->options_results->amazonapipublic, 'api_secret'=>$this->options_results->amazonapisecret, 'book_page' => $this->book_page, 'book_title' => $this->title, 'book_author' => $this->author, 'associate_tag' => $this->options_results->amazonaff, 'isbn' => $this->isbn);
				} else {
					$data = array('book_title' => $this->title, 'associate_tag' => $this->options_results->amazonaff, 'isbn' => $this->isbn);
				}

				//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
				$result = curl_exec($ch);
				$responsecode = curl_getinfo($ch, CURLINFO_HTTP_CODE);


				if($responsecode == 200){

				}
				curl_close($ch);
	    	} else {
	        	//#TODO: Log an error here in a log class like maintainme's saying both file_get_contents and cURL aren't available.
	    	}
    	}



    	$result = explode('</ItemSearchResponse>', $result);
    	$result = $result[0].'</ItemSearchResponse>';

    	// Convert result from API call to regular ol' array
		$xml = simplexml_load_string($result, 'SimpleXMLElement', LIBXML_NOCDATA);

		// if there was an error parsing the XML, try again by re-running the function
		if($xml === false){
			error_log('Calling Self');
			//$this->gather_amazon_data();
		}

		$json = json_encode($xml);
		$this->amazon_array = json_decode($json,TRUE);
		# Begin assigning values from $this->amazon_array to properties


		// Getting amazon link, if we don't already have one
		$this->amazonbuylink = $this->amazon_array['Items']['Item'][0]['DetailPageURL'];
		if($this->amazonbuylink == null || $this->amazonbuylink == ''){
			$this->amazonbuylink = $this->amazon_array['Items']['Item']['DetailPageURL'];
		}

		// Getting Amazon reviews iFrame
		if($this->amazonreviewiframe == null || $this->amazonreviewiframe == ''){
			$this->amazonreviewiframe = $this->amazon_array['Items']['Item'][0]['CustomerReviews']['IFrameURL'];
			if($this->amazonreviewiframe == null || $this->amazonreviewiframe == ''){
				$this->amazonreviewiframe = $this->amazon_array['Items']['Item']['CustomerReviews']['IFrameURL'];
			}
		}
		// Setting up iFrame to play with https
		if( isset($_SERVER['HTTPS'] ) ) {
            $pos = strpos($this->amazonreviewiframe, ':');
            $this->amazonreviewiframe = substr_replace($this->amazonreviewiframe, 'https', 0, $pos);
        }
        
        // Getting similar games
        $similarproductsstring = '';
		if($this->similaramazonproducts == null || $this->similaramazonproducts == ''){
			$this->similaramazonproducts = $this->amazon_array['Items']['Item'][0]['SimilarProducts']['SimilarProduct'];
			if(is_array($this->similaramazonproducts)){
				foreach($this->similaramazonproducts as $prod){
			      $similarproductsstring = $similarproductsstring.';bsp;'.$prod['ASIN'].'---'.$prod['Title'];

			    }
			    $this->similaramazonproducts = $similarproductsstring;
			}

			if($this->similaramazonproducts == null || $this->similaramazonproducts == ''){
				$this->similaramazonproducts = $this->amazon_array['Items']['Item']['SimilarProducts']['SimilarProduct'];
				if(is_array($this->similaramazonproducts)){
					foreach($this->similaramazonproducts as $prod){
				      $similarproductsstring = $similarproductsstring.';bsp;'.$prod['ASIN'].'---'.$prod['Title'];

				    }
				    $this->similaramazonproducts = $similarproductsstring;
				}
			}
		}
	}

	private function create_buy_links(){

		$this->gamestopurl = 'http://www.gamestop.com/browse?nav=16k-3-'.urlencode($this->title);
    	$this->bestbuyurl = 'http://www.bestbuy.com/site/searchpage.jsp?st='.urlencode($this->title).'&_dyncharset=UTF-8&id=pcat17071&type=page&sc=Global&cp=1&nrp=&sp=&qp=&list=n&af=true&iht=y&usc=All+Categories&ks=960&keys=keys';
    	$this->steamurl = 'http://store.steampowered.com/search/?snr=1_7_7_151_12&term='.urlencode($this->title);
    	$this->ebayurl = 'http://www.ebay.com/sch/Video-Games-Consoles/1249/i.html?_from=R40&_nkw='.urlencode($this->title);
	}

	private function set_default_woocommerce_data(){
		global $wpdb;

		// Check to see if Storefront extension is active
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if(is_plugin_active('wpgamelist-storefront/wpgamelist-storefront.php')){
			
			// Get saved settings
	    	$settings_table = $wpdb->prefix."wpgamelist_jre_storefront_options";
	    	$settings = $wpdb->get_row("SELECT * FROM $settings_table");

	    	if($this->saleprice == '' || $this->saleprice == null){
	    		$this->saleprice = $settings->defaultsaleprice;
	    	}

	    	if($this->regularprice == '' || $this->regularprice == null){
	    		$this->regularprice = $settings->defaultprice;
	    	}

	    	if($this->stock == '' || $this->stock == null){
	    		$this->stock = $settings->defaultstock;
	    	}

	    	if($this->length == '' || $this->length == null){
	    		$this->length = $settings->defaultlength;
	    	}

	    	if($this->width == '' || $this->width == null){
	    		$this->width = $settings->defaultwidth;
	    	}

	    	if($this->height == '' || $this->height == null){
	    		$this->height = $settings->defaultheight;
	    	}

	    	if($this->weight == '' || $this->weight == null){
	    		$this->weight = $settings->defaultweight;
	    	}

	    	if($this->sku == '' || $this->sku == null){
	    		$this->sku = $settings->defaultsku;
	    	}

	    	if($this->virtual == '' || $this->virtual == null){
	    		$this->virtual = $settings->defaultvirtual;
	    	}

	    	if($this->download == '' || $this->download == null){
	    		$this->download = $settings->defaultdownload;
	    	}

	    	if($this->salebegin == '-undefined-undefined' || $this->salebegin == null){
	    		$this->salebegin = $settings->defaultsalebegin;
	    	}

	    	if($this->saleend == '-undefined-undefined' || $this->saleend == null){
	    		$this->saleend = $settings->defaultsaleend;
	    	}

	    	if($this->purchasenote == '' || $this->purchasenote == null){
	    		$this->purchasenote = $settings->defaultnote;
	    	}

	    	if($this->productcategory == '' || $this->productcategory == null){
	    		$this->productcategory = $settings->defaultcategory;
	    	}

	    	if($this->upsells == '' || $this->upsells == null){
	    		$this->upsells = $settings->defaultupsell;
	    	}

	    	if($this->crosssells == '' || $this->crosssells == null){
	    		$this->crosssells = $settings->defaultcrosssell;
	    	}

		}

	}

	private function create_wpgamelist_woocommerce_product(){

		global $wpdb;
		error_log('in create_wpgamelist_woocommerce_product');
		if($this->woocommerce === 'Yes'){

			$price = '';
			$regularprice = '';
			if($this->price != null && $this->price != ''){
				if(!is_numeric($this->price[0])){
					$price = substr($this->price, 1);
				}
			} else {
				if($this->regularprice != null && $this->regularprice != ''){
					if(!is_numeric($this->regularprice[0])){
						$regularprice = substr($this->regularprice, 1);
					} 
				} else {
					$regularprice = '0.00';
				}
			}

			$woocommerce_existing_id = $wpdb->get_row($wpdb->prepare("SELECT * FROM $this->library WHERE ID = %d",$this->id ));
			
			include_once( GAMELIST_STOREFRONT_CLASS_DIR . 'class-storefront-woocommerce.php');
  			$this->woocommerceobject = new WPGameList_StoreFront_WooCommerce($this->title, $this->description, $this->image, $price, $regularprice, $this->saleprice, $this->stock, $this->length, $this->width, $this->height, $this->weight, $this->sku, $this->virtual, $this->download, $this->woofile, $this->salebegin, $this->saleend, $this->purchasenote, $this->productcategory, $this->reviews, $woocommerce_existing_id->woocommerce, $this->upsells, $this->crosssells);

  			$this->wooid = $this->woocommerceobject->post_id;
  			$this->woocommerce = $this->wooid;
  			error_log('Woocommerce post id:'.$this->woocommerceobject->post_id.' and '.$woocommerce_existing_id->woocommerce);

  			// Get the WooCommerce product link, if purchase link hasn't been provided
  			if($this->purchaselink == '' || $this->purchaselink == null){
  				$this->purchaselink = get_permalink($this->wooid);
  			}

		}
	}

	private function add_to_db(){

		// Create a unique identifier for this game
		$this->game_uid = uniqid();

		if($this->page == 'Yes' || $this->post == 'Yes'){
			$page_post_array = array(
				'title' => $this->title,
				'image' => $this->image,
				'platforms' => $this->platforms,
				'genres' => $this->genres,
				'developer' => $this->developer,
				'publisher' => $this->publisher,
				'rating' => $this->rating,
				'criticrating' => $this->criticrating,
				'perspective' => $this->perspective,
				'gamemodes' => $this->gamemodes,
				'themes' => $this->themes,
				'series' => $this->series,
				'franchise' => $this->franchise,
				'igdblink' => $this->igdblink,
				'price' => $this->price,
				'purchaselink' => $this->purchaselink,
				'releasedate' => $this->releasedate,
				'finishdate' => $this->finishdate,
				'esrb' => $this->esrb,
				'pegi' => $this->pegi,
				'owned' => $this->owned,
				'gamecondition' => $this->gamecondition,
				'finished' => $this->finished,
				'myrating' => $this->myrating,
				'library' => $this->library,
				'summary' => $this->summary,
				'notes' => $this->notes,
				'videos' => $this->videos,
				'websites' => $this->websites,
				'screenshots' => $this->screenshots,
				'altnames' => $this->altnames,
				'woocommerce' => $this->woocommerce,
				'saleprice' => $this->saleprice,
				'regularprice' => $this->regularprice,
				'stock' => $this->stock,
				'length' => $this->length,
				'width' => $this->width,
				'height' => $this->height,
				'weight' => $this->weight,
				'sku' => $this->sku,
				'virtual' => $this->virtual,
				'download' => $this->download,
				'woofile' => $this->woofile,
				'salebegin' => $this->salebegin,
				'saleend' => $this->saleend,
				'purchasenote' => $this->purchasenote,
				'productcategory' => $this->productcategory,
				'reviews' => $this->reviews,
				'crosssells' => $this->crosssells,
				'upsells' => $this->upsells,
				'page' => $this->page,
				'post' => $this->post,
				'amazonbuylink' => $this->amazonbuylink,
				'amazonreviewiframe' => $this->amazonreviewiframe,
				'similaramazonproducts' => $this->similaramazonproducts,
				'gamestopurl' => $this->gamestopurl,
				'bestbuyurl' => $this->bestbuyurl,
				'steamurl' => $this->steamurl,
				'ebayurl' => $this->ebayurl,
				'game_uid' => $this->game_uid,
			);

			# Each of these class instantiations will return the ID of the page/post created for storage in DB
			
			if($this->post == 'Yes'){
				require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-post.php');
				$post = new WPGameList_Post($page_post_array);
				$this->post = $post->post_id;
			}

			
			if($this->page == 'Yes'){
				require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-page.php');
				$page = new WPGameList_Page($page_post_array);
				$this->page = $page->create_result;
			}

		}

		// Check to see if Storefront extension is active
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if(is_plugin_active('wpgamelist-storefront/wpgamelist-storefront.php')){
			if($this->author_url == '' || $this->author_url == null){
				if($this->wooid != '' || $this->wooid != null){
					$this->author_url = get_permalink($this->wooid);

					if($this->price == null || $this->price == ''){
						$this->price = $this->regularprice;
					}
				}
			}
		}

		// Final data mods before saving
		if($this->owned == 'No'){
			$this->gamecondition = 'N/A';
		}

		// Flip the date for more human-readableness
		if($this->releasedate != '' && $this->releasedate != null){
			$tempdate = explode('-', $this->releasedate);
			$this->releasedate = $tempdate[1].'-'.$tempdate[2].'-'.$tempdate[0];
		}

		// Flip the date for more human-readableness
		if($this->finishdate != '' && $this->finishdate != null){
			$tempdate = explode('-', $this->finishdate);
			$this->finishdate = $tempdate[1].'-'.$tempdate[2].'-'.$tempdate[0];
		}


		$final_save_array = array(
          	'title' => $this->title,
			'image' => $this->image,
			'platforms' => $this->platforms,
			'genres' => $this->genres,
			'developer' => $this->developer,
			'publisher' => $this->publisher,
			'rating' => $this->rating,
			'criticrating' => $this->criticrating,
			'perspective' => $this->perspective,
			'gamemodes' => $this->gamemodes,
			'themes' => $this->themes,
			'series' => $this->series,
			'franchise' => $this->franchise,
			'igdblink' => $this->igdblink,
			'price' => $this->price,
			'purchaselink' => $this->purchaselink,
			'releasedate' => $this->releasedate,
			'finishdate' => $this->finishdate,
			'esrb' => $this->esrb,
			'pegi' => $this->pegi,
			'owned' => $this->owned,
			'gamecondition' => $this->gamecondition,
			'finished' => $this->finished,
			'myrating' => $this->myrating,
			'summary' => $this->summary,
			'notes' => $this->notes,
			'videos' => $this->videos,
			'websites' => $this->websites,
			'screenshots' => $this->screenshots,
			'altnames' => $this->altnames,
			'woocommerce' => $this->woocommerce,
			'page' => $this->page,
			'post' => $this->post,
			'amazonbuylink' => $this->amazonbuylink,
			'amazonreviewiframe' => $this->amazonreviewiframe,
			'similaramazonproducts' => $this->similaramazonproducts,
			'gamestopurl' => $this->gamestopurl,
			'bestbuyurl' => $this->bestbuyurl,
			'steamurl' => $this->steamurl,
			'ebayurl' => $this->ebayurl,
			'game_uid' => $this->game_uid,
          );

		error_log('$final_save_array');
		error_log(print_r($final_save_array, TRUE));

		// Adding submitted values to the DB
		global $wpdb;
		$result = $wpdb->insert( $this->library, $final_save_array,
        array(
        	'%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%d',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s'
          )   
  		);


		$this->addgameresult = $result;
		if($result == 1){
			$row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $this->library WHERE game_uid = %s", $this->game_uid));
			$this->addgameresult = $this->addgameresult.','.$row->ID;
		}
		// TODO: Create a log class to record the result of adding the game - or maybe just record an error, if there is one. Make a link for the log file somehwere, on settings page perhaps, for user to download. 

		
	}


	public static function display_edit_game_form(){

		// Perform check for previously-saved Amazon Authorization
		global $wpdb;
		$table_name = $wpdb->prefix . 'wpgamelist_jre_user_options';
		$opt_results = $wpdb->get_row("SELECT * FROM $table_name");

		$table_name = $wpdb->prefix . 'wpgamelist_jre_list_dynamic_db_names';
		$db_row = $wpdb->get_results("SELECT * FROM $table_name");

		// For grabbing an image from media library
		wp_enqueue_media();
	 	$string1 = '<div id="wpgamelist-addgame-container">
          		<form id="wpgamelist-addgame-form" method="post" action="">
	          		<div id="wpgamelist-add-game-form-div">
                		<div class="wpgamelist-add-game-form-row">
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Game Title','wpgamelist').'</label>
            				</div>
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Cover Image','wpgamelist').'&nbsp;&nbsp;</label><input id="wpgamelist-addgame-upload_image_button" type="button" value="Choose Image">
            				</div>
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Release Date','wpgamelist').'</label>
            				</div>
            			</div>
            			<div class="wpgamelist-add-game-form-row">
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-1" type="text"></input>
                			</div>
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-2" type="text"></input>
                			</div>
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-date-input" id="wpgamelist-add-game-date-input-1" type="date"></input>
                			</div>
            			</div>
            			<br/>
                        <br/>
            			<div class="wpgamelist-add-game-form-row">
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Platforms','wpgamelist').'</label>
            				</div>
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Genres','wpgamelist').'&nbsp;&nbsp;</label>
            				</div>
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Developer','wpgamelist').'</label>
            				</div>
            			</div>
            			<div class="wpgamelist-add-game-form-row">
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-3" type="text"></input>
                			</div>
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-4" type="text"></input>
                			</div>
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-5" type="text"></input>
                			</div>
            			</div>
            			<br/>
                        <br/>
            			<div class="wpgamelist-add-game-form-row">
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Publishers','wpgamelist').'</label>
            				</div>
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('IGDB Member Rating','wpgamelist').'&nbsp;&nbsp;</label>
            				</div>
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Average Critic Rating','wpgamelist').'</label>
            				</div>
            			</div>
            			<div class="wpgamelist-add-game-form-row">
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-6" type="text"></input>
                			</div>
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-7" type="text"></input>
                			</div>
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-8" type="text"></input>
                			</div>
            			</div>	
            			<br/>
                        <br/>
            			<div class="wpgamelist-add-game-form-row">
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Perspective','wpgamelist').'</label>
            				</div>
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Game Modes','wpgamelist').'&nbsp;&nbsp;</label>
            				</div>
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Themes','wpgamelist').'</label>
            				</div>
            			</div>
            			<div class="wpgamelist-add-game-form-row">
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-9" type="text"></input>
                			</div>
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-10" type="text"></input>
                			</div>
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-11" type="text"></input>
                			</div>
            			</div>
            			<br/>
                        <br/>
            			<div class="wpgamelist-add-game-form-row">
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Series','wpgamelist').'</label>
            				</div>
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Franchise','wpgamelist').'&nbsp;&nbsp;</label>
            				</div>
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('IGDB Link','wpgamelist').'</label>
            				</div>
            			</div>
            			<div class="wpgamelist-add-game-form-row">
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-12" type="text"></input>
                			</div>
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-13" type="text"></input>
                			</div>
                			<div class="wpgamelist-add-game-form-entry">
                				<input class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-text-input-14" type="text"></input>
                			</div>
            			</div>
            			<br/>
                        <br/>
            			<div class="wpgamelist-add-game-form-row">
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('ESRB Rating','wpgamelist').'</label>
            				</div>
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Pegi Rating','wpgamelist').'&nbsp;&nbsp;</label>
            				</div>
            				<div class="wpgamelist-add-game-form-entry">
            					<label>'.__('Owned','wpgamelist').'</label>
            				</div>
            			</div>
            			<div class="wpgamelist-add-game-form-row">
                			<div class="wpgamelist-add-game-form-entry">
                                <select class="wpgamelist-add-game-select-input" id="wpgamelist-add-game-select-input-1">
                                    <option>'.__('Rating Pending','wpgamelist').'</option>
                                    <option>'.__('Early Childhood','wpgamelist').'</option>
                                    <option>'.__('Everyone','wpgamelist').'</option>
                                    <option>'.__('Everyone 10+','wpgamelist').'</option>
                                    <option>'.__('Teen','wpgamelist').'</option>
                                    <option>'.__('Mature','wpgamelist').'</option>
                                    <option>'.__('Adults Only','wpgamelist').'</option>
                                </select>
                			</div>
                			<div class="wpgamelist-add-game-form-entry wpgamelist-add-game-form-select">
                				<select class="wpgamelist-add-game-select-input" id="wpgamelist-add-game-select-input-2">
                                    <option>'.__('Parental Guidance Recommended','wpgamelist').'</option>
                                    <option>'.__('Age 3+','wpgamelist').'</option>
                                    <option>'.__('Age 7+','wpgamelist').'</option>
                                    <option>'.__('Age 12+','wpgamelist').'</option>
                                    <option>'.__('Age 16+','wpgamelist').'</option>
                                    <option>'.__('Age 18+','wpgamelist').'</option>
                                </select>
                			</div>
                			<div class="wpgamelist-add-game-form-entry wpgamelist-add-game-form-select">
                				<select class="wpgamelist-add-game-select-input" id="wpgamelist-add-game-select-input-3">
                					<option>'.__('No','wpgamelist').'</option>
                					<option>'.__('Yes','wpgamelist').'</option>
                				</select>
                			</div>
            			</div>
                        <br/>
                        <br/>
                        <div class="wpgamelist-add-game-form-row">
                            <div class="wpgamelist-add-game-form-entry">
                                <label>'.__('Condition','wpgamelist').'</label>
                            </div>
                            <div class="wpgamelist-add-game-form-entry">
                                <label>'.__('Finished','wpgamelist').'&nbsp;&nbsp;</label>
                            </div>
                            <div class="wpgamelist-add-game-form-entry">
                                <label>'.__('Date Finished','wpgamelist').'</label>
                            </div>
                        </div>
                        <div class="wpgamelist-add-game-form-row">
                            <div class="wpgamelist-add-game-form-entry">
                                <select disabled class="wpgamelist-add-game-select-input" id="wpgamelist-add-game-select-input-4">
                                    <option>'.__('New (Sealed/Unopened Packaging)','wpgamelist').'</option>
                                    <option>'.__('Like New','wpgamelist').'</option>
                                    <option>'.__('Used','wpgamelist').'</option>
                                    <option>'.__('Fair','wpgamelist').'</option>
                                    <option>'.__('Poor','wpgamelist').'</option>
                                </select>
                            </div>
                            <div class="wpgamelist-add-game-form-entry wpgamelist-add-game-form-select">
                                <select class="wpgamelist-add-game-select-input" id="wpgamelist-add-game-select-input-5">
                                    <option>'.__('No','wpgamelist').'</option>
                                    <option>'.__('Yes','wpgamelist').'</option>
                                </select>
                            </div>
                            <div class="wpgamelist-add-game-form-entry wpgamelist-add-game-form-select">
                                <input disabled class="wpgamelist-add-game-date-input" id="wpgamelist-add-game-date-input-2" type="date"></input>
                            </div>
                        </div>
                        <br/>
                        <br/>
                        <div class="wpgamelist-add-game-form-row">
                            <div class="wpgamelist-add-game-form-entry">
                                <label>'.__('Summary','wpgamelist').'</label>
                            </div>
                            <div class="wpgamelist-add-game-form-entry">
                                <label>'.__('Notes','wpgamelist').'&nbsp;&nbsp;</label>
                            </div>
                            <div class="wpgamelist-add-game-form-entry">
                                <label>'.__('My Rating','wpgamelist').'</label>&nbsp;<img id="wpgamelist-addgame-rating-img" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'5star.png">
                            </div>
                        </div>
                        <div class="wpgamelist-add-game-form-row">
                            <div class="wpgamelist-add-game-form-entry">
                                <textarea placeholder="'.__('Short Summary of Game','wpgamelist').'" class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-textarea-input-1"></textarea>
                            </div>
                            <div class="wpgamelist-add-game-form-entry wpgamelist-add-game-form-select">
                                <textarea placeholder="'.__('My Thoughts and Opinions about this Title','wpgamelist').'" class="wpgamelist-add-game-text-input" id="wpgamelist-add-game-textarea-input-2"></textarea>
                            </div>
                            <div class="wpgamelist-add-game-form-entry wpgamelist-add-game-form-select">
                                <select class="wpgamelist-add-game-select-input" id="wpgamelist-add-game-select-input-6">
                                    <option>'.__('5 Stars','wpgamelist').'</option>
                                    <option>'.__('4 Stars','wpgamelist').'</option>
                                    <option>'.__('3 Stars','wpgamelist').'</option>
                                    <option>'.__('2 Stars','wpgamelist').'</option>
                                    <option>'.__('1 Star','wpgamelist').'</option>
                                </select>
                            </div>
                        </div>
                        <br/>
                        <br/>
                        <div class="wpgamelist-add-game-form-row">
                            <div class="wpgamelist-add-game-form-entry">
                                <label>'.__('Videos','wpgamelist').'</label>
                            </div>
                            <div class="wpgamelist-add-game-form-entry">
                                <label>'.__('Websites','wpgamelist').'&nbsp;&nbsp;</label>
                            </div>
                            <div class="wpgamelist-add-game-form-entry">
                                <label>'.__('Screenshots','wpgamelist').'</label>
                            </div>
                        </div>
                        <div class="wpgamelist-add-game-form-row">
                            <div class="wpgamelist-add-game-form-entry">
                                <input class="wpgamelist-add-game-text-input wpgamelist-add-game-text-input-hidden" id="wpgamelist-add-game-hidden-text-input-1" type="text"></input>
                            </div>
                            <div class="wpgamelist-add-game-form-entry">
                                <input class="wpgamelist-add-game-text-input wpgamelist-add-game-text-input-hidden" id="wpgamelist-add-game-hidden-text-input-2" type="text"></input>
                            </div>
                            <div class="wpgamelist-add-game-form-entry">
                                <input class="wpgamelist-add-game-text-input wpgamelist-add-game-text-input-hidden" id="wpgamelist-add-game-hidden-text-input-3" type="text"></input>
                            </div>
                        </div>  
                        <br/>
                        <br/>
                        <div class="wpgamelist-add-game-form-row">
                            <div class="wpgamelist-add-game-form-entry">
                                <label>'.__('Alternative Names','wpgamelist').'</label>
                            </div>
                        </div>
                        <div class="wpgamelist-add-game-form-row">
                            <div class="wpgamelist-add-game-form-entry">
                                <input class="wpgamelist-add-game-text-input wpgamelist-add-game-text-input-hidden" id="wpgamelist-add-game-hidden-text-input-4" type="text"></input>
                            </div>
                        </div>  
                        <br/>
                        <br/>
                        <br/>
                        <br/>
                         <div class="wpgamelist-add-game-form-row">
                            <div class="wpgamelist-add-game-form-entry">
                                <label>'.__('Create a Page for this Game?','wpgamelist').'</label>
                            </div>
                            <div class="wpgamelist-add-game-form-entry">
                                <label>'.__('Create a Post for this Game?','wpgamelist').'&nbsp;&nbsp;</label>
                            </div>
                        </div>
                        <div class="wpgamelist-add-game-form-row">
                            <div class="wpgamelist-add-game-form-entry">
                                <select class="wpgamelist-add-game-select-input" id="wpgamelist-add-game-select-input-7">
                                    <option>'.__('No','wpgamelist').'</option>
                                    <option>'.__('Yes','wpgamelist').'</option>
                                </select>
                            </div>
                            <div class="wpgamelist-add-game-form-entry wpgamelist-add-game-form-select">
                                <select class="wpgamelist-add-game-select-input" id="wpgamelist-add-game-select-input-8">
                                    <option>'.__('No','wpgamelist').'</option>
                                    <option>'.__('Yes','wpgamelist').'</option>
                                </select>
                            </div>
                        </div>
                        <br/>
                        <br/>';

                        // This filter allows the addition of one or more rows of items into the 'Add A Book' form. 
                        $string2 = '';
                        if(has_filter('wpgamelist_append_to_addgame_form')) {
                            $string2 = apply_filters('wpgamelist_append_to_addgame_form', $string2);
                        }

                        $string3 = '<div id="wpgamelist-add-game-bottom-instruction-div">
                            <div>Review the information above, then click the \'Edit Game\' button below when ready!</div>
                            <img id="wpgamelist-add-game-bottom-instruct-arrow" src="'.GAMELIST_GAMELIST_ROOT_IMG_ICONS_URL.'download-arrow.svg"/>
                        </div>
            			<div id="wpgamelist-add-game-form-submit-div">
            				<button id="wpgamelist-admin-editgame-button">'.__('Edit Game','wpgamelist').'</button>
            				<div class="wpgamelist-spinner" id="wpgamelist-spinner-2"></div>
            				<div id="wpgamelist-add-game-response-div">

            				</div>
            			</div>

                	</div>
	        	</form>
	        	<div id="wpgamelist-add-game-error-check" data-add-game-form-error="true" style="display:none" data-></div>
    		</div>';

    		return $string1.$string2.$string3;
	}

	private function edit_game(){
		global $wpdb;

		$this->create_buy_links();
		$this->gather_amazon_data();
		$this->create_buy_links();
		$this->set_default_woocommerce_data();
		$this->create_wpgamelist_woocommerce_product();
			
		if($this->page == 'Yes' || $this->post == 'Yes'){
			$page_post_array = array(
				'title' => $this->title,
				'image' => $this->image,
				'platforms' => $this->platforms,
				'genres' => $this->genres,
				'developer' => $this->developer,
				'publisher' => $this->publisher,
				'rating' => $this->rating,
				'criticrating' => $this->criticrating,
				'perspective' => $this->perspective,
				'gamemodes' => $this->gamemodes,
				'themes' => $this->themes,
				'series' => $this->series,
				'franchise' => $this->franchise,
				'igdblink' => $this->igdblink,
				'price' => $this->price,
				'purchaselink' => $this->purchaselink,
				'releasedate' => $this->releasedate,
				'finishdate' => $this->finishdate,
				'esrb' => $this->esrb,
				'pegi' => $this->pegi,
				'owned' => $this->owned,
				'gamecondition' => $this->gamecondition,
				'finished' => $this->finished,
				'myrating' => $this->myrating,
				'library' => $this->library,
				'summary' => $this->summary,
				'notes' => $this->notes,
				'videos' => $this->videos,
				'websites' => $this->websites,
				'screenshots' => $this->screenshots,
				'altnames' => $this->altnames,
				'woocommerce' => $this->woocommerce,
				'saleprice' => $this->saleprice,
				'regularprice' => $this->regularprice,
				'stock' => $this->stock,
				'length' => $this->length,
				'width' => $this->width,
				'height' => $this->height,
				'weight' => $this->weight,
				'sku' => $this->sku,
				'virtual' => $this->virtual,
				'download' => $this->download,
				'woofile' => $this->woofile,
				'salebegin' => $this->salebegin,
				'saleend' => $this->saleend,
				'purchasenote' => $this->purchasenote,
				'productcategory' => $this->productcategory,
				'reviews' => $this->reviews,
				'crosssells' => $this->crosssells,
				'upsells' => $this->upsells,
				'page' => $this->page,
				'post' => $this->post,
				'amazonbuylink' => $this->amazonbuylink,
				'amazonreviewiframe' => $this->amazonreviewiframe,
				'similaramazonproducts' => $this->similaramazonproducts,
				'gamestopurl' => $this->gamestopurl,
				'bestbuyurl' => $this->bestbuyurl,
				'steamurl' => $this->steamurl,
				'ebayurl' => $this->ebayurl,
			);

			# Each of these class instantiations will return the ID of the page/post created for storage in DB
			
			if($this->post == 'Yes'){
				require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-post.php');
				$post = new WPGameList_Post($page_post_array);
				$this->post = $post->post_id;
			}

			
			if($this->page == 'Yes'){
				require_once(GAMELIST_GAMELIST_CLASS_DIR.'class-page.php');
				$page = new WPGameList_Page($page_post_array);
				$this->page = $page->create_result;
			}

		}

		// Check to see if Storefront extension is active
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if(is_plugin_active('wpgamelist-storefront/wpgamelist-storefront.php')){
			if($this->author_url == '' || $this->author_url == null){
				if($this->wooid != '' || $this->wooid != null){
					$this->author_url = get_permalink($this->wooid);

					if($this->price == null || $this->price == ''){
						$this->price = $this->regularprice;
					}
				}
			}
		}

		// Final data mods before saving
		if($this->owned == 'No'){
			$this->gamecondition = 'N/A';
		}

		// Flip the date for more human-readableness
		if($this->releasedate != '' && $this->releasedate != null){
			$tempdate = explode('-', $this->releasedate);
			$this->releasedate = $tempdate[1].'-'.$tempdate[2].'-'.$tempdate[0];
		}

		// Flip the date for more human-readableness
		if($this->finishdate != '' && $this->finishdate != null){
			$tempdate = explode('-', $this->finishdate);
			$this->finishdate = $tempdate[1].'-'.$tempdate[2].'-'.$tempdate[0];
		}


		$data = array(
          	'title' => $this->title,
			'image' => $this->image,
			'platforms' => $this->platforms,
			'genres' => $this->genres,
			'developer' => $this->developer,
			'publisher' => $this->publisher,
			'rating' => $this->rating,
			'criticrating' => $this->criticrating,
			'perspective' => $this->perspective,
			'gamemodes' => $this->gamemodes,
			'themes' => $this->themes,
			'series' => $this->series,
			'franchise' => $this->franchise,
			'igdblink' => $this->igdblink,
			'price' => $this->price,
			'purchaselink' => $this->purchaselink,
			'releasedate' => $this->releasedate,
			'finishdate' => $this->finishdate,
			'esrb' => $this->esrb,
			'pegi' => $this->pegi,
			'owned' => $this->owned,
			'gamecondition' => $this->gamecondition,
			'finished' => $this->finished,
			'myrating' => $this->myrating,
			'summary' => $this->summary,
			'notes' => $this->notes,
			'videos' => $this->videos,
			'websites' => $this->websites,
			'screenshots' => $this->screenshots,
			'altnames' => $this->altnames,
			'woocommerce' => $this->woocommerce,
			'page' => $this->page,
			'post' => $this->post,
			'amazonbuylink' => $this->amazonbuylink,
			'amazonreviewiframe' => $this->amazonreviewiframe,
			'similaramazonproducts' => $this->similaramazonproducts,
			'gamestopurl' => $this->gamestopurl,
			'bestbuyurl' => $this->bestbuyurl,
			'steamurl' => $this->steamurl,
			'ebayurl' => $this->ebayurl,
         );

	    $format = array(
	    	'%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%d',
            '%d',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%d',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
          ) ; 
	    $where = array( 'ID' => $this->id );
	    $where_format = array( '%d' );
	    $result = $wpdb->update( $this->library, $data, $where, $format, $where_format );


		// Insert the Amazon Authorization into the DB if it's not already set to 'Yes'
		$table_name_options = $wpdb->prefix . 'wpgamelist_jre_user_options';
  		$this->options_results = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name_options", $table_name_options));
  		if($this->options_results->amazonauth != 'true'){
			$data = array(
	        	'amazonauth' => $this->amazon_auth_yes
		    );
		    $format = array( '%s'); 
		    $where = array( 'ID' => 1 );
		    $where_format = array( '%d' );
		    $wpdb->update( $wpdb->prefix.'wpgamelist_jre_user_options', $data, $where, $format, $where_format );
		}

		$this->editgameresult = $result;


	}

	public function empty_table($library){
		global $wpdb;
		$wpdb->query("TRUNCATE TABLE $library");

		// Drop table and re-create
		$row2 = $wpdb->get_results('SHOW CREATE TABLE '.$library);
		$wpdb->query("DROP TABLE $library");
		$wpdb->query($row2[0]->{'Create Table'});
		// Make sure auto_increment is set to 1
		$wpdb->query("ALTER TABLE $library AUTO_INCREMENT = 1");
		
	}

	public function empty_everything($library){
		global $wpdb;
		$results = $wpdb->get_results("SELECT * FROM $library");

		foreach($results as $result){
			wp_delete_post( $result->page_yes, true );
			wp_delete_post( $result->post_yes, true );
		}

		$wpdb->query("TRUNCATE TABLE $library");
	}

	public function delete_game($library, $game_id, $delete_string){
		global $wpdb;

		// Delete the associated post and page
		$post_delete = '';
		if($delete_string != ''){
			$delete_array = explode('-', $delete_string);
			foreach($delete_array as $delete){
				$delete_result = wp_delete_post( $delete, true );

				if($delete_result){
					$d_result = 1;
				}
				
				$post_delete = $post_delete.'-'.$d_result;
			}
		}

		// Deleting from saved_page_post_log
		$game_row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $library WHERE ID = %d",$game_id ));
		$uid = $game_row->game_uid;
		$pp_table = $wpdb->prefix.'wpgamelist_jre_saved_page_post_log';
		$wpdb->delete( $pp_table, array( 'game_uid' => $uid ));


		// Deleting row
		$game_delete = $wpdb->delete( $library, array( 'ID' => $game_id ) );

		// Dropping primary key in database to alter the IDs and the AUTO_INCREMENT value
		$wpdb->query($wpdb->prepare( "ALTER TABLE $library MODIFY ID BIGINT(190) NOT NULL", $library));

		$wpdb->query($wpdb->prepare( "ALTER TABLE $library DROP PRIMARY KEY", $library));

		// Adjusting ID values of remaining entries in database
		$my_query = $wpdb->get_results($wpdb->prepare("SELECT * FROM $library", $library ));
		$title_count = $wpdb->num_rows;
		for ($x = $game_id; $x <= $title_count; $x++) {
			$data = array(
			    'ID' => $game_id
			);
			$format = array( '%s'); 
			$game_id++;  
			$where = array( 'ID' => ($game_id) );
			$where_format = array( '%d' );
			$wpdb->update( $library, $data, $where, $format, $where_format );
		}  

		// Adding primary key back to database 
		$wpdb->query($wpdb->prepare( "ALTER TABLE $library ADD PRIMARY KEY (`ID`)", $library));    

		$wpdb->query($wpdb->prepare( "ALTER TABLE $library MODIFY ID BIGINT(190) AUTO_INCREMENT", $library));

		// Setting the AUTO_INCREMENT value based on number of remaining entries
		$title_count++;
		$wpdb->query($wpdb->prepare( "ALTER TABLE $library AUTO_INCREMENT = %d", $title_count));

		return $game_delete.'-'.$post_delete;
	}

	public function refresh_amazon_review($id, $library){
		global $wpdb;

		// Build options table
		if(strpos($library, 'wpgamelist_jre_saved_game_log') !== false){
			$table_name_options = $wpdb->prefix . 'wpgamelist_jre_user_options';
		} else {
			$table = explode('wpgamelist_jre_', $library);
			$table_name_options = $wpdb->prefix . 'wpgamelist_jre_settings_'.$table[1];
		}

		// Get options for amazon affiliate id and hideamazonreview
		$this->options_results = $wpdb->get_row("SELECT * FROM $table_name_options");

		// Get game by id
		$this->get_game_by_id($id, $library);

		// Set isbn for gather Amazon data function
		$this->title = $this->retrieved_game->title;

		// Check and see if Amazon review URL is expired. If so, make a new api call, get URL, saved in DB.
		if($this->options_results->hideamazonreviews == null || $this->options_results->hideamazonreviews == 0){
			parse_str($this->retrieved_game->amazonreviewiframe, $output);
			if($output != null && $output != '' && isset($output['exp'])){
				$expire_date = substr($output['exp'], 0, 10);
				$today_date = date("Y-m-d");

				if($today_date == $expire_date || $today_date > $expire_date){

					//$this->isbn = $this->retrieved_game->isbn;
					$this->title = $this->retrieved_game->title;

					// Gather Amazon data
					$this->gather_amazon_data();

					// Save new iframe url
					$data = array(
					  'amazonreviewiframe' => $this->amazonreviewiframe
					);
					$format = array( '%s'); 
					$where = array( 'ID' => $this->retrieved_game->ID );
					$where_format = array( '%d' );
					$wpdb->update( $library, $data, $where, $format, $where_format );
				}
			}
		}
	}

	private function get_game_by_id($id, $library){
		global $wpdb;
		$this->retrieved_game = $wpdb->get_row("SELECT * FROM $library WHERE ID = $id");
	}
	


}

endif;