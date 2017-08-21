
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
              echo "{label:'{$questionnaire->question}', y:{$questionnaire->user_scores($user->id)->sum('score')}},\r\n";
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
    <div class="heading"></div>

    <div class = "panel-body">
      <form action="{{ route('doresultTotlalScore', $user->id) }}  " method="POST">

        <div class="row">
          <div class="col-md-6">
            <label for="Employee" class="control-label">Employee name::</label>
          </div>
          <div class="col-md-6">
            <label for="Employee" class="control-label"> {{$user->name}}</label>
            <input class = "form-control" name="user_id" value= " {{$user->id}}" type="hidden">
            <input class = "form-control" name="user_name" value= " {{$user->name}}" type="hidden">
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
              <td>{{$questionnaire->user_scores($user->id)->sum('score')}}</td>
              <input type="hidden" name="question[]" value="{{$questionnaire->question}}">
              <input type="hidden" name="question_id[]" value="{{$questionnaire->id}}">
              <input type="hidden" name="sume_score[]" value="{{$questionnaire->user_scores($user->id)->sum('score')}}">
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

            <td>  {{$comments->comment}}
              <td><input type="hidden" name="comment[]" value="{{$comments->comment}}"></td> </td>

            </tr>

            @endforeach
          </table>
          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
              <a href="/user" class="btn btn-danger">back</a>
              </div>
              <div class="col-md-6 ">
                <button type="submit" class="btn btn-success" style="float:right;">save</button>
              </div>
            </div>
            </div>

          <input type="hidden" name="_token" value="{{csrf_token()}}">
      </form>

    </div>
  </div>



          </body>
</html>

@endsection
