
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