<?php


/**
 * Conflict resolution class
 * 
 *
 */
class Conflict {
	
	/**
	 *
	 *		All the words we want to check
	 *
	 */
	var $all_words = array(
		"acai",
		"acid",
		"acidic",
		"acidity",
		"adriatic",
		"afghanistan",
		"africa",
		"agricultural",
		"agriculture",
		"akebi",
		"alabama",
		"algeria",
		"algerian",
		"almond",
		"amber",
		"america",
		"american",
		"americana",
		"andes",
		"appearance",
		"apple",
		"apricot",
		"arabic",
		"arctic",
		"argentina",
		"arid",
		"arizona",
		"aroma",
		"aromatic",
		"artocarpus",
		"asia",
		"asian",
		"astringent",
		"attractive",
		"australia",
		"avocado",
		"aztec",
		"baby",
		"bali",
		"banana",
		"bangladesh",
		"barbados",
		"bartlett",
		"belgium",
		"bengal",
		"berry",
		"bermuda",
		"beurré",
		"big",
		"bitter",
		"bilva",
		"black",
		"blackberries",
		"blackberry",
		"blossom",
		"blue",
		"blueberries",
		"blueberry",
		"bogotá",
		"bosc",
		"bramble",
		"branches",
		"brazil",
		"bread",
		"breadfruit",
		"bright",
		"brown",
		"brunei",
		"budwood",
		"bulbous",
		"burgundy",
		"burma",
		"buttery",
		"cactus",
		"california",
		"canada",
		"canning",
		"cantaloupe",
		"cantalupo",
		"capitata",
		"caramel",
		"caribbean",
		"carica",
		"cavaillon",
		"cavendish",
		"cavity",
		"center",
		"cheese",
		"cherimoya",
		"cherries",
		"cherry",
		"chestnut",
		"chile",
		"china",
		"chinese",
		"cinnamon",
		"citric",
		"citrullus",
		"citrus",
		"clementine",
		"clingstone",
		"clusters",
		"coast",
		"coastal",
		"coconut",
		"cold",
		"colder",
		"colombia",
		"colombian",
		"columbia",
		"concord",
		"conical",
		"consistency",
		"core",
		"cornflower",
		"costa",
		"cottony",
		"covered",
		"crack",
		"cranberries",
		"cranberry",
		"cream",
		"creamy",
		"crescent",
		"crete",
		"crisp",
		"crop",
		"cross",
		"crown",
		"crunchy",
		"cucumber",
		"cucumis",
		"cucurbitaceae",
		"culture",
		"currant",
		"currants",
		"curved",
		"custard",
		"custardlike",
		"cydonia",
		"cyphomandra",
		"dark",
		"date",
		"dates",
		"deep",
		"delicate",
		"delicious",
		"dense",
		"depressions",
		"desert",
		"diego",
		"diospyros",
		"domesticated",
		"dominican",
		"dragon",
		"dried",
		"drupelets",
		"dry",
		"durian",
		"east",
		"eastern",
		"ecuador",
		"ecuadorian",
		"edible",
		"edulis",
		"egg",
		"eggshaped",
		"egypt",
		"egyptian",
		"eight",
		"elderberries",
		"elderberry",
		"elongated",
		"enclosed",
		"england",
		"english",
		"eureka",
		"europe",
		"european",
		"evergreen",
		"exotic",
		"faint",
		"fall",
		"feijoa",
		"fibrous",
		"fifteen",
		"fig",
		"fiji",
		"firm",
		"five",
		"flat",
		"flesh",
		"fleshy",
		"flora",
		"floral",
		"florida",
		"flowering",
		"flowers",
		"foliage",
		"fragile",
		"fragrance",
		"france",
		"freestone",
		"french",
		"fresh",
		"fresno",
		"fruit",
		"fruity",
		"fuji",
		"fuyu",
		"fuzzy",
		"gac",
		"gala",
		"garden",
		"garlic",
		"gelatinous",
		"german",
		"ghana",
		"globular",
		"glossy",
		"gold",
		"golden",
		"gooseberries",
		"gooseberry",
		"gourd",
		"granny",
		"grape",
		"grapefruit",
		"gray",
		"greece",
		"green",
		"groove",
		"groves",
		"guanabana",
		"guatemala",
		"guava",
		"guinea",
		"hairs",
		"hairy",
		"hard",
		"hardy",
		"hass",
		"hawaii",
		"healthy",
		"heartshaped",
		"heavy",
		"hemispheres",
		"herb",
		"herbaceous",
		"hollow",
		"honduras",
		"honey",
		"honeydew",
		"horticultural",
		"hot",
		"hue",
		"hued",
		"huge",
		"humid",
		"husk",
		"husked",
		"india",
		"indian",
		"indies",
		"indonesia",
		"inedible",
		"iran",
		"israel",
		"italy",
		"ivory",
		"jack",
		"jamaica",
		"japan",
		"japanese",
		"jellied",
		"jelly",
		"jellylike",
		"joaquin",
		"juice",
		"juicy",
		"jujube",
		"kentucky",
		"kiwi",
		"kiwifruit",
		"ladyfinger",
		"lanatus",
		"lanka",
		"large",
		"larger",
		"largest",
		"latin",
		"leathery",
		"leaves",
		"lemon",
		"lemons",
		"light",
		"lightly",
		"lime",
		"limes",
		"limón",
		"liqueur",
		"liquid",
		"long",
		"longan",
		"longer",
		"loquat",
		"lumpy",
		"lychee",
		"malay",
		"malaysia",
		"mandarin",
		"mango",
		"mangosteen",
		"massachusetts",
		"medicine",
		"mediterranean",
		"mellow",
		"melon",
		"mexican",
		"mexico",
		"mild",
		"mildly",
		"moist",
		"moisture",
		"moraceae",
		"mottled",
		"mountainous",
		"mountains",
		"mulberries",
		"mulberry",
		"muskmelon",
		"musky",
		"narrow",
		"native",
		"natural",
		"naturally",
		"navel",
		"nectarine",
		"nigeria",
		"nile",
		"noni",
		"north",
		"northeastern",
		"northern",
		"northwest",
		"nut",
		"nutty",
		"oblong",
		"oblonga",
		"odor",
		"oil",
		"oily",
		"orange",
		"orchard",
		"oregon",
		"oriental",
		"outer",
		"oval",
		"ovate",
		"ovoid",
		"pacific",
		"pakistan",
		"palatable",
		"pale",
		"palm",
		"panama",
		"papaya",
		"paraguay",
		"passiflora",
		"passion",
		"passionfruit",
		"peach",
		"peaches",
		"pear",
		"pearshaped",
		"peel",
		"peeled",
		"pepper",
		"perennial",
		"perry",
		"persia",
		"persian",
		"persica",
		"persimmon",
		"peru",
		"peruvian",
		"petite",
		"philippines",
		"pineapple",
		"pink",
		"piquant",
		"pit",
		"pitaya",
		"plant",
		"plantain",
		"plum",
		"plump",
		"plumper",
		"pods",
		"pointed",
		"poisonous",
		"polynesian",
		"pomegranate",
		"pomelo",
		"porous",
		"portuguese",
		"potato",
		"prunus",
		"puerto",
		"pulp",
		"pulpy",
		"pumpkin",
		"pungent",
		"purple",
		"pyrus",
		"queen",
		"quince",
		"quito",
		"rare",
		"raspberries",
		"raspberry",
		"raw",
		"red",
		"republic",
		"reticulatus",
		"rica",
		"rind",
		"ripe",
		"ripen",
		"ripeness",
		"ripening",
		"river",
		"roasted",
		"root",
		"rootstock",
		"rome",
		"rosa",
		"rosaceae",
		"rose",
		"rouge",
		"rough",
		"rounded",
		"russet",
		"russia",
		"rusty",
		"sacs",
		"salvador",
		"samoa",
		"san",
		"sand",
		"sapodilla",
		"sapote",
		"scale",
		"scaly",
		"sea",
		"season",
		"seed",
		"seeded",
		"seedless",
		"seeds",
		"semisoft",
		"seville",
		"shaddock",
		"shades",
		"shape",
		"shaped",
		"shapes",
		"sharp",
		"shea",
		"shell",
		"shiny",
		"short",
		"shrubs",
		"singapore",
		"single",
		"six",
		"skin",
		"sliced",
		"small",
		"smaller",
		"smooth",
		"soft",
		"solanaceae",
		"sour",
		"source",
		"soursop",
		"south",
		"southeast",
		"southern",
		"southwestern",
		"spain",
		"spanish",
		"speckled",
		"spherical",
		"spicy",
		"spikelike",
		"spiny",
		"spongy",
		"spots",
		"spring",
		"squat",
		"starchy",
		"stems",
		"sticky",
		"stone",
		"strawberries",
		"strawberry",
		"stripes",
		"subtropical",
		"subtropics",
		"succulence",
		"succulent",
		"sugar",
		"sunny",
		"surface",
		"sweet",
		"sweeter",
		"sweetness",
		"sweetsop",
		"sweettart",
		"syria",
		"tahiti",
		"tall",
		"tamarillo",
		"tangelo",
		"tangerine",
		"tangy",
		"tannin",
		"tart",
		"taut",
		"temperate",
		"tender",
		"texas",
		"thailand",
		"thick",
		"thin",
		"thorny",
		"tiny",
		"tobacco",
		"tongo",
		"tomatillo",
		"tomato",
		"tough",
		"toxic",
		"translucent",
		"tree",
		"triploid",
		"tropical",
		"tropics",
		"turkey",
		"ugli",
		"unripe",
		"vaccinium",
		"valencia",
		"vanilla",
		"vegetable",
		"velvety",
		"venezuela",
		"vietnam",
		"vine",
		"vinifera",
		"virginia",
		"vitis",
		"warmer",
		"washington",
		"watermelon",
		"waxy",
		"west",
		"wet",
		"white",
		"wide",
		"widely",
		"wild",
		"williams",
		"winter",
		"wood",
		"woody",
		"yellow",
		"yellowish",
		"yucatan",
		"zapote",
		"zealand"
	); 
	 
	
	/**
	 * 		Mapper from character to number
	 *		Ignoring periods, numbers
	 */
	var $char_to_num = array(
		"a" => 0, "b" => 1, "c" => 2, "d" => 3, "e" => 4,
		"f" => 5, "g" => 6, "h" => 7, "i" => 8, "j" => 9,
		"k" => 10, "l" => 11, "m" => 12, "n" => 13, "o" => 14,
		"p" => 15, "q" => 16, "r" => 17, "s" => 18, "t" => 19,
		"u" => 20, "v" => 21, "w" => 22, "x" => 23, "y" => 24,
		"z" => 25, ";" => 26, "[" => 27, "," => 28,
	);


	/**
	 *		Array to store the weights of every letter
	 * 			weighted by frequency of the word in the english alphabet and proximity 
	 *
	 * 		mismatched cost: arr[i][i] - a[i][j]
	 * 		normal cost: arr[i][j]
	 *
	 */
	var $char_values = array(
		//     a, b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u, v, w, x, y, z, ;, [, ,
		array( 9, 0, 0, 0, 4, 0, 0, 0, 2, 0, 0, 0, 0, 0, 5, 0, 2, 0, 4, 0, 1, 0, 2, 1, 0, 2, 0, 0, 0 ),	// a	
		array( 0, 9, 0, 0, 0, 2, 2, 2, 0, 0, 0, 0, 0, 4, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0 ),	// b	
		array( 0, 0, 9, 3, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 0, 2, 0, 2, 0, 0, 0, 0, 0 ),	// c
		array( 0, 0, 3, 9, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 4, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0 ),	// d
		array( 3, 0, 0, 0, 9, 1, 0, 0, 1, 0, 0, 0, 0, 0, 3, 0, 0, 3, 3, 0, 1, 0, 2, 0, 0, 0, 0, 0, 0 ),	// e

		array( 0, 2, 3, 4, 1, 8, 2, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, 3, 0, 2, 0, 1, 0, 0, 0, 0, 0, 0, 0 ),	// f
		array( 0, 2, 0, 0, 0, 2, 8, 2, 0, 0, 0, 0, 0, 1, 0, 0, 0, 2, 0, 2, 0, 1, 0, 0, 1, 0, 0, 0, 0 ),	// g
		array( 0, 1, 0, 0, 0, 0, 2, 8, 0, 1, 0, 0, 1, 2, 0, 0, 0, 0, 0, 2, 1, 0, 0, 0, 1, 0, 0, 0, 0 ),	// h
		array( 2, 0, 0, 0, 2, 0, 0, 0, 9, 3, 2, 3, 0, 0, 4, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0 ),	// i
		array( 0, 0, 0, 0, 0, 0, 0, 2, 3, 6, 2, 0, 2, 3, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0 ),	// j

		array( 0, 0, 0, 0, 0, 0, 0, 0, 2, 2, 7, 2, 2, 0, 2, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0 ),	// k
		array( 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 2, 9, 0, 0, 4, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ),	// l
		array( 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 2, 9, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ),	// m
		array( 0, 3, 0, 0, 0, 0, 0, 2, 0, 2, 0, 0, 4, 9, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ),	// n
		array( 4, 0, 0, 0, 3, 0, 0, 0, 3, 0, 2, 2, 0, 0, 9, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ),	// o

		array( 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 0, 4, 9, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ),	// p
		array( 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 6, 0, 0, 2, 0, 0, 2, 0, 0, 0, 0, 0, 0 ),	// q
		array( 0, 0, 0, 2, 3, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 9, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0 ),	// r
		array( 3, 0, 4, 3, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 9, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0 ),	// s
		array( 0, 0, 0, 0, 0, 2, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 9, 0, 0, 0, 0, 3, 0, 0, 0, 0 ),	// t

		array( 1, 0, 0, 0, 1, 0, 0, 1, 3, 2, 2, 0, 0, 0, 1, 0, 0, 0, 0, 0, 9, 0, 0, 0, 2, 0, 0, 0, 0 ),	// u
		array( 0, 2, 3, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7, 0, 0, 0, 0, 0, 0, 0 ),	// v
		array( 2, 0, 0, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 2, 0, 0, 0, 7, 0, 0, 0, 0, 0, 0 ),	// w
		array( 2, 0, 3, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 0, 0, 0, 6, 0, 1, 0, 0, 0 ),	// x
		array( 0, 0, 0, 0, 0, 0, 2, 2, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 3, 2, 0, 0, 8, 0, 0, 0, 0 ),	// y

		array( 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 0, 0, 0, 0, 1, 0, 6, 0, 0, 0 ),	// z
		array( 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0 ),	// ;
		array( 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 0 ),	// [
		array( 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 3, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4 )	// ,
	);

	// Big query: cantolupea curranta indiea fleshe americam

	// score threshold - should be within this value of the correct word
	var $score_thres;
	
	// stores the indices of words/phrases we are comparing with
	var $comp_words;
	
	// will store the return results (~top three)
	var $most_sim_words;

	/**		
	 *		The conflict resolution function
	 *
	 * 		@param string: their query      	     	
	 * 		@return array of results, check if result is complete match or not	
	 */
	public function conflict_res($query) {
		// make query lowercase
		$query = trim($query);
		
		// regular query - 1 word			
		$query = strtolower($query);
		
		// only get first word of query
		$query_reg = explode(' ', $query);

		for ( $i = 0; $i < count($query_reg); ++$i )
			$query_reg[$i] = preg_replace("/[^a-z]+/", '', $query_reg[$i]);
		
		// initialize similar array
		$this -> most_sim_words = array();
		
		for ( $i = 0; $i < count($query_reg); ++$i ) {	
			$query = $query_reg[$i];
			
			// threshold score --- will depend on string length
			// only check up to +- threshold score
			$this -> score_thres = floor( log(strlen($query), 2) ) * 5;
		
			// initialize all arrays
			$this -> comp_words = array();			
		
			$this -> fillCompWords($query);			
			$this -> fillSimWords($query);					
		}
		
		//ksort($this -> most_sim_words);
		return $this -> most_sim_words;						// should check if size is 0 --- no results
	}
	
	
	/**		
	 *		Filters out most of the words so we do not need to search as much
	 *				similar to above but with multiple words
	 *				one word query compared to one word stock name/symbol
	 *
	 * 		@param string: their query
	 *		@return array: similar results
	 */
	private function fillSimWords($query) {	
		$top_three = array();			// similarity value, index --- not actually top three
		
		for ($i = 0; $i < count($this -> comp_words); ++$i) {
			$word = $this -> comp_words[$i];
			
			// need to find the minimum similarity
			$min_similar = 10000;
			
			// used for transposing
			$query_copy = $query;
			
			for ( $j = 0; $j < strlen($query_copy); ++$j ) {
				$query = $this -> transpose($query_copy, $j);
				
				$similarity = $this -> getOptimal($query, $word);
				
				if ( strlen($query) > 0 && strlen($word) > 0 ) 
					$similarity += floor( $this -> getPenalty($query[0], $word[0]) / 2 );						// can change
				
				if ( $similarity < $min_similar )
					$min_similar = $similarity;
			}
	
			// might want to change in case of transpose
			if ($min_similar == 0) {
				$perfect_match = array();	
				array_push($perfect_match, "123--");				// poison pill
				array_push($perfect_match, $word);
				array_push($this -> most_sim_words, $perfect_match);
				return;
			}
			
			// fill up to find top three most relavent results
			if ( $min_similar <= $this -> score_thres ) {	 
				if ( array_key_exists(intval($min_similar), $top_three) == false ) 
					$top_three[$min_similar] = array();
		
				array_push($top_three[$min_similar], $word);
			}
		}
		
		if ( count($top_three) == 0 ) {
			$perfect_match = array();	
			array_push($perfect_match, "321--");				// poison pill, no results
			array_push($perfect_match, $query);
			array_push($this -> most_sim_words, $perfect_match);
			return;
		}
		
		ksort($top_three);
		array_push($this -> most_sim_words, $top_three);				// also need to check if length is 0
	}
	
	
	/**		
	 *		Transposes the query in case they switch letters ie teh -> the
	 *
	 * 		@param string: their query
	 * 		@param idx: the idx of the switch
	 */
	private function transpose($query, $idx) {	
		if ( $idx == 0 )
			return $query;
		
		$query_new = $query;	
		$temp = $query_new[$idx - 1];	
		$query_new[$idx - 1] = $query_new[$idx];
		$query_new[$idx] = $temp;
		
		return $query_new;
	}
	

	/**		
	 *		Filters out most of the words so we do not need to search as much
	 *				similar to above but with multiple words
	 *
	 * 		@param string: their query
	 */
	private function fillCompWords($query) {
		$max_score = 0;
		
		for ($i = 0; $i < strlen($query); ++$i) 
			$max_score += $this -> getScore($query[$i]);
			
		for ($i = 0; $i < count($this -> all_words); ++$i) {
			$word_score = 0;
			$word = strtolower($this -> all_words[$i]);
			$word = preg_replace("/[^a-z]+/", '', $word);
	
			for ($j = 0; $j < strlen($word); ++$j) 
				$word_score += $this -> getScore($word[$j]);
	
			if ( abs($word_score - $max_score) <= $this -> score_thres ) 
				array_push($this -> comp_words, $word);
		}
	}

	
	/**		
	 *		Gets the score of the letter, also checks if they are valid
	 *
	 * 		@param char: letter
	 *		@return the score of the letter
	 */
	private function getScore($letter) {
		if ( isset($this -> char_to_num[$letter]) )
			return $this -> char_values[ $this -> char_to_num[$letter] ][ $this -> char_to_num[$letter] ];
		
		return 0;				// defaulted to 0 if the character is not one of those listed
	}
	
	
	/**		
	 *		Gets the penalty between the two letters, also checks if they are valid
	 *
	 * 		@param char: letter1 - from query
	 *		@param char: letter2 - from a word from the list of relevant words
	 *		@return the penalty of the letter
	 */
	private function getPenalty($letter1, $letter2) {
		if ( isset($this -> char_to_num[$letter1]) )
			return ($this -> char_values[ $this -> char_to_num[$letter1] ][ $this -> char_to_num[$letter1] ] - $this -> char_values[ $this -> char_to_num[$letter1] ][ $this -> char_to_num[$letter2] ]);
			
		return 7;				// default penalty if the word is not one of those listed
	}

	
	/**
	 * 		Runs our conflict resolution algorithm
	 *
	 * 		@param string: their query        	
	 *		@param string: from the list of relevant words     	       	
	 * 		@return weight of their difference
	 */
	private function getOptimal($str1, $str2) {
		$str1_len = strlen($str1);
		$str2_len = strlen($str2);
	
		// gap penalty is 6
		$gap_penalty = 6;

		// our 2d array
		$dp = array_fill(0, 2, array_fill(0, $str1_len + 1, 0));
		
		for ($i = 0; $i <= $str1_len; ++$i) 
			$dp[0][$i] = $gap_penalty * $i;
	
		for ($j = 1; $j <= $str2_len; ++$j) {
			$dp[1][0] = $gap_penalty * $j;
		
			for ($i = 1; $i <= $str1_len; ++$i) {
				$mis_penalty = $this -> getPenalty($str1[$i - 1], $str2[$j - 1]);
				$dp[1][$i] = min( $gap_penalty + $dp[1][$i - 1], $gap_penalty + $dp[0][$i], $dp[0][$i - 1] + $mis_penalty );
			}
		
			// saving space
			for ($i = 1; $i <= $str1_len; ++$i) 
				$dp[0][$i] = $dp[1][$i];
		}
	
		return $dp[0][$str1_len];
	}
}

?>
