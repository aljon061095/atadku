 <!-- Export -->
 <div class="modal fade" id="exportModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Export</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-floating mb-2">
                                <input type="date" class="form-control" placeholder="From" name="from_date" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : date('Y-m-d') ?>" required />
                                <label for="restaurant">From</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-floating mb-2">
                                <input type="date" class="form-control" placeholder="to" name="to_date" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : date("Y-m-d", time() + 86400) ?>" required />
                                <label for="restaurant">To</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="ExportType" class="btn btn-primary">Export</button>
                    </div>
                </form>
            </div>
        </div>
    </div>