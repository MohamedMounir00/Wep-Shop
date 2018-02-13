<!DOCTYPE html>
<html>
<head>
    <title>Default page | Bootstrap 3.x Admin Theme</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    {{ Html::style('adminstyle/css/bootstrap.min.css') }}
    {{ Html::style('adminstyle/css/bootstrap-theme.min.css') }}
    {{ Html::style('adminstyle/css/bootstrap-admin-theme.css') }}
    {{ Html::style('adminstyle/css/bootstrap-admin-theme-change-size.css') }}


    <!-- Vendors -->
    <!-- (...) -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
       {{ Html::script('adminstyle/js/html5shiv.js') }}

        {{ Html::script('adminstyle/js/respond.min.js') }}
        <![endif]-->



    </head>
    <body class="bootstrap-admin-with-small-navbar " style="text-align: right; direction: rtl; ">
        <!-- small navbar -->
        <nav class="navbar navbar-default navbar-fixed-top bootstrap-admin-navbar-sm" role="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="collapse navbar-collapse">

                            <ul class="nav navbar-nav navbar-left">

                                <li>
                                    <a href="#">Reminders <i class="glyphicon glyphicon-bell"></i></a>
                                </li>
                                <li>
                                    <a href="#">Settings <i class="glyphicon glyphicon-cog"></i></a>
                                </li>
                                <li>
                                    <a href="{{ url('/') }}">الرئيسيه<i class="glyphicon glyphicon-share-alt"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" role="button" class="dropdown-toggle" data-hover="dropdown"> <i class="glyphicon glyphicon-user"></i> {{ Auth::user()->name }} <i class="caret"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ url('admin/user/'.Auth::user()->id.'/edit') }}">تعديل العضويه</a></li>
                                        <li><a href="{{ url('logout') }}">تسجيل خروج</a></li>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- main / large navbar -->
        <nav class="navbar navbar-default navbar-fixed-top bootstrap-admin-navbar bootstrap-admin-navbar-under-small" role="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="navbar-header pull-right">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".main-navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="{{ url('/admin') }}">لوحه التحكم</a>
                        </div>
                        <div class="collapse navbar-collapse main-navbar-collapse pull-right">
                            <ul class="nav navbar-nav">

                            
                            <li >
                                <a href="{{ url('/admin/user') }}">
                                   الاعضاء</a>
                               </li>
                               <li >
                                <a href="{{ url('/admin/services/0') }}">
                                    خدمات منتظره 

                                    <label for="" class="label label-default">

                                        {{$service=\App\Service::where('status',0)->count()}}
                                    </label>


                                </a>
                            </li>
                            <li >
                                <a href="{{ url('/admin/profits/0') }}">
                                    ارباح منتظره ارسال
                                    <label for="" class="label label-default">

                                        {{ $profits=\App\Profit::where('status',0)->count()}}
                                    </label>


                                </a>
                            </li>
                            <li >
                                <a href="{{ url('/admin/getToDayOrderProfits/0') }}">
                                 ارباح اليوم المنتظره


                                 <label for="" class="label label-default">

                                   {{ $profitDateWaitig =\App\Profit::where('created_at' , '>' , $timenow.' 00:00:00')->where('created_at' , '<' , $timenow. ' 23:59:59')->where('status',0)->count() }}

                                   
                               </label>


                           </a>
                       </li>
                       <li >
                        <a href="{{ url('/admin/getToDayOrderProfits/1') }}">
                         ارباح اليوم المرسله


                         <label for="" class="label label-default">

                           {{ $profitDateDone =\App\Profit::where('created_at' , '>' , $timenow.' 00:00:00')->where('created_at' , '<' , $timenow. ' 23:59:59')->where('status',1)->count() }}


                       </label>


                   </a>
               </li>
               <li >
                <a href="{{ url('/admin/services') }}">
                الخدمات</a>
            </li>
            <li >
                <a href="{{ url('/admin/orders') }}">
                 الطلبات</a>
            </li>

            <li >
                <a href="{{ url('/admin/profits') }}">
                 طلبات سحب الارباح</a>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
</div>
</div>
</div><!-- /.container -->
</nav>

<div class="container">
    <!-- left, vertical navbar & content -->
    <div class="row">
        <!-- left, vertical navbar -->
        <div class="col-md-2 bootstrap-admin-col-left pull-right">
            <ul class="nav navbar-collapse collapse bootstrap-admin-navbar-side">


            <li >
                <a href="{{ url('/admin/user') }}">
                    <i class="glyphicon glyphicon-chevron-left pull-left"></i> الاعضاء</a>
                </li>
                <li >
                    <a href="{{ url('/admin/services/0') }}">
                        <i class="glyphicon glyphicon-chevron-left pull-left"></i>
                        خدمات منتظره 
                        <label for="" class="label label-default">

                            {{$service}}
                        </label>


                    </a>
                </li>
                <li >
                    <a href="{{ url('/admin/profits/0') }}">
                        <i class="glyphicon glyphicon-chevron-left pull-left"></i>

                        ارباح منتظره ارسال
                        <label for="" class="label label-default">

                            {{$profits}}
                        </label>


                    </a>
                </li>
                <li >
                    <a href="{{ url('/admin/getToDayOrderProfits/0') }}">
                     ارباح اليوم المنتظره


                     <label for="" class="label label-default">

                       {{ $profitDateWaitig }}



                   </label>
                   <i class="glyphicon glyphicon-chevron-left pull-left"></i>


               </a>
           </li>
           <li >
            <a href="{{ url('/admin/getToDayOrderProfits/1') }}">
             ارباح اليوم المرسله


             <label for="" class="label label-default">

               {{ $profitDateDone }}


           </label>
           <i class="glyphicon glyphicon-chevron-left pull-left"></i>


       </a>
   </li>

   <li >
    <a href="{{ url('/admin/services') }}">
        <i class="glyphicon glyphicon-chevron-left pull-left"></i> الخدمات</a>
    </li>
    <li >
        <a href="{{ url('/admin/orders') }}">
            <i class="glyphicon glyphicon-chevron-left pull-left"></i> الطلبات</a>
        </li>
        <li >
            <a href="{{ url('/admin/profits') }}">
                <i class="glyphicon glyphicon-chevron-left pull-left"></i>  طلبات سحب الارباح</a>
            </li>



        </ul>
    </div>

    <!-- content -->
    <div class="col-md-10 pull-left">
     @yield('content')
 </div>
</div>
</div>

<!-- footer -->
<div class="navbar navbar-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <footer role="contentinfo">
                    <p class="left">Mohamed Mounir</p>
                    <p class="right">&copy; 2017 <a href="" target="_blank">Mohamed Mounir</a></p>
                </footer>
            </div>
        </div>
    </div>
</div>


{{ Html::script('adminstyle/js/jquery-2.0.3.min.js') }}
{{ Html::script('adminstyle/js/bootstrap.min.js') }}
{{ Html::script('adminstyle/js/twitter-bootstrap-hover-dropdown.min.js') }}
{{ Html::script('adminstyle/js/bootstrap-admin-theme-change-size.js') }}

</body>
</html>
