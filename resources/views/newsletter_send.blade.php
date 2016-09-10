@extends ('layouts.dashboard')
@section('page_heading','Select List(s)')
@section('section')

    <style>

        form input[type="submit"] {
            background-color: #ce8483;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 200px;
            top: 70px;
            position: relative;

            left: 200px;

        }

        form input[type="checkbox"] {

            padding: 14px 20px;
            margin: 8px 0;

            cursor: pointer;
            width: 200px;

            position: relative;

            left: 100px;

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
        <p></p>
    </div>
@stop
