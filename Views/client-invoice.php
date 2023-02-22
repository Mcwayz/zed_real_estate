<?php 
  require_once "includes/head.php"; 
  include_once "../Database/database_connection.php";
  include_once "../Controllers/clientController.php";
  include_once "../Models/Client.php";
  $client = new Client(); 
  $id = $_GET['id'];
  $properties = $client->getTransaction($id);
  $row = $properties->fetch(PDO::FETCH_ASSOC);
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
              <div class="col">
                <h2 class="page-title">
                  Invoice
                </h2>
              </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
                  <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><rect x="7" y="13" width="10" height="8" rx="2" /></svg>
                  Print Invoice
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="page-body">
          <div class="container-xl">
            <div class="card card-lg">
              <div class="card-body">
                <div class="row">
                  <div class="col-6">
                    <p class="h3"><?=$row['Owner_Name']?></p>
                    <address>
                    <?=$row['owner_province']?><br>
                    <?=$row['owner_city']?>, <?=$row['owner_town']?><br>
                    </address>
                  </div>
                  <div class="col-6 text-end">
                    <p class="h3"><?= $_SESSION['firstname'],  $_SESSION['lastname']?></p>
                    <address>
                     <?=$_SESSION['phone_no']?>
                      Region, Postal Code<br>
                     <?=$_SESSION['email']?>
                    </address>
                  </div>
                  <div class="col-12 my-5">
                    <h1>Invoice <?=$row['txn_id']?></h1>
                  </div>
                </div>
                <table class="table table-transparent table-responsive">
                  <thead>
                    <tr>
                      <th class="text-center" style="width: 1%"></th>
                      <th>Property</th>
                      <th class="text-center" style="width: 1%">Property Type</th>
                      <th class="text-end" style="width: 1%">Set Price</th>
                      <th class="text-end" style="width: 1%">Amount Paid</th>
                    </tr>
                  </thead>
                  <tr>
                    <td class="text-center"><?=$row['id']?></td>
                    <td>
                      <p class="strong mb-1"><?=$row['property_type']?></p>
                      <div class="text-muted"><?=$row['property_details']?></div>
                    </td>
                    <td class="text-center">
                    <?=$row['id']?>
                    </td>
                    <td class="text-end"><?=$row['property_amount']?>/td>
                    <td class="text-end"><?=$row['amount']?>/td>
                  </tr>

                  <tr>
                    <td colspan="4" class="strong text-end">Subtotal</td>
                    <td class="text-end"><?=$row['property_amount']?></td>
                  </tr>
                  <tr>
                    <td colspan="4" class="strong text-end">Vat Rate</td>
                    <td class="text-end">0%</td>
                  </tr>
                  <tr>
                    <td colspan="4" class="strong text-end">Vat Due</td>
                    <td class="text-end">$5.000,00</td>
                  </tr>
                  <tr>
                    <td colspan="4" class="font-weight-bold text-uppercase text-end">Total Amount</td>
                    <td class="font-weight-bold text-end"><?=$row['property_amount']?></td>
                  </tr>
                </table>
                <p class="text-muted text-center mt-5">Thank you very much for doing business with us. We look forward to working with
                  you again!</p>
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