@extends('adminmain')



@section('content')

<?php if(@$message!="") {?>
                       <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <strong>{{@$message}}</strong> 
                                </div>
                       <?php }?> 
          <h5><i class="glyphicon glyphicon-eye-open"></i><b> Security </b> </h5>
                              <form method="post" action="profile" >
                        <div class="row">
                            
                            <div class="col-sm-6">
                                <div class="input-group mb15">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input name="cpassword" class="form-control" placeholder="Enter Current password" type="Password">
                                </div><!-- input-group -->
                            </div> 
                            
                        
                            
                          
                        </div>
                        <div class="row">
                          
                            <div class="col-sm-6">
                                <div class="input-group mb15">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-repeat"></i></span>
                                    <input name="npassword" class="form-control" placeholder="Enter New password" type="Password">
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

@stop


