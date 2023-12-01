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


let btn_like_binhluan = document.querySelectorAll(".btn-like_binhluan");
let label_like_binhluan = document.querySelectorAll(".bl_soluotlike");






