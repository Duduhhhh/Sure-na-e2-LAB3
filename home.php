<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-image: url('cvsu.png');
            background-size: cover;
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .content {
            text-align: center;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            border: 2px solid white; /* Added border */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid white;
            padding: 8px;
            color: white;
        }

        th {
            background-color: #007bff;
        }

        td {
            background-color: #333;
        }

        .btn {
            border-radius: 20px;
            margin-top: 10px;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #c82333;
            transform: scale(1.1);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <a href="logout.php" class="btn btn-danger logout-btn">LOGOUT</a>
    <div class="content">
        <h2>Home Page</h2>
        <?php 
            session_start();
            if(isset($_SESSION['user'])) {
                $user = $_SESSION['user'];
                echo "<p>Welcome back, $user!</p>";
            } else {
                header("location: index.php");
            }
        ?>
        <br><br>
        <form action="add.php" method="POST">
            <label for="details">Add more:</label>
            <input type="text" name="details" id="details" required>
            <br>
            <input type="checkbox" name="public[]" id="public" value="yes">
            <label for="public">Public post</label>
            <br>
            <input type="submit" value="Add to list" class="btn btn-primary">
        </form>
        <br><br>
        <h2>My list</h2>
        <table>
            <tr>
                <th>Id</th>
                <th>Details</th>
                <th>Post Time</th>
                <th>Edit Time</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Public Post</th>
            </tr>
            <?php
            $servername = "localhost";
            $username_db = "root";
            $password_db = "";
            $db_name = "first_db";
            
            $conn = mysqli_connect($servername, $username_db, $password_db, $db_name);
            
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            
            $query = mysqli_query($conn, "SELECT * FROM list_tbl");
            
            while($row = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['details']."</td>";
                echo "<td>".$row['date_posted']." - ".$row['time_posted']."</td>";
                echo "<td>".$row['date_edited']." - ".$row['time_edited']."</td>";
                echo "<td><a href='edit.php?id=".$row['id']."'>edit</a></td>";
                echo "<td><a href='#' onclick='myFunction(".$row['id'].")'>delete</a></td>";
                echo "<td>".$row['public']."</td>";
                echo "</tr>";
            }
            mysqli_close($conn);
            ?>
        </table>
        <script>
            function myFunction(id) {
                var r = confirm("Are you sure you want to delete this record?");
                if (r == true) {
                    window.location.assign("delete.php?id=" + id);
                }
            }
        </script>
    </div>
</body>
</html>
