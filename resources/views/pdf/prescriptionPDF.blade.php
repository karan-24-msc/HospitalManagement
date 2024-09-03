<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription PDF</title>
    <style>
        /* Basic reset */
        body, h1, h2, h3, p {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            padding: 20px;
            line-height: 1.6;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #000;
            padding: 20px;
        }

        .header, .footer {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin-bottom: 10px;
            font-size: 24px;
            font-weight: bold;
        }

        .header p {
            font-size: 14px;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h2 {
            margin-bottom: 10px;
            font-size: 18px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }

        .section p {
            font-size: 14px;
        }

        .info-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 8px;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        .info-table td.label {
            font-weight: bold;
            background-color: #f4f4f4;
        }

        .medicine-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .medicine-table th, .medicine-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 14px;
        }

        .medicine-table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Hospital Information -->
    <div class="header">
        <h1>{{ $information->name }}</h1>
        <p>{{ $information->address }}</p>
        <p>Phone: {{ $information->contact }} | Email: {{ $information->email }}</p>
    </div>

    <!-- Patient Information -->
    <div class="section">
        <h2>Patient Information</h2>
        <table class="info-table">
            <tr>
                <td class="label">Name:</td>
                <td>{{ $patientPrescription->patientInfo->name }}</td>
                <td class="label">Age:</td>
                <td>{{ $patientPrescription->patientInfo->age }}</td>
            </tr>
            <tr>
                <td class="label">Gender:</td>
                <td>{{ $patientPrescription->patientInfo->gender }}</td>
                <td class="label">Date:</td>
                <td>{{ \Carbon\Carbon::parse($patientPrescription->date)->format('Y-m-d') }}</td>
            </tr>
            <tr>
                <td class="label">Patient ID:</td>
                <td>{{ $patientPrescription->patientInfo->registration_no }}</td>
                <td class="label">Doctor:</td>
                <td>{{ $patientPrescription->patientInfo->doctor->name }}</td>
            </tr>
        </table>
    </div>

    <!-- Disease Description -->
    <div class="section">
        <h2>Disease Description</h2>
        <p>{{ $patientPrescription->disease_description }}</p>
    </div>

    <!-- Clinical Diagnosis -->
    <div class="section">
        <h2>Clinical Diagnosis</h2>
        <p>{{ $patientPrescription->clinical_diagnosis }}</p>
    </div>

    <!-- Advice -->
    <div class="section">
        <h2>Advice</h2>
        <p>{{ $patientPrescription->advice }}</p>
    </div>

    <!-- Medicines -->
    <div class="section">
        <h2>Medicines</h2>
        <table class="medicine-table">
            <thead>
            <tr>
                <th>Medicine Name</th>
                <th>Frequency</th>
                <th>Time</th>
                <th>Duration</th>
            </tr>
            </thead>
            <tbody>
            @foreach($medicines as $medicine)
                <tr>
                    <td>{{ $medicine->name }}</td>
                    <td>{{ $medicine->take }} times a day</td>
                    <td>{{ $medicine->time }}</td>
                    <td>5 days</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


</div>
</body>
</html>
