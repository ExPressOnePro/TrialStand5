
<div class="card-header">
    <h4 class="card-title">Стандартные настройки стенда</h4>
</div>

<!-- Body -->
<div class="card-body">
    <form id="updateStandForm">
        @csrf
        <div class="row mb-4">
            <div class="col-sm-12">
                <div class="col-md-12 form-group mb-3">
                    <label for="name" class="text-muted">Название стенда</label>
                    <input class="form-control form-control-rounded" id="name" type="text" name="name" placeholder="Введите название стенда" value="{{ $stand->name }}">
                </div>
                <div class="col-md-12 form-group">
                    <label for="location" class="text-muted">Место стенда</label>
                    <input class="form-control form-control-rounded" id="location" type="text" name="location" placeholder="Местоположение стенда" value="{{  $stand->location }}">
                </div>
            </div>
        </div>
    </form>
</div>


<script>
    $(document).ready(function () {
        // Function to handle form submission
        function updateStand() {
            // Serialize form data
            var formData = $('#updateStandForm').serialize();

            // Make AJAX request
            $.ajax({
                type: 'POST',
                url: '{{ route('stand.default_update', $stand->id) }}',
                data: formData,
                success: function (data) {
                    // Handle success, if needed
                    console.log('success');
                },
                error: function (error) {
                    // Handle error, if needed
                    console.error(error);
                }
            });
        }

        // Event listener for input fields
        $('#updateStandForm input').on('input', function () {
            // Call the updateStand function after a short delay (e.g., 500 milliseconds) to avoid triggering the AJAX call on every keystroke
            clearTimeout($(this).data('timeout'));
            $(this).data('timeout', setTimeout(updateStand, 500));
        });

        // Optionally, you can also trigger the update when the user leaves a field (on blur)
        // $('#updateStandForm input').on('blur', updateStand);
    });
</script>
