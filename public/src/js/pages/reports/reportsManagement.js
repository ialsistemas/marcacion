$(document).ready(function(){


})

$("#btnBusqueda").click(function(){

    tablaAdministrarMarcaciones.destroy();
    $("#tablaAdministrarMarcaciones tbody").empty();
    cargarTabla();

})

function cargarTabla(){

    const user = $("#usuarioBusqueda");
    tablaAdministrarMarcaciones = $("#tablaAdministrarMarcaciones").DataTable({
        responsive : true,
        language : languageDataTable,
        ordering : false,
        lengthMenu: [[10,20, 50, 100 -1], [10,20, 50, 100, "Todos"]],
        iDisplayLength : 10,
        ajax : {
            url : urlBase+"/reports/loadRecords" ,
            method : 'POST',
            data : {
                desde : $('#desdeBusqueda').val(),
                hasta : $('#hastaBusqueda').val(),
                codigo : user.attr("codigo") === "" ? "" : user.attr("codigo"),
                empleado : user.attr("codigo") === "" ? user.val() : ""
            },
            dataSrc : function ( r ) {
                console.log(r)
                return r.registros;  
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
                data: "dni",                
                className:"text-center font-13"     
            },
            { 
                data : "Cod_emp", 
                className :"font-14 text-center"
            },
            { 
                data : "Empleado", 
                className :"font-14 text-center"
            },
            { 
                data :  null, render:function(d){

                    return `<span class="font-weight-bolder ${ ( d.Tipo === "Entrada" ? "text-success" : "text-danger") }">${ d.FechaHora.substring(0,19) }</span>`;
                
                },className :"text-center font-14"
            },      
            { 
                data :  null, 
                render:function(d){
                    return "Reloj Loayza (Portal del trabajador)";
                },
                className :"font-14 text-center"
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

                    if(d.estado === "1"){
                        return `<span class="">ACTIVO</span>`;
                    }else{
                        return `INACTIVO`;
                    }
                
                },className :"text-center font-13"
            }
        ]

    })

}

$("#usuarioBusqueda").autocomplete({
    source: function(request, response){
        $.ajax({
            url: urlBase+"/users/searchUsers",
            dataType: "JSON",
            type: 'POST',
            data: {
                usuario : request.term,
                estado : 1
            },
            success: function(data){

                $("#usuarioBusqueda").removeClass("border border-success").attr("codigo","")
                let result = (!data.users) ? [{ vacio: true }] : data.users;
                response(result);

            }
        });
    },
    minLength: 1,
    select: function(event, ui){
        if (ui.item.vacio) {
            event.preventDefault();
        } else{
            $("#usuarioBusqueda").val(ui.item.codigo+" - "+ui.item.nombres).addClass("border border-success").attr("codigo",ui.item.codigo)
        }
        return false;
    }
}).autocomplete( "instance" )._renderItem = function( ul, item ) {

    if (item.hasOwnProperty('vacio')) {
        return $( "<li>" )
        .append( "<div>No se encontraron resultados</div>" )
        .appendTo( ul );
    }

    return $( "<li>" )
        .append( "<div>"+item.codigo+" - "+item.nombres+"</div>" )
        .appendTo( ul );
};

$("#downloadExcel").click(function(){

    const user = $("#usuarioBusqueda");
    const desde = $('#desdeBusqueda').val();
    const hasta = $('#hastaBusqueda').val();
    const codigo = user.attr("codigo") === "" ? "vacio" : user.attr("codigo");
    const empleado = user.val() === "" ? "vacio" : user.val();

    $.ajax({
        url: urlBase+`/reports/downloadExcel/${desde}/${hasta}/${codigo}/${empleado}`,
        type: 'GET',
        success: function(r) {
            
            if(r.response === "success"){

                const link = document.createElement('a');
                link.setAttribute('href', r.file );
                link.setAttribute('download', r.name );
                document.body.appendChild(link);
                link.click();
                Notiflix.Notify.success("REPORTE DE REGISTRO DE ASISTENCIAS DESCARGADO.");

            }else{

                Notiflix.Notify.failure("NO SE PUDO DESCARGAR EL DOCUMENTO EXCEL, POR FAVOR VUELVA A INTENTARLO");

            }
            

        }
    });

})

$("#usuarioBusqueda").keyup(function(){
    const valor = $(this).val()
    if(valor == ""){
        $(this).attr("codigo","")
    }
})