<?php
/*
 *  Cleveland State University
 *  School of Film and Media Arts
 *
 *  Sound Library Search Tool
 *
 *  index.php
 *
 *  verison 0.3.1
 *  24 June 2019
 *  Ryan Kraynak & Zachary Kascak
 */

/*--- Establish Connection ---*/
    require 'config.php';

    if (mysqli_connect_errno()) {
        $displayBlock = "could not connect to server error number;" . mysqli_connect_errno();

        exit();
    } else {
        echo "CONNECTED\n";
        $displayBlock = "connected to server" . mysqli_connect() . "<br>";
    }

/*function searchResults($numOfRows, $searchResults){
    if ($numOfRows < 1) {
        echo "No results found.\n\n";
    } else {
        echo "Number of results:" . $numOfRows . "\n\n";
                    while ($records = mysqli_fetch_array($searchResults)){
                        //Our Pulls
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

                        //Our Display block
                        echo "Title: $title \n";
                        echo "SFX ID: $sfx_id \t CD: $cd_name \t CD Track: $cd_track \t CD Track Index: $cd_track_index \n";
                        echo "Genres: $genre1 \t $genre2 \t $genre3 \n";
                        echo "Description: $description \n";
                        echo "Length: $length \t Location: /$location \n\n";
                    }
            }
        }
    }*/


?>
<!DOCTYPE html>
    <title>CSUFMAsoundSearch</title>
        <html>
        <head>
        </head>
    <body>
        <form action="soundsearch.php" method="post">
            <input type="text" name="searchText" placeholder="what do you want to hear?">
            <input type="submit" name="regSearch">
            <button type="$submit" name="luckySearch">I'm feeling lucky</button>
        </form>
        <h1>Your Search Results</h1>
        <?php echo $displayBlock ?>
    </body>
</html>
