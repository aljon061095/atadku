<?php
//Include config file
require_once "includes/config.php";

$admin_commission_sql = "SELECT * FROM admin_commission";
$result = mysqli_query($link, $admin_commission_sql);
$admin_commission = $result->fetch_all(MYSQLI_ASSOC);

if (isset($_POST["ExportType"])) {
    if (isset($_POST['from_date']) && isset($_POST['to_date'])) {
        $from_date = $_POST['from_date'];
        $to_date = $_POST['to_date'];

        $query = "SELECT * FROM admin_commission where date_added between '" . $from_date . "' 
            and '" . $to_date . "' ORDER BY id asc";
        $result = mysqli_query($link, $query);
        $admin_commission = $result->fetch_all(MYSQLI_ASSOC);
    }

    $filename = "Commission_Report" . ".xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    ExportFile($admin_commission);
    exit();
}

function ExportFile($records) {
    $heading = false;
    if (!empty($records))
        foreach ($records as $row) {
            if (!$heading) {
                // display field/column names as a first row
                echo implode("\t", array_keys($row)) . "\n";
                $heading = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<link href="../vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
<?php include 'includes/header.php' ?>

<body>
    <?php include 'includes/preloader.php' ?>

    <div id="main-wrapper">

        <?php include 'includes/topbar.php' ?>
        <?php include 'includes/sidebar.php' ?>

        <div class="content-body" style="margin-left: -5px; padding-top: 7rem;">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4><i class="mdi mdi-chart-bar-stacked"></i> Commission Report</h4>
                            <div class="col-md-12 float-right mb-4">
                                <div class="btn-group pull-right">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#exportModal" class="btn fs-22 py-1 ml-2 btn-primary">
                                        <i class="mdi mdi-download"></i>
                                        Export
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="col-md-12 well">
                            <form class="form-inline" method="POST" action="">
                                <label>From:</label>
                                    <input type="date" class="form-control" placeholder="Start" name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : date('Y-m-d') ?>" />
                                <label>To</label>
                                    <input type="date" class="form-control" placeholder="End" name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : date('Y-m-d') ?>" />
                                
                                <button class="btn btn-primary ml-2 mr-2" name="search">
                                    <span class="mdi mdi-keyboard-return"></span>
                                </button>
                                <a href="/atadku/admin/reports.php" type="button" class="btn btn-success">
                                    <span class="mdi mdi-refresh"><span>
                                </a>
                            </form>
                            <br /><br />
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="alert-info">
                                        <tr>
                                            <th>Commission</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php include 'range.php' ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'export_modal.php' ?>
    <?php include 'includes/footer.php' ?>
    
    <script src="../js/chart.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            jQuery('button').on("click", function() {
                var target = $(this).attr('id');
                switch (target) {
                    case 'export-to-excel':
                        $('#hidden-type').val(target);
                        //alert($('#hidden-type').val());
                        $('#export-form').submit();
                        $('#hidden-type').val('');
                        break;
                }
            });
        });
    </script>
</body>

</html>