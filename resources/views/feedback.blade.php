<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Center Startup Hub</title>

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
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-12">

            <div class="">
                <div class="text-center">
                  <div><img src="img/logo.png" style="width: 300px;" alt=""></div>
<div><label for="" class="text-value-lg"><h1><b>Digital Innovation & Entrepreneurship Forum</b></h1></label></div>
<div><label for="" class="text-value-lg"><h3><b>Feed Back</b></h3></label></div>


     
                </div>
                <div class="card-body">
                    <form method="POST" action="feedback" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="event_id">{{ trans('cruds.eventFeedback.fields.event') }}</label>
                            <select class="form-control select2 {{ $errors->has('event') ? 'is-invalid' : '' }}" name="event_id" id="event_id">
                                @foreach($events as $id => $entry)
                                    <option value="{{ $id }}" {{ old('event_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('event'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('event') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventFeedback.fields.event_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="feedback">{{ trans('cruds.eventFeedback.fields.feedback') }}</label>
                            <textarea class="form-control {{ $errors->has('feedback') ? 'is-invalid' : '' }}" name="feedback" id="feedback">{{ old('feedback') }}</textarea>
                            @if($errors->has('feedback'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('feedback') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.eventFeedback.fields.feedback_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                    </div>
                
            </div>

        </div>
    </div>
</div>
            </div>
        </div>
    </body>
    <footer>
        <div class="text-center" style=" position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;">Design and develop by <a href="https://thilinadharmasena.com/">Thilina Dharmasena </a></div> 
    </footer>
</html>
