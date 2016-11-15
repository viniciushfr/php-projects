<?php
	
  include('../mPDF/mpdf.php');
  $date = new DateTime();
  $date->setTimezone(new DateTimeZone('America/Sao_Paulo'));
  $html = "
	 <fieldset>
	 	<h1>Relatorio de produtos em estoque</h1>
	 	<h3>Consulta realizada em:".$date->format("d/m/Y")."
	 	as ".$date->format("H:m")."</h3>
	 </fieldset>";
	session_start();
	$mpdf=new mPDF(); 
	$mpdf->SetDisplayMode('fullpage');
	$css = file_get_contents("../../css/bootstrap.css");
	$mpdf->WriteHTML($css,1);
	$mpdf->WriteHTML($html.$_SESSION["relatorioEstoque"]);
	$mpdf->Output("relatorio_estoque.pdf",'D');

 ?>