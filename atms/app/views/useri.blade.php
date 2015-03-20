@extends('useri1')

@section('stats')
       <div class="col-md-4">
                                <div class="panel panel-success-alt noborder">
                                    <div class="panel-heading noborder">
                                        <div style="display: none;" class="panel-btns">
                                            <a data-original-title="Close Panel" href="" class="panel-close tooltips" data-toggle="tooltip" title=""><i class="fa fa-times"></i></a>
                                        </div><!-- panel-btns -->
                                        <div class="panel-icon"><i class="fa fa-dollar"></i></div>
                                        <div class="media-body">
                                            <h5 class="md-title nomargin">Today's Earnings</h5>
                                            <h1 class="mt5">${{round($todayEarning,5)}}</h1>
                                        </div><!-- media-body -->
                                        <hr>
                                        <div class="clearfix mt20">
                                            <div class="pull-left">
                                                <h5 class="md-title nomargin">Yesterday</h5>
                                                <h4 class="nomargin">${{round($yesterdayEarning,5)}}</h4>
                                            </div>
                                            <div class="pull-right">
                                                <h5 class="md-title nomargin">This Week</h5>
                                                <h4 class="nomargin">${{round($weekEarning,5)}}</h4>
                                            </div>
                                        </div>
                                        
                                    </div><!-- panel-body -->
                                </div><!-- panel -->
                            </div><!-- col-md-4 -->
                            
                            <div class="col-md-4">
                                <div class="panel panel-primary noborder">
                                    <div class="panel-heading noborder">
                                        <div class="panel-btns">
                                            <a data-original-title="Close Panel" href="" class="panel-close tooltips" data-toggle="tooltip" title=""><i class="fa fa-times"></i></a>
                                        </div><!-- panel-btns -->
                                        <div class="panel-icon"><i class="fa fa-users"></i></div>
                                        <div class="media-body">
                                            <h5 class="md-title nomargin">New User Accounts</h5>
                                            <h1 class="mt5">138,102</h1>
                                        </div><!-- media-body -->
                                        <hr>
                                        <div class="clearfix mt20">
                                            <div class="pull-left">
                                                <h5 class="md-title nomargin">Yesterday</h5>
                                                <h4 class="nomargin">10,009</h4>
                                            </div>
                                            <div class="pull-right">
                                                <h5 class="md-title nomargin">This Week</h5>
                                                <h4 class="nomargin">178,222</h4>
                                            </div>
                                        </div>
                                        
                                    </div><!-- panel-body -->
                                </div><!-- panel -->
                            </div><!-- col-md-4 -->
                            
                            <div class="col-md-4">
                                <div class="panel panel-dark noborder">
                                    <div class="panel-heading noborder">
                                        <div style="display: none;" class="panel-btns">
                                            <a data-original-title="Close Panel" href="" class="panel-close tooltips" data-toggle="tooltip" data-placement="left" title=""><i class="fa fa-times"></i></a>
                                        </div><!-- panel-btns -->
                                        <div class="panel-icon"><i class="fa fa-pencil"></i></div>
                                        <div class="media-body">
                                            <h5 class="md-title nomargin">New User Posts</h5>
                                            <h1 class="mt5">153,900</h1>
                                        </div><!-- media-body -->
                                        <hr>
                                        <div class="clearfix mt20">
                                            <div class="pull-left">
                                                <h5 class="md-title nomargin">Yesterday</h5>
                                                <h4 class="nomargin">144,009</h4>
                                            </div>
                                            <div class="pull-right">
                                                <h5 class="md-title nomargin">This Week</h5>
                                                <h4 class="nomargin">987,212</h4>
                                            </div>
                                        </div>
                                        
                                    </div><!-- panel-body -->
                                </div><!-- panel -->
                            </div><!-- col-md-4 -->

@stop



@section('links')
                       <div class="contentpanel">
                        
                        <!-- CONTENT GOES HERE -->   
                        
                        <div class="contentpanel">
                        
                        <div class="row">
      
         
            <!-- input-group -->
            
            
            
        
        
   <!-- col-sm-4 -->
   <script>
       function categorySelect(){
           
           var e = document.getElementById("category");
var category = e.options[e.selectedIndex].value;
    window.open('index?category='+category,'_self'); 
    
    }
    function forward(){
         var e = document.getElementById("category");
var category = e.options[e.selectedIndex].value;
    window.open('index?category='+category+'&pre={{$pre}}&btn=>','_self'); 
        
    }
    function reverse(){
        
         var e = document.getElementById("category");
var category = e.options[e.selectedIndex].value;
    window.open('index?category='+category+'&pre={{$pre}}&btn=<','_self'); 
        
    }
   
   </script>
            
            <div class="panel panel-dark-head">
                <div class="panel-heading">
                    <h4 class="panel-title"> Category Title</h4>
                  
                    
                    <select ID="category" onchange="categorySelect()" class="btn btn-lg btn-default"> 
                   <option value = ''>ALL</option>
                    @foreach($categorys as $cat)
                   
                    <option <?php
                        if($selected == $cat->ID)
                            echo "selected='selected'";
                            
                        
                    
                    ?> value="{{$cat->ID}}">{{$cat->title}}</option>
                   @endforeach
                    </select>
                    <button name="btn" onclick="reverse()" value="<" class="btn btn-white btn-navi btn-navi-left ml5" type="button"><</button>
                                    
                    <button name="btn" onclick="forward()" value=">" class="btn btn-white btn-navi btn-navi-left ml5" type="button">></button>               
                      <p>About {{$total}} results. Showing out of {{$pre}} - {{$pre+count($links)}}</p>
                    
                </div><!-- panel-heading -->
                <div class="panel-body">
                    
                    <div class="results-list">
                        
                        
                           @foreach($links as $link)
                        <div class="media">
                            <a href="#" class="pull-left">
                              <img alt="" src="{{$link->thumb_url}}" class="media-object thumbnail">
                            </a>
                            <div class="media-body">
                              <h4 class="filename text-primary">{{$link->title}}</h4>
                              Actual LINK<label style='color:green'> {{$link->url}}</label><br>
                              UTM LINK <label style='color:green'> {{$link->url . "?utm_source=linkify.cash&utm_medium=$user->username"}}</label><br>
                             <!-- <button class="btn btn-primary mr5"> GET UTM LINK </button>-->
                            </div>
                        </div>
                       @endforeach
                      
                        
                       
                        
                    </div><!-- results-list -->
                </div><!-- panel-body -->
            <!-- panel -->
            
         
            
        <!-- col-sm-8 -->
      </div><!-- row -->   
                    
                    </div> 
                    
                    
                    </div><!-- contentpanel -->
            
         

@stop