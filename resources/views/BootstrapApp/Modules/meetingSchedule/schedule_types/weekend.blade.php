<div class="row card shadow-lg rounded-4 mb-1 p-md-2 py-2">
    <div class="d-flex justify-content-between">
        <div class="col">
            <h3><img class="rounded-2" src="{{ asset('images/watchtower.svg') }}" style="width: 1.5em; height: 1.5em;">
                {{ \Carbon\Carbon::parse($ms->weekend_time)->isoFormat('MMMM D, YYYY, dddd - H:mm') }}</h3>

        </div>
    </div>

    <div class="responsibles_users">
        @if(isset($datas['weekend']['responsible_users']) && count($datas['weekend']['responsible_users']) > 0)
            @include('BootstrapApp.Modules.meetingSchedule.schedule_partials.responsibles_table_weekend')
        @else
            <p>Ответственные пользователи (выходной) не добавлены</p>
        @endif
    </div>

    <div class="song_1">
        @if(isset($datas['weekend']['songs']['1']) && count($datas['weekend']['songs']['1']) > 0)
            @include('BootstrapApp.Modules.meetingSchedule.schedule_partials.songs', ['key' => 1, 'song' => $datas['weekend']['songs']['1']])
        @else
            <p>Председатель (выходной) не добавлен</p>
        @endif
    </div>

    <div class="public_speech">
        @if(isset($datas['weekend']['public_speech']) && count($datas['weekend']['public_speech']) > 0)
            @include('BootstrapApp.Modules.meetingSchedule.schedule_partials.public_speech')
        @else
            <p>Публичная речь не добавлена</p>
        @endif
    </div>
    <div class="song_2">
        @if(isset($datas['weekend']['songs']['2']) && count($datas['weekend']['songs']['2']) > 0)
            @include('BootstrapApp.Modules.meetingSchedule.schedule_partials.songs', ['key' => 2, 'song' => $datas['weekend']['songs']['2']])
        @else
            <p>Песня не добавлена</p>
        @endif
    </div>

    <div class="watchtower">
        @if(isset($datas['weekend']['watchtower']) && count($datas['weekend']['watchtower']) > 0)
            @include('BootstrapApp.Modules.meetingSchedule.schedule_partials.watchtower')
        @else
            <p>Нет данных.</p>
        @endif
    </div>


    <div class="song_3">
        @if(isset($datas['weekend']['songs']['3']) && count($datas['weekend']['songs']['3']) > 0)
            @include('BootstrapApp.Modules.meetingSchedule.schedule_partials.songs', ['key' => 3, 'song' => $datas['weekend']['songs']['3']])
        @else
            <p>Заключительная молитва не добавлена</p>
        @endif
    </div>
</div>
