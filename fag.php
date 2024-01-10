<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    sty
</head>
<body>
    <div class="container mt-5">
        <h1>Frequently Asked Questions</h1>
        <div id="accordion">
            <?php
            include'db_connect.php';

            // SQL query to fetch FAQ data from the database
            $sql = "SELECT * FROM faq";
            $result = $conn->query($sql);

            // Generate FAQ items from the fetched data
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="card">';
                    echo '<div class="card-header" id="heading' . $row["id"] . '">';
                    echo '<h5 class="mb-0">';
                    echo '<button class="btn btn-link" data-toggle="collapse" data-target="#collapse' . $row["id"] . '" aria-expanded="true" aria-controls="collapse' . $row["id"] . '">';
                    echo $row["question"];
                    echo '</button>';
                    echo '</h5>';
                    echo '</div>';
                    echo '<div id="collapse' . $row["id"] . '" class="collapse" aria-labelledby="heading' . $row["id"] . '" data-parent="#accordion">';
                    echo '<div class="card-body">';
                    echo $row["answer"];
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "No FAQ entries found.";
            }

            // Close the database connection
            $conn->close();
            ?>
        </div>
    </div>

    <!-- Add Bootstrap and jQuery JS scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
