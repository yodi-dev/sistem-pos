    @aware(['activeBgColor' => 'bg-base-300'])

    @php
        $submenuActive = Str::contains($slot, 'mary-active-menu');
    @endphp

    <li
        x-data="
        {
            show: @if($submenuActive || $open) true @else false @endif,
            toggle(){
                // From parent Sidebar
                if (this.collapsed) {
                    this.show = true
                    $dispatch('menu-sub-clicked');
                    return
                }

                this.show = !this.show
            }
        }"
    >
        <details :open="show" @if($submenuActive) open @endif @click.stop>
            <summary @click.prevent="toggle()" @class(["hover:text-inherit text-inherit", $activeBgColor => $submenuActive])>
                @if($icon)
                    <x-mary-icon :name="$icon" class="inline-flex"  />
                @endif
                <span class="mary-hideable">{{ $title }}</span>
            </summary>
            <ul class="mary-hideable">
                {{ $slot }}
            </ul>
        </details>
    </li>