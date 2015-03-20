@extends('main')

@section('content')
<section>
            
            <div class="panel panel-signin">
                <div class="panel-body">
                    <div class="logo text-center">
                        <img src="images/logo-primary.png" alt="Chain Logo" >
                    </div>
                    <br />
                    <h4 class="text-center mb5">Forget Your Passowd?</h4>
                    <p class="text-center">Just Tell Us Your Email We will recover it</p>
                     <p class='text-center' style="color:red;">{{{  $message or '' }}}</p>
                    <div class="mb30"></div>
                    
                    <form action="recoverPassword" method="post">
                        <div class="input-group mb15">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input name="email" type="email" value="{{@$email}}" class="form-control" placeholder="Enter Email Address">
                        </div><!-- input-group -->
                        <!-- input-group -->
                        
                        <div class="clearfix">
                            <div class="pull-left">
                                
                            </div>
                           
                            <div class="pull-right">
                                <button type="submit" class="btn btn-success">Recover My password <i class="fa fa-angle-right ml5"></i></button>
                            </div>
                        </div>                      
                    </form>
                    
                </div><!-- panel-body -->
                <div class="panel-footer">
                    <a href="register" class="btn btn-primary btn-block">Not yet a Member? Create Account Now</a>
                </div><!-- panel-footer -->
            </div><!-- panel -->
            
        </section>


@stop