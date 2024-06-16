<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My First PHP Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-image: url('image2.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            text-align: center;
            padding: 10px;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        td {
            background-color: #f2f2f2;
        }
        .btn-group {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .btn-group .btn {
            margin: 0 10px;
        }
        .form-inline {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .form-inline input[type="text"] {
            margin-right: 10px;
            flex: 1;
        }
        .form-check-label {
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header("location: index.php");
    }
    $user = $_SESSION['user'];
    $id_exists = false;
    ?>
    <div class="container">
        <h2>Home Page</h2>
        <div class="text-center mb-3">
            <a href="home.php" class="btn btn-primary">Return to Home Page</a>
        </div>
        <p class="text-center">Hello, <?php echo htmlspecialchars($user); ?>!</p>
        <h2>Currently Selected</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Details</th>
                    <th>Post Time</th>
                    <th>Edit Time</th>
                    <th>Public Post</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($_GET['id'])) {
                    $id = $_GET['id'];
                    $_SESSION['id'] = $id;
                    $id_exists = true;

                    $servername = "localhost";
                    $username_db = "root";
                    $password_db = "";
                    $db_name = "first_db";
                    $conn = mysqli_connect($servername, $username_db, $password_db, $db_name);
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    $query = mysqli_query($conn, "SELECT * FROM list_tbl WHERE id='$id'");
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_array($query)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['details']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['date_posted'] . " - " . $row['time_posted']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['date_edited'] . " - " . $row['time_edited']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['public']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        $id_exists = false;
                    }
                }
                ?>
            </tbody>
        </table>
        <br/>
        <?php
        if ($id_exists) {
            echo '
            <div class="d-flex justify-content-center">
                <form action="edit.php" method="POST" class="w-50">
                    <div class="mb-3">
                        <label for="details" class="form-label">Enter new detail:</label>
                        <input type="text" name="details" class="form-control" id="details" required>
                    </div>
                    <div class="form-check form-switch mb-3 text-center">
                        <input class="form-check-input" type="checkbox" name="public[]" value="yes" id="publicSwitch">
                        <label class="form-check-label" for="publicSwitch">Public Post?</label>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Update List</button>
                    </div>
                </form>
            </div>';
        } else {
            echo '<h3 class="text-center">There is no data to be edited.</h3>';
        }
        ?>
    </div>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $db_name = "first_db";
    $conn = mysqli_connect($servername, $username_db, $password_db, $db_name);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $public = "no";
    $id = $_SESSION['id'];
    $time = strftime("%X");
    $date = strftime("%B %d, %Y");

    if (!empty($_POST['public'])) {
        $public = "yes";
    }

    $updateQuery = "UPDATE list_tbl SET details='$details', public='$public', date_edited='$date', time_edited='$time' WHERE id='$id'";
    mysqli_query($conn, $updateQuery);
    header("location: home.php");
}
?>
