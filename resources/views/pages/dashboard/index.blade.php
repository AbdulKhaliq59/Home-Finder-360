<!DOCTYPE html>
<html lang="en">
@include('components.dashboard-head-conf')

<body>

    @include('components.dashboard-header')

    @include('components.dashboard-sidebar')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">

            <div class="row">
                <div class="col-lg-6">
                    <div id="content-placeholder">
                        {{-- Content will be loaded here --}}
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
    {{-- Dashoard Footer --}}
    @include('components.dashboard-footer')

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
