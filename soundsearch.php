<?php
/*
 *  Cleveland State University
 *  School of Film and Media Arts
 * 
 *  Sound Library Search Tool
 * 
 *  soundsearch.php
 * 
 *  v0.2
 *  1 October 2018
 *  Zachary Kascak
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

if ($genre1NumRows < 1) {
	echo "No Results Found.\n\n";
} else {
	printf("Number of results: %d\n\n", $genre1NumRows);
	
	while ($records = mysqli_fetch_array($genre1Results)){
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
		
		echo "SFX ID: $sfx_id \t CD: $cd_name \t CD Track: $cd_track \t CD Track Index: $cd_track_index \n";
		echo "Title: $title \n";
		echo "Genres: $genre1 \t $genre2 \t $genre3 \n";
		echo "Description: $description \n";
		echo "Length: $length \t Location: /$location \n\n";
	}
}

$genre2Results = mysqli_query($mysqli, "SELECT * FROM sfx WHERE genre2 LIKE '%$searchText%';");
$genre2NumRows = mysqli_num_rows($genre2Results);

echo "--------------------GENRE 2 RESULTS--------------------\n";

if ($genre2NumRows < 1) {
	echo "No results found.\n";
} else {
	echo "Number of results: " . $genre2NumRows . "\n\n";

	while ($records = mysqli_fetch_array($genre2Results)){
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
		
		echo "SFX ID: $sfx_id \t CD: $cd_name \t CD Track: $cd_track \t CD Track Index: $cd_track_index \n";
		echo "Title: $title \n";
		echo "Genres: $genre1 \t $genre2 \t $genre3 \n";
		echo "Description: $description \n";
		echo "Length: $length \t Location: /$location \n\n";
	}
}

$genre3Results = mysqli_query($mysqli, "SELECT * FROM sfx WHERE genre3 LIKE '%$searchText%';");
$genre3NumRows = mysqli_num_rows($genre3Results);

echo "--------------------GENRE 3 RESULTS--------------------\n";

if ($genre3NumRows < 1) {
	echo "No results found.\n\n";
} else {
	echo "Number of results: " . $genre3NumRows . "\n\n";

	while ($records = mysqli_fetch_array($genre3Results)){
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
		
		echo "SFX ID: $sfx_id \t CD: $cd_name \t CD Track: $cd_track \t CD Track Index: $cd_track_index \n";
		echo "Title: $title \n";
		echo "Genres: $genre1 \t $genre2 \t $genre3 \n";
		echo "Description: $description \n";
		echo "Length: $length \t Location: /$location \n\n";
	}
}

$descriptionResults = mysqli_query($mysqli, "SELECT * FROM sfx WHERE description LIKE '%$searchText%';");
$descriptionNumRows = mysqli_num_rows($descriptionResults);

echo "--------------------DESCRIPTION RESULTS--------------------\n";

searchResults($descriptionNumRows, $descriptionResults);
/*
if ($descriptionNumRows < 1) {
	echo "No results found.\n\n";
} else {
	echo "Number of results: " . $descriptionNumRows . "\n\n";

	while ($records = mysqli_fetch_array($descriptionResults)){
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
		
		echo "SFX ID: $sfx_id \t CD: $cd_name \t CD Track: $cd_track \t CD Track Index: $cd_track_index \n";
		echo "Title: $title \n";
		echo "Genres: $genre1 \t $genre2 \t $genre3 \n";
		echo "Description: $description \n";
		echo "Length: $length \t Location: /$location \n\n";
	}
}*/
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

                echo "SFX ID: $sfx_id \t CD: $cd_name \t CD Track: $cd_track \t CD Track Index: $cd_track_index \n";
                echo "Title: $title \n";
                echo "Genres: $genre1 \t $genre2 \t $genre3 \n";
                echo "Description: $description \n";
                echo "Length: $length \t Location: /$location \n\n";
        }
}
?>
