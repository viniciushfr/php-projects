<?php
	
  include('../mPDF/mpdf.php');
  session_start();
  $date = new DateTime();
  $date->setTimezone(new DateTimeZone('America/Sao_Paulo'));
  $html = "
	 <fieldset>
	 	<h1>Relatorio de operações</h1>
	 	<h3>Consulta realizada em: ".$date->format("d/m/Y")."
	 	as ".$date->format("H:m")."</h3><h3>".
	 	$_SESSION['relatorioLancamentos']['tipo']."  do dia: ".  $_SESSION['relatorioLancamentos']['data']."</h3>
	 </fieldset>";
	$tabela = "<table class='table table-bordered'>
    <thead>
      <tr>
        <th>Data</th>
        <th>Valor</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody id='compra-table-body'>".
    $_SESSION["relatorioLancamentos"]["html"].
    " </tbody>
     </table>";
	$mpdf=new mPDF(); 
	$mpdf->SetDisplayMode('fullpage');
	$css = file_get_contents("../../css/bootstrap.css");
	$mpdf->WriteHTML($css,1);
	$mpdf->WriteHTML($html.$tabela,2);
	$mpdf->Output("lancamentos.pdf",'D');

 ?>