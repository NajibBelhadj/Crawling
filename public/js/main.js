function myFunction() {
    var demo=document.createElement("input");
    demo.disabled="true";
    var demo1=document.createElement("input");
    demo1.disabled="true";
    var x = document.getElementById("mySelect").value;
    var a=x.substring(0,x.indexOf('+'));
    var b=x.substring(x.indexOf('+')+1,x.length);
    demo.className="blocktext";
    demo1.className="blocktext";
    demo.value = a;
    demo1.value = b;
    var c=document.getElementById("najib");
    var btn=document.createElement("button");
    btn.innerHTML="VALIDER";
    btn.className="btn exemple-btn";
    c.innerHTML="";
    c.appendChild(document.createTextNode("TUNISIE BOOKING : "));
    c.className="example-text";
    c.appendChild(demo);
    c.appendChild(document.createElement("br"));
    c.appendChild(document.createElement("br"));
    c.appendChild(document.createTextNode("TAHA VOYAGE : "));
    c.appendChild(demo1);
    c.appendChild(document.createElement("br"));
    c.appendChild(btn);
    btn.onclick = function() { 
        var d=document.getElementById("njouba");
        d.style="display:bloc";
 };
}

function disableElement() {
    var d=document.getElementById("courbe");
        d.style="display:bloc";
}





