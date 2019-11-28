function EditModal(u_id, u_name, r_id) {
    debugger
    let e_modal = document.getElementById("edit-modal");
    let list_input = e_modal.querySelectorAll("input");
    list_input[0].value = u_id;
    if(r_id == 1) {
        list_input[1].value = 'admin';
    }
    else if (r_id == 2){
        list_input[1].value = 'guest';
    }
    e_modal.querySelectorAll("p span")[0].innerHTML = u_name;
}