<!DOCTYPE html>
<html lang="pt-Br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtividade Wms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.2.1/css/fixedHeader.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.dataTables.min.css">

    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        #infos label {
            font-size: 28px;
            font-weight: 600;
        }

        .table-responsive {
            min-height: 55vh;
            max-height: 55vh;
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

        .table tbody tr:hover {
            text-align: center;
            background-color: gray;
        }

        .table th {
            background-color: #0e2238;
            color: white;
            text-align: center;
        }

        .table tbody td {
            font-size: 30px;
            text-align: center;
        }

        .table thead th {
            font-size: 22px;
        }
    </style>
</head>

<body>
    <div class="main h-100" style="width: 100%; min-height: 100vh; max-height: 100vh">
        <div class="row" style="justify-content: center;">
            <h2 style="width: 100%; background-color: #0e2238; color: white; font-size: 50px; text-align: center; padding: 5px">Produtividade</h2>
            <div class="row col-12">
                <div class="row col-9 col-md-10">
                    <div class="col-12 col-md-6">
                        <label for="dataInicio" class="form-label">Data Início</label>
                        <input type="date" id="dataInicio" class="form-control">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="dataFim" class="form-label">Data Final</label>
                        <input type="date" id="dataFim" class="form-control">
                    </div>
                </div>
                <div class="col-3 col-md-2 d-flex justify-content-center align-items-md-end align-items-center">
                    <button type="button" id="ButtonFiltrar" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
            <div class="row col-12 justify-content-center" id="infos" style="margin-top: 20px">
                <div class="card col-11 col-md-3 col-sm-5 text-center" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                    <label id="LabelRetornaPcs" for="text"></label>
                </div>
                <div class="card col-11 col-md-3 col-sm-5 text-center" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                    <label id="LabelRetornaPcsMplus" for="text"></label>
                </div>
                <div class="card col-11 col-md-3 col-sm-5 text-center" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                    <label id="LabelProntaEntregaPcs" for="text"></label>
                </div>
                <div class="card col-11 col-md-3 col-sm-5 text-center" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                    <label id="LabelFaturadoPcs" for="text"></label>
                </div>
            </div>
            <div class="row col-12 justify-content-center" id="infos" style="margin-top: 10px">
                <div class="card col-11 col-md-3 col-sm-5 text-center" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                    <label id="LabelRetornaRS" for="text"></label>
                </div>
                <div class="card col-11 col-md-3 col-sm-5 text-center" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                    <label id="LabelRetornaMplusRS" for="text"></label>
                </div>
                <div class="card col-11 col-md-3 col-sm-5 text-center" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                    <label id="LabelProntaEntregaRS" for="text"></label>
                </div>
                <div class="card col-11 col-md-3 col-sm-5 text-center" style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                    <label id="LabelFaturadoRS" for="text"></label>
                </div>
            </div>
            <div class="row col-12" style="margin-top: 10px">
                <div class="col-12 col-md-6" style="border: 2px solid #0e2238">
                    <h2 style="width: 100%; text-align: center">Reposição</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="TabelaReposicao">
                            <thead>
                                <tr>
                                    <th scope="col">Rank</th>
                                    <th scope="col">Colaborador</th>
                                    <th scope="col">Qtd</th>
                                    <th scope="col">Ritmo</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="col-12 col-md-6" style="border: 2px solid #0e2238">
                    <h2 style="width: 100%; text-align: center">Separação</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="TabelaSeparacao">
                            <thead>
                                <tr>
                                    <th scope="col">Rank</th>
                                    <th scope="col">Colaborador</th>
                                    <th scope="col">Qtd</th>
                                    <th scope="col">Ritmo</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row col-12" style="margin-top: 10px">
                <div class="col-12 col-md-6 d-flex flex-wrap align-items-center p-2" style="background-color: #0e2238; color: white; border-right: 1px solid white">
                    <div class="col-2 text-center mb-2 mb-md-0">
                        <i class="fa-solid fa-trophy" style="color: yellow; font-size: 85px"></i>
                    </div>
                    <div class="col-12 col-md-5 text-left text-md-start mb-2 mb-md-0">
                        <label for="" class="mb-0" id="RecordReposicao" style="font-size: 25px;"></label>
                    </div>
                    <div class="col-12 col-md-5 text-center text-md-start mb-2 mb-md-0">
                        <label for="" class="mb-0" id="totalDiaReposicao" style="font-size: 25px;"></label>
                    </div>
                </div>
                <div class="col-12 col-md-6 d-flex flex-wrap align-items-center p-2" style="background-color: #0e2238; color: white; border-left: 1px solid white">
                    <div class="col-2 text-center mb-2 mb-md-0">
                        <i class="fa-solid fa-trophy" style="color: yellow; font-size: 85px"></i>
                    </div>
                    <div class="col-12 col-md-5 text-left text-md-start mb-2 mb-md-0">
                        <label for="" id="RecordSeparacao" class="mb-0" style="font-size: 25px;"></label>
                    </div>
                    <div class="col-12 col-md-5 text-center text-md-start mb-2 mb-md-0">
                        <label for=""  id="totalDiaSeparacao" class="mb-0" style="font-size: 25px;"></label>
                    </div>
                </div>
            </div>
            
        </div>
    </div>


</body>


<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/fixedheader/3.2.1/js/dataTables.fixedHeader.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.colVis.min.js"></script>

<script>
    $(document).ready(async () => {
        await ConsultaFaturamento();
        await ConsultaProdutividade('TagsReposicao', 'TabelaReposicao');
        ConsultaProdutividade('TagsSeparacao', 'TabelaSeparacao');
    })

    $('#ButtonFiltrar').click(async () => {
        await  ConsultaFaturamento();
        await ConsultaProdutividade('TagsReposicao', 'TabelaReposicao');
        ConsultaProdutividade('TagsSeparacao', 'TabelaSeparacao');
    })

    const hoje = new Date().toISOString().split('T')[0];
    document.getElementById('dataInicio').value = hoje;
    document.getElementById('dataFim').value = hoje;



    const ConsultaFaturamento = () => {
        console.log($('#dataInicio').val())
        $.ajax({
            type: 'GET',
            url: 'requests.php',
            dataType: 'json',
            data: {
                acao: 'Consultar_Faturamentos',
                dataInicio: $('#dataInicio').val(),
                dataFim: $('#dataFim').val(),
            },
            success: (data) => {
                console.log(data);
                $('#LabelRetornaPcs').text(`Retorna Pçs: ${data[0]['Pcs Retorna']}`);
                $('#LabelRetornaPcsMplus').text(`Retorna Mplus Pçs: ${data[0]['Pcs Retorna Mplus']}`);
                $('#LabelProntaEntregaPcs').text(`Pronta Entrega Pçs: ${data[0]['Pç Pronta Entrega']}`);
                $('#LabelFaturadoPcs').text(`Faturado Pçs: ${data[0]['qtdePecas Faturado']}`);
                $('#LabelRetornaRS').text(`Retorna R$: ${data[0]['No Retorna']}`);
                $('#LabelRetornaMplusRS').text(`Retorna Mplus R$: ${data[0]['No Retorna MPlus']}`);
                $('#LabelProntaEntregaRS').text(`Pronta Ent. R$: ${data[0]['Retorna ProntaEntrega']}`);
                $('#LabelFaturadoRS').text(`Faturado R$: ${data[0]['Total Faturado']}`);

            },
        });
    }

    const ConsultaProdutividade = (Consulta, tabela) => {
        $.ajax({
            type: 'GET',
            url: 'requests.php',
            dataType: 'json',
            data: {
                acao: 'Consultar_Produtividade',
                dataInicio: $('#dataInicio').val(),
                dataFim: $('#dataFim').val(),
                Consulta: Consulta,
                HoraInicio: '00:01',
                HoraFim: '23:59'
            },
            success: (data) => {
                console.log(data);
                criarTabelaProdutividade(data[0]['3- Ranking Repositores'], tabela);
                if(Consulta == 'TagsReposicao'){
                $('#RecordReposicao').text(`${data[0]['1- Record Repositor']}: ${data[0]['1.1- Record qtd']}`);
                $('#totalDiaReposicao').text(`Total Reposto: ${data[0]['2 Total Periodo']}`);
                }
                else if(Consulta == 'TagsSeparacao'){
                $('#RecordSeparacao').text(`${data[0]['1- Record Repositor']}: ${data[0]['1.1- Record qtd']}`);
                $('#totalDiaSeparacao').text(`Total Separado: ${data[0]['2 Total Periodo']}`);
                }
                
            },
        });
    }

    function criarTabelaProdutividade(listaNomes, tabela) {
        // Adiciona a coluna de rank aos dados
        listaNomes.forEach((item, index) => {
            item.rank = index + 1;

        });

        if ($.fn.DataTable.isDataTable(`#${tabela}`)) {
            $(`#${tabela}`).DataTable().destroy();
        }

        const tabelaDataTable = $(`#${tabela}`).DataTable({
            excel: true,
            responsive: true,
            paging: false,
            info: false,
            searching: false,
            colReorder: false,
            data: listaNomes,
            lengthChange: false,
            columns: [{
                    data: 'rank'
                },
                {
                    data: 'nome'
                },
                {
                    data: 'qtde'
                },
                {
                    data: 'ritmo'
                }
            ],
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excelHtml5',
                text: '<i class="fa-solid fa-file-excel"></i>',
                title: 'Produtividade',
                className: 'ButtonExcel'
            }]
        });
    }
</script>

</html>