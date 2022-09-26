<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">

    <meta name="csrf-token" content="@php echo csrf_token(); @endphp">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">

<link href="{{asset('html/img/favicon.ico')}}" rel="icon">

    <meta name="author" content="">
   <title>Collect Usdt</title>
    <link rel="stylesheet" href="{{ asset('collect-usdt/css/bootstrap.min.css')}}">

    @auth
    <link rel="stylesheet" href="{{ asset('collect-usdt/css/sb-admin-2.css')}}">
    @endauth
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }
    </style>
</head>