@extends('layouts.app')
@section('title','New Leave Request')

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
                            <h6>{{(auth()->user()->name)}}</h6>
                            <span>Last Login: 00/00/0000</span>
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
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
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
                <a class="nav-link collapsed" href="index.html">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link " data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>My Request</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="#" class="active">
                            <i class="bi bi-circle"></i><span>New Request</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="bi bi-circle"></i><span>Delete My Request</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Tables Nav -->

        </ul>

    </aside><!-- End Sidebar-->


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>New Request</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">


                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Multi Columns Form</h5>
                            @if($errors->any())
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li> {{ $error }} </li>
                                    @endforeach
                                </ul>
                            @endif
                            <!-- Multi Columns Form -->
                            <form class="row g-3" method="POST" action="{{route('requestStore')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <label for="inputName5" class="form-label">Line Manager</label>
                                    <input class="form-control" id="inputName5" name="inputName5" value="{{ request()->input('inputName5') ?? old('inputName5') }}" list="emp" autocomplete="off">
                                    <datalist id="emp">
                                        @foreach($u as $p=>$k)
                                        <option value="{{$k}}-{{$p}}">

                                        @endforeach
                                    </datalist>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputSubject5" class="form-label">Subject of Request Leave</label>
                                    <input type="text" id="inputSubject5" name="inputSubject5" value="{{ request()->input('inputSubject5') ?? old('inputSubject5') }}" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputTel" class="form-label">Emergency Tel</label>
                                    <input type="number" class="form-control" id="inputTel" value="{{ request()->input('inputTel') ?? old('inputTel') }}" name="inputTel">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail5" class="form-label">Personal Email</label>
                                    <input type="email" id="inputEmail5" value="{{ request()->input('inputEmail5') ?? old('inputEmail5') }}" name="inputEmail5" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCountry" class="form-label">Country of Domicile</label>
                                    <input type="text" class="form-control" id="inputCountry" value="{{ request()->input('inputCountry') ?? old('inputCountry')}}" name="inputCountry" value="Saudi Arabia">
                                </div>

                                <div class="col-md-3">
                                    <label class="col-sm-2 col-form-label" style="width: auto;">Advance Salary
                                        Required</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" value="{{ request()->input('ASR') ?? old('ASR')}}" aria-label="Default select example" name="ASR">
                                            <option selected></option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="inputDateFR" class="col-sm-2 col-form-label"
                                           style="width: auto;">From</label>
                                    <div class="col-sm-10">
                                        <input type="date" id="inputDateFR" name="inputDateFR" class="form-control" value="{{ request()->input('inputDateFR') ?? old('inputDateFR')}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="inputDateTO" class="col-sm-2 col-form-label">To</label>
                                    <div class="col-sm-10">
                                        <input type="date" id="inputDateTO" name="inputDateTO" value="{{ request()->input('inputDateTO') ?? old('inputDateTO')}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="col-sm-2 col-form-label" style="width: auto;">Leave Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="leaveType" value="{{ request()->input('leaveType') ?? old('leaveType')}}">
                                            <option selected></option>
                                            <option value="Haj">Haj</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                            {{--TO2--}}
                                <div class="col-md-3 c2">
                                    <label class="col-sm-2 col-form-label" style="width: auto;">Advance Salary2
                                        Required</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="ASR2" value="{{ request()->input('ASR2') ?? old('ASR2')}}">
                                            <option selected></option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 c2">
                                    <label for="inputDateFR2" class="col-sm-2 col-form-label"
                                           style="width: auto;">From</label>
                                    <div class="col-sm-10">
                                        <input type="date" id="inputDateFR2" name="inputDateFR2" class="form-control" value="{{ request()->input('inputDateFR2') ?? old('inputDateFR2')}}">
                                    </div>
                                </div>
                                <div class="col-md-3 c2">
                                    <label for="inputDateTO2" class="col-sm-2 col-form-label">To</label>
                                    <div class="col-sm-10">
                                        <input type="date" id="inputDateTO2" name="inputDateTO2" class="form-control" value="{{ request()->input('inputDateTO2') ?? old('inputDateTO2')}}">
                                    </div>
                                </div>
                                <div class="col-md-3 c2">
                                    <label class="col-sm-2 col-form-label" style="width: auto;">Leave Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="leaveType2" value="{{ request()->input('leaveType2') ?? old('leaveType2')}}">
                                            <option selected></option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                            {{--to3--}}
                                <div class="col-md-3 c3">
                                    <label class="col-sm-2 col-form-label" style="width: auto;">Advance Salary
                                        Required</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="ASR3" value="{{ request()->input('ASR3') ?? old('ASR3')}}">
                                            <option selected></option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 c3">
                                    <label for="inputDateFR3" class="col-sm-2 col-form-label"
                                           style="width: auto;">From</label>
                                    <div class="col-sm-10">
                                        <input type="date" id="inputDateFR3" name="inputDateFR3" class="form-control" value="{{ request()->input('inputDateFR3') ?? old('inputDateFR3')}}">
                                    </div>
                                </div>
                                <div class="col-md-3 c3">
                                    <label for="inputDateTO3" class="col-sm-2 col-form-label">To</label>
                                    <div class="col-sm-10">
                                        <input type="date" id="inputDateTO3" name="inputDateTO3" class="form-control" value="{{ request()->input('inputDateTO3') ?? old('inputDateTO3')}}">
                                    </div>
                                </div>
                                <div class="col-md-3 c3">
                                    <label class="col-sm-2 col-form-label" style="width: auto;">Leave Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="leaveType3" value="{{ request()->input('leaveType3') ?? old('leaveType3')}}">
                                            <option></option>
                                            <option value="haj">haj</option>
                                            <option value="Two">Two</option>
                                            <option value="Three">Three</option>
                                        </select>
                                    </div>
                                </div>
                            {{--to4--}}
                                <div class="col-md-3 c4">
                                    <label class="col-sm-2 col-form-label" style="width: auto;">Advance Salary
                                        Required</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" name="ASR4" aria-label="Default select example" value="{{ request()->input('ASR4') ?? old('ASR4')}}">
                                            <option selected></option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 c4">
                                    <label for="inputDateFR4" class="col-sm-2 col-form-label"
                                           style="width: auto;">From</label>
                                    <div class="col-sm-10">
                                        <input type="date" id="inputDateFR4" name="inputDateFR4" class="form-control" value="{{ request()->input('inputDateFR4') ?? old('inputDateFR4')}}">
                                    </div>
                                </div>
                                <div class="col-md-3 c4">
                                    <label for="inputDateTO4" class="col-sm-2 col-form-label">To</label>
                                    <div class="col-sm-10">
                                        <input type="date" id="inputDateTO4" name="inputDateTO4" class="form-control" value="{{ request()->input('inputDateTO4') ?? old('inputDateTO4')}}">
                                    </div>
                                </div>
                                <div class="col-md-3 c4">
                                    <label class="col-sm-2 col-form-label" style="width: auto;">Leave Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="leaveType4" value="{{ request()->input('leaveType4') ?? old('leaveType4')}}">
                                            <option selected></option>
                                            <option value="haj">haj</option>
                                            <option value="Two">Two</option>
                                            <option value="Three">Three</option>
                                        </select>
                                    </div>
                                </div>

                                <i class="bx  bxs-plus-circle" id="myButton" style="cursor: pointer;"
                                   onclick="showClasses()"></i>

                                <div class="col-md-6">
                                    <label for="formFile" class="col-sm-2 col-form-label">File Upload</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="formFile" name="file">
                                    </div>
                                </div>
                                <div class="form-floating col-md-6">
                                    <textarea class="form-control" placeholder="Leave a comment here"  value="{{ request()->input('leaveType5') ?? old('leaveType5')}}" name="floatingTextarea" id="floatingTextarea" style="height: 100px;"></textarea>
                                    <label for="floatingTextarea">Comments</label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </form><!-- End Multi Columns Form -->

                        </div>
                    </div>


                </div>
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
    <script>
        let classes = [ "c4", "c3", "c2"];

        function showClasses() {


            for (let i = 0; i < 4; i++) {
                let element = document.getElementsByClassName(classes[i]);

                if (element) {
                    for (let i = 0; i < 4; i++) {

                        element[i].style.display = "block";
                    }
                    if (classes[0] == 'c2') {
                        document.getElementById('myButton').style.display = "none";
                    }
                    break;

                }
            }
            classes.shift();


        }
    </script>
@endsection
