<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My First PHP Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .form-container {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form {
            max-width: 300px;
            margin: 0 auto;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .btn-back {
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            text-align: center;
            display: inline-block;
            margin-top: 10px;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .btn-back:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="form-container">
    <form action="register.php" method="POST">

        <h1>Registration</h1>

        <!-- NAME TEXTBOX -->
        <div class="form-group">
            <label for="username">Name:</label>
            <input type="text" name="username" id="username" required="required" class="form-control" placeholder="Enter Name">
        </div>

        <!-- PASSWORD TEXTBOX -->
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required="required" class="form-control" placeholder="Enter Password">
        </div>

        <!-- SUBMIT BUTTON -->
        <input type="submit" value="Register" class="btn btn-primary w-100">

        <!-- BACK BUTTON -->
        <a href="login.php" class="btn-back w-100 text-center mt-3">Back</a>

    </form>
</div>

</body>
</html>

<?php
$servername = "localhost";
$username_db = "root";
$password_db = "";
$db_name = "first_db";

// Create connection
$conn = mysqli_connect($servername, $username_db, $password_db, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $bool = true;
    $query = mysqli_query($conn, "SELECT * FROM users_tbl");

    while ($row = mysqli_fetch_array($query)) {
        $table_users = $row['username'];
        if ($username == $table_users) {
            $bool = false;
            echo '<script>alert("Username is not available!");</script>';
            echo '<script>window.location.assign("login.php");</script>';
        }
    }

    if ($bool) {
        mysqli_query($conn, "INSERT INTO users_tbl (username, password) VALUES ('$username', '$password')");
        echo '<script>alert("Successfully Registered");</script>';
        echo '<script>window.location.assign("login.php");</script>';
    }
}
?>
