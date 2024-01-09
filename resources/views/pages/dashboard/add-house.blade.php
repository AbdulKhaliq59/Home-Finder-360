<!DOCTYPE html>
<html lang="en">
@include('components.dashboard-head-conf1')
<style>
    .form-control:focus {
        border-color: #006125;
        box-shadow: 0 0 0 0.2rem rgba(13, 70, 2, 0.25);
    }

    .form-select:focus {
        border-color: #006125;
        box-shadow: 0 0 0 0.2rem rgba(13, 70, 2, 0.25);
    }
</style>
<style>
    .custom-toast {
        position: fixed;
        top: 16px;
        right: 16px;
        z-index: 1100;
        animation: slideInRight 0.5s, fadeOut 1.5s 2.5s;
    }

    @keyframes slideInRight {
        from {
            transform: translateX(100%);
        }

        to {
            transform: translateX(0);
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
        }
    }
</style>

<body>
    @include('components.dashboard-header1')

    @include('components.dashboard-sidebar1')
    <main id="main" class="main" style="background-color: #f3f3f3;">
        <div class="pagetitle">
            <h1 class="title">Add House</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Add House</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        @if (session('success'))
            <div class="custom-toast alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        @endif

        <div>
            <form action="{{ route('dashboard.create-house') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <h4 class="" style="font-weight:600; color:#006125; size:10px">House amenities</h4>
                    <div class="col-md-6">
                        <!-- First Column -->
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">House Name</label>
                            <div class="col-sm-8">
                                <input type="text" name="house_name" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-4 col-form-label">Area</label>
                            <div class="col-sm-8">
                                <input type="text" name="area" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-4 col-form-label">price</label>
                            <div class="col-sm-8">
                                <input type="number" name="price" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Type</label>
                            <div class="col-sm-8">
                                <select id="houseTypeSelect" name="type" class="form-select"
                                    aria-label="Default select example" onchange="loadDistricts()">
                                    <option value="" selected>Select type of your house</option>
                                    <option value="Ghetto">Ghetto</option>
                                    <option value="House">House</option>
                                    <!-- Add other provinces as needed -->
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-4 col-form-label">Rooms</label>
                            <div class="col-sm-8">
                                <input type="number" name="rooms" class="form-control">
                            </div>
                        </div>
                        <!-- Second Column -->
                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-4 col-form-label">Image Upload</label>
                            <div class="col-sm-8">
                                <!-- Add the multiple attribute to allow selecting multiple files -->
                                <input class="form-control" name="image_urls[]" type="file" id="formFile" multiple>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <h4 style="font-weight:600; color:#006125; size:10px">House address</h4>
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">Province</label>
                                <div class="col-sm-8">
                                    <select id="provinceSelect" name="province" class="form-select"
                                        aria-label="Default select example" onchange="loadDistricts()">
                                        <option value="" selected>Select Province</option>
                                        <option value="East">East</option>
                                        <option value="West">West</option>
                                        <option value="Kigali">Kigali</option>
                                        <option value="North">North</option>
                                        <option value="South">South</option>
                                        <!-- Add other provinces as needed -->
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-4  col-form-label">District</label>
                                <div class="col-sm-8">
                                    <select id="districtSelect" name="district" onchange="loadSectors()"
                                        class="form-select" aria-label="Default select example">
                                        <option value="" selected>Select District</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">Sector</label>
                                <div class="col-sm-8">
                                    <select id="sectorSelect" name="sector" class="form-select"
                                        aria-label="Default select example">
                                        <option value="" selected>Select Sector</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">Cell</label>
                                <div class="col-sm-8">
                                    <select id="cellSelect"name="cell" class="form-select"
                                        aria-label="Default select example">
                                        <option value="" selected>Select Cell</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">Village</label>
                                <div class="col-sm-8">
                                    <select id="villageSelect" name="village" class="form-select"
                                        aria-label="Default select example">
                                        <option value="" selected>Select Village</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <h4 style="font-weight:600; color:#006125; size:10px">Additional information</h4>
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-4 col-form-label">House Description</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="house_description" style="height: 100px"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-8">
                    <button type="submit" class="btn btn-lg" style="color:white; background-color:#006125"
                        onmouseover="this.style.backgroundColor='#2eca6a'">Add
                        House</button>
                </div>
        </div>

        </form><!-- End General Form Elements -->
        </div>
    </main><!-- End #main -->

    @include('components.dashboard-footer1')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var selectedProvince;
        var selectedDistrict;

        function loadDistricts() {
            var provinceSelect = document.getElementById("provinceSelect");
            var districtSelect = document.getElementById("districtSelect");

            // Clear existing options
            districtSelect.innerHTML = '<option value="" selected>Select District</option>';

            // Update selectedProvince globally
            selectedProvince = provinceSelect.value;

            if (selectedProvince) {
                // Fetch JSON data from your server (localhost:8000)
                $.ajax({
                    url: 'http://localhost:8000/get-province-cell-data',
                    method: 'GET',
                    success: function(data) {
                        // Parse the JSON data
                        var jsonData = JSON.parse(data);

                        // Retrieve districts for the selected province from your JSON data
                        var districts = jsonData[selectedProvince];

                        // Populate the district dropdown
                        for (var district in districts) {
                            var option = document.createElement("option");
                            option.value = district;
                            option.text = district;
                            districtSelect.add(option);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        }

        function loadSectors() {
            var districtSelect = document.getElementById("districtSelect");
            var sectorSelect = document.getElementById("sectorSelect");

            // Clear existing options
            sectorSelect.innerHTML = '<option value="" selected>Select Sector</option>';
            selectedDistrict = districtSelect.value;
            if (selectedDistrict && selectedProvince) {
                // Fetch JSON data from your server (localhost:8000)
                $.ajax({
                    url: 'http://localhost:8000/get-province-cell-data',
                    method: 'GET',
                    success: function(data) {
                        // Parse the JSON data
                        var jsonData = JSON.parse(data);

                        // Retrieve districts for the selected province from your JSON data
                        var provinceData = jsonData[selectedProvince];
                        var districtData = provinceData[selectedDistrict];

                        // Check if districtData is defined
                        if (districtData) {
                            // Retrieve sectors directly from the districtData
                            var sectors = Object.keys(districtData);

                            // Populate the sector dropdown
                            for (var i = 0; i < sectors.length; i++) {
                                var option = document.createElement("option");
                                option.value = sectors[i];
                                option.text = sectors[i];
                                sectorSelect.add(option);
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        }

        function loadCells() {
            var districtSelect = document.getElementById("districtSelect");
            var sectorSelect = document.getElementById("sectorSelect");
            var cellSelect = document.getElementById("cellSelect");

            // Clear existing options
            cellSelect.innerHTML = '<option value="" selected>Select Cell</option>';

            selectedDistrict = districtSelect.value;
            selectedSector = sectorSelect.value;


            if (selectedDistrict && selectedSector && selectedProvince) {
                // Fetch JSON data from your server (localhost:8000)
                $.ajax({
                    url: 'http://localhost:8000/get-province-cell-data',
                    method: 'GET',
                    success: function(data) {
                        // Parse the JSON data
                        var jsonData = JSON.parse(data);

                        // Retrieve cells for the selected district and sector from your JSON data
                        var districtData = jsonData[selectedProvince][selectedDistrict];
                        var sectorData = districtData[selectedSector];
                        // Check if sectorData is defined
                        if (sectorData) {
                            var cells = Object.keys(sectorData);

                            // Populate the sector dropdown
                            for (var i = 0; i < cells.length; i++) {
                                var option = document.createElement("option");
                                option.value = cells[i];
                                option.text = cells[i];
                                cellSelect.add(option);
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        }


        function loadVillages() {
            // Similar logic as loadDistricts

            var districtSelect = document.getElementById("districtSelect");
            var sectorSelect = document.getElementById("sectorSelect");
            var cellSelect = document.getElementById("cellSelect");
            var villageSelect = document.getElementById("villageSelect");

            // Clear existing options
            villageSelect.innerHTML = '<option value="" selected>Select village</option>';

            selectedDistrict = districtSelect.value;
            selectedSector = sectorSelect.value;
            var selectedCell = cellSelect.value;


            if (selectedDistrict && selectedSector && selectedProvince && selectedCell) {
                // Fetch JSON data from your server (localhost:8000)
                $.ajax({
                    url: 'http://localhost:8000/get-province-cell-data',
                    method: 'GET',
                    success: function(data) {
                        // Parse the JSON data
                        var jsonData = JSON.parse(data);

                        // Retrieve cells for the selected district and sector from your JSON data
                        var districtData = jsonData[selectedProvince][selectedDistrict];

                        var sectorData = districtData[selectedSector];

                        var cellData = sectorData[selectedCell];

                        // Check if sectorData is defined
                        if (cellData) {
                            var villages = cellData;
                            // Populate the sector dropdown
                            for (var i = 0; i < villages.length; i++) {
                                var option = document.createElement("option");
                                option.value = villages[i];
                                option.text = villages[i];
                                villageSelect.add(option);
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }

        }

        // Add event listeners to call the respective functions when a selection changes
        // $('#districtSelect').on('change', loadSectors);
        $('#sectorSelect').on('change', loadCells);
        $('#cellSelect').on('change', loadVillages);
        // Add similar functions to load other location-related dropdowns
    </script>


</body>

</html>
