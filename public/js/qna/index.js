
function validate(me) {
	if(me.value != "") {
		me.value = me.value.toLowerCase();
		me.value = me.value.trim();
		me.value.charAt(0).toUpperCase() + me.value.slice(1);

		document.getElementById("btn-add").removeAttribute("disabled");
    }
    else {
    debugger
    document.getElementById("btn-add").setAttribute("disabled", "disabled");
    }
}

function jsUcfirst(name) // chuyển hết thành chữ thường, cắt khoảng trắng đầu cuối rồi viết hoa chữ cái đầu tiên
{
	string = string.toLowerCase();
	string = string.trim();
	return string.charAt(0).toUpperCase() + string.slice(1);
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