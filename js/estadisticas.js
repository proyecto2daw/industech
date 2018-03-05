var empresas = [];
var categorias = [];
var prioridades = [];
var fechas=[];
$.getJSON(
        'index.php?controller=incidencia&action=getEstadisticas',
        function (data) {
            console.log(data);
            datos = data;
            //var array=$.map(datos.empresa, function(el) { return el });
            parseEmpresa(data);
            //   alert(empresas);
            console.log(empresas);


//console.log(datos['prioridad'][0].numero);
            Highcharts.chart('estadistica1', {
                chart: {
                    zoomType: 'x'
                },
                title: {
                    text: 'USD to EUR exchange rate over time'
                },
                subtitle: {
                    text: document.ontouchstart === undefined ?
                            'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
                },
                xAxis: {
                    type: 'number'
                },
                yAxis: {
                    title: {
                        text: 'Nº incidencias'
                    }
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    area: {
                        fillColor: {
                            linearGradient: {
                                x1: 0,
                                y1: 0,
                                x2: 0,
                                y2: 1
                            },
                            stops: [
                                [0, Highcharts.getOptions().colors[0]],
                                [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                            ]
                        },
                        marker: {
                            radius: 2
                        },
                        lineWidth: 1,
                        states: {
                            hover: {
                                lineWidth: 1
                            }
                        },
                        threshold: null
                    }
                },

                series: [{
                        type: 'area',
                        name: 'total de incidencias',
                        data: fechas
                    }]
            });


            Highcharts.chart('estadistica2', {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        beta: 0
                    }
                },
                title: {
                    text: 'Browser market shares at a specific website, 2014'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        depth: 35,
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}'
                        }
                    }
                },
                series: [{
                        type: 'pie',
                        name: 'Browser share',
                        data: prioridades
                    }]
            });
            Highcharts.chart('estadistica3', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'World\'s largest cities per 2014'
                },
                subtitle: {
                    text: 'Source: <a href="http://en.wikipedia.org/wiki/List_of_cities_proper_by_population">Wikipedia</a>'
                },
                xAxis: {
                    type: 'category',
                    labels: {
                        rotation: -45,
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Incidencias registradas'
                    }
                },
                legend: {
                    enabled: false
                },
                tooltip: {
                    pointFormat: 'incidencias <b>totales</b>'
                },
                series: [{
                        name: 'Population',
                        data: empresas,

                        /* [
                         ['Mercedes', 23.7],
                         ['renault', 16.1],
                         ['Ibermatica', 14.2],
                         ['Deusto', 14.0],
                         ['Michelin', 12.5],
                         ['Garaje Manolo', 12.1]
                         
                         ]*/
                        dataLabels: {
                            enabled: true,
                            rotation: -90,
                            color: '#FFFFFF',
                            align: 'right',
                            format: '{point.y:.1f}', // one decimal
                            y: 10, // 10 pixels down from the top
                            style: {
                                fontSize: '13px',
                                fontFamily: 'Verdana, sans-serif'
                            }
                        }
                    }]
            });
            Highcharts.chart('estadistica4', {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45
                    }
                },
                title: {
                    text: 'Contents of Highsoft\'s weekly fruit delivery'
                },
                subtitle: {
                    text: '3D donut in Highcharts'
                },
                plotOptions: {
                    pie: {
                        innerSize: 100,
                        depth: 45
                    }
                },
                series: [{
                        name: 'Delivered amount',
                        data: categorias
                    }]
            });

        }
);
function parseEmpresa(datos) {
    console.log('datos');
    console.log(datos.empresas);
    for (var i in datos.empresa) {
        empresas.push([datos.empresa[i].nombre, parseInt(datos.empresa[i].numero)]);

    }
    for (var x in datos.categoria) {
        categorias.push([datos.categoria[x].nombre, parseInt(datos.categoria[x].numero)]);

    }
    for (var k in datos.prioridad) {
        var prioridad;
        switch (datos.prioridad[k].prioridad) {
            case "0":
                prioridad = "baja";
                break;
            case "1":
                prioridad = "media";
                break;
            case "2":
                prioridad = "alta";
                break;
            case "3":
                prioridad = "urgente";
                break;
        }
       
        prioridades.push([prioridad, parseInt(datos.prioridad[k].numero)]);
    }
    console.log(prioridades);
    for(var n in datos.fecha){
        fechas.push([parseInt(datos.fecha[n].numeroMes),parseInt(datos.fecha[n].numero)]);
    }

}
