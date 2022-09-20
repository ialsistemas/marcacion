$(document).ready(function(){

    tblhorariosPersonal = $("#tblhorariosPersonal").DataTable({
        data : {},
        language : languageDataTable
    })

})

$("#formHorariosPorUsuario").submit(function(e){


    e.preventDefault();
    const data = $(this).serialize();
    tblhorariosPersonal.destroy();
    $("#tblhorariosPersonal tbody").empty();
    cargarHorariosPorPersonal( $(this).prop("action") , data );
    

})

function cargarHorariosPorPersonal(route,data){

    $("#tblhorariosPersonal").DataTable({
        responsive : true,
        language : languageDataTable,
        ordering : false,
        lengthMenu: [[10,15, 20, 50, 100 -1], [10,15,20, 50, 100, "Todos"]],
        iDisplayLength : 20,
        ajax : {
            url : route,
            method : 'POST',
            data : data ,
            dataSrc : function ( response ) { 
                console.log(response)
                return response
            }
        },
        columns:[
            {      
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                className:"text-center font-13 py-1"     
            },
            {
                data : null ,
                render : function(data){
                    return "<span style=''>"+data.Dni+"</span>"
                },
                className :"text-center font-13 py-1"
            },
            {
                data : null ,
                render : function(data){
                    return data.Apellidos.trim().toUpperCase()+" "+data.Nombres.trim().toUpperCase()
                },
                className :"text-center font-13 py-1"
            },
            {
                data : null ,
                render : function(data){
                    return data.NombreHorario.trim().toUpperCase();          
                },
                className :"text-center font-13 py-1"
            },
            {
                data : null ,
                render : function(data){
                    return data.HoraEntrada.substring(11,16)+" / "+data.HoraSalida.substring(11,16)
                },
                className :"text-center font-13 py-1"
            },
            {
                data : null ,
                render : function(data){
                    return data.PeriodoDesde.substring(0,10)+" / "+data.PeriodoHasta.substring(0,10)
                },
                className :"text-center font-13 py-1"
            }
        ],
        createdRow : function( row , data ) {
            $( row ).css({"cursor" : "pointer"});
            $( row ).hover( 
                function(){ $(this).addClass("bg-light") } ,
                function(){ $(this).removeClass("bg-light") } 
            ); 
        }
    })

}