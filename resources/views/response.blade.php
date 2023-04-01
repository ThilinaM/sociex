<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Rashi The Coach</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    @yield('styles')
</head>
    <body class="antialiased h-100  justify-content-center align-items-center">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-12">

            <div class="">
                <div class="text-center" style="margin-top:100px">
                  {{-- <div><img src="img/logo.png" style="width: 350px;" alt=""></div> --}}


                  <h2><div>ස්තූතියි ඔබට</div>
     <div>Thank you for details</div> 
     <div>விவரம் தந்ததற்கு நன்றி</div></h2>
     
                </div>        
                <br><br>
            </div >

        </div>
        <div class="col-md-12">
            <div class="text-center">                            
<div><label for="" class="text-value-lg"><h4><b>Our Partners</b></h4></label></div></div>
        </div>
        <div class="col-md-12">
            <div class="text-center">                            
                <div><img src="img/partner.png" style="width: 260px" alt=""></div>
        </div>
        </div>
        <div class="col-md-12"><br/>
            <div class="text-center"><h3><b>rashithecoach.com</b></h3></div>
        </div>
    </div>
</div>
            </div>
        </div>
    </body>
    <footer style=" position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;">
       <div class="text-center" style="         left: 0;
       bottom: 0;
       width: 100%;">Design and develop by <a href="https://sociexmedia.com">Sociex Media</a></div> 
    </footer>
</html>
