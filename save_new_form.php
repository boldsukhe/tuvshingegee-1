<?php
require("db_connect.php");
// Only run this block if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["project"])) {

    // Log incoming request (optional for debugging)
    error_log("Form script called at " . date("Y-m-d H:i:s") . ", POST: " . json_encode($_POST));

    // Extract POST values
  

    $project = $_POST["project"];
    $project_group_number = $_POST["project_group_number"];
    $buleg_utga = $_POST["buleg_utga"];
    $ded_buleg = $_POST["ded_buleg"];
    $ded_buleg_utga = $_POST["ded_buleg_utga"];
    $ajilbar = $_POST["ajilbar"];
    $hereglegch_ner = $_POST["hereglegch_ner"];
    $ajliin_turul = $_POST["ajliin_turul"];
    $ognoo = $_POST["ognoo"];
    $niit_ajil = $_POST["col3"];
    $uuriin_worker = $_POST["uuriin_worker"];
    $tuslan_worker = $_POST["tuslan_worker"];
    $turees_worker = $_POST["turees_worker"];
    $uuriin_work_hours = $_POST["uuriin_work_hours"];
    $tuslan_work_hours = $_POST["tuslan_work_hours"];
    $turees_work_hours = $_POST["turees_work_hours"];
    $uuriin_machine = $_POST["uuriin_machine"];
    $tuslan_machine = $_POST["tuslan_machine"];
    $turees_machine = $_POST["turees_machine"];
    $uuriin_machine_hours = $_POST["uuriin_machine_hours"];
    $tuslan_machine_hours = $_POST["tuslan_machine_hours"];
    $turees_machine_hours = $_POST["turees_machine_hours"];



   


$sql = "INSERT INTO new_form (project, project_group_number, buleg_utga, ded_buleg, ded_buleg_utga, ajilbar, 
                        hereglegch_ner, ajliin_turul, ognoo, niit_ajil, uuriin_worker, tuslan_worker,
                        turees_worker, uuriin_work_hours, tuslan_work_hours, turees_work_hours,
                        uuriin_machine, tuslan_machine, turees_machine,
                        uuriin_machine_hours, tuslan_machine_hours, turees_machine_hours)
            VALUES ('$project','$project_group_number', '$buleg_utga', '$ded_buleg', '$ded_buleg_utga', '$ajilbar',
                     '$hereglegch_ner', '$ajliin_turul', '$ognoo', $niit_ajil, $uuriin_worker, $tuslan_worker,
                      $turees_worker, $uuriin_work_hours, $tuslan_work_hours, $turees_work_hours,
                     $uuriin_machine, $tuslan_machine, $turees_machine,
                     $uuriin_machine_hours, $tuslan_machine_hours, $turees_machine_hours)";

$conn->query($sql);
exit;
}

$conn->close();
?>