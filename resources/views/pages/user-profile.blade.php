<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>HomeFinder360 | Dashboard</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/homeFinder.png" rel="icon">
    <link href="../assets1/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets1/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets1/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets1/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets1/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets1/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets1/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets1/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets1/css/style.css" rel="stylesheet">

    <!-- =======================================================
      * Template Name: NiceAdmin
      * Updated: Nov 17 2023 with Bootstrap v5.3.2
      * Template URL: https://KhaliqTech.com/nice-admin-bootstrap-admin-html-template/
      * Author: KhaliqTech.com
      * License: https://KhaliqTech.com/license/
      ======================================================== -->
</head>

@include('components.head-conf')

<body>

    @include('components.header')
    <main id="main" class="main">

        @if (session('Error'))
            <div class="custom-toast alert alert-danger bg-danger text-light border-0 alert-dismissible fade show"
                role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        @endif
        <section class="section profile intro-single-profile">
            <div class="pagetitle">
                <h1>Profile</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" style=" color: #000000;"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item">Users</li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <div class="row">
                @auth
                    <div class="col-xl-4">

                        <div class="card">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                <img src="../storage/{{ auth()->user()->profile_image }}"
                                    alt="{{ auth()->user()->profile_image }}" class="rounded-circle">

                                <h2>{{ auth()->user()->name }}</h2>
                                <h3>{{ auth()->user()->role }}</h3>
                            </div>
                        </div>

                    </div>
                @endauth

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Overview</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                        Profile</button>
                                </li>



                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-change-password">Change Password</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">
                                @auth
                                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                        <h5 class="card-title">Profile Details</h5>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label " style="color: #000000">Full Name</div>
                                            <div class="col-lg-9 col-md-8">{{ auth()->user()->name }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label" style="color: #000000">Email</div>
                                            <div class="col-lg-9 col-md-8">{{ auth()->user()->email }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label" style="color: #000000">Role</div>
                                            <div class="col-lg-9 col-md-8">{{ auth()->user()->role }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label" style="color: #000000">Phone Number</div>
                                            <div class="col-lg-9 col-md-8">{{ auth()->user()->phoneNumber }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label" style="color: #000000">Country</div>
                                            <div class="col-lg-9 col-md-8">{{ auth()->user()->country }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label" style="color: #000000">Address</div>
                                            <div class="col-lg-9 col-md-8">{{ auth()->user()->address }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label" style="color: #000000">Phone Number</div>
                                            <div class="col-lg-9 col-md-8">{{ auth()->user()->phoneNumber }}</div>
                                        </div>
                                    </div>
                                @endauth
                                @auth
                                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                        <!-- Profile Edit Form -->
                                        <form method="post" action="{{ route('user-profile.update') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row mb-3">
                                                <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"
                                                    style="color: #000000">Profile
                                                    Image</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input type="file" name="profileImage" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="Email" class="col-md-4 col-lg-3 col-form-label"
                                                    style="color: #000000">Email</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="email" type="email" class="form-control"
                                                        id="Email" placeholder="{{ auth()->user()->email }}"
                                                        value="">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label"
                                                    style="color: #000000">Full
                                                    Name</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="fullName" type="text" class="form-control"
                                                        id="fullName" placeholder="{{ auth()->user()->name }}"
                                                        value="">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="Job" class="col-md-4 col-lg-3 col-form-label"
                                                    style="color: #000000">Phone
                                                    Number</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="phoneNumber" type="text" class="form-control"
                                                        id="Job" placeholder="{{ auth()->user()->phoneNumber }}"
                                                        value="">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="Country" class="col-md-4 col-lg-3 col-form-label"
                                                    style="color: #000000">Country</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="country" type="text" class="form-control"
                                                        id="Country" placeholder="{{ auth()->user()->country }}"
                                                        value="">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="Address" class="col-md-4 col-lg-3 col-form-label"
                                                    style="color: #000000">Address</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="address" type="text" class="form-control"
                                                        id="address" placeholder="{{ auth()->user()->address }}"
                                                        value="">
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form><!-- End Profile Edit Form -->

                                    </div>
                                @endauth


                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <form method="POST" action="{{ route('user-profile.updatePassword') }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row mb-3">
                                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label"
                                                style="color: #000000">Current
                                                Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="currentPassword" type="password" class="form-control"
                                                    id="currentPassword">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label"
                                                style="color: #000000">New
                                                Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="newpassword" type="password" class="form-control"
                                                    id="newPassword">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="passwordConfirmation" class="col-md-4 col-lg-3 col-form-label"
                                                style="color: #000000">Confirm New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password_confirmation" type="password"
                                                    class="form-control" id="passwordConfirmation">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                        </div>
                                    </form><!-- End Change Password Form -->

                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
    @include('components.footer')
</body>

</html>
