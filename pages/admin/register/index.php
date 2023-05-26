<!-- Registration Modal -->
<div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrationModalLabel">New Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="newAccountUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="newAccountUsername">
                    </div>
                    <div class="mb-3">
                        <label for="newAccountPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="newAccountPassword" placeholder="Enter new password">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-control" id="role">
                            <?php
                            foreach ($data->roles as $role) {
                                echo "<option value='" . $role['id'] . "'>" . $role['role_name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="register()">Save</button>
            </div>
        </div>
    </div>
</div>