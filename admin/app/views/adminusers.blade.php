@extends('adminmain')



@section('content')

<div class="table-responsive">
                          
                        <div class="pull-right">
                           
                                      

                                        <form action="users">
                          

                                          <select class="btn btn-xs btn-primary"  role="menu" name="category">
                                          <option value="0">All</option>
                                          @foreach($categorys as $category)
                                             <option class="" <?php if($categoryID == $category->ID) echo "selected=''"; ?> value="{{$category->ID}}">{{$category->title}}</option>
                                          @endforeach   
                                      
                                          <input name="btn" value="filter" type="submit" class="btn btn-white btn-navi btn-navi-left ml5" type="button">
                                    
                                          </select>

                                            <input type="hidden" name="pre" value="{{{$pre or '0'}}}" />
                                      
                                        Showing {{{$pre or '0'}}} - {{$pre+2}} of {{$total}} Results
                                        <input name="btn" value="<" type="submit" class="btn btn-white btn-navi btn-navi-left ml5" type="button">
                                    
                                   
                                        <input name="btn" value=">" type="submit" class="btn btn-white btn-navi btn-navi-left ml5" type="button">
                                     </form>    
                                    </div>  
                       <h3> Users </h3>
                        
                              <table class="table table-bordered mb30">
                                <thead>
                                  <tr>
                                       <th>Category</th>
                                    <th>username</th>
                                   
                                  
                                     <th>Stats</th>
                                      
                                    <th>HOLD/UNHOLD</th>
                                    <th>Unable/Disable</th>
                                    <th>Notification</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                  <tr 

                                  <?php if(!$user->enable) { ?>
                                    style="background:red;"
                                    <?php }?>

                                  >
                                      <td>{{$user->category_ID}}</td>
                                    <td><a href="{{URL::to('/')}}/viewUser?userID={{$user->ID}}">{{$user->username}}</a></td>
                                    
                                    
                                    <td><a href="{{URL::to('/')}}/viewStat?userID={{$user->ID}}">view</a></td>
                                    

                                    <td>
                                    <?php if(!$user->hold) {?>  

                                    <form action="{{URL::to('/')}}/holduser?pre={{$pre}}" method="post">
                                          <input name="ID" type="hidden" value="{{$user->ID}}" />
                                          <button type="submit" class="btn btn-danger">hold</button>
                                    </form>      
                                    <?php }else{ ?>  

                                    <form action="{{URL::to('/')}}/unholduser?pre={{$pre}}" method="post">
                                          <input name="ID" type="hidden" value="{{$user->ID}}" />
                                          <button type="submit" class="btn btn-danger">Unhold</button>
                                    </form> 

                                    <?php  } ?>
                                    </td>


                                    <td>
                                       <?php if(!$user->enable) {?> 
                                         <form action="{{URL::to('/')}}/enableuser?pre={{$pre}}" method="post">
                                            <input name="ID" type="hidden" value="{{$user->ID}}" />
                                            <button class="btn btn-warning">Enable</button>
                                      </form>
                                     <?php }else{ ?> 
                                      <form action="{{URL::to('/')}}/disableuser?pre={{$pre}}" method="post">
                                           <input name="ID" type="hidden" value="{{$user->ID}}" />
                                            <button class="btn btn-warning">Disable</button>
                                      </form>
                                        <?php  } ?>
                                    </td>
                                    <td><a  href="{{URL::to('/')}}/sendNotification?userID={{$user->ID}}" class="btn btn-warning">Send</a></td>
                                  

                                    
                                  </tr>
                                 @endforeach 
                                     
                             
                                
                           
                               
                                </tbody>
                              </table>


@stop


