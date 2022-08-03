<?php
  require "header.php";
?>
<main>
  <h1>Signup</h1>
  <?php
  if (isset($_GET['error'])) {
    if ($_GET['error'] == "emptyfields") {
      echo '<p class="signuperror">Fill in all fields!</p>';
    } else if ($_GET['error'] == "invaliduseremail") {
      echo '<p class="signuperror">Invalid Username and Email!</p>';
    } else if ($_GET['error'] == "invaliduser") {
      echo '<p class="signuperror">Invalid Username!</p>';
    } else if ($_GET['error'] == "invalidemail") {
      echo '<p class="signuperror">Invalid Email!</p>';
    } else if ($_GET['error'] == "passwordcheck") {
      echo '<p class="signuperror">Your passwords do not match!</p>';
    } else if ($_GET['error'] == "usertaken") {
      echo '<p class="signuperror">Username is already taken!</p>';
    }
  } else if (isset($_GET['signup']) == 'success') {
    echo '<p class="signupsuccess">Success!</p>';
  }
  ?>

  
  <form action="includes/signup.inc.php" method="post">
    <input type="text" name="user" placeholder="Username...">
    <input type="text" name="email" placeholder="Email...">
    <input type="password" name="pass" placeholder="Password...">
    <input type="password" name="pass-repeat" placeholder="Retype Password...">
    <button type="submit" name="signup-submit">Sign up</button>
  </form>
</main>
<?php
  require "footer.php";
?>