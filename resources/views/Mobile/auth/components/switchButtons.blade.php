
<div class="text-center">
    <ul class="nav nav-segment nav-pills  border border-secondary mb-7" role="tablist">
        @if(Request::is('*registration'))
            <li class="nav-item">
                <a class="nav-link active bg-soft-info border border-secondary" href="{{ route('auth.registration') }}">Личный аккаунт</a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link"  href="{{ route('auth.registration') }}">Личный аккаунт</a>
            </li>
        @endif
        @if(Request::is('*registrationCongregation'))
            <li class="nav-item">
                <a class="nav-link active bg-soft-info border border-secondary"  href="{{ route('auth.registrationCongregation') }}">Аккаунт Собрания</a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('auth.registrationCongregation') }}">Аккаунт Собрания</a>
            </li>
        @endif
    </ul>
</div>


