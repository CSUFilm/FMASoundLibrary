<?php
/*
 *  Cleveland State University
 *  School of Film and Media Arts
 * 
 *  Sound Library Search Tool
 * 
 *  soundsearch.php
 * 
 *  v0.1
 *  20 June 2018
 *  Zachary Kascak
 */

$mysqli = new mysqli("ip.address.com", "username", "password", "sound_library");

if (mysqli_connect_errno()) {
	printf("connection failed: %s\n", mysqli_connect_error());
	exit();
} else {
	echo "CONNECTED\n";
    printf("host information: %s\n\n", mysqli_get_host_info($mysqli));
    mysqli_close($mysqli);
}
