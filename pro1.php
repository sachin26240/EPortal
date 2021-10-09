<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>IPR E-PORTAL</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon1.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Selecao - v4.5.0
  * Template URL: https://bootstrapmade.com/selecao-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <?php
    require_once "config.php";
    session_start();
    // echo $_SESSION["email"];
    ?>
</head>

<body class="page">

    <header id="header" class="fixed-top d-flex align-items-center  header-transparent " style="background: #323549;">
        <div class="container d-flex align-items-center justify-content-between">

            <div class="logo">
                <h1><a href="index.php"><img src="assets/img/favicon1.png" alt="" class="img-fluid"></a><a href="index.php"> IPR E-PORTAL</a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" href="index.php">Home</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
    <section id="form" class="about">
        <div class="container">

            <div class="section-title" data-aos="zoom-out">
                <h2>Consultant Allotement</h2>
                <p>Fill Details</p>
            </div>

            <div class="row content" data-aos="fade-up">
                <div class="offset-md-3 col-md-6 mt-125">

                    <form method="post">

                        <div class="form-group">
                            <label for="name">Applicant Name:</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <label for="topic">Topic:</label>
                            <input type="text" class="form-control" id="topic" name="topic">
                            <label for="ipr">Intellectual Property Rights:</label>
                            <select id='ipr' name='ipr' class="form-control">
                                <option value="Patent">Patent</option>
                                <option value="Copyright">Copyright</option>
                                <option value="Trademark">Trademark</option>
                                <option value="SICLD">SICLD</option>
                            </select>
                            <label for="mobile">Mobile No:</label>
                            <input type="text" class="form-control" id="mobile" name="mobile">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" id="email" name="email">
                            <label for="key">Generate Key:</label>
                            <input type="text" class="form-control" id="key" name="key">
                            <button type="button" style="float: right;" onclick="random()">Generate</button><br>
                            <input class="btn btn-primary my-2 align-center " type="submit" value="Allot" name="allotement">
                        </div>
                    </form>
                    <?php
                    if (isset($_POST["allotement"])) {
                        $name = mysqli_real_escape_string($db, $_POST['name']);
                        $topic = mysqli_real_escape_string($db, $_POST['topic']);
                        $ipr = mysqli_real_escape_string($db, $_POST['ipr']);
                        $mobile = mysqli_real_escape_string($db, $_POST['mobile']);
                        $email = mysqli_real_escape_string($db, $_POST['email']);
                        $key = mysqli_real_escape_string($db, $_POST['key']);

                        $sql = "SELECT consultID FROM consultant";
                        $result = mysqli_query($db, $sql);

                        $count = mysqli_num_rows($result);
                        $random = rand(1, $count);

                        $sql1 = "INSERT INTO allotement (ID, name,topic,ipr,mobile,email,accessKey,counsultID) VALUES (NULL, '$name', '$topic', '$ipr', '$mobile', '$email', '$key', '$random')";
                        $result1 = mysqli_query($db, $sql1) or die(mysqli_error($db));
                        // $result = mysqli_query($db, $sql);
                        if (mysqli_affected_rows($db) > 0) {
                            $sql2 = "SELECT name FROM `consultant` WHERE `consultID`='$random'";
                            $query = mysqli_query($db, $sql2)  or die(mysqli_error($db));
                            $row = mysqli_fetch_row($query);

                            $cosultname = $row[0];
                            echo "<script>alert('Congratulation Consultant Alloted Name:" . $cosultname . " Remember the key to verify')</script>";
                        } else {
                            echo "<script>alert('not inserted')</script>";
                        }
                    }
                    mysqli_close($db);
                    ?>
                </div>
            </div>

        </div>
    </section>
    <?php include("footer.php"); ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script>
        function random() {
            const result = Math.random().toString(36).substring(2, 9);
            console.log(result);
            document.getElementById('key').value = result;
        }
    </script>
</body>

</html>