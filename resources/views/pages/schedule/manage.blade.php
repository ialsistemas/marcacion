
@extends('layouts.main')

@section('pageTitle' , 'RL | Administrar Horarios')

@section('moduleTitle' , 'Administrar Horarios')

@section('quickAccessLink' , route('u.manage') )
@section('quickAccessText' , 'Admin. usuarios' )
@section('quickAccess' , 'Horarios')

@section('moduleContent')

  
  <div class="row">
    <div class="col-lg-7">
      <div class="card">
        <div class="card-header py-1 bg-light">
          <span class="font-15">Listado de Horarios</span>
        </div>
        <div class="card-body">   
          <div class="table-responsive">
            <table id="tablaAdministrarHorarios" style="width:100%" class="table table-bordered table-condensed table-sm">
              <thead>
                <tr class="bg-secondary">
                  <th class="text-center p-0 font-13 font-weight-normal" style="max-width:10px">#</th>
                  <th class="text-center p-0 font-13 font-weight-normal" style="min-width:30px">Nombre</th>
                  <th class="text-center p-0 font-13 font-weight-normal" style="max-width:60px">Inicio</th>
                  <th class="text-center p-0 font-13 font-weight-normal" style="max-width:60px">Término</th>
                  <!--<th class="text-center p-0 font-13 font-weight-normal" style="max-width:30px">-</th>-->
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>  
      </div>
    </div>
    <div class="col-lg-5">
      <div class="card">

        <div class="card-header py-1 bg-light">
          <span class="font-15" id="tituloMantHorarios">Acciones - horarios</span>
          <button type="button" id="btnAgregarHorario" class="float-right px-2 btn btn-success btn-xs text-white"><i class="mr-2 fas fa-plus text-white font-10"></i> <span class="font-12">Nuevo</span></button>
        </div>

        <div class="card-body">

            <div class="text-center" id="msjAccionesHorarios">
              <span class="font-13">Seleccione un horario de la lista para editarlo, o presione el boton "Nuevo" para crear un nuevo horario.</span>
            </div>
            
            <form id="formHorarios" action="{{route('sch.create.edit')}}" style="display:none">
              <input type="hidden" name="id" id="id_form">
            
              <div class="form-group mb-3">
                <label class="font-13 font-weight-bold">Nombre Horario (<span class="text-danger font-13 font-weight-bold">*</span>) </label>
                <input type="text" required name="nombre" id="nombre_form" class="form-control form-control-sm inputRL">                       
              </div>

              <div class="row">
                        
                <div class="col-6 ">
                  <div class="font-13 font-weight-bold border-bottom mb-2">Entrada:</div> 
                  <div class="form-group mb-1">
                    <label class="font-12">Hora Entrada (<span class="text-danger font-13 font-weight-bold">*</span>) </label>
                    <input type="time" required class="form-control form-control-sm inputRL" name="horaEntrada" id="inicio_form">                       
                  </div>                     
                  <div class="form-group mb-1">
                    <label class="font-12">Umbral Inicio (<span class="text-danger font-13 font-weight-bold">*</span>) </label>
                    <input type="time" required class="form-control form-control-sm inputRL" name="umbralInicio1" id="u_inicio1_form">                       
                  </div>
                  <div class="form-group mb-1">
                    <label class="font-12">Umbral Término (<span class="text-danger font-13 font-weight-bold">*</span>) </label>
                    <input type="time" required class="form-control form-control-sm inputRL" name="umbralSalida1" id="u_termino1_form">                       
                  </div>
                </div>
                <div class="col-6 pb-2">
                  <div class="font-13 font-weight-bold border-bottom mb-2">Salida:</div>                
                  <div class="form-group mb-1">
                    <label class="font-12">Hora Salida (<span class="text-danger font-13 font-weight-bold">*</span>) </label>
                    <input type="time" required class="form-control form-control-sm inputRL" name="horaSalida" id="termino_form">                       
                  </div>
                  <div class="form-group mb-1">
                    <label class="font-12">Umbral Inicio (<span class="text-danger font-13 font-weight-bold">*</span>) </label>
                    <input type="time" required class="form-control form-control-sm inputRL" name="umbralInicio2" id="u_inicio2_form">                       
                  </div>
                  <div class="form-group mb-1">
                    <label class="font-12">Umbral Término (<span class="text-danger font-13 font-weight-bold">*</span>) </label>
                    <input type="time" required class="form-control form-control-sm inputRL" name="umbralSalida2" id="u_termino2_form">                       
                  </div>
                </div>
              </div>

              <div class="float-right mt-3">
                <button type="submit" class="btn btn-success btn-xs px-3" id="btnMantHorario"> <span class="font-12">Guardar</span> </button>
                <button id="btnCancelar" class="btn btn-danger btn-xs px-3"> <span class="font-12">Cancelar</span></button>
              </div>  
              
            </form>
            
          
        </div>  
      </div>
    </div>
  </div>

  <style>
    .btn-excel-dt {
      display: inline-block !important;
      font-weight: 400 !important;
      color: white !important;
      text-align: center !important;
      vertical-align: middle !important;
      -webkit-user-select: none !important;
      -moz-user-select: none !important;
      -ms-user-select: none !important;
      user-select: none !important;
      background-color: transparent !important;
      border: 1px solid transparent !important;
      padding: 5px 18px !important;
      font-size: 1rem !important;
      border-radius: 0.25rem !important;
      transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out !important;
      background: rgba(42, 190, 106, 0.938) !important;
      font-size: 16px !important;
    }
    div.dataTables_wrapper div.dataTables_filter input {
      width: 150px !important;
      height: 26px !important;
    }
    div.dataTables_wrapper div.dataTables_filter label {
      font-size: 13px !important;
    }
    .dataTables_wrapper .dataTables_length label {
      font-size: 13px !important;
    }
    .dataTables_wrapper .dataTables_length select {
      height: 26px !important;
      font-size: 13px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
      padding: 2px 4px !important;
      font-size:14px !important;
    }
    .dataTables_wrapper .dataTables_info {
      font-size: 14px !important;
    }
  </style>

@endsection