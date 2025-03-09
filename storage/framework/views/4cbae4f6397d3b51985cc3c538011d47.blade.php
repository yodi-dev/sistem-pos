    @aware(['activateByRoute' => false, 'activeBgColor' => 'bg-base-300'])

    <li>
        <a
            {{
                $attributes->class([
                    "my-0.5 hover:text-inherit rounded-md whitespace-nowrap ",
                    "mary-active-menu $activeBgColor" => ($active || ($activateByRoute && $routeMatches()))
                ])
            }}

            @if($link)
                href="{{ $link }}"

                @if($external)
                    target="_blank"
                @endif

                @if(!$external && !$noWireNavigate)
                    {{ $attributes->wire('navigate')->value() ? $attributes->wire('navigate') : 'wire:navigate' }}
                @endif
            @endif

            @if($spinner)
                wire:target="{{ $spinnerTarget() }}"
                wire:loading.attr="disabled"
            @endif
        >
            <!-- SPINNER -->
            @if($spinner)
                <span wire:loading wire:target="{{ $spinnerTarget() }}" class="loading loading-spinner w-5 h-5"></span>
            @endif

            @if($icon)
                <span class="block -mt-0.5" @if($spinner) wire:loading.class="hidden" wire:target="{{ $spinnerTarget() }}" @endif>
                    <x-mary-icon :name="$icon" />
                </span>
            @endif

            @if($title || $slot->isNotEmpty())
            <span class="mary-hideable whitespace-nowrap truncate">
                @if($title)
                    {{ $title }}

                    @if($badge)
                        <span class="badge badge-ghost badge-sm {{ $badgeClasses }}">{{ $badge }}</span>
                    @endif
                @else
                    {{ $slot }}
                @endif
            </span>
            @endif
        </a>
    </li>