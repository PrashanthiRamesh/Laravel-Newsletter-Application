@extends ('layouts.dashboard')
@section('page_heading','Edit Newsletter')
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

        form textarea{
            margin: 0 30% 0 4%;
        }

    </style>
    <div class="col-sm-8 text-left">

        {{ Form::open(array('url' => '/password/change', 'method'=>'post')) }}

        {{ Form::hidden('id', $user->id) }}
        {{ Form::label('New Password') }}<br><br>
        {{ Form::text('new_password', "", array('placeholder'=>'New Password'))}}
        <br><br>
        {{ Form::label('Confirm Password') }}<br><br>
        {{ Form::text('confirm_password', "", array('placeholder'=>'Retype Password')) }}
        <br><br>

        {{Form::submit('Change Password')}}
        {{ Form::close() }}


    </div>
@stop
