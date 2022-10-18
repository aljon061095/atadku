<?php
    require_once 'config.php';

    //Ready for delivery
    if (isset($_POST['action']) === "ready_for_delivery") {
        $id = 0;
        
        if (isset($_POST['id'])) {
            $id = mysqli_real_escape_string($link, $_POST['id']);
        }

        if ($id > 0) {
            // Check record exists
            $checkRecord = mysqli_query($link, "SELECT * FROM food_orders WHERE id=" . $id);
            $totalrows = mysqli_num_rows($checkRecord);

            if ($totalrows > 0) {   
                // update status item record
                $query = "UPDATE food_orders SET status = 2 WHERE id=" . $id;
                mysqli_query($link, $query);
                return 1;
                exit;
            } else {
                return 0;
                exit;
            }
        }

        return 0;
        exit;
    }
