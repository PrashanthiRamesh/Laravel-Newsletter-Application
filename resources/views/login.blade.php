<!doctype html>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Subscribe to Newsletter</title>
    <style>
        /*Some Little Minor CSS to tidy up the form*/
        body{
            margin:0;
            font-family:Arial,Tahoma,sans-serif;
            text-align:center;
            padding-top:60px;
            color:#666;
            font-size:24px
        }
        input{
            font-size:18px
        }

        form {
            border: 3px solid #f1f1f1;
        }

        input[type=text], input[type=password] {
            width:300px;
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
            width:300px;
        }


    </style>
</head>
<body>


{{ Form::open(array('url' => 'login')) }}
<h2>Login</h2>

<!-- if there are login errors, show them here -->
<p>
    {{ $errors->first('email') }}
    {{ $errors->first('password') }}
</p>

<p>
    {{ Form::label('email', 'Email Address') }}<br>
    {{ Form::text('email', \Illuminate\Support\Facades\Input::old('email'), array('placeholder' => 'awesome@awesome.com')) }}
</p>
{!! csrf_field() !!}
<p>
    {{ Form::label('password', 'Password') }}<br>
    {{ Form::password('password') }}
</p>

<p>{{ Form::submit('Submit!') }}</p>
{{ Form::close() }}

</body>
</html>

