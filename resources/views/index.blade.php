@auth
    <a href="{{ route('thread.view') }}">Thread view</a> |
    <a href="{{ route('thread.view.nested') }}">Thread view nested</a> |

    <a href="{{ route('logout') }}">Logout</a>
@else
    <a href="{{ route('redirect') }}">Log in</a>
@endauth
