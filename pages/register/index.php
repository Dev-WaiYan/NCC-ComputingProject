<?php
$__cssLinks = ['styles/pages/login_register.css'];
?>

<main class="container-wrapper">
    <div class="container">
        <h1>Register</h1>
        <form>
            <div class="form-group">
                <label for="userEmail">Email <span class="required">*</span></label>
                <input id="userEmail" name="userEmail" type="email" />
            </div>
            <div class="form-group">
                <label for="firstName">First Name <span class="required">*</span></label>
                <input id="firstName" name="firstName" type="text" />
            </div>
            <div class="form-group">
                <label for="surName">Sur Name <span class="required">*</span></label>
                <input id="surName" name="surName" type="text" />
            </div>
            <div class="form-group">
                <label for="password">Password <span class="required">*</span></label>
                <input id="password" name="password" type="password" />
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password <span class="required">*</span></label>
                <input id="confirmPassword" name="confirmPassword" type="password" />
            </div>
            <div class="form-group">
                <div class="button-container">
                    <button type="button" onclick="register()">Register</button>
                </div>
            </div>
            <div class="info-container">
                <div class="form-group">
                    <a href="privacy-policy">Privacy Policy</a>
                </div>
                <div class="form-group">
                    <a href="login">I already have an user account. Login.</a>
                </div>
            </div>
        </form>
    </div>
</main>

<script>
    function register() {
        const userEmail = $('#userEmail').val();
        const password = $('#password').val();
        const confirmPassword = $('#confirmPassword').val();
        const firstName = $('#firstName').val();
        const surName = $('#surName').val();

        if (!isValidPassword(password)) {
            alert("Please valid password. Password must have min 8 letter password, with at least a symbol, upper and lower case letters and a number.");
            return;
        }

        if (userEmail && password && confirmPassword && firstName && surName) {
            if (password !== confirmPassword) {
                alert("Password and Confirm Password are not same.")
                return;
            }

            $.ajax({
                method: "POST",
                url: 'api/v1/register',
                data: {
                    userEmail,
                    password,
                    firstName,
                    surName,
                },
                success: function(response) {
                    if (response.existedUser) {
                        alert("Your account has existed already.");
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