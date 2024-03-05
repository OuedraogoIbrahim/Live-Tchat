<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <title>Messages</title>

    <style>
        body {
            background-color: #000000;
            color: #ffffff;
        }

        .messages {
            border: 2px solid blue;
            width: 400px;
            margin: auto;
            padding: 20px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
        }

        .message-sent,
        .message-received {
            border: 2px solid yellow;
            transform: translateX(20px);
            position: relative;

            padding: 8px 8px 20px 8px;
            border-radius: 8px;
            min-width: 60%;
            max-width: 80%;
            line-height: 1.6;
        }

        .message-sent {
            border-color: red;
            transform: translateX(-20px);
        }

        .message-sent span,
        .message-received span {
            position: absolute;
            bottom: 0;
            right: 0;
            font-size: 12px;
            font-weight: bold;
            color: green;
        }

        form {
            border: 2px solid blue;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 36px;
        }

        form textarea {
            height: 36px;
            border-radius: 8px;
            font-weight: bold;
            padding: 0 8px;
            resize: none;
            outline: none;
            width: 200px;
            /* overflow: hidden; */
        }

        form textarea::placeholder {
            color: #000000;
            font-weight: bold;
            text-align: center;
        }

        form textarea:focus {
            background-color: aquamarine;
            font-size: 14px;
        }

        input[type="submit"] {
            height: 30px;
            font-weight: bold;
            width: 80px;
        }
    </style>

    <script>
        const id = "{{ $user_id }}";
        const auth = "{{ $auth }}"

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('93ac135e7a198794887d', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('channel' + auth);
        channel.bind('event' + auth, function(data) {
            console.log(data);
            const messages = document.querySelector('.messages');
            const addMessage = document.createElement('div');
            addMessage.textContent = data.data;
            addMessage.classList.add('message-received');
            messages.appendChild(addMessage);
        });
    </script>


</head>

<body>

    <section class="messages">
        @foreach ($messages as $m)
            @if ($m->user_write == Auth::id())
                @php
                    $date = $m->created_at;
                    $date = $date->format('H:i');
                @endphp
                <div class="message-sent">
                    <span>{{ $date }}</span>
                    {{ $m->message }}
                </div>
            @else
                @php
                    $date = $m->created_at;
                    $date = $date->format('H:i');
                @endphp
                <div class="message-received">
                    <span>{{ $date }}</span>
                    {{ $m->message }}
                </div>
            @endif
        @endforeach
    </section>

    <form action="" id="submitted">

        <textarea name="message" id="myTextarea" rows="1" placeholder="Votre message"></textarea>
        <input type="submit" value="Sent">

    </form>

    <span class="{{ 'inactive ' . $user_id }}"></span>
    <script>
        $(document).ready(function() {
            // Sélectionnez le textarea
            var textarea = $('#myTextarea');

            // Lorsque le contenu du textarea change
            textarea.on('input', function() {
                // Ajustez la hauteur du textarea en fonction de son contenu
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
        });
    </script>
    <script src="{{ asset('message.js') }}"></script>
</body>

</html>
