<?php
session_start();
require_once "server/connection.php";

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
  header("Location: account.php");
  die;
}

if (isset($_POST['login-btn'])) {

  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
  $stmt = $conn->prepare("SELECT * FROM users WHERE user_email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  if ($user = $stmt->get_result()->fetch_object()) {
    if (password_verify($password, $user->user_password)) {
      $_SESSION['user_id'] = $user->user_id;
      $_SESSION['user_name'] = $user->user_name;
      $_SESSION['user_email'] = $user->user_email;
      $_SESSION['logged_in'] = true;
      header("Location: account.php?message=logged in successfully");
    } else {
      header("Location: login.php?error=something went wrong");
    }
  } else {
    header("Location: login.php?error=something went wrong");
  }
}

require_once "layouts/header.php";
?>



<!-- Login -->
<section class="my-5 py-5">
  <div class="container text-center mt-3 pt-5">
    <h2 class="form-weight-bold">Login</h2>
    <hr class="mx-auto" />
  </div>
  <div class="mx-auto container">
    <form method="POST" action="login.php" id="login-form">
      <p style="color:red;" class="text-center"><?= $_GET['error'] ?? ""; ?></p>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="login-email" name="email" value="<?= (isset($_POST['email']) ? $_POST['email'] : "") ?>" placeholder="E-mail" required autocomplete="on" />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required />
      </div>
      <div class="form-group">
        <input type="submit" class="btn" name="login-btn" id="login_btn" value="Login" />
      </div>
      <div class="form-group">
        <a href="register.php" id="register-url" class="btn">Dont have account? Register</a>
      </div>
    </form>
  </div>
</section>

<!-- Footer -->
<?php
require_once "layouts/footer.php";
?>