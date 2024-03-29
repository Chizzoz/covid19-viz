<!doctype html>
<html class="no-js" lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- CSRF Token -->
	<script>
		window.Laravel = { csrfToken: '{{ csrf_token() }}' }
	</script>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>
		<?php if (isset($heading)) echo $heading . " | "; ?>Covid-19 Coronavirus Visualisations | One Ziko
	</title>
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
	<link rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/github-fork-ribbon-css/0.2.3/gh-fork-ribbon.min.css" />
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/custom.css') }}">
	<style>
		#map {
			width: 800px;
			height: 500px;
		}

		.info {
			padding: 6px 8px;
			font: 14px/16px Arial, Helvetica, sans-serif;
			background: white;
			background: rgba(255, 255, 255, 0.8);
			box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
			border-radius: 5px;
		}

		.info h4 {
			margin: 0 0 5px;
			color: #777;
		}

		.legend {
			text-align: left;
			line-height: 18px;
			color: #555;
		}

		.legend i {
			width: 18px;
			height: 18px;
			float: left;
			margin-right: 8px;
			opacity: 0.7;
		}
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
						<a class="navbar-item" href="#">
							<figure class="image"><img class="is-rounded user-profile-picture" src="<?php
										if (!(Auth::user()->user_profile_picture == "")) {
											echo str_replace('users', 'small', Auth::user()->user_profile_picture);
										} else {
											echo asset('/images/small/default-user-profile-picture.png');
										} ?>" title="{{ Auth::user()->username }}" alt="{{ Auth::user()->username }}"></figure>
						</a>
						<div class="navbar-dropdown is-right">
							@if(Auth::user()->user_role_id == 1)
							<a class="navbar-item" href="{{ route('pull_global_covid19_data') }}">Pull Global Covid-19
								Data</a>
							<a class="navbar-item" href="#">Post New Covid-19 Case</a>
							<a class="navbar-item" href="#">Edit Covid-19 Case</a>
							@endif
							<a class="navbar-item" href="{{ route('logout') }}"
								onclick="event.preventDefault();document.getElementById('logout-form').submit();">
								Logout
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
		<script>
			var grayscale = L.tileLayer('http://a.tile.stamen.com/toner/{z}/{x}/{y}.png', {
						maxZoom: 18,
						attribution: 'Last Updated: {{ $last_updated_on }} | &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
					});

					var streets = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
						maxZoom: 19,
						attribution: 'Last Updated: {{ $last_updated_on }} | &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
					});
					
					// var marker1 = L.marker([-15.4102, 28.2616]).bindPopup("<b>Hello world!</b><br>I am a popup.<br><a href='#'><img src='https://via.placeholder.com/480'></a>");
					
					// marker2 = L.marker([-14.4102, 25.2616]).bindPopup("<b>Hello world!</b><br>I am a popup.<br><a href='#'><img src='https://via.placeholder.com/480'></a>");
					
					<?php
							$count = 1;
							foreach($covid_cases as $covid_case) {
								if(isset($covid_case->latitude) && isset($covid_case->longitude) && isset($covid_case->confirmed) && isset($covid_case->deaths) && isset($covid_case->recovered)) {
									if (500*$covid_case->active < 400000){
										$radius = 500*$covid_case->active;
									} else {
										$radius = 400000;
									}
									if($covid_case->country_region == 'US') {
										$province_state = 'US';
										$latitude = '39.099724';
										$longitude = '-94.578331';
									} else {
										$province_state = $covid_case->province_state;
										$latitude = $covid_case->latitude;
										$longitude = $covid_case->longitude;
									}
									if(!empty($covid_case->province_state)) {
										$province_state = ", " . str_replace("'","-", $province_state);
									} else {
										$province_state = $province_state;
									}
									$country_region = str_replace("'","-", $covid_case->country_region);
									echo "var circle{$count} = L.circle([{$latitude}, {$longitude}], { color: 'red', fillColor: '#f03', fillOpacity: 0.5, radius: {$radius} }).bindPopup('<b>{$country_region} {$province_state}</b><br>Confirmed: <b>{$covid_case->confirmed}</b><br>Deaths: <b>{$covid_case->deaths}</b><br>Recovered: <b>{$covid_case->recovered}</b><br>Active: <b>{$covid_case->active}</b>'); \n";

									$count++;
								}
							}
					?>
					
					<?php
							$count = 1;
							$circles = '';
							foreach($covid_cases as $covid_case) {
								$circles .= "circle{$count},";
								$count++;
							}
							if ($circles != '') {
								echo "var circles = L.layerGroup([{$circles}]);";
							}
					?>

					var mymap = L.map('mapid', {
						center: [-13.4102, 28.2616],
						zoom: 6,
						layers: [streets<?php if($circles != '') echo ", circles";?>],
						defaultExtentControl: true
					});

					mymap.attributionControl.addAttribution('2019 Novel Coronavirus COVID-19 (2019-nCoV) Data Repository by Johns Hopkins CSSE: <a href="https://github.com/CSSEGISandData/COVID-19" title="2019 Novel Coronavirus COVID-19 (2019-nCoV) Data Repository by Johns Hopkins CSSE" target="_blank">GitHub Repository</a>');
					
					var baseMaps = {
						"Streets": streets,
						"Grayscale": grayscale
					};
					@if($circles != '')
						var overlayMaps = {
							"Drawings": circles
						};
					@endif

					L.control.layers(baseMaps, overlayMaps).addTo(mymap);

		</script>
		<a class="github-fork-ribbon left-bottom fixed" href="https://github.com/Chizzoz/covid19-viz" target="_blank"
			data-ribbon="Fork me on GitHub" title="Fork me on GitHub">Fork me on GitHub</a>
	</div>
	<!-- Footer -->
	<div class="map-foot">
		<div class="content has-text-centered">
			<div class="card">
				<div class="card-content">
					<strong>Covid-19 Viz</strong> &copy; <a href="https://oneziko.com" title="One Ziko Homepage"
						target="_blank">One Ziko</a>
					<?php echo date("Y") ?>
				</div>
			</div>
		</div>
	</div>
	<script async src="{{ asset('/js/bulma.js') }}"></script>
	<script src="{{ asset('/js/leaflet.defaultextent.js') }}"></script>
	<script src="{{ asset('/js/L.Control.Locate.min.js') }}"></script>
</body>

</html>