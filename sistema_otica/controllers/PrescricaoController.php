<?php
include_once"../models/Prescricao.php";
include_once"../models/dao/PrescricaoDAO.php";

if(isset($_POST["btn-editar"])){
    echo "botao editar";
    $id = $_POST["id"];
    $numReceita = $_POST["numReceita"];
    $medico = $_POST["medico"];
    $data = $_POST["data"];
    
    $longeOdEsf = $_POST["longe-od-esf"];
    $longeOdCil = $_POST["longe-od-cil"];
    $longeOdEixo = $_POST["longe-od-eixo"];
    $longeOdDpn = $_POST["longe-od-dpn"];
    $longeOdAlt = $_POST["longe-od-alt"];
    
    $longeOeEsf = $_POST["longe-oe-esf"];
    $longeOeCil = $_POST["longe-oe-cil"];
    $longeOeEixo = $_POST["longe-oe-eixo"];
    $longeOeDpn = $_POST["longe-oe-dpn"];
    $longeOeAlt = $_POST["longe-oe-alt"];
    
    $pertoOdEsf = $_POST["perto-od-esf"];
    $pertoOdCil = $_POST["perto-od-cil"];
    $pertoOdEixo = $_POST["perto-od-eixo"];
    $pertoOdDpn = $_POST["perto-od-dpn"];
    $pertoOdAlt = $_POST["perto-od-alt"];
    
    $pertoOeEsf = $_POST["perto-oe-esf"];
    $pertoOeCil = $_POST["perto-oe-cil"];
    $pertoOeEixo = $_POST["perto-oe-eixo"];
    $pertoOeDpn = $_POST["perto-oe-dpn"];
    $pertoOeAlt = $_POST["perto-oe-alt"];
    
    $addPertoOd = $_POST["add-perto-od"];
    $addPertoOe = $_POST["add-perto-oe"];
    PrescricaoController::editarPrescricao($id, $numReceita, $medico, $data, $longeOdEsf, $longeOdCil,$longeOdEixo,$longeOdDpn,$longeOdAlt,$longeOeEsf,$longeOeCil,$longeOeEixo,$longeOeDpn,$longeOeAlt,$pertoOdEsf,$pertoOdCil,$pertoOdEixo,$pertoOdDpn,$pertoOdAlt,$pertoOeEsf,$pertoOeCil,$pertoOeEixo,$pertoOeDpn,$pertoOeAlt,$addPertoOd,$addPertoOe);
}
if(isset($_POST["excluir"])){
    PrescricaoController::excluirPrescricao($_POST["id"]);
}

class PrescricaoController{
    public static function cadastrarPrescricao(){
        if(isset($_POST['btn-cadastrar-prescricao'])){
            try {
                $params = array(null,
                                $_POST['num-receita'],
                                $_POST['medico'],
                                $_POST['data'],
                                $_POST['select-cliente'],
                                $_POST['longe-od-esf'],
                                $_POST['longe-od-cil'],
                                $_POST['longe-od-eixo'],
                                $_POST['longe-od-dpn'],
                                $_POST['longe-od-alt'],
                                $_POST['longe-oe-esf'],
                                $_POST['longe-oe-cil'],
                                $_POST['longe-oe-eixo'],
                                $_POST['longe-oe-dpn'],
                                $_POST['longe-oe-alt'],
                                
                                $_POST['perto-od-esf'],
                                $_POST['perto-od-cil'],
                                $_POST['perto-od-eixo'],
                                $_POST['perto-od-dpn'],
                                $_POST['perto-od-alt'],
                                $_POST['perto-oe-esf'],
                                $_POST['perto-oe-cil'],
                                $_POST['perto-oe-eixo'],
                                $_POST['perto-oe-dpn'],
                                $_POST['perto-oe-alt'],
                                
                                $_POST['add-perto-od'],
                                $_POST['add-perto-oe'],
                                
                                
                                );
                $prescricaoDAO = new PrescricaoDAO();
                if(!empty($prescricaoDAO->insert("", $params))){
                    
                    echo "<div class='alert alert-success' style='margin:10px;'>Prescrição cadastrada!</div>";
                }else{
                    throw new Exception("Não foi possivel cadastrar!");
                }   
                    
            }catch(Exception $e){
                echo "<div class='alert alert-danger' style='margin:10px;'><strong>ERROR:</strong> ".$e->getMessage()."</div>";
            }
        }
    }
    public static function buscaPrescricao(){
        //echo "buscarProduto<br>";
        if(isset($_POST['buscar-prescricoes'])){
            //echo "entrou no post buscaCliente <br>";
            $busca = $_POST['busca'];
            $atributo = $_POST['atributo'];
            $add = "WHERE ".$atributo." LIKE "."\"%".$busca."%\"";
            //echo $add ."<br>";
            $obs = "*busca por \"".$busca."\" em ".$atributo;
         }else{
             $obs ="*ultimos 10 registros";
             $add = "ORDER BY id DESC LIMIT 10";
         }
        echo $obs . "<br>";
        $prescricaoDAO = new PrescricaoDAO();
        $prescricoes = $prescricaoDAO->load("*",$add);
        return $prescricoes;
        
    }
    public static function excluirPrescricao($id){
        $prescricaoDAO = new PrescricaoDAO();
        if($prescricaoDAO->delete("id = $id")){
            echo "success";
        }else{
            echo "error";
        }
        
    }
    public static function editarPrescricao($id, $numReceita, $medico, $data, $longeOdEsf,
                                                                $longeOdCil,
                                                                $longeOdEixo,
                                                                $longeOdDpn,
                                                                $longeOdAlt,
                                                                
                                                                $longeOeEsf,
                                                                $longeOeCil,
                                                                $longeOeEixo,
                                                                $longeOeDpn,
                                                                $longeOeAlt,
                                                                
                                                                $pertoOdEsf,
                                                                $pertoOdCil,
                                                                $pertoOdEixo,
                                                                $pertoOdDpn,
                                                                $pertoOdAlt,
                                                                
                                                                $pertoOeEsf,
                                                                $pertoOeCil,
                                                                $pertoOeEixo,
                                                                $pertoOeDpn,
                                                                $pertoOeAlt,
                                                                
                                                                $addPertoOd,
                                                                $addPertoOe){
        $prescricaoDAO = new PrescricaoDAO();
        $fields = array("numReceita", "medico", "data", "longeOdEsf",
                                                        "longeOdCil",
                                                        "longeOdEixo",
                                                        "longeOdDpn",
                                                        "longeOdAlt",
                                                        
                                                        "longeOeEsf",
                                                        "longeOeCil",
                                                        "longeOeEixo",
                                                        "longeOeDpn",
                                                        "longeOeAlt",
                                                        
                                                        "pertoOdEsf",
                                                        "pertoOdCil",
                                                        "pertoOdEixo",
                                                        "pertoOdDpn",
                                                        "pertoOdAlt",
                                                        
                                                        "pertoOeEsf",
                                                        "pertoOeCil",
                                                        "pertoOeEixo",
                                                        "pertoOeDpn",
                                                        "pertoOeAlt",
                                                        
                                                        "addPertoOd",
                                                        "addPertoOe");
        $parans = array( $numReceita, $medico, $data, $longeOdEsf,
                                                                $longeOdCil,
                                                                $longeOdEixo,
                                                                $longeOdDpn,
                                                                $longeOdAlt,
                                                                
                                                                $longeOeEsf,
                                                                $longeOeCil,
                                                                $longeOeEixo,
                                                                $longeOeDpn,
                                                                $longeOeAlt,
                                                                
                                                                $pertoOdEsf,
                                                                $pertoOdCil,
                                                                $pertoOdEixo,
                                                                $pertoOdDpn,
                                                                $pertoOdAlt,
                                                                
                                                                $pertoOeEsf,
                                                                $pertoOeCil,
                                                                $pertoOeEixo,
                                                                $pertoOeDpn,
                                                                $pertoOeAlt,
                                                                
                                                                $addPertoOd,
                                                                $addPertoOe);
        $where = "id = $id";
        if($prescricaoDAO->update($fields,$parans,$where)){
            echo true;
        }else{
            echo false;
        }
        
    }
}

?>