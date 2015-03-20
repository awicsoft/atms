<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>@yield('pageTitle')</title>

        <link href="../css/style.default.css" rel="stylesheet">
   <link href="../css/morris.css" rel="stylesheet">
        <link href="../css/select2.css" rel="stylesheet" />

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        
         @yield('header')
        
        <section>
            <div class="mainwrapper">
                <!-- leftpanel -->
                
                
                
                
                @yield('leftpanel')
                
                
                
                
                
                
               <!-- leftpanel -->
                
                
                <div class="mainpanel">
                    
                    
                    <div class="contentpanel">
                        
                        <!-- CONTENT GOES HERE -->    
                    @yield('content')
                    </div><!-- contentpanel -->
                    
                </div>
            </div><!-- mainwrapper -->
        </section>
@yield('modals')

        <script src="../js/jquery-1.11.1.min.js"></script>
        <script src="../js/jquery-migrate-1.2.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/modernizr.min.js"></script>
        <script src="../js/pace.min.js"></script>
        <script src="../js/retina.min.js"></script>
        <script src="../js/jquery.cookies.js"></script>
        
        <script src="../js/flot/jquery.flot.min.js"></script>
        <script src="../js/flot/jquery.flot.resize.min.js"></script>
        <script src="../js/flot/jquery.flot.spline.min.js"></script>
        <script src="../js/jquery.sparkline.min.js"></script>
        <script src="../js/morris.min.js"></script>
        <script src="../js/raphael-2.1.0.min.js"></script>
        <script src="../js/bootstrap-wizard.min.js"></script>
        <script src="../js/select2.min.js"></script>

        <script src="../js/custom.js"></script>
        <script src="../js/dashboard.js"></script>


    </body>
</html>
