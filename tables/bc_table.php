<div class="report">
    <table class="table table-sm table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Date</th>
                <th scope="col">Title</th>
                <th scope="col">Artist</th>
                <th scope="col">Genre</th>
                <th scope="col">Location</th>
                <th scope="col">Track Count</th>
                <th scope="col">Amount</th>
                <th scope="col">Currency</th>
                <th scope="col">Has Label?</th>
                <th scope="col">Label</th>
                </tr>
            </thead>
        <tbody>

    <?php

    $stats = new StatsFetcher;
    $all_stats = $stats->fetchStats('select_all');

    foreach($all_stats as $row) {
        $date = $row["date"];
        $title = $row["title"];
        $artist = $row["artist"];
        $genre = $row["genre"];
        $loc = $row["location"];
        $track_count = $row["track_count"];
        $amount = $row["amount"];
        $currency = $row["currency"];
        $has_label = $row["has_label"];
        $label = $row["label"];
        $link = $row["link"];

        echo "<tr>
                    <td>$date</td>
                    <td><a class='album-link' href='$link'>$title</a></td>
                    <td>$artist</td>
                    <td>$genre</td>
                    <td>$loc</td>
                    <td>$track_count</td>
                    <td>$amount</td>
                    <td>$currency</td>
                    <td>$has_label</td>
                    <td>$label</td>
                </tr>";
    }

    ?>
        </tbody>
    </table>
</div>