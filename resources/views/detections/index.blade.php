<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detections Table</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        /* Common styles */
        body {
            background-color: #ffffff;
            /* White background color */
            /* Brown text color */
            position: relative;
            /* Make body position relative */
            overflow-x: hidden;
            /* Hide horizontal overflow */
        }

        /* Background image with reduced blur */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('images/background2.jpg') }}');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            /* Ensure the background covers the entire screen */
            opacity: 0.9;
            z-index: -1;
            filter: blur(2px);
            /* Blur effect */
        }


        .dashboard-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 30px;
            padding: 20px;
            border: 5px solid #244B93;
            /* Brown border color */
            border-radius: 10px;
            background-color: #ffffff;
            /* White background color for container */
            width: 100%;
            /* Ensure full width */
            max-width: 1200px;
            /* Limit maximum width */
            margin-left: auto;
            /* Center container horizontally */
            margin-right: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #244B93;
            /* Brown border color */
            padding: 8px;
            text-align: left;
            font-size: 16px;
        }

        th {
            background-color: #3FA2F6;
            /* Brown background color for headers */
            color: #ffffff;
            /* White text color */
        }

        td {
            background-color: #ffffff;
            /* White background color for cells */
            color: #244B93;
            /* Brown text color */
        }

        /* Navbar styles */
        .navbar-custom {
            background-color: #1089FF;
            /* Brown background color */
            color: #ffffff;
            /* White text color */
            padding: 10px 20px;
            /* Add padding to navbar */
        }

        .navbar-custom .navbar-brand {
            color: #ffffff;
            /* White brand (logo) text color */
        }

        .navbar-custom .navbar-nav .nav-link {
            color: #ffffff;
            /* White nav links text color */
        }

        .navbar-custom .navbar-nav .nav-link:hover,
        .navbar-custom .navbar-nav .nav-link:focus {
            color: #ffffff;
            /* White nav links text color on hover or focus */
        }

        .action-button {
            background-color: #009EFF;
            /* Brown background color */
            color: white;
            /* White text color */
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            display: flex;
            align-items: center; /* Center items vertically */
        }

        .action-button i {
            margin-right: 5px; /* Add space between icon and text */
        }

        .action-button:hover {
            background-color: #009EFF;
            /* Darker brown background color on hover */
        }

        /* Footer styles */
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #96C9F4;
            /* Brown background color */
            color: #ffffff;
            /* White text color */
            padding: 10px 20px;
            /* Add padding to footer */
            text-align: center;
        }

        footer button {
            background-color: transparent;
            /* Transparent background */
            border: none;
            /* No border */
            color: #0f0f0f;
            /* White text color */
            cursor: pointer;
            display: flex;
            align-items: center; /* Center items vertically */
        }

        footer button:hover {
            text-decoration: underline;
            /* Underline on hover */
        }
    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script>
        // Function to navigate back
        function goBack() {
            window.history.back();
        }
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="#">Detections Table</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <span class="welcome-message">Welcome, {{ Auth::user()->name }}!</span>
            </li>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-link nav-link"
                    style="font-weight: bold; color: white;">Logout</button>
            </form>
        </ul>
    </nav>
    <div>
        <div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Driver Detected</th>
                        <th>Passenger Detected</th>
                        <th>Belt Status</th>
                        <th>Drowsiness</th>
                        <th>Timestamp</th>
                        <th>Action</th> <!-- Kolom Action ditambahkan di sini -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detections as $detection)
                        <tr data-id="{{ $detection->id }}">
                            <td>{{ $detection->id }}</td>
                            <td>{{ $detection->driver_detected ? 'Yes' : 'No' }}</td>
                            <td>{{ $detection->passenger_detected ? 'Yes' : 'No' }}</td>
                            <td>{{ $detection->belt_status }}</td>
                            <td>{{ $detection->drowsiness_detected }}</td>
                            <td>{{ $detection->created_at }}</td>
                            <td class="action-column">
                                <button class="action-button"
                                    onclick="redirectToDashboard({{ $detection->id }})">
                                    <span>View</span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Tombol navigasi -->
    <footer>
        <button onclick="goBack()">
            <i class="fas fa-arrow-left"></i>
            <span></span>
        </button>
    </footer>
    <script>
        // Function to redirect to dashboard with detection ID
        function redirectToDashboard(detectionId) {
            window.location.href = '/dashboard/' // Adjust URL as per your application's route
        }
    </script>
</body>

</html>
