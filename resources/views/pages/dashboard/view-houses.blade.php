<!DOCTYPE html>
<html lang="en">
@include('components.dashboard-head-conf1')

<body>
    @include('components.dashboard-header1')

    @include('components.dashboard-sidebar1')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Houses List</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Houses</li>
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
                                    <th>Area</th>
                                    <th>Price</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($housesAll as $house)
                                    <tr>
                                        <td>{{ $house->house_name }}</td>
                                        <td>{{ $house->area }}</td>
                                        <td>{{ $house->price }}</td>
                                        <td>{{ $house->type }}</td>
                                        <td>
                                            <button class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#houseModal{{ $house->id }}">View</button>
                                            <button class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteHouseModal{{ $house->id }}">Delete</button>
                                            <button class="btn btn-primary"data-bs-toggle="modal"
                                                data-bs-target="#updateHouseModal{{ $house->id }}">Edit</button>
                                        </td>
                                    </tr>

                                    <!-- Modal for Viewing House Details -->
                                    <div class="modal fade" id="houseModal{{ $house->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ $house->house_name }} Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Add house details here -->
                                                    <p><strong>House Name:</strong> {{ $house->house_name }}</p>
                                                    <p><strong>Area:</strong> {{ $house->area }}</p>
                                                    <p><strong>Price:</strong> {{ $house->price }}</p>
                                                    <p><strong>Type:</strong> {{ $house->type }}</p>
                                                    <p><strong>Rooms:</strong> {{ $house->rooms }}</p>

                                                    @if ($house->image_urls)
                                                        <p><strong>Images:</strong></p>
                                                        <div id="carouselExampleControls" class="carousel slide"
                                                            data-bs-ride="carousel"
                                                            style="max-width: 300px; max-height: 400px; margin: 0 auto;">
                                                            <div class="carousel-inner">
                                                                @foreach (json_decode($house->image_urls) as $index => $image)
                                                                    <script>
                                                                        console.log("Image URL: {{ asset($image) }}");
                                                                    </script>
                                                                    <div
                                                                        class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                                        <img src="../{{ $image }}"
                                                                            class="d-block w-100 image-fluid"
                                                                            alt="House Image">
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <button class="carousel-control-prev" type="button"
                                                                data-bs-target="#carouselExampleControls"
                                                                data-bs-slide="prev">
                                                                <span class="carousel-control-prev-icon"
                                                                    aria-hidden="true"></span>
                                                                <span class="visually-hidden">Previous</span>
                                                            </button>
                                                            <button class="carousel-control-next" type="button"
                                                                data-bs-target="#carouselExampleControls"
                                                                data-bs-slide="next">
                                                                <span class="carousel-control-next-icon"
                                                                    aria-hidden="true"></span>
                                                                <span class="visually-hidden">Next</span>
                                                            </button>
                                                        </div>
                                                    @endif


                                                    @if ($house->address)
                                                        <p><strong>Address:</strong></p>
                                                        <ul>
                                                            <li><strong>Province:</strong>
                                                                {{ $house->address['province'] }}</li>
                                                            <li><strong>District:</strong>
                                                                {{ $house->address['district'] }}</li>
                                                            <li><strong>Sector:</strong>
                                                                {{ $house->address['sector'] }}</li>
                                                            <li><strong>Cell:</strong> {{ $house->address['cell'] }}
                                                            </li>
                                                            <li><strong>Village:</strong>
                                                                {{ $house->address['village'] }}</li>
                                                        </ul>
                                                    @endif

                                                    <p><strong>Additional Description:</strong>
                                                        {{ $house->additional_description }}</p>
                                                    <!-- Add more details as needed -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Delete modal --}}
                                    <div class="modal fade" id="deleteHouseModal{{ $house->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Delete House</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to remove {{ $house->house_name }}?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <form
                                                        action="{{ route('dashboard.delete-house', ['id' => $house->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End Small Modal-->
                                    {{-- Update modal --}}

                                    <div class="modal fade" id="updateHouseModal{{ $house->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-fullscreen">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update House</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <div>
                                                        <form method="POST"
                                                            action="{{ route('dashboard.update-house', ['id' => $house->id]) }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('put')
                                                            <div class="row mb-3">
                                                                <h4 class=""
                                                                    style="font-weight:600; color:#006125; size:10px">
                                                                    House amenities</h4>
                                                                <div class="col-md-6">
                                                                    <!-- First Column -->
                                                                    <div class="row mb-3">
                                                                        <label for="inputText"
                                                                            class="col-sm-4 col-form-label">House
                                                                            Name</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" name="house_name"
                                                                                value="{{ $house->house_name }}"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <label for="inputPassword"
                                                                            class="col-sm-4 col-form-label">Area</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text"
                                                                                value="{{ $house->area }}"
                                                                                name="area" class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <label for="inputNumber"
                                                                            class="col-sm-4 col-form-label">price</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="number"
                                                                                value="{{ $house->price }}"
                                                                                name="price" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="row mb-3">
                                                                        <label
                                                                            class="col-sm-4 col-form-label">Type</label>
                                                                        <div class="col-sm-8">
                                                                            <select id="houseTypeSelect"
                                                                                name="type" class="form-select">
                                                                                <option value="" selected>Select
                                                                                    type of your house</option>
                                                                                <option value="Ghetto"
                                                                                    {{ $house->type === 'Ghetto' ? 'selected' : '' }}>
                                                                                    Ghetto</option>
                                                                                <option value="House"
                                                                                    {{ $house->type === 'House' ? 'selected' : '' }}>
                                                                                    House</option>
                                                                                <!-- Add other options as needed -->
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="inputNumber"
                                                                            class="col-sm-4 col-form-label">Rooms</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="number" name="rooms"
                                                                                value="{{ $house->rooms }}"
                                                                                class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <!-- Second Column -->
                                                                    <div class="row mb-3">
                                                                        <label for="inputNumber"
                                                                            class="col-sm-4 col-form-label">Image
                                                                            Upload</label>
                                                                        <div class="col-sm-8">
                                                                            <!-- Add the multiple attribute to allow selecting multiple files -->
                                                                            <input class="form-control"
                                                                                name="image_urls[]" type="file"
                                                                                value="{{ $house->image_urls }}"
                                                                                id="formFile" multiple>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <h4
                                                                        style="font-weight:600; color:#006125; size:10px">
                                                                        House address</h4>
                                                                    <div class="col-md-6">
                                                                        <div class="row mb-3">
                                                                            <label
                                                                                class="col-sm-4 col-form-label">Province</label>
                                                                            <div class="col-sm-8">
                                                                                <select id="provinceSelect"
                                                                                    name="province"
                                                                                    class="form-select"
                                                                                    aria-label="Default select example"
                                                                                    onchange="loadDistricts()">
                                                                                    <option value="" selected>
                                                                                        Select Province</option>
                                                                                    <option value="East">East
                                                                                    </option>
                                                                                    <option value="West">West
                                                                                    </option>
                                                                                    <option value="Kigali">Kigali
                                                                                    </option>
                                                                                    <option value="North">North
                                                                                    </option>
                                                                                    <option value="South">South
                                                                                    </option>
                                                                                    <!-- Add other provinces as needed -->
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mb-3">
                                                                            <label
                                                                                class="col-sm-4  col-form-label">District</label>
                                                                            <div class="col-sm-8">
                                                                                <select id="districtSelect"
                                                                                    name="district"
                                                                                    onchange="loadSectors()"
                                                                                    class="form-select"
                                                                                    aria-label="Default select example">
                                                                                    <option value="" selected>
                                                                                        Select District</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mb-3">
                                                                            <label
                                                                                class="col-sm-4 col-form-label">Sector</label>
                                                                            <div class="col-sm-8">
                                                                                <select id="sectorSelect"
                                                                                    name="sector" class="form-select"
                                                                                    aria-label="Default select example">
                                                                                    <option value="" selected>
                                                                                        Select Sector</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="row mb-3">
                                                                            <label
                                                                                class="col-sm-4 col-form-label">Cell</label>
                                                                            <div class="col-sm-8">
                                                                                <select id="cellSelect"name="cell"
                                                                                    class="form-select"
                                                                                    aria-label="Default select example">
                                                                                    <option value="" selected>
                                                                                        Select Cell</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3">
                                                                            <label
                                                                                class="col-sm-4 col-form-label">Village</label>
                                                                            <div class="col-sm-8">
                                                                                <select id="villageSelect"
                                                                                    name="village" class="form-select"
                                                                                    aria-label="Default select example">
                                                                                    <option value="" selected>
                                                                                        Select Village</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <h4
                                                                        style="font-weight:600; color:#006125; size:10px">
                                                                        Additional information</h4>
                                                                    <div class="col-md-6">
                                                                        <div class="row mb-3">
                                                                            <label for="inputPassword"
                                                                                class="col-sm-4 col-form-label">House
                                                                                Description</label>
                                                                            <div class="col-sm-8">
                                                                                <textarea class="form-control" value="{{ $house->additional_description }}" name="house_description"
                                                                                    style="height: 100px"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </form>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End Full Screen Modal-->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- End #main -->

    @include('components.dashboard-footer1')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/loadCellData.js"></script>
</body>

</html>
