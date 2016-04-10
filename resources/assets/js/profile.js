var invoiceRentalIDs = [];

function addToInvoice(id){
    var invoiceButton = $('#invoice'+id);
    invoiceButton.addClass('btn-danger');
    invoiceButton.removeClass('btn-default');
    invoiceButton.text('Remove from invoice');
    invoiceButton.attr("onclick", "removeFromInvoice("+id+")");

    updateInvoice(id, true);
}

function removeFromInvoice(id){
    var invoiceButton = $('#invoice'+id)
    if(typeof invoiceButton !== 'undefined'){
        invoiceButton.addClass('btn-default');
        invoiceButton.removeClass('btn-danger');
        invoiceButton.text('Add to invoice');
        invoiceButton.attr("onclick", "addToInvoice("+id+")");
    }
    console.log('Updating invoice');
    updateInvoice(id, false);
}

function deleteRental(id){
    var basketListItem = $('#basket' + id);
    if(basketListItem){
        basketListItem.remove();
    }
    console.log('Removing from rental' + id);
    removeFromInvoice(id);
}

function updateInvoice(id, add){
    var invoiceFooter = $('#invoiceFooter');
    if(add){
        invoiceRentalIDs.push(id);
    }else{
        invoiceRentalIDs = jQuery.grep(invoiceRentalIDs, function(value) {
            return value != id;
        });
    }
    console.log(invoiceRentalIDs);
    if(invoiceRentalIDs.length > 0){   
        invoiceFooter.show();
    }else{
        invoiceFooter.hide();
    }
}

function createInvoice(){
    $.post("/profile/invoice?_token=" + token, {rentals: invoiceRentalIDs}, function(result){
        var invoice = JSON.parse(result);
        var rentals = invoice['rentals'];
        for (var i = rentals.length - 1; i >= 0; i--) {
            var rentalID = rentals[i]
            deleteRental(rentalID);
        }  
    });
}