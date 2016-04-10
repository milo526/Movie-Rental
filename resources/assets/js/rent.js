function rent(id){
    var rentForm  = $('#rent-form');
    var rentCount = $('#rent-count');
    var cart = $('#cart');
    var rentButton = $('#rent-button');
    var cartList = $('.dropdown-cart');
    var response

    rentButton.text('Rented');
    rentButton.addClass('btn-success');
    rentButton.removeClass('btn-primary');
    rentButton.attr("disabled", "disabled");

    $.post("/profile/rent", {movie_id: id}, function(result){
        var currentCount = parseInt(rentCount.text());
                if (result !== 0) {
                    var rental = JSON.parse(result);
                    if(currentCount == 0){
                        cart.show();
                    }
                    rentCount.text(currentCount + 1);

                    cartList.prepend('<li id="cart'+rental["id"]+'"><span class="item"><span class="item-left"><span class="item-info"><span>'+rental["MovieName"]+'</span></span></span><span class="item-right"><a class="btn btn-xs btn-danger pull-right" onclick="removeRent('+rental["id"]+')">x</a></span></span></li>');
                }
                else {
                    //todo: display error;
                }
    });
}

function addToCart(){

}