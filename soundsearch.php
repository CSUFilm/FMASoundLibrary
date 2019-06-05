<?php
/*
 *  Cleveland State University
 *  School of Film and Media Arts
 * 
 *  Sound Library Search Tool
 * 
 *  soundsearch.php
 *
 *  v0.2.3
 *  31 May 2019
 * 	Zak Kascak & Ryan Kraynak
 */

$mysqli = new mysqli("ip.address.com", "username", "password", "sound_library");

if (mysqli_connect_errno()) {
	printf("connection failed: %s\n", mysqli_connect_error());
	exit();
} else {
	echo "CONNECTED\n";
    printf("host information: %s\n\n", mysqli_get_host_info($mysqli));
}

$in = fopen('php://stdin', 'r');
echo "Enter Search Query:";

$searchText = fgets($in, 250);
$searchText = rtrim($searchText, "\n\r");

echo "$searchText \n";

//$genre1Query = "SELECT * FROM sfx WHERE genre1 = '$searchTerm';";
$genre1Results = mysqli_query($mysqli, "SELECT * FROM sfx WHERE genre1 LIKE '%$searchText%';");

$genre1NumRows = mysqli_num_rows($genre1Results);

echo "--------------------GENRE 1 RESULTS--------------------\n";

searchResults($genre1NumRows, $genre1Results);

$genre2Results = mysqli_query($mysqli, "SELECT * FROM sfx WHERE genre2 LIKE '%$searchText%';");
$genre2NumRows = mysqli_num_rows($genre2Results);

echo "--------------------GENRE 2 RESULTS--------------------\n";

searchResults($genre2NumRows, $genre2Results);

$genre3Results = mysqli_query($mysqli, "SELECT * FROM sfx WHERE genre3 LIKE '%$searchText%';");
$genre3NumRows = mysqli_num_rows($genre3Results);

echo "--------------------GENRE 3 RESULTS--------------------\n";

searchResults($genre3NumRows, $genre3Results);		


$descriptionResults = mysqli_query($mysqli, "SELECT * FROM sfx WHERE description LIKE '%$searchText%';");
$descriptionNumRows = mysqli_num_rows($descriptionResults);

echo "--------------------DESCRIPTION RESULTS--------------------\n";

searchResults($descriptionNumRows, $descriptionResults);

mysqli_close($mysqli);

function searchResults($numOfRows, $searchResults){
	if ($numOfRows < 1) {
        	echo "No results found.\n\n";
	} else {
        	echo "Number of results: " . $numOfRows . "\n\n";

        	while ($records = mysqli_fetch_array($searchResults)){
                	$sfx_id = $records['sfx_id'];
	                $cd_name = $records['cd_name'];
        	        $cd_track = $records['cd_track'];
                	$cd_track_index = $records['cd_track_index'];
	                $title = $records['title'];
        	        $genre1 = $records['genre1'];
                	$genre2 = $records['genre2'];
	                $genre3 = $records['genre3'];
        	        $description = $records['description'];
                	$length = $records['length'];
	                $location = $records['location'];
        	        $license_id = $records['license_id'];
					$displayblock = "SFX ID: $sfx_id CD: $cd_name CD Track: $cd_track CD Track Index: $cd_track_index Title: $title Genres: $genre1: $genre2: $genre3: Description: $descriptionLength: $lengthLocation: $location";
		}
        }
}
	echo $displayblock;
?>
