<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ __('voyager::generic.is_rtl') == 'true' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="none" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="admin login">
    <title>Balouki shop</title>
    <link rel="stylesheet" href="{{ voyager_asset('css/app.css') }}">

    <style>
        body {
            background-image:url('{{ Voyager::image( Voyager::setting("admin.bg_image"), voyager_asset("images/bgc.jpg") ) }}');
            background-color: {{ Voyager::setting("admin.bg_color", "#FFFFFF" ) }};
        }
        body.login .login-sidebar {
            border-top:2px solid {{ config('voyager.primary_color','#22A7F0') }};
        }
        @media (max-width: 767px) {
            body.login .login-sidebar {
                border-top:0px !important;
                border-left:5px solid {{ config('voyager.primary_color','#22A7F0') }};
            }
        }
        body.login .form-group-default.focused{
            border-color:{{ config('voyager.primary_color','#22A7F0') }};
        }
        .login-button, .bar:before, .bar:after{
            background:{{ config('voyager.primary_color','#22A7F0') }};
        }
       
    </style>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
</head>
<body class="login">
<div class="container-fluid">
    <div class="row">
        <div class="faded-bg animated"></div>
        <div class="hidden-xs col-sm-7 col-md-8">
            <div class="clearfix">
                <div class="col-sm-12 col-md-10 col-md-offset-2">
                    <div class="logo-title-container">
                         <h2>Balouki shop</h2>
                    </div> <!-- .logo-title-container -->
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-5 col-md-4 login-sidebar" >

            <div class="login-container">

              <h2>Cr??er un compte</h2>

                <form action="{{ route('register') }}" method="POST" >
                    {{ csrf_field() }}
                    <div class="form-group form-group-default" id="nomGroup">
                        <label>{{ __('Nom') }}</label>
                        <div class="controls">
                            <input id="name" type="text" placeholder="Nom" class="form-control @error('name') is-invalid @enderror"  name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group form-group-default" id="emailGroup">
                        <label>{{ __('Addresse E-Mail') }}</label>
                        <div class="controls">
                            <input type="text" name="email" id="email" value="{{ old('email') }}" placeholder="{{ __('voyager::generic.email') }}" class="form-control" required>
                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group form-group-default" id="telGroup">
                        <label>{{ __(' Telephone') }}</label>

                        <div class="controls">
                            <input id="tel" type="tel" placeholder="T??l??phone" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel') }}" required autocomplete="tel">

                            @error('tel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group form-group-default" id="passwordGroup">
                        <label>Mot de passe</label>
                        <div class="controls">
                            <input type="password" name="password" placeholder="Mot de passe" class="form-control" required>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                    </div>
                    <div class="form-group form-group-default" id="passwordGroup">
                        <label>{{ __('Confirmer Mot de passe') }}</label>

                        <div class="controls">
                            <input id="password-confirm" type="password" placeholder="Confirmer mot de passe" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                   
                    
                    <button type="submit" class="btn btn-block login-button" style="margin-top : -10px">
                        <span class="signingin hidden"><span class="voyager-refresh"></span> Connexion...</span>
                        <span class="signin">Connexion</span>
                    </button>

              </form>

              <div style="clear:both"></div>

              <div class="container">
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
              </div>
            </div> <!-- .login-container -->

        </div> <!-- .login-sidebar -->
    </div> <!-- .row -->
</div> <!-- .container-fluid -->

</body>
</html>

