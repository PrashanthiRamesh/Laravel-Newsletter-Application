@extends('layouts.dashboard')
@section('page_heading','Newsletters')

@section('section')
    <style>
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
    </style>
    <div class="col-sm-8 text-left">

        <table>
            <thead>
            <tr>
                <th scope="col" >ID</th>
                <th scope="col" colspan="5" >Subject</th>

            </tr>
            </thead>
            <tbody>

            @foreach ($newsletters as $newsletter)

                <tr>

                    <td> {{ $newsletter->id }}</td>
                    <td > {{ $newsletter->subject }}</td>
                    <td>  <a href="{!! route('newsletter_send', ['id'=>$newsletter->id]) !!} " onclick="return confirm('Are you sure you want to send this newsletter ?')">{{ HTML::image('img/mail-send.png') }}</a></td>
                    <td>  <a href="{!! route('newsletter_preview', ['id'=>$newsletter->id]) !!} ">{{ HTML::image('img/preview.png') }}</a></td>
                    <td>  <a href="{!! route('newsletter_edit', ['id'=>$newsletter->id]) !!}">{{ HTML::image('img/Icon_edit.gif') }}</a></td>
                    <td>  <a href="{!! route('newsletter_delete', ['id'=>$newsletter->id]) !!} " onclick="return confirm('Are you sure you want to delete this newsletter ?')">{{ HTML::image('img/delete-icon.gif') }}</a></td>

                </tr>
            @endforeach

            </tbody>

        </table>

        <p></p>
    </div>
@stop