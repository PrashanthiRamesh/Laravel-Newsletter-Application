@extends ('layouts.dashboard')
@section('page_heading','New Newsletter')
@section('section')

    <style>

        ​ input{
            font-size:18px
        }
        input[type=text] {
            width: 80%;
            margin: 0 30% 0 4%;
            -webkit-transition: width 0.4s ease-in-out;
            transition: width 0.4s ease-in-out;
        }

        input[type=text]:focus {
            width: 140%;
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
        form textarea {
            margin: 0 30% 0 4%;

        }


    </style>
    <div class="col-sm-8 text-left">

        {{ Form::open(array('url' => '/newsletter/new', 'method'=>'post')) }}


        {{ Form::text('subject', '', array('placeholder'=>'Type the subject here'))}}
        <br><br>

        {{ Form::textarea('body', '', ['size' => '71x18','placeholder'=>'Type the body of the newsletter here']) }}
        <br><br>

        {{Form::submit('Add Newsletter')}}
        {{ Form::close() }}



    </div>


@stop
