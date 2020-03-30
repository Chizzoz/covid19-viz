@section('terms')
	<section id="terms">
		<div class="container">
			<div class="columns">
				<div class="column is-three-quarters">
					<div class="column">
						<div class="card">
							<div class="card-content">
                                <table class="table is-striped is-hoverable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Admin</th>
                                            <th>Province/ State</th>
                                            <th>Country/ Region</th>
                                            <th>Last Update</th>
                                            <th>Confirmed</th>
                                            <th>Deaths</th>
                                            <th>Recovered</th>
                                            <th>Active</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Admin</th>
                                            <th>Province/ State</th>
                                            <th>Country/ Region</th>
                                            <th>Last Update</th>
                                            <th>Confirmed</th>
                                            <th>Deaths</th>
                                            <th>Recovered</th>
                                            <th>Active</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $count = 0; ?>
                                        @foreach($covid_cases as $covid_case)
                                            <tr>
                                                <th>{{ $count++ }}</th>
                                                <td>{{ $covid_case->admin }}</td>
                                                <td>{{ $covid_case->province_state }}</td>
                                                <td>{{ $covid_case->country_region }}</td>
                                                <td>{{ $covid_case->lastupdate }}</td>
                                                <td>{{ $covid_case->confirmed }}</td>
                                                <td>{{ $covid_case->deaths }}</td>
                                                <td>{{ $covid_case->recovered }}</td>
                                                <td>{{ $covid_case->active }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
							</div>
						</div>
					</div>
				</div>
				@yield('right_sidebar')
			</div>
		</div>
	</section>
@stop