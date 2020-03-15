<table id="drill-tracks" class="table table-striped table-hover table-sm">
    <thead>
        <tr>
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
            // $stats is an instance of StatsFetcher that is instantiated in the parent template

            $tracks = $stats->fetchStats('select_all');
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

                echo "
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

        ?>
    </tbody>
</table>