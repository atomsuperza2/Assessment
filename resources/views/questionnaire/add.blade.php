@extends('layouts.app')

@section('content')



<div class="container form-container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <ol class="breadcrumb">
            <li><a href="/home">Home</a></li>
            <li><a href="/questionnaire">Questionnaire management</a></li>
            <li class="active">Add new Questionnaire</li>
          </ol>
            <div class="panel-regis">
                <div class="heading">New Questionnaire</div>

                <div class = "panel-body">
                <form class = "" method = "POST" action = "{{URL('/questionnaire/add')}}">
                  <label for="dateEnd" class="col-md-4 control-label">Questionnaire</label>
                  <input type= "text" class = "form-control" name="question" ><br>
                  <label for="dateEnd" class="col-md-4 control-label">Date create</label>
                  <input type= "text" class = "form-control" name="date_create" value="{{$today->toDateString()}}"><br>


                    <!-- <input type= "text" class = "form-control" name="UserQId" placeholder="UserQId"><br> -->
                <button type="submit" class="btn btn-success">save</button>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
            </div>
        </div>
    </div>
</div>
@endsection
