<?php
/*
 *  Cleveland State University
 *  School of Film and Media Arts
 *
 *  Sound Library Search Tool
 *
 *  index.php
 *
 *  verison 0.3.0
 *  14 June 2019
 *  Ryan Kraynak
 */

//--- Establish Connection ---
require 'config.php';

$displayBlock = "version 1
<br>
<br>";

if (mysqli_connect_errno()) {
    $displayBlock .= "could not connect to server error number;" .mysqli_connect_errno();
} else {
    echo "CONNECTED\n";
    $displayBlock .= "connected to server" . mysqli_connect() . "<br>";
}


// Variable Declarations
$regSearch = $_POST["regSearch"];
$luckySearch = $_POST["luckySearch"];
$searchText = $_POST["searchText"];

// Choose regular or lucky search      
if ($regSearch == 1) {
    $displayBlock .= "
    <br>
    <br>
    Keyword: " . $searchText . "
    <br>
    <br>
    <table>";
    
    $genre1Query = "SELECT * FROM sound_library.sfx WHERE genre1 LIKE ('".$searchText."')";
    $genre1Results = mysqli_query($mysqli, $genre1Query);
    /*
    $genre1Results = mysqli_query($mysqli, "SELECT * FROM sfx WHERE genre1 LIKE '%$searchText%';");*/
    $genre1NumRows = mysqli_num_rows($genre1Results);
    $displayBlock .= searchResults($genre1NumRows, $genre1Results);
    $genre2Results = mysqli_query($mysqli, "SELECT * FROM sfx WHERE genre2 LIKE '%$searchText%';");
    $displayBlock .= searchResults($genre2NumRows, $genre2Results);
    $genre3Results = mysqli_query($mysqli, "SELECT * FROM sfx WHERE genre3 LIKE '%$searchText%';");
    $displayBlock .= searchResults($genre3NumRows, $genre3Results);
} else {
    $displayBlock .= "Error";
}

function searchResults($numOfRows, $searchResults){
    $searchResultBlock = "";

    if ($numOfRows < 1) {
        $searchResultBlock .= "
        <tr>
            <td>No results found</td>
        </tr>";
        return $searchResultBlock;
    } else {
        echo "Number of results:" . $numOfRows . "\n\n";
        //Our Pulls
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

            $resultFormatingBlock =
            " <tr>
                <td>".$sfx_id."</td>
                <td>".$cd_name."</td>
                <td>".$cd_track."</td>
                <td>".$cd_track_index."</td>
              </tr>
              <tr>
                <td>".$genre1."</td>
                <td>".$genre2."</td>
                <td>".$genre3."</td>
              </tr>
              <tr>
                <td>".$description."</td>
              </tr>
              <tr>
                <td>".$length."</td>
                <td>".$location."</td>
              </tr>";
        
            $searchResultBlock .= $resultFormatingBlock;
        }

        return $searchResultBlock;
    }
}

?>
<!DOCTYPE html>
    <title>CSUFMAsoundSearch</title>
        <html>
        <head>
        </head>
    <body>
        <form action="soundSearch.php" method="post">
            <input type="text" name="searchText" placeholder="what do you want to hear?">
            <button type="submit" name="regSearch" value="1">Submit</button>
            <!--<button type="submit" name="luckySearch" value="1">I'm feeling lucky</button>-->
        </form>
        <h1>Your Search Results</h1>
        <?php
        echo $displayBlock;
        ?>
    </body>
</html>
