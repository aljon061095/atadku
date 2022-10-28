<?php 
    //Include config file
    require_once "includes/config.php";

    session_start();

    $owner_id =  $_SESSION["id"];
    //owner
    $result = mysqli_query($link, "SELECT SUM(sales) AS sales_sum FROM sales WHERE restaurant_id = '$owner_id'");
    $row = mysqli_fetch_assoc($result);
    $sales = $row['sales_sum'];
?>

<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<link href="../vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
<?php include 'includes/header.php'?>

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
                            <h4><i class="mdi mdi-chart-bar-stacked"></i> Reports </h4>
                        </div>
                    </div>
                </div>
                <!-- row -->

                <div class="row">
                    <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered mytable"> 
                              <thead>
                                 <tr>
                                     <th>Month</th>
                                     <th>Sales</th>
                                 </tr>
                             </thead>
                                    <tbody>
                                       <tr>
                                           <td>October</td>
                                           <td>
                                                <input class="monthly-sales" type="hidden" value="<?php echo $sales; ?>" />
                                                <?php echo $sales; ?>
                                            </td>
                                       </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8 col-lg-8 col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <canvas id="bargraph" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php include 'includes/footer.php'?>
    <script src="../js/chart.js"></script>
    <script>
        $monthlySales = $('.monthly-sales').val();
        document.addEventListener("DOMContentLoaded", function () {
            var barChartData = {
                labels: ["October"],
                datasets: [{
                    label: 'Sales',
                    backgroundColor: 'rgb(45,34,23)',
                    borderColor: 'rgba(0, 158, 251, 1)',
                    borderWidth: 1,
                    data: [$monthlySales]
                }]
            };

            var ctx = document.getElementById('bargraph').getContext('2d');
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        display: false,
                    }
                }
            });

        });
    </script>
</body>

</html>