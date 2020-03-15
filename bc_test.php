<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bandcamp Notables Report</title>

        <?php require_once "fetch_stats.php";?>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="static/css/styles.css">
    </head>
    <body>

        <!-- Navbar -->
            <?php require_once "bc_nav.php" ?>
        <!-- End Navbar -->

        <div id="report_container" class="container">
            <?php
                $stats = new StatsFetcher;
                $genres = $stats->getGenreCount();

                foreach($genres as $row) {
                    echo $row['genre'] . " " . $row['count'] . "<br>";
                }
            ?>
        </div>
        <br>
        <div class="container">
            <button type="button" id="clicker" class="btn btn-info">Load Table</button>
            <div class="report">
                <table class="table table-sm table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Artist</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Date</th>
                        <th scope="col">Location</th>
                        <th scope="col">Track Count</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Currency</th>
                        <th scope="col">Has Label?</th>
                        <th scope="col">Label</th>
                        </tr>
                    </thead>
                    <tbody id="test-body">
                        <!-- Content will be loaded via ajax -->
                    </tbody>
                </table>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <script type="text/javascript" src="static/js/test.js"></script>
    </body>
</html>

