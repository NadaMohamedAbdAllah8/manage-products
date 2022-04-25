<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 9 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html>
<!--begin::Head-->

<head>
          <base href="">
          <meta charset="utf-8" />
          <title>Manage Products | @yield('title')</title>
          <meta name="description" content="Manage Products" />
          <meta name="viewport" content="width=device-width, initial-scale=1">

          {{-- styles --}}

          <!-- Latest compiled and minified CSS -->
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

          <!-- jQuery library -->
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

          <!-- Latest compiled JavaScript -->
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

          <link rel="stylesheet"
                    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

          <link href="{{ asset('assets/css/pages_style.css') }}" rel="stylesheet" type="text/css" />

          @yield('styles')

</head>

<body>
          @include('inc.messages')

          @yield('content')

          {{-- scrips --}}
          <script type=" text/javascript" src="{{ asset('assets/js/make-input-read-only.js') }}"></script>
          @yield('scripts')
</body>