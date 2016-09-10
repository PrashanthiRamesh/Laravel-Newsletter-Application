@extends('layouts.dashboard')
@section('page_heading','Subscribe to Newsletters')

@section('section')
    <style>


        input{
            font-size:18px
        }
        input[type=text] {
            width: 50%;
            margin: 0 30% 0 4%;
            -webkit-transition: width 0.4s ease-in-out;
            transition: width 0.4s ease-in-out;
        }

        input[type=text]:focus {
            width: 90%;
        }
        form input[type="submit"] {
            margin: 0 30% 0 4%;
            background-color: #ce8483;
            border: none;
            color: white;
            padding: 16px 32px;
            text-decoration: none;
            cursor: pointer;

        }
        form input[type="submit"]:hover {
            background-color: #ff6666;

        }


    </style>

    <body>

    @foreach($errors->all() as $error)
        <p>
            {{$error}}
        </p>
    @endforeach




    {{Form::open(array('url'=> URL::to('subscribe/submit'),'method' => 'post'))}}

    {{Form::text('name',null,array('placeholder'=>'Type your Name here'))}}
    <br><br>
    {{Form::text('email',null,array('placeholder'=>'Type your E-mail address here'))}}
    <br><br>
    {{Form::submit('Subscribe')}}

    {{Form::close()}}

    </body>
@stop