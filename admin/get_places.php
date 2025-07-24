<?php
// get_places.php

// Database connection
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'officenav';

$db = mysqli_connect($hostname, $username, $password, $database);

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

$collegeName = mysqli_real_escape_string($db, $_GET['college_name']);

$query = "SELECT id, place FROM places WHERE info = '$collegeName'";
$result = mysqli_query($db, $query);


$places = array();
while ($row = mysqli_fetch_assoc($result)) {
    $places[] = array(
        'id' => $row['id'],
        'place' => $row['place']
    );
}

echo json_encode($places);

mysqli_close($db);
?>


<?php
// Include the qrlib.php file
require 'qrlib.php';

// Initialize variables
$placeName = '';
$link = '';
$qrCodeData = '';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the place name and link from the form input
    $placeName = $_POST['place'];
    $link = $_POST['location'];

    // Generate the QR code data
    $qrCodeData = $link;

    // Generate the QR code
    $qrCodeFile = 'qrcodes/' . uniqid() . '.png'; // Unique filename for each QR code
    QRcode::png($qrCodeData, $qrCodeFile);

    // Store the QR code filename, place name, and link in the database
    $db = mysqli_connect('localhost', 'root', '', 'officenav');

    // Check for database connection errors
    if (!$db) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Escape user input to prevent SQL injection
    $placeName = mysqli_real_escape_string($db, $placeName);
    $link = mysqli_real_escape_string($db, $link);
    $qrCodeFile = mysqli_real_escape_string($db, $qrCodeFile);

    // Insert data into the database
    $query = "INSERT INTO qr_codes (place,qr) VALUES ('$placeName','$qrCodeFile')";
    $result = mysqli_query($db, $query);

    // Check for database query errors
    if ($result) {?>
        <script type="text/javascript">
            window.alert(" QR updated Successfully");
            window.location="manageqr.php";
            </script>
            <?php } else {
        echo "Error: " . mysqli_error($db);
    }

    // Close the database connection
    mysqli_close($db);
}
?>
