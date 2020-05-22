<?php
  session_start();
  require_once "php/connect.php";

  function isLogged(){
    if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) return true;
    else return false;
  }
  if(!isLogged()) header('Location: index.php');

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
      <section class="cart">
        <h1 class="subpage--header">Koszyk</h1>
        <div class="cart--div">
          <div class="cart--list">
            <button class="cart--empty-button">
              OPRÓŻNIJ (<span class="cart--count"></span>)
            </button>
            <table class="cart--table">
              <tr class="cart--empty">
                <td>Koszyk jest pusty</td>
              </tr>
            </table>
          </div>
          <div class="cart--user">
            <?php
              echo '<div class="user--name">'.$_SESSION['name'].' '.$_SESSION['lastname'].'</div>';
              echo '<div class="user--address">
                <div class="address--text">'.$_SESSION['city'].' '.$_SESSION['post_code'].'<br> '.$_SESSION['address'].'</div>
                <div class="address--change"><a href="settings.php">Zmień adres</a></div>
              </div>';
            ?>
            <div class="cart--summary">
              <div class="summary--products summary--number"></div>
              <div class="summary--delivery summary--number"></div>
              <div class="summary--sum summary--number"></div>
            </div>
            <div class="cart--payment">
              <form method="post" action="blik.php">
                <input type="hidden" name="cost" required>
                <input type="hidden" name="products" required>
                <input type="submit" value="Zapłać" class="payment--submit" disabled>
              </form>
            </div>
          </div>
        </div>
      </section>
    </main>
    <footer>
      <p>GYM SHOP &copy 2020</p>
    </footer>
    <script type="module" src="js/cart.js"></script>
  </body>
</html>
