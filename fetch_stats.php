<?php

define('DB_USER', 'dbTest');
define('DB_PASSWORD', 'testing321');
define('DB_HOST', 'localhost');
define('DB_NAME', 'bandcamp_db');

function getAllStats()
{
    // Fetch all stats from notables table and put in assoc array
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
    $conn = new PDO($dsn, DB_USER, DB_PASSWORD) or die("Could not connect to DB!");
    $q = "SELECT * FROM `notables_tab` ORDER BY `date`";

    $stmt = $conn->prepare($q);
    $stmt->execute();

    $all_stats = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($all_stats, $row);
    }

    return $all_stats;
}



?>