function addMultiAnswer(id, input_id) {
    let input = document.createElement("input");
    input.setAttribute("placeholder", "Nhập giá trị");
    input.setAttribute("name", "ans[]");
    let span = document.createElement("span");
    span.setAttribute("class", "glyphicon");
    span.classList.add("glyphicon-remove");
    span.classList.add("gly");
    span.setAttribute("onclick", "javascript:deleteElement(this)");

    let div = document.createElement("div");
    div.appendChild(input);
    div.appendChild(span);
    document.getElementById(id).appendChild(div);
    document.getElementById(input_id).value = document.getElementById(id).children.length;
}
function deleteElement(me) {
    // debugger
    grand = me.parentNode.parentNode;
    grand.removeChild(me.parentNode);
    if(grand.id == "multi-ans") {
        document.getElementById("muls").value = grand.children.length;
    }
    else if(grand.id == "one-ans") {
        document.getElementById("ones").value = grand.children.length;
    }
}