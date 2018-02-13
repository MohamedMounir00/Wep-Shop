  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    {{ Html::style('/css/style.css') }}
    <meta id="_token" value="{{ csrf_token() }}">



</head>
<body id="app-layout" style="direction:rtl; text-align: right;" >


  <nav class="navbar navbar-inverse navbar-static-top">
  <div class="container  ">
    <div class="navbar-header pull-right">
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand pull-right"  href="{{url('/#!')}}">SHOPS</a>

         <form class="navbar-form navbar-right" style="padding-right:50px" >
             
      
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="بحث">
                    </div>
                    <button type="submit" class="btn btn-info">بحث</button>
                </form>
    </div>
    
    <div class="collapse navbar-collapse js-navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
           
            <li class="dropdown mega-dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <i class="fa fa-folder"></i>
                الاقسام <span class="caret"></span></a>                
                <ul class="dropdown-menu mega-dropdown-menu">
                @foreach(\App\Cat::get(['name','id']) as $c)
                 <li class="col-sm-3 pull-right">
                 <ul class="text-right">
                   
                 <li>
                 <a href="{{url('/')}}#!/Cat/{{ $c->id }}/{{ $c->name }}" >
                 {{ $c->name }}</a>
                 </li>
                    
                </ul>
                 </li>
                @endforeach
                
                    </ul>
                    </li>
                </ul>       
            
                
             
                
                      
                 <ul class="nav navbar-nav navbar-left">
  


                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">تسجيل الدخول</a></li> 
                    <li><a href="{{ url('/register') }}">تسجيل عضويه جديده</a></li>
               

                @endif



   

         </ul>  
    </div>
    </div>
  </nav>



@yield('content')

{{ Html::script('/js/main.js') }}
{{ Html::script('/js/app.js') }}


</body>
</html>