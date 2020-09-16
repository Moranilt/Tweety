@if(current_user()->isNot($user))
<form id="follow-form" action="{{ route('follow', $user->username) }}" method="post" class="my-0">
  @csrf
    <input type="hidden" id="username" name="username" value="{{$user->username}}">
  <button
  type="submit"
  class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs"
  id="follow-btn"
  style="outline:none;"
  >
    {{ current_user()->following($user) ? 'Unfollow Me' : 'Follow Me' }}
  </button>
</form>
@endif
