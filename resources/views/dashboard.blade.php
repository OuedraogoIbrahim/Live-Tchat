<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>

    <style>
        body {
            background-color: #000000;
            color: #ffffff;
        }

        h4 {
            text-align: center;
            font-weight: bold;
            font-style: oblique;
            color: #ffffff;
        }

        h4 span {
            color: red;
            font-size: 18px;
        }

        .messages {

            padding: 20px 0;
            width: 500px;
            margin: auto;
            border: 4px solid brown;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .messages span {
            font-weight: bold;
            font-size: 20px;
        }

        .messages .user a {
            font-style: oblique;
            cursor: pointer;
            text-decoration: none;
            color: #ffffff;
        }

        .messages h2 {
            font-weight: bold;
            font-style: italic;
            font-size: 20px;
            border-bottom: 4px solid wheat;
        }
    </style>
</head>

<body>
    <h4>Profil name : <span>{{ $user->name }} </span></h2>

        <section class="messages">
            @if (isset($no_message))
                <span>{{ $no_message }}</span>
            @else
                <h2>Vos discussions</h2>
                @foreach ($messages_received_by as $m)
                    <span class="user">
                        <a href="{{ route('tchat', ['user' => $m->id]) }}"> {{ $m->name }}</a>
                    </span>
                @endforeach
            @endif
        </section>
</body>

</html>
