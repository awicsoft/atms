@extends('usermain')



@section('content')
 <div class="contentpanel">
                        
                        <!-- CONTENT GOES HERE -->   
                        
            
                            
                            <div class="col-sm-9 col-md-9 col-lg-10">
                                
                                <!-- msg-header -->
                                
                                <ul class="media-list msg-list">
                                    @foreach($notifications as $notification)
                                    <li class="media unread">
                                       
                                        <a class="pull-left" href="viewNotification?ID={{$notification->ID}}">
                                            <img class="media-object img-circle img-online" src="images/photos/user1.png" alt="...">
                                         </a>
                                        <div class="media-body">
                                            <div class="pull-right media-option">
                                                
                                                <small>{{$notification->timestamp}}</small>
                                                
                                                <div class="btn-group">
                                                    <a class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                       
                                                    </a>
                                                    
                                                </div>
                                            </div>
                                            <h4 class="sender">Admin Notification</h4>
                                            <p><a href="viewNotification?ID={{$notification->ID}}"><strong class="subject">{{$notification->title}}</strong>{{$notification->details}}</a></p>
                                        </div>
                                           
                                    </li>
                                    @endforeach
                                 
                                    
                                      <li class="media unread">
                                       
                                        <a class="pull-left" href="#">
                                            <img class="media-object img-circle img-online" src="images/photos/user1.png" alt="...">
                                        </a>
                                        <div class="media-body">
                                            <div class="pull-right media-option">
                                                
                                                <small>Yesterday 5:51am</small>
                                                
                                                <div class="btn-group">
                                                    <a class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                       
                                                    </a>
                                                    
                                                </div>
                                            </div>
                                            <h4 class="sender">Renov Leonga</h4>
                                            <p><a href="view_message.html"><strong class="subject">Hi Hello!</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</a></p>
                                        </div>
                                    </li>
                                    
                                    
                                </ul>
                            </div>
                        </div>
                    </div> 
@stop
