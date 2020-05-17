<?php 
    if(isset($_SESSION['imgPerfil']) && $_SESSION['imgPerfil'] != "") {
        $img = "assets/images/".$_SESSION['imgPerfil'];
    } else {
        $img = "assets/images/default.png";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Site</title>
    <link rel="stylesheet" href=<?php echo BASE_URL."assets/css/normalize.css"; ?>>
    <link rel="stylesheet" href=<?php echo BASE_URL."assets/css/template.css"; ?>>
</head>
<body>
    <header>
        <span><a href="">Home</a></span>
        <nav>
            <a href=<?php echo BASE_URL."logof"; ?>>Sair</a>
        </nav>
    </header>

    <section id="sidenav">
        <header>
            <label id="photo">
                <img src="<?php echo $img; ?>" alt="">
                <span class="imgHover">clique para alterar</span>
            </label>
            <span><?php echo $_SESSION['email']; ?></span> 
        </header>
        <hr>
        <nav>
            <ul>
                <li><a href="">Menu 1</a></li>
                <li><a href="">Menu 2</a></li>
                <li><a href="">Menu 3</a></li>
                <li><a href="">Menu 4</a></li>
            </ul>
        </nav>

        <footer>Links</footer>
    </section>

    <div class="modal_box">
        <div class="modal_bg"></div>
        <div class="modal"></div>
    </div>

    <section id="main">
        <main>
            <?php $this->loadViewInTemplate($viewName,$viewData) ?>
        </main>

        <footer>Copyright</footer>
    </section>
    
    <script>
        var img = document.querySelector('#photo');
        var modal_box = document.querySelector('.modal_box');
        var modal_bg = document.querySelector('.modal_bg');
        var modal = document.querySelector('.modal');

        img.onclick = function() {
            modal.innerHTML = "Carregando...";
            modal_box.classList.add('show');

            let req = new XMLHttpRequest();
            req.onreadystatechange = function() {
                if(this.readyState == 4 && this.status == 200) {
                    modal.innerHTML = req.responseText;

                    var bt_modal = document.querySelector('.btnModal');
                    bt_modal.onclick = hidden;
                } 
                if(this.readyState == 4 && this.status != 200) {
                    alert("Não foi possível carregar o conteúdo!");
                }           
            }
            req.open('GET', <?php echo "'".BASE_URL."views/img_perfil.php'"; ?>);
            req.send(); 
        }
        modal_bg.onclick = hidden;
        
        function hidden() {
            modal_box.classList.remove('show');
        }          
    </script>
</body>
</html>