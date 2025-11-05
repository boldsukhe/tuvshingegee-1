<?php
// Only run this block if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["ner"])) {

    // Log incoming request (optional for debugging)
    error_log("Form script called at " . date("Y-m-d H:i:s") . ", POST: " . json_encode($_POST));

    // Extract POST values
    $ner = $_POST["ner"];
    $tusuv_id = $_POST["tusuv_id"];
    $ded_group = $_POST["ded_buleg_id"];
    $udriin_tuluv = $_POST["udriin_tuluv"];
    $geodyse_hyanalt = $_POST["geodyse_hyanalt"];
    $mashin_mechanism_uuriin = $_POST["mashin_mechanism_uuriin"];
    $mashin_mechanism_uuriin_tsag = $_POST["mashin_mechanism_uuriin_tsag"];
    $mashin_mechanism_turees = $_POST["mashin_mechanism_turees"];
    $mashin_mechanism_turees_tsag = $_POST["mashin_mechanism_turees_tsag"];
    $ajillasan_uuriin_hun = $_POST["ajillasan_uuriin_hun"];
    $ajillasan_turees_hun = $_POST["ajillasan_turees_hun"];
    $ashiglasan_material = $_POST["ashiglasan_material"];
    $material_too_hemjee = $_POST["material_too_hemjee"];
    $hyanalt_hiigdsen_eseh = $_POST["hyanalt_hiigdsen_eseh"];
    $anhaarah_zuil = $_POST["anhaarah_zuil"];
    $tailbar = $_POST["tailbar"];
    $ajliin_dugaar = $_POST["ajliin_dugaar"];

    // DB connection
    require "db_connect.php";

    $sql = "INSERT INTO Ajilbar (
                `ner`, `tusuv_id`, `ded_group`, `udriin_tuluv`, `geodyse_hyanalt`, 
                `mashin_mechanism_uuriin`, `mashin_mechanism_uuriin_tsag`, 
                `mashin_mechanism_turees`, `mashin_mechanism_turees_tsag`, 
                `ajillasan_uuriin_hun`, `ajillasan_turees_hun`, 
                `ashiglasan_material`, `material_too_hemjee`, 
                `hyanalt_hiigdsen_eseh`, `anhaarah_zuil`, `tailbar`, 
                `ajliin_dugaar`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        die("SQL error: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "siisssisisssissss",
        $ner,
        $tusuv_id,
        $ded_group,
        $udriin_tuluv,
        $geodyse_hyanalt,
        $mashin_mechanism_uuriin,
        $mashin_mechanism_uuriin_tsag,
        $mashin_mechanism_turees,
        $mashin_mechanism_turees_tsag,
        $ajillasan_uuriin_hun,
        $ajillasan_turees_hun,
        $ashiglasan_material,
        $material_too_hemjee,
        $hyanalt_hiigdsen_eseh,
        $anhaarah_zuil,
        $tailbar,
        $ajliin_dugaar
    );

    mysqli_stmt_execute($stmt);

    // ✅ Optional: redirect to prevent duplicate insert on refresh
    header("Location: ./home_budgetAdmin.html");
    exit;

} else {
    // The request wasn't POST or required fields are missing
    echo "⚠️ No valid form submission.";
}
?>
