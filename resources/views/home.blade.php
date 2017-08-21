@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

  </head>
  <body>
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-6">
          <a href="/user" class="btn btn-warning" style="height: 200px; width: 45%; margin-left: 50%; margin-top: 25%;">
            <img src="/upload/Ass.png" style="margin-top:5px; width:200px; height:160px;"><br><label for="resulr">Assessment</label></a>
        </div>
        <div class="col-md-6">
          <a href="{{ route('totalScore', Auth::user() ) }}" class="btn btn-success" style="height: 200px; width: 45%; margin-right: 35%; margin-top: 25%;">
          <img src="/upload/re.png" style="margin-top:5px; width:200px; height:160px;"><br><label for="resulr">Result Assessment</label></a>
        </div>
      </div>

    </div>




    </body>

</html>

@endsection
