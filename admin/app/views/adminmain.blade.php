@extends('template.atms.layout1')
@section('pageTitle')
	Affiliate Links Management System
@stop
@section('header')
<header>
            <div class="headerwrapper">
                <div class="header-left">
                    <a href="index" class="logo">
                        <img src="images/logo.png" alt="" /> 
                    </a>
                    <div class="pull-right">
                        <a href="" class="menu-collapse">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                </div><!-- header-left -->
                
                <div class="header-right">
                    
                    <div class="pull-right">
                        
                   
                        
                        
                        <!-- btn-group -->
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        <div class="btn-group btn-group-list btn-group-notification ">
                            
                            <!-- dropdown-menu -->
                        </div>
                        
                        <div class="btn-group btn-group-option">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-caret-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                              <li><a href="profile"><i class="glyphicon glyphicon-user"></i> My Profile</a></li>
                              <li><a href="#"><i class="glyphicon glyphicon-question-sign"></i> Help</a></li>
                              <li class="divider"></li>
                              <li><a href="logout"><i class="glyphicon glyphicon-log-out"></i>Sign Out</a></li>
                            </ul>
                        </div><!-- btn-group -->
                        
                    </div><!-- pull-right -->
                    
                </div><!-- header-right -->
                
            </div><!-- headerwrapper -->
        </header>
@stop


@section('leftpanel')
<div class="leftpanel">
                    <div class="media profile-left">
                        
                        <div class="media-body">
                            <h4 class="media-heading">Admin</h4>
                            
                        </div>
                    </div><!-- media -->
                    
                    
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="index"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                        <li class="parent \">
                            <a href = '#' ><i class="fa fa-file-text"></i> <span>Users</span></a>
                            <ul style="display: none;" class="children">
                                <li><a href="{{URL::to('/')}}/users">View All</a></li>

                                <li><a href="{{URL::to('/')}}/adminusercat">Category</a></li>
                               <li><a href="{{URL::to('/')}}/adminrates">Make Rates</a></li>
                               
                                
                               
                                
                            </ul>
                        </li>
                         <li class="parent "><a href=""><i class="fa fa-file-text"></i> <span>Links</span></a>
                            <ul style="display: none;" class="children">
                                <li><a href="{{URL::to('/')}}/links">View All</a></li>

                                <li><a href="{{URL::to('/')}}/linkcat">Category</a></li>
                               <li><a href="{{URL::to('/')}}/locations">Locations</a></li>
                               
                                
                               
                                
                            </ul>
                        </li>
                         <li><a href="stats"><i class="glyphicon glyphicon-eye-open"></i> <span>Stats</span></a></li>
                        <li><a href="{{URL::to('/')}}/sendNotification"><i class="fa fa-file-text"></i> <span>Notification</span></a></li>
                        
                        
                          
    
                        
                        
                        
                    
                        
                        
                        <li><a href="profile"><i class="glyphicon glyphicon-user"></i><span>Profile</span></a></li>
                      
                        <li><a href="logout"><i class="glyphicon glyphicon-log-out"></i> <span>Logout</span></a></li>
                       
                        
                    </ul>
                    
                </div>
@stop
