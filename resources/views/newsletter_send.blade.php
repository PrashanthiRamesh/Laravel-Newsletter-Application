@extends ('layouts.dashboard')
@section('page_heading','Select List(s)')
@section('section')

    <style>

        form input[type="submit"] {
            background-color: #ce8483;
            color: white;
            padding: 14px 20px;
            margin:2% 25% 0 35%;
            border: none;
            cursor: pointer;
            width: 200px;
            top: 70px;


        }

        form input[type="checkbox"] {

            padding: 14px 20px;
            margin: 8px 0;

            cursor: pointer;
            width: 200px;

            position: relative;

            left: 100px;

        }

        .alert {
            padding: 20px;
            background-color: #d43f3a; /* Red */
            color: white;
            margin: 0 30% 0 4%;
            font-size: 20px;
            position: relative;
        }
        .alert_sent {
            padding: 20px;
            background-color: #2ab27b; /* Red */
            color: white;
            margin: 0 30% 0 4%;
            font-size: 20px;
            position: relative;
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


        {{ Form::open(array('url' => '/newsletter/send', 'method'=>'post')) }}
        {{ Form::hidden('newsletter_id', $newsletterid) }}
        @foreach ($lists as $list)

            {{ Form::checkbox('list[]',$list->id) }} &nbsp {{$list->name}}

            <br>
        @endforeach
        {{Form::submit('Send')}}
        {{ Form::close() }}
        <br><br>

        @if($success = \Illuminate\Support\Facades\Session::get('message_list'))
            <div class="alert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>Damn!</strong> {{ $success }}
            </div>
        @endif
        @if($success = \Illuminate\Support\Facades\Session::get('message_sent'))
            <div class="alert_sent">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>Success!</strong> {{ $success }}
            </div>
        @endif


    </div>
@stop
