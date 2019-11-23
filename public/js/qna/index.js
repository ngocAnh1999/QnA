
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