@extends ('layouts.dashboard')
@section('page_heading','New List')
@section('section')

    <style>
        form {
            width: 170%;
            margin: 0 auto;
        }

        label, input {
            /* in order to define widths */
            display: inline-block;
        }

        label {
            width: 20%;
            /* positions the label text beside the input */
            text-align: right;
        }

        label + input {
            width: 40%;
            /* large margin-right to force the next element to the new-line
               and margin-left to create a gutter between the label and input */
            margin: 0 30% 0 4%;
        }

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

        /* only the submit button is matched by this selector,
           but to be sure you could use an id or class for that button */
        input + input {
            float: right;
        }

        ​

    </style>
    <div class="col-sm-8 text-left">


        {{ Form::open(array('url' => '/list/new', 'method'=>'post')) }}

        {{ Form::label('name', 'List Name:')}}
        {{ Form::text('name', '')}}
        <br><br>
        {{ Form::label('desc', 'Description:')}}
        {{ Form::text('desc', '')}}
        <br>

        {{Form::submit('Add List')}}
        {{ Form::close() }}



    </div>


@stop
