<div class="row card mb-4">
    <!-- ... (previous code remains unchanged) ... -->
    <div class="responsibles_users">
        @if(isset($data['weekday']['responsible_users']) && is_array($data['weekday']['responsible_users']) && count($data['weekday']['responsible_users']) > 0)
            <div class="d-none d-md-block">
                <table class="table table-responsive-sm table-bordered table-sm table-warning lh-sm">
                    <!-- ... (rest of the code remains unchanged) ... -->
                </table>
            </div>
            <div class="d-sm-none">
                <table class="table table-responsive-sm table-bordered table-sm table-warning lh-sm">
                    <!-- ... (rest of the code remains unchanged) ... -->
                </table>
            </div>
        @else
            <p>No responsible users data available.</p>
        @endif
    </div>

    <div class="treasures">
        <h4 class="pb-1 d-flex align-items-center" style="color: #2A6B77">
            <!-- ... (rest of the code remains unchanged) ... -->
        </h4>
        @if(isset($data['weekday']['treasures']) && is_array($data['weekday']['treasures']) && count($data['weekday']['treasures']) > 0)
            @foreach($data['weekday']['treasures'] as $key => $value)
                <!-- ... (rest of the code remains unchanged) ... -->
            @endforeach
        @else
            <p>No treasures data available.</p>
        @endif
    </div>

    <div class="field_ministry py-1">
        <h4 class="pb-1 mb-1 d-flex align-items-center" style="color: #D68F00">
            <!-- ... (rest of the code remains unchanged) ... -->
        </h4>
        @if(isset($data['weekday']['field_ministry']) && is_array($data['weekday']['field_ministry']) && count($data['weekday']['field_ministry']) > 0)
            @foreach($data['weekday']['field_ministry'] as $key => $value)
                <!-- ... (rest of the code remains unchanged) ... -->
            @endforeach
        @else
            <p>No field ministry data available.</p>
        @endif
    </div>

    <div class="song_2">
        <!-- ... (rest of the code remains unchanged) ... -->
    </div>

    <div class="living py-1">
        <!-- ... (rest of the code remains unchanged) ... -->
    </div>

    <div class="song_3">
        <!-- ... (rest of the code remains unchanged) ... -->
    </div>
</div>
