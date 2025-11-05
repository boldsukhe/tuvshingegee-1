<?php
require("db_connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["project"])) {

    // Sanitize inputs
    $project = $_POST["project"] ?? '';
    $project_group_number = $_POST["project_group_number"] ?? '';
    $ded_buleg = $_POST["ded_buleg"] ?? '';
    $hereglegch_ner = $_POST["hereglegch_ner"] ?? '';
    $ajliin_turul = $_POST["ajliin_turul"] ?? '';
    $ognoo = $_POST["ognoo"] ?? '';

    $niit_ajil = floatval($_POST["col3"] ?? 0);
    $uuriin_worker = intval($_POST["uuriin_worker"] ?? 0);
    $tuslan_worker = intval($_POST["tuslan_worker"] ?? 0);
    $turees_worker = intval($_POST["turees_worker"] ?? 0);

    $uuriin_work_hours = floatval($_POST["uuriin_work_hours"] ?? 0);
    $tuslan_work_hours = floatval($_POST["tuslan_work_hours"] ?? 0);
    $turees_work_hours = floatval($_POST["turees_work_hours"] ?? 0);

    // Machine selections
    $uuriin_machine = isset($_POST['uuriin_machine']) ? implode(", ", $_POST['uuriin_machine']) : '';
    $tuslan_machine = isset($_POST['tuslan_machine']) ? implode(", ", $_POST['tuslan_machine']) : '';
    $turees_machine = isset($_POST['turees_machine']) ? implode(", ", $_POST['turees_machine']) : '';

    $uuriin_machine_hours = $_POST["uuriin_machine_tsag"];
    $uuriin_machines_hours = "";

    foreach ($uuriin_machine_hours as $machine => $quantity) {
        $safeMachine = htmlspecialchars($machine);
        $safeQuantity = intval($quantity);

        // Save to DB or display:
        // echo "$safeMachine - $safeQuantity<br>";
        $uuriin_machines_hours .= "$safeMachine - $safeQuantity<br>";
    }

    $tuslan_machine_hours = $_POST["tuslan_machine_tsag"];
    $tuslan_machines_hours = "";
    
    foreach ($tuslan_machine_hours as $machine => $quantity) {
        $safeMachine = htmlspecialchars($machine);
        $safeQuantity = intval($quantity);

        // Save to DB or display:
        // echo "$safeMachine - $safeQuantity<br>";
        $tuslan_machines_hours .= "$safeMachine - $safeQuantity<br>";
    }

    $turees_machine_hours = $_POST["turees_machine_tsag"];
    $turees_machines_hours = "";

    foreach ($turees_machine_hours as $machine => $quantity) {
        $safeMachine = htmlspecialchars($machine);
        $safeQuantity = intval($quantity);

        // Save to DB or display:
        // echo "$safeMachine - $safeQuantity<br>";
        $turees_machines_hours .= "$safeMachine - $safeQuantity<br>";
    }

    // Prepared SQL
    $sql = "INSERT INTO new_form (
        project, project_group_number, ded_buleg, hereglegch_ner, ajliin_turul, ognoo,
        niit_ajil, uuriin_worker, tuslan_worker, turees_worker,
        uuriin_work_hours, tuslan_work_hours, turees_work_hours,
        uuriin_machine, tuslan_machine, turees_machine,
        uuriin_machine_hours, tuslan_machine_hours, turees_machine_hours
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param(
        "ssssssiiiiiiissssss",
        $project,
        $project_group_number,
        $ded_buleg,
        $hereglegch_ner,
        $ajliin_turul,
        $ognoo,
        $niit_ajil,
        $uuriin_worker,
        $tuslan_worker,
        $turees_worker,
        $uuriin_work_hours,
        $tuslan_work_hours,
        $turees_work_hours,
        $uuriin_machine,
        $tuslan_machine,
        $turees_machine,
        $uuriin_machines_hours,
        $tuslan_machines_hours,
        $turees_machines_hours
    );

    if ($stmt->execute()) {
        echo "Form saved successfully.";
    } else {
        echo "Error executing query: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
