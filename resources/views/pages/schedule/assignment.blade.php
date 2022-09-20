
@extends('layouts.main')

@section('pageTitle' , 'RL | Asignar Horarios')

@section('moduleTitle' , 'Asignar Horarios')

@section('quickAccessLink' , route('u.manage') )
@section('quickAccessText' , 'Admin. usuarios' )
@section('quickAccess' , 'Horarios')

@section('moduleContent')
  
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header py-1 bg-light">
          <span class="font-14">Personal activo</span>
        </div>
        <div class="card-body">   
          <div class="table-responsive">
            <table id="tblPersonalHorariosAsignados" style="width:100%" class="table table-bordered table-condensed table-sm">
              <thead>
                <tr class="bg-secondary">
                  <th class="text-center p-0" style="">#</th>
                  <th class="text-center p-0" style="">Dni</th>
                  <!--<th class="text-center p-0" style="">Usuario</th>-->
                  <th class="text-center p-0" style="min-width:350px">Nombres</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>  
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card">

        <div class="card-header py-1 bg-light">
          <span class="font-14" id="tituloMantHorarios">Horarios establecidos</span>
        </div>

        <div class="card-body">

            <form id="formAsignarHorarios" style="">
              
              <div id="codigos_personal"></div>
              <div id="id_horarios"></div>

              <div class="row">
                <div class="form-group col-lg-6">
                  <label for="exampleInputEmail1">Periodo Desde:</label>
                  <input type="date" required name="PeriodoDesde" class="form-control form-control-sm" id="periodoDesde">                
                </div>
                <div class="form-group col-lg-6">
                  <label for="exampleInputEmail1">Periodo Hasta</label>
                  <input type="date" required name="PeriodoHasta" class="form-control form-control-sm" id="periodoHasta">
                </div>
              </div>

              <div class="table-responsive">
                <table id="tablaHorarios" style="width:100%" class="table table-bordered table-condensed table-sm">
                  <thead>
                    <tr class="bg-secondary">                           
                      <th class="text-center p-0" style="">Nombre</th>
                      <th class="text-center p-0" style="">Inicio</th>
                      <th class="text-center p-0" style="">Término</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>

              <div class="float-right mt-3">
                <button type="submit" class="btn btn-success btn-xs px-3" id="btnMantHorario"> <span class="font-13">Asignar Horarios</span> </button>
                <!--<button id="btnCancelar" class="btn btn-danger btn-xs px-3"> <span class="font-12">Cancelar</span></button>-->
              </div>  
              
            </form>
            
          
        </div>  
      </div>
    </div>
  </div>

  <style>
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