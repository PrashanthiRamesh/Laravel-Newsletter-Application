<!doctype html>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Subscribe to Newsletter</title>
    <style>

        body{
            margin:0;
            font-family:Arial,Tahoma,sans-serif;
            text-align:center;padding-top:60px;
            color:#666;
            font-size:24px
        }
        input{
            font-size:18px
        }
        input[type=text]{
            width:300px
        }

    </style>
</head>
<body>

    @foreach($errors->all() as $error)
    <p>
        {{$error}}
    </p>
    @endforeach




{{Form::open(array('url'=> URL::to('subscribe/submit'),'method' => 'post'))}}<p>Newsletter Subscription</p>

{{Form::text('name',null,array('placeholder'=>'Type your Name here'))}}
<br><br>
{{Form::text('email',null,array('placeholder'=>'Type your E-mail address here'))}}
<br><br>
{{Form::submit('Subscribe')}}
    <hr>
    <a href="/login" class="large">Login</a>

{{Form::close()}}

</body>
</html>