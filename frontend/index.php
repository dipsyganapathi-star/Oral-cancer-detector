<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oral Disease Detection</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

/* PAGE FADE-IN */
body {
    animation: fadeIn 1s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* NAVBAR ANIMATION */
.navbar {
    animation: slideDown 0.8s ease-in-out;
}

@keyframes slideDown {
    from { transform: translateY(-60px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

/* HERO TEXT ANIMATION */
.hero-content h1 {
    animation: zoomIn 1s ease-in-out;
}

.hero-content p {
    animation: fadeInText 1.5s ease-in;
}

@keyframes zoomIn {
    from { transform: scale(0.8); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

@keyframes fadeInText {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* BUTTON ANIMATION */
.hero-btn {
    transition: all 0.3s ease;
}

.hero-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 20px rgba(0,0,0,0.3);
}

/* FEATURE CARDS ANIMATION */
.feature-card {
    transition: 0.4s ease;
}

.feature-card:hover {
    transform: translateY(-12px) scale(1.03);
    box-shadow: 0 15px 25px rgba(0,0,0,0.2);
}

/* BACKGROUND MOVING EFFECT */
.hero {
    background-size: 120%;
    animation: bgMove 20s infinite alternate;
}

@keyframes bgMove {
    from { background-position: left; }
    to { background-position: right; }
}

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial;
        }

        body{
            background:#f5f7fb;
        }

        .navbar{
            background:#0b132b;
            padding:15px 40px;
        }

        .navbar-brand{
            color:white !important;
            font-size:28px;
            font-weight:bold;
        }

        .navbar-brand span{
            color:#00b4d8;
        }

        .nav-link{
            color:white !important;
            margin-left:20px;
            transition:0.3s;
        }

        .nav-link:hover{
            color:#00b4d8 !important;
        }

        .hero{
            min-height:90vh;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:50px;
            background:linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)),
            url('https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?q=80&w=1200&auto=format&fit=crop');

            background-size:cover;
            background-position:center;
            color:white;
        }

        .hero-content h1{
            font-size:55px;
            font-weight:bold;
            margin-bottom:20px;
        }

        .hero-content p{
            font-size:18px;
            line-height:1.8;
            margin-bottom:30px;
        }

        .hero-btn{
            background:#00b4d8;
            color:white;
            padding:12px 30px;
            border:none;
            border-radius:8px;
            text-decoration:none;
            font-size:18px;
            transition:0.3s;
        }

        .hero-btn:hover{
            background:#0077b6;
            color:white;
        }

        .section-title{
            text-align:center;
            margin-bottom:50px;
        }

        .section-title h2{
            font-size:40px;
            color:#0b132b;
            font-weight:bold;
        }

        .features{
            padding:80px 20px;
        }

        .feature-card{
            background:white;
            padding:30px;
            border-radius:15px;
            text-align:center;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);
            transition:0.3s;
            height:100%;
        }

        .feature-card:hover{
            transform:translateY(-10px);
        }

        .feature-card i{
            font-size:45px;
            color:#00b4d8;
            margin-bottom:20px;
        }

        .feature-card h4{
            margin-bottom:15px;
            color:#0b132b;
        }

        .about{
            padding:80px 20px;
            background:white;
        }

        .about img{
            width:100%;
            border-radius:15px;
        }

        .footer{
            background:#0b132b;
            color:white;
            text-align:center;
            padding:20px;
            margin-top:50px;
        }

    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark">

    <div class="container-fluid">

        <a class="navbar-brand" href="#">
            <i class="fa-solid fa-tooth"></i>
            Oral <span>Disease Detection</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

        <ul class="navbar-nav ms-auto">

        <li class="nav-item">
            <a class="nav-link" href="/oral_cancer_detector/frontend/index.php">Home</a>
        </li>

        <li class="nav-item">
            <a class="nav-link active" href="/oral_cancer_detector/frontend/about.html">About</a>
        </li>

        <!-- FIXED: direct to upload.html -->
        <li class="nav-item">
            <a class="nav-link" href="/oral_cancer_detector/frontend/welcome.php">Predictions</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/oral_cancer_detector/frontend/contact.html">Contact</a>
        </li>

        <li class="nav-item">
        <a class="nav-link" href="#" onclick="logoutConfirm()">Logout</a>
        </li>
        </ul>

        </div>

    </div>

</nav>

<section class="hero">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-7 hero-content">

                <h1>AI Based Oral Disease Detection System</h1>

                <p>
                    This system uses Deep Learning and CNN algorithms to detect oral diseases from mouth images.
                    Upload an image and the AI model predicts the disease type along with confidence percentage.
                </p>

                <!-- FIXED BUTTON -->
                <a href="/oral_cancer_detector/frontend/welcome.php" class="hero-btn">
                    Start Prediction
                </a>

            </div>

        </div>

    </div>

</section>

<section class="features">

    <div class="container">

        <div class="section-title">
            <h2>System Features</h2>
        </div>

        <div class="row g-4">

            <div class="col-md-4">

                <div class="feature-card">

                    <i class="fa-solid fa-brain"></i>

                    <h4>Deep Learning</h4>

                    <p>
                        CNN-based AI model trained using oral disease image datasets.
                    </p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="feature-card">

                    <i class="fa-solid fa-image"></i>

                    <h4>Image Detection</h4>

                    <p>
                        Upload oral images and instantly get disease prediction.
                    </p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="feature-card">

                    <i class="fa-solid fa-chart-column"></i>

                    <h4>Confidence Score</h4>

                    <p>
                        Displays prediction accuracy percentage for each result.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<section class="about">

    <div class="container">

        <div class="row align-items-center g-5">

            <div class="col-lg-6">

                <img src="https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?q=80&w=1200&auto=format&fit=crop">

            </div>

            <div class="col-lg-6">

                <h2 style="font-weight:bold;color:#0b132b;">
                    About The Project
                </h2>

                <p style="margin-top:20px;line-height:1.9;font-size:17px;">
                    The Oral Disease Detection System is developed using PHP, MySQL,
                    Python, TensorFlow and CNN.
                </p>

                <p style="line-height:1.9;font-size:17px;">
                    This project helps in early-stage disease screening
                    and supports fast medical analysis.
                </p>

            </div>

        </div>

    </div>

</section>

<div class="footer">
    <p>© 2026 Oral Disease Detection System | Final Year Project</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
function logoutConfirm() {
    let result = confirm("Are you sure you want to logout?");

    if (result) {
        window.location.href = "/oral_cancer_detector/backend/logout.php";
    } 
    // if No → nothing happens (stays on same page)
}
</script>

</body>
</html>