$(document).ready(function(){

    LoadUsers(0);

})

$("#formCrearUsuario").submit(function(e){
    e.preventDefault();
    const data = $(this).serialize();
    $.post( $(this).prop("action") , data )
    .done(function(res){
        if( res.response === "success" ){
            Notiflix.Notify.success('USUARIO REGISTRADO CON ÉXITO');
            tablaAdministrarUsuarios.ajax.reload(null,false);     
            $("#formCrearUsuario")[0].reset();   
            $("#modalCrearUsuario").modal("hide");
        }else if(res.response === "warning"){
            Notiflix.Notify.warning(res.message);
        }
    })
    .fail(function(r){
        console.log(r)
    });
})

$("#btnCrearUsuario").click(function(){

    $("#modalCrearUsuario").modal("show")

})

$("#tipoUsuario").change(function(){

    const tipo = $(this).val();
    tablaAdministrarUsuarios.destroy();
    $('#tablaAdministrarUsuarios tbody').empty();
    LoadUsers(tipo);

})

function LoadUsers(tipo){

    tablaAdministrarUsuarios = $("#tablaAdministrarUsuarios").DataTable({
        responsive : true,
        language : languageDataTable,
        ordering : false,
        lengthMenu: [[10,20, 50, 100 -1], [10,20, 50, 100, "Todos"]],
        iDisplayLength : 20,
        ajax : {
            url : urlBase+"/users/manage/load",
            method : 'POST',
            data : {
                tipousuario : tipo,
            },
            dataSrc : function ( res ) {

                return res.users  

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
            { data :  null, render:function(data,type,row){
                return data.Nombres.trim().toUpperCase();
            },className :"text-center font-13"},
            { data :  null, render:function(data,type,row){
                return data.Apellidos.trim().toUpperCase()
            },className :"text-center font-13"},
            { data : "Dni" , className :"text-center font-13" },
            { data :  null, render:function(data,type,row){

                return data.TipoUsuario.toUpperCase();
                
            },className :"text-center font-13"},
            { data :  null, render:function(data,type,row){
                if(data.Estado === "0"){
                    return "<span class='badge badge-danger font-11'>Inactivo</span>";
                }else{
                    return "<span class='badge badge-success font-11'>Activo</span>";  
                }
            },className :"text-center font-13"},
            { data :  null, render:function(data,type,row){
                let plantilla = `<button type="button" disabled class=" btn btn-xs btn-warning" password="${data.Password}" estado="${data.Estado}" nombre="${data.Apellidos.trim()+" "+data.Nombres.trim()}" onclick='editarUsuario(this)' ><i class="fa fa-edit text-white font-9"></i></button>`; 
                return plantilla;
            },className :"text-center font-13"}
        ]
    })

}

function editarUsuario(f){

    const codigo = $(f).attr("codigo");
    const estado = $(f).attr("estado");
    const nombres = $(f).attr("nombre");
    //const password = $(f).attr("password");

    $("#idEditar").val(codigo);
    $("#codigoEditar").val(codigo);
    $("#nombresEditar").val(nombres);
    $("#passwordEditar").val("**********");
    $("#estadoEditar").html(`<option value="1" ${( estado === "1" ? "selected" : "" )} >ACTIVO</option><option value="0" ${( estado === "0" ? "selected" : "" )}>INACTIVO</option>`);

    $("#modalEditarUsuario").modal("show");
    
}

$("#formEditarUsuario").submit(function(e){
    
    e.preventDefault()
    const data = $(this).serialize();
    const dataArray = $(this).serializeArray();

    $.post( $(this).prop("action") , data )
    .done(function(r){

        if( r.response === "success" ){
            
            Notiflix.Notify.success('USUARIO ACTUALIZADO CON ÉXITO');
            tablaAdministrarUsuarios.ajax.reload(null,false);        
            $("#modalEditarUsuario").modal("hide");

        }

    })
    .fail(function(r){
        console.log(r)
    });

})