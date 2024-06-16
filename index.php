<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My First PHP Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-image: url('cvsu.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: white;
            text-align: center;
        }

        .container {
            margin-top: 50px;
        }

        h2 {
            margin-bottom: 30px;
        }

        .btn-container {
            margin-bottom: 30px;
        }

        .btn-primary {
            margin: 5px;
        }

        table {
            width: 85%;
            margin: 0 auto;
            background-color: rgba(0, 0, 0, 0.7);
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #333;
        }

        tr:hover {
            background-color: #555;
        }

        td {
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>My PHP Website</h2>
        <div class="btn-container">
            <a href="login.php" class="btn btn-primary">Login Here</a>
        </div>
        <h2>My List</h2>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Details</th>
                    <th>Post Time</th>
                    <th>Edit Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username_db = "root";
                $password_db = "";
                $db_name = "first_db";

                $conn = mysqli_connect($servername, $username_db, $password_db, $db_name);

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $query = mysqli_query($conn, "SELECT * FROM list_tbl WHERE public = 'yes'");

                while ($row = mysqli_fetch_array($query)) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['details']}</td>";
                    echo "<td>{$row['date_posted']} - {$row['time_posted']}</td>";
                    echo "<td>{$row['date_edited']} - {$row['time_edited']}</td>";
                    echo "</tr>";
                }

                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzOg+Amz7wi8BWfpHUz5VFLRHBTGqXg1A75W8PraGFIg" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-A3i+XmB01DkfkJA0Qq4ZwJ1FUZoNf2tbL5fDpH8fF1l78LMlxRzV4SbVOxr7B2lb" crossorigin="anonymous"></script>
</body>
</html>
