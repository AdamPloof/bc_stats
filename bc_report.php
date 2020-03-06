<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bandcamp Notables Report</title>

    <?php require_once "fetch_stats.php";?>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="static/styles.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">BC Notables Report</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
        </ul>
    </div>
    </nav>
    <!-- End Navbar -->

    <div class="container">
        <!-- Report Goes Here -->
        <div class="report">
            <table class="table table-sm table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Date</th>
                    <th scope="col">Title</th>
                    <th scope="col">Artist</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Location</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Currency</th>
                    <th scope="col">Has Label?</th>
                    <th scope="col">Label</th>
                    </tr>
                </thead>
                <tbody>
<?php
$all_stats = getAllStats();

foreach($all_stats as $row) {
    $id = $row["id"];
    $date = $row["date"];
    $title = $row["title"];
    $artist = $row["artist"];
    $genre = $row["genre"];
    $loc = $row["location"];
    $amount = $row["amount"];
    $currency = $row["currency"];
    $has_label = $row["has_label"];
    $label = $row["label"];
    $link = $row["link"];

    echo "<tr>
            <th scope='row'>$id</th>
                <td>$date</td>
                <td><a class='album-link' href='$link'>$title</a></td>
                <td>$artist</td>
                <td>$genre</td>
                <td>$loc</td>
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
    </div>

</body>
</html>