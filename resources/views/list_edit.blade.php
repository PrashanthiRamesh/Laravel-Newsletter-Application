@extends ('layouts.dashboard')
@section('page_heading','Edit List')
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
            margin: 0 0% 0 4%;
            font-size: 18px
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
    <div class="col-sm-8 text-left">

        {{ Form::open(array('url' => '/list/edit/{id}', 'method'=>'post')) }}

        {{ Form::hidden('id', $list->id) }}
        {{ Form::label('List Name') }}<br><br>
        {{ Form::text('name', $list->name, array('placeholder'=>'Type list Name here'))}}
        <br><br>
        {{ Form::label('List Description') }}<br><br>
        {{ Form::text('desc', $list->description, array('placeholder'=>'Type list describtion here'))}}
        <br><br>

        {{Form::submit('Edit List')}}
        {{ Form::close() }}
<br><br>

        @if($success = \Illuminate\Support\Facades\Session::get('message'))
            <div class="alert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>Success!</strong> {{ $success }}
            </div>
@endif
    </div>
@stop
