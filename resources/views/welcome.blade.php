<!doctype html>
<html class="no-js" lang="en">
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
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.1/dist/leaflet.css" />
		<link href="{{ asset('/css/leaflet.defaultextent.css') }}" rel="stylesheet">
		<link href="{{ asset('/css/L.Control.Locate.min.css') }}" rel="stylesheet">
		<style>
			#map { width: 800px; height: 500px; }
			.info { padding: 6px 8px; font: 14px/16px Arial, Helvetica, sans-serif; background: white; background: rgba(255,255,255,0.8); box-shadow: 0 0 15px rgba(0,0,0,0.2); border-radius: 5px; } .info h4 { margin: 0 0 5px; color: #777; }
			.legend { text-align: left; line-height: 18px; color: #555; } .legend i { width: 18px; height: 18px; float: left; margin-right: 8px; opacity: 0.7; }
		</style>
		<!-- font -->
		<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		<!-- Leaflet -->
		<script src="https://unpkg.com/leaflet@1.0.1/dist/leaflet.js"></script>
		<script src="{{ asset('/js/leaflet.defaultextent.js') }}"></script>
		<script src="{{ asset('/js/L.Control.Locate.min.js') }}"></script>
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
								<a class="navbar-item" href="{{ route('login') }}" title="Login">Login</a>
								<a class="navbar-item" href="{{ route('register') }}" title="Register">Register</a>
								<a class="navbar-item" href="{{ url('about') }}" title="About">About</a>
								<a class="navbar-item" href="{{ url('contact') }}" title="Contact Us">Contact Us</a>
							@else
								<a class="navbar-item" href="{{ url('about') }}">About</a>
								<a class="navbar-item" href="{{ url('contact') }}">Contact Us</a>
								<div class="navbar-item has-dropdown is-hoverable">
									<a class="navbar-item" href="#"><figure class="image"><img class="is-rounded user-profile-picture" src="<?php
										if (!(Auth::user()->user_profile_picture == "")) {
											echo str_replace('users', 'small', Auth::user()->user_profile_picture);
										} else {
											echo asset('/images/small/default-user-profile-picture.png');
										} ?>" title="{{ Auth::user()->username }}" alt="{{ Auth::user()->username }}"></figure></a>
									<div class="navbar-dropdown is-right">
										<a class="navbar-item" href="#">Post New Covid-19 Case</a>
										<a class="navbar-item" href="#">Edit Covid-19 Case</a>
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
				<div id="mapid" class="mapclass"></div>
				<?php
					$filename = 'https://raw.githubusercontent.com/CSSEGISandData/COVID-19/master/csse_covid_19_data/csse_covid_19_daily_reports/03-27-2020.csv';

					// The nested array to hold all the arrays
					$covid19_data = []; 
					
					// Open the file for reading
					if (($h = fopen("{$filename}", "r")) !== FALSE) 
					{
					// Each line in the file is converted into an individual array that we call $data
					// The items of the array are comma separated
					while (($data = fgetcsv($h, 1000, ",")) !== FALSE) 
					{
						// Each individual array is being pushed into the nested array
						$covid19_data[] = $data;		
					}
					
					// Close the file
					fclose($h);
					}
				?>
				<script>
					var grayscale = L.tileLayer('http://{s}.tiles.wmflabs.org/bw-mapnik/{z}/{x}/{y}.png', {
						maxZoom: 18,
						attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
					});

					var streets = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
						maxZoom: 19,
						attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
					});
					
					// var marker1 = L.marker([-15.4102, 28.2616]).bindPopup("<b>Hello world!</b><br>I am a popup.<br><a href='#'><img src='https://via.placeholder.com/480'></a>");
					
					// marker2 = L.marker([-14.4102, 25.2616]).bindPopup("<b>Hello world!</b><br>I am a popup.<br><a href='#'><img src='https://via.placeholder.com/480'></a>");
					
					<?php
							$count = 1;
							foreach($covid_cases as $covid_case) {
								if(isset($covid_case->latitude) && isset($covid_case->longitude) && isset($covid_case->confirmed) && isset($covid_case->deaths) && isset($covid_case->recovered)) {
									$province_state = str_replace("'","-", $covid_case->province_state);
									$country_region = str_replace("'","-", $covid_case->country_region);
									echo "var marker{$count} = L.marker([{$covid_case->latitude}, {$covid_case->longitude}]).bindPopup('<b>{$province_state}, {$country_region}</b><br><b>Confirmed: {$covid_case->confirmed}</b><br><b>Deaths: {$covid_case->deaths}</b><br><b>Recovered: {$covid_case->recovered}</b>'); \n";
									$count++;
								}
							}
					?>
					
					<?php
							$count = 2;
							$markers = '';
							if ($markers != '') {
								foreach($covid_cases as $covid_case) {
									$markers .= ",marker{$count}";
									$count++;
								}
								echo "var markers = L.layerGroup([{$markers}]);";
							}
					?>

					var mymap = L.map('mapid', {
						center: [-13.4102, 28.2616],
						zoom: 6,
						layers: [streets, markers],
						defaultExtentControl: true
					});

					mymap.attributionControl.addAttribution('Population data &copy; <a href="https://earthworks.stanford.edu/">Stanford University Earth Works</a>');
					
					var baseMaps = {
						"Streets": streets,
						"Grayscale": grayscale
					};

					var overlayMaps = {
						"Markers": markers
					};

					L.control.layers(baseMaps, overlayMaps).addTo(mymap);

				</script>
			</div>
			<!-- Footer -->
			<div class="map-foot">
				<div class="content">
					<div class="card">
						<div class="card-content">
							<strong>Covid-19 Viz</strong> &copy; <a href="https://oneziko.com" title="One Ziko Homepage" target="_blank">One Ziko</a> <?php echo date("Y") ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<script async src="{{ asset('/js/bulma.js') }}"></script>
		<script src="{{ asset('/js/leaflet.defaultextent.js') }}"></script>
		<script src="{{ asset('/js/L.Control.Locate.min.js') }}"></script>
	</body>

</html>