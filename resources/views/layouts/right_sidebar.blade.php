@section('right_sidebar')
	<div class="column is-one-quarter">
		@if (isset($contents))
			@if (!is_null($contents))
				@if ($contents->count() > 0)
					<div class="column">
						<div class="card">
							<header class="card-header">
								<p class="card-header-title">
									RECENT CONTENT
								</p>
							</header>
							<div class="card-content">
								<ul class="menu-list">
									@foreach ($contents as $content)
										<li><a href="{{ route('view-startup-content', [$content->startup_content_type_slug, $content->title_slug]) }}">{{ $content->title }}</a></li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
				@endif
			@endif
		@endif
		<div class="column">
			<div class="card">
				<header class="card-header">
					<p class="card-header-title">
						LINKS
					</p>
				</header>
				<div class="media">
				</div>
			</div>
		</div>
	</div>
</div>
@stop