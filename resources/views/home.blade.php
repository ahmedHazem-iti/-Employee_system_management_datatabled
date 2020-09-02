@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Employee System Management</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="/admin/employee" type="button" class="btn btn-primary btn-lg btn-block">Employee System Management</a>
                    @if (Auth::user() && Auth::user()->admin_role==1)
                    <a href="{{route('supercontrol')}}" type="button" class="btn btn-primary btn-lg btn-block">SuperUser System Management</a>
                    <a href="{{route('allemployee')}}" type="button" class="btn btn-primary btn-lg btn-block">All EMployee</a>
                    @endif


                 </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
