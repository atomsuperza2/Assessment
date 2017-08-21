
@extends('layouts.app')

@section('content')

@if(session()->has('message'))
<h2 class ="alert alert-succress">{{session()->get('message')}}</h2>
@endif

<div class="container form-container">

<div class="col-md-12">
  <ol class="breadcrumb">
    <li><a href="/home">Home</a></li>
    <li class="active">employee list</li>
  </ol>
    <div class="panel-regis">
    <div class="heading"></div>
    <div class="panel-body">
<table class="table table-striped">

  <tr>
    <th>ID</th>
<th>Employee</th>

<th>Action</th>
</tr>
<div class="container">
  @foreach ($user as $user)
    <tr>
      <td>{{ $user->id }}</td>
        <td>{{ $user->name}}</td>


        <td>

          <a href="{{ route('assessment', $user->id) }}" class="btn btn-info">assessment</a>

          <!-- for admin -->
          @can('store_assessment')
          <a href="{{ route('resultTotlalScore', $user->id ) }}" class="btn btn-success">Summary</a>
          @endcan
        </td>

    @endforeach

    </tr>
</div>
</table>
</div>
</div>
</div>
</div>
@endsection
