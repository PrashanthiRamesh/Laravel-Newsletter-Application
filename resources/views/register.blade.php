<!doctype html>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Subscribe to Newsletter</title>
    <style>
        /*Some Little Minor CSS to tidy up the form*/
        body {
            margin: 0;
            font-family: Arial, Tahoma, sans-serif;
            text-align: center;
            padding-top: 60px;
            color: #666;
            font-size: 18px
        }

        input {
            font-size: 18px
        }

        form {
            border: 3px solid #f1f1f1;
        }

        input[type=text], input[type=password] {
            width: 300px;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        form input[type="submit"] {
            background-color: #ce8483;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 300px;
        }

        .alert {
            padding: 20px;
            background-color: #2ab27b; /* Red */
            color: white;
            margin: 0 30% 0 4%;
            font-size: 20px;
        }

        ​.closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
            cursor: pointer;
        }
    </style>
</head>
<body>
@if($errors->any())
    @foreach ($errors->all() as $error)
        <div class="err">{{ $error }}</div>
    @endforeach
    <br>
@endif

@if($success = \Illuminate\Support\Facades\Session::get('message'))
    <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <strong>Success!</strong> {{ $success }}
    </div>
@endif

{!! csrf_field() !!}
{{ Form::open(array('url' => 'register')) }}
<h2>Register</h2>

<!-- if there are login errors, show them here -->

<p>
    {{ Form::label('name', 'Name') }}<br>
    {{ Form::text('name', '') }}
</p>

<p>
    {{ Form::label('username', 'Username') }}<br>
    {{ Form::text('username', '') }}
</p>

<p>
    {{ Form::label('email', 'Email Address') }}<br>
    {{ Form::text('email', '', array('placeholder' => 'awesome@awesome.com')) }}
</p>

<p>
    {{ Form::label('password', 'Password') }}<br>
    {{ Form::password('password') }}
</p>

<p>
    {{ Form::label('confirm', 'Confirm Password') }}<br>
    {{ Form::password('confirm') }}
</p>

<p>{{ Form::submit('Submit!') }}</p>
{{ Form::close() }}

</body>
</html>

