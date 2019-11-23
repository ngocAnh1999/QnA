
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
  debugger 
  let myTableRow = me.parentNode.parentNode;
  let e_name = myTableRow.children[1].innerText;
  let e_mota = myTableRow.children[2].innerText;
  let e_start = myTableRow.children[3].innerText;
  let e_end = myTableRow.children[4].innerText;
}