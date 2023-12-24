
        <div class="card-header">
            <h4 class="card-title">Активация </h4>
        </div>

        <!-- Body -->
        <div class="card-body">
            <p>Время в которое отображается таблица следующей недели<span class="fw-semibold"></span></p>

            <form id="timeActivation">
                @csrf
                <div class="row mb-4">
                    <div class="col-12">
                        <select class="form-select " name="dayOfWeek">
                            @foreach($daysOfWeek as $dayNumber => $dayName)
                                <option value="{{ $dayNumber }}" {{ $dayNumber == $activation_values[0] ? 'selected' : '' }}>
                                    {{ $dayName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 mt-4">
                        <select class="form-control text-center" id="time" name="time">
                            @for($hour = 0; $hour < 24; $hour++)
                                @for($minute = 0; $minute < 60; $minute += 60)
                                    <option value="{{ sprintf('%02d:%02d', $hour, $minute) }}" {{ $activation_values[1] == sprintf('%02d:%02d', $hour, $minute) ? 'selected' : '' }}>
                                        {{ sprintf('%02d:%02d', $hour, $minute) }}
                                    </option>
                                @endfor
                            @endfor
                        </select>
                    </div>
                </div>
            </form>
        </div>


        <script>
            $(document).ready(function () {
                // Function to handle form submission
                function updateTimeActivation() {
                    // Serialize form data
                    var formData = $('#timeActivation').serialize();

                    // Make AJAX request
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('stand.timeActivation', $stand->id) }}',
                        data: formData,
                        success: function (data) {
                            // Handle success, if needed
                            console.log(data);
                        },
                        error: function (error) {
                            // Handle error, if needed
                            console.error(error);
                        }
                    });
                }

                // Event listener for select fields
                $('#timeActivation select').change(function () {
                    updateTimeActivation();
                });

                // Optionally, you can also trigger the update when the user leaves the field (on blur)
                // $('#timeActivation select').blur(updateTimeActivation);
            });
        </script>
