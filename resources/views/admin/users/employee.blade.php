@extends('layouts.app')

@section('content')
<style>
    .pagination{
        display: inline-flex;
    }
    .searchbar{
        display: flex;
    justify-content: center;
    }
</style>
<div class="text-center">
    <h1> All Employee Which Users Owned On WebSite</h1>

    <nav class="navbar navbar-light bg-light searchbar">
        <form class="form-inline text-center">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </nav>

</div>
<table class="table table-hover table-dark">
        <thead>
        <tr>
    <th>Name</th>
    <th>Job</th>
    <th>Image</th>
    <th>Status</th>
    <th>Delete</th>





        </tr>
    </thead>
    <tbody>
    @foreach($employee as $users)
        <tr>
        <td>{{ $users->f_name }} {{$users->f_name}} </td>
        <td>{{ $users->job }}</td>
        <td> <img style="height: 100px;width:100px" src="/{{ $users->image }}" alt=""> </td>
        <td>{{ $users->status }}</td>
        <td><a href="{{route('deleteemployee',$users->id)}}" type="button" class="btn btn-danger">Delete</a>
        </td>






        </tr>
    @endforeach
    </tbody>

</table>
<div class="text-center ">
    {{ $employee->links() }}

</div>

@endsection
