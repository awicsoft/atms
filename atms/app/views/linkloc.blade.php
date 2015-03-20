@extends('adminmain')



@section('content')




                                <form action="locations" class="form-horizontal" method="post" >
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div style="display: none;" class="panel-btns">
                                                <a data-original-title="Minimize Panel" href="" class="panel-minimize tooltips" data-toggle="tooltip" title=""><i class="fa fa-minus"></i></a>
                                                <a data-original-title="Close Panel" href="" class="panel-close tooltips" data-toggle="tooltip" title=""><i class="fa fa-times"></i></a>
                                            </div><!-- panel-btns -->
                                            <h4 class="panel-title">Links Add FORM</h4>
                                           
                                        </div>
                                        <div class="panel-body">
                                          <!-- form-group -->
                                          <div class="form-group">
                                                <label class="col-sm-4 control-label">Country:</label>
                                                <div class="col-sm-8">
                                                    <input name="country" class="form-control" type="text">
                                                </div>
                                            </div>
                                            
                                        </div><!-- panel-body -->
                                        <div class="panel-footer">
                                          
                                            <button type="submit" class="btn btn-primary mr5">Add</button>
                                           
                                        </div><!-- panel-footer -->
                                    </div><!-- panel-default -->
                                </form>
                            
                            <br>

<div class="table-responsive">
                          
                        <div class="pull-right">
                           
                                      

                                        <form >
                          

                                          

                                            <input action="locations" type="hidden" name="pre" value="{{{$pre or '0'}}}" />
                                      
                                        Showing {{{$pre or '0'}}} - {{$pre+2}} of {{$total}} Results
                                        <input name="btn" value="<" type="submit" class="btn btn-white btn-navi btn-navi-left ml5" type="button">
                                    
                                   
                                        <input name="btn" value=">" type="submit" class="btn btn-white btn-navi btn-navi-left ml5" type="button">
                                     </form>    
                                    </div>  
                       <h3> Links </h3>
                        
                              <table class="table table-bordered mb30">
                                <thead>
                                  <tr>
                                    
                                    <th>Location</th>
                                   
                                   
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach($locations as $location)
                                 <tr>
                                    
                                     
                                    <th>{{$location->country}}</th>
                                 
                                    <th>
                                      <form method="post" action="deleteLoc">
                                        <input type="hidden" name="ID" value="{{$location->ID}}" />
                                        <button type="submit">DELETE</button>
                                      </form>

                                    </th>
                                  </tr>

                               @endforeach
                                </tbody>
                              </table>


@stop


