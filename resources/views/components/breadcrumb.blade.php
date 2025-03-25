<ol class="breadcrumb float-sm-right">
    @foreach ($metadata['breadcrumbs'] as $breadcrumb)
        <li @class([
            'breadcrumb-item',
            'active' => $loop->last
        ])>
            @if (!$loop->last)
                <a href="{{ route($breadcrumb['route']) }}">{{ $breadcrumb['name'] }}</a>
            @else
                {{ $breadcrumb['name'] }}
            @endif
        </li>
    @endforeach
</ol>