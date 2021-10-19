<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    @page {
      margin: 100px 25px;
    }

    header {
      position: fixed;
      top: -60px;
      left: 0px;
      right: 0px;
      height: 10%;

      background-color: rgba(0, 123, 255, 0.4);
      color: white;
      text-align: center;
      line-height: 50px;
      border-radius: 7px;
      -webkit-border-radius: 7px;
      -moz-border-radius: 7px;
      -ms-border-radius: 7px;
      -o-border-radius: 7px;
      font-size: 1.8rem;
    }

    .one {
      width: 120px;
      height: 120px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 320%;
      -webkit-border-radius: 320%;
      -moz-border-radius: 320%;
      -ms-border-radius: 320%;
      -o-border-radius: 320%;
      position: relative;
      margin-left: 33%;
      margin-top: -6%;
    }

    .two {
      width: 150px;
      height: 150px;
      background: rgba(255, 255, 255, 0.3);
      border-radius: 500%;
      -webkit-border-radius: 500%;
      -moz-border-radius: 500%;
      -ms-border-radius: 500%;
      -o-border-radius: 500%;
      position: relative;
      margin-left: 90%;
      margin-top: -17%;
    }

    .three {
      width: 210px;
      height: 210px;
      background: rgba(255, 255, 255, 0.4);
      border-radius: 620%;
      -webkit-border-radius: 620%;
      -moz-border-radius: 620%;
      -ms-border-radius: 620%;
      -o-border-radius: 620%;
      position: relative;
      margin-left: 55%;
      margin-top: -15%;
    }

    footer {
      position: fixed;
      bottom: -60px;
      left: 0px;
      right: 0px;
      height: 50px;

      background-color: rgba(0, 123, 255, 0.4);
      color: white;
      text-align: center;
      line-height: 35px;
      border-radius: 7px;
      -webkit-border-radius: 7px;
      -moz-border-radius: 7px;
      -ms-border-radius: 7px;
      -o-border-radius: 7px;
    }

    section {
      height: 50px !important;
    }

    .px-1 {
      padding-right: .25rem !important;
      padding-left: .25rem !important;
    }

    .py-4 {
      padding-top: 1.5rem !important;
      padding-bottom: 1.5rem !important;
    }

    .px-2 {
      padding-right: .5rem !important;
      padding-left: .5rem !important;
    }

    .px-4 {
      padding-right: 1.5rem !important;
      padding-left: 1.5rem !important;
    }

    .border-dark {
      border-color: #343a40 !important;
    }

    .border {
      border: 1px solid #dee2e6 !important;
    }

    .my-1 {
      margin-top: .25rem !important;
      margin-bottom: .25rem !important;
    }

    .my-n1 {
      margin-top: 0;
      margin-bottom: 0;
    }
  </style>
</head>

<body>
  <header>
    <h3 style="margin-top: 20px;"><img src="{{ asset('img/shortlogo.gif') }}" alt="{{$nameProjects}}"> {{$nameProjects}}</h3>
    <div class="one"></div>
    <div class="two"></div>
    <div class="three"></div>
  </header>
  <footer>{{$nameProjects}} - Copyright &copy; {{date('Y')}}</footer>
  <div style="margin-top: 3.5rem; text-align: right; position: absolute; right: 1.5rem;" class="px-4">
    <div class="border border-dark" style="max-width:200px;">
      <small class="my-n1">CODIGO DOCUMENTO</small>
      <p class="my-n1" style="margin-right: .25rem;">{{$all[0]['dolCode']}}</p>
    </div>
  </div>
  <div style="margin-top: 9rem; position: absolute; left: 1.5rem;" class="px-4">
    <small class="my-n1">Versión Documento</small>
    <p class="my-n1">{{$all[0]['dolVersion']}}</p>
  </div>
  <div class="py-4" style="margin: 0rem 2rem; margin-top: 14rem;">
    <p>{{$content}}</p>
  </div>
</body>

</html>