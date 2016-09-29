@extends ('layouts.dashboard')
@section('page_heading','Edit Subscriber')
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

        ​

    </style>
    <div class="col-sm-8 text-left">

        {{ Form::open(array('url' => '/subscriber/edit/{id}', 'method'=>'post')) }}

        {{ Form::hidden('id', $subscriber->id) }}
        {{ Form::label('Subscriber\'s Name' ) }}<br><br>
        {{ Form::text('name', $subscriber->name, array('placeholder'=>'Type subscriber\'s Name here'))}}
        <br><br>
        {{ Form::label('Subscriber\' Email') }}<br><br>
        {{ Form::text('email', $subscriber->email, array('placeholder'=>'Type subscriber\'s Email here'))}}
        <br><br>
        {{ Form::label('lists', 'Lists:')}}<br><br>

        @if(!empty($lists))
            @foreach ($lists as $list)

                @if($subscribtions->where('list_id',$list->id)->all())

                    {{ Form::checkbox('list[]',$list->id, true) }} &nbsp {{$list->name}}
                @else
                    {{ Form::checkbox('list[]',$list->id, false) }} &nbsp {{$list->name}}

                @endif
                <br>
            @endforeach
        @endif

        <br><br>
        {{Form::submit('Edit Subscriber')}}
        {{ Form::close() }}


    </div>
@stop
