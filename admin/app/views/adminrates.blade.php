@extends('adminmain')



@section('content')




                                <form class="form-horizontal" method="post" >
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div style="display: none;" class="panel-btns">
                                                <a data-original-title="Minimize Panel" href="" class="panel-minimize tooltips" data-toggle="tooltip" title=""><i class="fa fa-minus"></i></a>
                                                <a data-original-title="Close Panel" href="" class="panel-close tooltips" data-toggle="tooltip" title=""><i class="fa fa-times"></i></a>
                                            </div><!-- panel-btns -->
                                            <h4 class="panel-title">Rates FORM</h4>
                                           
                                        </div>
                                        <div class="panel-body">
                                           <div class="form-group">
                                                <label class="col-sm-4 control-label">User Category:</label>
                                                <div class="col-sm-8">
                                                  <select name="category">
                                                    @foreach($categorys as $category)
                                                    <option value="{{$category->ID}}" >{{$category->title}}</option>
                                                    @endforeach
                                                  </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Link Location:</label>
                                                <div class="col-sm-8">
                                                  <select name="location">
                                                      @foreach($locations as $location)
                                                       <option value="{{$location->ID}}" >{{$location->country}}</option>
                                                      @endforeach
                                                  </select>

                                                </div>
                                            </div>

                                          <div class="form-group">
                                                <label class="col-sm-4 control-label">Rate:</label>
                                                <div class="col-sm-8">
                                                    <input name="rate" class="form-control" type="text">
                                                </div>
                                            </div>
                                           
                                        </div><!-- panel-body -->
                                        <div class="panel-footer">
                                            <button class="btn btn-primary mr5">Add Rate</button>
                                           
                                        </div><!-- panel-footer -->
                                    </div><!-- panel-default -->
                                </form>
                            
                            <br>
                              <form class="form-horizontal" method="post" action='adsenserate' >
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div style="display: none;" class="panel-btns">
                                                <a data-original-title="Minimize Panel" href="" class="panel-minimize tooltips" data-toggle="tooltip" title=""><i class="fa fa-minus"></i></a>
                                                <a data-original-title="Close Panel" href="" class="panel-close tooltips" data-toggle="tooltip" title=""><i class="fa fa-times"></i></a>
                                            </div><!-- panel-btns -->
                                            <h4 class="panel-title">Adsense Parterner User Rate FORM</h4>
                                           
                                        </div>
                                        <div class="panel-body">
                                           <div class="form-group">
                                                <label class="col-sm-4 control-label">User Category:</label>
                                                <div class="col-sm-8">
                                                  Adsense
                                                
                                                </div>
                                            </div>

                                           

                                          <div class="form-group">
                                                <label class="col-sm-4 control-label">Percentage Rate:</label>
                                                <div class="col-sm-8">
                                                    <input name="rate" class="form-control" value='{{$adsenseRate}}' type="text">
                                                </div>
                                            </div>
                                           
                                        </div><!-- panel-body -->
                                        <div class="panel-footer">
                                            <button class="btn btn-primary mr5">Update Rate</button>
                                           
                                        </div><!-- panel-footer -->
                                    </div><!-- panel-default -->
                                </form>
 <br>
<div class="table-responsive">
                          
                        <div class="pull-right">
                           
                                      

                                       
                                    </div>  
                       <h3> Rates</h3>
                        
                              <table class="table table-bordered mb30">
                                <thead>
                                  <tr>
                                      
                                  
                                  
                                     <th>ID</th>
                                     <th>User Category</th> 
                             
                                      <th>Location</th> 

                                      <th>Rate</th> 
                             
                                  </tr>
                                </thead>
                                <tbody>
                                 @foreach($rates as $rate)   
                                    <tr>
                                    
                                       
                                 
                                        <td>{{$rate->ID}}</td>
                                        <td>{{$rate->user_category_ID->title}}</td>
                                        <td>{{$rate->link_loc_ID->country}}</td>
                                          <td>{{$rate->rate}}</td>
                                      
                                    </tr>
                                @endforeach
                               
                                </tbody>
                              </table>


@stop

