<?php
if (isset($_POST['signup-submit'])) {
  require 'dbh.inc.php';

  $username = $_POST['user'];
  $email = $_POST['email'];
  $password = $_POST['pass'];
  $password_repeat = $_POST['pass-repeat'];

  if (empty($username) || empty($email) || empty($password) || empty($password_repeat)) {
    header("Location: ../signup.php?error=emptyfields&user=".$username."&email=".$email);
    exit();
  }

      else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
      header("Location: ../signup.php?error=invaliduseremail");
      exit();
      } 

      else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidemail&user=".$username);
        exit();
      } 

      else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invaliduser&email=".$email);
        exit();
      } 

      else if ($password !== $password_repeat) {
        header("Location: ../signup.php?error=passwordcheck&user=".$username."&email=".$email);
        exit();
      } 

    else {
      $sql = "SELECT user FROM users WHERE user=?;";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../signup.php?error=sqlerror");
        exit();
      } 

      else {
        // s == string, i == int, b == blob
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $result_check = mysqli_stmt_num_rows($stmt);
        if ($result_check > 0) {
          header("Location: ../signup.php?error=usertaken&email=".$email);
          exit();
        }

        else {
          $sql = "INSERT INTO users (user, email, pass) VALUES (?, ?, ?)";
          $stmt = mysqli_stmt_init($conn);

          if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
          } 
          
          else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashed);
            mysqli_stmt_execute($stmt);
            header("Location: ../signup.php?signup=success");
            exit();
          }
        }
      }
      mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
  } 

else {
  header("Location: ../signup.php");
  exit();
}