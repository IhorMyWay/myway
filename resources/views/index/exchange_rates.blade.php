<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        html,
        body,
        .intro {
            height: 100%;
        }

        table td,
        table th {
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        thead th,
        tbody th {
        }

        tbody td {
            font-weight: 500;
        }

        .card {
            border-radius: .5rem;
        }
    </style>
</head>
<body>
<section class="intro">
    <div>
        <div class="mask d-flex align-items-center h-100" style="background-color: #718096;">
            <div class="container">
                <div class="row">
                    <a href="{{ route('index') }}"><button style="background: white; color: black">Go to main page</button></a>
                </div>
                <div class="row" style="color: white">
                    <div class="col-12">
                        <div class="card bg-dark shadow-2-strong">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-dark table-borderless mb-0">
                                        <thead>
                                            <th rowspan="5">Bank name: {{ $name }}</th>
                                            @if($period === 'day' )
                                                <th><a href="{{ route('bank.courses', [$name, 'week']) }}"><button style="background: white; color: black">History for week</button></a></th>
                                                <th><a href="{{ route('bank.courses', [$name, 'month']) }}"><button style="background: white; color: black">History for month</button></a></th>
                                            @elseif($period == 'week')
                                                <th><a href="{{ route('bank.courses', [$name, 'day']) }}"><button style="background: white; color: black">History for day</button></a></th>
                                                <th><a href="{{ route('bank.courses', [$name, 'month']) }}"><button style="background: white; color: black">History for month</button></a></th>
                                            @else
                                                <th><a href="{{ route('bank.courses', [$name, 'day']) }}"><button style="background: white; color: black">History for day</button></a></th>
                                                <th><a href="{{ route('bank.courses', [$name, 'week']) }}"><button style="background: white; color: black">History for week</button></a></th>
                                            @endif

                                            @if($dateFromAndTo)
                                                <th> History from {{ $dateFromAndTo['from'] }} to {{ $dateFromAndTo['to'] }}</th>
                                            @else
                                                <th> History for: {{ $today }}</th>
                                            @endif

                                        </thead>
                                        <tbody>
                                            <tr class="header">
                                                <td><b>Currency</b></td>
                                                <td><b>Buy grn</b></td>
                                                <td><b>Sale grn</b></td>
                                                <td><b>Date and time</b></td>
                                            </tr>
                                        @foreach($rates as $key => $rate)

                                            @foreach($rate as $v)
                                            <tr>
                                                <td><b>{{ $key }}</b></td>
                                                <td>{{ $v->buy }}</td>
                                                <td>{{ $v->sale }}</td>
                                                <td>{{ $v->created_at }}</td>
                                            </tr>
                                            @endforeach

                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
