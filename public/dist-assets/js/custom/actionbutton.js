function sendData() {
    var selectedRow = document.querySelector('#elem .table-row.selected');
    var rowData = selectedRow.innerText;
    $.ajax({
        type: 'POST',
        url: '/your/url',
        data: {
            row_data: rowData
        },
        success: function(response) {
            console.log(response);
        }
    });
}
