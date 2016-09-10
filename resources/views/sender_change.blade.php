@extends('layouts.dashboard')
@section('page_heading','Change Sender')

@section('section')
    <style>
        input {
            font-size: 18px
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

        form label {
            margin: 0 30% 0 4%;
            font-size: 18px

        }

        form input[type="checkbox"] {
            margin: 0 0 0 4%;
            font-size: 18px
        }

        ​

    </style>
    <div class="col-sm-8 text-left">
        {{ Form::open(array('url' => '/sender/change', 'method'=>'post')) }}


        @foreach ($senders as $sender)

            @if($sender->selected== true)
                {{ Form::radio('sender[]',$sender->id, true) }} &nbsp {{$sender->email}}
            @else
                {{ Form::radio('sender[]',$sender->id, false) }} &nbsp {{$sender->email}}

            @endif
            <br>
        @endforeach
        <br><br>
        {{Form::submit('Change Sender')}}
        {{ Form::close() }}

    </div>
@stop