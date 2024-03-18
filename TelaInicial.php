<?php
include_once("./utils/session.php");
include_once("./templates/headers.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="<?= $BASE_URL ?>css/TelaInicial.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.29.0/dist/apexcharts.min.js"></script>
</head>
<style>
    .Corpo{
        display: flex;
        width: 100%;
        height: 80.5vh;
    }

    .left{
        width: 45%;
        height: 100%;
    }

    .right{
        display: flex;
        flex-direction: column;
        width: 55%;
        height: 100%;
    }

    .top{
        overflow: auto;
            border-radius: 10px;
            width: 100%;
            height: 50%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

    }

    .bottom{
        overflow: auto;
            border-radius: 10px;
            width: 100%;
            height: 50%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

</style>
<body>
    <div class="container">
        <div class="title">
            <h3>INDICADORES</h3>
        </div>
        <div class="Datas">
            <input type="date" id="dataInicial">
            <input type="date" id="dataFinal">
            <button onclick="initializeCharts()">Atualizar</button>
        </div>
        <div class="Corpo">
            <div class="left">
            <div id="PercentualQualidade">
                <h2>Percentual 2ª Qualidade</h2>
                <div id="chartQualidade">
                    <div id="chartQualidadeLabel"></div>
                </div>
            </div>
            </div>
            <div class="right">
                <div class="top">
                <h2>Ranking Defeitos</h2>
                <div id="chart"></div>
                </div>
                <div class="bottom"></div>
            </div>
        </div>
    </div>
</body>
<script>
        const ApiMotivos = 'http://192.168.0.183:5000/api/MotivosAgrupado';
        const ApiQualidade = 'http://192.168.0.183:5000/api/AcompanhamentoQualidade';

        async function fetchData(apiUrl, dataInicial, dataFinal) {
            try {
                const response = await fetch(`${apiUrl}?DataIncial=${dataInicial}&DataFinal=${dataFinal}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': "a40016aabcx9"
                    },
                });

                if (!response.ok) {
                    throw new Error('Erro no retorno da API');
                }

                return response.json();
            } catch (error) {
                console.error(error);
                return null;
            }
        }

        async function renderBarChart(data) {
            const chartOptions = {
                chart: {
                    type: 'bar',
                    height: '195%',
                    width: '100%',
                },
                series: [{
                    name: 'Quantidade',
                    data: data.map(item => item.qtde)
                }],
                xaxis: {
                    categories: data.map(item => item.motivo2Qualidade),
                    labels: {
                        rotate: -90,
                        align: 'center',
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        barHeight: 80,
                        horizontal: true,
                    }
                }
            };

            const chart = new ApexCharts(document.querySelector("#chart"), chartOptions);
            chart.render();
        }

        async function renderDonutChart(data) {
    if (data.length > 0) {
        const totalPecas = parseFloat(data[0]["2- Total Peças Baixadas periodo"]);
        const pecas2Qualidade = parseFloat(data[0]["1- Peças com Motivo de 2Qual."]);

        if (!isNaN(totalPecas) && !isNaN(pecas2Qualidade)) {
            const porcentagem2Qualidade = (pecas2Qualidade / totalPecas) * 100;
            const porcentagemDiferenca = 100 - porcentagem2Qualidade;

            const chartOptions = {
                chart: {
                    type: 'donut',
                    width: '100%',
                },
                series: [porcentagem2Qualidade, porcentagemDiferenca],
                labels: ['Peças 2ª Qualidade', 'Peças 1ª Qualidade'],
                colors: ['#FF4560', '#008FFB'],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }],
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                name: {
                                    show: true
                                },
                                value: {
                                    show: true,
                                    formatter: function (val) {
                                        return val.toFixed(2) + "%"; // Mostra o valor com duas casas decimais
                                    }
                                },
                                total: {
                                    show: true,
                                    label: 'Total 2ª Qualidade',
                                    formatter: function () {
                                        return porcentagem2Qualidade.toFixed(2) + '%'; // Exibe o percentual de segunda qualidade no centro do donut
                                    }
                                }
                            }
                        }
                    }
                },
                dataLabels: {
                    enabled: false
                },
                legend: {
                    show: true,
                    position: 'bottom'
                }
            };

            const chart = new ApexCharts(document.querySelector("#chartQualidade"), chartOptions);
            chart.render();

            const legendContainer = document.getElementById("legendQualidade");
            chartOptions.labels.forEach((label, index) => {
                const legendItem = document.createElement("div");
                legendItem.classList.add("legend-item");

                const legendColor = document.createElement("div");
                legendColor.classList.add("legend-color");
                legendColor.style.backgroundColor = chartOptions.colors[index];

                const legendLabel = document.createElement("div");
                legendLabel.innerText = label;

                legendItem.appendChild(legendColor);
                legendItem.appendChild(legendLabel);

                legendContainer.appendChild(legendItem);
            });
        } else {
            throw new Error('Valores inválidos para criar o gráfico');
        }
    } else {
        throw new Error('Nenhum dado disponível para criar o gráfico');
    }
}

async function initializeCharts() {
    // Limpa o conteúdo dos elementos onde os gráficos serão renderizados
    document.getElementById("chart").innerHTML = '';
    document.getElementById("chartQualidade").innerHTML = '';

    const dataInicial = document.getElementById("dataInicial").value.split("-").reverse().join("/");
    const dataFinal = document.getElementById("dataFinal").value.split("-").reverse().join("/");

    const dataMotivos = await fetchData(ApiMotivos, dataInicial, dataFinal);
    if (dataMotivos) {
        renderBarChart(dataMotivos);
    }

    const dataQualidade = await fetchData(ApiQualidade, dataInicial, dataFinal);
    if (dataQualidade) {
        renderDonutChart(dataQualidade);
    }
}

document.addEventListener("DOMContentLoaded", function() {
    const today = new Date();
    const formattedDate = today.toISOString().split('T')[0]; // Obtém a data de hoje no formato 'aaaa-mm-dd'

    document.getElementById("dataInicial").value = formattedDate; // Define a data de hoje para a entrada de data inicial
    document.getElementById("dataFinal").value = formattedDate; // Define a data de hoje para a entrada de data final
    initializeCharts(); // Inicia os gráficos com os dados da data de hoje
});

</script>
</html>
