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
                                        @foreach($cases as $case)
                                            <tr>
                                                <th>{{ $count++ }}</th>
                                                <td>{{ $case->admin }}</td>
                                                <td>{{ $case->province_state }}</td>
                                                <td>{{ $case->country_region }}</td>
                                                <td>{{ $case->lastupdate }}</td>
                                                <td>{{ $case->confirmed }}</td>
                                                <td>{{ $case->deaths }}</td>
                                                <td>{{ $case->recovered }}</td>
                                                <td>{{ $case->active }}</td>
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