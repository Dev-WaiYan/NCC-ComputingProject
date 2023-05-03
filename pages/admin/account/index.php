<?php
$__cssLinks = ['styles/pages/admin/account.css'];

$data = AccountController::getData();

?>

<main>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-center">My Profile</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="userName" class="form-label">Username</label>
                                <input type="text" class="form-control" id="userName" disabled value="adbcd">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter new password">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <input type="text" class="form-control" disabled value="admin">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 d-flex justify-content-center my-4">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registrationModal">Register New Admin</button>
            </div>
        </div>
    </div>
</main>

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


<script>
    function register() {
        const newAccountUsername = $('#newAccountUsername').val();
        const newAccountPassword = $('#newAccountPassword').val();
        const role = $('#role').val();

        if (newAccountUsername && newAccountPassword && role) {
            if (!isValidPassword(newAccountPassword)) {
                alert("Please valid password. Password must have min 8 letter password, with at least a symbol, upper and lower case letters and a number.");
                return;
            }

            $.ajax({
                method: "POST",
                url: 'api/v1/register',
                data: {
                    newAccountUsername,
                    newAccountPassword,
                    role
                },
                success: function(response) {
                    if (response.existedUser) {
                        alert("Account has existed already.");
                    } else if (response.adminId) {
                        alert("Successfully registered. Will redirect soon to login.");
                        window.location.reload();
                    } else {
                        throw new Error("Registration failed.")
                    }

                    // setTimeout(() => {
                    //     window.location.replace('login')
                    // }, 1000)
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                    alert("Registration failed.");
                }
            });
        } else {
            alert("Please fill required fields.");
        }
    }
</script>