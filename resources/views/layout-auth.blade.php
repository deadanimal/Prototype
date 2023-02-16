<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="The prototype maker">
	<meta name="author" content="Prototype">

	<title>Prototype</title>

	<link href="/spark/css/modern.css" rel="stylesheet"> 
	<style>
		body {
			opacity: 0;
		}
	</style>
	<script src="/spark/js/settings.js"></script>
</head>

<body>
	<div class="splash active">
		<div class="splash-icon"></div>
	</div>

	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<a class="sidebar-brand" href="/spark/index.html">
				Prototype
			</a>
			<div class="sidebar-content">
				<div class="sidebar-user">
					<img src="https://pipeline-apps.sgp1.cdn.digitaloceanspaces.com/{{ Auth::user()->profile_picture }}" class="img-fluid rounded-circle mb-2" alt="Profile Picture" />
					<div class="fw-bold">{{ Auth::user()->name }}</div>
					<small>{{ Auth::user()->position }}</small>
				</div>

				<ul class="sidebar-nav">

					<li class="sidebar-item active">
						<a data-bs-target="#dashboards" data-bs-toggle="collapse" class="sidebar-link">
							<i class="align-middle me-2 fas fa-fw fa-home"></i> <span class="align-middle">Meeting</span>
						</a>
						<ul id="dashboards" class="sidebar-dropdown list-unstyled collapse show" data-bs-parent="#sidebar">
							<li class="sidebar-item active"><a class="sidebar-link" href="/spark/dashboard-default.html">Default</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/dashboard-analytics.html">Analytics</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/dashboard-e-commerce.html">E-commerce</a></li>
						</ul>
					</li>

					{{-- <li class="sidebar-item">
						<a data-bs-target="#pages" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle me-2 fas fa-fw fa-file"></i> <span class="align-middle">Pages</span>
						</a>
						<ul id="pages" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/pages-settings.html">Settings</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/pages-clients.html">Clients <span
										class="sidebar-badge badge rounded-pill bg-primary">New</span></a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/pages-invoice.html">Invoice</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/pages-pricing.html">Pricing</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/pages-tasks.html">Tasks</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/pages-chat.html">Chat <span
										class="sidebar-badge badge rounded-pill bg-primary">New</span></a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/pages-blank.html">Blank Page</a></li>
						</ul>
					</li>
					<li class="sidebar-item">
						<a data-bs-target="#auth" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle me-2 fas fa-fw fa-sign-in-alt"></i> <span class="align-middle">Auth</span>
						</a>
						<ul id="auth" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/pages-sign-in.html">Sign
									In</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/pages-sign-up.html">Sign
									Up</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/pages-reset-password.html">Reset Password</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/pages-404.html">404
									Page</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/pages-500.html">500
									Page</a></li>
						</ul>
					</li>

					<li class="sidebar-header">
						Elements
					</li>
					<li class="sidebar-item">
						<a data-bs-target="#ui" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle me-2 fas fa-fw fa-flask"></i> <span class="align-middle">User Interface</span>
						</a>
						<ul id="ui" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/ui-alerts.html">Alerts</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/ui-buttons.html">Buttons</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/ui-cards.html">Cards</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/ui-general.html">General</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/ui-grid.html">Grid</a>
							</li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/ui-modals.html">Modals</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/ui-offcanvas.html">Offcanvas</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/ui-placeholders.html">Placeholders</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/ui-notifications.html">Notifications</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/ui-tabs.html">Tabs</a>
							</li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/ui-typography.html">Typography</a></li>
						</ul>
					</li>
					<li class="sidebar-item">
						<a data-bs-target="#charts" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle me-2 fas fa-fw fa-chart-pie"></i> <span class="align-middle">Charts</span>
							<span class="sidebar-badge badge rounded-pill bg-primary">New</span>
						</a>
						<ul id="charts" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/charts-chartjs.html">Chart.js</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/charts-apexcharts.html">ApexCharts</a></li>
						</ul>
					</li>

					<li class="sidebar-item">
						<a data-bs-target="#forms" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle me-2 fas fa-fw fa-check-square"></i> <span class="align-middle">Forms</span>
						</a>
						<ul id="forms" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/forms-layouts.html">Layouts</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/forms-basic-elements.html">Basic Elements</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/forms-advanced-elements.html">Advanced Elements</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/forms-floating-labels.html">Floating Labels</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/forms-input-groups.html">Input Groups</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/forms-editors.html">Editors</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/forms-validation.html">Validation</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/forms-wizard.html">Wizard</a></li>
						</ul>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="/spark/tables-bootstrap.html">
							<i class="align-middle me-2 fas fa-fw fa-list"></i> <span class="align-middle">Tables</span>
						</a>
					</li>
					<li class="sidebar-item">
						<a data-bs-target="#datatables" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle me-2 fas fa-fw fa-table"></i> <span class="align-middle">DataTables</span>
						</a>
						<ul id="datatables" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/tables-datatables-responsive.html">Responsive Table</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/tables-datatables-buttons.html">Table with Buttons</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/tables-datatables-column-search.html">Column Search</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/tables-datatables-fixed-header.html">Fixed Header</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/tables-datatables-multi.html">Multi Selection</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/tables-datatables-ajax.html">Ajax Sourced Data</a></li>
						</ul>
					</li>
					<li class="sidebar-item">
						<a data-bs-target="#icons" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle me-2 fas fa-fw fa-heart"></i> <span class="align-middle">Icons</span>
						</a>
						<ul id="icons" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/icons-feather.html">Feather</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/icons-ion.html">Ion
									Icons</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/icons-font-awesome.html">Font Awesome</a></li>
						</ul>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="/spark/calendar.html">
							<i class="align-middle me-2 far fa-fw fa-calendar-alt"></i> <span class="align-middle">Calendar</span>
						</a>
					</li>
					<li class="sidebar-item">
						<a data-bs-target="#maps" data-bs-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle me-2 fas fa-fw fa-map-marker-alt"></i> <span class="align-middle">Maps</span>
						</a>
						<ul id="maps" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/maps-google.html">Google Maps</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/spark/maps-vector.html">Vector Maps</a></li>
						</ul>
					</li> --}}

				</ul>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-theme">
				<a class="sidebar-toggle d-flex me-2">
					<i class="hamburger align-self-center"></i>
				</a>

				{{-- <form class="d-none d-sm-inline-block">
					<input class="form-control form-control-lite" type="text" placeholder="Search projects...">
				</form> --}}

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav ms-auto">
						{{-- <li class="nav-item dropdown active">
							<a class="nav-link dropdown-toggle position-relative" href="/spark/#" id="messagesDropdown" data-bs-toggle="dropdown">
								<i class="align-middle fas fa-envelope-open"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
								<div class="dropdown-menu-header">
									<div class="position-relative">
										4 New Messages
									</div>
								</div>
								<div class="list-group">
									<a href="/spark/#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="/spark/img/avatars/avatar-5.jpg" class="avatar img-fluid rounded-circle" alt="Michelle Bilodeau">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Michelle Bilodeau</div>
												<div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu tortor.</div>
												<div class="text-muted small mt-1">5m ago</div>
											</div>
										</div>
									</a>
									<a href="/spark/#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="/spark/img/avatars/avatar-3.jpg" class="avatar img-fluid rounded-circle" alt="Kathie Burton">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Kathie Burton</div>
												<div class="text-muted small mt-1">Pellentesque auctor neque nec urna.</div>
												<div class="text-muted small mt-1">30m ago</div>
											</div>
										</div>
									</a>
									<a href="/spark/#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="/spark/img/avatars/avatar-2.jpg" class="avatar img-fluid rounded-circle" alt="Alexander Groves">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Alexander Groves</div>
												<div class="text-muted small mt-1">Curabitur ligula sapien euismod vitae.</div>
												<div class="text-muted small mt-1">2h ago</div>
											</div>
										</div>
									</a>
									<a href="/spark/#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="/spark/img/avatars/avatar-4.jpg" class="avatar img-fluid rounded-circle" alt="Daisy Seger">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Daisy Seger</div>
												<div class="text-muted small mt-1">Aenean tellus metus, bibendum sed, posuere ac, mattis non.</div>
												<div class="text-muted small mt-1">5h ago</div>
											</div>
										</div>
									</a>
								</div>
								<div class="dropdown-menu-footer">
									<a href="/spark/#" class="text-muted">Show all messages</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown ms-lg-2">
							<a class="nav-link dropdown-toggle position-relative" href="/spark/#" id="alertsDropdown" data-bs-toggle="dropdown">
								<i class="align-middle fas fa-bell"></i>
								<span class="indicator"></span>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
								<div class="dropdown-menu-header">
									4 New Notifications
								</div>
								<div class="list-group">
									<a href="/spark/#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="ms-1 text-danger fas fa-fw fa-bell"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Update completed</div>
												<div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
												<div class="text-muted small mt-1">2h ago</div>
											</div>
										</div>
									</a>
									<a href="/spark/#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="ms-1 text-warning fas fa-fw fa-envelope-open"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Lorem ipsum</div>
												<div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
												<div class="text-muted small mt-1">6h ago</div>
											</div>
										</div>
									</a>
									<a href="/spark/#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="ms-1 text-primary fas fa-fw fa-building"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Login from 192.186.1.1</div>
												<div class="text-muted small mt-1">8h ago</div>
											</div>
										</div>
									</a>
									<a href="/spark/#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="ms-1 text-success fas fa-fw fa-bell-slash"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">New connection</div>
												<div class="text-muted small mt-1">Anna accepted your request.</div>
												<div class="text-muted small mt-1">12h ago</div>
											</div>
										</div>
									</a>
								</div>
								<div class="dropdown-menu-footer">
									<a href="/spark/#" class="text-muted">Show all notifications</a>
								</div>
							</div>
						</li> --}}
						<li class="nav-item dropdown ms-lg-2">
							<a class="nav-link dropdown-toggle position-relative" href="/spark/#" id="userDropdown" data-bs-toggle="dropdown">
								<i class="align-middle fas fa-cog"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="/spark/#"><i class="align-middle me-1 fas fa-fw fa-user"></i> View Profile</a>
								<a class="dropdown-item" href="/spark/#"><i class="align-middle me-1 fas fa-fw fa-comments"></i> Contacts</a>
								<a class="dropdown-item" href="/spark/#"><i class="align-middle me-1 fas fa-fw fa-chart-pie"></i> Analytics</a>
								<a class="dropdown-item" href="/spark/#"><i class="align-middle me-1 fas fa-fw fa-cogs"></i> Settings</a>
								<div class="dropdown-divider"></div>
								<form action="/logout" method="POST">
									@csrf
									<button class="dropdown-item" type="submit"><i class="align-middle me-1 fas fa-fw fa-arrow-alt-circle-right"></i> Sign out</button>
								</form>
								
							</div>
						</li>
					</ul>
				</div>
			</nav>

			@yield('content')


		</div>
        
	</div>

	
	<script src="/spark/js/app.js"></script>

</body>

</html>