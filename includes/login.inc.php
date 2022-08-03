<?php
if (isset($_POST['login-submit'])) {
  require 'dbh.inc.php';

  $user = $_POST['user'];
  $pass = $_POST['pass'];

  if (empty($user) || empty($pass)) {
    header("Location: ../index.php?error=emptyfields");
    exit();
  }
   else {
    $sql = "SELECT * FROM users WHERE user=? OR email=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../index.php?error=sqlerror");
      exit();
    }
     else {
      mysqli_stmt_bind_param($stmt, "ss", $user, $user);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        $pass_check = password_verify($pass, $row['pass']);

        if ($pass_check == false) {
          header("Location: ../index.php?error=wrongpassword");
          exit();
        } 
        else if ($pass_check == true) {
          session_start();
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['user'] = $row['user'];

          header("Location: ../index.php?login=success");
          exit();
        } 
        else {
          header("Location: ../index.php?error=nouser");
          exit();
        }
      } 
      else {
        header("Location: ../index.php?error=nouser");
        exit();
      }
    }
  }
} else {
  header("Location: ../index.php");
  exit();
}