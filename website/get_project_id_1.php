<?php
require "db_connect.php";

header('Content-Type: application/json'); // Must be at the top before any output

if (isset($_POST['project_name'])) {
    $name = $conn->real_escape_string($_POST['project_name']);

    // Optional: Whitelist allowed tables to avoid SQL injection
  

    $result_1 = $conn->query("SELECT group_number FROM `$name`"); //$name ni songoson tusliin ner
    $groupNames = [];

    if ($result_1 && $result_1->num_rows > 0) {
        while ($row = $result_1->fetch_assoc()) {
            $groupNames[] = $row['group_number'];
        }
    } 

    $result = $conn->query("SELECT * FROM new_form WHERE project = '$name'");

    $uuriin_machine_hours = [];
    $tuslan_machine_hours = [];
    $turees_machine_hours = [];

    if ($result && $result->num_rows > 0) 
    {
        while ($row = $result->fetch_assoc()) 
        {
            // Array of fields to process
            $fields = [
                "uuriin_machine_hours" => &$uuriin_machine_hours,
                "tuslan_machine_hours" => &$tuslan_machine_hours,
                "turees_machine_hours" => &$turees_machine_hours
            ];

            foreach ($fields as $fieldName => &$targetArray) 
            {

                $machine_string = $row[$fieldName];
                if (!$machine_string) continue;

                $lines = explode("<br>", $machine_string);

                foreach ($lines as $line) 
                {
                    if (trim($line) === "") continue;

                    if (strpos($line, "-") !== false) 
                    {
                        list($machine, $hours) = explode("-", $line);
                        $machine = trim($machine);
                        $hours = (float)trim($hours);

                        if (isset($targetArray[$machine])) 
                        {

                            $targetArray[$machine] += $hours;
                        } else 
                        {
                            $targetArray[$machine] = $hours;
                        }
                    }
                }
            }
        }

        // Output machine hours
        echo json_encode([
            "Өөрийн" => $uuriin_machine_hours,
            "Туслангийн" => $tuslan_machine_hours,
            "Түрээс" => $turees_machine_hours,
            "GroupNames" => $groupNames
        ]);
    } else 
    {
        // No data found
        echo json_encode([
            "Өөрийн машин" => [],
            "Туслан гүйцэтгэгч" => [],
            "Түрээсийн машин" => [],
            "message" => "Хоосон байна."
        ]);
    }
}
