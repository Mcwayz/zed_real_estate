<?php 
  session_start();
  include_once '../Database/database_connection.php';
  include_once '../Controllers/ownerController.php';
  include_once '../Models/Session.php';
  include_once '../Models/Owner.php';
  $session = new Session();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Sign up - Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title>
    <!-- CSS files -->
    <link href="./dist/css/tabler.min.css" rel="stylesheet"/>
    <link href="./dist/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="./dist/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="./dist/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="./dist/css/demo.min.css" rel="stylesheet"/>
  </head>
  <body class=" border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
      <div class="container-tight py-4">
        <div class="text-center mb-4">
          <a href="." class="navbar-brand navbar-brand-autodark"><img src="./static/logo.svg" height="36" alt=""></a>
        </div>
        <form class="card card-md" method="POST" enctype="multipart/form-data">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Propery Owner Onboarding</h2>
            <div class="row">
              <div class="col-12 col-lg-6">
                <div class="mb-3">
                  <label class="form-label">NRC</label>
                  <input type="text" class="form-control" name="nrc-no" placeholder="Enter NRC Number">
                </div>
              </div>
              <div class="col-12 col-lg-6">
                <div class="mb-3">
                  <label class="form-label">NRC Attachments</label>
                  <input type="file" class="form-control" name="nrc_att">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" value="<?=$_SESSION['email']?>" placeholder="Enter email address" readonly>
                </div>
              </div>
              <div class="col-12 col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Proof of Residence</label>
                  <input type="file" class="form-control" name="proof">
                </div>
              </div>
            </div>
            <div class="hr-text">Your Location</div>      
            <div class="row">
              <div class="col-12 col-lg-6">
                <div class="mb-3">
                <label class="form-label">Province</label>
                  <select class="form-select" name="province" id="">
                    <option>Select</option>
                    <option value="Eastern Province">Eastern Province</option>
                    <option value="Lusaka Province">Lusaka Province</option>
                    <option value="Central Province">Centrol Province</option>
                    <option value="Western Province">Western Province</option>
                    <option value="Copperbelt Province">Copperbelt Province</option>
                    <option value="Southern Province">Southern Province</option>
                    <option value="Luapula Province">Luapula Province</option>
                    <option value="Muchinga Province">Muchinga Province</option>
                    <option value="Northern Province">Northern Province</option>
                    <option value="North-Western Province">North-Western Province</option>
                  </select>
                </div>
              </div>
              <div class="col-12 col-lg-6">
                <div class="mb-3">
                  <label class="form-label">City</label>
                  <select class="form-select" name="city" id="">
                    <option>Select</option>
                    <option value="Chipata">Chipata</option>
                    <option value="Lusaka">Lusaka</option>
                    <option value="Kabwe">Kabwe</option>
                    <option value="Ndola">Ndola</option>
                    <option value="Kitwe">Kitwe</option>
                    <option value="Livingstone">Livingstone</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label class="form-label">Town</label>
                <input type="text" class="form-control" name="town" placeholder="Enter Town">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-check">
                <input type="checkbox" class="form-check-input"/>
                <span class="form-check-label">Agree the <a href="./terms-of-service.html" tabindex="-1">terms and policy</a>.</span>
              </label>
            </div>
            <div class="form-footer">
              <input type="submit" name="add-owner" value="Complete Profile" class="btn btn-primary w-100">
            </div>
          </div>
        </form>
        <div class="text-center text-muted mt-3">
          I Need a Client Account? <a href="client-sign-up.php" tabindex="-1">Sign Up Here</a>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js"></script>
    <script src="./dist/js/demo.min.js"></script>
  </body>
</html>