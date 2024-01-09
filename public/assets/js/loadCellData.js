var selectedProvince;
var selectedDistrict;

function loadDistricts() {
    var provinceSelect = document.getElementById("provinceSelect");
    var districtSelect = document.getElementById("districtSelect");

    // Clear existing options
    districtSelect.innerHTML =
        '<option value="" selected>Select District</option>';

    // Update selectedProvince globally
    selectedProvince = provinceSelect.value;

    if (selectedProvince) {
        // Fetch JSON data from your server (localhost:8000)
        $.ajax({
            url: "http://localhost:8000/get-province-cell-data",
            method: "GET",
            success: function (data) {
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
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
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
            url: "http://localhost:8000/get-province-cell-data",
            method: "GET",
            success: function (data) {
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
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
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
            url: "http://localhost:8000/get-province-cell-data",
            method: "GET",
            success: function (data) {
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
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
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
    villageSelect.innerHTML =
        '<option value="" selected>Select village</option>';

    selectedDistrict = districtSelect.value;
    selectedSector = sectorSelect.value;
    var selectedCell = cellSelect.value;

    if (
        selectedDistrict &&
        selectedSector &&
        selectedProvince &&
        selectedCell
    ) {
        // Fetch JSON data from your server (localhost:8000)
        $.ajax({
            url: "http://localhost:8000/get-province-cell-data",
            method: "GET",
            success: function (data) {
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
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
        });
    }
}

// Add event listeners to call the respective functions when a selection changes
// $('#districtSelect').on('change', loadSectors);
$("#sectorSelect").on("change", loadCells);
$("#cellSelect").on("change", loadVillages);
// Add similar functions to load other location-related dropdowns
