<tr>
    <td class="header mt-[2rem]" style="margin-top: 2rem">
        <a href="{{ $url }}" style="display: inline-block;">
            {{-- @if (trim($slot) === 'Laravel')
        <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo"> --}}
            @if (trim($slot) === 'Juntar')
                <div class="header-logo">
                    <img src="https://i.imgur.com/7lXAKuu.png"
                        class="logo" alt="">
            @endif


                    <br><span>{{ config('app.name') }}</span>
            </div>

        </a>
    </td>
</tr>
