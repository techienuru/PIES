<?php
session_start();
include_once "../includes/connect.php";
include_once "../includes/classes/admin.php";

$object = new dashboard($connect);

$object->collectUserID();

// Sets Pension Rate to zero
$object->setPensionRate();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Pension Information system</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../assets/vendors/jquery-bar-rating/css-stars.css" />
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css" />
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="../assets/css/demo_1/style.css" />
  <!-- End layout styles -->
  <link rel="shortcut icon" href="../assets/images/favicon.png" />
  <style>
    body {
      background-color: #f4f4f4;
      font-family: 'Poppins', sans-serif;
    }

    .welcome-container {
      background: linear-gradient(135deg, #007bff, #4e73df);
      color: white;
      padding: 40px;
      border-radius: 15px;
      margin-top: 50px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      animation: fadeIn 1.5s ease-out;
    }

    .welcome-header {
      font-size: 2.5rem;
      font-weight: 700;
    }

    .welcome-subtext {
      font-size: 1.1rem;
      margin-top: 10px;
    }

    .quote {
      font-style: italic;
      margin-top: 20px;
      opacity: 0.9;
    }

    .btn-container {
      margin-top: 30px;
    }

    .welcome-icon {
      font-size: 60px;
      margin-bottom: 10px;
      color: #ffc107;
    }

    @keyframes fadeIn {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }

      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>

</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item nav-profile border-bottom">
          <a href="#" class="nav-link flex-column">
            <div class="nav-profile-image">
              <!--change to offline or busy as needed-->
            </div>
            <div class="nav-profile-text d-flex ml-0 mb-3 flex-column">
              <span class="font-weight-semibold mb-1 mt-2 text-center">PIES</span>
            </div>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./dashboard.php">
            <i class="mdi mdi-compass-outline menu-icon"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="./manage_pensioneer.php">
            <i class="mdi mdi-compass-outline menu-icon"></i>
            <span class="menu-title">Manage Pensioneers</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="./notification.php">
            <i class="mdi mdi-compass-outline menu-icon"></i>
            <span class="menu-title">Notifications</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./update_payment.php">
            <i class="mdi mdi-compass-outline menu-icon"></i>
            <span class="menu-title">Update Payment</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="./settings.php">
            <i class="mdi mdi-compass-outline menu-icon"></i>
            <span class="menu-title">Settings</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="logout.php">
            <i class="mdi mdi-compass-outline menu-icon"></i>
            <span class="menu-title">Logout</span>
          </a>
        </li>
      </ul>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div id="settings-trigger"><i class="mdi mdi-settings"></i></div>
      <div id="theme-settings" class="settings-panel">
        <i class="settings-close mdi mdi-close"></i>
        <p class="settings-heading">SIDEBAR SKINS</p>
        <div class="sidebar-bg-options selected" id="sidebar-default-theme">
          <div class="img-ss rounded-circle bg-light border mr-3"></div>Default
        </div>
        <div class="sidebar-bg-options" id="sidebar-dark-theme">
          <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
        </div>
        <p class="settings-heading mt-2">HEADER SKINS</p>
        <div class="color-tiles mx-0 px-4">
          <div class="tiles default primary"></div>
          <div class="tiles success"></div>
          <div class="tiles warning"></div>
          <div class="tiles danger"></div>
          <div class="tiles info"></div>
          <div class="tiles dark"></div>
          <div class="tiles light"></div>
        </div>
      </div>
      <!-- partial -->
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-chevron-double-left"></span>
          </button>
          <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="../assets/images/logo-mini.svg" alt="logo" /></a>
          </div>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper pb-0">


          <div class="row">
            <div class="col-sm-12 stretch-card grid-margin">
              <div class="card">
                <div class="card-body">
                  <div class="container d-flex justify-content-center">
                    <div class="welcome-container text-center">
                      <i class="welcome-icon fas fa-user-shield"></i>
                      <h2 class="welcome-header">Welcome Back, Administrator!</h2>
                      <p class="welcome-subtext">
                        Empowering Pensioners Starts with You. Your dashboard is ready to deliver seamless information, manage updates,
                        and enhance lives with every action you take today.
                      </p>
                      <hr class="my-4" style="border-color: rgba(255, 255, 255, 0.5);">
                      <p class="quote">
                        "Great technology simplifies lives – let's make it happen together."
                      </p>
                      <div class="btn-container">
                        <a href="./manage_pensioneer.php" class="btn btn-warning btn-lg">Get Started</a>
                        <a href="./notification.php" class="btn btn-outline-light btn-lg ml-3">Notifications</a>
                      </div>
                    </div>
                  </div>




                </div>
              </div>
            </div>
          </div>



        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © PIES 2024</span>

          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../assets/vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
  <script src="../assets/vendors/chart.js/Chart.min.js"></script>
  <script src="../assets/vendors/flot/jquery.flot.js"></script>
  <script src="../assets/vendors/flot/jquery.flot.resize.js"></script>
  <script src="../assets/vendors/flot/jquery.flot.categories.js"></script>
  <script src="../assets/vendors/flot/jquery.flot.fillbetween.js"></script>
  <script src="../assets/vendors/flot/jquery.flot.stack.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../assets/js/off-canvas.js"></script>
  <script src="../assets/js/hoverable-collapse.js"></script>
  <script src="../assets/js/misc.js"></script>
  <script src="../assets/js/settings.js"></script>
  <script src="../assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="../assets/js/dashboard.js"></script>
  <!-- End custom js for this page -->
</body>

</html>