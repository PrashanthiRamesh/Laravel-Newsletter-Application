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
        .alert{
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

        .err {
            padding: 10px;
            background-color: #f0ad4e; /* Red */
            color: white;
            margin: 0 30% 0 4%;
            font-size: 20px;
        }

    </style>

    <body>

    @if($errors->any())
        @foreach ($errors->all() as $error)
            <div class="err">{{ $error }}</div>
        @endforeach
        <br>
    @endif




    {{Form::open(array('url'=> URL::to('subscribe/submit'),'method' => 'post'))}}

    {{Form::text('name',null,array('placeholder'=>'Type your Name here'))}}
    <br><br>
    {{Form::text('email',null,array('placeholder'=>'Type your E-mail address here'))}}
    <br><br>
    {{Form::submit('Subscribe')}}

    {{Form::close()}}
    <br><br>
    @if($success = \Illuminate\Support\Facades\Session::get('sub_add'))
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>Success!</strong> {{ $success }}
        </div>
    @endif
    </body>
@stop