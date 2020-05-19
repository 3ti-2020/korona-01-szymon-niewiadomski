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
      <!-- <h1 class="logo">GYM SHOP</h1> -->
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
      <section class="products">
        <div class="product--preview">
          <img class="preview--img"src=<?php echo 'img/products/'.$data['img'].'.jpg'?> alt="Obraz produktu">
          <table class="preview--table">
            <tr>
              <th>Produkt</th>
              <td><?php echo $data['name']?></td>
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
              <td class="preview--button" colspan="2">Dodaj do koszyka</td>
            </tr>
          </table>
        </div>
      </section>
    </main>
    <footer>
      <p>GYM SHOP &copy 2020</p>
    </footer>
    <script src="index.js"></script>
  </body>
</html>
