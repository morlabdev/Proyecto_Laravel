@if(Auth::user()->image)
    <img src="{{ route('user.avatar', ['filename'=>Auth::user()->image]) }}" class="rounded-circle float-start"
            height="35" alt="Avatar" loading="lazy" >
@endif
