<?php
$__cssLinks = ['styles/pages/admin/account.css'];
?>

<main>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-center">Admin Login</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="userName" class="form-label">Username</label>
                                <input type="text" class="form-control" id="userName">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password">
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-primary" onclick="login()">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
     function login() {
        const userName = $('#userName').val();
        const password = $('#password').val();

        if (userName && password) {
            $.ajax({
                method: "POST",
                url: 'api/v1/login',
                data: {
                    userName,
                    password
                },
                success: function(response) {
                    if (response.admin) {
                        alert("Login success. Redirect soon.");
                        setTimeout(() => {
                            window.location.replace('profile');
                        }, 1000)
                    } else {
                        alert("Credentials do not match.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                    alert("Login failed.");
                }
            });
        } else {
            alert("Please fill required fields.");
        }
    }
</script>