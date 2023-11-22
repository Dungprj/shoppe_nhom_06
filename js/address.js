

document.addEventListener('DOMContentLoaded', function ()
{



    let btn_add_address = document.querySelector(".btn-add-new-address");

    let bl_add_address = document.querySelector("#bl_add_new_address");
    let btn_cancel_new_address = document.querySelector("#btn_cancel_add_address");
    let ls_btn_edit_address = document.querySelectorAll(".btn-edit-profile_thongtin");
    
   
    
    
    btn_add_address.onclick = function() {
        if (document.querySelectorAll(".bl-profile-address-edit_thongtin").length > 2) {
            alert("Quá số lượt lưu trữ !");
        
        }else
        {
            bl_add_address.style.display ="flex";
        }
    
    
    }


    


})














