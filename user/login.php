 <?php
 require "header.php";

 ?>
 <div class="container">
   <div class="row">
     <div class="col-md-4 col-md-offset-4">
       <div class="login-panel panel panel-default">
         <div class="panel-heading">
           <h3 class="panel-title">Login</h3>
         </div>
         <div class="panel-body">
           <form method="post" action="dao/cliente_dao.php?op=logar_cliente">
             <fieldset>
               <div class="form-group">
                 <input class="form-control" placeholder="Login" name="usuario" type="text" autofocus>
               </div>
               <div class="form-group">
                 <input class="form-control" placeholder="Senha" name="senha" type="password" value="">
               </div>

               <label>
                <a href="cadastro.php">Cadastre-se</a>
              </label>
              <!-- Change this to a button or input when using this as a form -->
              <button type="submit" class="btn btn-lg btn-success btn-block">Entrar</button>
              <?php
              if(array_key_exists("exist", $_GET)){
                $exist = $_GET['exist'];
               if ($exist == "false") {
                echo "<br><label>Usuário não encontrado!</label>";
              }
            }
            ?>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<?php
require "footer.php";
?>