<?php
include_once("requests.php");
include_once("../../../templates/heads.php");
include("../../../templates/Loading.php");
?>
<link rel="stylesheet" href="style.css">
<style>
    #form-container {
    min-width: 100%;
    width: 100%;
    height: calc(100vh - 50px);
    padding: 20px;
    overflow-y: auto;
    background-color: gray;
}

.Corpo {
    width: 100%;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    border-radius: 10px;
    overflow: auto;
    background-color: var(--branco);
    padding: 20px;
    min-height: calc(100% - 50px);
    max-height: calc(100% - 50px);
}

#Infos {
    display: flex;
    height: 5vh;
    margin-top: 40px;
    justify-content: left;
    align-items: center;
    text-align: right;
}

#itensPorPagina {
    max-width: 100px;
    margin-left: 5px;
    margin-right: 5px;
    margin-top: -10px;
}

.table-container {
    margin-top: 20px;
    position: relative;
}

.table-responsive {
    min-height: 59vh;
    max-height: 59vh;
    overflow: auto;
}

.table {
    padding: auto;
    margin: auto;
    width: 100%;
    min-width: 100%;
    max-width: 100%;
    min-height: 100%;
    max-height: 100%;
    overflow: auto;
}

.table th,
.table td {
    white-space: nowrap;
}

.table tbody tr:hover {
    background-color: var(--corFundoTabela);
}

.table th {
    background-color: var(--corBase);
    color: var(--branco);
    text-align: center;
}

#Paginacao {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 10px;
    min-width: 100%;
    height: auto;
    overflow-x: auto;
    padding: 10px 0;
    flex-wrap: wrap; /* Adiciona wrap para melhor responsividade */
}

#Paginacao .paginate_button {
    margin: 3px;
    padding: 3px 6px;
    color: var(--corBase);
    border: 1px solid var(--corBase);
    border-radius: 4px;
    cursor: pointer;
    background-color: var(--branco);
}

#Paginacao .paginate_button:hover {
    background-color: var(--corBase);
    color: var(--branco);
}

#Paginacao .paginate_button.current {
    background-color: var(--corBase);
    color: var(--branco);
}

.acoes {
    display: flex;
    justify-content: space-around;
    align-items: center;
    height: 100%;
}

.acoes i {
    cursor: pointer;
    font-size: 20px;
    margin: 0 0;
}

.dataTables_wrapper .dataTables_filter {
    display: none;
}

.ButtonExcel i {
    color: green;
    font-size: 25px;
}

.ButtonVisibilidade {
    border: none !important;
}

@media (max-width: 768px) {
    td.descricao {
        white-space: normal;
        word-break: break-word;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .table {
        padding: auto;
        margin: auto;
        width: 100%;
        min-width: 100%;
        max-width: 100%;
        min-height: 100%;
        max-height: 100%;
        overflow: auto;
    }

    #form-container,
    .Corpo {
        padding: 10px;
    }

    #Paginacao {
        flex-direction: column; /* Direção da coluna para melhor ajuste em telas pequenas */
    }

    #Paginacao .paginate_button {
        margin: 5px 0;
    }
}
</style>

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
                            <th scope="col">Código Engenharia</th>
                            <th scope="col">Código Reduzido</th>
                            <th scope="col">Necessidade em Peças</th>
                            <th scope="col">Saldo em Fila</th>
                            <th scope="col">Op's</th>
                            <th scope="col">Qtd. Pedidos Faltando</th>
                            <th scope="col">Cód. Epc Referencial</th>
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