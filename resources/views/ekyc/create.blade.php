<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>{{ $title }}</title>
    <style>
        /* Custom styles for enhanced professionalism */
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
        }

        .text-primary {
            color: #007bff !important;
        }

        .min-vh-100 {
            min-height: 100vh;
        }

        /* Ensure responsiveness */
        @media (max-width: 576px) {
            .card-body {
                padding: 1.5rem !important;
            }

            .card-title {
                font-size: 1.5rem !important;
            }
        }
    </style>
</head>

<body>

    <div class="container h-100">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-12 col-md-8 col-lg-5">
                <div class="card border-0 shadow-lg rounded-3 animate__animated animate__fadeIn">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="card-title text-center mb-4 fw-bold text-primary">E-KYC Verification</h3>
                        <p class="text-center text-muted mb-4">Complete the form below to initiate your E-KYC process.
                        </p>
                        @include('ekyc.varification')
                        <hr />
                        <button type="button" class="btn btn-secondary px-4"
                            onclick="document.getElementById('userLogoutForm').submit()">Logout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <form action="{{ route('retailer.logout') }}" method="post" id="userLogoutForm">
        @csrf
    </form>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js">
    </script>

</body>

</html>
