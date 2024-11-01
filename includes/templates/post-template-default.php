<?php

$string1 = '';
$string2 = '';
$string3 = '';
$string4 = '';
$string5 = '';
$string6 = '';
$string7 = '';
$string8 = '';
$string9 = '';
$string10 = '';
$string11 = '';
$string12 = '';
$string13 = '';
$string14 = '';
$string15 = '';
$string16 = '';
$string17 = '';
$string18 = '';
$string19 = '';
$string20 = '';
$string21 = '';
$string22 = '';
$string23 = '';
$string24 = '';
$string25 = '';
$string26 = '';
$string27 = '';
$string28 = '';
$string29 = '';
$string30 = '';
$string31 = '';
$string32 = '';
$string33 = '';
$string34 = '';
$string35 = '';
$string36 = '';
$string37 = '';
$string38 = '';
$string39 = '';
$string40 = '';
$string41 = '';
$string42 = '';
$string43 = '';
$string44 = '';
$string45 = '';
$string46 = '';
$string47 = '';
$string48 = '';
$string49 = '';
$string50 = '';
$string51 = '';
$string52 = '';

$string1 =  '<div id="wpbl-posttd-top-container">
	<div id="wpbl-posttd-left-row">
		<div id="wpbl-posttd-image">';
			if($options_post_row->hidecoverimage == null || $options_post_row->hidecoverimage == 0){ 

				if($game_row->image == null){
							$string2 =  '<img id="wpbl-posttd-img" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'image_unavaliable.png"/>';
				} else {
							$string2 =  '<img id="wpbl-posttd-img" src="'.$game_row->image.'"/>';
				} 
			}

		$string3 =  '</div>
		<div id="wpbl-posttd-details-div">';

			if( (($options_post_row->hidestarsgame == null) || ($options_post_row->hidestarsgame == 0)) && ($game_row->myrating != 0)){ 
				if($game_row->myrating == 5){
				    $string4 =  '<img id="wpbl-posttd-rating-img" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'5star.png'.'" />';
				}    

				if($game_row->myrating == 4){
				    $string4 =  '<img id="wpbl-posttd-rating-img" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'4star.png'.'" />';
				}    

				if($game_row->myrating == 3){
				    $string4 =  '<img id="wpbl-posttd-rating-img" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'3star.png'.'" />';
				}    

				if($game_row->myrating == 2){
				    $string4 =  '<img id="wpbl-posttd-rating-img" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'2star.png'.'" />';
				}    

				if($game_row->myrating == 1){
				    $string4 =  '<img id="wpbl-posttd-rating-img" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'1star.png'.'" />';
				}    
			} 

			if(($options_post_row->hidefacebookshare== null || $options_post_row->hidefacebookshare== 0) || ($options_post_row->hidetwitter == null || $options_post_row->hidetwitter == 0) || ($options_post_row->hidegoogleplus == null || $options_post_row->hidegoogleplus == 0) || ($options_post_row->hidefacebookmessenger == null || $options_post_row->hidefacebookmessenger == 0) || ($options_post_row->hidepinterest == null || $options_post_row->hidepinterest == 0) || ($options_post_row->hideemail == null || $options_post_row->hideemail == 0)){ 

			    $string5 =  '<div><p class="wpbl-posttd-share-text">'.__('Share This Game','wpgamelist').'</p>';

			    if($options_post_row->hidefacebookshare== null || $options_post_row->hidefacebookshare== 0){
			    	$string6 =  '<div class="addthis_sharing_toolbox addthis_default_style" style="cursor:pointer"><a style="cursor:pointer;" href="" addthis:title="'.$game_row->title.'" addthis:description="'.htmlspecialchars(addslashes($game_row->summary)).'"addthis:url="'.$game_row->amazonbuylink.'" class="addthis_button_facebook"></a></div>';
				}

				if($options_post_row->hidetwitter == null || $options_post_row->hidetwitter == 0){
			    	$string7 =  '<div class="addthis_sharing_toolbox addthis_default_style" style="cursor:pointer"><a style="cursor:pointer;" href="" addthis:title="'.$game_row->title.'" addthis:description="'.htmlspecialchars(addslashes($game_row->summary)).'"addthis:url="'.$game_row->amazonbuylink.'" class="addthis_button_twitter"></a></div>';
				}

				if($options_post_row->hidegoogleplus == null || $options_post_row->hidegoogleplus == 0){
			    	$string8 =  '<div class="addthis_sharing_toolbox addthis_default_style" style="cursor:pointer"><a style="cursor:pointer;" href="" addthis:title="'.$game_row->title.'" addthis:description="'.htmlspecialchars(addslashes($game_row->summary)).'"addthis:url="'.$game_row->amazonbuylink.'" class="addthis_button_google_plusone_share"></a></div>';
				}

				if($options_post_row->hidefacebookmessenger == null || $options_post_row->hidefacebookmessenger == 0){
			    	$string9 =  '<div class="addthis_sharing_toolbox addthis_default_style" style="cursor:pointer"><a style="cursor:pointer;" href="" addthis:title="'.$game_row->title.'" addthis:description="'.htmlspecialchars(addslashes($game_row->summary)).'"addthis:url="'.$game_row->amazonbuylink.'" class="addthis_button_messenger"></a></div>';
				}

				if($options_post_row->hidepinterest == null || $options_post_row->hidepinterest == 0){
                	$string10 =  '<div class="addthis_sharing_toolbox addthis_default_style" style="cursor:pointer"><a style="cursor:pointer;" href="" addthis:title="'.$game_row->title.'" addthis:description="'.htmlspecialchars(addslashes($game_row->summary)).'"addthis:url="'.$game_row->amazonbuylink.'" class="addthis_button_pinterest_share"></a></div>';
				}

				if($options_post_row->hideemail == null || $options_post_row->hideemail == 0){
			    	$string11 =  '<div class="addthis_sharing_toolbox addthis_default_style" style="cursor:pointer"><a style="cursor:pointer;" href="" addthis:title="'.$game_row->title.'" addthis:description="'.htmlspecialchars(addslashes($game_row->summary)).'"addthis:url="'.$game_row->amazonbuylink.'" class="addthis_button_gmail"></a></div>';
				}

				$string12 =  '</div>';
			} 

			if($options_post_row->hidesimilartitles != 1 && $similar_string != '<span id="wpgamelist-page-span-hidden" style="display:none;"></span>'){
				$string13 =  '<div id="wpbl-similar-div"><p style="font-weight:bold; font-size:18px; margin-bottom:5px;" class="wpbl-posttd-share-text">'.__('Similar Titles','wpgamelist').'</p>'.$similar_string;
			}

			$string53 = '';
			if(has_filter('wpgamelist_video_add_to_post')) {
				$string53 = apply_filters('wpgamelist_video_add_to_post', $game_row->videos);
			}

			$string54 = '';
			if(has_filter('wpgamelist_add_to_post_screenshots')) {
				$string54 = apply_filters('wpgamelist_add_to_post_screenshots', $game_row->screenshots);
			}
			//if($options_post_row->hidegoogleprev == null || $options_post_row->hidegoogleprev == 0){

				if(has_filter('wpgamelist_add_to_post_google')) {
					$string14 = $string14.apply_filters('wpgamelist_add_to_post_google', $game_row->igdblink.'---'.$game_row->image);
				}
			//}

			if($options_post_row->hidequote == null || $options_post_row->hidequote == 0){
				$string52 = $string52.'<div id="wpbl-posttd-post-quote">'.stripslashes($quote).'</div>';
			}
		$string15 =  '</div>
	</div>
	<div id="wpbl-posttd-right-row">';
		if($options_post_row->hidetitlegame == null || $options_post_row->hidetitlegame == 0){
			$string16 =  '<h3 id="wpbl-posttd-game-title">'.stripslashes($game_row->title).'</h3>';
		}
		$string17 =  '<div id="wpbl-posttd-game-details-div">';
			if($options_post_row->hidereleasedate == null || $options_post_row->hidereleasedate == 0){
				$string18 =  '<div id="wpbl-posttd-game-details-1">
						<span>'.__('Initial Release Date:', 'wpgamelist').' </span> '.$game_row->releasedate.'
					</div>';
			}

			if(($options_post_row->enablepurchase != null && $options_post_row->enablepurchase != 0) && $game_row->price != null && $game_row->author_url != null){
				$string19 =  '<div id="wpbl-posttd-game-details-9">
					<span>'.__('Price:','wpgamelist').' </span>'.$game_row->price;
				$string20 =  '</div>';
			}

			if($options_post_row->hidegenre == null || $options_post_row->hidegenre == 0){
				$string21 =  '<div id="wpbl-posttd-game-details-2">
					<span>'.__('Genre(s):','wpgamelist').' </span>'.$game_row->genres.'
				</div>';
			}

			if($options_post_row->hideseries == null || $options_post_row->hideseries == 0){
				$string22 =  '<div id="wpbl-posttd-game-details-3">
					<span>'.__('Series:','wpgamelist').' </span>'.stripslashes($game_row->series).'
				</div>';
			}

			if($options_post_row->hidepublisher == null || $options_post_row->hidepublisher == 0){
				$string23 =  '<div id="wpbl-posttd-game-details-4">
					<span>'.__('Publisher:','wpgamelist').' </span>'.$game_row->publisher.'
				</div>';
			}

			if($options_post_row->hidedeveloper == null || $options_post_row->hidedeveloper == 0){
				$string50 =  '<div id="wpbl-posttd-game-details-4">
					<span>'.__('Developer:','wpgamelist').' </span>'.$game_row->developer.'
				</div>';
			}

			if($options_post_row->hidecriticrating == null || $options_post_row->hidecriticrating == 0){
				$string51 =  '<div id="wpbl-posttd-game-details-4">
					<span>'.__('Avg. Critic Rating:','wpgamelist').' </span>'.$game_row->criticrating.'
				</div>';
			}

			if($options_post_row->hideigdblink == null || $options_post_row->hideigdblink == 0){
				$string24 =  '<div id="wpbl-posttd-game-details-5">
					<span>'.__('IGDB Link:','wpgamelist').' </span><a href="'.$game_row->igdblink.'">Click Here</a>
				</div>';
			}

			if($options_post_row->hidefinished == null || $options_post_row->hidefinished == 0){
				$string25 =  '<div id="wpbl-posttd-game-details-5">
					<span>'.__('Finished?','wpgamelist').' </span>'.$game_row->finished.'
				</div>';
			}

			if($options_post_row->hideplatforms == null || $options_post_row->hideplatforms == 0){
				$string28 =  '<div id="wpbl-posttd-game-details-5">
					<span>'.__('Platform(s):','wpgamelist').' </span>'.$game_row->platforms.'
				</div>';
			}

			if($options_post_row->hidealtnames == null || $options_post_row->hidealtnames == 0){
				$string29 =  '<div id="wpbl-posttd-game-details-5">
					<span>'.__('Alternative Names:','wpgamelist').' </span>'.stripslashes($game_row->altnames).'
				</div>';
			}

		$string34 = '</div>';

		if(($options_post_row->enablepurchase != null && $options_post_row->enablepurchase != 0) && $game_row->price != null && $game_row->author_url != null){ 

			  if(has_filter('wpgamelist_add_storefront_calltoaction_post')) {
			    $string35 =  $var = apply_filters('wpgamelist_add_storefront_calltoaction_post', $game_row->author_url);
			  }

		}

		if(($options_post_row->hideamazonpurchase == null || $options_post_row->hideamazonpurchase == 0) || ($options_post_row->hidesteampurchase == null || $options_post_row->hidesteampurchase == 0) || ($options_post_row->hidebestbuypurchase == null || $options_post_row->hidebestbuypurchase == 0) || ($options_post_row->hidegamestoppurchase == null || $options_post_row->hidegamestoppurchase == 0) || (($options_post_row->enablepurchase != null && $options_post_row->enablepurchase != 0) && $game_row->price != null && $game_row->author_url != null) ){ 
			$string36 =  '<div id="wpbl-posttd-top-purchase-div">
				<h4 id="wpbl-posttd-purchase-title">'.__('Purchase this title at:','wpgamelist').' </h4>
				<div id="wpbl-posttd-line-under-purchase"></div>';
				if (($game_row->amazonbuylink != null) && ($options_post_row->hideamazonpurchase == null || $options_post_row->hideamazonpurchase == 0 )){

					$string37 =  '<a class="wpbl-posttd-wpgamelist-purchase-img" href="'.$game_row->amazonbuylink.'" target="_blank"><img src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'amazon.png" /></a>';
				}

				if($game_row->gamestopurl == null || $game_row->gamestopurl == ''){
					$game_row->gamestopurl = 'http://www.barnesandnoble.com/s/'.$game_row->isbn;
				}

				if ($options_post_row->hidegamestoppurchase == null || $options_post_row->hidegamestoppurchase == 0 ){
					$string38 =  '<a class="wpbl-posttd-wpgamelist-purchase-img" href="'.$game_row->gamestopurl.'" target="_blank"><img src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'gamestop.png" /></a>';
				}

				if ($options_post_row->hidebestbuypurchase == null || $options_post_row->hidebestbuypurchase == 0 ){
					$string39 =  '<a class="wpbl-posttd-wpgamelist-purchase-img" href="'.$game_row->bestbuyurl.'" target="_blank"><img src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'bestbuy.png" /></a>';
				}

				if ($options_post_row->hidesteampurchase == null || $options_post_row->hidesteampurchase == 0 ){
					$string40 =  '<a class="wpbl-posttd-wpgamelist-purchase-img" href="'.$game_row->steamurl.'" target="_blank"><img id="wpbl-posttd-itunes-img" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'steam.png" /></a>';
				}

				if (($options_post_row->hideebaypurchase == null || $options_post_row->hideebaypurchase == 0 )){
					$string48 =  '<a class="wpbl-posttd-wpgamelist-purchase-img" href="'.$game_row->ebayurl.'" target="_blank"><img src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'ebay.png" /></a>';
				}

				if(($options_post_row->enablepurchase != null && $options_post_row->enablepurchase != 0) && ($game_row->author_url != null)){
					if(has_filter('wpgamelist_add_storefront_gameimg_post')) {
					    $string41 =  $var = apply_filters('wpgamelist_add_storefront_gameimg_post', $game_row->author_url);
					}
				}
			$string42 = '</div>';
		} 
		if(($options_post_row->hidedescription == null || $options_post_row->hidedescription == 0) && $game_row->summary != null && strlen($game_row->summary) > 2){
			$string43 =  '<div id="wpbl-posttd-game-description-div">
				<h5 id="wpbl-posttd-game-description-h5">'.__('Description','wpgamelist').'</h5>
				<div id="wpbl-posttd-game-description-contents">'.html_entity_decode(stripslashes(stripslashes($game_row->summary))).'</div>
			</div>';
		}
		if(($options_post_row->hidenotes == null || $options_post_row->hidenotes == 0) && $game_row->notes != null){
		$string44 =  '<div id="wpbl-posttd-game-notes-div">
			<h5 id="wpbl-posttd-game-notes-h5">'.__('Notes','wpgamelist').'</h5>
			<div id="wpbl-posttd-game-notes-contents">'.html_entity_decode(stripslashes($game_row->notes)) .'</div>
		</div>';
		} 
		if(($options_post_row->hideamazonreviews == null || $options_post_row->hideamazonreviews == 0) && $game_row->amazonreviewiframe != null){
		$string45 =  '<div id="wpbl-posttd-game-amazon-review-div">
			<h5 id="wpbl-posttd-game-amazon-review-h5">'.__('Amazon Reviews','wpgamelist').'</h5>
			<iframe id="wpbl-posttd-game-amazon-review-contents" src="'.$game_row->amazonreviewiframe.'"></iframe>
		</div>';
		} 

		$append_string = '';
		if(has_filter('wpgamelist_append_to_default_post_template_right_column')) {
			$append_string = apply_filters('wpgamelist_append_to_default_post_template_right_column', $append_string);
		}
		$string46 =  $append_string;


	$string47 = '</div>

</div>';


