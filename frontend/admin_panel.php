<?php
$file = "ai_model/disease_data.json";
$data = json_decode(file_get_contents($file), true);

// ADD / UPDATE
if (isset($_POST['save'])) {

    $disease = $_POST['disease'];
    $symptom = $_POST['symptom'];
    $weight = floatval($_POST['weight']);

    if (!isset($data[$disease])) {
        $data[$disease] = [];
    }

    $data[$disease][$symptom] = $weight;

    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

    echo "<script>alert('Updated Successfully');</script>";
}

// DELETE symptom
if (isset($_POST['delete_symptom'])) {
    $disease = $_POST['disease'];
    $symptom = $_POST['symptom'];

    unset($data[$disease][$symptom]);

    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

    echo "<script>alert('Deleted Successfully');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Disease Panel</title>

    <style>
        body{
            font-family:Arial;
            background:#0f172a;
            color:white;
            padding:20px;
        }

        input, button{
            padding:10px;
            margin:5px;
        }

        .box{
            background:rgba(255,255,255,0.1);
            padding:20px;
            border-radius:10px;
            margin-bottom:20px;
        }

        button{
            cursor:pointer;
        }
    </style>
</head>

<body>

<h2>🏥 Disease Admin Panel</h2>

<div class="box">
    <h3>Add / Update Symptom Weight</h3>

    <form method="POST">
        <input name="disease" placeholder="Disease" required>
        <input name="symptom" placeholder="Symptom" required>
        <input name="weight" placeholder="Weight (0-1)" required>
        <button name="save">Save</button>
    </form>
</div>

<div class="box">
    <h3>Current Data</h3>
    <pre><?php print_r($data); ?></pre>
</div>

</body>
</html>