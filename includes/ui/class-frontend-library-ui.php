<?php
/**
 * WPGameList Front-End Library UI Class
 *
 * @author   Jake Evans
 * @category Front-End UI
 * @package  Includes/UI
 * @version  1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WPGameList_Front_End_Library_UI', false ) ) :
/**
 * WPGameList_Front_End_Library_UI Class.
 */
class WPGameList_Front_End_Library_UI {

	public $table;
	public $games_read;
	public $games_signed;
	public $games_first_edition;
	public $display_options_table;
	public $display_options_actual = array();
	public $quotes_table;
	public $category_count = 0;
	public $author_count = 0;
	public $subject_count = 0;
	public $country_count = 0;
	public $games_actual = array();
	public $quotes_actual = array();
	public $total_game_count = 0;
	public $total_platform_count = 0;
	public $total_platform_count_array = array();
	public $total_publisher_count = 0;
	public $total_publisher_count_array = array();
	public $total_genre_count = 0;
	public $total_genre_count_array = array();
	public $total_category_count = 0;
	public $total_author_count = 0;
	public $total_subject_count = 0;
	public $total_country_count = 0;
	public $total_quotes_count = 0;
	public $total_game_read_count = 0;
	public $total_game_signed_count = 0;
	public $total_game_first_edition_count = 0;
	public $library_actual_string = '';
	public $library_pagination_string = '';
	public $final_category_array = array();
	public $final_author_array = array();
	public $final_subject_array = array();
	public $final_country_array = array();
	public $action;
	public $sort = '';
	public $brandingtext1 = '';
	public $brandingtext2 = '';
	public $brandinglogo1 = '';
	public $brandinglogo2 = '';
	public $active_plugins = array();


	public function __construct($which_table, $searchType = null, $searchTerm = null, $sort = null, $action = null, $filter_author = null, $filter_category = null, $filter_subject = null, $filter_country = null, $yearfilter1 = null, $yearfilter2 = null) {

		# Set up variables and such we'll need throughout
		global $wpdb;

		$this->sort = $sort;

		// Removed strtolower in 5.5.2 - not sure why it was ever here
		//$this->table = strtolower($which_table);
		$this->table = $which_table;

		// Setting action to take when image is clicked
		$this->action = $action;

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

        foreach ($this->active_plugins as $key => $value) {
        	if($value == 'wpgamelist-branding/wpgamelist-branding.php'){
        		$table_name = $wpdb->prefix.'wpgamelist_branding_table';
				$row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE ID = %d", 1));

				$this->brandingtext1 = $row->brandingtext1;
				$this->brandingtext2 = $row->brandingtext2;
				$this->brandinglogo1 = $row->brandinglogo1;
				$this->brandinglogo2 = $row->brandinglogo2;

        	}
        }


		

		// Building display options table
		if($this->table == $wpdb->prefix.'wpgamelist_jre_saved_game_log'){
			$this->display_options_table = $wpdb->prefix.'wpgamelist_jre_user_options';
		} else {
			$temp = explode('_', $this->table);
			$temp = array_pop($temp);
			$this->display_options_table = $wpdb->prefix.'wpgamelist_jre_settings_'.strtolower($temp);
		}


		// Getting all display options
		$this->display_options_actual = $wpdb->get_row($wpdb->prepare("SELECT * FROM $this->display_options_table WHERE ID = %d", 1));

		// Getting quotes table name
		$this->quotes_table = $wpdb->prefix.'wpgamelist_jre_game_quotes';


		# Getting all games from table depending on search and sort settings
		// If no search term is set, build default query for entire library
		if(($searchTerm == null || $searchTerm == 'Search...') && $searchType == ''){
			$query = "SELECT * FROM $this->table";
		} else {
			$searchType = explode('-', $searchType);
			// If only one search type was specified
			if(sizeof($searchType) == 2){
				if($searchType[1] == 'title'){
					$query = "SELECT * FROM $this->table where title LIKE %s";
				}
				if($searchType[1] == 'author'){
					$query = "SELECT * FROM $this->table where author LIKE %s";
				}
				if($searchType[1] == 'category'){
					$query = "SELECT * FROM $this->table where category LIKE %s";
				}
			}

			// If two search types were specified
			if(sizeof($searchType) == 3){
				if(in_array('title', $searchType) && in_array('author', $searchType)){
					$query = "SELECT * FROM $this->table where title LIKE %s OR author LIKE %s";
				}

				if(in_array('title', $searchType) && in_array('category', $searchType)){
					$query = "SELECT * FROM $this->table where title LIKE %s OR category LIKE %s";
				}

				if(in_array('author', $searchType) && in_array('category', $searchType)){
					$query = "SELECT * FROM $this->table where author LIKE %s OR category LIKE %s";
				}
			}

			// If all three search terms were specified
			if(sizeof($searchType) > 3 || sizeof($searchType) == 1){
				$query  = "SELECT * FROM $this->table where author LIKE %s OR category LIKE %s OR title LIKE %s";
			}
		}

		# Build second part of query if a sort option is set
		if($sort != null && $sort != 'default'){
			// Handles the sorting if one of the dynamic categories is selected
			if($sort != 'first-edition' && $sort != 'alphabetically' && $sort != 'year-read' && $sort != 'signed' && $sort != 'pages-desc' && $sort != 'pages-asc' && $sort != 'releasedate' && $sort != 'author-desc' && $sort != 'pub-asc' && $sort != 'pub-desc' && $sort != 'subject'){
				$sortTerm = 'cat';
			} else {
				$sortTerm = $sort;
			}

			// If a search term was not set, then append to first part of query without any 'AND's
			if(($searchTerm == null || $searchTerm == 'Search...') && $searchType == ''){
				switch ($sortTerm) {
	                case "first-edition":
	                    $query = $query." WHERE first_edition = 'true' ORDER BY title ASC";
	                    break;
	                case "alphabetically":
	                    $query = $query." ORDER BY title ASC";
	                    break;
	                case "subject":
	                    $query = $query." ORDER BY subject ASC";
	                    break;
	                case "year-read":
	                    $query = $query." WHERE finished = 'true' ORDER BY finishdate ASC";
	                    break;
	                case "signed":
	                    $query = $query." WHERE signed = 'true' ORDER BY title ASC";
	                    break;
	                case "pages-desc":
	                    $query = $query." ORDER BY pages DESC";
	                    break;
	                case "pages-asc":
	                    $query = $query." ORDER BY pages ASC";
	                    break;
	                case "cat":
	                     $query = $query." WHERE category = %s";
	                    break;
	                case "pub-desc":
	                    $query = $query." ORDER BY pub_year DESC";
	                    break;
	                case "pub-asc":
	                    $query = $query." ORDER BY pub_year ASC";
	                    break;
	                case "releasedate":
	                    $query = $query." ORDER BY releasedate ASC";
	                    break;	
	                case "author-desc":
	                    $query = $query." ORDER BY author DESC";
	                    break;		       
            	}
			} else {
				// If a search term was set, then append to first part of query with 'AND's
				switch ($sort) {
	                case "first-edition":
	                    $query = $query." AND first_edition = 'true' ORDER BY title ASC";
	                    break;
	                case "alphabetically":
	                    $query = $query." ORDER BY title ASC";
	                    break;
	                case "year-read":
	                    $query = $query." AND finished = 'true' ORDER BY finishdate ASC";
	                    break;
	                case "signed":
	                    $query = $query." AND signed = 'true' ORDER BY title ASC";
	                    break;
	                case "pages-desc":
	                    $query = $query." ORDER BY pages DESC";
	                    break;
	                case "pages-asc":
	                    $query = $query." ORDER BY pages ASC";
	                    break;
	                case "pub-desc":
	                    $query = $query." ORDER BY pub_year DESC";
	                    break;
	                case "pub-asc":
	                    $query = $query." ORDER BY pub_year ASC";
	                    break;
	                default:
	                	$query = $query." AND category = %s";						       
	            }
			}
		}
		


		// Now start modifying the Query based on the filter options
		// If at least one of the filter options are set...
		if($filter_author != null || $filter_category != null || $filter_subject != null || $filter_country != null || ($yearfilter1 != null  && $yearfilter1 != '2000' && $yearfilter1 != 'NaN' ) || ($yearfilter2 != null && $yearfilter2 != '2019' && $yearfilter2 != 'NaN')){
			$exploded_query = explode($this->table, $query);
			$query_one = $exploded_query[0];
			$query_two = $exploded_query[1];

			// Build an array of the 4 possible filter values
			$filter_array = array(
				'author' => $filter_author,
				'category' => $filter_category,
				'subject' => $filter_subject,
				'country' => $filter_country,
				'date1' => $yearfilter1,
				'date2' => $yearfilter2,
			);
			$tempquery = ' WHERE ';
			foreach ($filter_array as $key => $filter) {
				$tempquery = $tempquery.$key." = '".$filter."' AND ";
			}
			$tempquery = str_replace("WHERE author = '' AND", 'WHERE', $tempquery);
			$tempquery = str_replace("WHERE category = '' AND", 'WHERE', $tempquery);
			$tempquery = str_replace("WHERE subject = '' AND", 'WHERE', $tempquery);
			$tempquery = str_replace("WHERE country = '' AND", 'WHERE', $tempquery);
			$tempquery = str_replace("AND author = ''", '', $tempquery);
			$tempquery = str_replace("AND category = ''", '', $tempquery);
			$tempquery = str_replace("AND subject = ''", '', $tempquery);
			$tempquery = str_replace("AND country = ''", '', $tempquery);
			$tempquery = rtrim($tempquery, ' AND ');


			if(strpos($query, 'ORDER BY title ASC') !== false){
				$tempquery = str_replace('ORDER BY title ASC', $tempquery.' ORDER BY title ASC', $query_two);
			}

			if(strpos($query, "WHERE finished = 'true' ORDER BY finishdate ASC") !== false){
				$tempquery = str_replace("WHERE finished = 'true' ORDER BY finishdate ASC", $tempquery." AND finished = 'true' ORDER BY finishdate ASC", $query_two);
			}

			if(strpos($query, "WHERE signed = 'true'") !== false){
				if(strpos($tempquery, "WHERE signed = 'true'  WHERE") !== false){
					$tempquery = str_replace("WHERE signed = 'true'  WHERE", "WHERE signed = 'true' AND", $tempquery);
				}
			}

			if(strpos($query, "WHERE first_edition = 'true'") !== false){
				if(strpos($tempquery, "WHERE first_edition = 'true'  WHERE") !== false){
					$tempquery = str_replace("WHERE first_edition = 'true'  WHERE", "WHERE first_edition = 'true' AND", $tempquery);
				}
			}

			if(strpos($query, "date1 = '".$yearfilter1."' AND date2 = '".$yearfilter2."'") !== false){
				if(strpos($tempquery, "WHERE first_edition = 'true'  WHERE") !== false){
					$tempquery = str_replace("WHERE first_edition = 'true'  WHERE", "WHERE first_edition = 'true' AND", $tempquery);
				}
			}




			if(strpos($query, 'ORDER BY pages ASC') !== false){
				$tempquery = $tempquery.' ORDER BY pages ASC';
			}

			if(strpos($query, 'ORDER BY pages DESC') !== false){
				$tempquery = $tempquery.' ORDER BY pages DESC';
			}

			if(strpos($query, 'ORDER BY pub_year ASC') !== false){
				$tempquery = $tempquery.' ORDER BY pub_year ASC';
			}

			if(strpos($query, 'ORDER BY pub_year DESC') !== false){
				$tempquery = $tempquery.' ORDER BY pub_year DESC';
			}

			if(strpos($query, 'ORDER BY author ASC') !== false){
				$tempquery = $tempquery.' ORDER BY author ASC';
			}

			if(strpos($query, 'ORDER BY author DESC') !== false){
				$tempquery = $tempquery.' ORDER BY author DESC';
			}

			if($yearfilter1 == '2000' && $yearfilter2 == '2019'){
			
				if(strpos($tempquery, "AND date1 = '".$yearfilter1."' AND date2 = '".$yearfilter2."'") !== false){
					$tempquery = str_replace("AND date1 = '".$yearfilter1."' AND date2 = '".$yearfilter2."'", '', $tempquery);
				}

				if(strpos($tempquery, "WHERE date1 = '".$yearfilter1."' AND date2 = '".$yearfilter2."'") !== false){
					$tempquery = str_replace("WHERE date1 = '".$yearfilter1."' AND date2 = '".$yearfilter2."'", '', $tempquery);
				}

			} else {
			
			
				if($yearfilter1 != 'NaN' && $yearfilter2 != 'NaN'){
				
										if(strpos($tempquery, "WHERE date1 = '".$yearfilter1."' AND date2 = '".$yearfilter2."'") !== false){
						$tempquery = str_replace("WHERE date1 = '".$yearfilter1."' AND date2 = '".$yearfilter2."'", 'WHERE pub_year >= '.$yearfilter1.' and pub_year <= '.$yearfilter2, $tempquery);
					}

					if(strpos($tempquery, "date1 = '".$yearfilter1."' AND date2 = '".$yearfilter2."'") !== false){
						$tempquery = str_replace("date1 = '".$yearfilter1."' AND date2 = '".$yearfilter2."'", ' pub_year >= '.$yearfilter1.' and pub_year <= '.$yearfilter2, $tempquery);
					}
				
				}
			}

			





			$this->table;
			$this->author_select = $filter_author;
			$this->query = $tempquery;
			$query = $query_one.' '.$this->table.$tempquery;
		}

//where date >= [start date] and date <= [end date]
		//echo $tempquery;
//echo $yearfilter1;
//echo $yearfilter2;

		// Determine how many '%s' placeholders are in query string for wpdb->prepare
		$placeholder = array();
		$count = substr_count($query, '%s');
		if($count >= 1){
			// If at least one placeholder was found...
			$searchTerm = '%'.$wpdb->esc_like($searchTerm).'%';
			if(($searchTerm == null || $searchTerm == 'Search...') && $searchType == ''){
				// If search term was not set, and one placeholder was found, then query must pertain to sort
				$this->games_actual = $wpdb->get_results($wpdb->prepare($query, $sort));
			} else {
				// If one placeholder was found, and query does or does not contains 'WHERE Category'...
				if($count == 1){ 
					if(strpos($query, 'WHERE category = %s') !== false){
						$this->games_actual = $wpdb->get_results($wpdb->prepare($query, $sort));
					} else {
						$this->games_actual = $wpdb->get_results($wpdb->prepare($query, $searchTerm));
					}
				}

				// 2 placeholders
				if($count == 2){
					$this->games_actual = $wpdb->get_results($wpdb->prepare($query, $searchTerm, $searchTerm));
				}

				// 3 placeholders
				if($count == 3){
					$this->games_actual = $wpdb->get_results($wpdb->prepare($query, $searchTerm, $searchTerm, $searchTerm));
				}
			}
		} else {
			// If no placeholders are found in query, execute the query
			$this->games_actual = $wpdb->get_results($query);
		}

		// Getting total game count
		$this->total_game_count = $wpdb->num_rows;


		// Getting total # of games read/finished
		foreach($this->games_actual as $game){
			if($game->finished == 'Yes'){
				$this->total_game_read_count++;
			}
		}


		// Getting total # of unique platforms
		foreach($this->games_actual as $game){
			$platforms = explode(', ', $game->platforms);
			foreach ($platforms as $key => $value) {
				array_push($this->total_platform_count_array, $value);
			}	
		}
		$this->total_platform_count_array = array_unique($this->total_platform_count_array);
		$this->total_platform_count = sizeof($this->total_platform_count_array);

		// Getting total # of unique genres
		foreach($this->games_actual as $game){
			$genres = explode(', ', $game->genres);
			foreach ($genres as $key => $value) {
				array_push($this->total_genre_count_array, $value);
			}	
		}
		$this->total_genre_count_array = array_unique($this->total_genre_count_array);
		$this->total_genre_count = sizeof($this->total_genre_count_array);

		// Getting total # of unique publishers
		foreach($this->games_actual as $game){

			if(strpos($game->publisher, ',')){
				$publishers = explode(', ', $game->publisher);
				foreach ($publishers as $key => $value) {
					array_push($this->total_publisher_count_array, $value);
				}	
			} else {
				array_push($this->total_publisher_count_array, $game->publisher);
			}
		}
		$this->total_publisher_count_array = array_unique($this->total_publisher_count_array);
		$this->total_publisher_count = sizeof($this->total_publisher_count_array);

		// Getting quotes
		$this->quotes_table = $wpdb->prefix.'wpgamelist_jre_game_quotes';
		$this->quotes_actual = $wpdb->get_results("SELECT * FROM $this->quotes_table");


		// Getting number of quotes
		$this->total_quotes_count = $wpdb->num_rows;


		// Output default non-variable first bit of html
		$this->output_beginning_html();

		// Output search if not hidden
		if($this->display_options_actual->hidesearch != 1){
			$this->output_search();
		}

		// Output the closure of the sort and search elements
		$this->output_close_sort_search();


		// Output Stats if not hidden
		if($this->display_options_actual->hidestats != 1){
			$this->output_stats();
		}


		// Output Quote if not hidden
		if($this->display_options_actual->hidequote != 1){
			$this->output_quote();
		}

		// Build Library actual output string
		//$this->build_library_actual();

		// Build library pagination
		//$this->build_library_pagination();

		// Output Library and pagination strings
		//$this->output_library_actual();
	}

	private function output_beginning_html(){
		echo '<div class="wpgamelist-top-container">
    			<div class="wpgamelist-table-for-app">'.$this->table.'</div>
    			<div class="wpgamelist-for-branding" id="wpgamelist-branding-text-1" data-value="'.$this->brandingtext1.'"></div>
    			<div class="wpgamelist-for-branding" id="wpgamelist-branding-text-2" data-value="'.$this->brandingtext2.'"></div>
    			<div class="wpgamelist-for-branding" id="wpgamelist-branding-logo-1" data-value="'.$this->brandinglogo1.'"></div>
    			<div class="wpgamelist-for-branding" id="wpgamelist-branding-logo-2" data-value="'.$this->brandinglogo2.'"></div>
    			<p id="specialcaseforappid"></p>
				<a id="hidden-link-for-styling" style="display:none"></a>
				<div id="wpgamelist-filter-search-container">';
	}

	private function output_filter_html(){
		$string1 = '<div id="wpgamelist-filter-div">
						<div id="wpgamelist-filter-author-box-div">
							<div id="wpgamelist-select-sort-div">
		                        <select id="wpgamelist-filter-author-box">    
		                            <option selected disabled>'.__('Filter By Publisher...', 'wpgamelist').'</option>';

		                            $string2 = '';
		                            foreach($this->total_publisher_count_array as $auth){
		                            	$string2 = $string2.'<option value="'.$auth.'">'.$auth.'</option>';
		                            }

		                            $string3 = '
		                        </select>
	                    	</div>
                    	</div>';

        $string4 = '<div id="wpgamelist-filter-category-box-div">
						<div id="wpgamelist-select-sort-div">
	                        <select id="wpgamelist-filter-category-box">    
	                            <option selected disabled>'.__('Filter By Genre...', 'wpgamelist').'</option>';

	                            $string5 = '';
	                            foreach($this->total_genre_count_array as $cat){
	                            	$string5 = $string5.'<option value="'.$cat.'">'.$cat.'</option>';
	                            }

	                            $string6 = '
	                        </select>
                    	</div>
                    </div>';

        $string7 = '<div id="wpgamelist-filter-subject-box-div">
						<div id="wpgamelist-select-sort-div">
	                        <select id="wpgamelist-filter-subject-box">    
	                            <option selected disabled>'.__('Filter By Platform...', 'wpgamelist').'</option>';

	                            $string8 = '';
	                            foreach($this->total_platform_count_array as $subject){
	                            	$string8 = $string8.'<option value="'.$subject.'">'.$subject.'</option>';
	                            }

	                            $string9 = '
	                        </select>
                    	</div>
                    </div>';

        $string10 = '<div id="wpgamelist-filter-country-box-div">
						<div id="wpgamelist-select-sort-div">
	                        <select id="wpgamelist-filter-country-box">    
	                            <option selected disabled>'.__('Filter By Country...', 'wpgamelist').'</option>';

	                            $string11 = '';
	                            foreach($this->final_country_array as $country){
	                            	$string11 = $string11.'<option value="'.$country.'">'.$country.'</option>';
	                            }

	                            $string12 = '
	                        </select>
                    	</div>
                    	<div id="wpgamelist-filter-between-year-div">
                    		<p>Filter by Publication Year Range</p>
                    		<select id="wpgamelist-year-range-1">
                    			<option selected>20</option>
                    			<option>19</option>
                    			<option>18</option>
                    			<option>17</option>
                    			<option>16</option>
                    			<option>15</option>
                    			<option>14</option>
                    		</select>
                    		<select id="wpgamelist-year-range-2">
                    			<option selected>00</option>
                    			<option>01</option>
                    			<option>02</option>
                    			<option>03</option>
                    			<option>04</option>
                    			<option>05</option>
                    			<option>06</option>
                    			<option>07</option>
                    			<option>08</option>
                    			<option>09</option>
                    			<option>10</option>
                    			<option>11</option>
                    			<option>12</option>
                    			<option>13</option>
                    			<option>14</option>
                    			<option>15</option>
                    			<option>16</option>
                    			<option>17</option>
                    			<option>18</option>
                    			<option>19</option>
                    			<option>20</option>
                    			<option>21</option>
                    			<option>22</option>
                    			<option>23</option>
                    			<option>24</option>
                    			<option>25</option>
                    			<option>26</option>
                    			<option>27</option>
                    			<option>28</option>
                    			<option>29</option>
                    			<option>30</option>
                    			<option>31</option>
                    			<option>32</option>
                    			<option>33</option>
                    			<option>34</option>
                    			<option>35</option>
                    			<option>36</option>
                    			<option>37</option>
                    			<option>38</option>
                    			<option>39</option>
                    			<option>40</option>
                    			<option>41</option>
                    			<option>42</option>
                    			<option>43</option>
                    			<option>44</option>
                    			<option>45</option>
                    			<option>46</option>
                    			<option>47</option>
                    			<option>48</option>
                    			<option>49</option>
                    			<option>50</option>
                    			<option>51</option>
                    			<option>52</option>
                    			<option>53</option>
                    			<option>54</option>
                    			<option>55</option>
                    			<option>56</option>
                    			<option>57</option>
                    			<option>58</option>
                    			<option>59</option>
                    			<option>60</option>
                    			<option>61</option>
                    			<option>62</option>
                    			<option>63</option>
                    			<option>64</option>
                    			<option>65</option>
                    			<option>66</option>
                    			<option>67</option>
                    			<option>68</option>
                    			<option>69</option>
                    			<option>70</option>
                    			<option>71</option>
                    			<option>72</option>
                    			<option>73</option>
                    			<option>74</option>
                    			<option>75</option>
                    			<option>76</option>
                    			<option>77</option>
                    			<option>78</option>
                    			<option>79</option>
                    			<option>80</option>
                    			<option>81</option>
                    			<option>82</option>
                    			<option>83</option>
                    			<option>84</option>
                    			<option>85</option>
                    			<option>86</option>
                    			<option>87</option>
                    			<option>88</option>
                    			<option>89</option>
                    			<option>90</option>
                    			<option>91</option>
                    			<option>92</option>
                    			<option>93</option>
                    			<option>94</option>
                    			<option>95</option>
                    			<option>96</option>
                    			<option>97</option>
                    			<option>98</option>
                    			<option>99</option>
                    		</select>
                    		<span id="wpgamelist-to-span"> To </span>
                    		<select id="wpgamelist-year-range-3">
                    			<option selected>20</option>
                    			<option>19</option>
                    			<option>18</option>
                    			<option>17</option>
                    			<option>16</option>
                    			<option>15</option>
                    			<option>14</option>
                    		</select>
                    		<select id="wpgamelist-year-range-4">
                    			<option>00</option>
                    			<option>01</option>
                    			<option>02</option>
                    			<option>03</option>
                    			<option>04</option>
                    			<option>05</option>
                    			<option>06</option>
                    			<option>07</option>
                    			<option>08</option>
                    			<option>09</option>
                    			<option>10</option>
                    			<option>11</option>
                    			<option>12</option>
                    			<option>13</option>
                    			<option>14</option>
                    			<option>15</option>
                    			<option>16</option>
                    			<option>17</option>
                    			<option>18</option>
                    			<option selected>19</option>
                    			<option>20</option>
                    			<option>21</option>
                    			<option>22</option>
                    			<option>23</option>
                    			<option>24</option>
                    			<option>25</option>
                    			<option>26</option>
                    			<option>27</option>
                    			<option>28</option>
                    			<option>29</option>
                    			<option>30</option>
                    			<option>31</option>
                    			<option>32</option>
                    			<option>33</option>
                    			<option>34</option>
                    			<option>35</option>
                    			<option>36</option>
                    			<option>37</option>
                    			<option>38</option>
                    			<option>39</option>
                    			<option>40</option>
                    			<option>41</option>
                    			<option>42</option>
                    			<option>43</option>
                    			<option>44</option>
                    			<option>45</option>
                    			<option>46</option>
                    			<option>47</option>
                    			<option>48</option>
                    			<option>49</option>
                    			<option>50</option>
                    			<option>51</option>
                    			<option>52</option>
                    			<option>53</option>
                    			<option>54</option>
                    			<option>55</option>
                    			<option>56</option>
                    			<option>57</option>
                    			<option>58</option>
                    			<option>59</option>
                    			<option>60</option>
                    			<option>61</option>
                    			<option>62</option>
                    			<option>63</option>
                    			<option>64</option>
                    			<option>65</option>
                    			<option>66</option>
                    			<option>67</option>
                    			<option>68</option>
                    			<option>69</option>
                    			<option>70</option>
                    			<option>71</option>
                    			<option>72</option>
                    			<option>73</option>
                    			<option>74</option>
                    			<option>75</option>
                    			<option>76</option>
                    			<option>77</option>
                    			<option>78</option>
                    			<option>79</option>
                    			<option>80</option>
                    			<option>81</option>
                    			<option>82</option>
                    			<option>83</option>
                    			<option>84</option>
                    			<option>85</option>
                    			<option>86</option>
                    			<option>87</option>
                    			<option>88</option>
                    			<option>89</option>
                    			<option>90</option>
                    			<option>91</option>
                    			<option>92</option>
                    			<option>93</option>
                    			<option>94</option>
                    			<option>95</option>
                    			<option>96</option>
                    			<option>97</option>
                    			<option>98</option>
                    			<option>99</option>
                    		</select>
                    	</div>
                    	<button onClick="window.location.reload();">Reset Filters, Sort & Search</button>
                    </div>
                </div>';

        echo $string1.$string2.$string3.$string4.$string5.$string6.$string7.$string8.$string9.$string10.$string11.$string12;
	}

	private function output_search(){

		$string1 = '<div id="wpgamelist-search-div">
						<div id="wpgamelist-search-sort-inner-cont">
						<div id="wpgamelist-sort-search-div">
							<div id="wpgamelist-select-sort-div">
		                        <select id="wpgamelist-sort-select-box">    
		                            <option selected disabled>'.__('Sort By...', 'wpgamelist').'</option>
		                            <option value="default">'.__('Default', 'wpgamelist').'</option>
		                            <option value="alphabetically">'.__('Alphabetically', 'wpgamelist').'</option>
		                            <option value="releasedate">'.__('Release Date', 'wpgamelist').'</option>
		                            <option value="author-desc">'.__('Author (Descending)', 'wpgamelist').'</option>';

		                           // if($this->display_options_actual->hidefinishedsort != 1){
		                            	$string1 = $string1.'<option value="year-read">'.__('Year Finished', 'wpgamelist').'</option>';
		                        	//}

		                        	//if($this->display_options_actual->hidesignedsort != 1){
		                            	$string1 = $string1.'<option value="signed">'.__('Signed', 'wpgamelist').'</option>';
		                        	//}

		                        	//if($this->display_options_actual->hidefirstsort != 1){
		                            	$string1 = $string1.'<option value="first-edition">'.__('First Edition', 'wpgamelist').'</option>';
		                        	//}

		                        	//if($this->display_options_actual->hidesubjectsort != 1){
		                            	$string1 = $string1.'<option value="subject">'.__('Subject', 'wpgamelist').'</option>';
		                        	//}




		                            $string1 = $string1.'<option value="pages-desc">'.__('Pages (Descending)', 'wpgamelist').'</option>
		                            <option value="pages-asc">'.__('Pages (Ascending)', 'wpgamelist').'</option>
		                            <option value="pub-desc">'.__('Publication Date (Descending)', 'wpgamelist').'</option>
		                            <option value="pub-asc">'.__('Publication Date (Ascending)', 'wpgamelist').'</option>
		                        </select>
                    		</div>
                    	</div>
                   	</div>
                    	<div id="wpgamelist-search-checkboxes">
	                        <p>'.__('Search By','wpgamelist').':
	                            <input id="wpgamelist-game-title-search" type="checkbox" name="game-title-search" value="game-title-search">'.__('Title', 'wpgamelist').'</input>
	                            <input id="wpgamelist-author-search" type="checkbox" name="author-search" value="author-search">'.__('Author','wpgamelist').'</input>
	                            <input id="wpgamelist-cat-search" type="checkbox" name="cat-search" value="author-search">'.__('Category','wpgamelist').'</input>
	                        </p>
                    	</div>
                    	<div>
                    		<input id="wpgamelist-search-text" type="text" name="search-query" value="'.__('Search...','wpgamelist').'">
                    	</div>
	                    <div id="wpgamelist-search-submit">
	                        <input disabled data-table="'.$this->table.'" id="wpgamelist-search-sub-button" type="button" name="search-button" value="'.__('Search','wpgamelist').'"></input>
	                    </div>
                	</div>';

        echo $string1;
	}

	private function output_close_sort_search(){
		echo '</div>';
	}

	private function output_stats(){
		$string1 = '
		<div class="wpgamelist_stats_tdiv">
         	<p class="wpgamelist_control_panel_stat">'.__('Total Games:','wpgamelist').' '.number_format($this->total_game_count).'</p>
            <p class="wpgamelist_control_panel_stat">'.__('Finished:','wpgamelist').' '.number_format($this->total_game_read_count).'</p>
            <p class="wpgamelist_control_panel_stat">'.__('Total Platforms:','wpgamelist').' '.number_format($this->total_platform_count).'</p>
            <p class="wpgamelist_control_panel_stat">'.__('Total Genres:','wpgamelist').' '.number_format($this->total_genre_count).'</p>
            <p class="wpgamelist_control_panel_stat">'.__('Total Publishers:','wpgamelist').' ';

       $string2 = $this->total_publisher_count;

        $string3 = '</p>
        </div>';

        echo $string1.$string2.$string3;
	}

	private function output_quote(){
		$quote_num = rand(0,$this->total_quotes_count);
		if($quote_num != null){
		    $quote_actual = $this->quotes_actual[$quote_num]->quote;
		    $pos = strpos($quote_actual,'" - ');
		    $attribution = substr($quote_actual, $pos);
		    $quote = substr($quote_actual, 0, $pos);
		    echo '<div class="wpgamelist-ui-quote-area-div">
	    		<p class="wpgamelist-ui-quote-area-p">
	    			<span id="wpgamelist-quote-actual">'.stripslashes($quote).'</span>
	    			<span id="wpgamelist-attribution-actual">'.stripslashes($attribution).'</span>
	    		</p>
	    	  </div>';
	    }
	}

	public function build_library_actual($offset){

		// Sorts the games by the 'Sort By' options on the 'Display Options' page, if a front-end 'Sort' option isn't in play.
		if($this->sort == ''){
			switch ($this->display_options_actual->sortoption) {
				case 'alphabetically':
					function compare1($a, $b){
	    				return strcmp($a->title, $b->title);
					}
					usort($this->games_actual, "compare1");
				break;
				case 'pages_desc':
					function compare2($b, $a){
	    				return $a->pages - $b->pages;
					}
					usort($this->games_actual, "compare2");
				break;
				case 'pages_asc':
					function compare3($a, $b){
	    				return $a->pages - $b->pages;
					}
					usort($this->games_actual, "compare3");
				break;
				case 'year_read':
					// First get all games that have been finished, then sort those, then display those first, and then the unfinished ones
					$finished_array = array();
					foreach($this->games_actual as $key=>$game){
						if($game->finished == 'Yes'){
							array_push($finished_array, $game);
							unset($this->games_actual[$key]);
						}
					}
					function compare4($a, $b){
	    				return strcmp($a->finishdate, $b->finishdate);
					}
					usort($finished_array, "compare4");
					$this->games_actual = array_merge($finished_array, $this->games_actual);
				break;
				case 'signed':
					// First get all games that have been finished, then sort those, then display those first, and then the unfinished ones
					$signed_array = array();
					foreach($this->games_actual as $key=>$game){
						if($game->signed == 'true'){
							array_push($signed_array, $game);
							unset($this->games_actual[$key]);
						}
					}
					function compare5($a, $b){
	    				return strcmp($a->signed, $b->signed);
					}
					usort($signed_array, "compare5");
					$this->games_actual = array_merge($signed_array, $this->games_actual);
				break;
				case 'first_edition':
					// First get all games that have been finished, then sort those, then display those first, and then the unfinished ones
					$edition_array = array();
					foreach($this->games_actual as $key=>$game){
						if($game->first_edition == 'true'){
							array_push($edition_array, $game);
							unset($this->games_actual[$key]);
						}
					}
					function compare6($a, $b){
	    				return strcmp($a->first_edition, $b->first_edition);
					}
					usort($edition_array, "compare6");
					$this->games_actual = array_merge($edition_array, $this->games_actual);
				break;
				
				default:
					# code...
					break;
			}
		}

		$this->games_actual;

		$string1 = '<div id="wpgamelist_main_display_div">';

		$onpage_key = 1;
		$string2 = '';

		foreach($this->games_actual as $key=>$game){

			// Replace default tag if the user has provided their own - 5.5.3
			if(strpos($game->amazonbuylink, 'wpbooklistid-20')){
				if($this->display_options_actual->amazonaff != '' && $this->display_options_actual->amazonaff != null){
					$game->amazonbuylink = str_replace('wpbooklistid-20', $this->display_options_actual->amazonaff, $game->amazonbuylink);
				}
			}

			// Replace my API key/Subscription ID if the user has provided their own - 5.5.3
			if(strpos($game->amazonbuylink, 'AKIAJCI3DJTKR6N4LR2A')){
				if($this->display_options_actual->amazonapipublic != '' && $this->display_options_actual->amazonapipublic != null){
					$game->amazonbuylink = str_replace('AKIAJCI3DJTKR6N4LR2A', $this->display_options_actual->amazonapipublic, $game->amazonbuylink);
				}
			}

			


			if($key >= $offset){ 
				if($onpage_key <= $this->display_options_actual->gamesonpage){

					// Displaying games based on provided action
					if($this->action == 'post'){
						if($game->post != 'false'){
							$string2 = $string2.'<div class="wpgamelist_entry_div">
			                <p style="display:none;" id="wpgamelist-hidden-isbn1">'.$game->game_uid.'</p>
			                <div class="wpgamelist_inner_main_display_div">
			                    <a href="'.get_permalink($game->post).'"><img class="wpgamelist_cover_image_class" data-gameid="'.$game->ID.'" data-gametable="'.$this->table.'" id="wpgamelist_cover_image" src="'.$game->image.'" style="opacity: 1;"></a>
			                    <span class="hidden_id_title">'.$game->ID.'</span>
			                    <a href="'.$game->amazonbuylink.'"><p class="wpgamelist_saved_title_link" data-gameid="'.$game->ID.'" data-gametable="'.$this->table.'" id="wpgamelist_saved_title_link">'.stripslashes($game->title).'<span class="hidden_id_title">1</span>
			                    </p></a>';
		                } else {
		                	$string2 = $string2.'<div class="wpgamelist_entry_div">
			                <p style="display:none;" id="wpgamelist-hidden-isbn1">'.$game->game_uid.'</p>
			                <div class="wpgamelist_inner_main_display_div">
			                    <img class="wpgamelist_cover_image_class wpgamelist-show-game-colorbox" data-gameid="'.$game->ID.'" data-gametable="'.$this->table.'" id="wpgamelist_cover_image" src="'.$game->image.'" style="opacity: 1;">
			                    <span class="hidden_id_title">'.$game->ID.'</span>
			                    <p class="wpgamelist_saved_title_link wpgamelist-show-game-colorbox" data-gameid="'.$game->ID.'" data-gametable="'.$this->table.'" id="wpgamelist_saved_title_link">'.stripslashes($game->title).'<span class="hidden_id_title">1</span>
			                    </p>';
		                }


		            } else if($this->action == 'page'){
						if($game->post != 'false'){
							$string2 = $string2.'<div class="wpgamelist_entry_div">
			                <p style="display:none;" id="wpgamelist-hidden-isbn1">'.$game->game_uid.'</p>
			                <div class="wpgamelist_inner_main_display_div">
			                    <a href="'.get_permalink($game->page).'"><img class="wpgamelist_cover_image_class" data-gameid="'.$game->ID.'" data-gametable="'.$this->table.'" id="wpgamelist_cover_image" src="'.$game->image.'" style="opacity: 1;"></a>
			                    <span class="hidden_id_title">'.$game->ID.'</span>
			                    <a href="'.$game->amazonbuylink.'"><p class="wpgamelist_saved_title_link" data-gameid="'.$game->ID.'" data-gametable="'.$this->table.'" id="wpgamelist_saved_title_link">'.stripslashes($game->title).'<span class="hidden_id_title">1</span>
			                    </p></a>';
		                } else {
		                	$string2 = $string2.'<div class="wpgamelist_entry_div">
			                <p style="display:none;" id="wpgamelist-hidden-isbn1">'.$game->game_uid.'</p>
			                <div class="wpgamelist_inner_main_display_div">
			                    <img class="wpgamelist_cover_image_class wpgamelist-show-game-colorbox" data-gameid="'.$game->ID.'" data-gametable="'.$this->table.'" id="wpgamelist_cover_image" src="'.$game->image.'" style="opacity: 1;">
			                    <span class="hidden_id_title">'.$game->ID.'</span>
			                    <p class="wpgamelist_saved_title_link wpgamelist-show-game-colorbox" data-gameid="'.$game->ID.'" data-gametable="'.$this->table.'" id="wpgamelist_saved_title_link">'.stripslashes($game->title).'<span class="hidden_id_title">1</span>
			                    </p>';
		                }


		            } else if($this->action == 'amazon'){
						$string2 = $string2.'<div class="wpgamelist_entry_div">
		                <p style="display:none;" id="wpgamelist-hidden-isbn1">'.$game->game_uid.'</p>
		                <div class="wpgamelist_inner_main_display_div">
		                    <a href="'.$game->amazonbuylink.'"><img class="wpgamelist_cover_image_class" data-gameid="'.$game->ID.'" data-gametable="'.$this->table.'" id="wpgamelist_cover_image" src="'.$game->image.'" style="opacity: 1;"></a>
		                    <span class="hidden_id_title">'.$game->ID.'</span>
		                    <a href="'.$game->amazonbuylink.'"><p class="wpgamelist_saved_title_link" data-gameid="'.$game->ID.'" data-gametable="'.$this->table.'" id="wpgamelist_saved_title_link">'.stripslashes($game->title).'<span class="hidden_id_title">1</span>
		                    </p></a>';
		            } else if($this->action == 'googlegames'){
		            	$string2 = $string2.'<div class="wpgamelist_entry_div">
		                <p style="display:none;" id="wpgamelist-hidden-isbn1">'.$game->game_uid.'</p>
		                <div class="wpgamelist_inner_main_display_div">
		                    <a href="'.$game->google_preview.'"><img class="wpgamelist_cover_image_class" data-gameid="'.$game->ID.'" data-gametable="'.$this->table.'" id="wpgamelist_cover_image" src="'.$game->image.'" style="opacity: 1;"></a>
		                    <span class="hidden_id_title">'.$game->ID.'</span>
		                    <a href="'.$game->google_preview.'"><p class="wpgamelist_saved_title_link" data-gameid="'.$game->ID.'" data-gametable="'.$this->table.'" id="wpgamelist_saved_title_link">'.stripslashes($game->title).'<span class="hidden_id_title">1</span>
		                    </p></a>';

		            } else if($this->action == 'igames'){
		            	$string2 = $string2.'<div class="wpgamelist_entry_div">
		                <p style="display:none;" id="wpgamelist-hidden-isbn1">'.$game->game_uid.'</p>
		                <div class="wpgamelist_inner_main_display_div">
		                    <a href="'.$game->itunes_page.'"><img class="wpgamelist_cover_image_class" data-gameid="'.$game->ID.'" data-gametable="'.$this->table.'" id="wpgamelist_cover_image" src="'.$game->image.'" style="opacity: 1;"></a>
		                    <span class="hidden_id_title">'.$game->ID.'</span>
		                    <a href="'.$game->itunes_page.'"><p class="wpgamelist_saved_title_link" data-gameid="'.$game->ID.'" data-gametable="'.$this->table.'" id="wpgamelist_saved_title_link">'.stripslashes($game->title).'<span class="hidden_id_title">1</span>
		                    </p></a>';

		            } else if($this->action == 'gamesamillion'){
		            	$string2 = $string2.'<div class="wpgamelist_entry_div">
		                <p style="display:none;" id="wpgamelist-hidden-isbn1">'.$game->game_uid.'</p>
		                <div class="wpgamelist_inner_main_display_div">
		                    <a href="http://www.anrdoezrs.net/links/8090484/type/dlg/'.$game->bam_link.'?id=7059442747215"><img class="wpgamelist_cover_image_class" data-gameid="'.$game->ID.'" data-gametable="'.$this->table.'" id="wpgamelist_cover_image" src="'.$game->image.'" style="opacity: 1;"></a>
		                    <span class="hidden_id_title">'.$game->ID.'</span>
		                    <a href="http://www.anrdoezrs.net/links/8090484/type/dlg/'.$game->bam_link.'?id=7059442747215"><p class="wpgamelist_saved_title_link" data-gameid="'.$game->ID.'" data-gametable="'.$this->table.'" id="wpgamelist_saved_title_link">'.stripslashes($game->title).'<span class="hidden_id_title">1</span>
		                    </p></a>';

		            } else if($this->action == 'kobo'){
		            	$string2 = $string2.'<div class="wpgamelist_entry_div">
		                <p style="display:none;" id="wpgamelist-hidden-isbn1">'.$game->game_uid.'</p>
		                <div class="wpgamelist_inner_main_display_div">
		                    <a href="'.$game->kobo_link.'"><img class="wpgamelist_cover_image_class" data-gameid="'.$game->ID.'" data-gametable="'.$this->table.'" id="wpgamelist_cover_image" src="'.$game->image.'" style="opacity: 1;"></a>
		                    <span class="hidden_id_title">'.$game->ID.'</span>
		                    <a href="'.$game->kobo_link.'"><p class="wpgamelist_saved_title_link" data-gameid="'.$game->ID.'" data-gametable="'.$this->table.'" id="wpgamelist_saved_title_link">'.stripslashes($game->title).'<span class="hidden_id_title">1</span>
		                    </p></a>';
		            } else {
		            	$string2 = $string2.'<div class="wpgamelist_entry_div">
		                <p style="display:none;" id="wpgamelist-hidden-isbn1">'.$game->game_uid.'</p>
		                <div class="wpgamelist_inner_main_display_div">
		                    <img class="wpgamelist_cover_image_class wpgamelist-show-game-colorbox" data-gameid="'.$game->ID.'" data-gametable="'.$this->table.'" id="wpgamelist_cover_image" src="'.$game->image.'" style="opacity: 1;">
		                    <span class="hidden_id_title">'.$game->ID.'</span>
		                    <p class="wpgamelist_saved_title_link wpgamelist-show-game-colorbox" data-gameid="'.$game->ID.'" data-gametable="'.$this->table.'" id="wpgamelist_saved_title_link">'.stripslashes($game->title).'<span class="hidden_id_title">1</span>
		                    </p>';
		            }

		                    if($this->display_options_actual->hidestarslibrary != 1 && $game->myrating != 0 && $game->myrating != null){

		                    	if($game->myrating == 1){
		                    		$string2 = $string2.'<img style="opacity: 1;" class="wpgamelist-rating-image" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'1star.png">';
		                    	}

		                    	if($game->myrating == 2){
		                    		$string2 = $string2.'<img style="opacity: 1;" class="wpgamelist-rating-image" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'2star.png">';
		                    	}

		                    	if($game->myrating == 3){
		                    		$string2 = $string2.'<img style="opacity: 1;" class="wpgamelist-rating-image" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'3star.png">';
		                    	}

		                    	if($game->myrating == 4){
		                    		$string2 = $string2.'<img style="opacity: 1;" class="wpgamelist-rating-image" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'4star.png">';
		                    	}

		                    	if($game->myrating == 5){
		                    		$string2 = $string2.'<img style="opacity: 1;" class="wpgamelist-rating-image" src="'.GAMELIST_GAMELIST_ROOT_IMG_URL.'5star.png">';
		                    	}

		                    }

		                    $string2 = $string2.'<div class="wpgamelist-library-frontend-purchase-div">';

		                    $sales_array = array($game->purchaselink,$game->price);
		                    if($this->display_options_actual->enablepurchase == 1 && ($game->price != null && $game->price != '') && $this->display_options_actual->hidefrontendbuyprice != 1){
			                    if(has_filter('wpgamelist_append_to_frontend_library_price_purchase')) {
									$string2 = $string2.apply_filters('wpgamelist_append_to_frontend_library_price_purchase', $sales_array);
								}
							}

							if($this->display_options_actual->enablepurchase == 1 && $game->purchaselink != '' && $this->display_options_actual->hidefrontendbuyimg != 1){
			                    if(has_filter('wpgamelist_append_to_frontend_library_image_purchase')) {
									$string2 = $string2.apply_filters('wpgamelist_append_to_frontend_library_image_purchase', $sales_array);
								}
							}

		                    $string2 = $string2.'</div></div></div>';

		            $onpage_key++;
		        }
	    	}
		}

		$string3 = '</div>';

		$this->library_actual_string = $string1.$string2;

		$this->build_library_pagination();
		$this->output_library_actual();

	}

	private function build_library_pagination(){

		$string1 = '<div id="wpgamelist-pagination-div">';

		if($this->total_game_count > 0 && $this->display_options_actual->gamesonpage > 0){
			$whole_pages = floor($this->total_game_count/$this->display_options_actual->gamesonpage);
			$remainder_pages = $this->total_game_count%$this->display_options_actual->gamesonpage;

			// If there's only one page, don't show pagination
			if($whole_pages >= 1){
				for($i = 0; $i <= $whole_pages; $i++){

					$remainder = $this->total_game_count-($i*$this->display_options_actual->gamesonpage);

					if( ((($i+1)*$this->display_options_actual->gamesonpage)-($this->display_options_actual->gamesonpage-1)) >   $this->total_game_count){
						$string1 = $string1.'</div>';
						$this->library_pagination_string = $string1;
						return;
					}

					if($remainder > $this->display_options_actual->gamesonpage){
						if(((($i+1)*$this->display_options_actual->gamesonpage)-($this->display_options_actual->gamesonpage-1)) == (($i+1)*$this->display_options_actual->gamesonpage)){
								$string1 = $string1.'<div data-library="'.$this->table.'" data-page="'.$i.'" data-per-page="'.$this->display_options_actual->gamesonpage.'" class="wpgamelist-pagination-page-div" id="wpgamelist-pagination-page-'.$i.'"> '.((($i+1)*$this->display_options_actual->gamesonpage)-($this->display_options_actual->gamesonpage-1)).' </div>';
						} else {
							$string1 = $string1.'<div data-library="'.$this->table.'" data-page="'.$i.'" data-per-page="'.$this->display_options_actual->gamesonpage.'" class="wpgamelist-pagination-page-div" id="wpgamelist-pagination-page-'.$i.'"> '.((($i+1)*$this->display_options_actual->gamesonpage)-($this->display_options_actual->gamesonpage-1)).'-'.(($i+1)*$this->display_options_actual->gamesonpage).' </div>';
						}

					} else {
						// This if displays just the one game number if there's only one game on the next page
						if(((($i+1)*$this->display_options_actual->gamesonpage)-($this->display_options_actual->gamesonpage-1)) == $this->total_game_count){
							$string1 = $string1.'<div data-library="'.$this->table.'" data-page="'.$i.'" data-per-page="'.$this->display_options_actual->gamesonpage.'" class="wpgamelist-pagination-page-div" id="wpgamelist-pagination-page-'.$i.'"> '.((($i+1)*$this->display_options_actual->gamesonpage)-($this->display_options_actual->gamesonpage-1)).' </div>';
						} else {
							$string1 = $string1.'<div data-library="'.$this->table.'" data-page="'.$i.'" data-per-page="'.$this->display_options_actual->gamesonpage.'" class="wpgamelist-pagination-page-div" id="wpgamelist-pagination-page-'.$i.'"> '.((($i+1)*$this->display_options_actual->gamesonpage)-($this->display_options_actual->gamesonpage-1)).'-'.$this->total_game_count.' </div>';
						}
					}
				}
			}
		}

		$string1 = $string1.'</div>';

		$this->library_pagination_string = $string1;
	}

	private function output_library_actual(){
		echo $this->library_actual_string.$this->library_pagination_string;
	}


}


endif;

?>