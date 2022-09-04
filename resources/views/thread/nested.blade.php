@include('index')

@foreach ($threads as $thread)
    <div>
        <b>{{ $thread->title }}, {{ $thread->description }}</b>
        @foreach ($thread->comments as $comment)
            <div style="margin-left: 20px">
                <x-reply-component :comment="$comment" />
            </div>
        @endforeach
    </div>
@endforeach
