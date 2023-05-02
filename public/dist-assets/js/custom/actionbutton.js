$('#contactForm').on('submit',function(event){
    event.preventDefault();

    let name = $('#name').val();

    $.ajax({
        url: "/UserControl",
        type:"POST",
        data:{
            "_token": "{{ csrf_token() }}",
            name:name,
        },
        success:function(response){
            console.log(response);
        },
    });
});
