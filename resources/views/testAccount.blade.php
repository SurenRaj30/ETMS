<!DOCTYPE html>
<html>

<head>

    <title>Laravel 5.8 Datatables Tutorial - ItSolutionStuff.com</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

</head>

<body>

    

<div class="container mt-5">

    <table class="table table-bordered data-table shadow">

        <thead>

            <tr>

                <th>No</th>

                <th>Provider Name</th>
                
                <th>Provider Email</th>

                <th>Contact No</th>

                <th style="width:5px;">Status</th>

                <th style="width:200px;">Action</th>
               
            </tr>

        </thead>

        <tbody>

        </tbody>

    </table>

</div>

</body>

<script type="text/javascript">

 
  $(function (row, data) {

    var table = $('.data-table').DataTable({

        processing: true,

        serverSide: true,

        ajax: "{{ route('pendingList') }}",

        columns: [

            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'p_no', name: 'p_no'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},

        ]

    });

  });

</script>

</html>