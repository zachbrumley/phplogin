<?php
  session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="description" content="This is a description">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <title></title>
</head>

<body>

  <style>
  ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
  }

  li {
    float: left;
  }

  li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
  }

  li a:hover {
    background-color: #111;
  }

  #usertxt{
    float: right;
    padding: 10px 32px;
    top:-43px;
    left: -15px;
    position:relative;
  }

  #passtxt{
    float: right;
    padding: 10px 32px;
    top:-43px;
    left: -10px;
    position: relative;
  }

  #loginsubmit{
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 14px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    float: right;
    position: relative;
    top:-47px;
    left: -20px;
  }

  #logoutsubmit{
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 14px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    float: right;
    position: relative;
    top:-47px;
  }
  </style>

  <header>
    <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="signup.php">Register</a></li>
   </ul>

      <div>
        <?php
          if (isset($_SESSION['user_id'])) {
            echo '<form action="includes/logout.inc.php" method="post">
                    <button type="submit" id="logoutsubmit" name="logout-submit">Logout</button>
                  </form>';
          } else {
            echo '
              <form action="includes/login.inc.php" method="post">
              <input type="password" id="passtxt" name="pass" placeholder="Password...">
              <input type="text" id="usertxt" name="user" placeholder="User/Email...">  
                <button type="submit" id="loginsubmit" name="login-submit">Login</button>
              </form>';
              
          }
        ?>
      </div>
    </nav>
  </header>
</body>