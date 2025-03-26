// Part 2. Defense

//Modifications:
// 1.Use stored procedure to fetch user details securely
// 2.Verify hashed password for security


<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_php_test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = trim($_POST['username']); // MODIFIED: Trim input to prevent whitespace issues
    $pass = trim($_POST['password']);
    
    // MODIFIED: Use stored procedure to fetch user details securely
    $stmt = $conn->prepare("CALL GetUserByUsername(?)");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // MODIFIED: Verify hashed password for security
        if (password_verify($pass, $row['password'])) {
            $_SESSION['user'] = $user;
            echo "Login successful!";
        } else {
            echo "Invalid credentials!";
        }
    } else {
        echo "Invalid credentials!";
    }
    
    $stmt->close();
}
$conn->close();
?>


//This login system is susceptible to SQL injection due to the direct embedding of user inputs into the SQL query.
//Make this a secure login


?>

<!DOCTYPE html>
<html>
<head>
    <title>Vulnerable Login</title>
</head>
<body>
    <form method="POST" action="">
        <label>Username:</label>
        <input type="text" name="username"><br>
        <label>Password:</label>
        <input type="password" name="password"><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
