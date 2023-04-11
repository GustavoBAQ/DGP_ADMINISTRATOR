<?php
include('../verifica-login.php');
include('../conexao.php');

use Dompdf\Dompdf;

function segundos_horas($segundos)
{

    $horas = floor($segundos / 3600);
    $minutos = floor($segundos % 3600 / 60);
    $segundos = $segundos % 60;

    return sprintf("%02d:%02d:%02d", $horas, $minutos, $segundos);
}



$data_passada = date('Y-m', strtotime('-1 month'));

$data_passada = date('Y-m', strtotime('-1 month'));
if(date("d m Y") != date("t m y")){
   
    $where = "
    AND DATE_FORMAT(data_entrada,'%Y-%m') = '$data_passada'
  ";
}


if (isset($_SESSION['UsuarioID'])) {
    
    $usuario_id = $_SESSION['UsuarioID'];

    $sql =  "
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
      WHERE fk_id_usuario = '$usuario_id'
      AND DATE_FORMAT(data_entrada,'%Y-%m') = '$data_passada'
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
    WHERE fk_id_usuario = '$usuario_id'
    AND DATE_FORMAT(data_entrada,'%Y-%m') = '$data_passada'
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

    $query = mysqli_query($conecta, $sql);

    if ($result = mysqli_fetch_array($query)) {

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

        
    //    $total_horas_trabalhadas = $_SESSION['total_horas_trabalhadas'] ;
    $total_horas_trabalhadas = segundos_horas($total_horas_trab);

        //conta final

        $salario_liquido = $salario_liq + $result['vale_transporte'] + $result['vale_refeicao'] - $result['inss'] - $result['convenio'];
        $salario_bruto =  $salario_liq + $result['vale_transporte'] + $result['vale_refeicao'];
        $total_desconto = $result['inss'] + $result['convenio'];
        $salario_liq_contrInss = $salario_liq - $result['inss'];
        
    

        $html = '
<html>
<head>
<link rel="stylesheet" href="http://localhost/dgp/sistema/css/pdf.css">

</head>
<body>

                    <table >
                        <thead>
                            <tr>
                                <th style="text-align: center">Recibo de Pagamento</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    <table>
                                    <tr>
                                            
                                            <th >Empresa:</th>
                                            <th colspan="3">Instituto Educacional Monte-Verde</th>
                                           </tr>
                                        <tr class="tabela--width">
                                            <th>Endereço:</th>
                                            <th>Rua Pascal</th>
                                            <th>Período:</th>
                                            <th>'. $result['data_inicio'].'</th>
  
                                         </tr>
                                        <tr>
                                            <th>CNPJ:</th>
                                            <th>2321423324</th>
                                            <th>Data do Crédito <br>'.date('t/m/Y', strtotime('-1 month')).'</th>
                                            <th></th>

                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td class="table--bottom table--top">
                                    <table class=" table--adm  ">
                                        <tr class="tabela--width">
                                            <th>Funcionário:</th>
                                            <th colspan="3">'.$result['nome_colaborador'].'</th>
                                        </tr>
                                        <tr>
                                            <th width="10%">Função:</th>
                                            <th>'.$result['nome_profissao'].'</th>
                                            <th></th>
                                            <th>'.$result['cbo'].'</th>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr >
                                <th style="height: 15px;">

                                </th>

                            </tr>

                            <tr>
                                <td >
                                    <table class="border--th">
                                        <thead >
                                            <tr class="tabela--width">
                                                <th  width="5%">COD</th>
                                                <th >Descrição</th>
                                                <th  width="5%">Ref</th>
                                                <th >Vencimentos</th>
                                                <th >Descontos</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <tr>

                                                <th >01</th>
                                                <th >Sálario Mensal</th>
                                                <th >'.$total_horas_trabalhadas.'</th>
                                                <th >R$'.$salario_liq_format = number_format($salario_liq, 2, '.', '').'</th>
                                                <th ></th>
                                            </tr>
                                            <tr>
                                                <th >02</th>
                                                <th >INSS s/ Sálario</th>
                                                <th ></th>
                                                <th ></th>
                                                <th >R$'. $result['inss'].'</th>
                                            </tr>
                                            <tr>
                                                <th >03</th>
                                                <th >Convênio</th>
                                                <th ></th>
                                                <th ></th>
                                                <th >R$'.$result['convenio'].'</th>

                                            </tr>
                                            <tr>
                                                <th >04</th>
                                                <th >Convênio Vale-Refeição</th>
                                                <th ></th>
                                                <th >R$ '.$result['vale_refeicao'].'</th>
                                                <th ></th>

                                            </tr>
                                            <tr>
                                                <th >05</th>
                                                <th >Vale-Trasporte</th>
                                                <th ></th>
                                                <th >R$ '.$result['vale_transporte'].'</th>
                                                <th ></th>

                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th style="background-color: #D9D9D9;">Totais</th>
                                                <th style="background-color: #D9D9D9;">R$'.$salario_bruto_format = number_format($salario_bruto, 2, '.', '').'</th>
                                                <th style="background-color: #D9D9D9;">R$'.$total_desconto.'</th>

                                            </tr>
                                            <tr >
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th style="background-color: #D9D9D9;">Total liquido</th>
                                                <th style="background-color: #D9D9D9;">R$'.$salario_liquido_format = number_format($salario_liquido, 2, '.', '').'</th>

                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="table--top table--bottom">

                                    <table class="table table--adm  table--bottom">

                                        <tbody>
                                            <tr>
                                                <th>Salario Base</th>
                                                <th>Salario Contr.INSS</th>
                                                <th>Base Cálc FGTS</th>
                                                <th>FGTS do mês</th>
                                                <th>Bae Cálc. IRRF</th>
                                                <th>Faixa IRRF</th>

                                            </tr>
                                            <tr >
                                                <th>R$ '.$salario.'</th>
                                                <th>R$ '.$salario_liq_contrInss_format = number_format($salario_liq_contrInss, 2, '.', '').'</th>
                                                <th>R$'.$salario.'</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>

                                            </tr>





                                        </tbody>




                                    </table>




                                </td>
                                


                            </tr>
                            <tr>
                            <td class="">
                                    <table class="table table--adm">
                                        <tr>
                                            <th class="border-end border-dark">Data:</th>
                                            <th class="border-bottom border-dark">Assinatura:</th>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
               
</body>
</html>



';
// echo $html;exit;

        require '../dompdf/vendor/autoload.php';



        $dompdf = new Dompdf(['enable_remote' => true]);
        $dompdf->setPaper('A4');
        $dompdf->loadHtml($html);
        // (Opcional) Tipo do papel e orientação
        // Render HTML para PDF
        $dompdf->render();
        // Download do arquivo
        $dompdf->stream('holerite.pdf', [
            'compress' => true,
            'Attachment' => true,

        ]);
        
    } else {
        $_SESSION['tipo'] = 'danger';
        $_SESSION['mensagem'] = 'Matricula não encontrada';
    }
}
// echo $html;
?>
