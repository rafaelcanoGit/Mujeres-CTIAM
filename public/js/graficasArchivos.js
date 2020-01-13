function cambiar_fecha_grafica(){
    var anio_sel=$("#anio_sel").val();
    var mes_sel=$("#mes_sel").val();

    grafica_visitas_archivos(anio_sel,mes_sel);
    grafica_descargas_archivos(anio_sel,mes_sel);
    grafica_top_visitas(anio_sel,mes_sel);
    grafica_top_descargas(anio_sel,mes_sel);

}



function grafica_visitas_archivos(anio,mes){

    var options={
        chart: {
            renderTo: 'div_grafica_visitas_archivos',
            type: 'column'
        },
        title: {
            text: 'Numero De Visitas En El Mes'
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
                text: 'VISITAS AL DIA'
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
        series: [
            {name: 'libros',color: '#c50083',data: []},
            {name: 'revistas',color: '#811a5f',data: []},
            {name: 'informes tecnicos',color: '#c50083',data: []},
            {name: 'informes de investigacion',color: '#811a5f',data: []},
            {name: 'infografias',color: '#c50083',data: []}
        ]
    }

    var URLactual = window.location;
    var url = URLactual+"/grafica_visitas/"+anio+"/"+mes+"";
    
    $.get(url,function(resul){
        
    var datos= jQuery.parseJSON(resul);
    console.log(datos);
    if(mes==0){
        options.xAxis.title.text="MESES DEL AÑO";
        options.yAxis.title.text="VISITAS AL MES";
        options.title.text="Numero De Visitas Por Año";
    }
    var totaldias=datos.totaldias;
    var registrosLibros=datos.registrosLibros;
    var registrosRevistas=datos.registrosRevistas;
    var registrosInfoTec=datos.registrosInfoTec;
    var registrosInfoInv=datos.registrosInfoInv;
    var registrosInfoGra=datos.registrosInfoGra;
    var i=0;
    for(i=1;i<=totaldias;i++){
    options.series[0].data.push( registrosLibros[i] );
    options.series[1].data.push( registrosRevistas[i] );
    options.series[2].data.push( registrosInfoTec[i] );
    options.series[3].data.push( registrosInfoInv[i] );
    options.series[4].data.push( registrosInfoGra[i] );
    options.xAxis.categories.push(i);
    }

    chart = new Highcharts.Chart(options);

    })

}


function grafica_descargas_archivos(anio,mes){

    var options={
        chart: {
            renderTo: 'div_grafica_descargas_archivos',
            type: 'column'
        },
        title: {
            text: 'Numero De Descargas En El Mes'
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
                text: 'DESCARGAS AL DIA'
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
        series: [
            {name: 'libros',color: '#c50083',data: []},
            {name: 'revistas',color: '#811a5f',data: []},
            {name: 'informes tecnicos',color: '#c50083',data: []},
            {name: 'informes de investigacion',color: '#811a5f',data: []},
            {name: 'infografias',color: '#c50083',data: []}
        ]
    }

    var URLactual = window.location;
    var url = URLactual+"/grafica_descargas/"+anio+"/"+mes+"";
    
    $.get(url,function(resul){
        
    var datos= jQuery.parseJSON(resul);

    if(mes==0){
        options.xAxis.title.text="MESES DEL AÑO";
        options.yAxis.title.text="DESCARGAS AL MES";
        options.title.text="Numero De Descargas Por Año";
    }
    var totaldias=datos.totaldias;
    var registrosLibros=datos.registrosLibros;
    var registrosRevistas=datos.registrosRevistas;
    var registrosInfoTec=datos.registrosInfoTec;
    var registrosInfoInv=datos.registrosInfoInv;
    var registrosInfoGra=datos.registrosInfoGra;
    var i=0;
    for(i=1;i<=totaldias;i++){
    options.series[0].data.push( registrosLibros[i] );
    options.series[1].data.push( registrosRevistas[i] );
    options.series[2].data.push( registrosInfoTec[i] );
    options.series[3].data.push( registrosInfoInv[i] );
    options.series[4].data.push( registrosInfoGra[i] );
    options.xAxis.categories.push(i);
    }

    chart = new Highcharts.Chart(options);

    })
}

function  grafica_top_visitas(anio,mes){

    var options={
        chart: {
            renderTo: 'div_grafica_top_visitas',
            type: 'column'
        },
        title: {
            text: 'Top 5 Visitas En El Mes'
        },
        subtitle: {
            text: ''
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            categories: [],
            crosshair: true,
            title: {
                text: 'DOCUMENTOS'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'VISTAS AL MES'
            }
    
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y}'
                }
            }
        },
    
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
           
        },
    
        series: [
            {
                name: "Libro",
                colorByPoint: true,
                data: [
                    {name: "1",color: '#c50083',y: 0,drilldown: "1"},
                    {name: "2",color: '#c50083',y: 0,drilldown: "2"},
                    {name: "3",color: '#c50083',y: 0,drilldown: "3"},
                    {name: "4",color: '#c50083',y: 0,drilldown: "4"},
                    {name: "5",color: '#c50083',y: 0,drilldown: "5"}
                ]
            },{
                name: "Revista",
                colorByPoint: true,
                data: [
                    {name: "1",color: '#811a5f',y: 0,drilldown: "1"},
                    {name: "2",color: '#811a5f',y: 0,drilldown: "2"},
                    {name: "3",color: '#811a5f',y: 0,drilldown: "3"},
                    {name: "4",color: '#811a5f',y: 0,drilldown: "4"},
                    {name: "5",color: '#811a5f',y: 0,drilldown: "5"}
                ]
            },{
                name: "Informe Tecnico",
                colorByPoint: true,
                data: [
                    {name: "1",color: '#c50083',y: 0,drilldown: "1"},
                    {name: "2",color: '#c50083',y: 0,drilldown: "2"},
                    {name: "3",color: '#c50083',y: 0,drilldown: "3"},
                    {name: "4",color: '#c50083',y: 0,drilldown: "4"},
                    {name: "5",color: '#c50083',y: 0,drilldown: "5"}
                ]
            },{
                name: "Informe Investigacion",
                colorByPoint: true,
                data: [
                    {name: "1",color: '#811a5f',y: 0,drilldown: "1"},
                    {name: "2",color: '#811a5f',y: 0,drilldown: "2"},
                    {name: "3",color: '#811a5f',y: 0,drilldown: "3"},
                    {name: "4",color: '#811a5f',y: 0,drilldown: "4"},
                    {name: "5",color: '#811a5f',y: 0,drilldown: "5"}
                ]
            },{
                name: "Infografias",
                colorByPoint: true,
                data: [
                    {name: "1",color: '#c50083',y: 0,drilldown: "1"},
                    {name: "2",color: '#c50083',y: 0,drilldown: "2"},
                    {name: "3",color: '#c50083',y: 0,drilldown: "3"},
                    {name: "4",color: '#c50083',y: 0,drilldown: "4"},
                    {name: "5",color: '#c50083',y: 0,drilldown: "5"}
                ]
            }
        ],
        drilldown: {
            series: [
                {name: "1",id: "1",data: []},
                {name: "2",id: "2",data: []},
                {name: "3",id: "3",data: []},
                {name: "4",id: "4",data: []},
                {name: "5",id: "5",data: []}
            ]
        }
    };

    var URLactual = window.location;
    var url = URLactual+"/grafica_visitas_top/"+anio+"/"+mes+"";
    
    $.get(url,function(resul){
        
    var datos= jQuery.parseJSON(resul);

    if(mes==0){
        options.yAxis.title.text="VISTAS AL AÑO";
        options.title.text="Top 5 Visitas En El Año";
    }
    var i=0;
    
    var registrosLibros=datos.registrosLibros;
    var cantLibros=Object.keys(registrosLibros).length;
    var registrosRevistas=datos.registrosRevistas;
    var cantRevistas=Object.keys(registrosRevistas).length;
    var registrosInfoTec=datos.registrosInfoTec;
    var cantInfoTec=Object.keys(registrosInfoTec).length;
    var registrosInfoInv=datos.registrosInfoInv;
    var cantInfoInv=Object.keys(registrosInfoInv).length;
    var registrosInfoGra=datos.registrosInfoGra;
    var cantInfoGra=Object.keys(registrosInfoGra).length;

    for(i=0;i<cantLibros;i++){
        options.series[0].data[i].name = registrosLibros[i].nombre;
        options.series[0].data[i].drilldown=registrosLibros[i].nombre;
        options.series[0].data[i].y= registrosLibros[i].cant;
        options.drilldown.series[i].name=registrosLibros[i].nombre ;
        options.drilldown.series[i].id=registrosLibros[i].nombre ;
        options.drilldown.series[i].data.push( registrosLibros[i].cant );
    }

    for(i=0;i<cantRevistas;i++){
        options.series[1].data[i].name = registrosRevistas[i].nombre;
        options.series[1].data[i].drilldown=registrosRevistas[i].nombre;
        options.series[1].data[i].y= registrosRevistas[i].cant;
        options.drilldown.series[i].name=registrosRevistas[i].nombre ;
        options.drilldown.series[i].id=registrosRevistas[i].nombre ;
        options.drilldown.series[i].data.push( registrosRevistas[i].cant );
    }

    for(i=0;i<cantInfoTec;i++){
        options.series[2].data[i].name = registrosInfoTec[i].nombre;
        options.series[2].data[i].drilldown=registrosInfoTec[i].nombre;
        options.series[2].data[i].y= registrosInfoTec[i].cant;
        options.drilldown.series[i].name=registrosInfoTec[i].nombre ;
        options.drilldown.series[i].id=registrosInfoTec[i].nombre ;
        options.drilldown.series[i].data.push( registrosInfoTec[i].cant );
    }

    for(i=0;i<cantInfoInv;i++){
        options.series[3].data[i].name = registrosInfoInv[i].nombre;
        options.series[3].data[i].drilldown=registrosInfoInv[i].nombre;
        options.series[3].data[i].y= registrosInfoInv[i].cant;
        options.drilldown.series[i].name=registrosInfoInv[i].nombre ;
        options.drilldown.series[i].id=registrosInfoInv[i].nombre ;
        options.drilldown.series[i].data.push( registrosInfoInv[i].cant );
    }

    for(i=0;i<cantInfoGra;i++){
        options.series[4].data[i].name = registrosInfoGra[i].nombre;
        options.series[4].data[i].drilldown=registrosInfoGra[i].nombre;
        options.series[4].data[i].y= registrosInfoGra[i].cant;
        options.drilldown.series[i].name=registrosInfoGra[i].nombre ;
        options.drilldown.series[i].id=registrosInfoGra[i].nombre ;
        options.drilldown.series[i].data.push( registrosInfoGra[i].cant );
    }

    for(i=1;i<=5;i++) {
        options.xAxis.categories.push(i);
    }  
    

    chart = new Highcharts.chart(options); 
    })
}

function   grafica_top_descargas(anio,mes){
    var options={
        chart: {
            renderTo: 'div_grafica_top_descargas',
            type: 'column'
        },
        title: {
            text: 'Top 5 Descargas En El Mes'
        },
        subtitle: {
            text: ''
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            categories: [],
            crosshair: true,
            title: {
                text: 'DOCUMENTOS'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'DESCARGAS AL MES'
            }
    
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y}'
                }
            }
        },
    
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
           
        },
    
        series: [
            {
                name: "Libro",
                colorByPoint: true,
                data: [
                    {name: "1",color: '#c50083',y: 0,drilldown: "1"},
                    {name: "2",color: '#c50083',y: 0,drilldown: "2"},
                    {name: "3",color: '#c50083',y: 0,drilldown: "3"},
                    {name: "4",color: '#c50083',y: 0,drilldown: "4"},
                    {name: "5",color: '#c50083',y: 0,drilldown: "5"}
                ]
            },{
                name: "Revista",
                colorByPoint: true,
                data: [
                    {name: "1",color: '#811a5f',y: 0,drilldown: "1"},
                    {name: "2",color: '#811a5f',y: 0,drilldown: "2"},
                    {name: "3",color: '#811a5f',y: 0,drilldown: "3"},
                    {name: "4",color: '#811a5f',y: 0,drilldown: "4"},
                    {name: "5",color: '#811a5f',y: 0,drilldown: "5"}
                ]
            },{
                name: "Informe Tecnico",
                colorByPoint: true,
                data: [
                    {name: "1",color: '#c50083',y: 0,drilldown: "1"},
                    {name: "2",color: '#c50083',y: 0,drilldown: "2"},
                    {name: "3",color: '#c50083',y: 0,drilldown: "3"},
                    {name: "4",color: '#c50083',y: 0,drilldown: "4"},
                    {name: "5",color: '#c50083',y: 0,drilldown: "5"}
                ]
            },{
                name: "Informe Investigacion",
                colorByPoint: true,
                data: [
                    {name: "1",color: '#811a5f',y: 0,drilldown: "1"},
                    {name: "2",color: '#811a5f',y: 0,drilldown: "2"},
                    {name: "3",color: '#811a5f',y: 0,drilldown: "3"},
                    {name: "4",color: '#811a5f',y: 0,drilldown: "4"},
                    {name: "5",color: '#811a5f',y: 0,drilldown: "5"}
                ]
            },{
                name: "Infografias",
                colorByPoint: true,
                data: [
                    {name: "1",color: '#c50083',y: 0,drilldown: "1"},
                    {name: "2",color: '#c50083',y: 0,drilldown: "2"},
                    {name: "3",color: '#c50083',y: 0,drilldown: "3"},
                    {name: "4",color: '#c50083',y: 0,drilldown: "4"},
                    {name: "5",color: '#c50083',y: 0,drilldown: "5"}
                ]
            }
        ],
        drilldown: {
            series: [
                {name: "1",id: "1",data: []},
                {name: "2",id: "2",data: []},
                {name: "3",id: "3",data: []},
                {name: "4",id: "4",data: []},
                {name: "5",id: "5",data: []}
            ]
        }
    };

    var URLactual = window.location;
    var url = URLactual+"/grafica_descargas_top/"+anio+"/"+mes+"";
    
    $.get(url,function(resul){
        
    var datos= jQuery.parseJSON(resul);

    if(mes==0){
        options.yAxis.title.text="DESCARGAS AL AÑO";
        options.title.text="Top 5 Descargas En El Año";
    }
    var i=0;
    var registrosLibros=datos.registrosLibros;
    var cantLibros=Object.keys(registrosLibros).length;
    var registrosRevistas=datos.registrosRevistas;
    var cantRevistas=Object.keys(registrosRevistas).length;
    var registrosInfoTec=datos.registrosInfoTec;
    var cantInfoTec=Object.keys(registrosInfoTec).length;
    var registrosInfoInv=datos.registrosInfoInv;
    var cantInfoInv=Object.keys(registrosInfoInv).length;
    var registrosInfoGra=datos.registrosInfoGra;
    var cantInfoGra=Object.keys(registrosInfoGra).length;

    for(i=0;i<cantLibros;i++){
        options.series[0].data[i].name = registrosLibros[i].nombre;
        options.series[0].data[i].drilldown=registrosLibros[i].nombre;
        options.series[0].data[i].y= registrosLibros[i].cant;
        options.drilldown.series[i].name=registrosLibros[i].nombre ;
        options.drilldown.series[i].id=registrosLibros[i].nombre ;
        options.drilldown.series[i].data.push( registrosLibros[i].cant );
    }

    for(i=0;i<cantRevistas;i++){
        options.series[1].data[i].name = registrosRevistas[i].nombre;
        options.series[1].data[i].drilldown=registrosRevistas[i].nombre;
        options.series[1].data[i].y= registrosRevistas[i].cant;
        options.drilldown.series[i].name=registrosRevistas[i].nombre ;
        options.drilldown.series[i].id=registrosRevistas[i].nombre ;
        options.drilldown.series[i].data.push( registrosRevistas[i].cant );
    }

    for(i=0;i<cantInfoTec;i++){
        options.series[2].data[i].name = registrosInfoTec[i].nombre;
        options.series[2].data[i].drilldown=registrosInfoTec[i].nombre;
        options.series[2].data[i].y= registrosInfoTec[i].cant;
        options.drilldown.series[i].name=registrosInfoTec[i].nombre ;
        options.drilldown.series[i].id=registrosInfoTec[i].nombre ;
        options.drilldown.series[i].data.push( registrosInfoTec[i].cant );
    }

    for(i=0;i<cantInfoInv;i++){
        options.series[3].data[i].name = registrosInfoInv[i].nombre;
        options.series[3].data[i].drilldown=registrosInfoInv[i].nombre;
        options.series[3].data[i].y= registrosInfoInv[i].cant;
        options.drilldown.series[i].name=registrosInfoInv[i].nombre ;
        options.drilldown.series[i].id=registrosInfoInv[i].nombre ;
        options.drilldown.series[i].data.push( registrosInfoInv[i].cant );
    }

    for(i=0;i<cantInfoGra;i++){
        options.series[4].data[i].name = registrosInfoGra[i].nombre;
        options.series[4].data[i].drilldown=registrosInfoGra[i].nombre;
        options.series[4].data[i].y= registrosInfoGra[i].cant;
        options.drilldown.series[i].name=registrosInfoGra[i].nombre ;
        options.drilldown.series[i].id=registrosInfoGra[i].nombre ;
        options.drilldown.series[i].data.push( registrosInfoGra[i].cant );
    }

    for(i=1;i<=5;i++) {
        options.xAxis.categories.push(i);
    }  

    chart = new Highcharts.chart(options); 
    })
}