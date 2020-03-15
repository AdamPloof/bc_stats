<?php

define('DB_USER', 'dbTest');
define('DB_PASSWORD', 'testing321');
define('DB_HOST', 'localhost');
define('DB_NAME', 'bandcamp_db');

class StatsFetcher
{
    public function __construct()
    {
        require_once "bc_queries.php";
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
        $this->conn = new PDO($dsn, DB_USER, DB_PASSWORD) or die("Could not connect to DB!");

        $this->qs = $query_set;
    }

    public function fetchStats($idx)
    {
        // Execute provided query -- $q can either be a selection from
        // $report->query_set or a raw query
        if (empty($idx)) {
            die("A valid index of the query set must be provided");
        } else {
            $q = $this->qs[$idx];
        }

        if (isset($_REQUEST['start_date'])) {
            $start_date = $_REQUEST['start_date'];
        } else {
            // set date range to current year
            $start_date = '2020-01-01';
        }

        if (isset($_REQUEST['end_date'])) {
            $end_date = $_REQUEST['end_date'];
        } else {
            // set date range to current year
            $end_date = '2020-12-31';
        }

        $stmt = $this->conn->prepare($q);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':end_date', $end_date);
        $stmt->execute();

        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($results, $row);
        }

        return $results;

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
            WHERE `date` BETWEEN :start_date AND :end_date
            GROUP BY genre";

        // TOOD: make date variable based on user input
        $start_date = '2020-01-01';
        $end_date = '2020-12-31';

        $stmt = $this->conn->prepare($q);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':end_date', $end_date);
        $stmt->execute();

        $genre_count = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($genre_count, $row);
        }

        return $genre_count;
    }


    public function sumByDate()
    {
        // Sum currency by date
        $q = "SELECT `date`, SUM(amount) AS 'total', COUNT(id) AS 'count'
        FROM `notables_tab`
        WHERE `date` BETWEEN :st_date AND :en_date
        GROUP BY `date`";

        // TOOD: make date variable based on user input
        $start_date = '2020-01-01';
        $end_date = '2020-12-31';

        $stmt = $this->conn->prepare($q);
        $stmt->bindParam(':st_date', $start_date);
        $stmt->bindParam(':en_date', $end_date);
        $stmt->execute();

        $date_sum = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($date_sum, $row);
        }

        return $date_sum;
    }


    public function getJsonData()
    {
        // Return all stats as json
        $all_data = $this->getAllStats();
        return json_encode($all_data);
    }
}



?>