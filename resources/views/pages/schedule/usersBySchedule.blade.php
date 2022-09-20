
@extends('layouts.main')

@section('pageTitle' , 'RL | Horarios por usuario')

@section('moduleTitle' , 'Horarios por usuario')

@section('quickAccessLink' , route('u.manage') )
@section('quickAccessText' , 'Admin. usuarios' )
@section('quickAccess' , 'Horarios')

@section('moduleContent')
  
  <div class="row">
    <div class="col-12 ">
      <div class="card">
        <div class="card-header py-1 bg-light">
          <span class="font-14">Personal activo</span>
        </div>
        <div class="card-body">

          <form id="formHorariosPorUsuario" action="{{route('sch.usersByScheduleLoad')}}">
            <div class="row">
                <div class="form-group col-lg-3">
                  <label for="exampleInputEmail1">Periodo Desde:</label>
                  <input type="date" value="{{date('Y-m-d')}}" required name="PeriodoDesde" class="form-control form-control-sm" id="PeriodoDesde">                
                </div>
                <div class="form-group col-lg-3">
                  <label for="exampleInputEmail1">Periodo Hasta</label>
                  <input type="date" value="{{date('Y-m-d')}}" required name="PeriodoHasta" class="form-control form-control-sm" id="PeriodoHasta">
                </div>
                <div class="form-group col-lg-2">
                  <label for="exampleInputEmail1">Periodo Hasta</label>
                  <div>
                    <button tupe="submit" class="btn btn-success btn-sm btn-block">Buscar</button>
                  </div>
                </div>
            </div>
          </form>
          
          <div class="table-responsive">
            <table id="tblhorariosPersonal" style="width:100%" class="table table-bordered table-condensed table-sm">
              <thead>
                <tr class="bg-secondary">
                  <th class="text-center p-1" style="">#</th>
                  <th class="text-center p-1" style="">Documento</th>
                  <th class="text-center p-1" style="min-width:350px">Personal</th>
                  <th class="text-center p-1" style="">Horario</th>
                  <th class="text-center p-1" >Entrada / Salida</th>
                  <th class="text-center p-1" >Periodo Duración</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
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