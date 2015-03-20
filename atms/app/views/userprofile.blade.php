@extends('usermain')



@section('content')
      
 <div class="contentpanel">
                        
                        <!-- CONTENT GOES HERE -->    
                        <?php if(@$message!="") {?>
                       <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <strong>{{@$message}}</strong> 
                                </div>
                       <?php }?> 
                                 <div class="row">
                            <form action="updatePersonal" method="post">

                            <div class="" ="col-sm-6">
                                <div class="input-group mb15">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input name="name" value="{{$user->name}}" class="form-control"  placeholder="Enter your Full Name" type="text">
                                </div><!-- input-group -->
                            <div class="input-group mb15">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input name="email" value="{{$user->email}}" class="form-control" placeholder="Enter your Email" type="text">
                                </div>
                            <div class="clearfix">
                            
                            <div class="">
                                <button name="up" type="submit" class="btn btn-success">Update Personal Information <i class="fa fa-angle-right ml5"></i></button>
                            </div>
                        </div>
                        </form>
                        <form action="updateAddress" method="post">
                            <address>
                                 <h5><i class="fa fa-home"></i><b> Address </b> </h5>
                                    <div class="input-group mb15">
                                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                    <input  name="line1" value="{{$address->line1}}" class="form-control" placeholder="Address Line 1" type="text">
                                </div>
                                
                               
                                
                                <div class="input-group mb15">
                                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                    <input name="line2" value="{{$address->line2}}" class="form-control" placeholder="Address Line 2" type="text">
                                </div>
                                
                                <div class="input-group mb15">
                                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                    <input name="city" value="{{$address->city}}" class="form-control" placeholder="City " type="text">
                                
                                </div>
                                <div class="input-group mb15">
                                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                    <input name="country" value="{{$address->country}}" class="form-control" placeholder="Country " type="text">
                                
                                </div>
                                <div class="input-group mb15">
                                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                    <input name="zipcode" value="{{$address->zipcode}}" class="form-control" placeholder="Zip Code" type="text">
                                
                                </div>
                        <div class="clearfix">
                            
                            <div class="">
                                <button name="ua" type="submit" class="btn btn-success">Update Your Address <i class="fa fa-angle-right ml5"></i></button>
                            </div>
                        </div>        
                        </form>
                                </address>
                             <h5><i class="glyphicon glyphicon-eye-open"></i><b> Security </b> </h5>
                              <form method="post" action="updatePassword" >
                        <div class="row">
                            
                            <div class="col-sm-6">
                                <div class="input-group mb15">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input name="cpassword" class="form-control" placeholder="Enter Current password" type="text">
                                </div><!-- input-group -->
                            </div> 
                            
                        
                            
                          
                        </div>
                        <div class="row">
                          
                            <div class="col-sm-6">
                                <div class="input-group mb15">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-repeat"></i></span>
                                    <input name="npassword" class="form-control" placeholder="Enter New password" type="text">
                                </div><!-- input-group -->
                            </div> 
                            
                        
                            
                          
                        </div>
                        <!-- row -->
                       
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-group mb15">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-repeat"></i></span>
                                    <input name="rpassword" class="form-control" placeholder="Re-Enter new Password" type="Password">
                                </div><!-- input-group -->
                            </div>
                            
                            
                        </div><!-- row -->
                        
                        <div class="clearfix">
                            
                            <div class="">
                                <button name="upw" type="submit" class="btn btn-success">Update Password <i class="fa fa-angle-right ml5"></i></button>
                            </div>
                            </form>
                        </div>
                   
                            </div> 
                            
                            
                            
                                 <div class="row">
                            
                            <div class="col-sm-6">
                                <!-- input-group -->
                                
                                
                            </div> 
                            
                            <br>
                            
                            
                      
                          
                        </div>

@stop