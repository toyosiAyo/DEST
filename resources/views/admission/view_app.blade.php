<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Application Information</title>
    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 12px;
            line-height: 1.6;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th,
        td {
            border: 1px solid #444;
            padding: 8px;
            text-align: left;
        }

        .section-title {
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <h2>Basic Information</h2>

    <table>
        <tr>
            <th>Full Name</th>
            <td>{{ $application->surname . ' ' . $application->first_name . ' ' . $application->other_name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $application->email }}</td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>{{ $application->phone }}</td>
        </tr>
        <tr>
            <th>Date of Birth</th>
            <td>{{ $application->dob }}</td>
        </tr>
        <tr>
            <th>Gender</th>
            <td>{{ $application->gender }}</td>
        </tr>
        <tr>
            <th>City of Residence</th>
            <td>{{ $application->city_resident }}</td>
        </tr>
        <tr>
            <th>State of Origin</th>
            <td>{{ $application->state_origin }}</td>
        </tr>
        <tr>
            <th>Nationality</th>
            <td>{{ $application->country_resident }}</td>
        </tr>
        <tr>
            <th>Religion</th>
            <td>{{ $application->religion }}</td>
        </tr>
        {{-- <tr>
            <th>Physical Disability</th>
            <td>{{ $application->disability ? 'Yes' : 'No' }}</td>
        </tr> --}}
    </table>

    <h3 class="section-title">Next of Kin</h3>
    <table>
        <tr>
            <th>Name</th>
            <td>{{ $application->nok_name }}</td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>{{ $application->nok_phone }}</td>
        </tr>
        <tr>
            <th>Relationship</th>
            <td>{{ $application->nok_relationship }}</td>
        </tr>
        <tr>
            <th>Address</th>
            <td>{{ $application->nok_address }}</td>
        </tr>
    </table>

    <h3 class="section-title">Sponsor</h3>
    <table>
        <tr>
            <th>Name</th>
            <td>{{ $application->sponsor_name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $application->sponsor_email }}</td>
        </tr>
    </table>

    <h3 class="section-title">Application Details</h3>
    <table>
        <tr>
            <th>Application Type</th>
            <td>{{ $application->app_type }}</td>
        </tr>
        <tr>
            <th>First Choice</th>
            <td>{{ $application->Programme1 }}</td>
        </tr>
        <tr>
            <th>Second Choice</th>
            <td>{{ $application->Programme2 }}</td>
        </tr>
        <tr>
            <th>Screening Date/Center</th>
            <td>{{ $application->screen_date . ' (' . $application->screen_center . ')' }}</td>
        </tr>
    </table>
</body>

</html>
