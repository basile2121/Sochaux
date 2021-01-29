
function dragstart_handler(ev) {
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
    // On obtient l'identifiant de la cible et on ajoute l'élément déplacé
    // au DOM de la cible
    var data = ev.dataTransfer.getData("application/my-app");
    ev.target.appendChild(document.getElementById(data));
}

function reset(){
    for(i = 1;i<12;i++){
        for(j = 1;j<5;j++){
            if(document.getElementById("target"+i) != null && document.getElementById("target"+i).childNodes.length > 0){
                alert(document.getElementById("target"+i));
                console.log("target"+i);
                document.getElementById("target"+i).removeChild(document.getElementById("target"+i).lastChild);
            }
        }
    }
    while (document.getElementById("listeJoueurs").firstChild) {
        document.getElementById("listeJoueurs").removeChild(document.getElementById("listeJoueurs").lastChild);
    }
    afficheJoueurs();

}
function afficheJoueurs(){
    var liste = ["numero.png","griezmann.jpeg","muller.jpeg","ronaldo.jpeg","neuer.jpeg"];

    for(i = 0;i<10;i++){
        var element = document.createElement("img");
        element.className = "element";
        element.setAttribute("ondragstart","dragstart_handler(event)");
        element.id = "joueur"+i;
        element.width = 50;
        element.style = "border-radius: 3em;";
        element.style.position = "relative";
        element.draggable = true;
        element.src = liste[i];
        document.getElementById("listeJoueurs").appendChild(element);
    }
}
function afficheTargets(){
    for(i = 1;i<11;i++){
        const element = document.createElement("div");
        element.className = "target";
        element.id = "target"+i;
        element.setAttribute("ondragover","dragover_handler(event)");
        element.setAttribute("ondrop","drop_handler(event)");
        document.getElementById("terrain").appendChild(element);
    }
}
