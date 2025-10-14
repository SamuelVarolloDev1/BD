<?php
//Inicia a sessão no PHP
session_start();

//Controla as páginas
//Se a variável PAGINA ainda não estiver definida, inicializa como 0
if (!isset($_SESSION['PAGINA']))
    $_SESSION['PAGINA'] = 0;
//Se MUDARPAG for passado via GET, a página muda
if (isset($_GET['MUDARPAG']))
    $_SESSION['PAGINA'] += (int)$_GET['MUDARPAG'];

//Conecta ao banco usando PDO
$oCon = new PDO('mysql:host=localhost; dbname=BANCOCOMUM', 'Aluno2DS', 'SenhaBD2');
//Define quantos registros aparecerão na página
$nQtdeReg = 20;

//Verifica se txtNome foi enviado
if(isset($_GET['txtNome']))
	//Se o nome não estiver vazio
    if(strlen(trim($_GET['txtNome'])) != 0)
		//Se o código for diferente de 0, é uma edição
        if($_GET['txtCod'] != 0)
        {
			//Monta o SQL para atualizar o registro
            $cSQL = "UPDATE EXERCICIO SET EXRDESCRICAO = '" . trim($_GET['txtNome']) . "' WHERE EXRCODIGO = " . $_GET['txtCod'];
            //Executa o SQL
			$oCon->exec($cSQL);
        }
        else
        {
			//Se o código for 0, é uma inserção
            $cSQL = "INSERT INTO EXERCICIO (EXRDESCRICAO) VALUES ('" . trim($_GET['txtNome']) . "')";
            $oCon->exec($cSQL);
        }

		//Se um campo foi selecionado pelo radio button, o código correspondente é excluído
        if(isset($_GET['radSelecao']))
        {
            $cSQL = "DELETE FROM EXERCICIO WHERE EXRCODIGO = " . ((int)$_GET['radSelecao']);
            $oCon->exec($cSQL);
        }

$nCod = 0;
$cNome = "";

//Se foi passado o código de alteração(CODALT) via GET
if(isset($_GET['CODALT']))
{
	//Faz uma consulta com esse código no banco
    $cSQL = "SELECT * FROM EXERCICIO WHERE EXRCODIGO = " . ((int)$_GET['CODALT']);
    //Se encontrar o registro, os campos do form são preenchidos
	if($vReg = $oCon->query($cSQL, PDO::FETCH_ASSOC)->fetch())
    {
        $nCod = $vReg['EXRCODIGO'];
        $cNome = $vReg['EXRDESCRICAO'];
    }
}
?>

<html>
    <body>
        <form>
			<!--Campo oculto com o código para identificar se é um valor novo ou se é uma edição -->
            <input type="hidden" name="txtCod" value="<?= $nCod ?>" />
            <input name="txtNome" value="<?= $cNome ?>"/>
        </form>
        <form action="">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Dt. Inclusão</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
					//SQL para buscar os registros da página atual
                    $cSQL = "SELECT * FROM EXERCICIO ORDER BY EXRDATAINCLUSAO DESC LIMIT " . ($_SESSION['PAGINA'] * $nQtdeReg) . ", $nQtdeReg";
                    //Loop para exibir os registros como linhas da tabela
					foreach($oCon->query($cSQL, PDO::FETCH_ASSOC) as $vReg)
                       echo '<tr>' .
                            '  <td><input type="radio" name="radSelecao" value="' . $vReg['EXRCODIGO']  . '" /></td>' .
                            '  <td><a href="?CODALT=' . $vReg['EXRCODIGO'] . '">' . $vReg['EXRDESCRICAO'] .'</a></td>' .
                            '  <td>' . $vReg['EXRDATAINCLUSAO'] .'</td>' .
                            '</tr>';
                    ?>
                </tbody>
            </table>
            <button name="btnExcluir" type="button" onClick="if(confirm('Deseja realmente excluir o registro?\nEssa operação não poderá ser desfeita'))
                this.parentElement.submit()
            ">Remover seleção</button>
            <a href="?MUDARPAG=1">Próxima Página</a>
        </form>
    </body>
</html>