<?php
$aadhaarNumber = '';
$transactionId = '';
$showOtpForm = false;
$responseMessage = '';
$ekycView = '';

// API Token (Replace with your actual token)
$bearerToken = 'Bearer eyJhbGciOiJIUzUxMiJ9...'; 

// Aadhaar to Get OTP
if (isset($_POST['getOtp'])) {
    $aadhaarNumber = $_POST['aadhaarNumber'];
    $url = 'https://odfr.agristack.gov.in/farmer-registry-api-od/agristack/v1/api/farmerRegistryEkyc/requestEKycOtp?aadhaarNumber=' . $aadhaarNumber;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: ' . $bearerToken,
        'Accept: application/json',
        'Content-Type: application/json'
    ]);
    $response = curl_exec($ch);
    curl_close($ch);

    if ($response) {
        $result = json_decode($response, true);
        if (isset($result['data'])) {
            $transactionId = $result['data'];
            $showOtpForm = true;
        } else {
            $responseMessage = "<div class='error'>Failed to get Transaction ID. Response: " . $response . "</div>";
        }
    } else {
        $responseMessage = "<div class='error'>Failed to connect to OTP API.</div>";
    }
}

// Validate OTP and Fetch eKYC
if (isset($_POST['validateOtp'])) {
    $transactionId = $_POST['transactionId'];
    $otp = $_POST['otp'];
    $aadhaarNumber = $_POST['aadhaarNumber'];

    $validateUrl = 'https://odfr.agristack.gov.in/farmer-registry-api-od/agristack/v1/api/farmerRegistryEkyc/validateOtpAndGetEkycData';
    $postData = [
        'language' => 'en',
        'verificationType' => 'EMAIL',
        'verificationSource' => null,
        'otp' => $otp,
        'aadhaarNumber' => $aadhaarNumber,
        'transactionId' => $transactionId,
        'isUpdateRequest' => false
    ];

    $ch = curl_init($validateUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: ' . $bearerToken
    ]);
    $validateResponse = curl_exec($ch);
    curl_close($ch);

    if ($validateResponse) {
        $resultData = json_decode($validateResponse, true);

        if (isset($resultData['data'])) {
            $data = $resultData['data'];

            // Extract fields
            $aadhaarName = $data['aadhaarName'] ?? 'N/A';
            $dob = $data['dob'] ?? 'N/A';
            $genderEng = $data['gender']['genderDescEng'] ?? 'N/A';
            $genderHindi = $data['gender']['genderDescLl'] ?? 'N/A';
            $ekycCo = $data['ekycCo'] ?? 'N/A';
            $ekycLoc = $data['ekycLoc'] ?? 'N/A';
            $ekycVtc = $data['ekycVtc'] ?? 'N/A';
            $ekycDist = $data['ekycDist'] ?? 'N/A';
            $ekycState = $data['ekycState'] ?? 'N/A';
            $ekycPincode = $data['ekycPincode'] ?? 'N/A';
            $photoBase64 = $data['ekycPhotoBaseStr'] ?? '';

            // Local Language
            $ekycLLAadhaarName = $data['ekycLLAadhaarName'] ?? 'N/A';
            $ekycLLLoc = $data['ekycLLLoc'] ?? 'N/A';
            $ekycLLVtc = $data['ekycLLVtc'] ?? 'N/A';
            $ekycLLDist = $data['ekycLLDist'] ?? 'N/A';
            $ekycLLState = $data['ekycLLState'] ?? 'N/A';
            $ekycLLPincode = $data['ekycLLPincode'] ?? 'N/A';

            // Prepare A4 Printable view
            $ekycView = "
                        <div class='response'>
                            <h3>✅ eKYC Details</h3>
                            <img src='data:image/jpeg;base64,$photoBase64' alt='Aadhaar Photo' style='max-width:150px;'><br><br>
                            <strong>Name:</strong> $aadhaarName ($ekycLLAadhaarName)<br>
                            <strong>Date of Birth:</strong> $dob<br>
                            <strong>Gender:</strong> $genderEng ($genderHindi)<br>
                            <strong>Care Of:</strong> $ekycCo<br>
                            <strong>Location:</strong> $ekycLoc ($ekycLLLoc)<br>
                            <strong>VTC:</strong> $ekycVtc ($ekycLLVtc)<br>
                            <strong>District:</strong> $ekycDist ($ekycLLDist)<br>
                            <strong>State:</strong> $ekycState ($ekycLLState)<br>
                            <strong>Pincode:</strong> $ekycPincode ($ekycLLPincode)<br>
                        </div>";

        } else {
            $responseMessage = "<div class='error'>Invalid eKYC Data.</div>";
        }
    } else {
        $responseMessage = "<div class='error'>Failed to validate OTP.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>🔒 Aadhaar eKYC Portal</title>
    <style>
        @media print {
            body {
                background: #fff !important;
            }
            .print-hide {
                display: none;
            }
            .response {
                border: none;
                background: #fff;
                color: #000;
            }
            .response img {
                max-width: 200px;
            }
        }
        body {
            background: linear-gradient(to right, #2980b9, #6dd5fa, #ffffff);
            font-family: 'Poppins', sans-serif;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 850px;
            margin: auto;
            background: #fff;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        h2 {
            text-align: center;
            color: #007BFF;
            font-size: 28px;
            margin-bottom: 30px;
        }
        label { font-weight: 600; display: block; margin-bottom: 8px; }
        input[type="text"], input[type="submit"] {
            width: 100%; padding: 14px; margin-bottom: 25px;
            border-radius: 8px; border: 1px solid #ccc; font-size: 16px;
        }
        input[type="submit"] {
            background-color: #007BFF; color: #fff; font-weight: 600;
            transition: background 0.3s; border: none;
        }
        input[type="submit"]:hover { background-color: #0056b3; }
        .response, .error {
            padding: 20px; border-radius: 10px; margin-top: 30px; line-height: 1.8;
        }
        .response { background-color: #e8f8f5; border-left: 6px solid #28a745; }
        .error { background-color: #fbeaea; border-left: 6px solid #dc3545; }
        .photo { text-align: center; margin-bottom: 20px; }
        .photo img {
            max-width: 180px; border-radius: 10px; border: 4px solid #007BFF;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        .footer { text-align: center; margin-top: 50px; color: #555; font-size: 14px; }
        .print-btn { background: green; color: #fff; padding: 10px 20px; cursor: pointer; border-radius: 5px; border: none; }
    </style>
</head>

<body>

<div class="container">
    <h2>🔒 Aadhaar eKYC Verification</h2>

    <?php
    if (!empty($responseMessage)) echo $responseMessage;
    if (!empty($ekycView)) {
        echo $ekycView;
        echo '<div class="print-hide" style="text-align:center; margin-top:20px;">
                <button class="print-btn" onclick="window.print()">🖨️ Print eKYC</button>
              </div>';
    }
    ?>

    <?php if (!$showOtpForm && empty($ekycView)) { ?>
        <form method="POST" class="print-hide">
            <label>📄 Enter Aadhaar Number</label>
            <input type="text" name="aadhaarNumber" maxlength="12" required placeholder="Enter 12-digit Aadhaar Number">
            <input type="submit" name="getOtp" value="📩 Request OTP">
        </form>
    <?php } ?>

    <?php if ($showOtpForm) { ?>
        <form method="POST" class="print-hide">
            <input type="hidden" name="transactionId" value="<?php echo $transactionId; ?>">
            <input type="hidden" name="aadhaarNumber" value="<?php echo $aadhaarNumber; ?>">
            <label>🔑 Enter OTP Received</label>
            <input type="text" name="otp" placeholder="Enter 6-Digit OTP" required>
            <input type="submit" name="validateOtp" value="✅ Validate OTP & Fetch eKYC">
        </form>
    <?php } ?>

</div>

<div class="footer print-hide">© 2025 Manisha Technology - Aadhaar eKYC Portal</div>

</body>
</html>
