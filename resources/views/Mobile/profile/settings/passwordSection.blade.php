<div class="card-header">
    <h4 class="card-title">Change your password</h4>
</div>

<div class="card-body">
    <!-- Form -->
    <form id="changePasswordForm">
        <!-- Form -->
        <div class="row mb-4">
            <label for="currentPasswordLabel" class="col-sm-3 col-form-label form-label">Current password</label>

            <div class="col-sm-9">
                <input type="password" class="form-control" name="currentPassword" id="currentPasswordLabel" placeholder="Enter current password" aria-label="Enter current password">
            </div>
        </div>
        <!-- End Form -->

        <!-- Form -->
        <div class="row mb-4">
            <label for="newPassword" class="col-sm-3 col-form-label form-label">New password</label>

            <div class="col-sm-9">
                <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="Enter new password" aria-label="Enter new password">
            </div>
        </div>
        <!-- End Form -->

        <!-- Form -->
        <div class="row mb-4">
            <label for="confirmNewPasswordLabel" class="col-sm-3 col-form-label form-label">Confirm new password</label>

            <div class="col-sm-9">
                <div class="mb-3">
                    <input type="password" class="form-control" name="confirmNewPassword" id="confirmNewPasswordLabel" placeholder="Confirm your new password" aria-label="Confirm your new password">
                </div>

                <h5>Password requirements:</h5>

                <p class="fs-6 mb-2">Ensure that these requirements are met:</p>

                <ul class="fs-6">
                    <li>Minimum 8 characters long - the more, the better</li>
                    <li>At least one lowercase character</li>
                    <li>At least one uppercase character</li>
                    <li>At least one number, symbol, or whitespace character</li>
                </ul>
            </div>
        </div>
        <!-- End Form -->

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
    <!-- End Form -->
</div>
