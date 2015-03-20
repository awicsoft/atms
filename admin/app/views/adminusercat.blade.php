@extends('adminmain')



@section('content')




                                <form class="form-horizontal" method="post" >
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div style="display: none;" class="panel-btns">
                                                <a data-original-title="Minimize Panel" href="" class="panel-minimize tooltips" data-toggle="tooltip" title=""><i class="fa fa-minus"></i></a>
                                                <a data-original-title="Close Panel" href="" class="panel-close tooltips" data-toggle="tooltip" title=""><i class="fa fa-times"></i></a>
                                            </div><!-- panel-btns -->
                                            <h4 class="panel-title">USER FORM</h4>
                                           
                                        </div>
                                        <div class="panel-body">
                                           
                                          <div class="form-group">
                                                <label class="col-sm-4 control-label">Title:</label>
                                                <div class="col-sm-8">
                                                    <input name="title" class="form-control" type="text">
                                                </div>
                                            </div>
                                           
                                        </div><!-- panel-body -->
                                        <div class="panel-footer">
                                            <button class="btn btn-primary mr5">Make User Category</button>
                                           
                                        </div><!-- panel-footer -->
                                    </div><!-- panel-default -->
                                </form>
                            
                            <br>

<div class="table-responsive">
                          
                        <div class="pull-right">
                           
                                      

                                       
                                    </div>  
                       <h3> User Catrgory </h3>
                        
                              <table class="table table-bordered mb30">
                                <thead>
                                  <tr>
                                      
                                  
                                  
                                     <th>Title</th>
                                      
                             
                                   
                                  </tr>
                                </thead>
                                <tbody>
                                 @foreach($categorys as $category)   
                                    <tr>
                                    
                                       
                                 
                                         <td>{{$category->title}}</td>

                                      
                                    </tr>
                                @endforeach
                               
                                </tbody>
                              </table>


@stop


