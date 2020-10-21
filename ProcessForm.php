<?php
// get values sent from browser and test that both are filled in.
// If not, redirect to error.php
if (! empty($_POST['name']) and ! empty($_POST['password'])) {
    
    $name = $_POST['name'];
    $password = $_POST['password'];

    // Turn off default error reporting
  //  error_reporting(0);

    // allow MySQLi error reporting and Exception handling
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
        // Connect to MySQL, select database
        require ("model/database.php");

        // test name for HTML characters to avoid HTML Injection
        require ("TestInput.php");
        $name = test_input($name);
        $password = test_input($password);

        // Perform SQL query
        $query = "SELECT * FROM Login WHERE UserID='$name' And password='$password'";
        $result = mysqli_query($con, $query);

        $rows = mysqli_num_rows($result);

        // if userid not in login table, redirect to error page and try again
        if ($rows < 1)
            header("Location: error.php?message='user/password not found'");

        //get table header names from SQL field names
        $finfo = mysqli_fetch_fields($result);

        // create web page with table and styles
        echo "<html>
<head>
<link href='css/page.css' rel='stylesheet' type='text/css'>
</head>
<body>
<h3 style='text-align:center;'>Here's my Account Info</h3><br><br>
<table align='center'>";
        echo "<tr>";

        // get table column names from result set
        foreach ($finfo as $val) {

            echo "<th> $val->name </th>";
        }
        echo "</tr>";

        // loop over result set. Print a table row for each record
        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "\t<tr>\n";
            // inner loop. Print each table field value for a record
            foreach ($line as $col_value) {
                echo "\t\t<td>$col_value</td>\n";
            }
            echo "\t</tr>\n";
        }
        echo "</table>\n";

        echo "</body></html>";
    } catch (Exception $e) {
        $message = $e->getMessage();
        $code = $e->getCode();
        header("Location: error.php?code=$code&message=$message");
    } 
    finally{
        // close connection
        mysqli_close($con);
    }
} // both fields not filled in, redirect to index.php
else
    header("Location: error.php?message='form fields not filled in'");
?>