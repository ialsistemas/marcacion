@extends('layouts.main')

@section('pageTitle','RL | Iniciar Sesión')

@section('login')
    <div class="login-box" style="width: 430px;">
        <div class="card card-outline card-primary p-3"> 

            <div class="card-header text-center py-3">
                <h4> Control de Asistencia en Línea</h4>
                <h4> I.A.L </h4>
            </div>

            <div class="card-body">

                <p class="login-box-msg">ADMINISTRADOR - DOCENTE</p>
                
                <form action="{{route('auth.login')}}" method="post">

                    @csrf
                    
                    <div class="input-group mb-3">
                        <input name="usuario" required autofocus type="text" value="{{old('usuario')}}" class="form-control @error('usuario') is-invalid @enderror" placeholder="Usuario">
                        <div class="input-group-append">
                            <div class="input-group-text bg-muted">
                                <span class="fas fa-user text-secondary"></span>
                            </div>
                        </div>
                        @error('usuario') 
                            <div class="invalid-feedback text-uppercase">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <div class="input-group mb-4">
                        <input name="password" required type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña">
                        <div class="input-group-append">
                            <div class="input-group-text bg-muted">
                                <span class="fas fa-lock text-secondary"></span>
                            </div>
                        </div>
                        @error('password') 
                            <div class="invalid-feedback text-uppercase">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    
                    @if ($errors->any())
                        @error('error')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">                         
                                {{$message}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @enderror
                    @endif

                    <button type="submit" class="btn py-2 btn-sm shadow-sm btn-primary btn-block">
                        INICIAR SESIÓN
                        <i class="fas fa-sign-in-alt ml-2"></i>
                    </button>
                    
                </form>

            </div>
        </div>  
    </div> 
@endsection