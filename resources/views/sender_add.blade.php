@extends('layouts.dashboard')
@section('page_heading','Add Sender')

@section('section')
    <style>
        input{
            font-size:18px
        }
        input[type=text] {
            width: 80%;
            margin: 0 30% 0 4%;
            -webkit-transition: width 0.4s ease-in-out;
            transition: width 0.4s ease-in-out;
        }

        input[type=text]:focus {
            width: 150%;
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
        form label{
            margin: 0 30% 0 4%;
            font-size:18px

        }

        form input[type="checkbox"]{
            margin: 0 0 0 4%;
            font-size:18px
        }

        ​

    </style>
    <div class="col-sm-8 text-left">
        <p>
            {{ $errors->first('name') }}<br>
            {{ $errors->first('email') }}<br>

            {{ $errors->first('designation') }}
        </p>

        {{ Form::open(array('url' => '/sender/add', 'method'=>'post')) }}


        {{ Form::text('name', '', array('placeholder'=>'Type Name here'))}}
        <br><br>
        {{ Form::text('email', '', array('placeholder'=>'Type a verified email here'))}}
        <br><br>
        {{ Form::text('designation', '', array('placeholder'=>'Type the designation of the sender here'))}}
        <br><br>
        {{Form::submit('Add Sender')}}
        {{ Form::close() }}


    </div>
@stop