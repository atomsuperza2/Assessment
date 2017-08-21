@extends('layouts.app')

@section('title', 'Edit User ' . $user->name)

@section('content')



    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-10 col-md-offset-1">
              <ol class="breadcrumb">
                <li><a href="/home">Home</a></li>
                <li class="active">Change user info</li>
              </ol>
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        {!! Form::model($user, ['method' => 'PUT', 'route' => ['users.update',  $user->id ] ]) !!}
                            @include('user._form')
                            <!-- Submit Form Button -->
                            {!! Form::submit('Save Changes', ['class' => 'btn btn-success']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
