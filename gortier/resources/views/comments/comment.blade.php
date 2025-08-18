<div>
    <strong>{{ $comment->user->name }}</strong> ({{ $comment->created_at->diffForHumans() }}):
    <p>{{ $comment->body }}</p>
</div>