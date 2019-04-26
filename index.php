<?php
/**
 * Created by PhpStorm.
 * User: Usuário
 * Date: 05/12/2018
 * Time: 21:49
 */
include "lib/header.php";
?>
<div class="container">
    <div class="row justify-content-center align-items-center">
    <form action="./views/Principal.php" method="POST">

    <div class="form-group">
        <label for="value">Valor: </label>
        <input type="number" name="value" class="form-control">
    </div>
        <input type="submit" name="iniciar" value="Inicia" class="btn btn-primary">
    </form>
    </div>
</div>
</body>
</html>
