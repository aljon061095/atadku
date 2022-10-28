<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<link href="../vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
<?php include 'includes/header.php'?>
    <!-- Datatable -->
<body>

    <?php include 'includes/preloader.php'?>


    <div id="main-wrapper">

        <?php include 'includes/topbar.php'?>
        <?php include 'includes/sidebar.php'?>

        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4><i class="mdi mdi-cogs"></i> System Settings</h4>
                        </div>
                    </div>
                </div>
                <!-- row -->


                <div class="row">
					<div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Update Settings</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Max Order Allowed</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" placeholder="ex. 12">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Commission</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" placeholder="ex. 12%">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Drivers Rate</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" placeholder="ex. 536">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-primary">Save</button>
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
    
    </div>

    <?php include 'includes/footer.php'?>

</body>

</html>