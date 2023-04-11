<?php

include('../verifica-login.php');
include('../conexao.php');
$active = "Financeiro";
$data_mes = date('Y-m');
$where = '';
$fk_usuario = '';

if (isset($_GET['fk_usuario'])) {
    $fk_usuario = $_GET['fk_usuario'];
    $_SESSION['id_select'] = $fk_usuario;

    $where .= "
  AND fk_id_usuario = $fk_usuario
  ";
}

if (isset($_GET['data_mes'])) {
    $data_mes = $_GET['data_mes'];
    $_SESSION['data_mes'] = $data_mes;

    $where .= "
  AND DATE_FORMAT(data_entrada,'%Y-%m') = '$data_mes'
  ";
} else {
    $where .= "
    AND fk_id_usuario = 0
    ";
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Inicial</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <style>
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css");

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;

        }

        .row {

            padding: 0px;
            margin: 0px;
        }

        .header--topo {
            background: black;
            padding: 0px;
            margin: 0px;
        }

        .container-fluid {
            padding: 0px;
        }

        .text--titulo {
            margin-top: 10px;
            color: #fff;
        }

        h1 {
            font-family: 'Lato', sans-serif;
            font-weight: 300;
            letter-spacing: 2px;
            font-size: 48px;
        }

        .content {
            position: relative;
            height: 55vh;
            text-align: center;
            background-color: white;
        }

        .header {
            position: relative;
            text-align: center;
            background: #1c2130;
            color: white;
            padding: 0px;
        }

        .menu {
            justify-content: space-evenly;

        }

        .text-bg-danger {
            color: #000 !important;
            text-decoration: none;
            display: block;


        }

        .text-bg-success {
            color: #000 !important;
            text-decoration: none !important;
            display: block;


        }

        .card--item a:hover {
            text-decoration: none !important;

        }

        .card--item a {
            text-decoration: none !important;

        }

        .table--adm {
            color: #000 !important;
            background-color: #fff;


        }

        .table--header {
            width: 100%;
        }

        .table--border {
            border-bottom: #000 solid;
            border-width: 1px
        }

        .table--holerite {
            padding-top: 0 !important;
        }

        .table--bottom {
            margin-bottom: 0px !important;
            padding-bottom: 0px !important;
        }

        .table--top {
            padding-top: 0px !important;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">
</head>





<body>

    <?php
    include('../topo.php');
    ?>

    <div class="container-fluid">
        <div class="row">
            <?php
            include('../menu.php');
            ?>



            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <?php include('../alert.php'); ?>


                <h2 class="pt-3">Espelho do Holerite</h2>



                <div class="col-12">

                    <!-- Formulário pesquisar entre datas -->
                    <form class="row" action="">

                        <div class="col-md-6">
                            <label for="nome" class="form-label">
                                Colaborador:
                            </label>
                            <select required class="form-control" id="fk_usuario" name="fk_usuario">
                                <option value="">-- Selecione --</option>
                                <?php
                                $sql0 = "
            SELECT id_usuario , u.nome  
            FROM usuarios u 
            ORDER BY nome
            ";
                                $query3 = mysqli_query($conecta, $sql0);
                                while ($result1 = mysqli_fetch_object($query3)) {

                                    $selected = "";
                                    if ($fk_usuario == $result1->id_usuario) {
                                        $selected = "selected";
                                    }
                                    echo '
            <option ' . $selected . ' value="' . $result1->id_usuario . '"> ' . $result1->nome . ' </option>
            ';
                                    $nome1 = $result1->nome;
                                }

                                ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="data_mes" class="form-label">
                                Mês:
                            </label>
                            <input type="month" class="form-control" name='data_mes' value='<?php echo $data_mes; ?>'>
                        </div>

                        <div class="col-md-2 mt-4">
                            <input class="btn btn-secondary" type="submit" value="Pesquisar" name="PesqUsuario">
                        </div>

                    </form>
                </div>
                <div class="footer pt-3">
                    <a class="btn btn-outline-secondary" href="../Financeiro/index.php"> Voltar </a>
                </div>


                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <br>
                                <th scope="col">#</th>
                                <th scope="col">Colaborador</th>
                                <th scope="col">Profissão</th>
                                <th scope="col">Horas trabalhadas</th>
                                <th scope="col">Faltas Justificadas</th>
                                <th scope="col">Total de Hrs Trabalhadas</th>
                                <th scope="col">Salário Mensal</th>
                                <th scope="col">I.N.S.S </th>
                                <th scope="col">valor Convenio</th>
                                <th scope="col">Vale Transporte</th>
                                <th scope="col">Vale Refeição</th>
                                <th scope="col">Salário Líquido</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            function segundos_horas($segundos)
                            {

                                $horas = floor($segundos / 3600);
                                $minutos = floor($segundos % 3600 / 60);
                                $segundos = $segundos % 60;

                                return sprintf("%02d:%02d:%02d", $horas, $minutos, $segundos);
                            }



                            $sql = "
            SELECT m.id_profissao_setor , c.nome nome_colaborador , p.nome_profissao, p.cbo , s.nome_setor  , m.periodo,
             DATE_FORMAT(m.data_inicio,'%d/%m/%Y') data_inicio, DATE_FORMAT(m.data_fim,'%d/%m/%Y') data_fim, m.salario, m.inss, m.convenio, m.vale_transporte, m.vale_refeicao,t.faltas_justificadas,
             (
              SELECT CONCAT(
                  SUM(HOUR(total_hora)) + FLOOR(SUM(MINUTE(total_hora))/60) ,
                  ':' ,
                  LPAD(SUM(MINUTE(total_hora))%60 + FLOOR(SUM(SECOND(total_hora))/60),2,0) ,
                  ':' ,
                  LPAD(SUM(SECOND(total_hora))%60,2,0)
              )
              FROM temporizadores t
              WHERE fk_id_usuario = '$fk_usuario'
              AND DATE_FORMAT(data_entrada,'%Y-%m') = '$data_mes'
              GROUP BY fk_id_usuario
             ) horas_trabalhadas,
             
             (
              SELECT CONCAT(
              SUM(HOUR(faltas_justificadas)) + FLOOR(SUM(MINUTE(faltas_justificadas))/60) ,
              ':' ,
              LPAD(SUM(MINUTE(faltas_justificadas))%60 + FLOOR(SUM(SECOND(faltas_justificadas))/60),2,0) ,
              ':' ,
              LPAD(SUM(SECOND(faltas_justificadas))%60,2,0)
          ) 
          FROM temporizadores 
          WHERE fk_id_usuario = '$fk_usuario'
          AND DATE_FORMAT(data_entrada,'%Y-%m') = '$data_mes'
          GROUP BY fk_id_usuario
          )faltas_justificadas
         
            
            FROM profissoes_setores m
            JOIN colaboradores c ON m.id_colaborador = c.id_colaborador
            JOIN profissoes p ON p.id_profissao = m.id_profissao
            JOIN setores s ON m.id_setor = s.id_setor
            JOIN temporizadores t ON t.fk_id_usuario = c.fk_usuario
            
            WHERE 1=1
            $where
            ORDER BY faltas_justificadas DESC
            ";


                            $querry = mysqli_query($conecta, $sql);

                            if ($result = mysqli_fetch_array($querry)) {

                                $faltas_justificadas = $result['faltas_justificadas'];
                                $horas_trabalhadas = $result['horas_trabalhadas'];
                                $salario = $result['salario'];

                                //conta do salario
                                //transforma em segundos
                                $calc = 0;
                                list($horas, $minutos, $segundos) = explode(':', $horas_trabalhadas);
                                $calc = $horas * 3600 + $minutos * 60 + $segundos;

                                list($horas, $minutos, $segundos) = explode(':', $faltas_justificadas);
                                $calc2 = $horas * 3600 + $minutos * 60 + $segundos;
                                /////////////     
                                $salario_sec = $salario / 3600;

                                $total_horas_trab = $calc + $calc2;

                                $salario_liq = $total_horas_trab * $salario_sec;

                                $total_horas_trabalhadas = segundos_horas($total_horas_trab);
                                $_SESSION['total_horas_trabalhadas'] = $total_horas_trabalhadas;

                                //conta final

                                $salario_liquido = $salario_liq + $result['vale_transporte'] + $result['vale_refeicao'] - $result['inss'] - $result['convenio'];
                                $salario_bruto =  $salario_liq + $result['vale_transporte'] + $result['vale_refeicao'];
                                $total_desconto = $result['inss'] + $result['convenio'];
                                $salario_liq_contrInss = $salario_liq - $result['inss'];
                                $data_credito = $data_mes . '-01';






                                echo "
              <tr>
                  <td>$result[id_profissao_setor]</td>
                  <td>$result[nome_colaborador]</td>
                  <td>$result[nome_profissao]</td>
                  <td>$result[horas_trabalhadas]</td>
                  <td>$result[faltas_justificadas]</td>
                  <td>$total_horas_trabalhadas</td>
                  <td>R$" . number_format($result['salario'], 2, ',', '.') . "</td>
                  <td>R$" . number_format($result['inss'], 2, ',', '.') . "</td>
                  <td>R$" . number_format($result['convenio'], 2, ',', '.') . "</td>
                  <td>R$" . number_format($result['vale_transporte'], 2, ',', '.') . "</td>
                  <td>R$" . number_format($result['vale_refeicao'], 2, ',', '.') . "</td>
                  <td>R$" . number_format($salario_liquido, 2, ',', '.') . "</td>
                
                  
                </tr>
              ";




                                // While($result = mysqli_fetch_array($querry)){
                                //   echo"
                                //   <tr>
                                //       <td>$result[id_matricula]</td>
                                //       <td>$result[data_matricula]</td>
                                //       <td>$result[nome_aluno]</td>
                                //       <td>$result[nome_curso]</td>
                                //       <td>$result[periodo]</td>
                                //     </tr> <td>$result<?php echo $horas . ':' . str_pad($minutos_2, 2, "0", STR_PAD_LEFT) . ':' . str_pad($segundos_2, 2, "0", STR_PAD_LEFT);//   ";
                            }


                            ?>

                        </tbody>
                    </table>
                </div>
                            
               
            </main>
        </div>
    </div>


  







    <div class="container-fluid">

        <?php
        include('../menu.php');
        ?>

        <?php



        $sql = "
               SELECT * FROM temporizadores
               WHERE fk_id_usuario = $fk_usuario
               AND DATE_FORMAT(data_entrada,'%Y-%m') = '$data_mes'
               ";
        $query = mysqli_query($conecta, $sql);





        if (is_numeric($fk_usuario) && mysqli_num_rows($query) > 0) {

            $html = '
            <div class="row " style="background-color: #1c2130;">
            
            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 ">
            <a href="pdf.php" target="_blank" class="btn btn-outline-secondary my-4 ">

                Exportar <i class="bi bi-file-earmark-pdf"></i>
            </a>
        </div>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

            <div class=" table-reponsive">
                <table class="table table--adm table-striped table-sm">
                    <thead>
                        <tr>
                            <th class="text-center table--border">Recibo de Pagamento</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="border-bottom border-dark table--bottom tabele--top">
                                <table class="table table--adm table-striped table-sm m-0 ">
                                    <tr>
                                        <th width="10%">Empresa:</th> 
                                        <th>Instituto Educacional Monte-Verde</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>

                                    </tr>
                                    <tr>
                                        <th>Endereço:</th>
                                        <th>Rua Pascal</th>
                                        <th>Período:   ' . $result['data_inicio'] . ' </th>
                                        <th> </th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th>CNPJ:</th>
                                        <th>2321423324</th>
                                        <th>Data do Crédito :</th>
                                        <th> ' . $data_credito  . '</th>
                                        <th></th>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td class="table--bottom table--top">
              
                                <table class="table table--adm table-striped table-sm m-0 ">
                                    <tr>
                                        <th>Funcionário:</th>
                                        <th>' . $result['nome_colaborador'] . '</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th width="10%">Função:</th>
                                        <th>' . $result['nome_profissao'] . '</th>
                                        <th></th>
                                        <th> ' . $result['cbo'] . '</th> 
                                        <th></th>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr style="height: 20px; border-top:#000 2px solid; border-bottom:#000 2px solid">
                            <th>

                            </th>

                        </tr>

                        <tr>
                            <td class="table--holerite table--bottom">
                                <table class="table table--adm table-striped table-sm  table--bottom">
                                    <thead class="border-bottom border-dark text-center">
                                        <tr>
                                            <th class="border-end border-dark" width="5%">COD</th>
                                            <th class="border-end border-dark">Descrição</th>
                                            <th class="border-end border-dark" width="5%">Ref</th>
                                            <th class="border-end border-dark">Vencimentos</th>
                                            <th class="border-start border-end-0 border-dark">Descontos</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-end">
                                        <tr>

                                            <th class="border-end border-dark">01</th>
                                            <th class="text-start border-end border-dark">Sálario Mensal</th>
                                            <th class="border-end border-dark">' . $total_horas_trabalhadas . '</th>
                                            <th class="border-end border-dark ">R$ ' . $salario_liq_format = number_format($salario_liq, 2, '.', '') . '</th>
                                            <th class="border-bottom border-dark"></th>
                                        </tr>
                                        <tr>
                                            <th class="border-end border-dark">02</th>
                                            <th class="border border-dark text-start">INSS s/ Sálario</th>
                                            <th class="border border-dark">8.7</th>
                                            <th class="border border-dark"></th>
                                            <th class="border-bottom border-dark text-center">R$ ' . $result['inss'] . '</th>
                                        </tr>
                                        <tr>
                                            <th class="border-end border-dark">03</th>
                                            <th class="text-start border-end border-dark">Convênio</th>
                                            <th class="border-end border-dark"></th>
                                            <th class="border-end border-dark "></th>
                                            <th class="border-bottom border-dark  text-center">R$ ' . $result['convenio'] . ' </th>

                                        </tr>
                                        <tr>
                                            <th class="border-end border-dark">04</th>
                                            <th class="text-start border-end border-dark">Convênio Vale-Refeição</th>
                                            <th class="border-end border-dark"></th>
                                            <th class="border-end border-dark ">R$ ' . $result['vale_refeicao'] . '</th>
                                            <th class="border-bottom border-dark  text-center"></th>

                                        </tr>
                                        <tr>
                                            <th class="border-end border-dark">05</th>
                                            <th class="text-start border-end border-dark">Vale-Trasporte</th>
                                            <th class="border-end border-dark"></th>
                                            <th class="border-end border-dark ">R$' . $result['vale_transporte'] . ' </th>
                                            <th class="border-bottom border-dark pb-5  text-center"></th>

                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>Totais</th>
                                            <th class="border  border-dark">R$ ' . $salario_bruto_format = number_format($salario_bruto, 2, '.', '') . '</th>
                                            <th class="border border-end-0 border-dark ">R$ ' . $total_desconto . '</th>

                                        </tr>
                                        <tr class="border border-end-0 border-start-0 border-dark">
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th class="border  border-start-0 border-dark">Total liquido</th>
                                            <th>R$' . $salario_liquido_format = number_format($salario_liquido, 2, '.', '') . ' </th>

                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="table--top table--bottom">

                                <table class="table table--adm table-striped table-sm table--bottom">

                                    <tbody>
                                        <tr>
                                            <th>Salario Base</th>
                                            <th>Salario Contr.INSS</th>
                                            <th>Base Cálc FGTS</th>
                                            <th>FGTS do mês</th>
                                            <th>Bae Cálc. IRRF</th>
                                            <th>Faixa IRRF</th>

                                        </tr>
                                        <tr class="border-bottom border-dark">
                                            <th>R$ ' . $salario_liq . '</th>
                                            <th>R$  ' . $salario_liq_contrInss_format = number_format($salario_liq_contrInss, 2, '.', '') . ' </th>
                                            <th>R$ ' . $salario . ' </th>
                                            <th></th>
                                            <th></th>
                                            <th></th>

                                        </tr>





                                    </tbody>




                                </table>




                            </td>



                        </tr>
                        <tr>
                            <td class="table--top">
                                <table class="table table--adm table-striped table-sm">
                                    <tr>
                                        <th class="border-end border-dark">Data:</th>
                                        <th class="border-bottom border-dark">Assinatura:</th>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
            </div>
            
            
            
            ';









            echo $html;
        } else {
        }

        ?>
         

        


         
    </div>
   

    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>

    <script src="../js/dashboard.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>