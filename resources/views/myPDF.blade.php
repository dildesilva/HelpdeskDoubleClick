<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HelpDesk Report</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 30px;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        header {
            text-align: center;
            margin-bottom: 40px;
        }

        .title {
            font-size: 32px;
            font-weight: bold;
            color: #003366;
            margin: 0;
        }

        .subtitle {
            font-size: 20px;
            color: #555;
            margin: 10px 0 0;
        }

        .report-details .label {
            font-size: 14px;
            font-weight: bold;
            color: #003366;
            text-align: left;
            padding: 10px 0;
        }

        .report-details table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .report-details td,
        .report-details th {
            padding: 12px;
            font-size: 14px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .report-details td {
            background-color: #fafafa;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .data-table th {
            background-color: #003366;
            color: white;
            padding: 12px;
            font-size: 14px;
            text-align: left;
            font-weight: normal;
        }

        .data-table td {
            background-color: #f9f9f9;
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 13px;
        }

        .data-table tr:nth-child(even) td {
            background-color: #f1f1f1;
        }

        .data-table tr:hover td {
            background-color: #e0e0e0;
        }

        .divider {
            border: none;
            border-top: 2px solid #003366;
            margin: 30px 0;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 14px;
            color: #777;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            margin-top: 0;
            padding-bottom: 10px;
        }

        @media (max-width: 768px) {
            .container {
                width: 100%;
                padding: 20px;
            }

            .title {
                font-size: 28px;
            }

            .subtitle {
                font-size: 18px;
            }

            .data-table th,
            .data-table td {
                font-size: 12px;
                padding: 10px;
            }

            .report-details td {
                font-size: 12px;
            }
        }

    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1 class="title">Double Click IT</h1>
            <h2 class="subtitle">HelpDesk Report</h2>
        </header>
        <section class="report-details">
            <table class="report-table">
                <tr>
                    <th class="label">Date:</th>
                    <td>{{$downloadDate}}</td>
                </tr>
                <tr>
                    <th class="label">Week Duration:</th>
                    <td>{{$lastMonday}} to {{$lastSunday}}</td>
                </tr>
                <tr>
                    <th class="label">Name:</th>
                    <td>{{ Auth::user()->name }}</td>
                </tr>
                <tr>
                    <th class="label">E-Mail:</th>
                    <td>{{ Auth::user()->email }}</td>
                </tr>
            </table>
            <hr class="divider">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Sender E-Mail</th>
                        <th>Company</th>
                        <th>Done Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Report as $ticket)
                    <tr>
                        <td>{{ $ticket->subject }}</td>
                        <td>{{ $ticket->sender }}</td>
                        <td>{{ $ticket->company }}</td>
                        <td>{{ $ticket->updated_at->format('Y-m-d') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <footer>
            <p>© 2024 HelpDesk System. All Rights Reserved. Double Click IT.</p>
        </footer>
    </div>
</body>
</html>

