// next and prev in danh muc
function next() {
  x = document.querySelector(".image-carousel__item-list");
  x.style.transform = "translate(-550px,0px)";
  status_next = false;

  document.querySelector(".arrow-next").style.visibility = "hidden";

  y = document.querySelector(".arrow-prev");
  y.style.visibility = "visible";
}

function prev() {
  x = document.querySelector(".image-carousel__item-list");
  x.style.transform = "translate(0px,0px)";

  document.querySelector(".arrow-prev").style.visibility = "hidden";

  y = document.querySelector(".arrow-next");
  y.style.visibility = "visible";
}

bt_next = document.querySelector(".arrow-next");
bt_next.addEventListener("click", next);


bt_prev = document.querySelector(".arrow-prev");
bt_prev.addEventListener("click", prev);


//dong ho dem nguoc

function updateCountdown() {
  let now = new Date();
  let target = new Date(now.getFullYear(), now.getMonth(), now.getDate() + 1, -5, 0, 0);
  let diff = target - now;

  if (diff <= 0) {
    document.querySelector("#countdown").innerHTML = "Expired";
    return;
  }

  let days = Math.floor(diff / 1000 / 60 / 60 / 24);
  let hours = Math.floor(diff / 1000 / 60 / 60) % 24;
  let minutes = Math.floor(diff / 1000 / 60) % 60;
  let seconds = Math.floor(diff / 1000) % 60;

  if (hours < 10) {
    hours_n = `0${hours}`;
  } else {
    hours_n = hours;
  }
  if (minutes < 9) {
    minutes_n = `0${minutes}`;
  } else {
    minutes_n = minutes;
  }
  if (seconds < 10) {
    seconds_n = `0${seconds}`;
  } else {
    seconds_n = seconds;
  }

  document.querySelector("#countdown").innerHTML = `<div class="id_hour">${hours_n}</div>:<div class="id_minute">${minutes_n}</div>:<div class="id_second">${seconds_n}</div>`;
}

updateCountdown();
setInterval(updateCountdown, 1000);

// next and prev in flash sale

let po = 0;

if (po >= 0) {
  document.querySelector(".arrow-prev_flash_sale").style.visibility = "hidden";
}

function next_flash_sale() {
  po -= 965;
  if (po == -1930) {
    document.querySelector(".arrow-next_flash_sale").style.visibility = "hidden";
  }
  x = document.querySelector(".image-carousel__item-list_flash_sale");
  x.style.transform = `translate(${po}px,0px)`;


  y = document.querySelector(".arrow-prev_flash_sale");
  if (po < 0) {
    document.querySelector(".arrow-prev_flash_sale").style.visibility = "visible";
  }
}

function prev_flash_sale() {
  po += 965;
  x = document.querySelector(".image-carousel__item-list_flash_sale");
  x.style.transform = `translate(${po}px,0px)`;

  document.querySelector(".arrow-prev").style.visibility = "hidden";

  y = document.querySelector(".arrow-next");
  y.style.visibility = "visible";

  if (po == 0) {
    document.querySelector(".arrow-prev_flash_sale").style.visibility = "hidden";
    document.querySelector(".arrow-next_flash_sale").style.visibility = "visible";
  }
}



bt_next_flash_sale = document.querySelector(".arrow-next_flash_sale");
bt_next_flash_sale.addEventListener("click", next_flash_sale);



bt_prev_flash_sale = document.querySelector(".arrow-prev_flash_sale");
bt_prev_flash_sale.addEventListener("click", prev_flash_sale);


//next and prev in shopee mall
let distance = 0;

if (distance >= 0) {
  document.querySelector(".arrow-prev__shmall").style.visibility = "hidden";
}

function next_shopee_mall() {
  distance -= 458;
  if (distance == -458) {
    document.querySelector(".arrow-next__shmall").style.visibility = "hidden";
  }
  x = document.querySelector(".shopee-mall__imagewrapper")
  x.style.transform = `translate(${distance}px, 0)`;

  y = document.querySelector(".arrow-prev__shmall");
  if (distance < 0) {
    y.style.visibility = "visible"
  }
}

function prev_shopee_mall() {
  distance += 458;
  x = document.querySelector(".shopee-mall__imagewrapper");
  x.style.transform = `translate(${distance}px, 0px)`;

  document.querySelector(".arrow-prev__shmall").style.visibility = "hidden"

  y = document.querySelector(".arrow-next__shmall");
  y.style.visibility = "visible";

  // if(distance == 0) {
  //   document.querySelector(".arrow-prev__shmall").style.visibility = "hidden";
  //   document.querySelector(".arrow-next__shmall").style.visibility = "visible";
  // }
}

btn_shopemall_next = document.querySelector(".arrow-next__shmall");
btn_shopemall_next.addEventListener("click", next_shopee_mall);

btn_shopeemall_prev = document.querySelector(".arrow-prev__shmall");
btn_shopeemall_prev.addEventListener("click", prev_shopee_mall);


