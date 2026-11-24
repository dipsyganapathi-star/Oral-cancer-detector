<?php

require_once("../backend/db.php");

if (!isset($_POST['symptoms'])) {
    die("No symptoms selected");
}

$all_symptoms = [
    "mouth_ulcer",
    "white_patch",
    "red_patch",
    "bleeding_gums",
    "swollen_gums",
    "bad_breath",
    "tooth_pain",
    "loose_teeth",
    "difficulty_swallowing",
    "jaw_pain",
    "burning_sensation",
    "mouth_lump"
];

$binary_input = [];

foreach ($all_symptoms as $symptom) {
    $binary_input[] = in_array($symptom, $_POST['symptoms']) ? 1 : 0;
}

$script = realpath(__DIR__ . "/../ai_model/predict_symptom.py");
$cmd = "python \"$script\" " . implode(" ", $binary_input);
$output = shell_exec($cmd);

if (!$output) {
    die("Prediction failed");
}

$output = trim($output);
$results = explode("|", rtrim($output, "|"));

$parsed = [];

foreach ($results as $r) {

    $parts = explode(":", $r);
    if (count($parts) < 2) continue;

    $parsed[] = [
        "disease" => $parts[0],
        "confidence" => $parts[1],
        "reason" => $parts[2] ?? ""
    ];
}

$top = $parsed[0];

$disease = $top["disease"];
$confidence = $top["confidence"];
$reason = $top["reason"];

$disease_display = ucwords(strtolower(str_replace("_", " ", $disease)));

$disease_clean = strtoupper($disease);

$stmt = $conn->prepare("SELECT advice FROM disease_advice WHERE disease = ?");
$stmt->bind_param("s", $disease_clean);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $advice = $row['advice'];
} else {
    $advice = "🩺 Maintain oral hygiene and consult dentist.";
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Symptom Result</title>

<style>
body{
    margin:0;
    font-family:Segoe UI;
    background: linear-gradient(135deg, #0f172a, #1e293b);
    color:white;
}

.container{
    width:70%;
    margin:50px auto;
    padding:30px;
    background: rgba(255,255,255,0.08);
    border-radius:16px;
    text-align:center;
}

.result{
    padding:20px;
    background: rgba(0,0,0,0.3);
    border-radius:12px;
}

.disease{
    font-size:26px;
    color:#ffd700;
}

.conf{
    color:#00ff99;
    font-size:20px;
}

.reason, .advice{
    margin-top:20px;
    padding:15px;
    background: rgba(255,255,255,0.1);
    border-radius:10px;
}

/* BACK BUTTON */
.back-btn{
    display:inline-block;
    margin-top:25px;
    padding:12px 20px;
    background:#111827;
    color:white;
    text-decoration:none;
    border-radius:8px;
    font-weight:bold;
    transition:0.3s;
}

.back-btn:hover{
    background:#1f2937;
    transform:scale(1.05);
}
</style>

</head>

<body>

<div class="container">

<h2>🧠 Symptom Prediction Result</h2>

<div class="result">

<div class="disease">
🦷 <?php echo $disease_display; ?>
</div>

<div class="conf">
📊 Confidence: <?php echo $confidence; ?>%
</div>

</div>

<div class="reason">
💡 Why this prediction:<br><br>
<?php echo $reason; ?>
</div>

<div class="advice">
💊 Medical Advice:<br><br>
<?php echo $advice; ?>
</div>

<!-- BACK BUTTON -->
<a href="javascript:history.back()" class="back-btn">⬅ Back</a>

</div>

</body>
</html>