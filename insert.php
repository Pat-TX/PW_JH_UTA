<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTA PW_JH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<div class="container">
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="#">CSE 3330 Project Phase 3</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="index.php">Question 1</a>
                    <a class="nav-link active" href="insert.php">Question 2</a>
                    <a class="nav-link" href="update.php">Question 3</a>
                    <a class="nav-link" href="delete.php">Question 4</a>
                </div>
            </div>
        </div>
    </nav>
</div>

<br />

<div class="container">
    <p>
        Question 2: Insert a new item "Frozen Broccoli" in the database using the web interface you created.
    </p>

    <br />

    <form method="GET" action="insert.php">
        <div class="row g-3">
            <div class="col-sm">
                <input type="text" class="form-control" placeholder="ID" id="iid" name="iid">
            </div>
            <div class="col-sm-2">
                <input type="text" class="form-control" placeholder="Item Name" id="iname" name="iname">
            </div>
            <div class="col-sm-2">
                <input type="text" class="form-control" placeholder="Price" id="iprice" name="iprice">
            </div>
            <div class="col-sm-7">
                <input type="text" class="form-control" placeholder="Description" id="idesc" name="idesc">
            </div>
        </div>

        <br />

        <div class="row text-center">
            <div class="d-grid mb-3">

                <button type="submit" class="btn btn-primary" name="submit">Add Item to Table</button>

            </div>
        </div>

    </form>

    <?php
    // Include the database connection file
    require 'db.php';

    $sql = "SELECT iId, Iname, Sprice, Idescription FROM item";

    if (isset($_GET['submit'])) {
        $iname = trim($_GET['iname']);
        $iid = trim($_GET['iid']);
        $iprice = trim($_GET['iprice']);
        $idesc = trim($_GET['idesc']);

        if (empty($iname) || empty($iid) || empty($iprice) || empty($idesc)) {
            echo "<div class='alert alert-danger' role='alert'>
                Please fill out all data fields!
              </div>";
        }
    }

    // Query the database
    $result = mysqli_query($connection, $sql);

    // Check if there are results
    if (mysqli_num_rows($result) > 0) {
        // Display data in a table
        echo "<table class='table table-striped table-hover'>";
        echo "<tr><th scope='col'>Item ID</th><th scope='col'>Item Name</th><th scope='col'>Price</th><th scope='col'>Description</th></tr>";

        // Fetch and display each row of data
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['iId']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Iname']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Sprice']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Idescription']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<div class='alert alert-info' role='alert'>
                No results found.
              </div>";
    }

    // Close the connection
    mysqli_close($connection);
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>