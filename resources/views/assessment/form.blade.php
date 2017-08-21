@extends('layouts.app')



@section('content')

<div class="container form-container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="panel-regis">
                <div class="heading"></div>

                <div class = "panel-body">
                  <form name = "content" action=" {{ route('doassessment', $user->id) }} " method="post">

                    <div class="row">
                      <div class="col-md-6">
                        <label for="Employee" class="control-label">Assessor::</label>
                      </div>
                      <div class="col-md-6">
                      <label for="Employee" class="control-label"> {{$auth->name}}</label>
                      <input class = "form-control" name="auth_id" value= " {{$auth->id}}" type="hidden">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <label for="Employee" class="control-label">The assessment::</label>
                      </div>
                      <div class="col-md-6">
                      <label for="Employee" class="control-label"> {{$user->name}}</label>
                      <input class = "form-control" name="user_id" value= "{{$user->id}} " type="hidden">
                      </div>
                    </div>



              <table class="table table-striped">

                <tr>
                  <th>Questionnaire</th>
                  <th>Score</th>

                </tr>
                <div class="container">
                  @foreach ($questionnaire as $questionnaires)
                  <tr>
                          <td>
                            <label for="questionnaire" class="control-label">{{$questionnaires->question}}</label>
                            <input type="hidden" name="questionnaire_id[]" value="{{$questionnaires->id}}">
                            </td>

                          <td>
                  <select class="form-control" name="score[]">
                    <option value=" 1">1</option>
                    <option value=" 2">2</option>
                    <option value=" 3">3</option>
                    <option value=" 4">4</option>
                    <option value=" 5">5</option>
                  </select>
                </td>

                    </tr>
                    @endforeach


    </div>
      <?=csrf_field(); ?>
  </table>
    <br>
      <div class="row">



        <div class="col-md-12 col-md-offset-0">
          <label for="comment" class="control-label">Comment:</label><br>
          <textarea name="comment" rows="5" cols="50" class = "form-control"></textarea><br>
        </div>
      </div>
      <br>
  <div class="form-group">
    <div class="row">
      <div class="col-md-6">
      <a href="/user" class="btn btn-danger">back</a>
      </div>
      <div class="col-md-6 ">
        <button type="submit" class="btn btn-success" style="float:right;">submit</button>
      </div>
    </div>
    </div>

  <input type="hidden" name="_token" value="{{csrf_token()}}">

                  </form>
                </div>
              </div>

          </div>
        </div>

@endsection
