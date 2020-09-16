
@if($tweet->user->id != current_user()->id && !$tweet->isSharedBy(current_user()))
<form action="{{ route('tweet.share', $tweet->id) }}" method="POST">
    @csrf
    <div id="share-content" style="cursor:pointer">
        <button type="submit">
            <i class="far fa-share-square"></i>
        </button>
    </div>
</form>
@endif
