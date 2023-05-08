@extends('layouts.app')
@section('title','Dashboard')

@section('content')
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="#" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="assets/img/profile.svg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{abbreviateFirstName(auth()->user()->name)}}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{auth()->user()->name}}</h6>
                            <span>Last Login: {{$elapsed}}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                            <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="#">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>My Requests</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="#">
                            <i class="bi bi-circle"></i><span>New Request</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="bi bi-circle"></i><span>Delete My Request</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Components Nav -->

        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Recent -->
                        <div class="col-6">
                            <div class="card recent-sales overflow-auto">

                                <div class="card-body">
                                    <h5 class="card-title">Your requests are being processed.</h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Manger</th>
                                            <th scope="col">Subject</th>
                                            <th scope="col">LM</th>
                                            <th scope="col">HR</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($pendingLeaveRequests as $r=> $req)
                                            <tr>
                                                <th scope="row"><a href="#">#{{$r+1}}</a></th>
                                                <td>{{$req->LM}}</td>
                                                <td>{{$req->Subject}}</td>
                                                <td>
                                                    @if(($req->LM_type) ===null )
                                                        <span class="badge bg-warning text-dark"><i
                                                                class="bi bi-exclamation-triangle me-1"></i>Pending</span>

                                                    @elseif(($req->LM_type) ==1)
                                                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Approved</span>
                                                    @else
                                                        <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i>Rejected</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(($req->HR_type) ===null )
                                                        <span class="badge bg-secondary"><i class="bi bi-collection me-1"></i>Pending</span>
                                                    @elseif(($req->HR_type) ==1)
                                                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Approved</span>
                                                    @else
                                                        <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i>Rejected</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="#" class="edit" data-toggle="modal"><i class="bi bi-pencil"
                                                                                                    data-toggle="tooltip"
                                                                                                    title="Edit"
                                                                                                    style="color: #FF9800;font-size: large;"></i></a>
                                                    &nbsp;<a href="#" class="delete" data-toggle="modal"><i
                                                            class="bi bi-trash" data-toggle="tooltip" title="Delete"
                                                            style="font-size: large;"></i></a>
                                                </td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div><!-- End  -->
                        <div class="col-6">
                            <div class="card recent-sales overflow-auto">

                                <div class="card-body">
                                    <h5 class="card-title">Your request has been processed.</h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Manger</th>
                                            <th scope="col">Subject</th>
                                            <th scope="col">LM</th>
                                            <th scope="col">HR</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($approvedRequests as $r=> $req)
                                            <tr>
                                                <th scope="row"><a href="#">#{{$r+1}}</a></th>
                                                <td>{{$req->LM}}</td>
                                                <td>{{$req->Subject}}</td>
                                                <td>
                                                    @if(($req->LM_type) ===null )
                                                        <span class="badge bg-warning text-dark"><i
                                                                class="bi bi-exclamation-triangle me-1"></i>Pending</span>

                                                    @elseif(($req->LM_type) ==1)
                                                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Approved</span>
                                                    @else
                                                        <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i>Rejected</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(($req->HR_type) ===null )
                                                        <span class="badge bg-secondary"><i class="bi bi-collection me-1"></i>Pending</span>
                                                    @elseif(($req->HR_type) ==1)
                                                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Approved</span>
                                                    @else
                                                        <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i>Rejected</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="#" class="edit" data-toggle="modal"><i class="bi bi-pencil"
                                                                                                    data-toggle="tooltip"
                                                                                                    title="Edit"
                                                                                                    style="color: #FF9800;font-size: large;"></i></a>
                                                    &nbsp;<a href="#" class="delete" data-toggle="modal"><i
                                                            class="bi bi-trash" data-toggle="tooltip" title="Delete"
                                                            style="font-size: large;"></i></a>
                                                </td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div><!-- End  -->
                        <hr>
                        <!-- Employee  -->
                        <div class="col-6">
                            <div class="card recent-sales overflow-auto">

                                <div class="card-body">
                                    <h5 class="card-title">Staff waiting for your approval (LM).</h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Subject</th>
                                            <th scope="col">From</th>
                                            <th scope="col">To</th>
                                            <th scope="col">Action</th>
                                            <th scope="col">Details</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($pendingLeaveRequestsLM as $r=> $req)
                                            <tr>
                                                <th scope="row"><a href="#">#{{$r+1}}</a></th>
                                                <td>{{$req->Subject}}</td>
                                                <td>{{$req->FROM}}</td>
                                                <td>{{$req->TO}}</td>

                                                <td>

                                                    <a href="{{url('request3/'.$req->id)}}/" class="edit" data-toggle="modal"><i class="bi bi-check-circle"
                                                                                                    data-toggle="tooltip"
                                                                                                    title="Accept"
                                                                                                    style="color: #198754;font-size: large;"></i></a>
                                                    &nbsp;<a href="{{url('request4/'.$req->id)}}/" class="delete" data-toggle="modal"><i
                                                            class="bi bi-x-circle" data-toggle="tooltip" title="Reject"
                                                            style="font-size: large;"></i></a>
                                                </td>
                                                <td><a href="#" class="text-primary">More Details</a> </td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div><!-- End  -->
                        <div class="col-6">
                            <div class="card recent-sales overflow-auto">

                                <div class="card-body">
                                    <h5 class="card-title">Staff request has been processed (LM).</h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Subject</th>
                                            <th scope="col">From</th>
                                            <th scope="col">To</th>
                                            <th scope="col">Action</th>
                                            <th scope="col">Details</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($approvedLMRequestsLM as $r=> $req)
                                            <tr>
                                                <th scope="row"><a href="#">#{{$r+1}}</a></th>
                                                <td>{{$req->Subject}}</td>
                                                <td>{{$req->FROM}}</td>
                                                <td>{{$req->TO}}</td>

                                                <td>
                                                    @if(($req->LM_type) ===null )
                                                        <span class="badge bg-warning text-dark"><i
                                                                class="bi bi-exclamation-triangle me-1"></i>Pending</span>

                                                    @elseif(($req->LM_type) ==1)
                                                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Approved</span>
                                                    @else
                                                        <span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i>Rejected</span>
                                                    @endif
                                                </td>
                                                <td><a href="#" class="text-primary">More Details</a> </td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div><!-- End  -->
                        <hr>
                        <!-- Vice  -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="card-body">
                                    <h5 class="card-title">LM who have authorized you to respond.</h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Subject</th>
                                            <th scope="col">From</th>
                                            <th scope="col">To</th>
                                            <th scope="col">Action</th>
                                            <th scope="col">Details</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($viceLeaveRequests as $r=> $req)
                                            <tr>
                                                <th scope="row"><a href="#">#{{$r+1}}</a></th>
                                                <td>{{$req->Subject}}</td>
                                                <td>{{$req->FROM}}</td>
                                                <td>{{$req->TO}}</td>

                                                <td>

                                                    <a href="{{url('request3/'.$req->id)}}/" class="edit" data-toggle="modal"><i class="bi bi-check-circle"
                                                                                                                                 data-toggle="tooltip"
                                                                                                                                 title="Accept"
                                                                                                                                 style="color: #198754;font-size: large;"></i></a>
                                                    &nbsp;<a href="{{url('request4/'.$req->id)}}/" class="delete" data-toggle="modal"><i
                                                            class="bi bi-x-circle" data-toggle="tooltip" title="Reject"
                                                            style="font-size: large;"></i></a>
                                                </td>

                                                <td><a href="#" class="text-primary">More Details</a> </td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div><!-- End  -->
                    </div>
                </div><!-- End Left side columns -->

            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>BAE Systems</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Powered by <a href="#">SDT</a>
        </div>
    </footer><!-- End Footer -->


@endsection
