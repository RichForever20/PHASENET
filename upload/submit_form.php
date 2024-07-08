<?php
$servername = "db5016050574.hosting-data.io"; // change if using a different host
$username = "dbu3051243"; // change if using a different username
$password = "Phase.Net@10050201Yo0121Ay"; // change if using a different password
$dbname = "dbs13074270"; // database name created above

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $organization_name = $_POST['organization_name'];
    $country = $_POST['country'];
    $email = $_POST['email'];
    $problem_description = $_POST['problem_description'];
    $existing_solution = $_POST['existing_solution'];
    $existing_solution_details = $_POST['existing_solution_details'];
    $request_nda = isset($_POST['request_nda']) ? 'Yes' : 'No';
    $nda_file = null;

    if (isset($_FILES['nda_file']) && $_FILES['nda_file']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $nda_file = $upload_dir . basename($_FILES['nda_file']['name']);
        move_uploaded_file($_FILES['nda_file']['tmp_name'], $nda_file);
    }

    $stmt = $conn->prepare("INSERT INTO submissions (first_name, last_name, organization_name, country, email, problem_description, existing_solution, existing_solution_details, nda_file, request_nda) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $first_name, $last_name, $organization_name, $country, $email, $problem_description, $existing_solution, $existing_solution_details, $nda_file, $request_nda);

    if ($stmt->execute()) {
        echo "<script>alert('We appreciate your interest in joining us as a partner. A representative from our team will reach out to you soon.'); window.location.href = 'index.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
