<?php
session_start();

    if(!isset($_POST['cost']) || !isset($_SESSION['user_id'])){
        header('Location: cart.php');
        exit();
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Płatność blikiem</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="blik--body">
    <div class="blik--free-code">
        <div class="code"></div>
        <div class="timer">120 sek</div>
    </div>
    <main class="blik">
        <img class="blik--logo" src="img/blik.png" alt="logo blika">
        <label class="blik--code">
            <input type="text" name="code" class="blik--input" maxlength="6" onkeyup="this.value=this.value.replace(/[^\d]/,'')" autofocus>
            <div class="dashes">
                <div class="dash"></div>
                <div class="dash"></div>
                <div class="dash"></div>
                <div class="dash"></div>
                <div class="dash"></div>
                <div class="dash"></div>
            </div>
        </label>
        <div class="blik--cost">Kwota: <?php echo $_POST['cost']?> zł</div>
        <button class="blik--button">Zapłać</button>
    </main>
    <div class="blik--completed">
        <div class="completed--header">Transakcja zakończona sukcesem</div>
        <div class="completed--mark">&#10004;</div>
        <a href="index.php" class="completed--link">Wróć na stronę sklepu</a>
    </div>
    <script>
        const blik = {
            time: 120,
            timerDiv: document.querySelector('.timer'),
            input: document.querySelector('.blik--input'),
            init(){
                this.setCode();

                this.timer = setInterval(() => {
                    this.time--;
                    this.timerDiv.innerHTML = this.time + ' sek';
                    if(this.time <= 0) {
                        this.setCode();
                        this.time = 120;
                    }
                }, 1000);
                this.bind();

            },
            randomCode(){
                let code = '';
                for(let i = 0;  i < 6; i++){
                    code += Math.floor(Math.random() * 10);
                }
                return code;
            },
            setCode(){
                const div = document.querySelector('.code');
                this.code = this.randomCode();
                div.innerHTML = this.code;
            },
            bind(){
                document.querySelector('.blik--button').addEventListener('click', this.checkCode.bind(this));
            },
            checkCode(){
                if(this.code === this.input.value){
                    this.order();
                } else {
                    this.input.parentNode.classList.add('blik--animation');
                    setTimeout(() => {
                        this.input.parentNode.classList.remove('blik--animation');

                    }, 500);
                }
            },
            order(){
                const data = new FormData();
                data.append('cost', '<?php echo $_POST['cost']?>');
                data.append('user_id', <?php echo $_SESSION['user_id']?>);
                data.append('products', '<?php echo $_POST['products']?>');
                <?php
                    unset($_POST['cost']);
                    unset($_POST['products']);
                ?>
                console.log(data.get('products'));
                fetch('php/order.php', {
                    method: 'post',
                    body: data,
                }).then(res=>{
                    const data2 = new FormData();
                    data.append('flag', 'true');
                    fetch('php/emptyCart.php', {
                        method: 'post',
                        body: data
                    }).then(res=>{
                        document.querySelector('.blik').style.display= "none";
                        document.querySelector('.blik--completed').style.display= "flex";
                    })
                });
            }
        }

        blik.init();

    </script>
</body>
</html>