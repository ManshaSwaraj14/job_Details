<?php
// database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "job_portal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get job id from URL
$job_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch job details
$sql = "SELECT * FROM jobs WHERE id = $job_id";
$result = $conn->query($sql);

// Check if job exists
if ($result->num_rows > 0) {
    $job = $result->fetch_assoc();
} else {
    echo "No job found.";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Job Details</title>
    <style>
        .job-details {
            width: 60%;
            margin: auto;
            border: 1px solid #ccc;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .job-details h2 {
            margin-top: 0;
        }
        .job-details p {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="job-details">
        <h2><?php echo htmlspecialchars($job['title']); ?></h2>
        <p><strong>Company:</strong> <?php echo htmlspecialchars($job['company']); ?></p>
        <p><strong>Location:</strong> <?php echo htmlspecialchars($job['location']); ?></p>
        <p><strong>Salary:</strong> <?php echo htmlspecialchars($job['salary']); ?></p>
        <p><strong>Posted Date:</strong> <?php echo htmlspecialchars($job['posted_date']); ?></p>
        <p><strong>Description:</strong></p>
        <p><?php echo nl2br(htmlspecialchars($job['description'])); ?></p>
    </div>
</body>
</html>
<?php
// Close connection
$conn->close();
?>
