<?php
$__cssLinks = ['styles/pages/register.css'];
?>

<main class="container my-5 px-4">
    <div class="row">
        <div class="col-md-6 offset-md-3 mx-auto">
            <h1>Register Form</h1>
            <form>
                <div class="form-group">
                    <label for="userName">Username:</label>
                    <input type="text" class="form-control" id="userName" name="userName" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group my-3 d-flex justify-content-end align-items-center">
                    <a href="login" class="mx-4">Login</a>
                    <button type="button" class="btn btn-primary" onclick="register()">Register</button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    function register() {
        const email = $('#email').val();
        const password = $('#password').val();
        const userName = $('#userName').val();
        const phone = $('#phone').val();

        if (password && !isValidPassword(password)) {
            alert("Please valid password. Password must have min 8 letter password, with at least a symbol, upper and lower case letters and a number.");
            return;
        }

        if (email && password && userName && phone) {
            $.ajax({
                method: "POST",
                url: 'api/v1/register',
                data: {
                    email,
                    password,
                    userName,
                    phone
                },
                success: function(response) {
                    if (response.existedUser) {
                        alert("Account has existed already.");
                    } else {
                        alert("Successfully registered. Will redirect soon to login.");
                    }

                    setTimeout(() => {
                        window.location.replace('login')
                    }, 1000)
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