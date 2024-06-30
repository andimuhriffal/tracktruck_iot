<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Truck Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- My Style -->
    <style>
        body {
            position: relative;
            background: linear-gradient(to right, rgba(255, 0, 0, 0.5), rgba(0, 0, 255, 0.5)), 
                        url('{{ asset('images/background.jpg') }}') no-repeat center center fixed;
            background-size: contain; /* Ensure the entire image is visible */
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Set minimum height to full viewport height */
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3); /* Optional: darken the image */
            backdrop-filter: blur(2px); /* Reduced blur */
            z-index: 0;
        }

        .dashboard-container {
            position: relative;
            z-index: 1;
            margin-top: 50px;
            margin-bottom: 50px;
            padding: 40px;
            border: 8px solid transparent; /* Transparent border */
            border-radius: 15px;
            width: 100%; /* Ensure container takes full width */
            max-width: 1000px; /* Limit maximum width of the container */
        }

        .dashboard-section {
            margin-bottom: 20px;
        }

        .dashboard-section h3 {
            margin-bottom: 30px;
            font-size: 28px;
            color: #f2f6fa;
            text-align: center;
            margin-top: 10px;
        }

        .dashboard-section img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 1px;
        }

        .camera-section {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }

        .camera-section img {
            width: 300%;
            height: 400%;
            object-fit: cover;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .dashboard-section p {
            font-size: 16px;
            color: #ccc;
            margin-bottom: 20px;
        }

        .gauge-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 200px;
            height: 200px;
            margin: auto;
        }

        .fuel-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .fuel-container h3 {
            margin-bottom: 20px;
        }

        #map {
            height: 400px;
            width: 200%;
            margin-bottom: 20px;
            border: 10px solid #007bff;
            border-radius: 10px;
        }

        .nav-link {
            font-weight: bold;
        }

        .navbar-brand {
            margin-right: 1rem;
        }

        .navbar-nav .nav-link {
            padding: 0.5rem 1rem;
            font-size: 1rem;
        }

        @media (max-width: 576px) {
            body {
                background-size: contain; /* Adjust background size for smaller screens */
            }

            .navbar-brand {
                margin-right: 0.5rem;
            }
        }

        .navbar-brand {
            color: black;
            font-weight: bold;
        }
    </style>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- Google Charts and Maps API -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    @stack('scripts')
</head>

<body>

    <div class="container mt-4 dashboard-container">
        @yield('container')
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous">
    </script>

    <script>
        // JavaScript for Google Maps API and Charts will go here
        @stack('inline-scripts')
    </script>
</body>

</html>
