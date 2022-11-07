<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Strong Tower | Client</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/admin.css">
</head>
<script>
  var base_url = "<?php echo "http://" . $_SERVER['SERVER_NAME'] . str_replace("index.php", "", strtok($_SERVER["REQUEST_URI"], '?')); ?>";
</script>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-danger navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <!-- <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#modal-default" role="button">
            <i class="fas fa-power-off"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar elevation-4 sidebar-dark-danger">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="assets/logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Strong Tower Gym</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?= ucfirst($_SESSION['user']->first_name) . ' ' . ucfirst($_SESSION['user']->last_name); ?></a>
          </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item">
              <a href="." class="nav-link btn-side active">
                <i class="fa fa-home nav-icon"></i>
                <p>Home</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link btn-side" name="admin/clients">
                <i class="fa fa-users nav-icon"></i>
                <p>Clients</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link btn-side" name="admin/trainers">
                <i class="fa fa-users nav-icon"></i>
                <p>Trainers</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link btn-side" name="admin/employees">
                <i class="fa fa-users nav-icon"></i>
                <p>Employees</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link btn-side" name="admin/client_plans">
                <i class="fa fa-clipboard nav-icon"></i>
                <p>Client Plans</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link btn-side" name="admin/plans">
                <i class="fa fa-clipboard nav-icon"></i>
                <p>Membership Plans</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link btn-side" name="admin/workouts">
                <i class="fa fa-hand-rock nav-icon"></i>
                <p>Workouts</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link btn-side" name="admin/equipments">
                <i class="fa fa-dumbbell nav-icon"></i>
                <p>Equipments</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link btn-side" name="admin/supplements">
                <i class="fa fa-pills nav-icon"></i>
                <p>Supplements</p>
              </a>
            </li>


            <li class="nav-item">
              <a href="#" class="nav-link btn-side" name="admin/services">
                <i class="fa fa-handshake nav-icon"></i>
                <p>Services</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link btn-side" name="admin/branches">
                <i class="fa fa-store nav-icon"></i>
                <p>Branches</p>
              </a>
            </li>

            <!-- <li class="nav-item">
              <a href="#" class="nav-link btn-side">
                <i class="fa fa-calendar nav-icon"></i>
                <p>My Activity</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link btn-side">
                <i class="fa fa-clipboard nav-icon"></i>
                <p>Workout Plan</p>
              </a>
            </li> -->

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>