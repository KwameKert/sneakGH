

function makeToast(body,bg,noti){
    $.toast({
        heading: "My Sika APP",
        text: body,
        bgColor:bg,
        position: 'top-right',
        loaderBg:'#ffeeff',
        icon: noti,
        textColor:'#fff',
        hideAfter: 10000,
        stack: 6
    })
};


// $(document).ready( function () {
//     $('.datatable-basic').DataTable();
// } );
