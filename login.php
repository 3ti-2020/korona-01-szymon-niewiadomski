<?php
  session_start();
  require_once "php/connect.php";

  function isLogged(){
    if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) return true;
    else return false;
  }
  if(isLogged()) header('Location: index.php');

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Szymon Niewiadomski</title>
    <meta charset="UTF-8" />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
  </head>

  <body>
    <h1 class="author">Szymon Niewiadomski Przykładowe konto: login - guest, hasło - guest</h1>
    <header>
      <nav class="navbar">
        <ol>
          <li class="nav--item"><a href="index.php" class="nav--link">Wszystko</a></li>
          <li class="nav--item"><a href="index.php?category=weights" class="nav--link">Wolne ciężary </a></li>
          <li class="nav--item"><a href="index.php?category=machines" class="nav--link">Maszyny</a></li>
          <li class="nav--item"><a href="index.php?category=accessories" class="nav--link">Akcesoria</a></li>
          <li class="nav--item"><a href="index.php?category=clothes" class="nav--link">Odzież</a></li>
          <?php
            if(isLogged()){
              echo '<li class="nav--item"><a href="cart.php" class="nav--link">Koszyk</a></li>';
              echo '<li class="nav--item"><a href="php/logout.php" class="nav--link">Wyloguj</a></li>';
            } else {
              echo '<li class="nav--item"><a href="login.php" class="nav--link">Logowanie</a></li>';
            }
          ?>
        </ol>
      </nav>
    </header>
    <main>
      <section class="login">
        <h1>Logowanie</h1>
            <form method="post" action="php/log-in.php" class="login--form">
              <input type="text" name="username" class="login--input <?php 
                if(isset($_SESSION['error_username'])){
                  echo 'error';
                  unset($_SESSION['error_username']);
                }
              ?>" placeholder="Nazwa użytkownika">
              <input type="password" name="password" class="login--input <?php
                if(isset($_SESSION['error_password'])){
                  echo 'error';
                  unset($_SESSION['error_password']);
                }
              ?> " placeholder="Hasło">
              <input type="submit" class="login--button" value="Zaloguj się">
            </form>
      </section>
    </main>
    <footer>
      <p>GYM SHOP &copy 2020</p>
    </footer>
  </body>
</html>
