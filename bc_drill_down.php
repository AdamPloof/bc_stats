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

    <!-- Filter Nav -->
    <nav class="filter-nav d-flex justify-content-around">
        <form class="form-inline">                      
            <div class="form-group row">
                <span class="dd-label"><small>Store</small></span>
                <div class="col drill-input">
                    <input type="text" class="form-control form-control-sm" id="store-input" placeholder="Store">
                </div>
                <span class="dd-label"><small>From</small></span>
                <div class="col-3 drill-input">
                    <input type="text" class="form-control form-control-sm" id="date1-input" placeholder="Start date">
                </div>
                <span class="dd-label"><small>To</small></span>
                <div class="col-3 drill-input">
                    <input type="text" class="form-control form-control-sm" id="date2-input" placeholder="End date">
                </div>
            </div>
        </form>
    </nav>

    <?php
        $stats = new StatsFetcher;
        $dates = $stats->sumByDate();
    ?>

    <div id="report_container" class="container">
        <!-- Report Goes Here -->
        <div class="drill-down">
            <div class="drill-col dates-sidebar">
                <div class="list-group">
                    <?php
                        foreach ($dates as $row) {
                            $date = $row["date"];
                            $total = $row["total"];
                            $count = $row['count'];

                            echo "
                                    <a href='#' class='list-group-item list-group-item-action'>
                                        <div class='d-flex w-100 justify-content-between'>
                                            <h5 class='mb-1'>$date</h5>
                                            <small>$count albums</small>
                                        </div>
                                        <p class='mb-1'>$total</p>
                                </a>
                            ";
                        }
                    ?>
                </div>
            </div>
            <div class="drill-col drill-output">
                <div class="genre-col">
                    <p>By Genre</p>
                </div>
                <div class="album-col">
                    <p>Albums</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>