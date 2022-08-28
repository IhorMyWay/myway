<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Laravel</title>
            <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
            <style>
                body {
                    background: #718096;
                    width: 100%;
                    margin: 0 auto;
                }

                .center {
                    display: table;
                    width: 100%;
                    height: 100vh;
                }

                #banks-header {
                    display: table-cell;
                    vertical-align: middle;
                    text-align: center;
                    font-size: 30px;
                }

                .bank-name {
                    font-size: 40px;
                }

            </style>
        </head>
        <body>
            <div class="center">
                <div id="banks-header">
                    <ul class="banks">
                        @foreach($banks as $bank)
                            <a href="{{ route('bank.courses', [$bank->name, 'day']) }}"><button class="bank-name">{{ $bank->name }}</button></a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </body>
    </html>
