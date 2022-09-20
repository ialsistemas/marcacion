
@extends('layouts.main')

@section('pageTitle','RL | Registrar asistencia')

@section('moduleTitle','Registrar Asistencia')

@section('moduleContent')

    <!--<pre>{{Auth::user() }}</pre>-->
    @if (session('login'))
        <!--<div class="alert alert-success">
            {{ session('login') }}
        </div>-->
    @endif

    <div class="row bg-white py-2 py-sm-3 py-md-5 shadow-sm">

        
        <div class="offset-lg-2 col-lg-8 offset-sm-1 col-sm-10">

            <div class="card card-outline card-success">
                <div class="card-header bg-light">
                    <b>Registrar nueva marcación</b>
                </div>
                <div class="card-body">

                    <div class="card mb-5">
                        <div class="card-header bg-light text-center font-12 p-2" >
                            Hora actual (en sucursal)
                        </div>
                        <div class="card-body text-center">
                            
                            <?php date_default_timezone_set('America/Lima') ?>

                            <h5><b>{{ date('d/m/Y') }}</b></h5>
                            
                            <p class="text-primary font-weight-bolder font-30 mb-0" id="reloj"></p>

                        </div>
                    </div>
                    
                    <p class="text-muted font-13 mb-4">Para registrar asistencia presione el botón correspondiente al tipo de marcación que desea generar. Este registro quedará asociado al reloj virtual "Portal del Trabajador" y por temas de seguridad se guardará la dirección del equipo donde realiza la marcación.</p>

                    <div class="row">
                        <div class="p-md-4 col-sm-6 mb-sm-0 mb-3">
                            <button disabled class="btn btn-success btn-block" url="{{route('attendance.register')}}" id="btnRegistrarEntrada" style="opacity:0.9">Registrar entrada</button>
                        </div>            
                        <div class="p-md-4 col-sm-6">
                            <button disabled class="btn btn-danger btn-block" url="{{route('attendance.register')}}" id="btnRegistrarSalida" style="opacity:0.9">Registrar salida</button>
                        </div>
                    </div>
                    
                </div>
            </div>

        </div>
       
    </div>


    <div class="modal fade" id="modalConfirmacion" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-sm modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header py-1 ">
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center">
                <span class="d-block font-weight-bold font-19 mb-3">¡Marcación exitosa!</span>
                <span class="d-block font-15">TUTOR VIRTUAL</span>
                <span id="modalFechaRegistro" class="d-block font-weight-bold font-17"></span>
                <span id="modalHoraRegistro" class="d-block font-weight-bold font-17"></span>
                <span id="modalEntradaSalida" class="d-block font-15"></span>
            </div>
            <div class="modal-footer d-flex justify-content-center">
              <button type="button" class="btn btn-sm btn-block btn-secondary" data-dismiss="modal">OK</button>
            </div>
          </div>
        </div>
      </div>
    
@endsection