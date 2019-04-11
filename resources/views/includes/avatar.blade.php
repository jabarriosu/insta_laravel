@if(Auth::user()->imagen)
<div class="container-avatar">
    <img src="{{ route('user.avatar',['img_nombre' => Auth::user()->imagen]) }}" class="avatar" alt="Avatar">
</div>
@endif