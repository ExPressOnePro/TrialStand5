
        <div class="card-header">
            <h4 class="card-title">Возвещатели</h4>
        </div>

        <!-- Body -->
        <div class="card-body">
            <p>Укажите количество возвещателей служащих со стендом <span class="fw-semibold"></span></p>
            <form id="updatePublishersAtStandForm">
                @csrf
                <div class="row mb-4">
                    <div class="col-sm-12">
                        <select class="form-select" name="publishersAtStand">
                            @for($number = 2; $number <= 4; $number++)
                                <option value="{{ $number }}" {{ $number == $settings_publishers_at_stand ? 'selected' : '' }}>
                                    {{ $number }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>
            </form>
        </div>

        <script>
            $(document).ready(function () {
                // Function to handle form submission
                function updatePublishersAtStand() {
                    // Serialize form data
                    var formData = $('#updatePublishersAtStandForm').serialize();

                    // Make AJAX request
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('stand.publishersAtStand.update', ['id'=> $stand->id]) }}',
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

                // Event listener for select field
                $('#updatePublishersAtStandForm select').change(function () {
                    updatePublishersAtStand();
                });

                // Optionally, you can also trigger the update when the user leaves the field (on blur)
                // $('#updatePublishersAtStandForm select').blur(updatePublishersAtStand);
            });
        </script>


