
function SuccessToastFun(text){
    Toastify({
        text: text,
        duration:2000,
        newWindow: true,
        close: true,
        gravity: "c", 
        position: "center", 
        stopOnFocus: true, 
        style: {
            background: '#fff',
            color:'black',
            border: '3px solid green',
            'border-radius':'7px' 
        },
    }).showToast();
}


function ErrorToastFun(text){
    Toastify({
        text: text,
        duration:2000,
        newWindow: true,
        close: true,
        gravity: "top", 
        position: "center", 
        stopOnFocus: true, 
        style: {
            background: '#fff',
            color:'black',
            border: '2px solid red',
            'border-radius': '6px' 
        },
    }).showToast();
}

function loaderShow() {
    $('#LoadingOverlay').removeClass('d-none');
}

function loaderHide() {
    $('#LoadingOverlay').addClass('d-none');
}


function removeAlert() {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    });
    return swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            return true;
        } else {
            return false;
        }
    });
}
