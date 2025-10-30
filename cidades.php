<?php
$oCon = new PDO('mysql:host=localhost; dbname=BANCOG05_A', 'Aluno2DS', 'SenhaBD2');

$cSQL = "SELECT CDDCODIGO, CDDNOME FROM CIDADES";
if(isset($_GET['ESTADO'])){
    $cSQL .= " WHERE CDDESTADO = '" . $_GET['ESTADO'] . "'";
}
else{
    $cSQL = "WHERE 1 = 2";
}
?>

<html>
    <body>
        <table>
            <?php
            $nQtde = 0;
            foreach($oCon->query($cSQL, PDO::FETCH_ASSOC) as $vReg)
            {
                echo '<tr>';
                foreach($vReg as $cNome=>$cCampo){
                    echo "<td>$cCampo</td>";
                }
                echo "</tr>";
                $nQtde++;
            }

            if($nQtde == 0){
                echo "Nenhum registro encontrado";
            }
            ?>
        </table>
    </body>
</html>