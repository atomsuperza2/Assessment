
@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    {!! Charts::styles() !!}
    <script src="js/canvasjs.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script type="text/javascript">
    window.onload = function () {
    	var chart = new CanvasJS.Chart("chartContainer", {
    		theme: "theme2",//theme1
    		title:{
    			text: "Chart summary"
    		},
    		animationEnabled: false,   // change to true
    		data: [
    		{
    			// Change type to "bar", "area", "spline", "pie",etc.
    			type: "column",
    			dataPoints: [

            <?php
            foreach ($questionnaires as $questionnaire) {
              echo "{label:'{$questionnaire->question}', y:{$questionnaire->user_scores($auth->id)->sum('score')}},\r\n";
            } ?>
    			]
    		}
    		]
    	});
    	chart.render();
    }
    </script>
  </head>
  <body>
    <div class="col-md-10 col-md-offset-1">
      <ol class="breadcrumb">
        <li><a href="/home">Home</a></li>
        <li class="active">Summary</li>
      </ol>
    <div class="heading"></div>

    <div class = "panel-body">
      <form name = "content" action="{{URL('/assessment/{Auth::id}/result')}}" method="get">

        <div class="row">
          <div class="col-md-6">
            <label for="Employee" class="control-label">Employee name::</label>
          </div>
          <div class="col-md-6">
            <label for="Employee" class="control-label"> {{$auth->name}}</label>
            <input class = "form-control" name="auth_id" value= " {{$auth->id}}" type="hidden">
          </div>
        </div>

        <br>
        <table class="table table-striped" >

          <tr>
            <th>Questionnaire</th>

            <th>Score</th>

          </tr>
          <div class="container">
            @foreach ($questionnaires as $questionnaire)
            <tr>
              <td>{{$questionnaire->question}}</td>
              <td>{{$questionnaire->user_scores($auth->id)->sum('score')}}</td>
              <td><input type="hidden" name="sume_score" value="{{$questionnaire->user_scores($auth->id)->sum('score')}}"></td>
              </tr>


              @endforeach


            </div>
            <?=csrf_field(); ?>
          </table><br>
          <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                <br>
                <br>
            <label for="comment" class="control-label">Comment::</label><br>
            <table class="table table-striped" >

          @foreach ($comment as $comments)
          <tr>

            <td>  {{$comments->comment}}</td>

            </tr>

            @endforeach
          </table>
      </form>
      <div class="form-group">
        <div class="row">
          <div class="col-md-6">

          </div>
          <div class="col-md-6 ">
            <a href="/home" class="btn btn-danger" style="float:right;">back home</a>
          </div>
        </div>
        </div>
    </div>
  </div>



          </body>
</html>

@endsection
