@extends('usermain')



@section('content')
<style>
    .foo {   
    float: left;
    width: 20px;
    height: 20px;
    margin: 5px;
    border-width: 1px;
    border-style: solid;
    border-color: rgba(0,0,0,.2);
}
.text{
    
     padding-top: 4px;
   
}
</style>
                    <!-- pageheader -->
                  
                    <div class="contentpanel">
                        
                        <!-- CONTENT GOES HERE -->   
               
                   <div style="width:100%;">
			<div>
				<canvas id="canvas" height="250" width="600"></canvas>
			</div>
                     
                   </div>

<table>
                         <tr>
                             <td> <div class="foo" style="background-color:rgba(220,220,220,0.2);"></div></td><td><div class="text">United States</div></td>
                       <td><div class="foo" style="background-color:rgba(151,187,205,0.2);"></div></td><td><div class="text">United Kingdom</div></td>
                     <td>  <div class="foo" style="background-color:rgba(33,44,205,0.2);"></div></td><td><div class="text">Canada</div></td>
                        <td> <div class="foo" style="background-color:rgba(33,44,26,0.2)"></div></td><td><div class="text">Australia</div></td>
                         <td><div class="foo" style="background-color:rgba(555,54,25,0.2)"></div></td><td><div class="text">Other</div></td>
                        </tr>
                     </table>
	<script>
		var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
		var lineChartData = {
			labels : [
				@foreach($graphDates as $gd)
				"{{$gd->date}}",
			
				@endforeach
			
			],
			datasets : [
				{
					label: "United States",
					fillColor : "rgba(220,220,220,0.2)",
					strokeColor : "rgba(220,220,220,0.2)",
					pointColor : "rgba(220,220,220,0.2)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : [
						@foreach($graphUnitedStates as $gus)
						{{$gus->earning}},
						@endforeach
					
					]
				},
				{
					label: "United Kingdom",
					fillColor : "rgba(151,187,205,0.2)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : [
						@foreach($graphUnitedKingdom as $guk)
						{{$guk->earning}},
						@endforeach
						
						]
				},
				{
					label: "Canada",
					fillColor : "rgba(33,44,205,0.2)",
					strokeColor : "rgba(33,44,205,0.2)",
					pointColor : "rgba(33,44,205,0.2)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : [
						@foreach($graphCanada as $gc)
						{{$gc->earning}},
						@endforeach
						
						]
				},
				{
					label: "Australia",
					fillColor : "rgba(33,44,26,0.2)",
					strokeColor : "rgba(33,44,26,0.2)",
					pointColor : "rgba(33,44,26,0.2)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : [
						@foreach($graphAustralia as $ga)
						{{$ga->earning}},
						@endforeach
						
						]
				},
				{
					label: "Other",
					fillColor : "rgba(555,54,25,0.2)",
					strokeColor : "rgba(555,54,25,0.2)",
					pointColor : "rgba(235,54,25,0.2)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : [
						@foreach($graphOther as $go)
						{{$go->earning}},
						@endforeach
						
						]
				}
				
			]

		}

	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myLine = new Chart(ctx).Line(lineChartData, {
			responsive: true
		});
	}


	</script>
       
        
        
        
                         <table id="basicTable" class="table table-striped table-bordered responsive dataTable no-footer" role="grid" aria-describedby="basicTable_info">
                                <thead class="">
                                    
                                    <tr role="row" class="odd">
                                        <th class="sorting_1"></th>
                                         <th>Date</th>
                                        <th>Country</th>
                                        <th>Visits</th>
                                       
                                        <th>Earning</th>
                                   
                                    </tr>
                          
                          
                             @foreach($stats as $stat)       
                                <tr role="row" class="odd">
                                     
                                        <td></td>
                                        <td>{{$stat->date}}</td>
                                        <td>{{$stat->country}}</td>
                                        <td>{{$stat->visits}}</td>
                                        <td>{{round($stat->earning,5)}}</td>
                                       
                                    </tr>
                             @endforeach       
                                   </tbody>
                            </table>
                        
                    
                    
                  </div>
@stop
