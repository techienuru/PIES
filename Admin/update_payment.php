<?php
session_start();
include_once "../includes/connect.php";
include_once "../includes/classes/admin.php";

$object = new update_payment($connect);

$object->collectUserID();

// If a User add Pension Info
if (isset($_POST["update_pensioneer_info"])) {
  $object->collectInputs();
  $object->insertIntoDB();
}

// If a User reset Pension Info
if (isset($_POST["reset_pensioner_info"])) {
  $object->resetPensionerInfo();
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
      text-align: center;
    }

    .table thead th {
      background-color: #007bff;
      color: white;
    }

    .btn-remove {
      background-color: #dc3545;
      color: white;
    }

    .btn-remove:hover {
      background-color: #c82333;
    }

    .btn-update {
      margin-top: 20px;
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
                        <h4>Update Pensioner Information</h4>
                      </div>
                      <div class="card-body">
                        <form id="updateForm" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                          <div class="mb-3">
                            <label for="pensionerSelect" class="form-label">Select Pensioner</label>
                            <select class="form-control" name="pensioner_id" id="pensionerSelect" required>

                              <option value="" disabled selected>Select a pensioner</option>
                              <?php
                              $sql = $object->selectPensioner();
                              while ($row = $sql->fetch_assoc()) {
                              ?>
                                <option value="<?php echo $row["pensioner_id"] ?>"><?php echo $row["fullname"] ?></option>
                              <?php } ?>
                            </select>
                          </div>


                          <div class="mb-3">
                            <label for="pensionerSalary" class="form-label">Salary</label>
                            <input type="number" class="form-control" name="salary" id="pensionerSalary" name="salary" required>
                          </div>

                          <div class="mb-3">
                            <label for="pensionerAllowance" class="form-label">Allowance</label>
                            <input type="number" class="form-control" name="allowance" id="pensionerAllowance" name="allowance" required>
                          </div>

                          <div class="mb-3">
                            <label class="form-label">Years Of Service</label>
                            <input type="number" class="form-control" name="years_of_service" max="35" name="years_of_service" placeholder="Maximum of 35 years" required>
                          </div>

                          <div class="text-center">
                            <button type="submit" name="update_pensioneer_info" class="btn btn-primary">Update Pensioner Information</button>
                          </div>
                        </form>

                        <hr class="my-4">

                        <h5 class="mt-4">Registered Pensioners</h5>
                        <table class="table table-bordered mt-2">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Salary</th>
                              <th>Allowance</th>
                              <th>Years Of Service</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody id="pensionerList">
                            <?php
                            $sql = $object->selectPensioner();
                            $number = 1;
                            while ($row = $sql->fetch_assoc()) {
                            ?>
                              <tr>
                                <td><?php echo $row["pensioner_id"] ?></td>
                                <td><?php echo $row["fullname"] ?></td>
                                <td><?php echo $object->resetDataToDash($row["salary"]) ?></td>
                                <td><?php echo $object->resetDataToDash($row["allowance"]) ?></td>
                                <td><?php echo $object->resetDataToDash($row["years_of_service"]) ?></td>
                                <td>
                                  <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                                    <input type="hidden" name="pensioner_id" value="<?php echo $row["pensioner_id"] ?>">
                                    <button type="submit" name="reset_pensioner_info" class="btn btn-remove">Reset</button>
                                  </form>
                                </td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>
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