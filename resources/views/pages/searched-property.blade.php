<!DOCTYPE html>
<html lang="en">

@include('components.head-conf')

<body>
    @include('components.header')
    <main id="main">

        <!-- ======= Intro Single ======= -->
        <section class="intro-single">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="title-single-box">
                            <h1 class="title-single">Seached Properties</h1>
                            <span class="color-text-a">Properties</span>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/properties') }}">All properties</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Properties Grid
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section><!-- End Intro Single-->

        <!-- ======= Property Grid ======= -->
        <section class="property-grid grid">
            <div class="container">
                <div class="row">
                    @foreach ($properties as $house)
                        <div class="col-md-4">
                            <div class="card-box-a card-shadow">
                                <div class="img-box-a">
                                    @php
                                        $imageUrls = json_decode($house->image_urls, true);
                                        $firstImageUrl = $imageUrls[0] ?? 'default-image.jpg';
                                    @endphp
                                    <img src="{{ $firstImageUrl }}" alt="" class="img-a img-fluid">
                                </div>
                                <div class="card-overlay">
                                    <div class="card-overlay-a-content">
                                        <div class="card-header-a">
                                            <h2 class="card-title-a">
                                                <a href="#">{{ $house->house_name }}
                                                    <br /> {{ $house->address['district'] }}</a>
                                            </h2>
                                        </div>
                                        <div class="card-body-a">
                                            <div class="price-box d-flex">
                                                <span class="price-a">rent | RWF {{ $house->price }}</span>
                                            </div>
                                            <a href="{{ url('single-property', ['id' => $house->id]) }}" class="link-a">
                                                Click here to view
                                                <span class="bi bi-chevron-right"></span>
                                            </a>

                                        </div>
                                        <div class="card-footer-a">
                                            <ul class="card-info d-flex justify-content-around">
                                                <li>
                                                    <h4 class="card-info-title">Number</h4>
                                                    <span>{{ $house->id }}</span>
                                                </li>
                                                <li>
                                                    <h4 class="card-info-title">Area</h4>
                                                    <span>{{ $house->area }}m
                                                        <sup>2</sup>
                                                    </span>
                                                </li>
                                                <li>
                                                    <h4 class="card-info-title">Rooms</h4>
                                                    <span>{{ $house->rooms }}</span>
                                                </li>
                                                <li>
                                                    <h4 class="card-info-title">Type</h4>
                                                    <span>{{ $house->type }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($loop->iteration % 3 == 0)
                </div>
                <div class="row">
                    @endif
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <nav class="pagination-a">
                            <ul class="pagination justify-content-end">

                                <!-- Previous Page Link -->
                                @if ($properties->currentPage() > 1)
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $properties->previousPageUrl() }}"
                                            tabindex="-1">
                                            <span class="bi bi-chevron-left"></span>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1">
                                            <span class="bi bi-chevron-left"></span>
                                        </a>
                                    </li>
                                @endif

                                <!-- Pagination Elements -->
                                @for ($i = 1; $i <= $properties->lastPage(); $i++)
                                    <li class="page-item {{ $i == $properties->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $properties->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                <!-- Next Page Link -->
                                @if ($properties->hasMorePages())
                                    <li class="page-item next">
                                        <a class="page-link" href="{{ $properties->nextPageUrl() }}">
                                            <span class="bi bi-chevron-right"></span>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#">
                                            <span class="bi bi-chevron-right"></span>
                                        </a>
                                    </li>
                                @endif

                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
        </section><!-- End Property Grid Single-->

    </main><!-- End #main -->
    @include('components.footer')

</body>

</html>
