<?php
	$endereco = $_GET['page'];
    if(empty($endereco)){
        $endereco="inicio.php";
    }else{
        
        $endereco = $endereco;
    }
	if (null !== $endereco){
		if (!empty($endereco)){
				if(!include_once($endereco)){
					echo "<center>Pagina '".$endereco."' não encontrada</center>";
				}
			}else{
			 include_once"inicio.php";
			}	
	}else{
		include_once"inicio.php";
	}

?>