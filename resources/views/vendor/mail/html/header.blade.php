<tr>
    <td class="header mt-[2rem]" style="margin-top: 2rem">
        <a href="{{ $url }}" style="display: inline-block;">
            {{-- @if (trim($slot) === 'Laravel')
        <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo"> --}}
            @if (trim($slot) === 'Juntar')
                <div class="header-logo">

                    <img src="https://ci5.googleusercontent.com/proxy/i1UaVa38u6NrfhO5dLzcVA3_fYeBcsJOsudvHL0GrsFY-cKfMjjYDD6a82FA-zIno9c=s0-d-e1-ft#https://i.imgur.com/7lXAKuu.png"
                        class="logo" alt="">
            @endif


                    <br><span>{{ config('app.name') }}</span>
            </div>

        </a>
    </td>
</tr>
