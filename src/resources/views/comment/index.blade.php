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

<table border='1'>

    <tr>
        <td>#</td>
        <td>Task name</td>
        <td>Comment Title</td> 
        <td>Action</td>       
    </tr>

    @forelse($comments as $key => $comment)
        {{--  @foreach($comment->getTask as $task)  --}}
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $comment->getTask->name }}</td>
            <td>{{ $comment->title }}</td>            
            <td> <a href="{{ route('commentShow',$comment->id) }}">View</a> </td>
        </tr>
        {{--  @endforeach  --}}
    @empty
        <tr>
            <td colspan="3">No results</td>
        </tr>
    @endforelse

</table>

</div>