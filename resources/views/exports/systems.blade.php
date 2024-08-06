<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <!-- First Row: Section Headers -->
            <tr>
                <th colspan="10"></th> <!-- Empty columns before SUPPORT -->
                <th colspan="5" style="text-align: center;">SUPPORT</th>
                <th colspan="2" style="text-align: center;">IMPLEMENTATION DATE</th>
                <th colspan="3" style="text-align: center;">PRODUCTION ENVIRONMENT</th>
                <th colspan="3" style="text-align: center;">DEVELOPMENT ENVIRONMENT</th>
                <th colspan="3" style="text-align: center;">DR/BACK-UP ENVIRONMENT</th>
                <th colspan="2" style="text-align: center;">GIT REPOSITORY</th>
                <th colspan="2" style="text-align: center;">SSI COMPLIANCE</th>
            </tr>
            <!-- Second Row: Actual Headers -->
            <tr>
                <th>NO.</th>
                <th>CODE NAME</th>
                <th>SYSTEM NAME</th>
                <th>OWNER</th>
                <th>RELEASE</th>
                <th>TYPE</th>
                <th>DEPLOYMENT</th>
                <th>LANGUAGE</th>
                <th>FRAMEWORK</th>
                <th>DATABASE</th>
                <th>SECTION</th>
                <th>DEVELOPER</th>
                <th>PRIMARY</th>
                <th>SECONDARY</th>
                <th>TERTIARY</th>
                <th>ORIGINAL</th>
                <th>PORTAL</th>
                <th>URL/PATH</th>
                <th>WEBSERVER</th>
                <th>DATABASE</th>
                <th>URL/PATH</th>
                <th>WEBSERVER</th>
                <th>DATABASE</th>
                <th>URL/PATH</th>
                <th>WEBSERVER</th>
                <th>DATABASE</th>
                <th>NAME</th>
                <th>SERVER</th>
                <th>Status</th>
                <th>Remarks</th>
                <th>Ongoing_activity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($systems as $system)
            <tr>
                <td>{{ $system->id }}</td>
                <td>{{ $system->code_name }}</td>
                <td>{{ $system->system_name }}</td>
                <td>{{ $system->owner }}</td>
                <td>{{ $system->release }}</td>
                <td>{{ $system->type }}</td>
                <td>{{ $system->deployment }}</td>
                <td>{{ $system->language }}</td>
                <td>{{ $system->framework }}</td>
                <td>{{ $system->database }}</td>
                <td>{{ $system->section }}</td>
                <td>{{ $system->developer }}</td>
                <td>{{ $system->primary }}</td>
                <td>{{ $system->secondary }}</td>
                <td>{{ $system->tertiary }}</td>
                <td>{{ $system->original }}</td>
                <td>{{ $system->portal }}</td>
                <td>{{ $system->url_path }}</td>
                <td>{{ $system->webserver }}</td>
                <td>{{ $system->database }}</td>
                <td>{{ $system->url_path }}</td>
                <td>{{ $system->webserver }}</td>
                <td>{{ $system->database }}</td>
                <td>{{ $system->url_path }}</td>
                <td>{{ $system->webserver }}</td>
                <td>{{ $system->database }}</td>
                <td>{{ $system->name }}</td>
                <td>{{ $system->server }}</td>
                <td>{{ $system->ssi_status }}</td>
                <td>{{ $system->remarks }}</td>
                <td>{{ $system->ongoing_activity }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>