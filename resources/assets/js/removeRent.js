function removeRent(id){
    var rentCount = $('#rent-count');
    var rentListItem = $('#cart' + id);
    var cart = $('#cart');
    var response
    $.post("/profile/rent/delete", {movie_id: id}, function(result){
        var currentCount = parseInt(rentCount.text());
                if (result == 1) {
                    currentCount = currentCount - 1;
                    rentCount.text(currentCount);
                    rentListItem.remove();
                    if(currentCount == 0){
                        cart.hide();
                    }

                    //Remove from profile if open
                    
                    if (typeof deleteRental == 'function'){
                        deleteRental(id); 
                    }
                }
                else {
                    //todo: display error;
                }
    });
}