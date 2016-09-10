@extends ('layouts.dashboard')
@section('page_heading','New List')
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


        ​

    </style>
    <div class="col-sm-8 text-left">


        {{ Form::open(array('url' => '/list/new', 'method'=>'post')) }}


        {{ Form::text('name', '', array('placeholder'=>'Type list name here'))}}
        <br><br>

        {{ Form::text('desc', '', array('placeholder'=> 'Type list description here'))}}
        <br><br>

        {{Form::submit('Add List')}}
        {{ Form::close() }}



    </div>


@stop
