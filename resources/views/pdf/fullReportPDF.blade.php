<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report PDF</title>
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

        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .report-table th, .report-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 14px;
        }

        .report-table th {
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
                <td>{{ $patientReport->patientInfo->name }}</td>
                <td class="label">Age:</td>
                <td>{{ $patientReport->patientInfo->age }}</td>
            </tr>
            <tr>
                <td class="label">Gender:</td>
                <td>{{ $patientReport->patientInfo->gender }}</td>
                <td class="label">Date:</td>
                <td>{{ \Carbon\Carbon::parse($patientReport->created_at)->format('Y-m-d') }}</td>
            </tr>
            <tr>
                <td class="label">Patient ID:</td>
                <td>{{ $patientReport->patientInfo->registration_no }}</td>
                <td class="label">Doctor:</td>
                <td>{{ $patientReport->patientInfo->doctor->name }}</td>
            </tr>
        </table>
    </div>

    <!-- Report Sections -->
    <div class="section">
        <h2>Hematology</h2>
        <table class="report-table">
            <thead>
            <tr>
                <th>Test Name</th>
                <th>Count Rate</th>
                <th>Condition</th>
            </tr>
            </thead>
            <tbody>
            @foreach ( json_decode($patientReport->hematology, true)[0] as $section => $tests)
                @foreach ($tests as $test)
                    @if (isset($test['rate']) && isset($test['condition']))
                        <tr>
                            <td>{{ ucwords(str_replace('_', ' ', $section)) }}</td>
                            <td>{{ $test['rate'] }}</td>
                            <td>{{ $test['condition'] }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="3">Incomplete data for section: {{ ucwords(str_replace('_', ' ', $section)) }}</td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Report Sections -->
    <div class="section">
        <h2>Biochemistry</h2>
        <table class="report-table">
            <thead>
            <tr>
                <th>Test Name</th>
                <th>Count Rate</th>
                <th>Condition</th>
            </tr>
            </thead>
            <tbody>
            @foreach ( json_decode($patientReport->biochemistry, true)[0] as $section => $tests)
                @foreach ($tests as $test)
                    @if (isset($test['rate']) && isset($test['condition']))
                        <tr>
                            <td>{{ ucwords(str_replace('_', ' ', $section)) }}</td>
                            <td>{{ $test['rate'] }}</td>
                            <td>{{ $test['condition'] }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="3">Incomplete data for section: {{ ucwords(str_replace('_', ' ', $section)) }}</td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Report Sections -->
    <div class="section">
        <h2>Stool</h2>
        <table class="report-table">
            <thead>
            <tr>
                <th>Test Name</th>
                <th>Count Rate</th>
                <th>Condition</th>
            </tr>
            </thead>
            <tbody>
            @foreach ( json_decode($patientReport->stool, true)[0] as $section => $tests)
                @foreach ($tests as $test)
                    @if (isset($test['rate']) && isset($test['condition']))
                        <tr>
                            <td>{{ ucwords(str_replace('_', ' ', $section)) }}</td>
                            <td>{{ $test['rate'] }}</td>
                            <td>{{ $test['condition'] }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="3">Incomplete data for section: {{ ucwords(str_replace('_', ' ', $section)) }}</td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Report Sections -->
    <div class="section">
        <h2>Urine</h2>
        <table class="report-table">
            <thead>
            <tr>
                <th>Test Name</th>
                <th>Count Rate</th>
                <th>Condition</th>
            </tr>
            </thead>
            <tbody>
            @foreach ( json_decode($patientReport->urine, true)[0] as $section => $tests)
                @foreach ($tests as $test)
                    @if (isset($test['rate']) && isset($test['condition']))
                        <tr>
                            <td>{{ ucwords(str_replace('_', ' ', $section)) }}</td>
                            <td>{{ $test['rate'] }}</td>
                            <td>{{ $test['condition'] }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="3">Incomplete data for section: {{ ucwords(str_replace('_', ' ', $section)) }}</td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Report Sections -->
    <div class="section">
        <h2>Serology</h2>
        <table class="report-table">
            <thead>
            <tr>
                <th>Test Name</th>
                <th>Count Rate</th>
                <th>Condition</th>
            </tr>
            </thead>
            <tbody>
            @foreach ( json_decode($patientReport->serology, true)[0] as $section => $tests)
                @foreach ($tests as $test)
                    @if (isset($test['rate']) && isset($test['condition']))
                        <tr>
                            <td>{{ ucwords(str_replace('_', ' ', $section)) }}</td>
                            <td>{{ $test['rate'] }}</td>
                            <td>{{ $test['condition'] }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="3">Incomplete data for section: {{ ucwords(str_replace('_', ' ', $section)) }}</td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Report Sections -->
    <div class="section">
        <h2>Immunology</h2>
        <table class="report-table">
            <thead>
            <tr>
                <th>Test Name</th>
                <th>Count Rate</th>
                <th>Condition</th>
            </tr>
            </thead>
            <tbody>
            @foreach ( json_decode($patientReport->immunology, true)[0] as $section => $tests)
                @foreach ($tests as $test)
                    @if (isset($test['rate']) && isset($test['condition']))
                        <tr>
                            <td>{{ ucwords(str_replace('_', ' ', $section)) }}</td>
                            <td>{{ $test['rate'] }}</td>
                            <td>{{ $test['condition'] }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="3">Incomplete data for section: {{ ucwords(str_replace('_', ' ', $section)) }}</td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Report Sections -->
    <div class="section">
        <h2>Blood Bank</h2>
        <table class="report-table">
            <thead>
            <tr>
                <th>Test Name</th>
                <th>Count Rate</th>
                <th>Condition</th>
            </tr>
            </thead>
            <tbody>
            @foreach ( json_decode($patientReport->blood_bank, true)[0] as $section => $tests)
                @foreach ($tests as $test)
                    @if (isset($test['rate']) && isset($test['condition']))
                        <tr>
                            <td>{{ ucwords(str_replace('_', ' ', $section)) }}</td>
                            <td>{{ $test['rate'] }}</td>
                            <td>{{ $test['condition'] }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="3">Incomplete data for section: {{ ucwords(str_replace('_', ' ', $section)) }}</td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Report Sections -->
    <div class="section">
        <h2>Histopathology Cytology Report</h2>
        <table class="report-table">
            <thead>
            <tr>
                <th>Test Name</th>
                <th>Count Rate</th>
                <th>Condition</th>
            </tr>
            </thead>
            <tbody>
            @foreach ( json_decode($patientReport->histopathology_cytology, true)[0] as $section => $tests)
                @foreach ($tests as $test)
                    @if (isset($test['rate']) && isset($test['condition']))
                        <tr>
                            <td>{{ ucwords(str_replace('_', ' ', $section)) }}</td>
                            <td>{{ $test['rate'] }}</td>
                            <td>{{ $test['condition'] }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="3">Incomplete data for section: {{ ucwords(str_replace('_', ' ', $section)) }}</td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Report Sections -->
    <div class="section">
        <h2>Microbiology</h2>
        <table class="report-table">
            <thead>
            <tr>
                <th>Test Name</th>
                <th>Count Rate</th>
                <th>Condition</th>
            </tr>
            </thead>
            <tbody>
            @foreach ( json_decode($patientReport->microbiology, true)[0] as $section => $tests)
                @foreach ($tests as $test)
                    @if (isset($test['rate']) && isset($test['condition']))
                        <tr>
                            <td>{{ ucwords(str_replace('_', ' ', $section)) }}</td>
                            <td>{{ $test['rate'] }}</td>
                            <td>{{ $test['condition'] }}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="3">Incomplete data for section: {{ ucwords(str_replace('_', ' ', $section)) }}</td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>


    <!-- Report Sections -->
    <div class="section">
        <h2>Ultra Snow Gram</h2>
        <table class="report-table">
            <thead>
            <tr>
                <th>Details</th>
                <th>Condition</th>
            </tr>
            </thead>
            <tbody>
            @foreach (json_decode($patientReport->ultra_snow_gram, true) as $test)
                @if (isset($test['details']) && isset($test['condition']))
                    <tr>
                        <td>{{ $test['details'] }}</td>
                        <td>{{ $test['condition'] }}</td>
                    </tr>
                @else
                    <tr>
                        <td colspan="2">Incomplete data for section: Ultra Snow Gram</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Report Sections -->
    <div class="section">
        <h2>X-Ray</h2>
        <table class="report-table">
            <thead>
            <tr>
                <th>Details</th>
                <th>Condition</th>
            </tr>
            </thead>
            <tbody>
            @foreach (json_decode($patientReport->x_ray, true) as $test)
                @if (isset($test['details']) && isset($test['condition']))
                    <tr>
                        <td>{{ $test['details'] }}</td>
                        <td>{{ $test['condition'] }}</td>
                    </tr>
                @else
                    <tr>
                        <td colspan="2">Incomplete data for section: Ultra Snow Gram</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Report Sections -->
    <div class="section">
        <h2>ECG</h2>
        <table class="report-table">
            <thead>
            <tr>
                <th>Details</th>
                <th>Condition</th>
            </tr>
            </thead>
            <tbody>
            @foreach (json_decode($patientReport->ecg, true) as $test)
                @if (isset($test['details']) && isset($test['condition']))
                    <tr>
                        <td>{{ $test['details'] }}</td>
                        <td>{{ $test['condition'] }}</td>
                    </tr>
                @else
                    <tr>
                        <td colspan="2">Incomplete data for section: Ultra Snow Gram</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Report Sections -->
    <div class="section">
        <h2>Echo/ETT</h2>
        <table class="report-table">
            <thead>
            <tr>
                <th>Details</th>
                <th>Condition</th>
            </tr>
            </thead>
            <tbody>
            @foreach (json_decode($patientReport->eco_ett, true) as $test)
                @if (isset($test['details']) && isset($test['condition']))
                    <tr>
                        <td>{{ $test['details'] }}</td>
                        <td>{{ $test['condition'] }}</td>
                    </tr>
                @else
                    <tr>
                        <td colspan="2">Incomplete data for section: Ultra Snow Gram</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Report Sections -->
    <div class="section">
        <h2>C.T. Scan</h2>
        <table class="report-table">
            <thead>
            <tr>
                <th>Details</th>
                <th>Condition</th>
            </tr>
            </thead>
            <tbody>
            @foreach (json_decode($patientReport->c_t_scan, true) as $test)
                @if (isset($test['details']) && isset($test['condition']))
                    <tr>
                        <td>{{ $test['details'] }}</td>
                        <td>{{ $test['condition'] }}</td>
                    </tr>
                @else
                    <tr>
                        <td colspan="2">Incomplete data for section: Ultra Snow Gram</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Report Sections -->
    <div class="section">
        <h2>Others</h2>
        <table class="report-table">
            <thead>
            <tr>
                <th>Details</th>
                <th>Condition</th>
            </tr>
            </thead>
            <tbody>
            @foreach (json_decode($patientReport->others, true) as $test)
                @if (isset($test['details']) && isset($test['condition']))
                    <tr>
                        <td>{{ $test['details'] }}</td>
                        <td>{{ $test['condition'] }}</td>
                    </tr>
                @else
                    <tr>
                        <td colspan="2">Incomplete data for section: Ultra Snow Gram</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
