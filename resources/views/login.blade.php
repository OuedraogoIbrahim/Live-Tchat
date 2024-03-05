<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <style>
        body {
            background-color: #000000;
        }

        h1 {
            color: #fff;
            font-style: oblique;
            font-weight: bold;
            font-size: 18px;
            text-align: center;
        }

        h4 {
            color: red;
            font-weight: bold;
            font-style: oblique;
        }

        h5 a {
            color: green;
        }

        form {
            margin: auto;
            width: 400px;
            height: 400px;
            border: 2px solid #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        form input {
            border: unset;
            padding: 10px;
            outline: unset;

        }

        form input:focus {
            border: 2px solid blue;
            border-radius: 6px;
            background-color: aqua;
            font-weight: bold;
        }

        form input::placeholder {
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>

<body>

    <h1> Go to your account </h1>

    <form action="" method="POST">
        @csrf

        <input type="email" name="email" placeholder="Your email" value="{{ old('email') }}">
        @error('email')
            <h4>{{ $message }}</h4>
        @enderror

        <input type="password" name="password" placeholder="Your password">
        @error('password')
            <h4>{{ $message }}</h4>
        @enderror

        <input type="submit" value="Login">

        <h5> <a href="{{ route('register') }}">Create a account ?</a></h5>
    </form>
</body>

</html>
