<div>

    <table>

        <tr>
            <td>Comment title</td>
            <td>:</td>
            <td>{{ $comment->title }}</td>
        </tr>
        <tr>
            <td>User</td>
            <td>:</td>
            <td>{{ $comment->getUser->name }}</td>
        </tr>
        <tr>
            <td>Task name</td>
            <td>:</td>
            <td> <a href="{{ route('taskShow',$comment->getTask->id) }}">{{ $comment->getTask->name }}</a> </td>
        </tr>
        <tr>
            <td>Comment</td>
            <td>:</td>
            <td>{{ $comment->comment }}</td>
        </tr>
        <tr>
            <td>Url</td>
            <td>:</td>
            <td>{{ $comment->url }}</td>
        </tr>
        <tr>
            <td>File</td>
            <td>:</td>
            <td>{{ $comment->file }} <a href="{{ url('/uploads/'.$comment->file) }}">view file</a></td>
        </tr>

    </table>

</div>