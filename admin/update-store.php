<div class="modal fade" id="update_store_modal<?php echo $store['id'] ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Update Store</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" name="name" value="<?php echo $store['name']; ?>" id="restaurant" placeholder="Store Name" required>
                            <label for="restaurant">Store Name</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" name="owner_name" value="<?php echo $store['owner_name']; ?>" id="owner_name" placeholder="Owner Name" required>
                            <label for="owner_name">Owner Name</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-floating mb-2">
                            <input type="number" class="form-control" name="tin" value="<?php echo $store['tin']; ?>"  id="tin" placeholder="TIN" required>
                            <label for="tin">TIN</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" name="address" value="<?php echo $store['address']; ?>" id="address" placeholder="Address" required>
                            <label for="address">Address</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" name="username" value="<?php echo $store['username']; ?>"  id="username" placeholder="Username" required>
                            <label for="username">Username</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="update_store" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>