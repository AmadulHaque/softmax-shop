    <!DOCTYPE html>
    <html lang="en">
    
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--favicon-->
        <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
        <!-- loader-->
        <!-- Bootstrap CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/app.css" rel="stylesheet">
        <link href="assets/css/icons.css" rel="stylesheet">
        <title>Rukada - Responsive Bootstrap 5 Admin Template</title>
    </head>
    
    <body class="bg-lock-screen">
        <!-- wrapper -->
        <div class="wrapper">
            <div class="authentication-lock-screen d-flex align-items-center justify-content-center">
                <div class="card shadow-none bg-transparent">
                    <div class="card-body p-md-5 text-center">
                        <h2 class="text-white">{{date('H:i A')}}</h2>
                        <h5 class="text-white">{{date('l')}}, {{date('F')}} {{date('m')}}, {{date('Y')}}</h5>
                        <div class="">
                            <img src="{{asset('assets/images/icons/user.png')}}" class="mt-5" width="120" alt="" />
                        </div>
                        <p class="mt-2 text-white">Administrator</p>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3 mt-3">
                                <input type="email" name="email" required class="form-control" placeholder="Email" />
                            </div>
                            <div class="mb-3 mt-3">
                                <input type="password" name="password" required class="form-control" placeholder="Password" />
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-white">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end wrapper -->
    </body>
    
    </html>






