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
    @endforeach
</table>
