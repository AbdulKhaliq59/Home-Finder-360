<!DOCTYPE html>
<html lang="en">
@include('components.dashboard-head-conf1')

<body>

    @include('components.dashboard-header1')

    @include('components.dashboard-sidebar1')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Landlord List</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Landlord</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- Tenant Table --}}
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($landlords as $landlord)
                                    <tr>
                                        <td>{{ $landlord->name }}</td>
                                        <td>{{ $landlord->email }}</td>
                                        <td>
                                            {{-- Add tenant-related actions/buttons here --}}
                                            {{-- For example: --}}
                                            <button class="btn btn-success">View</button>
                                            <button class="btn btn-danger">Delete</button>
                                            <button class="btn btn-primary">Edit</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- End #main -->
    {{-- Dashoard Footer --}}
    @include('components.dashboard-footer1')

    {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            // Handle sidebar item clicks
            $('.nav-link').on('click', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                loadContent(url);
            });

            // Function to load content dynamically
            function loadContent(url) {
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(data) {
                        $('#content-placeholder').html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    </script>
</body>

</html>
