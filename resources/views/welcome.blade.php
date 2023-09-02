<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>All In Lab</title>

    <!-- Styles -->
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
        }

        /* Optional styles for the image */
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body >
    <img src="{{ asset('images/ALLINLAB1.png') }}" width="200px" alt="Allinlab Image">
</body>
</html>
