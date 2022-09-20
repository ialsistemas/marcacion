
@extends('layouts.main')

@section('pageTitle','RL | Bandeja de entrada')

@section('moduleTitle','Bandeja de entrada')

@section('quickAccessLink' , route('attendance'))
@section('quickAccessText' , 'Registrar Asistencia' )
@section('quickAccess' , 'Bandeja de entrada')

@section('moduleContent')

  <div class="card">

    <div class="card-body">

      <div class="row p-0">
        <div class="col-lg-3 col-md-4 col-sm-4">
          
            <label for="desde" class="mr-2">Desde:</label>
            <input type="date" value="{{date("Y-m-01")}}" class="form-control form-control-sm font-12 inputRL" id="desdeBusqueda">
          
        </div>
        <div class="col-lg-3 col-md-4 col-sm-4">
          
            <label for="hasta" class="mr-2">Hasta:</label>
            <input type="date"  value="{{date("Y-m-d")}}" class="form-control form-control-sm inputRL" id="hastaBusqueda">
          
        </div>
        <div class="col-md-2 col-sm-2">
          <label for="">Buscar</label>
          <button disabled class="btn btn-sm btn-block btn-success font-14" id="btnFiltrar"><i class="fas fa-search"></i></button>
        </div>
      </div>

    </div>  
  </div>

  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-12">
            <p>Lista de sus registros de asistencia en CORPORACION ARZOBISPO LOAYZA SOCIEDAD ANONIMA CERRADA</p>
        </div>
      </div>
      <div class="table-responsive">
        <table id="tablaAdministrarMarcaciones" style="width:100%" class="table table-bordered table-condensed table-sm table-striped">
          <thead>
            <tr class="bg-secondary">
              <th class="text-center p-1 font-15 font-weight-normal" style="max-width:40px" >#</th>
              <th class="text-center p-1 font-15 font-weight-normal" style="min-width:300px" >Asunto</th>
              <th class="text-center p-1 font-15 font-weight-normal" style="max-width:160px" >Registro</th>
              <th class="text-center p-1 font-15 font-weight-normal" style="max-width:150px" >Fecha</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>  
  </div>

@endsection

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