<?php
session_start();
include_once "../includes/connect.php";
include_once "../includes/classes/user.php";

$object = new notification($connect);

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
      padding: 15px 0;
      display: flex;
      flex-direction: column;
    }

    .notification-item:last-child {
      border-bottom: none;
    }

    .notification-title {
      font-weight: 500;
      cursor: pointer;
      font-size: 1.1rem;
    }

    .notification-date {
      font-size: 0.85rem;
      color: #6c757d;
      margin-top: 5px;
    }

    .no-notifications {
      text-align: center;
      padding: 20px;
      font-size: 1.25rem;
      color: #6c757d;
    }

    .notification-item:hover {
      background-color: #f1f3f5;
      border-radius: 5px;
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
                      <div class="card">
                        <div class="card-header">
                          <h4>All Notifications</h4>
                        </div>
                        <div class="card-body">
                          <div id="notificationsList">

                            <?php
                            $sql = $object->selectNotificationsForAll();
                            while ($row = $sql->fetch_assoc()) {
                            ?>
                              <div class="notification-item">
                                <div class="notification-title">Reminder: <?php echo $row["title"] ?></div>
                                <div class="notification-date">Message: <?php echo $row["message"] ?></div>
                                <div class="notification-date">To: All Pensioner</div>
                                <div class="notification-date">Date: <?php echo $row["date_created"] ?></div>
                              </div>
                            <?php } ?>
                            <?php
                            $sql = $object->selectNotificationsForPensioner();
                            while ($row = $sql->fetch_assoc()) {
                            ?>
                              <div class="notification-item">
                                <div class="notification-title">Reminder: <?php echo $row["title"] ?></div>
                                <div class="notification-date">Message: <?php echo $row["message"] ?></div>
                                <div class="notification-date">To: <?php echo $object->fullname; ?></div>
                                <div class="notification-date">Date: <?php echo $row["date_created"] ?></div>
                              </div>
                            <?php } ?>


                          </div>

                          <!-- Fallback message if no notifications exist -->
                          <div id="noNotifications" class="no-notifications d-none">
                            No notifications to display.
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
    <script>
      // Example logic to show/hide "No notifications" message
      const notificationsList = document.getElementById('notificationsList');
      const noNotifications = document.getElementById('noNotifications');

      if (notificationsList.children.length === 0) {
        noNotifications.classList.remove('d-none');
      } else {
        noNotifications.classList.add('d-none');
      }
    </script>
</body>

</html>