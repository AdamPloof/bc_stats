<?php

define('DB_USER', 'dbTest');
define('DB_PASSWORD', 'testing321');
define('DB_HOST', 'localhost');
define('DB_NAME', 'bandcamp_db');

class StatsFetcher
{
    public function __construct()
    {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
        $this->conn = new PDO($dsn, DB_USER, DB_PASSWORD) or die("Could not connect to DB!");
    }

    public function getAllStats()
    {
        // Fetch all stats from notables table and put in assoc array
        $q = "SELECT * FROM `notables_tab` ORDER BY `date`";

        $stmt = $this->conn->prepare($q);
        $stmt->execute();

        $all_stats = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($all_stats, $row);
        }

        return $all_stats;
    }

    // The following functions return JSON strings to be parsed by javascript

    public function getGenreCount()
    {
        // Fetch the tally of genres for specified date range
        $q = "SELECT genre, COUNT(id) AS 'count'
            FROM `notables_tab`
            WHERE `date` BETWEEN :st_date AND :en_date
            GROUP BY genre";

        $start_date = '2020-01-01';
        $end_date = '2020-12-31';

        $stmt = $this->conn->prepare($q);
        $stmt->bindParam(':st_date', $start_date);
        $stmt->bindParam(':en_date', $end_date);
        $stmt->execute();

        $all_stats = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($all_stats, $row);
        }

        return $all_stats;
    }

    public function getJsonData()
    {
        // Return all stats as json
        $all_data = $this->getAllStats();
        return json_encode($all_data);
    }
}



?>