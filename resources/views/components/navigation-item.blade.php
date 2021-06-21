@if (!$admin || ($admin && Auth::user() && Auth::user()->is_administrator))
    @if (\array_key_exists('children', $navigation) && count($navigation['children']) > 0)
        @php
        $active = false;

        $queue = [];
        $children = [];
        foreach ($navigation['children'] as $child) {
            $children[] = $child;
            $queue[] = $child;
        }

        while(!$active && count($queue) > 0) {
            $child = \array_shift($queue);
            $child_route = $child['url'] ?? 'javascript:;';
            $child_exact = $child['exact'] ?? true;
            $active = (!$child_exact && Str::is("{$child_route}*", $current_url)) || $current_url === $child_route;
        }
        @endphp
        <li class="nav-item has-treeview @if ($active) menu-open @endif">
            <a href="{{ $route }}" class="nav-link @if ($active) active @endif">
                <i class="nav-icon {{ $navigation['icon'] ?? '' }}"></i>
                <p>
                    {{ $navigation['text'] }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @foreach ($children as $child)
                    <x-navigation-item :navigation="$child" />
                @endforeach
            </ul>
        </li>
    @else
        <li class="nav-item">
            <a href="{{ $route }}" class="nav-link @if ((!$exact && Str::is("{$route}*", $current_url)) || $current_url === $route) active @endif">
                <i class="nav-icon {{ $navigation['icon'] ?? '' }}"></i>
                <p>{{ $navigation['text'] }}</p>
            </a>
        </li>
    @endif
@endif
