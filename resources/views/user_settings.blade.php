@extends('layouts.dashboard')
@section('page_heading','User Settings')

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

    a.password {
        color: #c9302c;
        margin: 0 30% 0 4%;
    }
    ​

</style>
<div class="col-sm-8 text-left">

    {{ Form::open(array('url' => '/settings/user', 'method'=>'post')) }}

    {{ Form::hidden('id', $user->id) }}
    {{ Form::label('Name') }}<br><br>
    {{ Form::text('name', $user->name, array('placeholder'=>'Type user name here'))}}
    <br><br>
    {{ Form::label('Email') }}<br><br>
    {{ Form::text('email', $user->email, array('placeholder'=>'Type user email here'))}}
    <br><br>

    <a class="password" href="{!! route('forgot_password', ['id'=>$user->id]) !!} " onclick="return confirm('A mail will be sent to ur email id. Confirm?')">Forgot Password {{ HTML::image('img/mail-send.png') }}</a>
    <br> <br>
    {{Form::submit('Edit User Details')}}
    {{ Form::close() }}


</div>


@stop