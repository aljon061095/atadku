<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<?php include 'includes/header.php' ?>

<body>
   <?php include "includes/preloader.php"; ?>
   <div id="main-wrapper">
      <?php include 'includes/navbar.php' ?>
      <div class="content-body" style="margin-left: -5px;">
         <div class="container-fluid">
            <div class="row">
               <section class="container mt-5">
                  <div class="row page-titles mx-0">
                     <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                           <h4><i class="mdi mdi-phone"></i> Contact Us</h4>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12 mb-4 col-md-5">
                        <!--Form with header-->
                        <div class="card border-primary rounded-0">
                           <div class="card-header d-block p-0">
                              <div class="bg-primary text-white text-center py-2">
                                 <h3><i class="fa fa-envelope"></i> Write to us:</h3>
                                 <p class="m-0">We’ll write rarely, but only the best content.</p>
                              </div>
                           </div>
                           <div class="card-body p-3">
                              <div class="form-group">
                                 <label>Name</label>
                                 <div class="input-group">
                                    <input value="" type="text" name="data[name]" class="form-control" id="inlineFormInputGroupUsername" placeholder="Your name">
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label>Email Address</label>
                                 <div class="input-group mb-2 mb-sm-0">
                                    <input type="email" value="" name="data[email]" class="form-control" id="inlineFormInputGroupUsername" placeholder="Email">
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label>Subject</label>
                                 <div class="input-group mb-2 mb-sm-0">
                                    <input type="text" name="data[subject]" class="form-control" id="inlineFormInputGroupUsername" placeholder="Subject">
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label>Message</label>
                                 <div class="input-group mb-2 mb-sm-0">
                                    <input type="text" class="form-control" name="mesg">
                                 </div>
                              </div>
                              <div class="text-center">
                                 <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-block rounded-0 py-2">
                              </div>

                           </div>

                        </div>
                     </div>
                     <!--Grid column-->

                     <!--Grid column-->
                     <div class="col-sm-12 col-md-7">
                        <!--Google map-->
                        <div class="mb-4">
                           <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7702.87967015572!2d120.58468653488768!3d15.134170799999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sph!4v1665913019472!5m2!1sen!2sph" width="700" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <!--Buttons-->
                        <div class="row text-center">
                           <div class="col-md-4">
                              <a class="bg-primary px-3 py-2 rounded text-white mb-2 d-inline-block"><i class="mdi mdi-home-outline"></i></a>
                              <p> Your Address ….. </p>
                           </div>
                           <div class="col-md-4">
                              <a class="bg-primary px-3 py-2 rounded text-white mb-2 d-inline-block"><i class="mdi mdi-cellphone"></i></a>
                              <p>+91- 90000000</p>
                           </div>
                           <div class="col-md-4">
                              <a class="bg-primary px-3 py-2 rounded text-white mb-2 d-inline-block"><i class="mdi mdi-email"></i></a>
                              <p> your@gmail.com</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </section>
            </div>
         </div>
      </div>
   </div>

   <?php include 'includes/footer.php' ?>

   <!--**********************************
        Scripts
    ***********************************-->
   <!-- Required vendors -->
   <script src="vendor/global/global.min.js"></script>
   <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
   <script src="vendor/chart.js/Chart.bundle.min.js"></script>
   <script src="js/custom.min.js"></script>
   <script src="js/deznav-init.js"></script>
   <!-- Apex Chart -->
   <script src="vendor/apexchart/apexchart.js"></script>

   <script src="vendor/highlightjs/highlight.pack.min.js"></script>
   <!-- Circle progress -->
</body>

</html>