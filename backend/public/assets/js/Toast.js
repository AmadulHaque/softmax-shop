
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