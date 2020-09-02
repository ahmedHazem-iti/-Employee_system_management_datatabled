@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css">

<table class="table table-striped" id="appliedartists-table">
    <thead>
        <tr>
    <th>Name</th>
    <th>Username</th>



            <th>Admin Status</th>

        </tr>
    </thead>
    <tbody>
    @foreach($users as $users)
        <tr>
        <td>{{ $users->name }} </td>
        <td>{{ $users->username }}</td>

        <td>
            <input data-id="{{$users->id}}" class="first toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $users->admin_role==1 ? 'checked' : '' }}>
        </td>


        </tr>
    @endforeach
    </tbody>

</table>

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
    $(function() {
      $('.first').change(function() {
          var status = $(this).prop('checked') == true ? 1 : 0;
          var user_id = $(this).data('id');

          $.ajax({
              type: "GET",
              dataType: "json",
              url: '/admin/changeStatus',
              data: {'status': status, 'user_id': user_id},
              success: function(data){
              console.log(data.success)
              }
          });
      })
    });
///////


  </script>
@endsection

