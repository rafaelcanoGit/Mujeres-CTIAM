function cambiar_fecha_grafica(){
    var anio_sel=$("#anio_sel").val();
    var mes_sel=$("#mes_sel").val();

    grafica_registros_usuarios(anio_sel,mes_sel);
    grafica_registros_usuarios_tipo(anio_sel,mes_sel);
    grafica_inicios_sesion_tipo(anio_sel,mes_sel);
}



function grafica_registros_usuarios(anio,mes){

    var options={
        chart: {
            renderTo: 'div_grafica_registros_usuarios',
            type: 'column'
        },
        title: {
            text: 'Numero De Registros En El Mes'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [],
            title: {
                text: 'DIAS DEL MES'
            },
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'REGISTROS AL DIA'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'registros',
            color: '#c50083',
            data: []

        }]
    }

    var URLactual = window.location;
    var url = URLactual+"/grafica_registros/"+anio+"/"+mes+"";
    
    $.get(url,function(resul){
    var datos= jQuery.parseJSON(resul);

    if(mes==0){
        options.xAxis.title.text="MESES DEL AÑO";
        options.yAxis.title.text="REGISTROS AL MES";
        options.title.text="Numero De Registros Por Año";
    }
    var totaldias=datos.totaldias;
    var registrosdia=datos.registrosdia;
    var i=0;
    for(i=1;i<=totaldias;i++){
    options.series[0].data.push( registrosdia[i] );
    options.xAxis.categories.push(i);
    }

    chart = new Highcharts.Chart(options);

    })


}

function grafica_registros_usuarios_tipo(anio,mes){
    var options={
                chart: {
                    renderTo: 'div_grafica_registros_usuarios_tipo',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Registros Por Tipos En El Mes'
                },
                //tooltip: {pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'},
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Registros',
                    colorByPoint: true,
                    data: []
                }]
        
    }

    var URLactual = window.location;
    var url = URLactual+"/grafica_registrosTipo/"+anio+"/"+mes+"";


    $.get(url,function(resul){
        var datos= jQuery.parseJSON(resul);
        var tipos=datos.tipos;
        var totattipos=datos.cantTipos;
        var numeropublicaciones=datos.registrospormes;
        for(i=0;i<=totattipos-1;i++){  
            var objeto= {name: tipos[i].nombre, y:numeropublicaciones[tipos[i].nombre] };     
            options.series[0].data.push( objeto );  
        }
        if(mes==0){
            options.title.text="Registros Por Tipos En El Año";
        }
    chart = new Highcharts.Chart(options);
    })
}

function grafica_inicios_sesion_tipo(anio,mes){
    var options={
                chart: {
                    renderTo: 'div_grafica_inicios_sesion_tipo',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Inicios de Sesion Por Tipos En El Mes'
                },
                //tooltip: {pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'},
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Inicios de Sesion',
                    colorByPoint: true,
                    data: []
                }]
        
    }

    var URLactual = window.location;
    var url = URLactual+"/grafica_inicioSesionTipo/"+anio+"/"+mes+"";


    $.get(url,function(resul){
        var datos= jQuery.parseJSON(resul);
        var tipos=datos.tipos;
        var totattipos=datos.cantTipos;
        var numeropublicaciones=datos.registrospormes;
        for(i=0;i<=totattipos-1;i++){  
            var objeto= {name: tipos[i].nombre, y:numeropublicaciones[tipos[i].nombre] };     
            options.series[0].data.push( objeto );  
        }
        if(mes==0){
            options.title.text="Inicios de Sesion Por Tipos En El Año";
        }
    chart = new Highcharts.Chart(options);
    })
}