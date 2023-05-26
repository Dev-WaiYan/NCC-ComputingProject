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
                                <input type="text" class="form-control" id="userName" disabled value="<?php echo $_SESSION['userName'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter new password">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <input type="text" class="form-control" disabled value="<?php echo isset($_SESSION['roleId']) && $_SESSION['roleId'] === 1 ? 'admin' : 'staff' ?>">
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-primary" onclick="save()">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php if (isset($_SESSION['roleId']) && $_SESSION['roleId'] === 1) { ?>
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 d-flex justify-content-center my-4">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registrationModal">Register New Admin</button>
                </div>
            </div>
        <?php } ?>
    </div>
</main>

<?php require_once './pages/admin/register/index.php' ?>


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
                        alert("Successfully registered.");
                        window.location.reload();
                    } else {
                        throw new Error("Registration failed.")
                    }
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

    function save() {
        const password = $('#password').val();
        if (password) {
            if (!isValidPassword(password)) {
                alert("Please valid password. Password must have min 8 letter password, with at least a symbol, upper and lower case letters and a number.");
                return;
            }

            $.ajax({
                method: "POST",
                url: 'api/v1/account/update',
                data: {
                   password
                },
                success: function(response) {
                    if (response.status === 'ok') {
                        alert("Successfully updated.");
                        window.location.reload();
                    } else {
                        throw new Error("Process failed.")
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                    alert("Process failed.");
                }
            });
        } else {
            alert("Please fill required fields.");
        }
    }
</script>