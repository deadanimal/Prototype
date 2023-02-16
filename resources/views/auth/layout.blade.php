<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prototype</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <style>
        html,
        body {
            font-family: 'Questrial', sans-serif;
            font-size: 14px;
            font-weight: 300;
        }

        .hero.is-success {
            background: #F2F6FA;
        }

        .hero .nav,
        .hero.is-success .nav {
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .box {
            margin-top: 5rem;
        }

        .avatar {
            margin-top: -70px;
            padding-bottom: 20px;
        }

        .avatar img {
            padding: 5px;
            background: #fff;
            border-radius: 50%;
            -webkit-box-shadow: 0 2px 3px rgba(10, 10, 10, .1), 0 0 0 1px rgba(10, 10, 10, .1);
            box-shadow: 0 2px 3px rgba(10, 10, 10, .1), 0 0 0 1px rgba(10, 10, 10, .1);
        }

        input {
            font-weight: 300;
        }

        p {
            font-weight: 700;
        }

        p.subtitle {
            padding-top: 1rem;
        }

        .login-hr {
            border-bottom: 1px solid black;
        }

        .has-text-black {
            color: black;
        }

        .field {
            padding-bottom: 10px;
        }

        .fa {
            margin-left: 5px;
        }
    </style>


</head>

<body>

    @include('sweetalert::alert')


    @yield('content')


</body>

</html>
