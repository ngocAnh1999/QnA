function editAns(id, content) {
    let e_content = document.getElementById("edit-modal").querySelectorAll("textarea")[0];
    e_content.value = content;
    let e_id = document.getElementById("edit-modal").querySelectorAll("input.id")[0];
    e_id.value = id;
}
function deleteAns(id, content) {
    document.getElementById("del-name").innerHTML = content;
    document.getElementById("del_modal").querySelectorAll("input.del-id")[0].value = id;
}