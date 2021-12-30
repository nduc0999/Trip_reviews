var id;
var heart_icon;
const Toast = Swal.mixin({
    toast: true,
    position: 'bottom',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

$("#title").keyup(function() {

    if($(this).val() != '' ){
        $('.btn-create-travel').attr('disabled', false);;
    }else{
        $('.btn-create-travel').attr('disabled', true);;
    }
});

$('.add-heart').click(function(){
id = $(this).data('id');
    heart_icon = $(this);
    console.log(id)
loadListTravel();
$('#modal-list-travel').modal('show');

})

function loadListTravel(){
$.ajax({
    url: url_loadList,
    type: "POST",
    data: {
        "_token": csrf,
        "id": id,
    },
    success: function(result){
        $('.list-travel').html(result);
        addTravel();
    }
})
}

function addTravel(){
$('.item-travel').click(function(){
    let id_travel = $(this).data('id-travel');
    let heart = $(this).find('.show-heart').data('heart');
    $.ajax({
    url: url_addTravel,
    type: "POST",
    data:{
        "_token": csrf,
        "id_travel": id_travel,
        "id_post": id,
        "heart": heart,
    },
    success: function(result){
        if(result.status){
            $('#modal-list-travel').modal('hide');
            if (result.check_heart == 1) {
                heart_icon.html(`<i class="fa fa-heart" style='color: #ff5d5d;'></i>`);
            } else {
                heart_icon.html(`<i class="fa fa-heart-o" ></i>`);
            }
            if(result.type == 1){
                heart_icon.html(`<i class="fa fa-heart" style='color: #ff5d5d;'></i>`);
                Toast.fire({
                    icon: 'success',
                    title: 'Đã thêm vào chuyến đi.'
                })
            }

        }else{
        Toast.fire({
            icon: 'error',
            title: result.mess,
        })
        }
    }
    })
})
}

var err;
$('.btn-create-travel').click(function(e){
    e.preventDefault();
    let form = $('#form-create-travel');
    let data = new FormData(form[0]);
    
    $.ajax({
        url: url_createTravel,
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: function(result){
            if(err != null){
                removeErrorMsg(err);     
            }      
            if(result.status){
                $('#modal-create-travel').modal('hide');
                $('#title').val('');
                $("input[name=status][value=" + 0 + "]").prop('checked', true);
                    Toast.fire({
                    icon: 'success',
                    title: 'Đã tạo chuyến đi thành công'
                })
                loadListTravel();

            }else{
                console.log(result.mess);
            }
            
        },
        error: function(e){
            console.log(e);
            removeErrorMsg(err);
            printErrorMsg(e.responseJSON.errors);
        }

    })
})

function printErrorMsg (msg) {
    
    $.each( msg, function( key, value ) {
        $('.'+key+'_err').text(value);
    });
    

}

function removeErrorMsg (msg) {
    
    $.each( msg, function( key, value ) {
        $('.'+key+'_err').text('');
    });

}