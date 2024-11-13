<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTA PW_JH</title>
    <link rel="stylesheet" href="styles.css"> <!-- Optional for styling -->
</head>

<body>
    <h1>Database</h1>
    <h2>Customer List:</h2>

    <?php
    // Include the database connection file
    require 'db.php';

    // Query the database
    $sql = "SELECT Cname, Street, City, StateAB, ZipCode FROM customer";
    $result = mysqli_query($connection, $sql);

    // Check if there are results
    if (mysqli_num_rows($result) > 0) {
        // Display data in a table
        echo "<table border='1'>";
        echo "<tr><th>Name</th><th>Street</th><th>City</th><th>State</th><th>ZipCode</th></tr>";

        // Fetch and display each row of data
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['Cname']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Street']) . "</td>";
            echo "<td>" . htmlspecialchars($row['City']) . "</td>";
            echo "<td>" . htmlspecialchars($row['StateAB']) . "</td>";
            echo "<td>" . htmlspecialchars($row['ZipCode']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No records found.</p>";
    }

    // Close the connection
    mysqli_close($connection);
    ?>
</body>

</html>