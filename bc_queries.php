<?php
// Various queries for retrieving bandcamp data

$query_set = array(
    "select_all" => "SELECT * FROM `notables_tab`
        WHERE `date` BETWEEN :start_date AND :end_date
        ORDER BY `date`",

    "sum_by_date" => "SELECT `date`, SUM(amount) AS 'total', COUNT(id) AS 'count'
        FROM `notables_tab`
        WHERE `date` BETWEEN :start_date AND :end_date
        GROUP BY `date`",

    "sum_by_genre" => "SELECT `genre`, SUM(amount) AS 'total', COUNT(id) AS 'count'
    FROM `notables_tab`
    WHERE `date` BETWEEN :start_date AND :end_date
    GROUP BY `genre`",

    "genre_count" => "SELECT genre, COUNT(id) AS 'count'
        FROM `notables_tab`
        WHERE `date` BETWEEN :start_date AND :end_date
        GROUP BY genre"
    );