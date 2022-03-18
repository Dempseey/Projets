document.getElementById("nb_players").onchange = function() {
    document.querySelector("#add_players_firstnames").innerHTML = '';
    document.querySelector("#add_players_names").innerHTML = '';
    var j = 'p_joueur';
    var j2 = 'n_joueur';
    var n = 'Prénom du joueur n°';
    var n2 = 'Nom du joueur n°';
    for(var i = 0; i < document.getElementById("nb_players").value; i++) {
        var inputP = document.createElement("input");
        inputP.setAttribute('name', 'id', 'type', 'placeholder', 'required');
        inputP.name = j+i ;
        inputP.id =  j+i ;
        inputP.type = 'text';
        inputP.placeholder = n+(i+1);
        
        var inputN = document.createElement("input");
        inputN.setAttribute('name', 'id', 'type', 'placeholder', 'required');
        inputN.name = j2+i ;
        inputN.id =  j2+i ;
        inputN.type = 'text';
        inputN.placeholder = n2+(i+1);

        document.getElementById("add_players_firstnames").append(inputP);
        document.getElementById(inputP.id).required = true;
        document.getElementById("add_players_names").append(inputN);
        document.getElementById(inputN.id).required = true;

    }
}
