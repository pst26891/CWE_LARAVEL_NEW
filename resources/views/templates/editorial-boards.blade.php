<!--editorial_board-->
<div id="editorial_board" style="overflow: hidden;">
	<p><a href="https://www.google.com/maps/d/edit?mid=1oqK9qdotTmeSqjG7lBU-GnH1cXDtzbOK&usp=sharing" target="_blank" title="Map"><img src="{{url('images/icon_map.jpg')}}" alt="map"> View On Google Map</a></a></p>
	@php
	$j=1; @endphp
	@foreach($data['editorial_categories'] as $category)
	@if($category->id==1)
	<div class="panel panel-default">
		<div class="panel-body">
			<div id="rahul_heading" class="rahul_heading">{{$category->name}}</div>
			<div class="border_heading"></div>
			<div style="height:20px;"></div>
			@php $editorials = \App\Models\manage\Editorial_board::where(['category'=> '1'])->where(['status'=> 'active'])->get(); 
			@endphp
			@foreach($editorials as $editorial)
			<div class="col-md-7">
				<div id="editorial_board_h" style="text-align:center; margin-bottom:10px" align="center">
						<p id="active" style="text-align:center">{{$editorial->name}}</p>

						<p style="text-align:center"> {!! $editorial->address !!} </p>

						<p style="text-align:center"><strong>Email: </strong><a href="mailto:{{$editorial->email}}" style="color:#e84747" title="email">{{$editorial->email}}</a></p>

						@if($editorial->scopus_id!='')
						<p style="text-align:center"><strong>Scopus ID:</strong> <a href="https://www.scopus.com/authid/detail.uri?authorId={{$editorial->scopus_id}}" style="color:#e84747" title='scopus' target="_blank">{{$editorial->scopus_id}}</a></p>
						@endif

						<p style="text-align: center;"><span style="color: #e84747;"><a style="color: #e84747;" href="{{url('uploads/editorial').'/'.$editorial->resume}}" target="_blank">View CV</a></span></p>
				</div>
			</div>
			@endforeach
			<div class="col-md-5">
			<img src="{{url('uploads/editorial').'/'.$editorial->photo}}" class="img-responsive img-square edt-pic" style=" width: 50%;height:50%;background-color: white;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" />

			</div>
		</div>
	</div>
	@elseif($category->id==2)
	<div class="panel panel-default">
		<div class="panel-body">
			<div id="rahul_heading" class="rahul_heading">{{$category->name}}</div>
			<div class="border_heading"></div>
			<div style="height:20px;"></div>
			@php $editorials = \App\Models\manage\Editorial_board::where(['category'=> '2'])->where(['status'=> 'active'])->get(); 
			@endphp
			@foreach($editorials as $editorial)
			<div class="col-md-7">
				<div id="editorial_board_h" style="text-align:center; margin-bottom:10px" align="center">
					<center>
						<p id="active" style="text-align:center">{{$editorial->name}}</p>
					  <p style="text-align:center"> {!! $editorial->address !!} </p>
					  <p style="text-align:center"><strong>Email: </strong><a href="mailto:{{$editorial->email}}" style="color:#e84747" title="email">{{$editorial->email}}</a></p>
						@if($editorial->scopus_id!='')
						<p style="text-align:center"><strong>Scopus ID: </strong><a href="https://www.scopus.com/authid/detail.uri?authorId={{$editorial->scopus_id}}" style="color:#e84747" title='scopus' target="_blank">{{$editorial->scopus_id}}</a></p>
						@endif
						<p style="text-align: center;"><span style="color: #e84747;"><a style="color: #e84747;" href="{{url('uploads/editorial').'/'.$editorial->resume}}" target="_blank">View CV</a></span></p>
					</center>
				</div>
			</div>
			@endforeach
			<div class="col-md-5">
				<img src="{{url('uploads/editorial').'/'.$editorial->photo}}" class="img-responsive edt-pic" />

			</div>
		</div>
	</div>
    @else
	<div class="panel panel-default">
		<div class="panel-body">
			<div id="editorial_board_heading" class="myheading">{{$category->name}}</div>
			<div class="border_heading"></div>
			<div style="height:20px;"></div>
			@php $editorials = \App\Models\manage\Editorial_board::where(['category'=> $category->id])->where(['status'=> 'active'])->get(); 
			@endphp
			@foreach($editorials as $editorial)
			<div id="editorial_board_h" class="col-md-6 new_editorial_style">

				<p id="active">{{$editorial->name}}</p>
				<p>{!! $editorial->address !!}</p>
				@if($editorial->email!='')
				<p>Email: <a href="mailto:{{$editorial->email}}" style="color:#e84747" title="email">{{$editorial->email}}</a></p>
				@endif
				@if($editorial->scopus_id!='')
				<p style="text-align:center">Scopus ID: <a href="https://www.scopus.com/authid/detail.uri?authorId={{$editorial->scopus_id}}" style="color:#e84747" title='scopus' target="_blank">{{$editorial->scopus_id}}</a></p>
				@endif
				@if($editorial->resume!='')
				<p><a style="color: #e84747;" href="{{url('uploads/editorial').'/'.$editorial->resume}}" target="_blank">View CV</a></p>
				@endif
			</div>
			@endforeach

		</div>
	</div>
	@endif
	@endforeach
	<a href="{{url('/editorial-board-membership-application/')}}" style="margin:10px" class="btn btn-success"> Click Here To Apply </a>




	<p class="widget widget-text col-md-12" style="border:1px solid #c9c8c8;padding:5px">
		Note: Membership of the Editorial Board will be reviewed periodically, to ensure that all members are active and still willing to complete the tasks assigned to them. Members can be added or removed at any time as decided by the editorial selection committee.
	</p>
</div>