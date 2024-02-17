<div class="row card shadow-lg rounded-4 mb-1 p-md-2 py-2 d-none d-md-block">
    <div class="d-flex justify-content-between">
        <div class="col">
            <h3><img class="rounded-2" src="{{ asset('images/workbook.svg') }}"
                     style="width: 1.5em; height: 1.5em;"> {{ \Carbon\Carbon::parse($ms->weekday_time)->isoFormat('MMMM D, YYYY, dddd - H:mm') }}
            </h3>
        </div>
        <div class="col-auto">

        </div>
    </div>

    <div class="responsibles_users p-2">
        @if(isset($datas['weekday']['responsible_users']) && count($datas['weekday']['responsible_users']) > 0)
            @include('BootstrapApp.Modules.meetingSchedule.schedule_partials.responsibles_table_weekday')
        @else
            <p>Ответственные пользователи не добавлены</p>
        @endif
    </div>

    <div class="song_1 p-2">
        @if(isset($datas['weekday']['songs']['1']) && count($datas['weekday']['songs']['1']) > 0)
            @include('BootstrapApp.Modules.meetingSchedule.schedule_partials.songs', ['key' => 1, 'song' => $datas['weekday']['songs']['1']])
        @else
            <p>Председатель не добавлен</p>
        @endif
    </div>

    <div class="treasures p-2">
        @if(isset($datas['weekday']['treasures']) && count($datas['weekday']['treasures']) > 0)
            @include('BootstrapApp.Modules.meetingSchedule.schedule_partials.treasures')
        @else
            <p>Жемчужины не добавлены</p>
        @endif
    </div>

    <div class="field_ministry p-2">
        @if(isset($datas['weekday']['field_ministry']) && count($datas['weekday']['field_ministry']) > 0)
            @include('BootstrapApp.Modules.meetingSchedule.schedule_partials.field_ministry')
        @else
            <p>Навыки не добавлены</p>
        @endif
    </div>

    <div class="song_2 p-2">
        @if(isset($datas['weekday']['songs']['2']) && count($datas['weekday']['songs']['2']) > 0)
            @include('BootstrapApp.Modules.meetingSchedule.schedule_partials.songs', ['key' => 2, 'song' => $datas['weekday']['songs']['2']])
        @else
            <p>Вторая песня не добавлена</p>
        @endif
    </div>
    <div class="living p-2">
        @if(isset($datas['weekday']['living']) && count($datas['weekday']['living']) > 0)
            @include('BootstrapApp.Modules.meetingSchedule.schedule_partials.living')
        @else
            <p>Христианская жизнь не добавлена</p>
        @endif
    </div>
    <div class="song_3 p-2">
        @if(isset($datas['weekday']['songs']['3']) && count($datas['weekday']['songs']['3']) > 0)
            @include('BootstrapApp.Modules.meetingSchedule.schedule_partials.songs', ['key' => 3, 'song' => $datas['weekday']['songs']['3']])
        @else
            <p>Заключительная песня не добавлена</p>
        @endif
    </div>
</div>


<div class="row mb-1 p-md-2 py-2 d-sm-none">
    <div class="d-flex justify-content-between">
        <div class="col">
            <h3><img class="rounded-2" src="{{ asset('images/workbook.svg') }}"
                     style="width: 1.5em; height: 1.5em;"> {{ \Carbon\Carbon::parse($ms->weekday_time)->isoFormat('MMMM D, YYYY, dddd - H:mm') }}
            </h3>
        </div>
        <div class="col-auto">

        </div>
    </div>

    <div class="responsibles_users p-2">
        @if(isset($datas['weekday']['responsible_users']) && count($datas['weekday']['responsible_users']) > 0)
            @include('BootstrapApp.Modules.meetingSchedule.schedule_partials.responsibles_table_weekday')
        @else
            <p>Ответственные пользователи не добавлены</p>
        @endif
    </div>

    <div class="song_1 p-2">
        @if(isset($datas['weekday']['songs']['1']) && count($datas['weekday']['songs']['1']) > 0)
            @include('BootstrapApp.Modules.meetingSchedule.schedule_partials.songs', ['key' => 1, 'song' => $datas['weekday']['songs']['1']])
        @else
            <p>Председатель не добавлен</p>
        @endif
    </div>

    <div class="treasures p-2" style="background-color: rgba(42,107,119,0.11)">
        @if(isset($datas['weekday']['treasures']) && count($datas['weekday']['treasures']) > 0)
            @include('BootstrapApp.Modules.meetingSchedule.schedule_partials.treasures')
        @else
            <p>Жемчужины не добавлены</p>
        @endif
    </div>

    <div class="field_ministry p-2">
        @if(isset($datas['weekday']['field_ministry']) && count($datas['weekday']['field_ministry']) > 0)
            @include('BootstrapApp.Modules.meetingSchedule.schedule_partials.field_ministry')
        @else
            <p>Навыки не добавлены</p>
        @endif
    </div>

    <div class="song_2 p-2">
        @if(isset($datas['weekday']['songs']['2']) && count($datas['weekday']['songs']['2']) > 0)
            @include('BootstrapApp.Modules.meetingSchedule.schedule_partials.songs', ['key' => 2, 'song' => $datas['weekday']['songs']['2']])
        @else
            <p>Вторая песня не добавлена</p>
        @endif
    </div>
    <div class="living p-2">
        @if(isset($datas['weekday']['living']) && count($datas['weekday']['living']) > 0)
            @include('BootstrapApp.Modules.meetingSchedule.schedule_partials.living')
        @else
            <p>Христианская жизнь не добавлена</p>
        @endif
    </div>
    <div class="song_3 p-2">
        @if(isset($datas['weekday']['songs']['3']) && count($datas['weekday']['songs']['3']) > 0)
            @include('BootstrapApp.Modules.meetingSchedule.schedule_partials.songs', ['key' => 3, 'song' => $datas['weekday']['songs']['3']])
        @else
            <p>Заключительная песня не добавлена</p>
        @endif
    </div>
</div>


