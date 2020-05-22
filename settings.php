<?php
  session_start();
  require_once "php/connect.php";

  function isLogged(){
    if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) return true;
    else return false;
  }
  if(!isLogged()) header('Location: index.php');

  function checkError($error, $echo){
    if(isset($_SESSION[$error])){
      echo $echo;
      unset($_SESSION[$error]);
    }
  }
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
      <div class="logo">
        <span>GYM</span>
        <span>SHOP</span>
      </div>
      <nav class="navbar">
        <ol>
          <li class="nav--item"><a href="index.php" class="nav--link">Wszystko</a></li>
          <li class="nav--item"><a href="index.php?category=weights" class="nav--link">Wolne ciężary </a></li>
          <li class="nav--item"><a href="index.php?category=machines" class="nav--link">Maszyny</a></li>
          <li class="nav--item"><a href="index.php?category=accessories" class="nav--link">Akcesoria</a></li>
          <li class="nav--item"><a href="index.php?category=clothes" class="nav--link">Odzież</a></li>
          <li class="nav--item nav--panel"> 
            Panel Użytkownika &#x25BC;
            <ol class="nav--submenu">
              <li class="nav--subitem nav--user"><?php echo 'Witaj '.$_SESSION['name']?></li>
              <li class="nav--subitem"><a href="cart.php" class="nav--sublink">Koszyk</a></li>
              <li class="nav--subitem"><a href="orders.php" class="nav--sublink">Zamówienia</a></li>
              <li class="nav--subitem"><a href="settings.php" class="nav--sublink">Ustawienia</a></li>
              <li class="nav--subitem"><a href="php/logout.php" class="nav--sublink">Wyloguj</a></li>
            </ol>
          </li>
        </ol>
      </nav>
    </header>
    <main>
      <section class="settings">
        <h1>Ustawienia</h1>
          <form action="php/changeSettings.php" method="post" class="settings--form">
            <input type="password" name="password" class="settings--input <?php checkError('e_password', 'error')?>" placeholder="Stare hasło">
            <input type="password" name="new_password" class="settings--input <?php checkError('e_newpassword', 'error')?>" placeholder="Nowe hasło">
            <input type="password" name="re_password" class="settings--input <?php checkError('e_repassword', 'error')?>" placeholder="Powtórz nowe hasło">
            <input type="submit" class="settings--button <?php checkError('changed_password', 'success')?>" value="Zmień hasło">
          </form>
          <form action="php/changeSettings.php" method="post" class="settings--form">
            <input type="text" name="city" class="settings--input <?php checkError('e_city', 'error')?>" placeholder="Miasto" value="<?php echo $_SESSION['city']?>">
            <input type="text" name="post_code" class="settings--input <?php checkError('e_postcode', 'error')?>" placeholder="Kod Pocztowy" value="<?php echo $_SESSION['post_code']?>">
            <input type="text" name="address" class="settings--input <?php checkError('e_address', 'error')?>" placeholder="Ulica i mieszkanie" value="<?php echo $_SESSION['address']?>">
            <input type="submit" class="settings--button <?php checkError('changed_address', 'success')?>" value="Zaktualizuj adres">
          </form>
      </section>
    </main>
    <footer>
      <p>GYM SHOP &copy 2020</p>
    </footer>
  </body>
</html>
