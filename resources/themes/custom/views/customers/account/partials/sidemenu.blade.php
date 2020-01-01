<div class="sidebar">
    @foreach ($menu->items as $menuItem)
        <div class="menu-block font-serif uppercase mt-6">
            <div class="menu-block-title block sm:hidden max-w-md flex justify-between items-center">
                @foreach ($menuItem['children'] as $subMenuItem)
                    @if ($menu->getActive($subMenuItem))
                        <div>
                            <i class="{{ trans($subMenuItem['icon'])  .' ' . $menu->getActive($subMenuItem) }} align-middle h-auto w-6"></i><span class="ml-4 border-b border-gold text-gold"> {{ trans($subMenuItem['name']) }} </span>
                        </div>
                        @break
                    @endif
                @endforeach

                <i class="icon icon-arrow-down right p-3" id="down-icon"></i>
            </div>

            <?php
                $menu_title = '';

                foreach ($menuItem['children'] as $subMenuItem)  {
                    if ($menu->getActive($subMenuItem) == 'active') {
                        $menu_title = '<i class="' .  trans($subMenuItem['icon'])  .' ' . $menu->getActive($subMenuItem) .'" align-middle h-auto w-6"></i>';
                        break;
                    }
                }
            ?>

            <div class="menu-block-content">
                <ul class="menubar relative">
                    @foreach ($menuItem['children'] as $subMenuItem)
                        <li class="menu-item py-3 {{ ($menu->getActive($subMenuItem) == 'active') ? 'hidden sm:block' : '' }} {{ $menu->getActive($subMenuItem) }}">
                            <i class="{{ trans($subMenuItem['icon'])  .' ' . $menu->getActive($subMenuItem) }} align-middle h-auto w-6"></i><a href="{{ $subMenuItem['url'] }}" class="ml-4"> {{ trans($subMenuItem['name']) }} </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $(".icon.icon-arrow-down.right").on('click', function(e){
            var currentElement = $(e.currentTarget);
            if (currentElement.hasClass('icon-arrow-down')) {
                $(this).parents('.menu-block').find('.menubar').show();
                currentElement.removeClass('icon-arrow-down');
                currentElement.addClass('icon-arrow-up');
            } else {
                $(this).parents('.menu-block').find('.menubar').hide();
                currentElement.removeClass('icon-arrow-up');
                currentElement.addClass('icon-arrow-down');
            }
        });
    });
</script>
@endpush