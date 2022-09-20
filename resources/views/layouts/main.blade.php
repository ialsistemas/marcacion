    
@include('layouts.head')

    <body class="@auth sidebar-mini layout-footer-fixed text-sm control-sidebar-slide-open @endauth @guest hold-transition login-page @endguest">
        
        @auth
            
            <div class="wrapper">

                @include('layouts.nav')

                @include('layouts.sidebar')

                <div class="content-wrapper p-0 p-md-2">
                
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-8">
                                    <h5 class="m-0 font-weigth-700">
                                        
                                        @yield('moduleTitle','Nuevo Módulo')
                                    
                                    </h5>
                                </div>
                                <div class="col-sm-4 d-none d-sm-block">
                                    <ol class="breadcrumb float-right">
                                        <li class="breadcrumb-item text-dark"><a href="@yield('quickAccessLink',route('attendance'))" class="text-primary"> @yield( 'quickAccessText' , 'Inicio') </a></li>
                                        <li class="breadcrumb-item active">@yield( 'quickAccess' , 'Página principal' )</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content">
                        <div class="container-fluid">
                            
                            @yield('moduleContent','¡NO SE PUDO CARGAR EL CONTENIDO DEL MÓDULO!')

                        </div>
                    </div> 

                </div>

                <footer class="main-footer" style="font-size:13px">
                    Copyright &copy; 2022 <b>Instituto Arzobispo Loayza</b>.
                    Todos los derechos reservados.
                    <div class="float-right d-none d-sm-inline-block">
                        <b>Version</b> 1.0.0
                    </div>
                </footer>

            </div>  

        @endauth

        @guest

            @yield('login',"¡NO SE PUDO CARGAR LA PÁGINA!") 

        @endguest

        @include('layouts.footer')

    </body>
    
</html>