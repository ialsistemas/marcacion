$(document).ready(function(){
    
    clock();
    
})

$("#btnRegistrarEntrada").click(function(){

    const url = $(this).attr("url");
    registroAsistencia(url,1,"(ENTRADA)","ingreso");

})

$("#btnRegistrarSalida").click(function(){

    const url = $(this).attr("url");
    registroAsistencia(url,2,"(SALIDA)","salida");

})

function registroAsistencia(url,tipo,mjstipo,question){

    Notiflix.Confirm.show(
        'CONFIRMACIÓN',
        '¿Está seguro de registrar su '+question+'?',
        'Si',
        'No',
        function okCb() {
            $.post( url , { id : 0 , tipo : tipo } )
            .done(function(r){
                console.log(r)
                if( r.response === "success" ){
                    
                    $("#modalEntradaSalida").html(mjstipo)
                    $("#modalHoraRegistro").html(r.latest.FechaHora.substring(11 , 19) )
                    $("#modalFechaRegistro").html(r.latest.FechaHora.substring(10 , 0) )
                    $("#modalConfirmacion").modal("show");
                    Notiflix.Notify.success(r.data);
                
                }else{

                    Notiflix.Notify.failure("Ocurrio un error inesperado, por favor vuelva a intentarlo");

                }

            })
            .fail(function(r){
                
                Notiflix.Notify.failure("Ocurrio un error inesperado, por favor vuelva a intentarlo");

            });
        },
        function cancelCb() {
        }
    );

}

function clock(){

    setInterval(function() {
        
        const currentDate = new Date();

        let hour = currentDate.getHours()
        let minutes = currentDate.getMinutes()
        let seconds = currentDate.getSeconds()

        hour = hour.toString().length === 1 ? "0"+hour : hour;
        minutes = minutes.toString().length === 1 ? "0"+minutes : minutes;
        seconds = seconds.toString().length === 1 ? "0"+seconds : seconds;

        $("#reloj").html(`${hour} :  ${minutes}  :  ${seconds}`);
        $("#btnRegistrarEntrada").prop("disabled",false)
        $("#btnRegistrarSalida").prop("disabled",false)

    }, 1000);

}