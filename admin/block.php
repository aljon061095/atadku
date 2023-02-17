<?php
    require_once 'includes/config.php';

    //Delete
    $id = 0;
    $tableName = $_POST['tableName'];
    $actionName = $_POST['actionName'];

    $status = $actionName === "activated" ? 0 : 1;
    
    if (isset($_POST['id'])) {
        $id = mysqli_real_escape_string($link, $_POST['id']);
    }

    if ($id > 0) {
        // Check record exists
        $checkRecord = mysqli_query($link, "SELECT * FROM $tableName WHERE id=" . $id);
        $totalrows = mysqli_num_rows($checkRecord);

        if ($totalrows > 0) {
            // Update item record
            $query = "UPDATE $tableName SET is_blocked = $status WHERE id=" . $id;
            mysqli_query($link, $query);
            echo 1;
            exit;
        } else {
            echo 0;
            exit;
        }
    }

    echo 0;
    exit;
?>