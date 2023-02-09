<div class="modal fade" id="update_food_modal<?php echo $food['id'] ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Update Food</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-floating mb-2">
                                <input type="hidden" class="form-control" name="id" value="<?php echo $food['id']; ?>">
                                <input type="text" class="form-control" name="food_name" value="<?php echo $food['food_name']; ?>" id="food_name" placeholder="Food Name" required>
                                <label for="food_name">Food Name</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-floating mb-2">
                                <input type="number" class="form-control" name="price" value="<?php echo $food['price']; ?>" id="price" placeholder="Price" required>
                                <label for="price">Price</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-floating mb-2">
                                <textarea class="form-control" rows="4" placeholder="Description" name="description" id="description" required><?php echo $food['description']; ?></textarea>
                                <label for="description">Description</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="1" name="status" id="available" checked>
                                <label class="form-check-label" for="available">
                                    Available
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="0" name="status" id="not_available">
                                <label class="form-check-label" for="not_available">
                                    Not Available
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="update_food" class="btn btn-primary">Save changes</button>
                        </div>
                </form>
            </div>
        </div>
    </div>