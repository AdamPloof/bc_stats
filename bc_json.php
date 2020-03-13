<?php

require_once "fetch_stats.php";

$stats = new StatsFetcher;

echo $stats->getJsonData();