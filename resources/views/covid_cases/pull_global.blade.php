@section('content')
	<section id="new-article">
		<div class="container">
			<div class="columns">
				<div class="column is-three-quarters">
					<div class="column">
						<div class="card">
							<div class="card-content">
								<article class="media">
									<div class="media-content">
										<div class="content">
											@if (Session::get('startup_content_create_error'))
												<div class="notification is-danger"><button class="delete"></button>{{ Session::get('startup_content_create_error') }}</div>
											@endif
											<form action="{{ route('post_global_pull_request') }}" method="POST" enctype="multipart/form-data">
												{{ csrf_field() }}
												<!-- Date -->
												<div class="field">
													<label class="label">Date</label>
													<div class="control has-icons-left">
														<input class="input @if ($errors->has('date')) is-danger @endif" type="text" name="date" placeholder="Report Date" value="{{ old('date') }}">
														<span class="icon is-small is-left">
															<i class="fas fa-user"></i>
														</span>
													</div>
													@if (count($errors) > 0)
														@foreach ($errors->get('date') as $error)
															<p class="help is-danger">{{ $error }}</p>
														@endforeach
													@endif
												</div>
												
												<div class="field">
													<div class="control">
														<input type="submit" value="Submit" class="button is-link" />
													</div>
												</div>
											</form>
										</div>
									</div>
								</article>
							</div>
							<footer class="card-footer">
								<a href="{{ url()->previous() }}" class="card-footer-item" title="Go Back">Back</a>
							</footer>
						</div>
					</div>
				</div>
				@yield('right_sidebar')
			</div>
		</div>
	</section>
@stop