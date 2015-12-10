@extends ('provmon::split')


@section('content_dash')
	@if ($dash)
		<font color="grey">{{$dash}}</font>
	@else
		<font color="green"><b>TODO</b></font>
	@endif
@stop

@section('content_cacti')

	<iframe frameborder="0" scrolling="no" width=100% height=700px
		src="../../../cacti/graph_view.php?action=preview&filter={{$modem->hostname}}" name="imgbox" id="imgbox">
	</iframe>

@stop

@section('content_ping')

	@if ($ping)
		<font color="green"><b>Modem is Online</b></font><br>
		@foreach ($ping as $line)
				<table>
				<tr>
					<td> 
						 <font color="grey">{{$line}}</font>
					</td>
				</tr>
				</table>
		@endforeach
	@else
		<font color="red"> Modem is Offline</font>
	@endif

@stop

@section('content_lease')

	@if ($lease)
		<font color="green"><b>Modem has a valid lease</b></font><br>
		@foreach ($lease as $line)
				<table>
				<tr>
					<td> 
						 <font color="grey">{{$line}}</font>
					</td>
				</tr>
				</table>
		@endforeach
	@else
		<font color="red">No valid Lease found</font>
	@endif

@stop

@section('content_log')
	@if ($log)
		<font color="green"><b>Modem Logfile</b></font><br>
		@foreach ($log as $line)
				<table>
				<tr>
					<td> 
						 <font color="grey">{{$line}}</font>
					</td>
				</tr>
				</table>
		@endforeach
	@else
		<font color="red">Modem was not registering on Server - No log entry found</font>
	@endif
@stop


@section('content_realtime')
	@if ($realtime)

		<font color="green"><b>{{$realtime['forecast']}}</b></font><br>

		@foreach ($realtime['measure'] as $tablename => $table)
			<h5>{{$tablename}}</h5>
				@foreach ($table as $rowname => $row)
					<table>
					<tr>
						<th width="120px">
							{{$rowname}}
						</th>

						@foreach ($row as $linename => $line)
							<td> 
								 <font color="grey">{{htmlspecialchars($line)}}</font>
							</td>
						@endforeach
					</tr>
					</table>
				@endforeach
		@endforeach

	@else
		<font color="red">Modem is Offline</font>
	@endif
@stop