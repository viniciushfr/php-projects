<?php

$valor1 = $_POST['valor1'];
$valor2 = $_POST['valor2'];

echo $valor1;
echo $valor2;



echo "<br>";
echo soma($valor1,$valor2);





function soma($val1, $val2){
    return $val1+$val2;
}
?>