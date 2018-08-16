@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li class="text-red">
                {{ $error }}
            </li>
        @endforeach
    </ul>
@endif
