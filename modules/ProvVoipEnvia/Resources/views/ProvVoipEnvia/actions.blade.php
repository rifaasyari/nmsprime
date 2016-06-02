@if (isset($extra_data) && !is_null($extra_data))

		@foreach($extra_data as $extra_content)

			{{-- new job class --}}
			@if (!array_key_exists('linktext', $extra_content))
				<br><b><u>
				{{ $extra_content['class'] }}
				</u></b><br>

			{{-- job is done --}}
			@elseif (!array_key_exists('url', $extra_content))
				{{ $extra_content['linktext'] }} ✔
				<br>
			{{-- possible jobs --}}

			@else
				<a href="{{ $extra_content['url'] }}">{{ $extra_content['linktext'] }}</a>
				<br>

			@endif

		@endforeach

@endif