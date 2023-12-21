<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Modern Login Page | AsmrProg</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="../private/Login_signUp.php" method="post">
                <h1>Create Account</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registeration</span>
                <input type="email" placeholder="Email" name="email" required>
                <input type="password" placeholder="Password" id ="password1" name="pass" oninput="checkPasswordMatch()"required>
                <input type="password" placeholder="Confirm Password" id ="password2" oninput="checkPasswordMatch()"required>
                <div class="show-PW">
                <span> Show Password</span>
                <input type="checkbox" id="showPassword1" onclick="togglePasswordUP()">
                </div>
                <button name="SignUp" id="signUpButton" disabled>Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="../private/Login_signIn.php" method="post">
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email password</span>
                <?php
                  if(isset($_SESSION['error'])){
                  echo "<p>".$_SESSION['error']."</p>";
                  unset($_SESSION['error']);
                  }
                ?>
                <input type="email" placeholder="Email" name="emai_signIn" id="emaiIN" oninput="checkMatch()" required>
                <input type="password" placeholder="Password" name="pass_signIn" id="passwordIN" oninput="checkMatch()" required>
                <div class="show-PW">
                    <span> Show Password</span>
                    <input type="checkbox"  id="showPassword2" onclick="togglePasswordIN()">
                    </div>
                <a href="../private/PHPMailer-main/index.php">Forget Your Password?</a>
                <button name="signIn" id="signInButton" disabled>Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>