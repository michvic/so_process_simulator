<?php
include_once "../models/Memory.php";
include_once "../lib/header.php";

if(isset($_POST['iniciar']))
{
    $memory = new Memory();

    $value = $_POST['value'];
    $memory->initMemory($value);
    $_SESSION['memory'] = serialize($memory);
} else if (isset($_POST['novo-processo']))
{
    $memory = unserialize($_SESSION['memory']);
    switch($_POST["alg"])
    {
        case '1':{
            $memory->addProcessFirstFit($_POST['valor']);
            break;
        }
        case '2':{
            $memory->addProcessBestFit($_POST['valor']);
            break;
        }
        case '3':{
            $memory->addProcessWorstFit($_POST['valor']);
            break;
        }
    }
    $_SESSION['memory'] = serialize($memory);
} else if(isset($_POST['remover']))
{
    $memory = unserialize($_SESSION['memory']);
    $memory->remove($_POST['nome']);

    $_SESSION['memory'] = serialize($memory);   
} else if(isset($_POST['apagar']))
{
    session_abort();
    header("Location: ../index.php");
}
?>
<div class="container">
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col"><?php print_r(unserialize($_SESSION['memory'])->getCells());?></div>
    <div class="col-sm-4">
        <form action="Principal.php" method="POST">
            <h2>Adicionar novo processo</h2>
            <div class="form-group">
                <label for="metodo">Algoritmo de alocação</label>
                <select name="alg" class="form-control">
                    <option value="1">First Fit</option>
                    <option value="2">Best Fit</option>
                    <option value="3">Wost Fit</option>
                </select>
            </div>
            <div class="form-group">
                <label for="valor">Tamanho do novo processo</label>
                <input type="number" name="valor" class="form-control">
            </div>
            <input type="submit" class="btn btn-primary" name="novo-processo" value="adicionar">
        </form>
        <form action="Principal.php" method="POST">
            <h2>Remover Processo</h2>
            <div class="form-group">
                <label for="nome">Nome do processo</label>
                <input type="text" maxlength='1' name="nome" class="form-control">
            </div>
            <input type="submit" name="remover" class="btn btn-danger" value="remover">
        </form>
        <form action="Principal.php" method="POST">
            <input type="submit" value="Apagar Memoria" class="btn btn-warning" name="apagar">
        </form>
    </div>
</div>
</div>
</div>
<?php
include "../lib/footer.php";
?>