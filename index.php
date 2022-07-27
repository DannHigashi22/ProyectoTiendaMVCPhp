<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bibrant-ShopCL</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <!--Cabecera-->
    <header id="header">
        <div id="logo">
            <img src="assets/img/camiseta.png" alt="LogoDeBibrant-ShopCL">
            <a href="index.php">
                <h1>Bibrant-ShopCL</h1>
            </a>
        </div>
    </header>
    <!--Menu-->
    <nav id="menu">
        <ul>
            <li><a href="">inicio</a></li>
            <li><a href="">Categoria</a></li>
        </ul>
    </nav>
    <main id="content">
    <!--BarraLateral-->
    <aside id="aside">
        <div class="block-aside" id="login">
            <form action="" method="post">
                <label for="email">Email</label>
                <input type="email" name="email">
                <label for="pass">Contraseña</label>
                <input type="password" name="pass">
                <input type="submit" value="Enviar">
            </form>
            <a href="">Mis pedidos</a>
            <a href="">Gestinar pedidos</a>
            <a href="">gestinar Categorias</a>
        </div>
    </aside>
    <!--Contenido Principal-->
    <section id="main">
        <div class="product">
            <img src="assets/img/camiseta.png" alt="Articulo">
            <h2>Camiseta Azul Holgada</h2>
            <p>30.000 CLP</p>
            <a href="">Añadir al Carro</a>
        </div>
        <div class="product">
            <img src="assets/img/camiseta.png" alt="Articulo">
            <h2>Camseta Azul Holgada</h2>
            <p>30.000 CLP</p>
            <a href="">Añadir al Carro</a>
        </div>
    </section>
    </main>
    <!--Footer-->
    <footer id="footer">
        <p>Desarrollado por Bibrant-ShopCL &COPY; <?=date('Y')?></p>
    </footer>

    
</body>
</html>