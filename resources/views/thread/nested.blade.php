<table border="1">
    <tr>
        <td>Title</td>
        <td>Description</td>
    </tr>
    @foreach ($threads as $thread)
        <tr>
            <td>{{ $thread->title }}</td>
            <td>{{ $thread->description }}</td>
        </tr>

        <tr>
            <td colspan="2">
                <table>
                    @foreach ($thread->comments as $comment)
                        <tr>
                            <td>{{ $comment->message }}</td>
                        </tr>
                        @endforeach
                </table>
            </td>
    @endforeach
</table>
