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
            <!-- Report Goes Here -->
                <div class="report-chart">
                    <canvas id="myChart"></canvas>
                </div>
        </div>

    </body>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script type="text/javascript" src="static/js/bc_charts.js"></script>
</html>

