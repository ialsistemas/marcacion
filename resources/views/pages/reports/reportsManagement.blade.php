
@extends('layouts.main')

@section('pageTitle','RL | Gestión de registro')

@section('moduleTitle','Gestionar registros')

@section('quickAccessLink' , route('attendance'))
@section('quickAccessText' , 'Inicio' )
@section('quickAccess' , 'Gestión de registros')

@section('moduleContent')

  <div class="card">
    <div class="card-header py-1 bg-light">
        <span class="font-15">Búsqueda y carga</span>
    </div>
    <div class="card-body">
      <div class="row p-0">
    
        <div class="col-lg-2 col-md-4 col-sm-6">        
            <label for="desde" class="mr-2">Desde:</label>
            <input type="date" disabled value="{{ date("Y-m-01") }}" class="form-control form-control-sm inputRL" id="desdeBusqueda">
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">        
            <label for="hasta" class="mr-2">Hasta:</label>
            <input type="date" disabled value="{{ date("Y-m-d") }}" class="form-control form-control-sm inputRL" id="hastaBusqueda">
        </div>
        <div class="col-lg-4 col-md-4 col-sm-8">        
            <label for="desde" class="mr-2">Usuario:</label>
            <input type="text" disabled codigo="" class="form-control form-control-sm inputRL" id="usuarioBusqueda">
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4">
            <label for="">Buscar</label>
            <button disabled class="btn btn-sm font-13 btn-block btn-success" id="btnBusqueda"><i class="fas fa-search"></i></button>
        </div>

      </div>
    </div>  
  </div>

  <div class="card">
    <div class="card-header py-1 bg-light">
        <span class="font-15">Registros de Asistencia</span>
          <button href="#" disabled type="button" class="float-right btn btn-danger btn-sm ml-2 px-4"><i class="far fa-file-pdf text-white"></i></button>
          
          <!--<a href="{{--route('rep.downloadExcel',[ "desde" => "hoy", "hasta" => "manana" , "codigo" => "000000" , "personal" => "gonzalo"])--}}" type="submit" class="float-right btn btn-success btn-sm px-4 text-white"><i class="far fa-file-excel text-white"></i></a>-->
          <button type="button" disabled id="downloadExcel" class="float-right btn btn-success btn-sm px-4 text-white"><i class="far fa-file-excel text-white"></i></button>

      </div>
    <div class="card-body">   
      <div class="table-responsive">
        <table id="tablaAdministrarMarcaciones" style="width:100%" class="table table-bordered table-condensed table-sm table-striped">
          <thead>
            <tr class="bg-secondary">
              <th class="text-center p-1 font-15 font-weight-normal" style="max-width:40px">#</th>
              <th class="text-center p-1 font-15 font-weight-normal" style="max-width:80px">DNI</th>
              <th class="text-center p-1 font-15 font-weight-normal" style="max-width:80px">Cód. emp</th>
              <th class="text-center p-1 font-15 font-weight-normal" style="min-width:100px">Empleado</th>
              <th class="text-center p-1 font-15 font-weight-normal" style="min-width:60px">Fecha/Hora</th>
              <th class="text-center p-1 font-15 font-weight-normal" style="min-width:60px">Reloj</th>
              <th class="text-center p-1 font-15 font-weight-normal" style="max-width:50px">Tipo registro</th>
              <th class="text-center p-1 font-15 font-weight-normal" style="max-width:30px">Estado</th>
            </tr>
          </thead>
          <tbody>
            <tr><td class="font-14 text-center" colspan="8">Realice una búsqueda de registros de asistencia por un intervalo de fechas. Puede utilizar filtros de búsqueda por empleado.</td></tr>
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