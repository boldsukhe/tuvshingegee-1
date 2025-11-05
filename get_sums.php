<?php
require "db_connect.php";

$project = $_POST['project'] ?? '';
$group_number = $_POST['group_number'] ?? '';
$ded_buleg = $_POST['ded_buleg'] ?? '';

$response = [];

if ($project && $group_number && $ded_buleg) {
    $sql = "
        SELECT 
            SUM(uuriin_worker) AS total_uuriin_worker,
            SUM(tuslan_worker) AS total_tuslan_worker,
            SUM(turees_worker) AS total_turees_worker,
            SUM(uuriin_work_hours) AS total_uuriin_work_hours,
            SUM(tuslan_work_hours) AS total_tuslan_work_hours,
            SUM(turees_work_hours) AS total_turees_work_hours,
            SUM(uuriin_machine) AS total_uuriin_machine,
            SUM(tuslan_machine) AS total_tuslan_machine,
            SUM(turees_machine) AS total_turees_machine,
            SUM(uuriin_machine_hours) AS total_uuriin_machine_hours,
            SUM(tuslan_machine_hours) AS total_tuslan_machine_hours,
            SUM(turees_machine_hours) AS total_turees_machine_hours,
            SUM(niit_ajil) AS niit_ajil
        FROM new_form
        WHERE project = ?
          AND project_group_number = ?
          AND ded_buleg = ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $project, $group_number, $ded_buleg);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    $response = [
        'uuriin_worker' => $result['total_uuriin_worker'] ?? 0,
        'tuslan_worker' => $result['total_tuslan_worker'] ?? 0,
        'turees_worker' => $result['total_turees_worker'] ?? 0,
        'uuriin_work_hours' => $result['total_uuriin_work_hours'] ?? 0,
        'tuslan_work_hours' => $result['total_tuslan_work_hours'] ?? 0,
        'turees_work_hours' => $result['total_turees_work_hours'] ?? 0,
        'uuriin_machine' => $result['total_uuriin_machine'] ?? 0,
        'tuslan_machine' => $result['total_tuslan_machine'] ?? 0,
        'turees_machine' => $result['total_turees_machine'] ?? 0,
        'uuriin_machine_hours' => $result['total_uuriin_machine_hours'] ?? 0,
        'tuslan_machine_hours' => $result['total_tuslan_machine_hours'] ?? 0,
        'turees_machine_hours' => $result['total_turees_machine_hours'] ?? 0,
        'niit_ajil' => $result['niit_ajil'] ?? 0,
        

    ];
}

header('Content-Type: application/json');
echo json_encode($response);
