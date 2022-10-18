<!-- Food List -->
<div class="modal fade" id="addFoodModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Add Food</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="#">
            <div class="modal-body">
                <div class="form-group">
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="restaurant" placeholder="Restaurant Name">
                        <label for="restaurant">Restaurant</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="food_name" placeholder="Food Name">
                        <label for="food_name">Food Name</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-floating mb-2">
                        <input type="number" class="form-control" id="price" placeholder="Price">
                        <label for="price">Price</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-floating mb-2">
                        <input type="file" class="form-control" id="image" placeholder="Imgae">
                        <label for="image">Image</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-floating mb-2">
                        <textarea class="form-control" placeholder="Description" id="description"></textarea>
                        <label for="description">Description</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Driver -->
<div class="modal fade" id="addDriverModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Add Driver</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="#">
            <div class="modal-body">
                <div class="form-group">
                    <div class="form-floating mb-2">
                        <input type="file" class="form-control" id="profile" placeholder="Profile">
                        <label for="image">Profile</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="full_name" placeholder="Full Name">
                        <label for="restaurant">Full Name</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="address" placeholder="Address">
                        <label for="address">Address</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-floating mb-2">
                        <input type="email" class="form-control" id="email" placeholder="Email Address">
                        <label for="email">Email Address</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-floating mb-2">
                        <input type="number" class="form-control" id="number" placeholder="Contact Number">
                        <label for="number">Contact Number</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-floating mb-2">
                        <input type="number" class="form-control" id="license_number" placeholder="License Number">
                        <label for="license_number">License Number</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>