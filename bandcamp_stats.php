<?php

require_once 'stats_manager.php';

define('DB_USER', 'dbTest');
define('DB_PASSWORD', 'testing321');
define('DB_HOST', 'localhost');
define('DB_NAME', 'bandcamp_db');

$dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
$conn = new PDO($dsn, DB_USER, DB_PASSWORD);

$stats = new StatsManager();

// Get a list of all title/artist pairs in the db
$sel = "SELECT `title`, `artist` FROM `notables_tab`";
$current_stats = getCurrentStats($conn, $sel);

$q = "INSERT INTO notables_tab (
        id, 
        title, 
        artist, 
        genre, 
        link, 
        `date`, 
        `location`,
        track_count,
        amount,
        currency,
        has_label,
        label) 
    VALUES (
        Null, 
        :title, 
        :artist, 
        :genre, 
        :link, 
        :date, 
        :location,
        :track_count,
        :amount,
        :currency,
        :has_label,
        :label)";

// Insert each line of CSV into the DB
$csvFile = './bc_stats/bc_notable_2020-03-07.csv';

if (($f = fopen($csvFile, "r")) !== FALSE) {
    $row = 1;
    while (($data = fgetcsv($f, 0, ",")) !== FALSE) {
        if ($row > 1) {
            try {
                $stats->gatherStats($data);
                if (!checkDups($current_stats, $stats->tbl_def)) {
                    $stmt = $conn->prepare($q, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                    $stmt->execute($stats->tbl_def);

                    $title = $stats->tbl_def[":title"];
                    echo "Inserted $title into DB <br>";
                } else {
                    echo "Insert aborted! <br>";
                }
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
        $row++;
    }
    fclose($f);
}


function getCurrentStats($conn, $q)
{
    // Fetch the titles and artists currently in the table to prevent dups
    $stmt = $conn->prepare($q);
    $stmt->execute();
    $current_stats = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $entry = array("title" => $row["title"], "artist" => $row["artist"]);
        array_push($current_stats, $entry);
    }

    return $current_stats;
}


function checkDups($current_stats, $row)
{
    // Verify that the row to be inserted doesn't already exist in the DB
    // Return True if duplicate is found
    $title_to_add = $row[":title"];
    $artist_to_add = $row[":artist"];

    foreach ($current_stats as $album) {
        if (in_array($title_to_add, $album) and in_array($artist_to_add, $album)) {
            // duplicate found; return true
            echo "<i>$title_to_add</i> by 
            <strong>$artist_to_add</strong> already exists in DB <br>";

            return True;
        }
    }

    return False;
}

?>