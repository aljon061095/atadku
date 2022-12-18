<div class="modal fade" id="order_pickup_info_modal<?php echo $order['id'] ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">View Order Details</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="overflow-y: auto; max-height: 500px;">
                <div class="row">
                    <?php
                    if ($order['store_id'] > 0) {
                        $store_id = $order['store_id'];;
                        $result = mysqli_query($link, "SELECT * 
                                                    FROM store WHERE id = $store_id");
                        $store = mysqli_fetch_array($result);

                        echo '<h4>Store</h4>';
                        echo '<span>' . $store['name'] . '</span><br/>';
                        echo '<span>' . $store['address'] . '</span>';
                    }

                    if ($order['restaurant_id'] > 0) {
                        $restaurant_id = $order['restaurant_id'];;
                        $result = mysqli_query($link, "SELECT *
                                                    FROM restaurant WHERE id = $restaurant_id");
                        $restaurant = mysqli_fetch_array($result);

                        echo '<h4>Restaurant</h4>';
                        echo '<span>' . $restaurant['name'] . '</span><br/>';
                        echo '<span>' . $restaurant['address'] . '</span>';
                    }

                    $customer_id = $order['customer_id'];
                    $result = mysqli_query($link, "SELECT *
                                FROM customer WHERE id = $customer_id");
                    $customer = mysqli_fetch_array($result);
                    ?>

                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">Item Name</th>
                                <td><?php echo $order['name']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Price</th>
                                <td><?php echo $order['price']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Quantity</th>
                                <td><?php echo $order['quantity']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Total Amount</th>
                                <td><?php echo $order['total']; ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mt-2">
                        <h4>Customer Information</h4>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Name</th>
                                    <td><?php echo $customer['full_name']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Address</th>
                                    <td><?php echo $customer['address']; ?></td>
                                </tr>
                            </tbody>
                         </table>
                    </div>

                    <div class="mt-2">
                        <h4>Payment Information</h4>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Payment Method</th>
                                    <td><?php echo $order['payment_method']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Delivery Charge</th>
                                    <td><strong>₱ <?php echo number_format($order['charge'] > 0 ? $order['charge'] : 49, 2); ?></strong></td>
                                </tr>
                            </tbody>
                         </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>