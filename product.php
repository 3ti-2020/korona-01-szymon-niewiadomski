<?php
  session_start();
  require_once "php/connect.php";

  function isLogged(){
    if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) return true;
    else return false;
  }
  if(isset($_GET['product'])){
    $id = htmlentities($_GET['product']);
    $sql = "SELECT * FROM products WHERE product_id = $id";
    $result = $db->query($sql);

    if($result->num_rows > 0){
      $data = $result->fetch_array(MYSQLI_ASSOC);
    } else header('Location: index.php');
  } else header('Location: index.php');

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
      <h1 class="subpage--header">Podgląd produktu</h1>
        <div class="product--preview" data-id="<?php echo $data['product_id']?>">
          <img class="preview--img" src=<?php echo 'img/products/'.$data['img'].'.jpg'?> alt="Obraz produktu">
          <table class="preview--table">
            <tr>
              <th>Produkt</th>
              <td class="preview--name"><?php echo $data['name']?></td>
            </tr>
            <tr>
              <th>Opis</th>
              <td><?php echo $data['description']?></td>
            </tr>
            <tr>
              <th>Cena</th>
              <td><?php echo $data['price']?> zł</td>
            </tr>
            <tr>
              <th>Kategoria</th>
              <td><?php echo $data['category']?></td>
            </tr>
            <tr>
              <?php
              if(isLogged()) echo ' <td class="preview--button button--addToCart" colspan="2">Dodaj do koszyka</td>';
              else echo '<td class="preview--button button--login" colspan="2"><a href="login.php" class="preview--link">Zaloguj się</a></td>';
              ?>
            </tr>
          </table>
        </div>
      </section>
    </main>
    <footer>
      <p>GYM SHOP &copy 2020</p>
    </footer>
    <script src="js/previewProduct.js"></script>
  </body>
</html>
