$(document).ready(function(){

    cargarPersonal();
    cargarTablaHorario()

})

function cargarPersonal(){

    tblPersonal = $("#tblPersonalHorariosAsignados").DataTable({
        responsive : true,
        language : languageDataTable,
        ordering : false,
        lengthMenu: [[10,15, 20, 50, 100 -1], [10,15,20, 50, 100, "Todos"]],
        iDisplayLength : 15,
        ajax : {
            url : urlBase + "/schedule/assignment/load",
            method : 'POST',
            dataSrc : function ( res ) { 
                return res.data;
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
            { data: "Dni",className:"text-center font-13 py-1" },
            /**{ data : "codigo" , className :"text-center font-13 py-1" },**/
            {
                data : null ,
                render : function(data){
                    return data.Apellidos.trim().toUpperCase()+" "+data.Nombres.trim().toUpperCase();
                },
                className :"text-center font-13 py-1"
            }
        ],
        createdRow : function( row , data ) {
            
            $( row ).addClass( "tr-personal" );
            $( row ).attr( "codigo" , data.Id );  
            $( row ).css({"cursor" : "pointer"});
            $( row ).hover( 
                function(){ $(this).addClass("bg-light") } ,
                function(){ $(this).removeClass("bg-light") } 
            );
            
        }
    })

}

function cargarTablaHorario(){

    tablaHorarios = $("#tablaHorarios").DataTable({
        responsive : true,
        language : languageDataTable,
        ordering : false,
        lengthMenu: [[10,15, 20, 50, 100 -1], [10,15,20, 50, 100, "Todos"]],
        iDisplayLength : 15,
        ajax : {
            url : urlBase + "/schedule/manage/load",
            method : 'POST',
            dataSrc : function ( res ) {
                console.log(res)   
                return res.horarios;  
            }
        },
        columns:[
            { data : "Nombre" , className :"text-center font-13 py-1" },
            { 
                data : null ,
                render : function(data){              
                    return data.Inicio;
                }, 
              className :"text-center font-13 py-1" 
            },
            { 
                data : null ,
                render : function(data){
                    return data.Termino;
                } ,
                className :"text-center font-13 py-1" 
            }
        ],
        createdRow : function( row , data ) {
            
            $( row ).addClass( "tr-horarios" );
            $( row ).attr( "codigo" , data.ID );  
            $( row ).css({"cursor" : "pointer"});
            $( row ).hover( 
                function(){ $(this).addClass("bg-light") } ,
                function(){ $(this).removeClass("bg-light") } 
            );
            
        }
    })

}

$(document).on( "click" , ".tr-personal" , function(){
    if( $(this).hasClass("table-warning") ){  
        $(this).removeClass("table-warning")
        $("#"+$(this).attr("codigo")).remove()
    }else{
        $(this).addClass("table-warning")
        $("#codigos_personal").prepend(`<input name="id_empleados[]" id="${$(this).attr("codigo")}" type="hidden" value="${$(this).attr("codigo")}" >`)
    }
})

$(document).on( "click" , ".tr-horarios" , function(){
    if( $(this).hasClass("table-warning") ){  
        $(this).removeClass("table-warning")
        $("#"+$(this).attr("codigo")).remove()
    }else{ 
        $(this).addClass("table-warning")
        $("#id_horarios").prepend(`<input name="id_horarios[]" id="${$(this).attr("codigo")}" type="hidden" value="${$(this).attr("codigo")}" >`) 
    }
})

$("#formAsignarHorarios").submit(function(e){
    
    e.preventDefault()
    const data = $(this).serialize();

    $.post( urlBase+"/schedule/assignment/create" , data )
    .done(function(res){

        if(res.response === "success"){

            $("#id_horarios").html("");
            $("#codigos_personal").html("")
            $("#PeriodoDesde").val("");
            $("#PeriodoHasta").val("")
            
            $(".tr-personal").each(function(){
                $(this).removeClass("table-warning")
            })
            $(".tr-horarios").each(function(){
                $(this).removeClass("table-warning")
            })

            Notiflix.Notify.success('LOS HORARIOS HAN SIDO ASIGNADOS DE MANERA SATISFACTORIA');

        }else if(res.response === "warning"){

            Notiflix.Notify.warning('DEBE DE SELECCIONAR MÍNIMO UN PERSONAL Y UN HORARIO.');

        }

    }).fail(function(r){
        
        Notiflix.Notify.failure('Ocurrio un error inesperado, por favor actualice y vuelva a intentarlo.');
        
    });
   
})