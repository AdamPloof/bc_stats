<?php

class StatsFetcher
{
    const DB_USER = 'dbTest';
    const DB_PASSWORD = 'testing321';
    const DB_HOST = 'localhost';
    const DB_NAME = 'bandcamp_db';

    public function __construct()
    {
        require_once "bc_queries.php";
        $dsn = "mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME;
        $this->conn = new PDO($dsn, self::DB_USER, self::DB_PASSWORD) or die("Could not connect to DB!");

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

    public function getJsonData()
    {
        // Return all stats as json
        $all_data = $this->fetchStats('select_all');
        return json_encode($all_data);
    }
}



?>