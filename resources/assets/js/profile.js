var invoiceMovieIDs = [];

function addToInvoice(id){
    var invoiceButton = $('#invoice'+id);
    invoiceButton.addClass('btn-danger');
    invoiceButton.removeClass('btn-default');
    invoiceButton.text('Remove from invoice');
    invoiceButton.attr("onclick", "removeFromInvoice("+id+")");

    updateInvoice(id, true);
}

function removeFromInvoice(id){
    var invoiceButton = $('#invoice'+id);
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
    $.post("/profile/invoice?_token=" + token, {rentals: invoiceMovieIDs}, function(result){
        var invoice = JSON.parse(result);
        var date = new Date();
        var dateString;

        date.setDate(date.getDate() + 20);

        dateString = ('0' + date.getDate()).slice(-2) + '/'
                     + ('0' + (date.getMonth()+1)).slice(-2) + '/'
                     + date.getFullYear();
        var id = invoice['id'];
        $('#table-invoice tr:last').after("<tr><td>"+id+"</td><td>"+dateString+"</td><td><span class='glyphicon glyphicon-ok text-warning' aria-hidden='true'></span></td><td class='text-right'><div class='btn-group' role='group'><a href='/profile/invoice/"+id+" class='btn btn-info' role='button'>Show</a><button class='btn btn-primary' onclick=''>Pay</button></div></td></tr>");
    });
}

function payInvoice(){
    var invoice
}