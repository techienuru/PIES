<?php
session_start();
include_once "../includes/connect.php";
include_once "../includes/classes/user.php";

$object = new dashboard($connect);

$object->collectUserID();
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
      background-color: #f8f9fa;
      font-family: 'Poppins', sans-serif;
    }

    .container {
      margin-top: 50px;
    }

    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-header {
      background: linear-gradient(135deg, #007bff, #0056b3);
      color: white;
      font-weight: 600;
      border-radius: 15px 15px 0 0;
    }

    .notification-item {
      border-bottom: 1px solid #e9ecef;
      padding: 10px 0;
    }

    .notification-item:last-child {
      border-bottom: none;
    }

    .notification-title {
      font-weight: 500;
    }

    .notification-date {
      font-size: 0.85rem;
      color: #6c757d;
    }

    .view-all-btn {
      background-color: #007bff;
      color: white;
      text-decoration: none;
    }

    .view-all-btn:hover {
      background-color: #0056b3;
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
        <li class="pt-2 pb-1">
          <span class="nav-item-head">Pages</span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./dashboard.php">
            <i class="mdi mdi-compass-outline menu-icon"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./notifications.php">
            <i class="mdi mdi-compass-outline menu-icon"></i>
            <span class="menu-title">Notifications</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./payments_history.php">
            <i class="mdi mdi-compass-outline menu-icon"></i>
            <span class="menu-title">Payment History</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="./profile.php">
            <i class="mdi mdi-compass-outline menu-icon"></i>
            <span class="menu-title">Profile</span>
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
                  <div class="container">

                    <div class="container">
                      <div class="card mb-4">
                        <div class="card-header">
                          <h4>Your Pension Overview</h4>
                        </div>
                        <div class="card-body">
                          <h5 class="mb-3">Pension Details</h5>
                          <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Total Pension Savings
                              <span class="badge bg-primary rounded-pill text-white">
                                ₦<?php echo $object->calculatePensionSavings(); ?>
                              </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Total Earnings (Salary + Allowance)
                              <span class="badge bg-secondary rounded-pill">
                                ₦<?php echo $object->total_earnings; ?>
                              </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Current Years Of Service
                              <span class="badge bg-success rounded-pill">
                                <?php echo $object->years_of_service; ?> years
                              </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Status
                              <span class="badge bg-warning text-dark rounded-pill">
                                <?php echo $object->status; ?>
                              </span>
                            </li>
                          </ul>
                        </div>
                      </div>

                      <div class="card">
                        <div class="card-header">
                          <h4>Recent Notifications</h4>
                        </div>
                        <div class="card-body">
                          <?php
                          $sql = $object->selectNotificationsForAllwithLimit();
                          while ($row = $sql->fetch_assoc()) {
                          ?>
                            <div class="notification-item">
                              <div class="notification-title">Reminder: <?php echo $row["title"] ?></div>
                              <div class="notification-date"><?php echo $row["date_created"] ?></div>
                            </div>
                          <?php } ?>
                          <?php
                          $sql = $object->selectNotificationsForPensionerwithLimit();
                          while ($row = $sql->fetch_assoc()) {
                          ?>
                            <div class="notification-item">
                              <div class="notification-title">Reminder: <?php echo $row["title"] ?></div>
                              <div class="notification-date"><?php echo $row["date_created"] ?></div>
                            </div>
                          <?php } ?>

                          <div class="text-center mt-3">
                            <a href="./notifications.php" class="btn view-all-btn">View All Notifications</a>
                          </div>
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
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Pension Information system 2024</span>

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