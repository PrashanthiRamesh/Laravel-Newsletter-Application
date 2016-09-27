@extends ('layouts.dashboard')
@section('page_heading','Subscribers')
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
    .alert{
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

    .err{
        padding: 20px ;
        background-color: #f0ad4e; /* Red */
        color: white;
        margin: 0 30% 0 4%;
        font-size: 20px;
    }
    </style>
                <div class="col-sm-2 sidenav">
                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="err">{{ $error }}</div>
                        @endforeach
                        <br>
                    @endif
                    <table>
                        <thead>
                        <tr>
                            <th scope="col" >ID</th>
                            <th scope="col">Name</th>
                            <th scope="col" colspan="3" >Email</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($subscribers as $subscriber)

                            <tr>

                                <td> {{ $subscriber->id }}</td>
                                <td > {{ $subscriber->name }}</td>
                                <td > {{ $subscriber->email }} </td>
                                {{--<td>  <a href="{!! route('subscriber_edit', ['id'=>$subscriber->id]) !!}">{{ HTML::image('img/Icon_edit.gif') }}</a></td>--}}
                                {{--<td>  <a href="{!! route('subscriber_delete', ['id'=>$subscriber->id]) !!} " onclick="return confirm('Are you sure you want to delete this subscriber ?')">{{ HTML::image('img/delete-icon.gif') }}</a></td>--}}

                            </tr>
                        @endforeach

                        </tbody>

                    </table>
                        <br><br>
                        @if($success = \Illuminate\Support\Facades\Session::get('sub_add'))
                            <div class="alert">
                                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                <strong>Success!</strong> {{ $success }}
                            </div>
                        @endif
                </div>

@stop
