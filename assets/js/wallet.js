$(function() {

    var owner = $('#owner');
    var cardNumber = $('#cardNumber');
    var cardNumberField = $('#card-number-field');
    var amount = $('amount');
    var CVV = $("#cvv");
    var mastercard = $("#mastercard");
    var confirmButton = $('#confirm-purchase');
    var visa = $("#visa");
    var amex = $("#amex");

    // Use the payform library to format and validate
    // the payment fields.

    cardNumber.payform('formatCardNumber');
    CVV.payform('formatCardCVC');


    cardNumber.keyup(function() {

        amex.removeClass('transparent');
        visa.removeClass('transparent');
        mastercard.removeClass('transparent');

        if ($.payform.validateCardNumber(cardNumber.val()) == false) {
            cardNumberField.addClass('has-error');
        } else {
            cardNumberField.removeClass('has-error');
            cardNumberField.addClass('has-success');
        }

        if ($.payform.parseCardType(cardNumber.val()) == 'visa') {
            mastercard.addClass('transparent');
            amex.addClass('transparent');
        } else if ($.payform.parseCardType(cardNumber.val()) == 'amex') {
            mastercard.addClass('transparent');
            visa.addClass('transparent');
        } else if ($.payform.parseCardType(cardNumber.val()) == 'mastercard') {
            amex.addClass('transparent');
            visa.addClass('transparent');
        }
    });

    confirmButton.click(function(e) {

        e.preventDefault();

        var isCardValid = $.payform.validateCardNumber(cardNumber.val());
        var isCvvValid = $.payform.validateCardCVC(CVV.val());

        if(owner.val().length < 5){
            	makeToast("Wrong name info. Try again","danger","info");
        } else if (!isCardValid) {
            	makeToast("Wrong card number","danger","info");
        } else if (!isCvvValid) {
           	makeToast("Wrong CVV","danger","info"); 
        } else {
           
            deposit();
        
                        }
    });
});





function deposit(){
var amount = $("#amount").val();
var product_id = $("#product_id").val();
$(document).ready(function(){
    $("#loader").css("display","block")
   
$.post( "../controllers/payment.api.php",
         { "amount": amount,"product_id":product_id}, function( data ) {
        $("#loader").css("display","none")
          if(data.status){
             makeToast("Transaction made successfully","green","success");
             $('#transactionForm')[0].reset();
             $(".myModal").modal("hide");
         }else{
             makeToast("Oops an error occured. Try again","danger","info");
         }
});



})
    
}










 $(document).ready(function() {
                $('#datatable').DataTable();
            } );

$(document).on('click','.buy',function(ev){
    ev.preventDefault();
    var product_id = $(this).data('product_id');
    var amount = $(this).data('amount');

    $("#amount").val(amount);
    $("#product_id").val(product_id);
    $(".myModal").modal("show");
})


