@extends('layouts.app')

@section('content')

@if(session()->has('message'))
<h2 class ="alert alert-succress">{{session()->get('message')}}</h2>
@endif

<div class="container form-container">

<div class="col-md-12">
  <ol class="breadcrumb">
    <li><a href="/home">Home</a></li>
    <li class="active">Questionnaire management</li>
  </ol>
    <div class="panel-regis">
    <div class="heading">Questionnaire <a href="/questionnaire/add" class="btn btn-primary "style="float:right;">New Questionnaire</a></div>
    <div class="panel-body">
<table class="table table-striped">

  <tr>
    <th>ID</th>
    <th>Questionnaire</th>
    <th>Date Create</th>
    <th>Action</th>
  </tr>
<div class="container">
    @foreach ($questionnaire as $questionnaires)
    <tr>
      <td>{{ $questionnaires->id}}</td>
        <td>{{$questionnaires->question}}</td>
        <td>{{$questionnaires->date_create}}</td>

        <td>
          {!! Form::open(['method'=>'DELETE', 'route'=>['questionnaire.destroy',$questionnaires->id]]) !!}
									<a class="btn btn-warning" href="{{ route('questionnaire.edit', $questionnaires->id) }}">Edit</a>
									{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
									{!! Form::close() !!}


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
