@extends('admin/dashboard')

@php $aActivelang = ClaraLang::getActiveLang() @endphp

@section('CSS')
    <!-- DataTables -->
    {!! Html::style('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') !!}
    
    <!-- Select 2 -->
    {!! Html::style('bower_components/select2/dist/css/select2.min.css') !!}
    
    <style>
        .select2
        {
            width: 100% !important
        }
        
        .select2-results__option
        {
            height: 32px;
        }
    </style>
@stop

@section('content')

<div class="col-md-6">
    @if(session()->has('ok'))

        <div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>

    @endif
        
    <!-- TABLE: LATEST ORDERS -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Liste</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="tab-admin" class="table no-margin table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{ __('clara-page::page.title_page') }}</th>
                        <th>{{ __('clara-page::page.fk_page_category') }}</th>
                        <th>{{ __('clara-page::page.url_page') }}</th>
                        @if (count($aActivelang) > 1)
                        <th>{{ __('clara-page::page.fk_lang') }}</th>
                        @endif
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                @if (count($aActivelang) > 1)
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>
                            <select class="select2" data-col="4">
                                <option value=""></option>
                                @foreach ($aActivelang as $iIdLang => $sLang)
                                    <option value="{{ $iIdLang }}">{{ $sLang }}</option>
                                @endforeach
                            </select>
                        </th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            {!! Button::info('Ajouter')->asLinkTo(route('admin.page.create'))->small() !!}
        </div>
        <!-- /.box-footer -->
    </div>
    <!-- /.box -->
</div>
@endsection

@section('JS')
    {!! Html::script('bower_components/datatables.net/js/jquery.dataTables.min.js') !!}
    {!! Html::script('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') !!}
    
    <script type="text/javascript">
        $(document).ready(function() {
            $.fn.dataTable.ext.errMode = 'none';
            $('#tab-admin').DataTable({
                serverSide: true,
                ajax: {
                    'url': '{{ route('api.admin.page.index') }}'
                },
                columns: [
                    { 'data': 'id_page' },
                    { 'data': 'title_page' },
                    { 
                        'data': 'category_name',
                        'name': 'page_category.page_category_trans.name_page_category'
                    },
					{ 'data': 'url_page' },
                    @if (count($aActivelang) > 1)
					{ 
                        'data': 'fk_lang',
                        render: function(data, type, row, meta) {
                            switch (data)
                            {
                                @foreach ($aActivelang as $iIdLang => $sLang)
                                case {{ $iIdLang }}:
                                case '{{ $iIdLang }}':
                                    return '{{ $sLang }}';
                                @endforeach
                            }
                        }
                    },
                    @endif
                    {
                        "data": "id_page",
                        "render": function ( data, type, row, meta ) {

                            var render = "{!! Button::warning('Modifier')->asLinkTo(route('admin.page.edit', 'dummyId'))->extraSmall()->block()->render() !!}";
                            render = render.replace("dummyId", data);

                            return render;
                        }
                    },
                    {
                        "data": "id_page",
                        "render": function ( data, type, row, meta ) {

                            var render = '{!! BootForm::open()->action( route("admin.page.destroy", "dummyId") )->attribute("onsubmit", "return confirm(\'Vraiment supprimer cet objet ?\')")->delete() !!}'
                                +'{!! BootForm::submit("Supprimer", "btn-danger")->addClass("btn-block btn-xs") !!}'
                                +'{!! BootForm::close() !!}';
                            render = render.replace("dummyId", data);

                            return render;
                        }
                    }
                ], 
                aoColumnDefs: [
                    {
                        bSortable: false,
                        aTargets: [ -1, -2 ]
                    }
                ],
                "language": {
                    "sProcessing":     "Traitement en cours...",
                    "sSearch":         "Rechercher&nbsp;:",
                    "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
                    "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                    "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                    "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                    "sInfoPostFix":    "",
                    "sLoadingRecords": "Chargement en cours...",
                    "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                    "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
                    "oPaginate": {
                        "sFirst":      "Premier",
                        "sPrevious":   "Pr&eacute;c&eacute;dent",
                        "sNext":       "Suivant",
                        "sLast":       "Dernier"
                    },
                    "oAria": {
                        "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                        "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                    }
                }
            });
        } );
    </script>
    
    <!-- Select 2 -->
    {!! Html::script('bower_components/select2/dist/js/select2.full.min.js') !!}
    
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                them: 'bootstrap',
                minimumResultsForSearch: -1
            });
            
            $('.select2').val('').change();
            
            $('.select2').on('change', function(){
                var column = $('#tab-admin').dataTable().api().column($(this).data('col'));
                var val = $.fn.dataTable.util.escapeRegex(
                    $(this).val()
                );

                column
                    .search(val ? val : '', true, false)
                    .draw();
            });
        });
    </script>
@endsection
