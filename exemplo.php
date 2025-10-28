<?php
//Inicia a sessão no PHP - Para variáveis de sessão(como session_start)
session_start();

//Controla as páginas
//Se a variável PAGINA ainda não estiver definida, inicializa como 0
if (!isset($_SESSION['PAGINA']))
    $_SESSION['PAGINA'] = 0;
//Se MUDARPAG for passado via GET(ex: ?MUDARPAG=1 ou -1), a página muda
if (isset($_GET['MUDARPAG']))
    $_SESSION['PAGINA'] += (int) $_GET['MUDARPAG'];

//Conecta ao banco usando PDO
$oCon = new PDO('mysql:host=localhost; dbname=BANCOCOMUM', 'Aluno2DS', 'SenhaBD2');
//Define quantos registros aparecerão na página
$nQtdeReg = 14;
//Variáveis para mensagem de feedback
$cTipoMensagem = "";
$cMensagem = "";
//Variáveis para pesquisa
$cPesquisa = "";

//Verifica se txtNome foi enviado via GET
if (isset($_GET['txtNome']))
    //Se o nome não estiver vazio
    if (strlen(trim($_GET['txtNome'])) != 0)
        //Se o código for diferente de 0, é uma edição
        if ($_GET['txtCod'] != 0) {
            //Monta o comando SQL para atualizar o registro existente
            $cSQL = "UPDATE EXERCICIO SET EXRDESCRICAO = '" . trim($_GET['txtNome']) . "' WHERE EXRCODIGO = " . $_GET['txtCod'];
            //Executa o comando e verifica se deu certo
            //Se der certo, mostra a mensagem de sucesso
            if ($oCon->exec($cSQL)) {
                $cTipoMensagem = "Exito";
                $cMensagem = "Alteração realizada com sucesso";
            }
            //Se der errado, mostra a mensagem de falha
            else {
                $cTipoMensagem = "Erro";
                $cMensagem = "Ocorreu erro ao alterar o registro: <br />" . $oCon->errorInfo()[2];
            }
        } else {
            //Se o código for 0, é uma inserção
            //Monta o comando de inserção
            $cSQL = "INSERT INTO EXERCICIO (EXRDESCRICAO) VALUES ('" . trim($_GET['txtNome']) . "')";
            //Executa o comando e verifica o resultado
            //Dependendo da execução, mostra a mensagem que está na variável $cMensagem
            if ($oCon->exec($cSQL)) {
                $cTipoMensagem = "Exito";
                $cMensagem = "Inclusão realizada com sucesso";
            } else {
                $cTipoMensagem = "Erro";
                $cMensagem = "Ocorreu erro ao incluir o registro: <br />" . $oCon->errorInfo()[2];
            }
        } else
		//Se o usuário clicou em "Pesquisar", salva o texto da pesquisa
        $cPesquisa = trim($_GET['txtNome']);

//Se um campo foi selecionado pelo radio button, o código correspondente é excluído
if (isset($_GET['radSelecao'])) {
    //Monta o comando para deletar o registro selecionado
    $cSQL = "DELETE FROM EXERCICIO WHERE EXRCODIGO = " . ((int) $_GET['radSelecao']);
    //Executa o comando e verifica o resultado
    //Dependendo da execução, mostra a mensagem que está na variável $cMensagem
    if ($oCon->exec($cSQL)) {
        $cTipoMensagem = "Exito";
        $cMensagem = "Registro deletado com sucesso";
    } else {
        $cTipoMensagem = "Erro";
        $cMensagem = "Ocorreu erro ao deletar o registro: <br />" . $oCon->errorInfo()[2];
    }
}

//Inicializa variáveis padrão
$nCod = 0;
$cNome = "";

//Se foi passado o código de alteração(CODALT) via GET (quando o usuário clica em um nome da tabela)
if (isset($_GET['CODALT'])) {
    //Faz uma consulta com base nesse código
    $cSQL = "SELECT * FROM EXERCICIO WHERE EXRCODIGO = " . ((int) $_GET['CODALT']);
    //Se encontrar o registro, os campos do form são preenchidos com esses dados
    if ($vReg = $oCon->query($cSQL, PDO::FETCH_ASSOC)->fetch()) {
        $nCod = $vReg['EXRCODIGO'];
        $cNome = $vReg['EXRDESCRICAO'];
    }
}
?>

<html>

<style>
    /* Importa fontes do Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap');

    /* Aplica a fonte para todos os elementos */
    * {
        box-sizing: border-box;
        font-family: 'Oswald', monospace;
    }

    /* Form de Inclusão/edição */
    form:first-of-type {
        margin: 10px 4%;
        width: 90%;

        &>input {
            width: 75%;
        }

        &>button {
            width: 12%;
        }

        &>label {
            display: block;
        }
    }

    /* Estilo da tabela */
    table {
        margin: 50px 4%;
        width: 90%;
        border: 1px double #CFCFCF;
    }

    /* Alterna as cores das linhas */
    tr:nth-child(odd) {
        background-color: #FCFCFC;
    }

    tr:nth-child(even) {
        background-color: #EDEDED;
    }

    /* Efeito para quando passar o mouse em cima de uma linha */
    table tbody tr:hover {
        background-color: #3090F3;
        color: ;
    }

    /* Cabeçalho da tabela */
    th {
        background-color: #606060;
        color: #FFFFFF;
        font-family: 'Raleway', sans-serif;
    }

    /* Mensagem de sucesso e erro */
    .Exito,
    .Erro {
        margin: 5px 4%;
        padding: 2px 10px 2px 50px;
        width: 90%;
    }

    .Exito {
        background-color: #CFFFCF;
        border: 1px solid #009000;
        border-left: 5px solid #009000;
    }

    .Erro {
        background-color: #FFCFCF;
        border: 1px solid #900000;
        border-left: 5px solid #900000;
    }
</style>

<body>
    <!-- Form de inclusão ou alteração -->
    <form>
        <label>Descrição</label>
        <!-- Campo oculto com o código para identificar se é um valor novo ou se é uma edição -->
        <input type="hidden" name="txtCod" value="<?= $nCod ?>" />
        <!-- Campo de texto para a descrição -->
        <input name="txtNome" value="<?= $cNome ?>" placeholder="Informe a descrição" />
        <!-- Botão para gravar as alterações feitas(Inserção, edição) -->
        <button name="cmdGravar">Gravar alterações</button>
		<!-- Botão para pesquisar -->
        <button name="cmdPesquisar">Pesquisar</button>
    </form>
    <!-- Painel de mensagem de sucesso ou erro, apenas quando o usuário fizer algo -->
    <div id="pnlMensagem" class="<?= $cTipoMensagem ?>">
        <span><?= $cMensagem ?></span>
    </div>
    <!-- Form para listagem, exclusão e navegação -->
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
                //Comando para listar os registros com base na página e filtro
                $cSQL = "SELECT EXRCODIGO, EXRDESCRICAO, DATE_FORMAT(EXRDATAINCLUSAO, '%d/%m/%Y %H:%I:%S') EXRDATAINCLUSAO FROM EXERCICIO WHERE EXRDESCRICAO LIKE '%$cPesquisa%' ORDER BY EXRDATAINCLUSAO DESC LIMIT " . ($_SESSION['PAGINA'] * $nQtdeReg) . ", $nQtdeReg";
                //Loop para exibir os registros como linhas da tabela
                foreach ($oCon->query($cSQL, PDO::FETCH_ASSOC) as $vReg)
                    echo '<tr>' .
                        //Radio para selecionar um registro(para exclusão)
                        '  <td><input type="radio" name="radSelecao" value="' . $vReg['EXRCODIGO'] . '" /></td>' .
                        //Nome do registro
                        '  <td><a href="?CODALT=' . $vReg['EXRCODIGO'] . '">' . $vReg['EXRDESCRICAO'] . '</a></td>' .
                        //Data de inclusão
                        '  <td>' . $vReg['EXRDATAINCLUSAO'] . '</td>' .
                        '</tr>';
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <!-- Botão de exclusão -->
                        <button name="btnExcluir" onClick="if(confirm('Deseja realmente excluir o registro?\nEssa operação não poderá ser desfeita'))
                this.parentElement.submit()
            ">Remover seleção</button>
                        <!-- Links de navegação -->
                        <a href="<?= $_SESSION['PAGINA'] == 0 ? ' # ' : '?MUDARPAG=-1' ?>">&lt;</a>
                        <a href="?MUDARPAG=1">&gt;</a>
                    </td>
                    <td>Pronto.</td>
                </tr>
            </tfoot>
        </table>
    </form>
</body>
</html>