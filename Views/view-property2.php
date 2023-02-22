<?php require_once "includes/head.php"; ?>
<?php 
  include_once "../Database/database_connection.php";
  include_once "../Controllers/clientController.php";
  include_once "../Models/Client.php";
  $client = new Client(); 
  $properties = $client->getProperties();
?>
  <body >
    <div class="wrapper">
      <?php require_once "includes/header.php"; ?>
      <!--Nav-bar-->
      <?php require_once "includes/nav-bar-client.php"; ?>
      <!--Nav-bar-->
      <div class="page-wrapper">
        <div class="container-xl">
          <!-- Page title -->
          <div class="page-header d-print-none">
            <div class="row align-items-center">
            </div>
          </div>
        </div>
        <div class="page-body">
          <div class="container-xl">
            <div class="row gx-lg-4">
              <div class="col-lg-9">
                <div class="card">
                  <div id="carousel-controls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img class="d-block w-100" alt="" src="./static/photos/75b555b99d5b38c4.jpg">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" alt="" src="./static/photos/546fd146c83f428c.jpg">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" alt="" src="./static/photos/802a16cdf5ce3551.jpg">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" alt="" src="./static/photos/0986f97be719fb9a.jpg">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" alt="" src="./static/photos/1194d63fe36a8670.jpg">
                      </div>
                    </div>
                    <a class="carousel-control-prev" href="#carousel-controls" role="button" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-controls" role="button" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </a>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-6">
                        <div class="row g-3 align-items-center">
                          <a href="#" class="col-auto">
                            <span class="avatar" style="background-image: url(./static/avatars/000m.jpg)">
                              <span class="badge bg-red"></span></span>
                          </a>
                          <div class="col text-truncate">
                            <a href="#" class="text-body d-block text-truncate">Paweł Kuna</a>
                            <small class="text-muted text-truncate mt-n1">2 days ago</small>
                          </div>
                        </div>
                      </div>
                      <div class="col-6 ">
                        <div class="row justify-content-end">
                          <div class="col-md-6">
                            <div class="float-end mt-2 pt-1">
                              <a href="#" class="btn btn-twitter">
                                <!-- Download SVG icon from http://tabler-icons.io/i/cash -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="7" y="9" width="14" height="10" rx="2" /><circle cx="14" cy="14" r="2" /><path d="M17 9v-2a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h2" /></svg>
                                  Make Payment
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <br>
                    <h2 class="page-title">
                      Postname
                    </h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt, iste, itaque minima
                       neque pariatur perferendis sed suscipit velit vitae voluptatem.</p>
                  </div>
                      <div class="card">
                        <div class="card-body">
                          <h3>Comments</h3>
                          <div class="d-flex flex-start align-items-center">
                            <img class="rounded-circle shadow-1-strong me-3"
                              src="./static/avatars/017f.jpg" alt="avatar" width="60"
                              height="60" />
                          <div>
                          <h6 class="fw-bold text-primary mb-1">Lily Coleman</h6>
                          <p class="text-muted small mb-0">
                            Shared publicly - Jan 2020
                          </p>
                        </div>
                      </div>
                      <p class="mt-3 mb-4 pb-2">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip consequat.
                      </p>
                      <div class="small d-flex justify-content-start">
                        <a href="#!" class="d-flex align-items-center me-3">
                          <i class="far fa-thumbs-up me-2"></i>
                          <p class="mb-0">Like</p>
                        </a>
                        <a href="#!" class="d-flex align-items-center me-3">
                          <i class="far fa-comment-dots me-2"></i>
                          <p class="mb-0">Comment</p>
                        </a>
                        <a href="#!" class="d-flex align-items-center me-3">
                          <i class="fas fa-share me-2"></i>
                          <p class="mb-0">Share</p>
                        </a>
                      </div>
                    </div>
                    <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                      <div class="d-flex flex-start w-100">
                        <img class="rounded-circle shadow-1-strong me-3"
                          src="./static/avatars/017f.jpg" alt="avatar" width="40"
                            height="40" />
                        <div class="form-outline w-100">
                          <textarea class="form-control" id="textAreaExample" rows="4"
                            style="background: #fff;"></textarea>
                          <label class="form-label" for="textAreaExample">Message</label>
                        </div>
                      </div>
                      <div class="float-end mt-2 pt-1">
                        <button type="button" class="btn btn-primary btn-sm">Post comment</button>
                        <button type="button" class="btn btn-outline-primary btn-sm">Cancel</button>
                      </div>
                  </div>
                </div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">Advertising</h3>
                  </div>
                    <div id="carousel-controls" class="carousel slide" data-bs-ride="carousel">
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img class="d-block w-100" alt="" src="./static/photos/75b555b99d5b38c4.jpg">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" alt="" src="./static/photos/546fd146c83f428c.jpg">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" alt="" src="./static/photos/802a16cdf5ce3551.jpg">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" alt="" src="./static/photos/0986f97be719fb9a.jpg">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" alt="" src="./static/photos/1194d63fe36a8670.jpg">
                          <div class="carousel-caption">
                            <h3>What we do</h3>
                        </div>
                        </div>
                      </div>
                      <a class="carousel-control-prev" href="#carousel-controls" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                      </a>
                       <a class="carousel-control-next" href="#carousel-controls" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                      </a>
                    </div>
                </div>
              </div>
              <br>
              <div class="col-lg-9" style="margin-top: 1.25rem;">
                <h3>Copperbelt Range Property</h3>
                <div class="card">
                  <div class="row row-0">
                    <div class="col-3">
                      <img src="./static/photos/2854fd67ddbd6217.jpg" class="w-100 h-100 object-cover" alt="Card side image">
                    </div>
                    <div class="col">
                      <div class="card-body">
                        <h3 class="card-title">Card with left side image</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt, iste, itaque minima
                          neque pariatur perferendis sed suscipit velit vitae voluptatem.</p>
                      </div>
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
                  <li class="list-inline-item"><a href="./docs/index.html" class="link-secondary">Documentation</a></li>
                  <li class="list-inline-item"><a href="./license.html" class="link-secondary">License</a></li>
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
                    <a href="." class="link-secondary">Tabler</a>.
                    All rights reserved.
                  </li>
                  <li class="list-inline-item">
                    <a href="./changelog.html" class="link-secondary" rel="noopener">
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
    <script src="./dist/js/tabler.min.js"></script>
    <script src="./dist/js/demo.min.js"></script>
  </body>
</html>