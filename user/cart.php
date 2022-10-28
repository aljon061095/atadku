<?php
    require_once "includes/config.php";
    
    //Initialize the session
    session_start();

    if (isset($_POST["add"])) {
        if (isset($_SESSION["cart"])) {
            $item_array_id = array_column($_SESSION["cart"], "food_id");
            if (!in_array($_GET["id"], $item_array_id)) {
                $count = count($_SESSION["cart"]);
                $item_array = array(
                    'food_id' => $_GET["id"],
                    'restaurant_id' => $_POST["restaurant_id"],
                    'name' => $_POST["name"],
                    'price' => $_POST["price"],
                    'quantity' => $_POST["quantity"]
                );
                $_SESSION["cart"][$count] = $item_array;
                echo '<script>window.location="cart.php"</script>';
            } else {
                echo '<script>window.location="cart.php"</script>';
            }
        } else {
            $item_array = array(
                'food_id' => $_GET["id"],
                'restaurant_id' => $_POST["restaurant_id"],
                'name' => $_POST["name"],
                'price' => $_POST["price"],
                'quantity' => $_POST["quantity"]
            );
            $_SESSION["cart"][0] = $item_array;
            print_r($_SESSION["cart"]);
        }
    }
    
    if (isset($_GET["action"])) {
        if ($_GET["action"] == "delete") {
            foreach ($_SESSION["cart"] as $keys => $values) {
                if ($values["food_id"] == $_GET["id"]) {
                    unset($_SESSION["cart"][$keys]);
                    echo '<script>window.location="cart.php"</script>';
                }
            }
        }
    }
    
    if (isset($_GET["action"])) {
        if ($_GET["action"] == "empty") {
            foreach ($_SESSION["cart"] as $keys => $values) {
                unset($_SESSION["cart"]);
                echo '<script>window.location="cart.php"</script>';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<?php include 'includes/header.php' ?>

<body>
    <?php include 'includes/preloader.php' ?>

    <div id="main-wrapper">
        <?php include 'includes/navbar.php' ?>
        <?php include 'includes/sidebar.php'?>
        
        <div class="content-body" style="margin-left: -5px;">
            <div class="container-fluid">
                <div class='row'>
                    <?php
                    if (!empty($_SESSION["cart"])) {
                    ?>
                        <h3>Your Cart</h3>
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="40%">Food Name</th>
                                    <th width="10%">Quantity</th>
                                    <th width="20%">Price Details</th>
                                    <th width="15%">Order Total</th>
                                    <th width="5%">Action</th>
                                </tr>
                            </thead>
                            <?php
                            $total = 0;
                            $restaurant_id = 0;
                            foreach ($_SESSION["cart"] as $keys => $values) {
                                ?>
                                    <tr>
                                        <td><?php echo $values["name"]; ?></td>
                                        <td><?php echo $values["quantity"] ?></td>
                                        <td>₱ <?php echo number_format($values["price"], 2); ?></td>
                                        <td>₱ <?php echo number_format($values["quantity"] * $values["price"], 2); ?></td>
                                        <td><a href="cart.php?action=delete&id=<?php echo $values["food_id"]; ?>"><span class="text-danger">Remove</span></a></td>
                                    </tr>
                                <?php
                                    $restaurant_id = $values["restaurant_id"];
                                    $total = $total + ($values["quantity"] * $values["price"]);
                                }
                                ?>
                            <tr>
                                <td colspan="3" align="right">Total</td>
                                <td align="right">₱ <?php echo number_format($total, 2); ?></td>
                                <td></td>
                            </tr>
                        </table>
                        <div>
                            <a href="cart.php?action=empty">
                                <button class="btn btn-danger">
                                    <span class="glyphicon glyphicon-trash"></span> 
                                    Empty Cart
                                </button>
                            </a>

                            <a href="menu.php?id=<?php echo $restaurant_id; ?>">
                                <button class="btn btn-warning">Add more items</button>
                            </a>

                            <a href="checkout.php?restaurant_id=<?php echo $restaurant_id; ?>">
                                <button class="btn btn-success pull-right">
                                    <span class="glyphicon glyphicon-share-alt"></span> 
                                    Check Out
                                </button>
                            </a>
                        </div>
                    <?php
                    } elseif (empty($_SESSION["cart"])) {
                    ?>
                        <div class="container">
                            <div class="jumbotron">
                                <h3>Your cart is empty. Enjoy <a href="index.php">food list</a> here.</h3>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php' ?>
    <?php include 'includes/feedbacks.php' ?>
</body>

</html>