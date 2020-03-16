<?php

require_once "fetch_stats.php";
require_once "table_content.php";

$stats = new StatsFetcher;

if (isset($_REQUEST['tbl'])) {
    if ($_REQUEST['tbl'] == "genre") {
        $genres = $stats->fetchStats('sum_by_genre');
        echo getGenreTable($genres);
    } elseif ($_REQUEST['tbl'] == "tracks") {
        $tracks = $stats->fetchStats('select_all');
        echo getTracksTable($tracks);
    }
}