<?php
$__cssLinks = ['styles/pages/login.css'];
?>

<main class="container my-5 px-4">
    <div class="row">
        <div class="col-md-6 offset-md-3 mx-auto">
            <h1>Login Form</h1>
            <form>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group my-3 d-flex justify-content-end align-items-center">
                    <a href="register" class="mx-4">Register</a>
                    <button type="button" class="btn btn-primary" onclick="login()">Login</button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    function login() {
        const email = $('#email').val();
        const password = $('#password').val();

        if (email && password) {
            $.ajax({
                method: "POST",
                url: 'api/v1/login',
                data: {
                    email,
                    password
                },
                success: function(response) {
                    if (response.user) {
                        setTimeout(() => {
                            alert("Login success. Redirect soon.");
                            window.location.replace('home');
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