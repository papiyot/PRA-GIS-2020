<!-- <script src="{{ asset('js/codebase.core.js')}}"></script> -->
<script src="{{ asset('js/codebase.app.js')}}"></script>
<script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('js/pages/be_tables_datatables.min.js')}}"></script>
<script src="{{ asset('js/plugins/select2/js/select2.full.min.js')}}"></script>
{{--<script src="{{ asset('js/pages/be_forms_plugins.min.js')}}"></script>--}}

{{--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap-confirmation2/dist/bootstrap-confirmation.min.js"></script>
<script>
    jQuery(function() {
        Codebase.helpers(['select2']);
    });
</script>
<script>

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<script>
    $('[data-toggle=confirmation]').confirmation({
        rootSelector: '[data-toggle=confirmation]',
    });
</script>
@yield('js')