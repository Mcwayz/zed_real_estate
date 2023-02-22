<?php require_once "includes/head.php"; ?>
  <body >
    <div class="wrapper">
      <?php require_once "includes/header.php"; ?>
      <!--Nav-bar-->
      <?php require_once "includes/nav-bar.php"; ?>    
      <div class="page-wrapper">
        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
              <div class="col">
                <h2 class="page-title">
                  Settings
                </h2>
              </div>
            </div>
          </div>
        </div>
        <div class="page-body">
          <div class="container-xl">
            <div class="row gx-lg-4">
            <?php require_once "includes/menu.php"; ?>   
              <div class="col-lg-9">
                <div class="card card-lg">
                  <div class="card-body">
                    <div class="markdown">
                      <div class="row">
                        <div class="col-9 d-flex mb-3">
                          <h1 class="m-0">My Profile</h1>
                        </div>
                        <div class="col-3 d-flex mb-3">
                          <img src="../static/logo.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
                        </div>
                      </div>
                      <form  >
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="mb-3 col-md-6">
                                  <label class="form-label">First Name</label>
                                  <input type="text" class="form-control" name="example-text-input" placeholder="Enter First Name">
                                </div>
                                <div class="mb-3 col-md-6">
                                  <label class="form-label">Last Name</label>
                                  <input type="text" class="form-control" name="example-text-input" placeholder="Enter Last Name">
                                </div>
                              </div>
                              <div class="row">
                                <div class="mb-3 col-md-6">
                                  <label class="form-label">Middle Name</label>
                                  <input type="text" class="form-control" name="example-text-input" placeholder="Enter Middle Name">
                                </div>
                                <div class="mb-3 col-md-6">
                                  <label class="form-label">Phone Number</label>
                                  <input type="phone" class="form-control" name="example-text-input" placeholder="Enter Phone Number">
                                </div>
                              </div>
                              <hr>
                              <div class="row">
                                <div class="mb-3 col-md-6">
                                  <label class="form-label">Email</label>
                                  <input type="text" class="form-control" name="example-text-input" placeholder="Enter Email">
                                </div>
                                <div class="mb-3 col-md-6">
                                  <label class="form-label">NRC/Passport</label>
                                  <input type="text" class="form-control" name="example-text-input" placeholder="Enter NRC or Passport">
                                </div>
                              </div>
                              <div class="row">
                                <div class="mb-3 col-md-6">
                                  <label class="form-label">DOB</label>
                                  <input type="date" class="form-control">
                                </div>
                              </div>
                              <hr>
                              <div class="row">
                                <div class="mb-3 col-md-6">
                                  <label class="form-label">Address</label>
                                  <input type="text" class="form-control" name="example-text-input" placeholder="Enter NRC">
                                </div>
                                <div class="mb-3 col-md-6">
                                  <label class="form-label">City</label>
                                  <select class="form-select">
                                    <option>Select Title</option>
                                    <option value="Male">Mr</option>
                                    <option value="Female">Mrs</option>
                                    <option value="Female">Ms</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                                Cancel
                              </a>
                              <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                                Create new report
                              </a>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer class="footer footer-transparent d-print-none">
          <div class="container-xl">
            <div class="row text-center align-items-center flex-row-reverse">
              <div class="col-lg-auto ms-lg-auto">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item"><a href="../docs/index.html" class="link-secondary">Documentation</a></li>
                  <li class="list-inline-item"><a href="../license.html" class="link-secondary">License</a></li>
                  <li class="list-inline-item"><a href="https://github.com/tabler/tabler" target="_blank" class="link-secondary" rel="noopener">Source code</a></li>
                  <li class="list-inline-item">
                    <a href="https://github.com/sponsors/codecalm" target="_blank" class="link-secondary" rel="noopener">
                      <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon text-pink icon-filled icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 13.572l-7.5 7.428l-7.5 -7.428m0 0a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                      Sponsor
                    </a>
                  </li>
                </ul>
              </div>
              <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item">
                    Copyright &copy; 2022
                    <a href=".." class="link-secondary">Tabler</a>.
                    All rights reserved.
                  </li>
                  <li class="list-inline-item">
                    <a href="../changelog.html" class="link-secondary" rel="noopener">
                      v1.0.0-beta5
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="../dist/js/tabler.min.js"></script>
    <script src="../dist/js/demo.min.js"></script>
  </body>
</html>