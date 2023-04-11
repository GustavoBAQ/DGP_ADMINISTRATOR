<?php
include('../verifica-login.php');
include('../conexao.php');

use Dompdf\Dompdf;

//usar o bootstrap




if (isset($_SESSION['UsuarioID'])) {
    
    $usuario_id = $_SESSION['UsuarioID'];

    $sql =
        "SELECT 
c.nome nome_colaborador, c.endereco, 
p.nome_profissao, s.nome_setor, p.cbo,
y.periodo,y.salario, y.inss,y.convenio,y.vale_transporte,y.vale_refeicao, 
CONCAT(YEAR(y.data_inicio),'/', MONTHNAME(y.data_inicio)) data_inicio 
FROM colaboradores c
JOIN profissoes_setores y ON y.id_colaborador = c.id_colaborador
JOIN profissoes p ON p.id_profissao = y.id_profissao
JOIN setores s ON s.id_setor = y.id_setor
WHERE fk_usuario = $usuario_id";

    $query = mysqli_query($conecta, $sql);

    if (mysqli_num_rows($query) > 0) {

        $result = mysqli_fetch_object($query);

        $nome = $result->nome_colaborador;
        $endereco = $result->endereco;
        $nome_profissao = $result->nome_profissao;
        $cbo = $result->cbo;
        $periodo = $result->periodo;
        $salario = $result->salario;
        $inss = $result->inss;
        $convenio = $result->convenio;
        $vale_transporte = $result->vale_transporte;
        $vale_refeicao = $result->vale_refeicao;
        $data_inicio = $result->data_inicio;

        $data_atual = date('d/m/Y');
        $inss_salario = $salario - $inss;
        $total_desconto = $inss + $vale_refeicao + $vale_transporte + $convenio;
        $total_liquido = $salario - $total_desconto;

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
                                            <th>'.strtoupper($data_inicio).'</th>
  
                                         </tr>
                                        <tr>
                                            <th>CNPJ:</th>
                                            <th>2321423324</th>
                                            <th>Data do Crédito <br>'.$data_atual.'</th>
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
                                            <th colspan="3">'.$nome.'</th>
                                        </tr>
                                        <tr>
                                            <th width="10%">Função:</th>
                                            <th>'.$nome_profissao.'</th>
                                            <th></th>
                                            <th>'.$cbo.'</th>
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
                                                <th >30</th>
                                                <th >R$'.$salario.'</th>
                                                <th ></th>
                                            </tr>
                                            <tr>
                                                <th >02</th>
                                                <th >INSS s/ Sálario</th>
                                                <th ></th>
                                                <th ></th>
                                                <th >R$'.$inss.'</th>
                                            </tr>
                                            <tr>
                                                <th >03</th>
                                                <th >Convênio</th>
                                                <th ></th>
                                                <th ></th>
                                                <th >R$'.$convenio.'</th>

                                            </tr>
                                            <tr>
                                                <th >04</th>
                                                <th >Convênio Vale-Refeição</th>
                                                <th ></th>
                                                <th ></th>
                                                <th >R$ '.$vale_refeicao.'</th>

                                            </tr>
                                            <tr>
                                                <th >05</th>
                                                <th >Vale-Trasporte</th>
                                                <th ></th>
                                                <th ></th>
                                                <th >R$ '.$vale_transporte.'</th>

                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th style="background-color: #D9D9D9;">Totais</th>
                                                <th style="background-color: #D9D9D9;">R$'.$salario.'</th>
                                                <th style="background-color: #D9D9D9;">R$'.$total_desconto.'</th>

                                            </tr>
                                            <tr >
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th style="background-color: #D9D9D9;">Total liquido</th>
                                                <th style="background-color: #D9D9D9;">R$'.$total_liquido.'</th>

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
                                                <th>R$ '.$inss_salario.'</th>
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
?>
// echo $html;
