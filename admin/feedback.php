<?php 
    require_once "includes/config.php";

    $feedback_sql = "SELECT * FROM feedback";
    $result = mysqli_query($link, $feedback_sql);
    $feedbacks = $result->fetch_all(MYSQLI_ASSOC);
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
                            <h4><i class="mdi mdi-comment-text-multiple-outline"></i> Feedback & Reports</h4>
                        </div>
                    </div>
                </div>
                <!-- row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Date</th>
                                                <th>Submitted By</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($feedbacks as $feedback) { ?>
                                                <tr>
                                                    <td><?php echo $feedback['title']; ?></td>
                                                    <td><?php echo $feedback['description']; ?></td>
                                                    <td><?php echo $feedback['date_submitted']; ?></td>
                                                    <td><?php echo $feedback['submitted_by']; ?></td>
                                                    <td>
                                                        <span class="badge light badge-info">
                                                            <i class="fa fa-circle text-info mr-1"></i>
                                                            open
                                                        </span></td>
                                                    <td>
                                                        <select class="form-control">
                                                            <option>closed</option>
                                                            <option>open</option>
                                                            <option>solved</option>
                                                        </select>
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

    <?php include 'includes/footer.php'?>

</body>

</html>