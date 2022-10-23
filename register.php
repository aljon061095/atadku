<?php
// Include config file
require_once "includes/config.php";

$valid_type_sql = "SELECT * FROM valid_id_type";
$result = mysqli_query($link, $valid_type_sql);
$valid_id_types = $result->fetch_all(MYSQLI_ASSOC);

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

    $query = "INSERT INTO customer(profile, full_name, address, number, email_address, username, password, id_type, valid_id status)
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

    if (array_key_exists('valid_id', $_FILES)) {
        if ($_FILES['valid_id']['tmp_name'] != '') {
            $filename = 'valid_id' . '_' . strtotime(date('y-m-d H:i')) . '_' . basename($_FILES['valid_id']['name']);
            $move = move_uploaded_file($_FILES['valid_id']['tmp_name'], 'uploads/' . $filename);

            if ($move) {
                $valid_id = $filename;
            }
        }
    }

    $query = "INSERT INTO $type(name, logo, owner_name, tin, address, username, password, id_type, valid_id, status)
            VALUES ('$name', '$logo', '$owner_name', '$tin', '$address', '$username', '$password', '$id_type', '$valid_id', '$status')";
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

<?php include 'includes/header.php' ?>

<body style="background-image: url(images/avatar/registration_background.png); ">
    <div class="authincation">
        <div class="row">
            <div class="col-md-6 justify-content-left align-items-left mt-4 ml-4">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="auth-form" style="padding: 20px 30px 0 30px;">
                            <h4 class="text-center mb-2">Register an account</h4>
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
                            <div class="profile-tab">
                                <div class="custom-tab-1">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item"><a href="#customer" data-toggle="tab" class="nav-link active show">Customer</a>
                                        </li>
                                        <li class="nav-item"><a href="#owner" data-toggle="tab" class="nav-link">Owner</a>
                                        </li>
                                        <li class="nav-item"><a href="#driver" data-toggle="tab" class="nav-link">Driver</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content mt-4">
                                        <div id="customer" class="tab-pane fade active show">
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-floating">
                                                                <input type="file" class="form-control" name="profile" id="profile" placeholder="Profile" required>
                                                                <label for="profile">Profile</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name" required>
                                                                <label for="full_name">Full Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-floating">
                                                                <select class="form-select" id="id_type" name="id_type" required>
                                                                    <option selected value="">Choose your Id Type</option>
                                                                    <?php foreach ($valid_id_types as $id_type) { ?>
                                                                        <option value="<?php echo $id_type['id'] ?>"><?php echo $id_type['id_type'] ?></option>
                                                                    <?php  } ?>
                                                                </select>
                                                                <label for="id_type">Valid Id Type</label>
                                                            </div>
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
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" name="address" id="address" placeholder="Address" required>
                                                                <label for="address">Address</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <button type="submit" name="register_customer" class="btn btn-primary btn-block mb-2 mt-2">Register</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div id="owner" class="tab-pane fade">
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input mt-2" type="radio" name="type" value="restaurant" checked>
                                                                <label class="form-check-label">Restaurant</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input mt-2" type="radio" name="type" value="store">
                                                                <label class="form-check-label">Store</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" name="name" id="restaurant" placeholder="Restaurant Name">
                                                                <label for="restaurant">Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" name="address" id="address" placeholder="Address">
                                                                <label for="address">Address</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-floating">
                                                                <input type="email" class="form-control" name="email_address" id="email_address" placeholder="Email Address">
                                                                <label for="email_address">Email Address</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" name="owner_name" id="owner_name" placeholder="Owner Name">
                                                                <label for="owner_name">Owner Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-floating">
                                                                <select class="form-select" id="id_type" name="id_type" required>
                                                                    <option selected value="">Choose your Id Type</option>
                                                                    <?php foreach ($valid_id_types as $id_type) { ?>
                                                                        <option value="<?php echo $id_type['id'] ?>"><?php echo $id_type['id_type'] ?></option>
                                                                    <?php  } ?>
                                                                </select>
                                                                <label for="id_type">Valid Id Type</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-floating">
                                                                <input type="file" class="form-control" name="valid_id" id="valid_id" placeholder="Valid Identification" required>
                                                                <label for="valid_id">Valid Identification</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-floating">
                                                                <input type="file" class="form-control" name="logo" id="logo" placeholder="Logo">
                                                                <label for="logo">Logo</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-floating">
                                                                <input type="number" class="form-control" name="tin" id="tin" placeholder="TIN">
                                                                <label for="tin">TIN</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                                                                <label for="username">Username</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-floating">
                                                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                                                <label for="password">Password</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <button type="submit" name="register_owner" class="btn btn-primary btn-block mb-2 mt-2">Register</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div id="driver" class="tab-pane fade">
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-floating">
                                                                <input type="file" class="form-control" name="profile" id="profile" placeholder="Profile">
                                                                <label for="profile">Profile</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name">
                                                                <label for="full_name">Full Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" name="address" id="address" placeholder="Address">
                                                                <label for="address">Address</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <div class="form-floating">
                                                                    <select class="form-select" id="id_type" name="id_type" required>
                                                                        <option selected value="">Choose your Id Type</option>
                                                                        <?php foreach ($valid_id_types as $id_type) { ?>
                                                                            <option value="<?php echo $id_type['id'] ?>"><?php echo $id_type['id_type'] ?></option>
                                                                        <?php  } ?>
                                                                    </select>
                                                                    <label for="id_type">Valid Id Type</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-floating">
                                                                <input type="file" class="form-control" name="valid_id" id="valid_id" placeholder="Valid Identification">
                                                                <label for="valid_id">Valid Identification</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-floating">
                                                                <input type="number" class="form-control" name="number" id="number" placeholder="Contact Number">
                                                                <label for="number">Contact Number</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-floating">
                                                                <input type="email" class="form-control" name="email_address" id="email" placeholder="Email Address">
                                                                <label for="email">Email Address</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                                                                <label for="username">Username</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-floating">
                                                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                                                <label for="password">Password</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <button type="submit" name="register_driver" class="btn btn-primary btn-block mb-2 mt-2">Register</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <p>Already have an account? <a class="text-primary" href="login.php">Login</a></p>
                                    </div>
                                </div>
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

</body>

</html>