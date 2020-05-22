<?php
  session_start();
  require_once "php/connect.php";

  function isLogged(){
    if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) return true;
    else return false;
  }
  if(isLogged()) header('Location: index.php');

  function checkError($error){
    if(isset($_SESSION[$error])){
      echo 'class="register--label error" data-content="'.$_SESSION[$error].'"';
      unset($_SESSION[$error]);
    } else {
      echo 'class="register--label"';
    }
  }
  function savedData($data){
    if(isset($_SESSION[$data])){
      echo 'value="'.$_SESSION[$data].'"';
      unset($_SESSION[$data]);
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
          <li class="nav--item"><a href="login.php" class="nav--link">Logowanie</a></li>
          
          
        </ol>
      </nav>
    </header>
    <main>
      <section class="register">
        <h1>Rejestracja</h1>
            <form method="post" action="php/register.php" class="register--form">
            <div class="register--account">
              <label <?php checkError('e_username', 'error')?>>
                <input type="text" name="username" class="register--input" placeholder="Nazwa użytkownika" <?php savedData('r_username')?>>
              </label>
              <label <?php checkError('e_password', 'error')?>><input type="password" name="password" class="register--input" placeholder="Hasło"></label>
              <label <?php checkError('e_repassword', 'error')?>><input type="password" name="re_password" class="register--input" placeholder="Powtórz hasło"></label>
              <label <?php checkError('e_email', 'error')?>><input type="email" name="email" class="register--input" placeholder="Email"<?php savedData('r_email')?>></label>
              <label class="register--label"><label><input type="checkbox" name="rules" class="register--checkbox <?php checkError('e_rules', 'error')?>"> Akceptuję regulamin</label> 
            </div>
            <div class="register--personal">
              <label <?php checkError('e_name', 'error')?>><input type="text" name="name" class="register--input" placeholder="Imię" <?php savedData('r_name')?>></label>
              <label <?php checkError('e_lastname', 'error')?>><input type="text" name="lastname" class="register--input" placeholder="Nazwisko" <?php savedData('r_lastname')?>></label>
              <label <?php checkError('e_city', 'error')?>><input type="text" name="city" class="register--input" placeholder="Miejscowość" <?php savedData('r_city')?>></label></label>
              <label <?php checkError('e_postcode', 'error')?>><input type="text" name="post_code" class="register--input <?php checkError('e_postcode', 'error')?>" placeholder="Kod pocztowy" <?php savedData('r_postcode')?>></label>
              <label <?php checkError('e_address', 'error')?>><input type="text" name="address" class="register--input" placeholder="Ulica i mieszkanie" <?php savedData('r_address')?>></label>
            </div>
            <input type="submit" class="register--button" value="Zarejestruj się">
            </form>
      </section>
    </main>
    <footer>
      <p>GYM SHOP &copy 2020</p>
    </footer>
  </body>
</html>
