<?php
//Include config file
require_once "includes/config.php";

$driver_id =  $_SESSION["id"];

if (isset($_POST['search'])) {
	$date1 = date("Y-m-d", strtotime($_POST['date1']));
	$date2 = date("Y-m-d", strtotime($_POST['date2']));
	$query = mysqli_query($link, "SELECT * FROM `commission` WHERE driver_id = '$driver_id' && date(`date_added`) BETWEEN '$date1' AND '$date2'");
	$row = mysqli_num_rows($query);
	if ($row > 0) {
		while ($fetch = mysqli_fetch_array($query)) {
?>
			<tr>
				<td><?php echo $fetch['commission'] ?></td>
				<td><?php echo $fetch['date_added'] ?></td>
			</tr>
		<?php
		}
	} else {
		echo '
			<tr>
				<td colspan = "4"><center>Record Not Found</center></td>
			</tr>';
	}
} else {
	$query = mysqli_query($link, "SELECT * FROM `commission`");
	while ($fetch = mysqli_fetch_array($query)) {
		?>
		<tr>
			<td><?php echo $fetch['commission'] ?></td>
			<td><?php echo $fetch['date_added'] ?></td>
		</tr>
<?php
	}
}
?>