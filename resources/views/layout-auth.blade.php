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


    <!-- Datatable -->
    <link href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
    <script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>

</head>

<body>

    @include('sweetalert::alert')


    <div class="splash active">
        <div class="splash-icon"></div>
    </div>

    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <a class="sidebar-brand" href="/dashboard">
                Dashboard
            </a>
            <div class="sidebar-content">
                <div class="sidebar-user">
                    @if (Auth::user()->profile_picture)
                        <img src="https://pipeline-apps.sgp1.digitaloceanspaces.com/{{ Auth::user()->profile_picture }}"
                            class="img-fluid rounded-circle mb-2" alt="Profile Picture" />
                    @else
                        <img src="https://pipeline-apps.sgp1.digitaloceanspaces.com/prototype/profile_picture/QSaCQtnzxuLwd1aDyqDXKHapWdjOMMTqvNrK5828.png"
                            class="img-fluid rounded-circle mb-2" alt="Profile Picture" />
                    @endif

                    <div class="fw-bold">{{ Auth::user()->name }}</div>
                    <small>{{ Auth::user()->position }}</small>
                </div>

                <ul class="sidebar-nav">


                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/meetings">
                            <i class="align-middle me-2 fa fa-fw fa-sticky-note"></i> <span
                                class="align-middle">Meeting</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/mockups">
                            <i class="align-middle me-2 fa fa-fw fa-television"></i> <span
                                class="align-middle">Mock-up</span>
                        </a>
                    </li>


                    @if (Auth::user()->user_type == 'admin')
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/products">
                                <i class="align-middle me-2 fa fa-fw fa-ship"></i> <span
                                    class="align-middle">Product</span>
                            </a>
                        </li>
                    @endif

                    @if (Auth::user()->resource->resource_type == 'all' || Auth::user()->resource->resource_type == 'pmo')
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/projects">
                                <i class="align-middle me-2 fa fa-fw fa-bank"></i> <span
                                    class="align-middle">Project</span>
                            </a>
                        </li>
                    @endif

                    @if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff')
                        @if (Auth::user()->resource->resource_type == 'all' || Auth::user()->resource->resource_type == 'pmo')
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="/resources">
                                    <i class="align-middle me-2 fa fa-fw fa-user-md"></i> <span
                                        class="align-middle">Resource</span>
                                </a>
                            </li>
                        @endif
                    @endif

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/kitabs">
                            <i class="align-middle me-2 fa fa-fw fa-book"></i> <span class="align-middle">Knowledge
                                Book</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/workpackages">
                            <i class="align-middle me-2 fa fa-fw fa-terminal"></i> <span class="align-middle">Work
                                Package</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/tickets">
                            <i class="align-middle me-2 fa fa-fw fa-ticket"></i> <span
                                class="align-middle">Ticket</span>
                        </a>
                    </li>

                    @if (Auth::user()->resource->resource_type == 'all' || Auth::user()->resource->resource_type == 'business')
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/tenderproposals">
                                <i class="align-middle me-2 fa fa-fw fa-briefcase"></i> <span
                                    class="align-middle">Tender</span>
                            </a>
                        </li>
                    @endif

                    @if (Auth::user()->user_type == 'admin')
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/users">
                                <i class="align-middle me-2 fa fa-fw fa-users"></i> <span
                                    class="align-middle">User</span>
                            </a>
                        </li>
                    @endif

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
                            <a class="nav-link dropdown-toggle position-relative" href="/spark/#" id="userDropdown"
                                data-bs-toggle="dropdown">
                                <i class="align-middle fas fa-cog"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/profile"><i
                                        class="align-middle me-1 fas fa-fw fa-user"></i> Profile</a>
                                <a class="dropdown-item" href="/progress"><i
                                        class="align-middle me-1 fas fa-fw fa-briefcase"></i> Progress</a>
                                <a class="dropdown-item" href="/location"><i
                                        class="align-middle me-1 fas fa-fw fa-map-marker"></i> Location</a>
                                {{-- <a class="dropdown-item" href="/spark/#"><i class="align-middle me-1 fas fa-fw fa-chart-pie"></i> Analytics</a>
								{{-- <a class="dropdown-item" href="/spark/#"><i class="align-middle me-1 fas fa-fw fa-cogs"></i> Settings</a> --}}
                                <div class="dropdown-divider"></div>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button class="dropdown-item" type="submit"><i
                                            class="align-middle me-1 fas fa-fw fa-arrow-alt-circle-right"></i> Sign
                                        out</button>
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
