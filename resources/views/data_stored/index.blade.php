@extends('layouts.app')

@section('content')

@if(session()->has('message'))
<h2 class ="alert alert-succress">{{session()->get('message')}}</h2>
@endif

<div class="container form-container">

<div class="col-md-12">
  <ol class="breadcrumb">
    <li><a href="/home">Home</a></li>
    <li class="active">Scores stored</li>
  </ol>
    <div class="panel-regis">

    <div class="panel-body">
<table class="table table-striped">

  <tr>
    <th>Name</th>
    <th>Questionnaire</th>
    <th>Sum score</th>
    <th>Create date</th>
    <th>Action</th>
  </tr>
<div class="container">
    @foreach ($score as $scores)
    <tr>
      <td>{{ $scores->user_name}}</td>
        <td>{{$scores->question}}</td>
        <td>{{$scores->sume_score}}</td>
        <td>{{$scores->created_at}}</td>

        <td>
          {!! Form::open(['method'=>'DELETE', 'route'=>['data_stored.destroy',$scores->id]]) !!}

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
