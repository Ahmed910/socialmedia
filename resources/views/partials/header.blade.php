<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{route('blog.index')}}">Posts-Comments</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <audio id="play"><source src="{{ asset('sounds/chat.mp3') }}" type="audio/mp3"></audio>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{route('blog.index')}}">Blog <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('other.about')}}">About</a>
      </li>

      @if(!Auth::check())

      <li class="nav-item active">
      <a class="nav-link" href="{{ url('/login') }}">Login <span class="sr-only">(current)</span></a>

      </li>
      <li class="nav-item active">
      <a class="nav-link" href="{{ url('/register') }}">Register <span class="sr-only">(current)</span></a>

      </li>
      @else

      <li class="nav-item active">
        <a class="nav-link active" href="{{route('admin.index')}}">Posts <span class="sr-only">(current)</span></a>
      </li>

      <notify-users :userid="{{ auth()->id() }}" :unreadnotifcation="{{ auth()->user()->unreadNotifications }}"></notify-users>
      <li class="nav-item active">
                <a class="nav-link" href="{{ url('/logout') }}"
                    onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                                     Logout
                             </a>

           <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                   {{ csrf_field() }}
                     </form>
     </li>
     @endif
    </ul>

  </div>
</nav>
