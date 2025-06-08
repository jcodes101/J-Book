<?php

/*
    - since mysql does not report errors by default,
    this tells mysql to report any errors if there are any.
*/
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$db_server = "YOUR_SERVER";
$db_user = "YOUR_USER";
$db_pass = "YOUR_PASS";
$db_name = "YOUR_NAME";

/*
    - a connection to the database will be tried and if successful
    the connection is made, otherwise an error message is given
*/
try {
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
} catch (mysqli_sql_exception $e) {
    echo "could not connect: " . $e->getMessage();
}
?>

<!-- alternate (die) function method instead of try/catch -->
<?php
/*
$db_server = "YOUR_SERVER";
$db_user = "YOUR_USER";
$db_pass = "YOUR_PASS";
$db_name = "YOUR_NAME";

$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);


    // - more simple way:
            - if there is a connection, fine, otherwise the script is
            stopped and prints the error

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
*/
?>