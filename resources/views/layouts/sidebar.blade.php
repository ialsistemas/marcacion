<aside class="main-sidebar sidebar-dark-primary elevation-0">
                
    <a href="{{route('attendance')}}" class="brand-link bg-white border-right d-flex justify-content-center align-items-center p-2">
        <img SRC="{{asset('src/assets/img/logo/logo.png')}}" alt="IAL LOGO" class="brand-image" style="max-height:43px">
        <span class="text-dark font-weight-bold" style="font-size:20px">IAL</span>
    </a>

    <div class="sidebar">
        <nav class="mt-4">
            <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-flat nav-legacy nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <?php
                    $route_ = trim(Route::currentRouteName());
                    $path_ = explode( "/" , trim(Request::path()) )[0];
                ?>
                <!--REGISTRAR ASISTENCIA-->
                @if(Auth::user()->hasRole('empleado'))
                    <li class="nav-item active">
                        <a href="{{route('attendance')}}" class="nav-link">
                            <i class="nav-icon far fa-clock" ></i>
                            <p>Registrar Asistencia </p>
                        </a>
                    </li>
                    <!--BANDEJA DE ENTRADA-->
                    <li class="nav-item">
                        <a href="{{route('users.inbox')}}" class="nav-link">
                            <i class="nav-icon fas fa-inbox" ></i>
                            <p> Bandeja de entrada </p>
                        </a>
                    </li>
                @endif
                <!--USUARIOS-->
                @if(Auth::user()->hasRole('administrador'))
                    <li class="nav-item @if ( $path_ === "users" ) menu-open @endif">
                        <a href="#" class="nav-link @if ( $path_ === "users" ) active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Usuarios
                                <i class="fas fa-angle-left right"></i>                             
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('u.manage')}}" class="nav-link @if ( $route_ === "u.manage" ) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Usuarios</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item @if ( $path_ === "schedule" ) menu-open @endif">
                        <a href="#" class="nav-link @if ( $path_ === "schedule" ) active @endif">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                Horarios
                                <i class="fas fa-angle-left right"></i> 
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('sch.manage')}}" class="nav-link @if ( $route_ === "sch.manage" ) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Admin. Horarios</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('sch.assignment')}}" class="nav-link @if ( $route_ === "sch.assignment" ) active @endif" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Asignación Horarios</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('sch.usersBySchedule')}}" class="nav-link @if ( $route_ === "sch.usersBySchedule" ) active @endif" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Horarios por usuario</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item @if ( $path_ === "reports" ) menu-open @endif">
                        <a href="#" class="nav-link @if ( $path_ === "reports" ) active @endif">
                            <i class="nav-icon fas fa-chart-bar"></i>
                            <p>
                                Reportes
                                <i class="fas fa-angle-left right"></i>                      
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('recordsManagement')}}" class="nav-link @if ( $route_ === "recordsManagement" ) menu-open @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Administrar registros</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!--<li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cog"></i>
                            <p> Configuración <i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Información Personal</p>
                                </a>
                            </li>
                        </ul>
                    </li>-->
                @endif
            </ul>
        </nav>
    </div>

</aside>