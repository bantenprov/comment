<div>

<a href="{{ route('commentIndex') }}">List</a>
<hr>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session()->has('message'))
    <li>{{ session()->get('message') }}</li>
@endif
{!! Form::open(['route' => ['commentStore',$task->id],'method' => 'post','files' => true]) !!}

    <table>
        <tr>
            <td>Task name</td>
            <td>
                <b>{{ $task->name }}</b>
            </td>
        </tr> 
        <tr>
            <td>Title</td>
            <td>
                {!! Form::text('title') !!}
            </td>
        </tr> 
        <tr>
            <td valign="top">Comment</td>
            <td>
                {!! Form::textarea('comment') !!}
            </td>
        </tr>    
        <tr>
            <td valign="top">Url</td>
            <td>
                {!! Form::text('url') !!}
            </td>
        </tr>  
        <tr>
            <td valign="top">File</td>
            <td>
                {!! Form::file('file') !!}
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>            
                {!! Form::submit('submit') !!}                
            </td>
        </tr>
    </table>    
     
{!! Form::close() !!}

</div>