<?php
require "db_connect.php";

header('Content-Type: application/json');

if (isset($_POST['projects_buleg'])) 
{
    $projects_buleg = $conn->real_escape_string($_POST['projects_buleg']);
    $project = $conn->real_escape_string($_POST['project']);

    $result = $conn->query("SELECT * FROM new_form WHERE project_group_number = '$projects_buleg'");

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
            "Түрээс" => $turees_machine_hours
        ]);
    } else 
    {
        // No data found
        echo json_encode([
            "Өөрийн машин" => [],
            "Туслан гүйцэтгэгч" => [],
            "Шаалдаа машин" => [],
            "message" => "Хоосон байна."
        ]);
    }
}
?>
