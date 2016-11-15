<?php
include_once"../controllers/ProdutoController.php";

?>
<script type="text/javascript">
     jQuery(function($){
            $('#codigoBarra').mask("999-999-999-999-9"); 
            //$("#valor").maskMoney();
            //$("#valor").maskMoney({symbol:'R$ ', showSymbol:true, thousands:'.', decimal:',', symbolStay: true});})
            $('#telefone').mask("(99)9999-9999");
            $('#celular').mask("(99)99999-9999");
        });
        
</script>
<div class="panel panel-primary" style="margin-top:20px">
    <div class="panel-heading">
        Cadastrar um novo produto
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-8">
                <?php
                        ProdutoController::cadastrarProduto();
                ?>
                <form role="form" method="post">
                    <div class="form-group">
                        <label>Nome</label>
                        <input required name="nome" id="nome" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Codigo barra</label>
                                <input  name="codigoBarra" id="codigoBarra" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Marca</label>
                                <input required name="marca" id="marca" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>Modelo</label>
                                <input required name="modelo" id="modelo" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Grupo no Estoque</label>
                                <input  name="grupoEstoque" id="grupoEstoque" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Unidade</label>
                                <input  name="unidade" id="unidade" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Quantidade</label>
                                <input type="number" id="quantidade"  name="quantidade" min="0" class="form-control">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Valor Compra</label>
                                <input required name="valor" id="valor" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Valor Venda</label>
                                <input required name="valorVenda" id="valorVenda" class="form-control">
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="form-group">
                        <label>Descrição</label>
                        <textarea name="descricao" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" name="btnCadastrarProduto" class="btn btn-success">Cadastrar</button>
                    <button type="reset" class="btn btn-default">Cancelar</button>
                    
                </form>
            </div>
        </div>
    </div>
</div>



