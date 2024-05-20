<?php
session_start();
require_once "server/connection.php";

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
  header("Location: account.php");
  die;
}

if (isset($_POST['register'])) {
  $name = htmlspecialchars($_POST['name']);
  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
  $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
  $confirmPassword = filter_var($_POST['confirmPassword'], FILTER_SANITIZE_SPECIAL_CHARS);

  // if passwords dont match
  if ($password !== $confirmPassword) {
    header('Location: register.php?error=passwords dont match');
  }
  // if password is less than 6 char
  else if (strlen($confirmPassword) < 6) {
    header('Location: register.php?error=password must be at least 6 charachters');
  } else {
    $password = password_hash($password, PASSWORD_DEFAULT);
    // check wheter there is  user with this email or not
    $stmt1 = $conn->prepare("SELECT count(user_id) FROM users WHERE user_email = ?");
    $stmt1->bind_param("s", $email);
    $stmt1->execute();
    $stmt1->bind_result($num_rows);
    $stmt1->store_result();
    $stmt1->fetch();

    if ($num_rows !== 0) {

      header("Location: register.php?error=email already exists");
    }
    // create a new user
    $stmt = $conn->prepare("INSERT INTO users(user_name, user_email, user_password)
                          VALUES(?,?,?)");
    $stmt->bind_param("sss", $name, $email, $password);
    if ($stmt->execute()) {
      $_SESSION['user_id'] = $stmt->insert_id;
      $_SESSION['user_email'] = $email;
      $_SESSION['user_name'] = $name;
      $_SESSION['logged_in'] = true;
      header("Location: account.php?register_success=You registered successfully");
    } else {
      header("Location: register.php?error=could not create an account at the moment");
    }
  }
}
require_once "layouts/header.php";
?>


<!-- Register -->
<section class="my-5 py-5">
  <div class="container text-center mt-3 pt-5">
    <h2 class="form-weight-bold">Register</h2>
    <hr class="mx-auto" />
  </div>
  <div class="mx-auto container">
    <form id="register-form" method="POST" action="register.php">
      <p style="color:red;"><?= $_GET['error'] ?? ""; ?></p>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required />
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="register-email" name="email" placeholder="E-mail" required />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="register-password" name="password" placeholder="Password" required />
      </div>
      <div class="form-group">
        <label for="password">Confirm Password</label>
        <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="Confirm Password" required />
      </div>
      <div class="form-group">
        <input type="submit" class="btn" id="register-btn" name="register" value="Register" />
      </div>
      <div class="form-group">
        <a href="login.php" id="loginr-url" class="btn">Do you have an account? Login</a>
      </div>
    </form>
  </div>
</section>

<!-- Footer -->
<?php
require_once "layouts/footer.php";
?>