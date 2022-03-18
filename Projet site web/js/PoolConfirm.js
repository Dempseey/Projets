function conf_pool(){

    var depotVide = document.getElementById('backTeam').innerText;

    if(depotVide != "")
    {
        alert("There is at least one team in the repositery !");
    }

    else
    {
        var c_nb_poules = new Number($_GET('nbPls'));
        var c_nbEq = new Number($_GET('nbEq'));
        var c_limit = Math.ceil(c_nbEq / c_nb_poules); 

        var cpt_pool = 1;
        var cpt_eq = 1;
        var cpt_lim = 1;
        
        var tableau = new Array();
        var cpt_tab = 0;

        while(cpt_pool <= c_nb_poules)
        {
            tableau[cpt_tab] = 'P'+cpt_pool;
            cpt_tab++;

            for(var i=1; i<= c_limit; i++)
            {
                colid = 'poulecol'+cpt_pool+'_'+i;
                var idDivTeam = document.getElementById(colid).childNodes[1]
                if(idDivTeam) 
                { 
                    idDivTeam = idDivTeam.id; 

                    if(idDivTeam.startsWith('teamdrag'))
                    {
                        actualTeamId = document.getElementById(idDivTeam).getAttribute("name");
                        tableau[cpt_tab] = actualTeamId;
                        cpt_tab ++;
                    }
                }


            }

            cpt_pool ++;
        }

        console.log(tableau);

        window.localStorage.setItem("pool_array", JSON.stringify(tableau)); // Saving

        window.location = 'StartPool.php?tourneyId='+$_GET('tourneyId')+'&nbEq='+$_GET('nbEq');

    }
}
