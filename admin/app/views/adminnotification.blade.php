@extends('adminmain')



@section('content')




                                <form class="form-horizontal" method="post" >
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div style="display: none;" class="panel-btns">
                                                <a data-original-title="Minimize Panel" href="" class="panel-minimize tooltips" data-toggle="tooltip" title=""><i class="fa fa-minus"></i></a>
                                                <a data-original-title="Close Panel" href="" class="panel-close tooltips" data-toggle="tooltip" title=""><i class="fa fa-times"></i></a>
                                            </div><!-- panel-btns -->
                                            <h4 class="panel-title">NOTIFICATION SEND FORM</h4>
                                           
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">User ID:</label>
                                                <div class="col-sm-8">
                                                    <input value="{{$userID}}" name="userID" class="form-control" type="text">
                                                </div>
                                            </div><!-- form-group -->
                                          <div class="form-group">
                                                <label class="col-sm-4 control-label">Title:</label>
                                                <div class="col-sm-8">
                                                    <input name="title" class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">NOTIFICATION:</label>
                                                <div class="col-sm-8">
                                                    <input name="details" class="form-control" type="text">
                                                </div>
                                            </div><!-- form-group -->
                                        </div><!-- panel-body -->
                                        <div class="panel-footer">
                                            <button class="btn btn-primary mr5">SEND NOTIFICATION</button>
                                           
                                        </div><!-- panel-footer -->
                                    </div><!-- panel-default -->
                                </form>
                            
                            <br>

<div class="table-responsive">
                          
                        <div class="pull-right">
                           
                                      

                                        <form >
                          

                                          

                                            <input type="hidden" name="pre" value="{{{$pre or '0'}}}" />
                                      
                                        Showing {{{$pre or '0'}}} - {{$pre+2}} of {{$total}} Results
                                        <input name="btn" value="<" type="submit" class="btn btn-white btn-navi btn-navi-left ml5" type="button">
                                    
                                   
                                        <input name="btn" value=">" type="submit" class="btn btn-white btn-navi btn-navi-left ml5" type="button">
                                     </form>    
                                    </div>  
                       <h3> Notifications </h3>
                        
                              <table class="table table-bordered mb30">
                                <thead>
                                  <tr>
                                      
                                    <th>Username</th>
                                   
                                  
                                     <th>Title</th>
                                      
                                    <th>Notification</th>
                                   <th>Date - Time</th>
                                   
                                  </tr>
                                </thead>
                                <tbody>
                                 @foreach($notifications as $notification)   
                                    <tr>
                                    
                                         <td>{{$notification->userID}}</td>
                                 
                                         <td>{{$notification->title}}</td>

                                         <td>{{$notification->details}}</td>
                                         <td>{{$notification->timestamp}}</td>
                                    </tr>
                                @endforeach
                               
                                </tbody>
                              </table>


@stop


