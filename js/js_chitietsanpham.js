function increaseQuantity() {
    var quantityInput = document.getElementById('quantity');
    var currentQuantity = parseInt(quantityInput.value);
    quantityInput.value = currentQuantity + 1;
}

function decreaseQuantity() {
    var quantityInput = document.getElementById('quantity');
    var currentQuantity = parseInt(quantityInput.value);
    if (currentQuantity > 1) {
        quantityInput.value = currentQuantity - 1;
    }
}


let thongbao = document.querySelector(".thongbaothemvaogio");
let btn_themgiohang = document.querySelector(".btn_themgiohang");


btn_themgiohang.onclick  = function()
{
    thongbao.style.display = "flex";
}