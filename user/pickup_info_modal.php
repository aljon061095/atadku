<div class="modal fade" id="pickup_info_modal<?php echo $pickup['id'] ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">View Pickup Details</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="overflow-y: auto; max-height: 500px;">
                <div class="row">
                    <h4>Sender Details</h4>

                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">Sender Name</th>
                                <td><?php echo $pickup['sender_name']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Sender Address</th>
                                <td><?php echo $pickup['sender_address']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Item Details</th>
                                <td><?php echo $pickup['item_details']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Notes to Delivery Rider</th>
                                <td><?php echo $pickup['notes']; ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mt-2">
                        <h4>Recipeint Details</h4>

                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Recipeint Name</th>
                                    <td><?php echo $pickup['recipient_name']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Recipeint Address</th>
                                    <td><?php echo $pickup['recipient_address']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Message</th>
                                    <td><?php echo $pickup['message']; ?></td>
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
                                    <td><strong>₱ <?php echo number_format($order['charge'], 2); ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>