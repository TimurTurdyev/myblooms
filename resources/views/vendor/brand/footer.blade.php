@guest
    <p>Crafted with <span class="text-danger">♥</span> by Timur.T</p>
@else

    <div class="text-center user-select-none">
        <p class="small m-0">
            2022 - {{ date('Y') }}<br>
            <a>
                {{ __('Version') }}: {{\Orchid\Platform\Dashboard::VERSION}}
            </a>
        </p>
    </div>
@endguest
