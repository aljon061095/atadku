<?php
// Include config file
require_once "includes/config.php";

$valid_type_sql = "SELECT * FROM valid_id_type";
$result = mysqli_query($link, $valid_type_sql);
$valid_id_types = $result->fetch_all(MYSQLI_ASSOC);

//register as a customer
if (isset($_POST['register'])) {
  $profile = strtotime(date('y-m-d H:i')) . '_' . $_POST['full_name'];
  $full_name = $_POST['full_name'];
  $address = $_POST['address'];
  $number = $_POST['number'];
  $email_address = $_POST['email_address'];
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $id_type = $_POST['id_type'];
  $valid_id = strtotime(date('y-m-d H:i')) . '_' . $_POST['full_name'];
  //additional field for owner
  $user_type = $_POST['user_type'];
  $owner_name = $_POST['owner_name'];
  $business_permit = strtotime(date('y-m-d H:i')) . '_' . $_POST['full_name'];
  $tin = $_POST['tin'];
  $status = 1;

  if (array_key_exists('profile', $_FILES)) {
    if ($_FILES['profile']['tmp_name'] != '') {
      $filename = 'profile' . '_' . strtotime(date('y-m-d H:i')) . '_' . basename($_FILES['profile']['name']);
      $move = move_uploaded_file($_FILES['profile']['tmp_name'], 'uploads/' . $filename);

      if ($move) {
        $profile = $filename;
      }
    }
  }

  if (array_key_exists('business_permit', $_FILES)) {
    if ($_FILES['business_permit']['tmp_name'] != '') {
      $filename = 'logo' . '_' . strtotime(date('y-m-d H:i')) . '_' . basename($_FILES['business_permit']['name']);
      $move = move_uploaded_file($_FILES['business_permit']['tmp_name'], 'uploads/' . $filename);

      if ($move) {
        $business_permit = $filename;
      }
    }
  }

  if (array_key_exists('valid_id', $_FILES)) {
    if ($_FILES['valid_id']['tmp_name'] != '') {
      $filename = 'valid_id' . '_' . strtotime(date('y-m-d H:i')) . '_' . basename($_FILES['valid_id']['name']);
      $move = move_uploaded_file($_FILES['valid_id']['tmp_name'], 'uploads/' . $filename);

      if ($move) {
        $valid_id = $filename;
      }
    }
  }

  $query = "INSERT INTO user_list(full_name, profile, email_address, owner_name, tin, business_permit, id_type, valid_id, address, username, password, user_type, status)
            VALUES ('$full_name', '$profile', '$email_address', '$owner_name', '$tin', '$business_permit', '$id_type', '$valid_id', '$address', '$username', '$password', '$user_type', '$status')";
  $query_run = mysqli_query($link, $query);

  if ($query_run) {
    $item_id = $link->insert_id;
    $query = "INSERT INTO images(item_id, file_name) VALUES ('$item_id', '$profile')";
    $query_run = mysqli_query($link, $query);
    $_SESSION['success_status'] = "You have successfully registered as a new user.";
  }
}


//register as a customer
if (isset($_POST['register_customer'])) {
  $profile = strtotime(date('y-m-d H:i')) . '_' . $_POST['full_name'];
  $full_name = $_POST['full_name'];
  $address = $_POST['address'];
  $number = $_POST['number'];
  $email_address = $_POST['email_address'];
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $id_type = $_POST['id_type'];
  $valid_id = strtotime(date('y-m-d H:i')) . '_' . $_POST['full_name'];;
  $status = 1;

  if (array_key_exists('profile', $_FILES)) {
    if ($_FILES['profile']['tmp_name'] != '') {
      $filename = 'customer_profile' . '_' . strtotime(date('y-m-d H:i')) . '_' . basename($_FILES['profile']['name']);
      $move = move_uploaded_file($_FILES['profile']['tmp_name'], 'uploads/' . $filename);

      if ($move) {
        $profile = $filename;
      }
    }
  }

  $query = "INSERT INTO customer(profile, full_name, address, number, email_address, username, password, id_type, valid_id, status)
            VALUES ('$profile', '$full_name', '$address', '$number', '$email_address', '$username', '$password', '$id_type', '$valid_id',  '$status')";
  $query_run = mysqli_query($link, $query);

  if ($query_run) {
    $item_id = $link->insert_id;
    $query = "INSERT INTO images(item_id, file_name) VALUES ('$item_id', '$profile')";
    $query_run = mysqli_query($link, $query);
    $_SESSION['success_status'] = "You have successfully registered as a new customer.";
  }
}

//register as a owner
if (isset($_POST['register_owner'])) {
  $name = $_POST['name'];
  $logo = strtotime(date('y-m-d H:i')) . '_' . $_POST['name'];
  $owner_name = $_POST['owner_name'];
  $tin = $_POST['tin'];
  $id_type = $_POST['id_type'];
  $valid_id = strtotime(date('y-m-d H:i')) . '_' . $_POST['name'];
  $business_permit = strtotime(date('y-m-d H:i')) . '_' . $_POST['name'];
  $address = $_POST['address'];
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $type = $_POST['type'];
  $status = 1;

  if (array_key_exists('logo', $_FILES)) {
    if ($_FILES['logo']['tmp_name'] != '') {
      $filename = 'logo' . '_' . strtotime(date('y-m-d H:i')) . '_' . basename($_FILES['logo']['name']);
      $move = move_uploaded_file($_FILES['logo']['tmp_name'], 'uploads/' . $filename);

      if ($move) {
        $logo = $filename;
      }
    }
  }

  if (array_key_exists('business_permit', $_FILES)) {
    if ($_FILES['business_permit']['tmp_name'] != '') {
      $filename = 'logo' . '_' . strtotime(date('y-m-d H:i')) . '_' . basename($_FILES['business_permit']['name']);
      $move = move_uploaded_file($_FILES['business_permit']['tmp_name'], 'uploads/' . $filename);

      if ($move) {
        $business_permit = $filename;
      }
    }
  }

  if (array_key_exists('valid_id', $_FILES)) {
    if ($_FILES['valid_id']['tmp_name'] != '') {
      $filename = 'valid_id' . '_' . strtotime(date('y-m-d H:i')) . '_' . basename($_FILES['valid_id']['name']);
      $move = move_uploaded_file($_FILES['valid_id']['tmp_name'], 'uploads/' . $filename);

      if ($move) {
        $valid_id = $filename;
      }
    }
  }

  $query = "INSERT INTO $type(name, logo, owner_name, tin, address, username, password, id_type, valid_id, business_permit, status)
            VALUES ('$name', '$logo', '$owner_name', '$tin', '$address', '$username', '$password', '$id_type', '$valid_id', '$business_permit', '$status')";
  $query_run = mysqli_query($link, $query);

  if ($query_run) {
    $item_id = $link->insert_id;
    $query = "INSERT INTO images(item_id, file_name) VALUES ('$item_id', '$logo')";
    $query_run = mysqli_query($link, $query);
    $_SESSION['success_status'] = "You have successfully registered as a new $type owner.";
  }
}

//register as a driver
if (isset($_POST['register_driver'])) {
  $profile = strtotime(date('y-m-d H:i')) . '_' . $_POST['full_name'];
  $full_name = $_POST['full_name'];
  $address = $_POST['address'];
  $email = $_POST['email_address'];
  $number = $_POST['number'];
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $id_type = $_POST['id_type'];
  $valid_id = strtotime(date('y-m-d H:i')) . '_' . $_POST['full_name'];
  $status = 1;

  if (array_key_exists('profile', $_FILES)) {
    if ($_FILES['profile']['tmp_name'] != '') {
      $filename = 'driver_profile' . '_' . strtotime(date('y-m-d H:i')) . '_' . basename($_FILES['profile']['name']);
      $move = move_uploaded_file($_FILES['profile']['tmp_name'], 'uploads/' . $filename);

      if ($move) {
        $profile = $filename;
      }
    }
  }

  if (array_key_exists('valid_id', $_FILES)) {
    if ($_FILES['valid_id']['tmp_name'] != '') {
      $filename = 'valid_id' . '_' . strtotime(date('y-m-d H:i')) . '_' . basename($_FILES['valid_id']['name']);
      $move = move_uploaded_file($_FILES['valid_id']['tmp_name'], 'uploads/' . $filename);

      if ($move) {
        $valid_id = $filename;
      }
    }
  }

  $query = "INSERT INTO driver(profile, full_name, address, number, email_address, username, password, valid_id, id_type, status)
            VALUES ('$profile', '$full_name', '$address', '$number', '$email', '$username', '$password', '$valid_id', '$id_type', '$status')";
  $query_run = mysqli_query($link, $query);

  if ($query_run) {
    $item_id = $link->insert_id;
    $query = "INSERT INTO images(item_id, file_name) VALUES ('$item_id', '$profile')";
    $query_run = mysqli_query($link, $query);
    $_SESSION['success_status'] = "You have successfully registered as a new driver.";
  }
}
?>

<!DOCTYPE html>
<html lang="en" class="h-100">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<style>
  * {
    box-sizing: border-box;
  }

  body {
    background-color: #f1f1f1;
  }

  #regForm {
    background-color: #ffffff;
    margin: 100px auto;
    font-family: Raleway;
    padding: 40px;
    width: 70%;
    min-width: 300px;
  }

  h1 {
    text-align: center;
  }

  input {
    padding: 10px;
    width: 100%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa;
  }

  /* Mark input boxes that gets an error on validation: */
  input.invalid {
    background-color: #ffdddd;
  }

  /* Hide all steps by default: */
  .tab {
    display: none;
  }

  button {
    background-color: #04AA6D;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    font-size: 17px;
    font-family: Raleway;
    cursor: pointer;
  }

  button:hover {
    opacity: 0.8;
  }

  #prevBtn {
    background-color: #bbbbbb;
  }

  /* Make circles that indicate the steps of the form: */
  .step {
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbbbbb;
    border: none;
    border-radius: 50%;
    display: inline-block;
    opacity: 0.5;
  }

  .step.active {
    opacity: 1;
  }

  /* Mark the steps that are finished and valid: */
  .step.finish {
    background-color: #04AA6D;
  }
</style>

<?php include 'includes/header.php' ?>

<body style="background-image: url(images/avatar/registration_background.png); ">
  <div class="authincation">
    <div class="row">
      <div class="col-md-6 justify-content-left align-items-left mt-4 ml-4">
        <div class="authincation-content">
          <div class="row no-gutters">
            <div class="auth-form" style="padding: 20px 30px 0 30px;">
              <h4 class="text-center">Register an account</h4>
              <div class="row p-2">
                  <?php
                  if (isset($_SESSION['success_status'])) {
                  ?>
                    <div class="alert alert-success alert-dismissable">
                      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                      <?php echo $_SESSION['success_status']; ?>
                    </div>
                  <?php
                    unset($_SESSION['success_status']);
                  }
              ?>
              </div>
              <div class="row p-2">
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <div style="text-align:center;">
                  <span class="step"></span>
                  <span class="step"></span>
                </div>
                <div class="tab mt-2">
                  <div class="mt-2">
                  <label>Choose your user type:</label>
                    <div class="form-group">
                      <input type="radio" class="btn-check" name="user_type_radio" id="success-outlined" value="customer" autocomplete="off" checked>
                      <label class="btn btn-outline-success" style="margin: 10px;" for="success-outlined">Customer</label>
                        
                      <input type="radio" class="btn-check" name="user_type_radio" id="secondary-outlined" value="owner" autocomplete="off">
                      <label class="btn btn-outline-secondary" style="margin: 10px;" for="secondary-outlined">Store Owner</label>

                      <input type="radio" class="btn-check" name="user_type_radio" id="primary-outlined" value="driver" autocomplete="off">
                      <label class="btn btn-outline-primary" style="margin: 10px;" for="primary-outlined">Delivery Driver</label>
                    </div>

                    <div class="text-center">
                        <p>Already have an account? <a class="text-primary" href="login.php">Login</a></p>
                    </div>
                  </div>                  
                </div>
                <div class="tab">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="hidden" class="form-control" name="user_type" id="user_type_field">
                          <div class="form-floating">
                            <input type="file" class="form-control" name="profile" id="profile" placeholder="Profile" accept="image/*" required>
                            <label for="profile">Profile</label>
                          </div>
                          <small style="font-size: 12px;" class="text-muted">You must post a close-up photo of oneself; it cannot be a side or rear view.</small>
                        </div>
                        <div class="form-group">
                          <div class="form-floating">
                            <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name" required>
                            <label for="full_name">Full Name</label>
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="id_type" style="font-size: 12px;">Valid Id Type</label>
                            <select class="form-select" id="id_type" name="id_type" required>
                              <option selected value="">Choose your Id Type</option>
                              <?php foreach ($valid_id_types as $id_type) { ?>
                                <option value="<?php echo $id_type['id'] ?>"><?php echo $id_type['id_type'] ?></option>
                              <?php  } ?>
                            </select>
                        </div>
                        <div class="form-group">
                          <div class="form-floating">
                            <input type="file" class="form-control" name="valid_id" id="valid_id" placeholder="Valid Identification" required>
                            <label for="valid_id">Valid Identification</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <div class="form-floating">
                            <input type="number" class="form-control" name="number" id="number" placeholder="Contact Number" required>
                            <label for="number">Contact Number</label>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="form-floating">
                            <input type="email" class="form-control" name="email_address" id="email_address" placeholder="Email Address" required>
                            <label for="email_address">Email Address</label>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="form-floating">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                            <label for="username">Username</label>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="form-floating">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                            <label for="password">Password</label>
                          </div>
                        </div>
                        <div class="form-group owner-field">
                          <div class="form-floating">
                            <input type="text" class="form-control" name="address" id="address" placeholder="Address">
                            <label for="address">Address</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 mt-2 owner-field">
                          <div class="form-group">
                              <div class="form-floating">
                                  <input type="text" class="form-control" name="owner_name" id="owner_name" placeholder="TIN">
                                  <label for="tin">Owner's Name</label>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6 owner-field">
                        <div class="form-group">
                            <div class="form-floating">
                                <input type="file" class="form-control" name="business_permit" id="business_permit" placeholder="Valid Identification">
                                <label for="business_permit">Business Permit</label>
                            </div>
                        </div>
                      </div>
                      <div class="col-md-6 mt-2 owner-field">
                          <div class="form-group">
                              <div class="form-floating">
                                  <input type="number" class="form-control" name="tin" id="tin" placeholder="TIN">
                                  <label for="tin">TIN</label>
                              </div>
                          </div>
                      </div>
                    </div>
                </div>
                <div>
                  <div style="float:right; margin-top: 20px; margin-bottom: 20px;">
                    <button style="border-radius: 5px;" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                    <button style="border-radius: 5px;" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                    <button class="hidden" style="border-radius: 5px;" name="register" type="submit" id="submitBtn">Register</button>
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


  <!--**********************************
        Scripts
    ***********************************-->
  <!-- Required vendors -->
  <script src="vendor/global/global.min.js"></script>
  <script src="js/custom.min.js"></script>
  <script src="js/deznav-init.js"></script>

  <script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
      // This function will display the specified tab of the form...
      var x = document.getElementsByClassName("tab");
      x[n].style.display = "block";
      //... and fix the Previous/Next buttons:
      if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
      } else {
        document.getElementById("prevBtn").style.display = "inline";
      }
      if (n == (x.length - 1)) {
        document.getElementById("nextBtn").classList.add('hidden');
        document.getElementById("submitBtn").classList.remove('hidden');
      } else {
        document.getElementById("nextBtn").innerHTML = "Next";
      }
      //... and run a function that will display the correct step indicator:
      fixStepIndicator(n)
    }

    function nextPrev(n) {
      // This function will figure out which tab to display
      var x = document.getElementsByClassName("tab");
      // Exit the function if any field in the current tab is invalid:
      if (n == 1 && !validateForm()) return false;
      // Hide the current tab:
      x[currentTab].style.display = "none";
      // Increase or decrease the current tab by 1:
      currentTab = currentTab + n;
      // if you have reached the end of the form...
      if (currentTab >= x.length) {
        // ... the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
      }

      //check the usertype
      var user_type = document.querySelector('input[name="user_type_radio"]:checked').value;
      $('#user_type_field').val(user_type);
      if (user_type === "owner") {
        $('.owner-field').removeClass('hidden');
      } else {
        $('.owner-field').addClass('hidden');
      }
      
      // Otherwise, display the correct tab:
      showTab(currentTab);
    }

    function validateForm() {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      x = document.getElementsByClassName("tab");
      y = x[currentTab].getElementsByTagName("input");
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
          // add an "invalid" class to the field:
          y[i].className += " invalid";
          // and set the current valid status to false
          valid = false;
        }
      }
      // If the valid status is true, mark the step as finished and valid:
      if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
      }
      return valid; // return the valid status
    }

    function fixStepIndicator(n) {
      // This function removes the "active" class of all steps...
      var i, x = document.getElementsByClassName("step");
      for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
      }
      //... and adds the "active" class on the current step:
      x[n].className += " active";
    }
  </script>

</body>

</html>