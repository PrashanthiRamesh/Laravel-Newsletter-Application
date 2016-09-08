<!DOCTYPE html>
<html lang="en">
<head>
    <title>Prango Newsletter</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {
            height: 450px
        }

        /* Set gray background color and 100% height */
        .sidenav {
            padding-top: 20px;
            background-color: #f1f1f1;
            height: 100%;
        }

        /* Set black background color, white text and some padding */
        footer {
            background-color: #555;
            color: white;
            padding: 15px;
        }

        /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }

            .row.content {
                height: auto;
            }

        }

        table {
            border-collapse: separate;
            border-spacing: 0;
            color: #4a4a4d;
            font: 14px/1.4 "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        th,
        td {
            padding: 10px 15px;
            vertical-align: middle;
        }

        thead {
            background: #395870;
            background: linear-gradient(#337ab7, #1f648b);
            color: #fff;
            font-size: 11px;
            text-transform: uppercase;
        }

        th:first-child {
            border-top-left-radius: 5px;
            text-align: left;
        }

        th:last-child {
            border-top-right-radius: 5px;
        }

        tbody tr:nth-child(even) {
            background: #f0f0f2;
        }

        td {
            border-bottom: 1px solid #cecfd5;
            border-right: 1px solid #cecfd5;
        }

        td:first-child {
            border-left: 1px solid #cecfd5;
        }

        tfoot {
            text-align: right;
        }

        tfoot tr:last-child {
            background: #f0f0f2;
            color: #395870;
            font-weight: bold;
        }

        tfoot tr:last-child td:first-child {
            border-bottom-left-radius: 5px;
        }

        tfoot tr:last-child td:last-child {
            border-bottom-right-radius: 5px;
        }

        form {
            width: 100%;
            margin: 0 auto;
        }

        label, input {
            /* in order to define widths */
            display: inline-block;
        }

        label {
            width: 30%;
            /* positions the label text beside the input */
            text-align: right;
        }

        label + input {
            width: 60%;
            /* large margin-right to force the next element to the new-line
               and margin-left to create a gutter between the label and input */

        }

        form input[type="submit"] {
            background-color: #ce8483;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 200px;
            top: 100px;
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
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            {{--<a class="navbar-brand" href="#">Logo</a>--}}
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="/home">Home</a></li>
                <li ><a href="/subscribers">Subscribers</a></li>
                <li class="active"><a href="/newsletters">Newsletters</a></li>
                <li><a href="/lists">Lists</a></li>
                <li><a href="/templates">Templates</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-2 sidenav">

        </div>
        <div class="col-sm-8 text-left">
            <h1>Edit Newsletter</h1>
            <hr>
            {{ Form::open(array('url' => '/newsletter/edit/{id}', 'method'=>'post')) }}

            {{ Form::hidden('id', $newsletter->id) }}
            {{ Form::label('subject', 'Subject:')}}
            {{ Form::text('subject', $newsletter->subject)}}
            <br><br>
            {{ Form::label('body', 'body:')}}
            {{ Form::textarea('body', $newsletter->body, ['size' => '70x10']) }}
            <br>

            {{Form::submit('Edit Newsletter')}}
            {{ Form::close() }}


        </div>
        <div class="col-sm-2 sidenav">

        </div>
    </div>
</div>

<footer class="container-fluid text-center">
    <p></p>
</footer>

</body>
</html>

