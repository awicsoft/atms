@extends('adminmain')



@section('content')

<div class="table-responsive">
                          
                        <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <div style="display: none;" class="panel-btns">
                                            <a data-original-title="Minimize Panel" href="" class="panel-minimize tooltips" data-toggle="tooltip" title=""><i class="fa fa-minus"></i></a>
                                            <a data-original-title="Close Panel" href="" class="panel-close tooltips" data-toggle="tooltip" title=""><i class="fa fa-times"></i></a>
                                        </div><!-- panel-btns -->
                                        <h3 class="panel-title">User Panel</h3>                                      
                                    </div>
                                    <div class="panel-body">
                                       
                                      <table class="table table-bordered mb30">
                                      
                                       <tr><th width="100px">ID : </th> <th>{{$user->ID}}</th></tr>
                                       <tr><th width="100px">Username : </th> <th>{{$user->username}}</th></tr>
                                       <tr><th width="100px">Name: </th><th>{{$user->name}}</th></tr>
                                       <tr><th width="100px">Email : </th> <th>{{$user->email}}</th></tr>
                                       <tr><th width="100px">Category ID : </th> <th>{{$user->category_ID}}</th></tr>
                                       <tr><th width="100px">Line1 : </th> <th>{{$address->line1}}</th></tr>
                                       <tr><th width="100px">Line2 : </th> <th>{{$address->line2}}</th></tr>
                                       <tr><th width="100px">city : </th> <th>{{$address->city}}</th></tr>
                                       <tr><th width="100px">country : </th> <th>{{$address->country}}</th></tr>
                                       <tr><th width="100px">zipcode : </th> <th>{{$address->zipcode}}</th></tr>
                                      
                                      </table>


                                    </div><!-- panel-body -->
                                </div>

         


@stop


@section('modals')
@stop