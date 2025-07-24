<?php
// Database connection configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logistics";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    // Prepare SQL statement to insert data into database
    $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
    
    // Use prepared statements for security
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $password, $role);

    // Execute the statement
    if ($stmt->execute()) {
        // Success message
?>
<script>
    alert('user added Successfully');
    window.location="addplace.php";
</script><?php    } else {
        // Error message
        echo json_encode(array("status" => "error", "message" => "Failed to add user. Please try again later."));
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
