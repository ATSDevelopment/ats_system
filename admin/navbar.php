<link rel="stylesheet" type="text/css" href="css/navbar.css">

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <!--<img src="img/ats_logo.jpg" style="max-width:50px" />-->
                ATS System
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#">Meus Projetos</a>
                </li>
                <li>
                    <a href="#">Minhas Tarefas</a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Admin <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="funcionarios_listar.php">Gerenciar Funcionários</a>
                        </li>
                        <li>
                            <a href="projetos_listar.php">Gerenciar Projetos</a>
                        </li>
                        <li>
                            <a href="#">Gerenciar Clientes</a>
                        </li>
                        <li>
                            <a href="#">Gerenciar Tarefas</a>
                        </li>
                        <li>
                            <a href="#">Gerenciar Downloads</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Carlos Rodrigues <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user_img">
                            <img src="img/perfil/default.jpg">
                        </li>
                        <li>
                            <a href="#">Editar Perfil</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="#">Sair</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>