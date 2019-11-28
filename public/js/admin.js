function EditModal(u_id, u_name, r_id) {
    let e_modal = document.getElementById("edit-modal");
    let list_input = e_modal.querySelectorAll("input");
    list_input[0].value = u_id;
    if(r_id == 1) {
        list_input[1].value = 'admin';
    }
    else if (r_id == 2){
        list_input[1].value = 'guest';
    }
    let listOption = e_modal.querySelectorAll("option");
    for(let i = 0; i < listOption.length; i++) {
        listOption[i].classList.remove("d-none");
        if(listOption[i].value == r_id) {
            listOption[i].removeAttribute("selected", "selected");
            listOption[i].classList.add("d-none");
        }
        else {
            listOption[i].setAttribute("selected", "selected");
        }
    }
    e_modal.querySelectorAll("p span")[0].innerHTML = u_name;
}
function AddModal(u_id, u_name) {
    let modal = document.getElementById("add-modal");
    let list_input = modal.querySelectorAll("input");
    list_input[0].value = u_id;
    modal.querySelectorAll("p span")[0].innerHTML = u_name;
}