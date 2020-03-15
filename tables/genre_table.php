<table id="drill-tracks" class="table table-striped table-hover table-sm">
    <thead>
        <tr>
            <th scope="col">Genre</th>
            <th scope="col">Album Count</th>
            <th scope="col">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
            // $stats is an instance of StatsFetcher that is instantiated in the parent template

            $genres = $stats->fetchStats('sum_by_genre');
            foreach ($genres as $row) {
                if ($row['genre'] == "") {
                    $genre = "None";
                } else {
                    $genre = $row['genre'];
                }
                $g_count = $row['count'];
                $g_total = $row['total'];
                echo "
                <tr>
                    <td>$genre</a></td>
                    <td>$g_count</td>
                    <td>$$g_total</td>
                </tr>";
            }

        ?>
    </tbody>
</table>