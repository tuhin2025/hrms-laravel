{{--<nav>--}}
{{--    <ol class="breadcrumb mb-0">--}}

{{--        @foreach($items as $item)--}}

{{--            @if(isset($item['url']))--}}
{{--                <li class="breadcrumb-item">--}}
{{--                    <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>--}}
{{--                </li>--}}
{{--            @else--}}
{{--                <li class="breadcrumb-item active">--}}
{{--                    {{ $item['label'] }}--}}
{{--                </li>--}}
{{--            @endif--}}

{{--        @endforeach--}}

{{--    </ol>--}}
{{--</nav>--}}

<div class="px-3 py-2 mb-0 rounded-3 shadow-sm"
     style="background: linear-gradient(135deg, #4e73df, #1cc88a);">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">

            @foreach($items as $item)

                @if(isset($item['url']))
                    <li class="breadcrumb-item">
                        <a href="{{ $item['url'] }}" class="text-white text-decoration-none">
                            {{ $item['label'] }}
                        </a>
                    </li>
                @else
                    <li class="breadcrumb-item active text-white fw-bold">
                        {{ $item['label'] }}
                    </li>
                @endif

            @endforeach

        </ol>
    </nav>

</div>
