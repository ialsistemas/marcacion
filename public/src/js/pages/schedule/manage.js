$(document).ready(function(){

    cargarTabla();

})

function cargarTabla(){

    tablaAdministrarHorarios = $("#tablaAdministrarHorarios").DataTable({
        responsive : true,
        language : languageDataTable,
        ordering : false,
        lengthMenu: [[10,15, 20, 50, 100 -1], [10,15,20, 50, 100, "Todos"]],
        iDisplayLength : 15,
        ajax : {
            url : urlBase + "/schedule/manage/load",
            method : 'POST',
            dataSrc : function ( res ) {        
                return res.horarios;  
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
                data: "Nombre",className:"text-center font-13 py-1"     
            },
            { 
                data : "Inicio" , className :"text-center font-13 py-1"
            },
            { 
                data : "Termino" , className :"text-center font-13 py-1"
            }
        ],
        createdRow : function( row , d ) {
            
            $( row ).addClass("tr-editar");

            $( row ).attr("id",d.ID).attr("nombre",d.Nombre).attr("inicio",d.Inicio).attr("termino",d.Termino);
            $( row ).attr("umbralInicio1",d.UmbralInicio1).attr("umbralInicio2",d.UmbralInicio2);
            $( row ).attr("umbralTermino1",d.UmbralTermino1).attr("umbralTermino2",d.UmbralTermino2);

            $( row ).css({"cursor" : "pointer"});
            $( row ).hover( 
                function(){ $(this).addClass("bg-light") } ,
                function(){ $(this).removeClass("bg-light") } 
            );
            
        }
    })

}

$(document).on( "click" , ".tr-editar" , function(){

    $("#tablaAdministrarHorarios tbody").find("tr").removeClass("table-warning");
    $(this).addClass("table-warning");

    $("#msjAccionesHorarios").hide();
    $("#formHorarios").show("fast");
    $("#formHorarios")[0].reset();
    $("#tituloMantHorarios").html("Editar horario");
    $("#btnMantHorario").html("<span class='font-13'>Actualizar</span>");

    $("#id_form").val($(this).attr("id"));
    $("#nombre_form").val($(this).attr("nombre"));
    $("#inicio_form").val($(this).attr("inicio"));
    $("#u_inicio1_form").val($(this).attr("umbralInicio1"));
    $("#u_termino1_form").val($(this).attr("umbralTermino1"));
    $("#termino_form").val($(this).attr("termino"));
    $("#u_inicio2_form").val($(this).attr("umbralInicio2"));
    $("#u_termino2_form").val($(this).attr("umbralTermino2"));

})

$("#btnAgregarHorario").click(function(){
    
    $("#tablaAdministrarHorarios tbody").find("tr").removeClass("table-warning");

    $("#msjAccionesHorarios").hide();
    $("#formHorarios").show("fast");
    $("#formHorarios")[0].reset();
    $("#inicio_form");
    $("#termino_form");
    $("#tituloMantHorarios").html("Crear horario");
    $("#btnMantHorario").html("<span class='font-13'>Guardar</span>")
    $("#id_form").val("0");

})

$("#formHorarios").submit(function(e){
    
    e.preventDefault()
    const data = $(this).serialize();

    $.post( $(this).prop("action") , data )
    .done(function(res){

        if( res.response === "success" ){
            
            $("#formHorarios")[0].reset();
            const msj = res.msj === "0" ? "REGISTRADO" : "ACTUALIZADO";
            Notiflix.Notify.success('HORARIO '+msj+' CON ÉXITO.');
            $("#id_form").val("0");
            $("#tituloMantHorarios").html("Acciones - horarios");
            $("#btnMantHorario").html("<span class='font-13'>Guardar</span>")

            tablaAdministrarHorarios.ajax.reload(null,false);

        }else if( res.response === "warning"){

            Notiflix.Notify.warning('TODOS LOS CAMPOS SON REQUERIDOS.');
            tablaAdministrarHorarios.ajax.reload(null,false);        

        }

    })
    .fail(function(r){
        
        Notiflix.Notify.failure('Ocurrio un error inesperado, por favor actualice y vuelva a intentarlo.');
        
    });

})