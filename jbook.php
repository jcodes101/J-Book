<?php
/* 
    - this is to include the database.php file
    - handles the connection to the database through server, user, etc.
*/
include("sample_database.php");
?>

<!-- sample html boilerplate code-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Welcome to JBOOK</h2>
    <!-- 
        - this form has a php script to prevent special characters from being entered
        into the username/password input fields (such as malicious code such as an sql injection or malicious script)
     
        - the method is set to post for more security as username and password
        will not be relayed in the address bar by using this method

        - used to prevent XSS (which is cross-site scripting) along with the 'echo'
        which is used to have the URL embeddded in the actual HTML (via web console)
    -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <label>username:</label><br>
        <input type="text" name="username" required><br>

        <label>password:</label><br>
        <input type="password" name="password" required><br>

        <input type="submit" name="login" value="register">

    </form>

</body>

</html>

<?php
/* 
    - a check if the servers method is equal to post is in place
    to make sure the best security for the users credentials

    - this makes sure the PHP logic runs when the form is submitted
    using the POST method and not when the page loads
*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /*
        - username and password variables are assigned a filter_input
        to prevent malicious code

        - the trim is also used to prevent any whitespace
    */
    $username = trim(filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS));
    $password = trim(filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS));

    if (empty($username)) {
        echo "please enter a username";
    } elseif (empty($password)) {
        echo "please enter a password";
    } else {

        /*
            - a hash variable is made to store the encrypted version of the
            users password by using the default encryption method (BCRYPT)
        */
        $hash = password_hash($password, PASSWORD_DEFAULT);

        /*
            - an sql varibale is assigned to add the username and (hashed) password
            of the new user into a table in the mysql database
        */
        // $sql = "INSERT INTO users (user, password) VALUES ('$username', '$hash')";

        /* 
            - however the insert is only done if no values in the database 
            do not match any already entered
        */
        try {

            /*
                - these are prepared statements to escape inputs to make SQL injection
                nearly impossible or difficult to do

                - the 'prepare' function creates a prepared SQL statement
                where VALUES (?, ?) means the values are provided later

                - the '?' placeholders are used instead of directly insterting the username
                and password values into the table, it is what prevents the SQL injection
            */
            $stmt = $conn->prepare("INSERT INTO users (user, password) VALUES (?, ?)");

            /*
                - the bind_param function tells mysql what types of data to expect from the '?'
                placeholder and what to "bind" to them

                - "ss" means to strings first s=username, second s=password
            */
            $stmt->bind_param("ss", $username, $hash);

            // if everything is correct and safe, the new users are inserted into the databse table
            $stmt->execute();

            /* 
                - simple query to connect to the database along with the query
                information from the $sql variable
            */
            // mysqli_query($conn, $sql);
            echo "you are now registered";
        } catch (mysqli_sql_exception) {
            echo "that username is already taken";
        }
    }
}

/*
    - it is always a good practice to close the mysql connection
    to free system resources

    - if this isn't done too many open connections can slow things down
    
    - even though php automatically closes connections, it is
    better to do it explicitly
*/
mysqli_close($conn);
?>