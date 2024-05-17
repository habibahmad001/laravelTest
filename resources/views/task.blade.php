<!DOCTYPE html>
<html>
<head>
    <title>Laravel DataTables Editor</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
    <link rel="stylesheet" href="./css/editor.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script src="./js/dataTables.editor.js"></script>
</head>

<body>
<div class="container">
    <h1>Laravel DataTables Editor</h1>
    <table id="items-table" class="display" style="width:100%">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
        </thead>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var editor = new $.fn.dataTable.Editor({
            ajax: {
                create: {
                    type: 'POST',
                    url: '{{ route('items.store') }}',
                    data: function (d) {
                        d._token = $('meta[name="csrf-token"]').attr('content');
                    }
                },
                edit: {
                    type: 'PUT',
                    url: function (data) {
                        return '{{ route('items.update', '') }}/' + data.data[Object.keys(data.data)[0]].id;
                    },
                    data: function (d) {
                        d._token = $('meta[name="csrf-token"]').attr('content');
                    }
                },
                remove: {
                    type: 'DELETE',
                    url: function (data) {
                        return '{{ route('items.destroy', '') }}/' + data.data[Object.keys(data.data)[0]].id;
                    },
                    data: function (d) {
                        d._token = $('meta[name="csrf-token"]').attr('content');
                    }
                }
            },
            table: "#items-table",
            fields: [
                { label: "Name:", name: "name" },
                { label: "Quantity:", name: "quantity" }
            ]
        });

        $('#items-table').DataTable({
            dom: "Bfrtip",
            ajax: '{{ route('items.data') }}',
            columns: [
                { data: "id" },
                { data: "name" },
                { data: "quantity" },
                { data: "created_at" },
                { data: "updated_at" }
            ],
            select: true,
            buttons: [
                { extend: "create", editor: editor },
                { extend: "edit", editor: editor },
                { extend: "remove", editor: editor }
            ]
        });
    });
</script>

</body>
</html>
