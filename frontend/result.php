<?php

$image = isset($_GET['image']) ? $_GET['image'] : '';
$disease = isset($_GET['disease']) ? $_GET['disease'] : '';
$confidence = isset($_GET['confidence']) ? $_GET['confidence'] : '';

?>

<!DOCTYPE html>
<html>
<head>

<title>Detection Result</title>

<style>

body{
    font-family: Arial;
    background: linear-gradient(135deg,#141e30,#243b55);
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container{
    background: rgba(255,255,255,0.1);
    padding: 30px;
    border-radius: 15px;
    text-align: center;
    backdrop-filter: blur(10px);
    width: 500px;
}

img{
    width: 380px;
    height: 300px;
    object-fit: cover;
    border-radius: 12px;
    margin: 20px 0;
}

.result{
    font-size: 26px;
    font-weight: bold;
    color: yellow;
}

.confidence{
    font-size: 22px;
    margin-top: 10px;
    color: lightgreen;
}

/* BUTTON BOX */
.button-box{
    margin-top: 20px;
    padding: 15px;
    border: 2px dashed #00c6ff;
    border-radius: 12px;
}

/* BUTTONS */
button{
    padding: 12px 20px;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    cursor: pointer;
    margin: 5px;
    transition: 0.3s;
}

.upload{
    background: #00c6ff;
    color: white;
}

.predict{
    background: #00ff99;
    color: black;
}

.back{
    background: #ff4d4d;
    color: white;
}

.upload:hover{ background:#0099cc; }
.predict:hover{ background:#00cc77; }
.back:hover{ background:#cc0000; }

</style>

</head>

<body>

<div class="container">

<h2>Oral Disease Detection</h2>

<img src="../uploads/<?php echo $image; ?>">

<div class="result">
Disease Detected:
<br><br>
<?php echo $disease; ?>
</div>

<div class="confidence">
Confidence: <?php echo $confidence; ?>%
</div>

<!-- UPLOAD AGAIN SECTION -->

<form id="uploadForm" enctype="multipart/form-data">

    <input type="file"
           id="fileInput"
           name="image"
           accept="image/*"
           required
           style="display:none;"
           onchange="fileSelected()">

    <p id="fileName" style="color:white;margin-top:10px;"></p>

    <div class="button-box">

        <button type="button"
                class="upload"
                onclick="document.getElementById('fileInput').click()">
            Upload Another Image
        </button>

        <button type="submit" class="predict">
            Predict Image
        </button>

        <button type="button"
                class="back"
                onclick="window.location.href='welcome.php'">
            Back
        </button>

    </div>

</form>

</div>

<script>

function fileSelected() {
    let file = document.getElementById("fileInput").files[0];

    if (file) {
        document.getElementById("fileName").innerText =
            "Selected File: " + file.name;
    }
}

document.getElementById("uploadForm").addEventListener("submit", function(e){

    e.preventDefault();

    let formData = new FormData(this);

    fetch("../backend/upload.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {

        if(data.status === "error"){

            alert(data.message);
            return;
        }

        window.location.href =
            "result.php?image=" + encodeURIComponent(data.image)
            + "&disease=" + encodeURIComponent(data.disease)
            + "&confidence=" + encodeURIComponent(data.confidence);

    })
    .catch(error => {

        alert("Error processing image.");

        console.log(error);

    });

});

</script>

</body>
</html>