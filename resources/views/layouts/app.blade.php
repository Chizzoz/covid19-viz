<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- CSRF Token -->
		<script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>
		<meta name="csrf-token" content="{{ csrf_token() }}"/>
		<title><?php if (isset($heading)) echo $heading . " | "; ?>Covid-19 Coronavirus Visualisations | One Ziko</title>
		<!-- unflurl -->
			<!-- TODO -->
		<!-- favicon -->
		<link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">
		<link rel="icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">
		<!-- Styling sheets -->
		<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="{{ asset('/css/landing.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('/css/custom.css') }}">
		<!-- font -->
		<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<!-- Use Fontawesome -->
		<script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>
		<!-- Analytics JS -->
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-40321470-1', 'auto');
			ga('send', 'pageview');

		</script>
		<!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-1DW0H10ZTY"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'G-1DW0H10ZTY');
        </script>
    </head>
    <body>
		<!-- fb share JS-->
		<div id="fb-root"></div>
		<!-- fb SDK JS-->
        <script>
          window.fbAsyncInit = function() {
            FB.init({
              appId      : '706048359780521',
              cookie     : true,
              xfbml      : true,
              version    : 'v3.2'
            });
              
            FB.AppEvents.logPageView();   
              
          };
        
          (function(d, s, id){
             var js, fjs = d.getElementsByTagName(s)[0];
             if (d.getElementById(id)) {return;}
             js = d.createElement(s); js.id = id;
             js.src = "https://connect.facebook.net/en_US/sdk.js";
             fjs.parentNode.insertBefore(js, fjs);
           }(document, 'script', 'facebook-jssdk'));
        </script>
		<section class="map is-fullheight">
        	<div class="map-head">
				<nav class="navbar is-dark">
					<div class="navbar-brand">
						<a class="navbar-item" href="{{ route('welcome') }}">
							<img src="{{ asset('/img/sars-cov-19.jpg') }}" alt="Zambian Startups">
						</a>
						<div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
							<span></span>
							<span></span>
							<span></span>
						</div>
					</div>

					<div id="navbarExampleTransparentExample" class="navbar-menu">
						<div class="navbar-start">
							<a class="navbar-item" href="{{ route('table') }}">Table</a>
							@if (!Auth::guest())
								<a class="navbar-item" href="{{ route('table') }}">Table</a>
							@endif
						</div>

						<div class="navbar-end">
							@if (Auth::guest())
								<a class="navbar-item" href="{{ url('about') }}" title="About">About</a>
								<a class="navbar-item" href="{{ url('credits') }}" title="Credits">Credits</a>
								<a class="navbar-item" href="{{ url('contact') }}" title="Contact Us">Contact Us</a>
							@else
								<a class="navbar-item" href="{{ url('about') }}">About</a>
								<a class="navbar-item" href="{{ url('credits') }}" title="Credits">Credits</a>
								<a class="navbar-item" href="{{ url('contact') }}">Contact Us</a>
								<div class="navbar-item has-dropdown is-hoverable">
									<a class="navbar-item" href="#"><figure class="image"><img class="is-rounded user-profile-picture" src="<?php
										if (!(Auth::user()->user_profile_picture == "")) {
											echo str_replace('users', 'small', Auth::user()->user_profile_picture);
										} else {
											echo asset('/images/small/default-user-profile-picture.png');
										} ?>" title="{{ Auth::user()->username }}" alt="{{ Auth::user()->username }}"></figure></a>
									<div class="navbar-dropdown is-right">
										@if(Auth::user()->user_role_id == 1)
											<a class="navbar-item" href="{{ route('pull_global_covid19_data') }}">Pull Global Covid-19 Data</a>
											<a class="navbar-item" href="#">Post New Covid-19 Case</a>
											<a class="navbar-item" href="#">Edit Covid-19 Case</a>
										@endif
										<a class="navbar-item" href="{{ route('logout') }}"
										onclick="event.preventDefault();document.getElementById('logout-form').submit();">
											Logout
										</a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST"
										style="display: none;">
											{{ csrf_field() }}
										</form>
									</div>
								</div>
							@endif
						</div>
					</div>
				</nav>
            </div>

			<div class="map-body">
                @yield('about')
                @yield('contact')
                @yield('credits')
                @yield('content')
                @yield('privacy')
                @yield('terms')
			</div>
            <!-- Footer -->
            <div class="row map-foot">
                <div class="medium-12 column footer-links">
                    <ul class="footer menu">
                        <li><a href="{{ url('terms') }}" title="Terms and Conditions">Terms and Conditions</a></li>
                        <li><a href="{{ url('about') }}" title="About">About</a></li>
                        <li><a href="{{ url('credits') }}" title="Credits">Credits</a></li>
                        <li><a href="{{ url('contact') }}" title="Contact Us">Contact Us</a></li>
                    </ul>
                </div>
                <div class="medium-12 column base">
                    <div class="small-8 column copyright">
                        <strong>Covid-19 Viz</strong> &copy; <a href="https://oneziko.com" title="One Ziko Homepage" target="_blank">One Ziko</a> <?php echo date("Y") ?>
                    </div>
                    <div>
                        <ul class="social">
                            <li class="facebook"><a href="https://www.facebook.com/OneZiko" alt="facebook" title="One Ziko facebook page" target="_blank"></a></li>
                            <li class="twitter"><a href="https://twitter.com/oneziko" alt="twitter" title="One Ziko twitter page" target="_blank"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
		</section>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
		<script async src="{{ asset('/js/bulma.js') }}"></script>
    </body>
</html>
