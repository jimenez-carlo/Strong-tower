<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Strong Tower Gym</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

  <!-- Flaticon Font -->
  <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

  <!-- Customized Bootstrap Stylesheet -->
  <link href="css/landing_page.css" rel="stylesheet">
  <link href="css/landing_page_custom.css" rel="stylesheet">
</head>
<script>
  var base_url = "<?php echo "http://" . $_SERVER['SERVER_NAME'] . str_replace("index.php", "", strtok($_SERVER["REQUEST_URI"], '?')); ?>";
</script>

<body class="bg-white">
  <!-- Navbar Start -->
  <div class="container-fluid p-0 nav-bar">
    <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
      <a href="" class="navbar-brand">
        <h1 class="m-0 display-4 font-weight-bold text-uppercase text-white">WE CREATE<span class="text-primary">SHAPES</span></h1>
      </a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
        <div class="navbar-nav ml-auto p-4 bg-secondary">
          <a href="#home" class="nav-item nav-link active">Home</a>
          <a href="#about" class="nav-item nav-link">About Us</a>
          <a href="#class" class="nav-item nav-link">Classes</a>
          <a href="#trainer" class="nav-item nav-link">Trainers</a>
          <a href="#contact" class="nav-item nav-link">Contact Us</a>
          <a href="#" class="nav-item nav-link" data-toggle="modal" data-target="#register_modal">Register</a>
          <a href="#" class="nav-item nav-link" data-toggle="modal" data-target="#login_modal">Login</a>
        </div>
      </div>
    </nav>
  </div>