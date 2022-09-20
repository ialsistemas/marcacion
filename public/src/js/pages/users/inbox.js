$(document).ready(function(){

    cargarMarcaciones();

})


$("#btnFiltrar").click(function(){

    tablaAdministrarMarcaciones.destroy();
    $("#tablaAdministrarMarcaciones tbody").empty();
    cargarMarcaciones();

})

function cargarMarcaciones(){

    tablaAdministrarMarcaciones = $("#tablaAdministrarMarcaciones").DataTable({
        dom: 'lftip',
        buttons: [
                    {   
                        "extend": 'excel', 
                        "text":'<i class="far fa-file-excel"></i>',
                        "className": 'ml-md-5 mt-md-0 mt-2 btn-excel-dt font-13',
                        'filename' : 'Reporte-AsistenciasMarcadas'
                    }
                ],
        responsive : true,
        language : languageDataTable,
        ordering : false,
        lengthMenu: [[10,20, 50, 100 -1], [10,20, 50, 100, "Todos"]],
        iDisplayLength : 10,
        ajax : {
            url : urlBase+"/users/inboxLoad" ,
            method : 'POST',
            data : {
                desde : $('#desdeBusqueda').val(),
                hasta : $('#hastaBusqueda').val()
            },
            dataSrc : function ( r ) {

                console.log(r)
                return {}
                
            }
        },
        columns:[
            {      
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                className:"text-center font-13"     
            },
            { 
                data :  null, 
                render:function(d){
                    
                    const date = new Date(d.Fecha);
                    const day =  date.getDate().toString().length === 1 ? "0"+date.getDate() : date.getDate();
                    const month = date.getMonth().toString().length === 1 ? "0"+(date.getMonth() + 1) : date.getMonth() + 1 ;
                    const year = date.getFullYear(); 

                    return `Registro de asistencia : ${day}/${month}/${year} ${d.Marcacion} - ${d.Tipo} - Reloj Loayza (Portal del trabajador)`;

                },
                className :"font-14 "
            },
            { 
                data :  null, 
                render:function(d){
                    if(d.Tipo === "Entrada"){
                        return `<span class="badge badge-pill badge-success">ENTRADA</span>`;
                    }else{
                        return `<span class="badge badge-pill badge-danger">SALIDA</span>`;
                    }
                },
                className :"font-14 text-center"
            },
            { 
                data :  null, render:function(d){

                    const date = new Date(d.Fecha);
                    const day =  date.getDate().toString().length === 1 ? "0"+date.getDate() : date.getDate();
                    const month = date.getMonth().toString().length === 1 ? "0"+(date.getMonth() + 1) : date.getMonth() + 1 ;
                    const year = date.getFullYear(); 

                    return `<span class="font-weight-bolder">${day}/${month}/${year}</span>`;
                
                },className :"text-center font-13"
            }
        ]

    })
}