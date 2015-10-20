<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="index.php"><img alt="Brand" src="img/ats_logo.jpg" height="32px"></a>
</div>

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
  <ul class="nav navbar-nav">
    <li><a href="index.php">Home</a></li>
    <li><a href="#">Sobre</a></li>
    <li><a href="#">Downloads</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Área do Cliente <span class="caret"></span></a>
      <ul class="dropdown-menu">
        <?php 
        if (true) {
            echo " <li><a href='area_do_cliente.php?nav=projetos'>Perfil</a></li>
            <li role='separator' class='divider'></li>
            <li><a href='logout.php'>Sair</a></li>";
        }else{
            echo "<li><a href='login.php'>Entrar</a></li>"; 
        }
        ?>
    </ul>
</li>
</ul>
</div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>