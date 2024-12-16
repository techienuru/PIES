<?php
session_start();
include_once "../includes/connect.php";
include_once "../includes/classes/admin.php";

$object = new notification($connect);

$object->collectUserID();

if (isset($_POST["send_notification"])) {
  $object->collectInputs();
  $object->insertIntoDB();
}

if (isset($_POST["delete_notification"])) {
  $object->deleteNotification();
}

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
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

  <style>
    body {
      background-color: #f4f6f9;
      font-family: 'Poppins', sans-serif;
    }

    .container {
      margin-top: 50px;
    }

    .card {
      border: none;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 15px;
    }

    .card-header {
      background: linear-gradient(135deg, #28a745, #218838);
      color: white;
      font-weight: 600;
      border-radius: 15px 15px 0 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .btn-send {
      background-color: #17a2b8;
      color: white;
    }

    .btn-send:hover {
      background-color: #138496;
    }

    .notification-list {
      max-height: 300px;
      overflow-y: auto;
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
                  <div class="container">
                    <div class="card">
                      <div class="card-header">
                        <h4>Notifications Management</h4>
                        <button class="btn btn-send" data-toggle="modal" data-target="#sendNotificationModal">
                          Send Notification
                        </button>
                      </div>

                      <div class="card-body">
                        <h5 class="mb-3">Sent Notifications</h5>
                        <div class="notification-list">
                          <ul class="list-group">
                            <?php
                            $sql = $object->selectNotificationsForAll();
                            while ($row = $sql->fetch_assoc()) {
                            ?>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo $row["title"] ?> - All Pensioner
                                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                                  <input type="hidden" name="notification_id" value="<?php echo $row["notification_id"] ?>">
                                  <button type="submit" name="delete_notification" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i> Remove
                                  </button>
                                </form>
                              </li>
                            <?php } ?>

                            <?php
                            $sql = $object->selectNotificationsForPensioner();
                            while ($row = $sql->fetch_assoc()) {
                            ?>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?php echo $row["title"] ?> - <?php echo $object->fetchPassesPensionerName($row["send_to"]) ?>
                                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                                  <input type="hidden" name="notification_id" value="<?php echo $row["notification_id"] ?>">
                                  <button type="submit" name="delete_notification" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i> Remove
                                  </button>
                                </form>
                              </li>
                            <?php } ?>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Send Notification Modal -->
                  <div class="modal fade" id="sendNotificationModal" tabindex="-1" aria-labelledby="sendNotificationModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="sendNotificationModalLabel">Send Notification</h5>
                          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                            <div class="mb-3">
                              <label for="notificationTitle" class="form-label">Title</label>
                              <input type="text" name="title" class="form-control" id="notificationTitle" required>
                            </div>
                            <div class="mb-3">
                              <label for="notificationMessage" class="form-label">Message</label>
                              <textarea class="form-control" name="message" id="notificationMessage" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                              <label for="pensionerSelect" class="form-label">Send To</label>
                              <select id="pensionerSelect" name="send_to" class="form-control" required>
                                <option value="0">All Pensioners</option>
                                <?php
                                $sql = $object->selectPensioner();
                                while ($row = $sql->fetch_assoc()) {
                                ?>
                                  <option value="<?php echo $row["pensioner_id"] ?>">
                                    <?php echo $row["fullname"] ?>
                                  </option>
                                <?php } ?>
                              </select>
                            </div>
                            <button type="submit" name="send_notification" class="btn btn-primary w-100">Send Notification</button>
                          </form>
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