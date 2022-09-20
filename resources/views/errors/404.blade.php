<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Página no encontrada </title>
    <link rel="shortcut icon" type="image/png" href="{{asset('src/assets/img/logo/logo.png')}}"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset('src/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('src/css/global.css')}}">

</head>
<body class="d-flex" style="background:#f7fafc;height:100vh;width:100vw">
   
    <div class="m-auto" style="max-width:280px">
        <div class="text-dark font-weight-bolder" style="font-size:90px">404</div>
        <div id="line" class="bg-dark mb-1" style="height:2px;width:50px"></div>
        <div class="text-muted font-15 mb-4">Lo sentimos, no hemos podido encontrar la página que está buscando.</div>
        <div> 
           
            <a href="{{route('pagenotfound')}}" class="btn btn-sm btn-outline-light text-dark">Regresar</a> 
        
        </div>
 
    </div>

</body>
</html>