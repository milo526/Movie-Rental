var invoiceMovieIDs = [];

function addToInvoice(id){
    var invoiceButton = $('#rental'+id);
    invoiceButton.addClass('btn-danger');
    invoiceButton.removeClass('btn-default');
    invoiceButton.text('Remove from invoice');
    invoiceButton.attr("onclick", "removeFromInvoice("+id+")");

    updateInvoice(id, true);
}

function removeFromInvoice(id){
    var invoiceButton = $('#rental'+id);
    invoiceButton.addClass('btn-default');
    invoiceButton.removeClass('btn-danger');
    invoiceButton.text('Add to invoice');
    invoiceButton.attr("onclick", "addToInvoice("+id+")");

    updateInvoice(id, false);
}

function updateInvoice(id, add){
    var invoiceFooter = $('#invoiceFooter');
    if(add){
        invoiceMovieIDs.push(id);
    }else{
        var index = invoiceMovieIDs.indexOf(id);
        if (index > -1) {
            invoiceMovieIDs.splice(index, 1);
        }
    }

    if(invoiceMovieIDs.length > 0){   
        invoiceFooter.show();
    }else{
        invoiceFooter.hide();
    }
}

function createInvoice(){

}

function payInvoice(){
    var invoice
}