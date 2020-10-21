<?php
// enter new user in database

// Turn off default error reporting
error_reporting(0);

// allow MySQLi error reporting and Exception handling
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    //use Exception Handling for empty form fields
    if (empty($_POST['name']) or empty($_POST['password'])) throw new Exception("form fields not filled in");
    
    $name = $_POST['name'];
    $password = $_POST['password'];

        // Connect to MySQL, select database
        require ("model/database.php");

        // test name for HTML characters to avoid HTML Injection
        require ("TestInput.php");
        //$name = test_input($name);
        //$password = test_input($password);

        // Perform SQL query
        $query = "INSERT INTO Login VALUES('$name', '$password', 'Student', 6, now());";

        mysqli_query($con, $query);
    
} catch (Exception $e) {
    $message = $e->getMessage();
    $code = $e->getCode();
    header("Location: error.php?code=$code&message=$message");
}
finally{
    // close connection
    mysqli_close($con);
}
?>

<html>
<body>
	<h2 style="text-align: center;">Welcome <?php echo $name ?></h2>
	<br>
	<br>
	<a href="index.php">Login</a>
</body>
</html>