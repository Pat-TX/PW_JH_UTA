<!-- 

Patrick Williams, ID: 1002030029
Jeff Hernandez, ID: 1002162250

-->

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
                    <a class="nav-link" href="insert.php">Question 2</a>
                    <a class="nav-link" href="update.php">Question 3</a>
                    <a class="nav-link active" href="delete.php">Question 4</a>
                </div>
            </div>
        </div>
    </nav>
</div>

<br />

<div class="container">
    <p>
        Question 4: Delete the item record for "Organic Fresh Broccoli" that you just added using the web interface you created.
    </p>

    <br />

    <form method="POST" action="delete.php">
        <div class="row">
            <div class="col-sm-2">
                <label for="name" class="col-form-label">Item Name to be Deleted:</label>
            </div>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="dname" name="dname" placeholder="Item Name"><br><br>
            </div>
        </div>

        <div class="row text-center">
            <div class="d-grid mb-3">

                <button type="submit" class="btn btn-primary" name="submit">Delete Item</button>

            </div>
        </div>

    </form>

    <?php
    require 'db.php';

    $sql = "SELECT iId, Iname, Sprice, Idescription FROM item";

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) 
    {
        $dname = trim($_POST['dname']);

        if (empty($dname)) 
        {
            echo "<div class='alert alert-danger' role='alert'>
                Please enter the item name to be deleted!
              </div>";
        } 
        else 
        {
            $check_sql = "SELECT Iname FROM item WHERE Iname = ?";
            $check_stmt = mysqli_prepare($connection, $check_sql);
            mysqli_stmt_bind_param($check_stmt, "s", $dname);
            mysqli_stmt_execute($check_stmt);
            mysqli_stmt_store_result($check_stmt);

            if (mysqli_stmt_num_rows($check_stmt) == 0) 
            {
                echo "<div class='alert alert-danger' role='alert'>
                        Item '$dname' not found in the database. Please check the name and try again.
                      </div>";
            } 
            else 
            {
                $sql = "DELETE FROM item WHERE Iname = ?";
                $stmt = mysqli_prepare($connection, $sql);
                mysqli_stmt_bind_param($stmt, "s", $dname);

                if (mysqli_stmt_execute($stmt)) 
                {
                    echo "<div class='alert alert-success' role='alert'>Item deleted successfully!</div>";
                } 
                else 
                {
                    echo "<div class='alert alert-danger' role='alert'>Error: Could not delete data in the database.</div>";
                }
            }
        }
    }

    $sql = "SELECT iId, Iname, Sprice, Idescription FROM item";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) 
    {
        echo "<table class='table table-striped table-hover'>";
        echo "<tr><th scope='col'>Item ID</th><th scope='col'>Item Name</th><th scope='col'>Price</th><th scope='col'>Description</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) 
        {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['iId']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Iname']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Sprice']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Idescription']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } 
    else 
    {
        echo "<div class='alert alert-info' role='alert'>
                No results found.
              </div>";
    }

    mysqli_close($connection);
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>