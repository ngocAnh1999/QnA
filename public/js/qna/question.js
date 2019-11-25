function submited(me) {
    me.submit();
}
function editModal(id, q_id) {

    let wrap = document.getElementById(id);
    let title = wrap.querySelectorAll('P.q_title a')[0].innerText;
    let content = wrap.querySelectorAll('P.q_content span')[0].innerText;
    let edit_modal = document.getElementById("edit-modal");
    edit_modal.querySelectorAll('input.e-id')[0].value = q_id;
    edit_modal.querySelectorAll('input.e-name')[0].value = title;
    edit_modal.querySelectorAll('textarea.e-noidung')[0].value = content;
}
function deleteModal(id, q_id) {
    debugger
    let wrap = document.getElementById(id);
    let title = wrap.querySelectorAll('P.q_title a')[0].innerText;
    document.getElementById("del-name").innerHTML = title;
    document.getElementById("del-id").value = q_id;

}