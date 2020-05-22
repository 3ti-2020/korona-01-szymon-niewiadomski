<?php
  session_start();
  require_once "php/connect.php";

  function isLogged(){
    if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) return true;
    else return false;
  }
  if(!isLogged()) {
    header('Location: index.php');
    exit();
  }

  $user_id = $_SESSION['user_id'];
  $sql = "SELECT * FROM orders WHERE user_id = $user_id";
  $result =$db->query($sql);


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
      <section class="orders">
        <h1 class="subpage--header">Zamówienia</h1>
        <?php
          if($result->num_rows > 0){
            echo '<table class="orders--table">
              <tr>
                <th>Data</th><th>Status</th><th>Koszt</th><th>Produkty</th>
              </tr>';
            while($row = $result->fetch_array()){
              echo '<tr>';
                echo '<td>'.$row['date'].'</td><td>'.$row['status'].'</td><td>'.$row['cost'].' zł</td><td>'.$row['products'].'</td>';
              echo '</tr>';
            }
              
            echo '</table>';
          } else {
            echo '<div class="orders--empty"> Nie złożono jeszcze żadnych zamówień </div>';
          }
        ?>
      </section>
    </main>
    <footer>
      <p>GYM SHOP &copy 2020</p>
    </footer>
    <script type="module" src="js/cart.js"></script>
  </body>
</html>
