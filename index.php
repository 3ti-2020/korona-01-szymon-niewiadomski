<?php
  session_start();
  require_once "php/connect.php";

  function isLogged(){
    if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) return true;
    else return false;
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
          <?php
            if(isLogged()){
              echo '<li class="nav--item nav--panel"> 
                Panel Użytkownika &#x25BC;
                <ol class="nav--submenu">
                  <li class="nav--subitem nav--user">Witaj '.$_SESSION['name'].'</li>
                  <li class="nav--subitem"><a href="cart.php" class="nav--sublink">Koszyk</a></li>
                  <li class="nav--subitem"><a href="orders.php" class="nav--sublink">Zamówienia</a></li>
                  <li class="nav--subitem"><a href="settings.php" class="nav--sublink">Ustawienia</a></li>
                  <li class="nav--subitem"><a href="php/logout.php" class="nav--sublink">Wyloguj</a></li>
                </ol>
              </li>';
            } else {
              echo '<li class="nav--item"><a href="login.php" class="nav--link">Logowanie</a></li>';
            }
          ?>
          
          
        </ol>
      </nav>
    </header>
    <main>
      <section class="products">
        <div class="products--filter">
            <div class="filter--header filter--div"></div>
            <div class="filter--sort filter--div">
            Sortuj:
              <select class="filter--select">
                <option value="none">Brak</option>
                <option value="price_asc">Od najtańszego</option>
                <option value="price_desc">Od najdroższego</option>
                <option value="alpha_asc">Od A do Z</option>
                <option value="alpha_desc">Od Z do A</option>
              </select>
            </div>
        </div>
        <ol class="products--list"></ol>
      </section>
    </main>
    <footer>
      <p>GYM SHOP &copy 2020</p>
    </footer>
    <script type="module" src="js/productsList.js"></script>
  </body>
</html>
