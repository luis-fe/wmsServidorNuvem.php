<?php
include_once("requests.php");
include_once("../../../templates/heads.php");
include("../../../templates/Loading.php");
?>
<link rel="stylesheet" href="style.css">

<div class="container-fluid" id="form-container">
    <div class="Corpo auto-height">
        <div class="row col-12">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" id="Infos">
                <label for="itensPorPagina">Mostrar</label>
                <select class="form-select" id="itensPorPagina">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                <label for="text">elementos</label>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6" id="Infos" style="justify-content: right;">
                <div id="search-container" class="col-12 col-sm-12 ">
                    <input type="text" id="searchFila" class="form-control" placeholder="Pesquisar...">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="TableFila">
                    <thead>
                        <tr>
                            <th scope="col">Código Pedido</th>
                            <th scope="col">Código Tipo de Nota</th>
                            <th scope="col">Qtd. Pedida</th>
                            <th scope="col">Previsão</th>
                            <th scope="col">Código Cliente</th>
                            <th scope="col">Nome Cliente</th>
                            <th scope="col">Peças em Aberto</th>
                            <th scope="col">Condição de Pagamento</th>
                            <th scope="col">Entregas Solicitadas</th>
                            <th scope="col">Entregas Realizadas</th>
                            <th scope="col">Situação Pedidos</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="container3" style="margin-top: 1rem; min-width: 100%">
                <div class="col-6 col-md-7 align-items-center text-align-center justify-content-center" id="Paginacao">
                </div>
            </div>
        </div>
    </div>
</div>



<?php include_once("../../../templates/footer.php"); ?>
<script src="script.js"></script>