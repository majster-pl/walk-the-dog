<div class="dropdown">
    <button class="btn btn-sm btn-success text-white dropdown-toggle" type="button" id="dropdownMenuFilter1"
        data-bs-toggle="dropdown" aria-expanded="false">
        Sort by
        @switch(Request::get('sort'))
            @case('status')
                Status
            @break

            @case('title')
                Tilte
            @break

            @case('address_city')
                City
            @break

            @case('created_at')
                Newest
            @break

            @default
        @endswitch
    </button>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuFilter1">
        <li><a class="dropdown-item {{ Request::get('sort') == 'title' ? 'active' : '' }}"
                href="{{ url()->current().'?sort=title' }}">Title</a></li>
        {{-- <li><a class="dropdown-item" href="{{route('places'). '?sort=likes'}}">Likes</a></li> --}}
        <li><a class="dropdown-item {{ Request::get('sort') == 'address_city' ? 'active' : '' }}"
                href="{{ url()->current() . '?sort=address_city' }}">City</a></li>
        <li><a class="dropdown-item {{ Request::get('sort') == 'created_at' ? 'active' : '' }}"
                href="{{ url()->current() . '?sort=created_at' }}">Newest</a></li>
        <li><a class="dropdown-item {{ Request::get('sort') == 'status' ? 'active' : '' }}"
                href="{{ url()->current() . '?sort=status' }}">Status</a>
    </ul>
</div>
