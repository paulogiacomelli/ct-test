$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});

$(".btn").click(function(e){

    e.preventDefault();
    var name = $("input[name=name]").val();
    var quantity = $("input[name=quantity]").val();
    var price = $("input[name=price]").val();

    $.ajax({

       type:'POST',
       url:'/store',
       data:{
           name:name, 
           quantity:quantity, 
           price:price
        },

       success:function(data){
            if(data.errors) {
                // Shows alert-danger if form validatoin faield - from validator in ProductController
                $('.alert-danger').html('');
                $.each(data.errors, function(key, value){
                    $('.alert-danger').show();
                      $('.alert-danger').append('<p>'+value+'</p>');
                    
                    $('.alert-danger').fadeTo(2000, 500).slideUp(500, function(){
                        $('.alert-danger').slideUp(500);
                    });
                });

            } else {
                // Show the sucess alert and add the data to new row
                $(".alert-success").show();
                $('#table').find('tr:last').prev().after('<tr><td>' + data.name +'</td><td>' + data.quantity + '</td><td>' + data.price + '</td><td>' + data.created_at  + '</td><td>' + data.price*data.quantity + '</td></tr>')
                
                // Recalculate the total based on the new input
                let total = parseInt($('#total').text()) + (data.price*data.quantity)
                $('#total').text(total);
                
                // Remove alert, and reset the form
                $('.alert-success').fadeTo(2000, 500).slideUp(500, function(){
                    $('.alert-success').slideUp(500);
                });
                $('#form').trigger("reset");
            }   
        }
    });     
});