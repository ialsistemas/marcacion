
@extends('layouts.main')

@section('pageTitle','RL | Administrar Usuarios')

@section('moduleTitle','Administrar Usuarios')

@section('moduleContent')

  <div class="card">

    <div class="card-body table-responsive">

      <div class="row mb-2">
        <div class="col-lg-3 col-md-5 col-sm-8 col-12">
          <div class="form-group">
            <label class="text-secondary font-14 font-weight-normal" for="tipoUsuario">Tipo de usuario</label>
            <select class="form-control form-control-sm" id="tipoUsuario">
              <option value="0">TODOS</option>
              @foreach ($tipo_usuarios as $item)
                  
                    <option value="{{$item->Id}}">{{strtoupper($item->TipoUsuario)}}</option>
                               
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-lg-2 offset-lg-7">
          <label for="" class="font-14">Crear Usuario</label>
            <div>  
              <button class="btn btn-success btn-xs btn-block" id="btnCrearUsuario"><i class="fas fa-plus"></i></button>
            </div>
        </div>
      </div>

      <table id="tablaAdministrarUsuarios" style="width:100%" class="table table-bordered table-condensed table-sm table-striped">

        <thead>
          <tr class="bg-secondary">
            <th class="text-center font-15 font-weight-normal" style="" >#</th>
            <th class="text-center font-15 font-weight-normal" style="" >Nombres</th>
            <th class="text-center font-15 font-weight-normal" style="" >Apellidos</th>
            <th class="text-center font-15 font-weight-normal" style="" >Documento</th>
            <th class="text-center font-15 font-weight-normal" style="" >Tipo</th>
            <th class="text-center font-15 font-weight-normal" style="" >Estado</th>
            <th class="text-center font-15 font-weight-normal" style="" >Opciones</th>
          </tr>
        </thead>

        <tbody>
        </tbody>

      </table>
    </div>  
  </div>

  <!-- Modal editar usuario -->
  <div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar Usuario</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('u.manage.edit') }}" method="post" id="formEditarUsuario">
          <div class="modal-body">

            @csrf
            <input type="hidden" name="id" id="idEditar">
            
            <div class="form-group">
              <label for="codigoEditar">Código Usuario:</label>
              <input type="text" disabled class="form-control form-control-sm" id="codigoEditar">
            </div>

            <div class="form-group">
              <label for="nombresEditar">Nombres:</label>
              <input type="text" disabled class="form-control form-control-sm" id="nombresEditar">
            </div>

            <div class="form-group">
              <label for="passworEditar">Contraseña</label>
              <input type="password" name="password" class="form-control form-control-sm" id="passwordEditar">
            </div>

            <div class="form-group">
              <label for="estadoEditar">Estado</label>
              <select class="form-control form-control-sm" name="estado" id="estadoEditar">

              </select>
            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
          </div>
        </form>
      </div>
    </div>
  </div>


<div class="modal fade" id="modalCrearUsuario" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-16" id="staticBackdropLabel">Crear Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formCrearUsuario" action="{{route('u.manage.create')}}">
      <div class="modal-body">
        @csrf
          <div class="form-group">
            <label for="">Apellidos</label>
            <input required type="text" class="form-control form-control-sm" name="Apellidos">
          </div>
          <div class="form-group">
            <label for="">Nombres</label>
            <input required type="text" class="form-control form-control-sm" name="Nombres">
          </div>
          <div class="form-group">
            <label for="">Dni</label>
            <input required type="number" class="form-control form-control-sm" name="Dni">
          </div>
          <div class="form-group">
            <label for="">Usuario</label>
            <input autocomplete="nope" required type="text" class="form-control form-control-sm" name="Usuario">
          </div>
          <div class="form-group">
            <label for="">Tipo de Usuario</label>
            <select required class="form-control form-control-sm" name="Tipo">
              <option disabled selected>Seleccione</option>
              @foreach ($tipo_usuarios as $item)             
                    <option value="{{$item->Id}}">{{strtoupper($item->TipoUsuario)}}</option>                                       
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="">Password</label>
            <input required autocomplete="new-password" type="password" class="form-control form-control-sm" name="Password">
            <small class="form-text font-12 text-muted">Mínimo 5 caracteres</small>
          </div>
      </div>
      <div class="modal-footer py-1">
        <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
      </div>
    </form>
    </div>
  </div>
</div>

@endsection