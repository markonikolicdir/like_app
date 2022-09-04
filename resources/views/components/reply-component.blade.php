@props(['comment'])

<div>
    {{ $comment->message }}
    @foreach ($comment->children as $child)
        <div style="margin-left: 20px">
            <x-reply-component :comment="$child" />
        </div>
    @endforeach
</div>
