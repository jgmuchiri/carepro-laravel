<link href="/plugins/datatable/css/dataTables.bootstrap.css" rel="stylesheet"/>
<link href="/plugins/datatable/css/responsive.bootstrap.min.css" rel="stylesheet"/>

<script src="/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="/plugins/datatable/js/dataTables.bootstrap.js"></script>

@if(isset($advanced))
    <link href="/plugins/datatable/css/buttons.dataTables.min.css" rel="stylesheet"/>

    <script src="/plugins/datatable/js/dataTables.buttons.min.js"></script>
    <script src="/plugins/datatable/js/buttons.print.min.js"></script>
    <script src="/plugins/datatable/js/buttons.colVis.min.js"></script>
@endif
<script>
    $(document).ready(function () {
        @if(isset($advanced))
            {!! $advanced !!}
        @else
        $('<?php echo $table; ?>').DataTable();
        @endif

    });
</script>