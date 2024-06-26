<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Truck Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        /* Common styles */
        body {
            background-color: #00a2ff;
            color: white;
        }

        .dashboard-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 30px;
            padding: 20px;
            border: 5px solid #007bff;
            border-radius: 10px;
            background-color: #0f0470;
            width: 100%;
        }

        .fuel-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }

        .fuel-container h3 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ffffff;
            padding: 8px;
            text-align: left;
            font-size: 16px;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        td {
            background-color: #0f0470;
            color: white;
        }

        /* Navbar styles */
        .navbar-custom {
            background-color: #0f0470; /* Background color */
            color: white; /* Text color */
        }

        .navbar-custom .navbar-brand {
            color: white; /* Brand (logo) text color */
        }

        .navbar-custom .navbar-nav .nav-link {
            color: white; /* Nav links text color */
        }

        .navbar-custom .navbar-nav .nav-link:hover,
        .navbar-custom .navbar-nav .nav-link:focus {
            color: white; /* Nav links text color on hover or focus */
        }
    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom bg-primary">
        <a class="navbar-brand" href="#">Informasi Truck</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <span class="welcome-message">Welcome, {{ Auth::user()->name }}!</span>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a> <!-- Tombol untuk menuju halaman dashboard -->
            </li>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-link nav-link" style="font-weight: bold;">Logout</button>
            </form>
        </ul>
    </nav>

    <div id="fuel-level-data">
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Recorded At</th>
                <th>Fuel Level (%)</th>
                <th>Action</th> <!-- Kolom tambahan untuk tombol aksi -->
            </tr>
        </thead>
        <tbody id="data-table-body">
            <!-- Table rows will be dynamically populated -->
        </tbody>
    </table>

    <script>
        // Function to fetch and update fuel level data
        function fetchAndSetFuelLevel() {
            fetch('/api/fuel-level/latest')
                .then(response => response.json())
                .then(data => {
                    updateDataTable(data);
                })
                .catch(error => console.error('Error fetching fuel level data:', error));
        }

        // Function to update the table with new data
        function updateDataTable(data) {
            var tableBody = document.getElementById('data-table-body');
            var existingRow = tableBody.querySelector('tr');

            if (existingRow) {
                // Update existing row with new data
                existingRow.innerHTML = `
                    <td>${data.no}</td>
                    <td>${data.latitude}</td>
                    <td>${data.longitude}</td>
                    <td>${data.recorded_at}</td>
                    <td>${data.persentase_bahan_bakar} %</td>
                    <td><button class="btn btn-primary" onclick="goToDetectionPage('${data.id}')">Details</button></td>
                `;
            } else {
                // Append new row to the table
                var newRow = `
                    <tr>
                        <td>${data.no}</td>
                        <td>${data.latitude}</td>
                        <td>${data.longitude}</td>
                        <td>${data.recorded_at}</td>
                        <td>${data.persentase_bahan_bakar} %</td>
                        <td><button class="btn btn-primary" onclick="goToDetectionPage('${data.id}')">Details</button></td>
                    </tr>
                `;
                tableBody.innerHTML = newRow + tableBody.innerHTML;
            }

            document.getElementById('fuel-level').textContent = data.persentase_bahan_bakar; // Update fuel level display
        }

        // Function to navigate to detections page
        function goToDetectionPage(id) {
            window.location.href = `/detections`; // Adjust the URL as per your route structure
        }

        // Function to fetch and update GPS data
        function fetchAndSetGPSData() {
            fetch('/api/gps/latest')
                .then(response => response.json())
                .then(data => {
                    updateGPSData(data);
                })
                .catch(error => console.error('Error fetching GPS data:', error));
        }

        // Function to update the GPS data display
        function updateGPSData(data) {
            var gpsDataElement = document.getElementById('gps-data');
            gpsDataElement.innerHTML = `
                <p>Latitude: ${data.latitude}</p>
                <p>Longitude: ${data.longitude}</p>
                <p>Recorded At: ${data.recorded_at}</p>
            `;
        }

        // Set interval to update fuel level data every 5 seconds
        setInterval(fetchAndSetFuelLevel, 5000);

        // Set interval to update GPS data every 5 seconds
        setInterval(fetchAndSetGPSData, 5000);
    </script>
</body>

</html>
