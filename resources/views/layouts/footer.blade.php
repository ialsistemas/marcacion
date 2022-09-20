
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/jquery/jquery-ui.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('plugins/notiflix/js/notiflix-3.2.5.min.js')}}"></script>
<script src="{{asset('plugins/datatables/datatables.min.js')}}"></script>
<script src="{{asset('plugins/datatables/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/datatables/vfs_fonts.js')}}"></script>
<script>
    const urlBase = "{{ url('/') }}"
</script>
<script src="{{asset('src/js/template/adminlte.js')}}"></script>
<script src="{{asset('src/js/pages/main.js')}}"></script>


@isset($scripts)
    @foreach ($scripts as $script)
        <script src="{{asset($script)}}?v={{rand(1,50)}}"></script> 
    @endforeach
@endisset
