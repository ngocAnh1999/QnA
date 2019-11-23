
function validate(me) {
debugger
	if(me.value != "") {
		
		document.getElementById("btn btn-success").removeAttribute("disabled");
    }
    else {
    debugger
    document.getElementById("btn btn-success").setAttribute("disabled", "disabled");
    }
}

function DeleteModal(me) {
  let myTableRow = me.parentNode.parentNode;
  let del_name = myTableRow.children[1].innerText;
  let del_id = myTableRow.attributes["property"].value;
  document.getElementById("del-name").innerHTML = del_name;
  document.getElementById("del-id").value = del_id;
}
function EditModal(me) {
  let myTableRow = me.parentNode.parentNode;
  let editModal = document.getElementById("edit-modal");
  editModal.querySelectorAll(".e-id")[0].value = myTableRow.attributes["property"].value;
  editModal.querySelectorAll(".e-name")[0].value = myTableRow.children[1].innerText;
  editModal.querySelectorAll(".e-mota")[0].value = myTableRow.children[2].innerText;
  editModal.querySelectorAll(".e-start")[0].value = myTableRow.children[3].innerText;
  editModal.querySelectorAll(".e-end")[0].value = myTableRow.children[4].innerText;
}