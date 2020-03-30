@section('privacy')
	<section id="terms">
		<div class="container">
			<div class="columns">
				<div class="column is-three-quarters">
					<div class="column">
						<div class="card">
							<div class="card-content">
								<strong>Privacy Policy</strong>
									<p><i>We value your privacy.</i></p><br>
									
									<p>Our Website, <a href="{{ URL::to('/') }}" title="{{ URL::to('/') }}">{{ URL::to('/') }}</a> (“Site”), and its Software Applications collect some Personal Data from its Users (each, a “User”). The Data are collected and processed for the purposes set out below. This Privacy Policy governs the manner in which <strong>One Ziko</strong> collects, uses, maintains and discloses information collected from Users of the Site. This Privacy Policy applies to the Site and all products and services offered by <strong>One Ziko.</strong></p><br>

									<p>By using this Web site, you agree to the following privacy policy. Read this page carefully. If you disagree with this policy, do not use this site. We reserve the right to change this policy at any time.</p><br>

									<p><strong>Information We Collect</strong></p>
									<p>We collect the e-mail addresses of those who post messages to our bulletin board, the e-mail addresses of those who communicate with us via e-mail, the e-mail addresses of those who make postings to our chat areas, aggregate information on what pages consumers access or visit, and information volunteered by the consumer; such as, survey information and/or site registrations.</p><br>

									<p>We also collect traffic information. Such as, but not limit to, referring URL, click behavior, IP address, length of visit, and more.</p><br>

									<p>The information we collect is used to improve the content of our website and to provide the user with better service, such as notifications about special offers and promotions.</p><br>

									<p><strong>How We Use Collected Data and Information</strong></p>
									<p>We collect and use Users’ or Data Subjects’ Personal and Non-Personal Identification Information and other Data for the following purposes:</p><br>

									<ol>
										<li>To Personalize User Experience. We may use information in the aggregate to understand how our Users as a group use the services and resources provided on our Site. For such purposes Data are collected for traffic optimization and distribution, analytics, and interaction with external social networks and platforms.</li>
										<li>To Improve our Site. We continually strive to improve our website offerings based on the information and feedback we receive from you.</li>
										<li>To Improve Customer Service. Your information helps us to more effectively respond to your customer service requests and support needs.</li>
										<li>To Administer Content, Promotions, Surveys or Other Site Features. To send Users information they agreed to receive about topics we think will be of interest to them.</li>
										<li>To Send Periodic Emails. The email address Users provide will only be used to respond to their inquiries, and/or other requests or questions. If a User decides to opt-in to our mailing list, they will receive emails that may include company news, updates, related product or service information, etc. If at any time the User would like to unsubscribe from receiving future emails, we include unsubscribe instructions at the bottom of each email, or the User may contact us via our Site.</li>
									</ol>

									<p><strong>Cookies</strong></p>
									<p>We use cookies to store visitors preferences, record session information; such as, items that consumers add to their shopping cart. The information we obtain from cookies may be used to improve site usability and for marketing purposes. Our advertisers, sponsors, and partners may also send you cookies.</p><br>

									<p><strong>Links to Other Sites</strong></p>
									<p>Our website may link to external sites that are not operated by us. Please be aware that we have no control over the content and practices of these sites, and cannot assume responsibility for their treatment of your personal information. This privacy policy only covers our website and privacy practices.</p><br>

									<p><strong>Third-Party Services</strong></p>
									<p>We may employ third-party companies and individuals on our websites - for example, analytics providers and content partners. These third parties have access to your personal information only to perform specific tasks on our behalf, and are obligated not to disclose or use it for any other purpose.</p><br>

									<p>We may provide personal information when disclosure may be required by law (e.g. search warrants and court orders). We may determine that it may be reasonably necessary to protect a party’s rights, property, or well-being. This action may include exchanging information with other companies and organizations for the purposes of fraud detection or protection, or in other situations involving suspicious or illegal activities and to regulatory institutions for the purpose of periodic mandatory returns submissions.</p><br>

									<p><strong>Interaction with External Social Networks and Platforms</strong></p>
									<p>These services allow interaction with social networks or other external platforms directly from the Site’s pages. The interaction and information obtained by this Site are always subject to the User’s privacy settings for each social network. If a service enabling interaction with social networks is installed it may still collect traffic data for the pages where the service is installed, even when Users do not use it.</p><br>

									<p><strong>Security</strong></p>
									<p>We take security seriously, and do what we can within commercially acceptable means to protect your personal information from loss or theft, as well as unauthorized access, disclosure, copying, use or modification. That said, we advise that no method of electronic transmission or storage is 100% secure, and cannot guarantee the absolute security of your data.</p><br>

									<p><strong>Business Transfers</strong></p>
									<p>In the event of a transfer of ownership of bestmensshaver.com a users personal information will, in most instances, be part of the assets transferred.</p><br>

									<p><strong>Children’s Privacy</strong></p>
									<p>These Services do not address anyone under the age of 13. We do not knowingly collect personally identifiable information from children under 13. In the case we discover that a child under 13 has provided us with personal information, we immediately delete this from our servers. If you are a parent or guardian and you are aware that your child has provided us with personal information, please contact us so that we will be able to do necessary actions.</p><br>

									<p><strong>Changes to Privacy Statement</strong></p>
									<p>From time to time, we may use customer information for new, unanticipated uses not previously disclosed in our privacy notice. If our information practices change at some time in the future we will post the policy changes to our Web site to notify you of these changes and we will use for these new purposes only data collected from the time of the policy change forward.</p><br>

									<p><strong>Contact Us</strong></p>
									<p>If you have any questions or suggestions about our Privacy Policy, do not hesitate to <a href="{{ url('contact') }}" title="Contact Us">Contact Us</a>.</p><br>
									
								<p><strong>© One Ziko <?php echo date("Y") ?> All Rights Reserved</strong></p><br>
							</div>
						</div>
					</div>
				</div>
				@yield('right_sidebar')
			</div>
		</div>
	</section>
@stop