


@extends('adminmain')



@section('content')


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
function loadXMLDoc()
{

   document.getElementById("mythumb").value="asdasd";

var url = "http://img.linkify.cash/shot.php?url=google.com&w=300&h=100";
 $.get(url,function(data,status){


 alert("ss");

    alert("Data: " + data + "\nStatus: " + status);
  });
}

</script>




                                <form class="form-horizontal" method="post" >
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div style="display: none;" class="panel-btns">
                                                <a data-original-title="Minimize Panel" href="" class="panel-minimize tooltips maximize" data-toggle="tooltip" title=""><i class="fa fa-minus"></i></a>
                                                <a data-original-title="Close Panel" href="" class="panel-close tooltips" data-toggle="tooltip" title=""><i class="fa fa-times"></i></a>
                                            </div><!-- panel-btns -->
                                            <h4 class="panel-title">Manual Link Add FORM</h4>
                                           
                                        </div>
                                        <div class="panel-body">
                                          <!-- form-group -->
                                        
                                        
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">url:</label>
                                                <div class="col-sm-8">
                                                    <input name="url" class="form-control" type="text">
                                                </div>
                                            </div>
                                           
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Category:</label>
                                                <div class="col-sm-8">
                                                  <select name="category" class="form-control">
                                                      @foreach($categorys as $category)
                                                        <option  value="{{$category->ID}}">{{$category->title}}</option>
                                                      @endforeach

                                                  </select>
                                                </div>
                                            </div><!-- form-group -->
                                        </div><!-- panel-body -->
                                        <div class="panel-footer">
                                        
                                           
                                            <button type="submit" class="btn btn-primary mr5">Add</button>
                                           
                                        </div><!-- panel-footer -->
                                    </div><!-- panel-default -->
                                </form>
                                <form action="autoAddLinks" method="post">
                              <button type="submit" name="auto" class="btn btn-primary mr5" >Auto Add Link</button>
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
                       <h3> Links </h3>
                        
                              <table class="table table-bordered mb30">
                                <thead>
                                  <tr>
                                    
                                    <th>thumb</th>
                                   
                                     
                                    <th>Title</th>
                                 
                                    
                                    <th>Category</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                              @foreach($links as $link)
                                 <tr>
                                    
                                    <th><img src="{{$link->thumb_url}}" width="100px" height="100px" /></th>
                                   
                                     
                                    <th>{{$link->title}}</th>
                                 
                                   
                                    <th>{{$link->category_ID->title}}</th>
                                    <th>
                                      <form action="deleteLink">
                                        <input type="hidden" name="ID" value="{{$link->ID}}" />
                                        <button type="submit">DELETE</button>
                                      </form>

                                    </th>
                                  </tr>
                                  @endforeach
                               
                                </tbody>
                              </table>


@stop


