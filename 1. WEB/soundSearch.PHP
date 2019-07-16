<?php
/*
 *  Cleveland State University
 *  School of Film & Media Arts
 *
 *  Sound Library Search Tool
 *
 *  soundSearch.php
 *
 *  verison 0.3.2
 *  16 July 2019
 *  Zachary Kascak & Ryan Kraynak
 */

// Required Scripts
require "config.php";

// Variable Declaration
$displayBlock = "";
$searchText = $_POST['searchText'];
$regSearch = $_POST['regSearch'];
$luckySearch = $_POST['luckySearch'];

// Establish connection to MySQL
/*if (mysqli_connect_errno()) 
{
    $displayBlock .= "could not connect to server error number;" .mysqli_connect_errno();
    mysqli_close($mysqli);
}
else 
{
    $displayBlock .= "connected to server" . mysqli_connect() . "<br>";
}*/

// Case Switch for Regular or Lucky
if ($regSearch == 1) 
{
    $displayBlock .= "
    <br />
    <br />
    Keyword: " . $searchText . "
    <br />";

    // Query and display results
    $genre1SelectResults = mysqli_query($mysqli, "SELECT * FROM sound_library.sfx WHERE genre1 LIKE '%$searchText%';");
    $genre1SelectNumRows = mysqli_num_rows($genre1SelectResults);
    $displayBlock .= "
    <h3>Genre 1 Results:</h3>" . searchResults($genre1SelectNumRows, $genre1SelectResults);
    $genre2SelectResults = mysqli_query($mysqli, "SELECT * FROM sound_library.sfx WHERE genre2 LIKE '%$searchText%';");
    $genre2SelectNumRows = mysqli_num_rows($genre2SelectResults);
    $displayBlock .= "
    <br />
    <br />
    <h3>Genre 2 Results:</h3>" . searchResults($genre2SelectNumRows, $genre2SelectResults);
    $genre3SelectResults = mysqli_query($mysqli, "SELECT * FROM sound_library.sfx WHERE genre3 LIKE '%$searchText%';");
    $genre3SelectNumRows = mysqli_num_rows($genre3SelectResults);
    $displayBlock .= "
    <br />
    <br />
    <h3>Genre 3 Results:</h3>" . searchResults($genre3SelectNumRows, $genre3SelectResults);
    $descriptionSelectResults = mysqli_query($mysqli, "SELECT * FROM sound_library.sfx WHERE description LIKE '%$searchText%';");
    $descriptionSelectNumRows = mysqli_num_rows($descriptionSelectResults);
    $displayBlock .= "
    <br />
    <br />
    <h3>Description Results:</h3>" . searchResults($descriptionSelectNumRows, $descriptionSelectResults);
} 
else 
{
    $displayBlock .= "ERROR";
}

// Functions
function searchResults($numOfRows, $searchResults)
{
    // Declare function variables
    $searchResultBlock = "";

    //Test number of rows
    if ($numOfRows < 1)
    {
        $searchResultBlock .= "
        No Results Found
        <br />";
        return $searchResultBlock;
    }
    else
    {
        $searchResultBlock .= "
        <table>";

        while ($records = mysqli_fetch_array($searchResults)) 
        {
            $searchResultBlock .= "
            <tr height=\"15\">
            </tr>
            <tr>
              <td><b>SFX ID: </b></td><td>" . $records['sfx_id'] . "</td><td><b>CD Name:</b></td><td>" . $records['cd_name'] . "</td><td><b>Track:</b></td><td>" . $records['cd_track'] . "</td><td><b>Track Index:</b></td><td>" . $records['cd_track_index'] . "</td><td></td>
            </tr>
            <tr>
              <td><b>Genre 1: </b></td><td colspan=\"2\">" . $records['genre1'] . "</td><td><b>Genre 2: </b></td><td colspan=\"2\">" . $records['genre2'] . "</td><td><b>Genre 3: </b></td><td colspan=\"2\">" . $records['genre3'] . "</td>
            </tr>
            <tr>
              <td><b>Description: </b></td><td colspan=\"8\">" . $records['description'] . "</td>
            </tr>
            <tr>
              <td><b>Location: </b></td><td colspan=\"8\">" . $records['location'] . "</td>
            </tr>";
        }

        $searchResultBlock .= "
        </table>";

        return $searchResultBlock;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>FMA Sound Library</title>
    </head>
    <body>
        <h1 style="text-align: center">FMA Sound Library</h1>
        <form action="soundSearch.php" method="post">
            <input type="text" name="searchText" placeholder="what do you want to hear?">
            <button type="submit" name="regSearch" value="1">Submit</button>
            <!--<button type="submit" name="luckySearch" value="1">I'm feeling lucky</  button>-->
        </form>
        <h2>Your Search Results</h2>
        <?php
            echo $displayBlock;
        ?>
    </body>
</html>