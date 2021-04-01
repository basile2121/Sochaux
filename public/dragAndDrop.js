var idJoueurADeplacer;
var idJoueurADeplacer2;
var idSlotDepart;
var idSlotDepart2;
var ok = true;
var ok2 = true;
var provenance;
var nbJoueursE1 = document.getElementById('tableauE1').rows.length-1;
var nbJoueursE2 = document.getElementById('tableauE2').rows.length-1;
var tactique1 = document.getElementById("tactique").innerText.split(" ")
var tactique2 = document.getElementById("tactique2").innerText.split(" ")
var nbJoueursPlacesE1 = 0;
var nbJoueursPlacesE2 = 0;

function loadTerrain1(){
    var listeGardiensE1 = document.getElementById("gardienE1").value.split(",")
    var listeLigne1E1 = document.getElementById("ligne1E1").value.split(",")
    var listeLigne2E1 = document.getElementById("ligne2E1").value.split(",")
    var listeLigne3E1 = document.getElementById("ligne3E1").value.split(",")
    var listeLigne4E1 = document.getElementById("ligne4E1").value.split(",")

    for(let n = 12;n<23;n++){
        if(!document.getElementById("target"+n).hasChildNodes())
        {
            if (n == 12 && listeGardiensE1.length > 1) {
                var aDeplacer = document.getElementById(listeGardiensE1[1])
                document.getElementById("target" + n).appendChild(aDeplacer);
                nbJoueursPlacesE1++;
            }
            console.log(n + " ET " + listeLigne1E1[n - 12])
            if (n >= 13 && n <= (12 + Number(tactique1[0])) && listeLigne1E1[n - 12] > 0) {
                var aDeplacer = document.getElementById(listeLigne1E1[n - 12])
                document.getElementById("target" + n).appendChild(aDeplacer);
                nbJoueursPlacesE1++;
            }

            if (n >= 13 + Number(tactique1[0]) && n <= (12 + Number(tactique1[0]) + Number(tactique1[1])) && listeLigne2E1[n - (12 + Number(tactique1[0]))]) {
                var aDeplacer = document.getElementById(listeLigne2E1[n - (12 + Number(tactique1[0]))])
                document.getElementById("target" + n).appendChild(aDeplacer);
                nbJoueursPlacesE1++;
            }
            if (n >= 13 + Number(tactique1[0]) + Number(tactique1[1]) && n <= (12 + Number(tactique1[0]) + Number(tactique1[1]) + Number(tactique1[2])) && listeLigne3E1[n - (12 + Number(tactique1[0]) + Number(tactique1[1]))]) {
                var aDeplacer = document.getElementById(listeLigne3E1[n - (12 + Number(tactique1[0]) + Number(tactique1[1]))])
                document.getElementById("target" + n).appendChild(aDeplacer);
                nbJoueursPlacesE1++;
            }
            if (n >= 13 + Number(tactique1[0]) + Number(tactique1[1]) + Number(tactique1[2]) && n <= (12 + Number(tactique1[0]) + Number(tactique1[1]) + Number(tactique1[2]) + Number(tactique1[3])) && listeLigne4E1[n - (12 + Number(tactique1[0]) + Number(tactique1[1]) + Number(tactique1[2]))]) {
                var aDeplacer = document.getElementById(listeLigne4E1[n - (12 + Number(tactique1[0]) + Number(tactique1[1]) + Number(tactique1[2]))])
                document.getElementById("target" + n).appendChild(aDeplacer);
                nbJoueursPlacesE1++;
            }
        }
    }


}
function loadTerrain2() {
    var listeGardiensE2 = document.getElementById("gardienE2").value.split(",")
    var listeLigne1E2 = document.getElementById("ligne1E2").value.split(",")
    var listeLigne2E2 = document.getElementById("ligne2E2").value.split(",")
    var listeLigne3E2 = document.getElementById("ligne3E2").value.split(",")
    var listeLigne4E2 = document.getElementById("ligne4E2").value.split(",")

    for (let n = 1; n < 12; n++) {
        if (!document.getElementById("target" + n).hasChildNodes()) {
            if (n == 1 && listeGardiensE2.length > 1) {
                var aDeplacer = document.getElementById(listeGardiensE2[1])
                document.getElementById("target" + n).appendChild(aDeplacer);
                nbJoueursPlacesE2++;
            }

            if (n >= 2 && n <= (1 + Number(tactique2[0])) && (listeLigne1E2[n - 1] > 0)) {
                var aDeplacer = document.getElementById(listeLigne1E2[n - 1])
                document.getElementById("target" + n).appendChild(aDeplacer);
                nbJoueursPlacesE2++;
            }

            if (n >= 2 + Number(tactique2[0]) && n <= (1 + Number(tactique2[0]) + Number(tactique2[1])) && listeLigne2E2[n - (1 + Number(tactique2[0]))]) {
                var aDeplacer = document.getElementById(listeLigne2E2[n - (1 + Number(tactique2[0]))])
                document.getElementById("target" + n).appendChild(aDeplacer);
                nbJoueursPlacesE2++;
            }
            console.log(n)
            if (n >= 2 + Number(tactique2[0]) + Number(tactique2[1]) && n <= (1 + Number(tactique2[0]) + Number(tactique2[1]) + Number(tactique2[2])) && listeLigne3E2[n - (1 + Number(tactique2[0]) + Number(tactique2[1]))]) {
                var aDeplacer = document.getElementById(listeLigne3E2[n - (1 + Number(tactique2[0]) + Number(tactique2[1]))])
                document.getElementById("target" + n).appendChild(aDeplacer);
                nbJoueursPlacesE2++;
            }
            console.log(n)
            console.log("VERIF -> " + (n >= 2 + Number(tactique2[0]) + Number(tactique2[1]) + Number(tactique2[2])))
            if (n >= 2 + Number(tactique2[0]) + Number(tactique2[1]) + Number(tactique2[2]) && n <= (1 + Number(tactique2[0]) + Number(tactique2[1]) + Number(tactique2[2]) + Number(tactique2[3])) && listeLigne4E2[n - (1 + Number(tactique2[0]) + Number(tactique2[1]) + Number(tactique2[2]))]) {
                var aDeplacer = document.getElementById(listeLigne4E2[n - (1 + Number(tactique2[0]) + Number(tactique2[1]) + Number(tactique2[2]))])
                document.getElementById("target" + n).appendChild(aDeplacer);
                nbJoueursPlacesE2++;
            }
        }
    }
}

function afficheTargetsTerrain1(){
    for(let n = 12;n<23;n++){
        const element = document.createElement("div");
        element.className = "target";
        element.id = "target"+n;
        element.setAttribute("onclick","dropWithoutMouseFinished(event)");
        element.setAttribute("ondragover","dragover_handler(event)");
        element.setAttribute("ondrop","drop_handler(event)");
        document.getElementById("terrain1").appendChild(element);
    }
}

function afficheTargetsTerrain2(){
    for(let k = 1;k<12;k++){

        const element = document.createElement("div");
        element.className = "target";
        element.id = "target"+k;
        element.setAttribute("onclick","dropWithoutMouseFinished2(event)");
        element.setAttribute("ondragover","dragover_handler(event)");
        element.setAttribute("ondrop","drop_handler2(event)");
        document.getElementById("terrain2").appendChild(element);
    }
}
function cancelMove(){
    console.log("A ANNULER : "+idJoueurADeplacer)
    document.getElementById(idSlotDepart).appendChild(document.getElementById(idJoueurADeplacer));
    document.getElementById(idJoueurADeplacer).style.opacity = "50%";
    document.getElementById("annuler").style.visibility = "hidden";

    document.getElementById("recharger").style.visibility = "hidden";
    verif();
}
function cancelMove2(){
    console.log(document.getElementById(idSlotDepart2))
    console.log(document.getElementById(idJoueurADeplacer2))
    console.log(document.getElementById(idSlotDepart2).childNodes.length)
    document.getElementById(idSlotDepart2).appendChild(document.getElementById(idJoueurADeplacer2));
    console.log(document.getElementById(idSlotDepart2).childNodes.length)
    document.getElementById(idJoueurADeplacer2).style.opacity = "50%";
    document.getElementById("annuler2").style.visibility = "hidden";

    document.getElementById("recharger2").style.visibility = "hidden";
    verif()
}
function resetMove2() {
    document.getElementById("source"+document.getElementById(idJoueurADeplacer2).id).appendChild(document.getElementById(idJoueurADeplacer2));
    document.getElementById("recharger2").style.visibility = "hidden";
    document.getElementById("annuler2").style.visibility = "hidden";
    document.getElementById("quit2").style.visibility = "hidden";
    nbJoueursPlacesE2--;
    ok2 = true;
    verif();
}
function resetMove() {
    document.getElementById("source"+document.getElementById(idJoueurADeplacer).id).appendChild(document.getElementById(idJoueurADeplacer));
    document.getElementById("recharger").style.visibility = "hidden";
    console.log("haha 2")
    document.getElementById("quit").style.visibility = "hidden";
    document.getElementById("annuler").style.visibility = "hidden";
    nbJoueursPlacesE1--;
    ok = true;
    verif();
}
function reset1(){
    nbJoueursPlacesE1 = 0;
    for(i = 12;i<23;i++){
        idJoueurADeplacer = ""+i+"";
        if(document.getElementById("target"+idJoueurADeplacer) && document.getElementById("target"+idJoueurADeplacer).childNodes.length>0){
            var child = document.getElementById("target"+idJoueurADeplacer).lastChild;
            console.log(child+"| source"+child.id)
            console.log(document.getElementById("source"+document.getElementById(child.id)))
            document.getElementById("source"+child.id).appendChild(child);
        }

    }
    document.getElementById("recharger").style.visibility = "hidden";
    document.getElementById("annuler").style.visibility = "hidden";
    document.getElementById("quit").style.visibility = "hidden";
    ok = false;
    verif();
}
function reset2(){
    nbJoueursPlacesE2 = 0;
    for(i = 1;i<12;i++){
        idJoueurADeplacer2 = ""+i+"";
        if(document.getElementById("target"+idJoueurADeplacer2) && document.getElementById("target"+idJoueurADeplacer2).childNodes.length>0){
            var child = document.getElementById("target"+idJoueurADeplacer2).lastChild;
            console.log(child+"| source"+child.id)
            console.log(document.getElementById("source"+document.getElementById(child.id)))
            document.getElementById("source"+child.id).appendChild(child);
        }
    }
    document.getElementById("quit2").style.visibility = "hidden";
    document.getElementById("recharger2").style.visibility = "hidden";
    document.getElementById("annuler2").style.visibility = "hidden";
    ok2 = false;
    verif();
}
function dragWithoutMouseStarted(ev){
    if(ok){
        provenance = 1;
        idSlotDepart = ev.target.parentNode.id;
        idJoueurADeplacer = ev.target.id;
        document.getElementById(idJoueurADeplacer).style.opacity = "100%";
        console.log("DRAG");
        console.log(document.getElementById("quit"))
        document.getElementById("quit").style.visibility = "visible";
        console.log(document.getElementById("quit"))
        console.log("DRAG");
        document.getElementById("recharger").style.visibility = "visible";
        ok = false;
        console.log( document.getElementById("recharger").style.visibility)
        verif();
        console.log( document.getElementById("recharger").style.visibility)
    }

}

function dragWithoutMouseStarted2(ev){
    if(ok2){
        provenance = 2;
        idSlotDepart2 = ev.target.parentNode.id;
        idJoueurADeplacer2 = ev.target.id;
        document.getElementById(idJoueurADeplacer2).style.opacity = "100%";
        document.getElementById("quit2").style.visibility = "visible";
        document.getElementById("recharger2").style.visibility = "visible";
        ok2 = false;
        verif();
    }

}
function dropWithoutMouseFinished(ev){
    if(ev && provenance == 1   && ev.target.tagName=="DIV"){
        ev.preventDefault();
        console.log("hAHA 1")
        ev.target.appendChild(document.getElementById(idJoueurADeplacer));
        document.getElementById("annuler").style.visibility = "visible";
        document.getElementById("recharger").style.visibility = "visible";
        document.getElementById("quit").style.visibility = "hidden";
    }
    validate()
    verif();
}
function dropWithoutMouseFinished2(ev){
    if(ev && provenance == 2   && ev.target.tagName=="DIV"){
        ev.preventDefault();
        ev.target.appendChild(document.getElementById(idJoueurADeplacer2));
        document.getElementById("annuler2").style.visibility = "visible";
        document.getElementById("recharger2").style.visibility = "visible";
        document.getElementById("quit2").style.visibility = "hidden";
    }
    validate2();
}
function validate(){
    document.getElementById(idJoueurADeplacer).parentNode.style.backgroudColor = "green"
    document.getElementById(idJoueurADeplacer).style.opacity = "50%";
    ok = true;
    document.getElementById("gardienE1").value = ""
    document.getElementById("ligne1E1").value = ""
    document.getElementById("ligne2E1").value = ""
    document.getElementById("ligne3E1").value = ""
    document.getElementById("ligne4E1").value = ""
    nbJoueursPlacesE1 = 0;
    for(let n = 12;n<23;n++){
        if(document.getElementById("target"+n).hasChildNodes()){
            nbJoueursPlacesE1++;
            if(n == 12){
                document.getElementById("gardienE1").value = document.getElementById("target"+n).children[0].id
            }
            if(n>=13 && n<=(12+Number(tactique1[0]))){
                document.getElementById("ligne1E1").value += ","+document.getElementById("target"+n).children[0].id+""
            }
            if(n>=13+Number(tactique1[0]) && n<=(12+Number(tactique1[0])+Number(tactique1[1]))){
                document.getElementById("ligne2E1").value += ","+document.getElementById("target"+n).children[0].id+""
            }
            if(n>=13+Number(tactique1[0])+Number(tactique1[1]) && n<=(12+Number(tactique1[0])+Number(tactique1[1])+Number(tactique1[2]))){
                document.getElementById("ligne3E1").value += ","+document.getElementById("target"+n).children[0].id+""
            }
            if(n>=13+Number(tactique1[0])+Number(tactique1[1])+Number(tactique1[2]) && n<(13+Number(tactique1[0])+Number(tactique1[1])+Number(tactique1[2])+Number(tactique1[3]))){
                document.getElementById("ligne4E1").value += ","+document.getElementById("target"+n).children[0].id+""
            }
        }
    }
    verif();
}
function quit(){
    document.getElementById(idJoueurADeplacer).style.opacity = "50%";
    document.getElementById("recharger").style.visibility = "hidden";
    console.log("QUIT");
    document.getElementById("quit").style.visibility = "hidden";
    ok = true;
    verif();
}
function quit2(){
    document.getElementById(idJoueurADeplacer2).style.opacity = "50%";
    document.getElementById("recharger2").style.visibility = "hidden";
    document.getElementById("quit2").style.visibility = "hidden";
    ok = true;
    verif();
}
function verif(){
    console.log(nbJoueursPlacesE1+"/"+nbJoueursE1+","+nbJoueursPlacesE2+"/"+nbJoueursE2+","+ok+","+ok2);
    if(nbJoueursPlacesE1 == nbJoueursE1 && nbJoueursPlacesE2 == nbJoueursE2 && ok &&ok2){
        document.getElementById("valid").removeAttribute("disabled");
    }else{
        document.getElementById("valid").setAttribute("disabled","");
    }
}
function validate2(){
    document.getElementById(idJoueurADeplacer2).parentNode.style.backgroudColor = "green"
    document.getElementById(idJoueurADeplacer2).style.opacity = "50%";
    ok2 = true;
    document.getElementById("gardienE2").value = ""
    document.getElementById("ligne1E2").value = ""
    document.getElementById("ligne2E2").value = ""
    document.getElementById("ligne3E2").value = ""
    document.getElementById("ligne4E2").value = ""
    nbJoueursPlacesE2 = 0;
    for(let n = 1;n<12;n++){
        if(document.getElementById("target"+n).hasChildNodes()){
            console.log(n)
            nbJoueursPlacesE2++;
            if(n == 1){
                console.log("GARDIEN: "+n)
                document.getElementById("gardienE2").value = document.getElementById("target"+n).children[0].id
            }
            if(n>=2 && n<=(1+Number(tactique2[0]))){
                console.log("LIGNE 1: "+n)
                document.getElementById("ligne1E2").value += ","+document.getElementById("target"+n).children[0].id+""
            }

            if(n>=2+Number(tactique2[0]) && n<=(1+Number(tactique2[0])+Number(tactique2[1]))){
                console.log("LIGNE 2: "+n)
                document.getElementById("ligne2E2").value += ","+document.getElementById("target"+n).children[0].id+""
            }
            if(n>=2+Number(tactique2[0])+Number(tactique2[1]) && n<=(1+Number(tactique2[0])+Number(tactique2[1])+Number(tactique2[2]))){
                console.log("LIGNE 3: "+n)
                document.getElementById("ligne3E2").value += ","+document.getElementById("target"+n).children[0].id+""
            }
            if(n>=2+Number(tactique2[0])+Number(tactique2[1])+Number(tactique2[2]) && n<(2+Number(tactique2[0])+Number(tactique2[1])+Number(tactique2[2])+Number(tactique2[3]))){
                console.log("LIGNE 4: "+n)
                document.getElementById("ligne4E2").value += ","+document.getElementById("target"+n).children[0].id+""
            }
        }
    }
    verif();
}

function dragstart_handler(ev) {

        provenance = 1;
        idJoueurADeplacer = ev.target.id;
        idSlotDepart = ev.target.parentNode.id;
        // On ajoute l'identifiant de l'élément cible à l'objet de transfert
        ev.dataTransfer.setData("application/my-app", ev.target.id);
        ev.dataTransfer.dropEffect = "move";


}
function dragstart_handler2(ev) {

        console.log("BIEN COMMENCE")
        provenance = 2;
        idJoueurADeplacer2 = ev.target.id;
        idSlotDepart2 = ev.target.parentNode.id;
        // On ajoute l'identifiant de l'élément cible à l'objet de transfert
        ev.dataTransfer.setData("application/my-app", ev.target.id);
        ev.dataTransfer.dropEffect = "move";

}
function dragover_handler(ev) {
    ev.preventDefault();
    ev.dataTransfer.dropEffect = "move"
}
function drop_handler(ev) {
    ev.preventDefault();
    // idSlotDest = Number(ev.target.id.substring(6,8))
    console.log("ICI ->"+provenance)
    if(provenance == 1 && ev.target.tagName=="DIV"){
        document.getElementById("quit").style.visibility = "hidden";
        // On obtient l'identifiant de la cible et on ajoute l'élément déplacé
        // au DOM de la cible
        var data = ev.dataTransfer.getData("application/my-app");
        console.log(data)
        ev.target.appendChild(document.getElementById(data));
        document.getElementById("annuler").style.visibility = "visible";
        document.getElementById("recharger").style.visibility = "visible";
    }
    ok = false;
    validate();
    verif();
    console.log(ok);
}
function drop_handler2(ev) {
    ev.preventDefault();
    if(provenance == 2   && ev.target.tagName=="DIV"){
        idSlotDest = Number(ev.target.id.substring(6,8))
        // FIN
        // On obtient l'identifiant de la cible et on ajoute l'élément déplacé
        // au DOM de la cible
        var data = ev.dataTransfer.getData("application/my-app");
        ev.target.appendChild(document.getElementById(data));
        document.getElementById("quit2").style.visibility = "hidden";
        document.getElementById("annuler2").style.visibility = "visible";
        document.getElementById("recharger2").style.visibility = "visible";
    }
    ok2 = false;
    validate2();
    verif();
}


