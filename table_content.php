<?php
// A collection of functions to generate table and list content
// for the drill down page.

function getGenreTable($genres)
{
    $tbl = "";

    foreach ($genres as $row) {
        if ($row['genre'] == "") {
            $genre = "None";
        } else {
            $genre = $row['genre'];
        }
        $g_count = $row['count'];
        $g_total = $row['total'];
        
        $tbl .= "
        <tr>
            <td>$genre</a></td>
            <td>$g_count</td>
            <td>$$g_total</td>
        </tr>";
    }

    return $tbl;
}
 
function getTracksTable($tracks)
{
    $tbl = "";

    foreach ($tracks as $row) {
        $link = $row['link'];
        $title = $row['title'];
        $artist = $row['artist'];
        $genre = $row['genre'];
        $location = $row['location'];
        $track_count = $row['track_count'];
        $amount = $row['amount'];
        $currency = $row['currency'];
        $has_label = $row['has_label'];
        $label = $row['label'];

        $tbl .= "
        <tr>
            <td><a href='$link'>$title</a></td>
            <td>$artist</td>
            <td>$genre</td>
            <td>$location</td>
            <td>$track_count</td>
            <td>$amount</td>
            <td>$currency</td>
            <td>$has_label</td>
            <td>$label</td>
        </tr>";
    }

    return $tbl;
}


function getTotalsSidebar($totals)
{
    $sidebar = "";

    foreach ($totals as $row) {
        $date = $row['date'];
        $total = $row['total'];
        $count = $row['count'];

        $sidebar .= "
                <a href='#' class='list-group-item list-group-item-action' data-date='$date'>
                    <div class='d-flex w-100 justify-content-between'>
                        <h5 class='mb-1'>$date</h5>
                        <small>$count albums</small>
                    </div>
                    <p class='mb-1'>$$total</p>
            </a>
        ";
    }

    return $sidebar;
}

function getAllTable()
{
    
}


?>
