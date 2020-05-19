<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
    <head>
        <meta charset="UTF-8">
        <title>{{ trans('common.brand.title') }}</title>
        <meta name="description" content="">
        <meta name="theme-color" content="#096eb6">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <link href="{{ url('images/favicon.png') }}" rel="shortcut icon" />
        <link rel="stylesheet" href="{{ url('css/app.css') }}">
        @if (isset($styles) && ! empty($styles))
        <link rel="stylesheet" href="{{ url($styles) }}">
        @endif
    </head>

    <body>