@section('contact')
	<section id="contact">
		<div class="container">
			<div class="columns">
				<div class="column">
					<div class="card">
						<header class="card-header">
							<p class="card-header-title">Contacts Us</p>
						</header>
						
						<div class="card-content">
							@if (Session::get('email_sent'))
								<div class="notification is-success">{{ Session::get('email_sent') }}</div>
							@endif
							@if (Session::get('email_error'))
								<div class="notification is-danger">{{ Session::get('email_error') }}</div>
							@endif
							<form action="{{ route('contact-us-post') }}" method="POST">
								{{ csrf_field() }}
								<!-- Name -->
								<div class="field">
									<label class="label">Name</label>
									<div class="control has-icons-left">
										<input class="input @if ($errors->has('name')) is-danger @endif" type="text" name="name" placeholder="Your Name" value="{{ old('name') }}">
										<span class="icon is-small is-left">
											<i class="fas fa-user"></i>
										</span>
									</div>
									@if (count($errors) > 0)
										@foreach ($errors->get('name') as $error)
											<p class="help is-danger">{{ $error }}</p>
										@endforeach
									@endif
								</div>
								<!-- e-Mail -->
								<div class="field">
									<label class="label">e-Mail</label>
									<div class="control has-icons-left">
										<input class="input @if ($errors->has('email')) is-danger @endif" type="email" name="email" placeholder="Your e-Mail" value="{{ old('email') }}">
										<span class="icon is-small is-left">
											<i class="fas fa-envelope"></i>
										</span>
									</div>
									@if (count($errors) > 0)
										@foreach ($errors->get('email') as $error)
											<p class="help is-danger">{{ $error }}</p>
										@endforeach
									@endif
								</div>
								<!-- Phone Number -->
								<div class="field">
									<label class="label">Phone Number</label>
									<div class="control has-icons-left">
										<input class="input @if ($errors->has('phone')) is-danger @endif" type="text" name="phone" placeholder="Your Phone Number" value="{{ old('phone') }}">
										<span class="icon is-small is-left">
											<i class="fas fa-phone"></i>
										</span>
									</div>
									@if (count($errors) > 0)
										@foreach ($errors->get('phone') as $error)
											<p class="help is-danger">{{ $error }}</p>
										@endforeach
									@endif
								</div>
								<!-- Inquiry -->
								<div class="field">
									<label class="label">Message</label>
									<div class="control">
										<textarea class="textarea input @if ($errors->has('inquiry')) is-danger @endif" name="inquiry" placeholder="Your Message">{{ old('inquiry') }}</textarea>
									</div>
									@if (count($errors) > 0)
										@foreach ($errors->get('inquiry') as $error)
											<p class="help is-danger">@if ($error == 'The inquiry format is invalid.') No URL's or links allowed @else {{ $error }} @endif</p>
										@endforeach
									@endif
								</div>
								<!-- Area Code -->
								<div class="field area-51">
									<label class="label">Area 51</label>
									<div class="control has-icons-left">
										<input class="input @if ($errors->has('area_code')) is-danger @endif" type="text" name="area_code" placeholder="Area Code" value="">
										<span class="icon is-small is-left">
											<i class="fas fa-phone"></i>
										</span>
									</div>
								</div>
								
								<div class="field">
									<div class="control">
										<input type="submit" value="Submit" class="button is-link" />
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="column">
					<div class="card">
						<div class="card-content">
							<ul class="contact-details">
								<li>
									<img src="{{ asset('/img/email-32.gif') }}" alt="email" />  <a href="mailto:info@oneziko.com">info@oneziko.com</a>
								</li>
							</ul>
							<ul class="projects">
								<li><strong>Services</strong></li>
								<li><a href="http://maliketi.oneziko.com/" target="_blank">Maliketi eXchange</a></li>
								<li><a href="http://creatives.oneziko.com/" target="_blank">Zambian Creatives</a></li>
								<li><a href="http://facts.oneziko.com/" target="_blank">Zambian Facts</a></li>
								<li><a href="http://headlines.oneziko.com/" target="_blank">Zambian Headlines</a></li>
								<li><a href="http://lyrics.oneziko.com/" target="_blank">Zambian Lyrics</a></li>
								<li><a href="http://timeline.oneziko.com/" target="_blank">Zambian Music Timeline</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@stop