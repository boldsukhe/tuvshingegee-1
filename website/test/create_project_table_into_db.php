<?php
require "db_connect.php";

// Check if the project name was passed
if (isset($_GET['projectName']) && !empty(trim($_GET['projectName']))) {
    // Sanitize the name: allow only letters, numbers, and underscores
    $rawProjectName = $_GET['projectName'];
    $projectName = preg_replace('/[^a-zA-Z0-9_]/', '', str_replace(' ', '_', $rawProjectName));

    if ($projectName === '') {
        die("Error: Project name after sanitization is empty or invalid.");
    }

    $sql = "CREATE TABLE `$projectName` (
        project_id INT AUTO_INCREMENT PRIMARY KEY,
        group_number varchar(255) ,
        source_buleg VARCHAR(255) ,
        ajliin_turul VARCHAR(255) ,
        negj VARCHAR(100) ,
        quantity INT ,
        unit_cost INT ,
        total_cost INT ,
        start_date VARCHAR(30) ,
        end_date VARCHAR(30)
    )";

if ($conn->query($sql) === TRUE) {
    // Insert into 'projects' table
    $stmt = $conn->prepare("INSERT INTO projects (name) VALUES (?)");
    $stmt->bind_param("s", $projectName);

    if ($stmt->execute()) {
        // Redirect only after successful insertion
        header("Location: add_project_budget_timeline_2.html?projectName=" . urlencode($projectName));
        exit();
    } else {
        echo "Error inserting into projects table: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error creating table: " . $conn->error;
}


} else {
    echo "Error: No valid project name provided in the URL.";
}

$conn->close();
?>
