<?php 
  include_once '../Database/database_connection.php';
  include_once '../Controllers/authController.php';
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
        <form class="card card-md" method="POST">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Create new account</h2>
            <div class="row">
              <div class="col-12 col-lg-6">
                <div class="mb-3">
                  <label class="form-label">First Name</label>
                  <input type="text" class="form-control" name="firstname" placeholder="Enter First Name" required>
                </div>
              </div>
              <div class="col-12 col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Last Name</label>
                  <input type="text" class="form-control" name="lastname" placeholder="Enter Last Name" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Phone Number</label>
                  <input type="phone" class="form-control" name="phonenumber" placeholder="Enter Phone Number" required>
                </div>
              </div>
              <div class="col-12 col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Email address</label>
                  <input type="email" class="form-control" name="email" placeholder="Enter email" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Password</label>
                  <div class="input-group input-group-flat">
                    <input type="password" class="form-control" name="pass" placeholder="Password" autocomplete="off" required>
                    <span class="input-group-text">
                      <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="2" /><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" /></svg>
                      </a>
                    </span>
                  </div>
                </div>
              </div>
              <div class="col-12 col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Confirm Password</label>
                  <div class="input-group input-group-flat">
                    <input type="password" class="form-control" name="con_pass" placeholder="Confirm Password" autocomplete="off" required>
                    <span class="input-group-text">
                      <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="2" /><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" /></svg>
                      </a>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-check">
                <input type="checkbox" class="form-check-input"/>
                <span class="form-check-label">Agree the <a href="#" tabindex="-1">terms and policy</a>.</span>
              </label>
            </div>
            <div class="form-footer">
              <input type="submit" name="register-user" class="btn btn-primary w-100" value="Create new account" >
            </div>
          </div>
        </form>
        <div class="text-center text-muted mt-3">
          Already have account? <a href="sign-in.php" tabindex="-1">Sign in</a>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js"></script>
    <script src="./dist/js/demo.min.js"></script>
  </body>
</html>