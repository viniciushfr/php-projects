<?php
	
  include('../mPDF/mpdf.php');
  session_start();
  $date = new DateTime();
  $date->setTimezone(new DateTimeZone('America/Sao_Paulo'));
  $html = "
	 <fieldset>
	 	<h1>Relatorio de Caixa</h1>
	 	<h3>Consulta realizada em: ".$date->format("d/m/Y")."
	 	as ".$date->format("H:m")."</h3>
	 </fieldset>";
	
    $_SESSION["relatorioCaixa"]["html"];
   
	$mpdf=new mPDF(); 
	$mpdf->SetDisplayMode('fullpage');
	$css = file_get_contents("../../css/bootstrap.css");
	$mpdf->WriteHTML($css,1);
	$mpdf->WriteHTML($html.$_SESSION["relatorioCaixa"]["html"],2);
	$mpdf->Output("relatorio_caixa.pdf",'D');

 ?>