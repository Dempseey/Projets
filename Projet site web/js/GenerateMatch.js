
function randomMatch() {

    teamCount = nb_eq();
    poolCount = nb_pool();

    for(var i=1 ; i <= poolCount ; i++)
    {
        var nbvers = howManyTeamsIn(i);
        var nbTeamInPool = new Number(nbvers);

        var arrayTeamInPool = getTeamFromPool(i); //Renvoie un tableau contenant les id des teams présententes dans la poule i

        var cptMatch = 1; //Compteur de matchs pour ne pas dépasser le nombre de match dans la poule calculés ci-dessous
        var nbMatchInPool =  nbTeamInPool * ((nbTeamInPool - 1) / 2); // Formule pour savoir le nombre de matchs dans une poule selon le nombre d'équipes
            //alert("Il va y avoir "+nbMatchInPool+ " matchs dans la poule "+i);
            
        var divId = createDivPool(i);
            //alert("n° du div de la poule"+i+ " = "+divId);

        var countArrayMatch = 0;

        var arrayMatch = getCombiMatch(arrayTeamInPool, arrayTeamInPool.length, nbMatchInPool);
            //alert("liste des matchs : "+arrayMatch);

        while(cptMatch <= nbMatchInPool)
        {
    
            var idDivMatch = createDivMatch(cptMatch, divId);
                //alert("div du match n°"+cptMatch+ " = "+idDivMatch);
            var tableMatchId = createMatchTable(idDivMatch, cptMatch);
                //alert("id de la table qui va accueillir ce match : "+tableMatchId);

    ////////////////////////////////////////////////////////////////////////////////////////////////////
                
    ////////////////////////////////////////////////////////////////////////////////////////////////////

            var actualMatch = arrayMatch[countArrayMatch];
                //alert("match en traitement : "+actualMatch);
            countArrayMatch++;

            var firstTeamNameId = actualMatch.substring(0, actualMatch.indexOf("-"));
            var secondTeamNameId = actualMatch.substring(actualMatch.indexOf("-") + 1);
            var firstTeamName = getTeamNameFrom_NameId(firstTeamNameId);
            var secondTeamName = getTeamNameFrom_NameId(secondTeamNameId);

            andTrTd(firstTeamName, firstTeamNameId, secondTeamName, secondTeamNameId, tableMatchId);
                //alert("match ("+firstTeamName+" VERSUS "+secondTeamName+") a été traité");
                cptMatch++;
        }



    }

    document.getElementById('genbutton').remove();
    createSubmitButton();
}







function createDivPool(poolNumber)
{
    var divPoolMatch = document.createElement('div');
    divPoolMatch.setAttribute('id', 'name');
    divPoolMatch.id = 'divPfM_'+poolNumber;
    divPoolMatch.name = 'divPfM_'+poolNumber;
    divPoolMatch.innerHTML = '</br></br> Matches of the Pool n°'+poolNumber;
	divPoolMatch.style.fontSize = "30px";
	divPoolMatch.style.color = "#FFF";
    divPoolMatch.className = "buttonDiv";

    document.getElementById('showmatch').appendChild(divPoolMatch);

    return divPoolMatch.id;

}



function createDivMatch(matchNumber, divPoolId)
{
    var divMatch = document.createElement('div');
    divMatch.setAttribute('id', 'name');
    divMatch.id = 'divM_'+divPoolId+'_'+matchNumber;
    divMatch.name = 'divM_'+divPoolId+'_'+matchNumber;

    document.getElementById(divPoolId).appendChild(divMatch);

    return divMatch.id;
}



function createMatchTable(divMatchId, matchNumber)
{
    var matchTable = document.createElement('table'); 
    matchTable.setAttribute('id', 'name');
    matchTable.id = 'table_'+divMatchId;
    matchTable.name = 'table_'+divMatchId;
	matchTable.style.backgroundColor = '#DF2121';
	matchTable.style.marginLeft = '5%';

    document.getElementById(divMatchId).appendChild(matchTable);


    var titleLine = document.createElement('tr');
    titleLine.setAttribute('id', 'name');
    titleLine.id = 'titleline_'+divMatchId;
    titleLine.name = 'titleline_'+divMatchId;

    document.getElementById(matchTable.id).appendChild(titleLine);


    var titleCase = document.createElement('th');
    titleCase.setAttribute('id','name');
    titleCase.id = 'titleCase_'+divMatchId;
    titleCase.name = 'titleCase_'+divMatchId;
    titleCase.innerHTML = 'Match n°'+matchNumber;
	titleCase.style.fontSize = "20px";
	titleCase.style.color = "#FFF";
	titleCase.style.textDecoration = "underline";
    titleCase.colSpan = '3';

    document.getElementById(titleLine.id).appendChild(titleCase);

    return matchTable.id;
    
}


function andTrTd(team1_name, team1_id, team2_name, team2_id, matchTableId)
{
    var trElement = document.createElement('tr');
    trElement.setAttribute('id', 'name');
    trElement.id = 'versusline_'+matchTableId;
    trElement.name = 'versusline_'+matchTableId;

    document.getElementById(matchTableId).appendChild(trElement);



    var tdCase1 = document.createElement('td');
    tdCase1.setAttribute('id', 'class');
    tdCase1.className = "caseteam_"+matchTableId;
    tdCase1.id = 'caseteam_'+matchTableId+'_'+team1_id;
    tdCase1.innerHTML = team1_name;
	tdCase1.style.fontSize = "20px";
    document.getElementById(trElement.id).appendChild(tdCase1);

    var tdCaseVS = document.createElement('td');
    tdCaseVS.name = 'versusline_'+matchTableId;
    tdCaseVS.innerHTML = " VERSUS ";
	tdCaseVS.style.color = "#FFF";
	tdCaseVS.style.fontSize = "10px";
    document.getElementById(trElement.id).appendChild(tdCaseVS);

    var tdCase2 = document.createElement('td');
    tdCase2.setAttribute('id', 'class');
    tdCase2.className = "caseteam_"+matchTableId;
    tdCase2.id = 'caseteam_'+matchTableId+'_'+team2_id;
    tdCase2.innerHTML = team2_name;
	tdCase2.style.fontSize = "20px";
    document.getElementById(trElement.id).appendChild(tdCase2);

}

function getTeamFromPool(x)
{
    var poolName = 'P'+x;
    var tabRes = new Array();

    for(var i=0; i < pool_array.length; i++)
    {
        if(pool_array[i].startsWith(poolName))
        {
            var j = new Number(i);
        }
    }

    j += 1;

    for(j ; j < pool_array.length ; j ++)
    {
        if(pool_array[j].startsWith('P'))
        {
            return tabRes;
        }
        else
        {
            tabRes.push(pool_array[j]);
        }
    }

    return tabRes;
}


function getTeamNameFrom_NameId(nameTeamId)
{
    return document.getElementsByName(nameTeamId)[0].textContent;
}


function getCombiMatch(arrayTeam, taille, nbMatch)
{
    var arrayMatchRes = new Array();
    var cpt = nbMatch;

    while(cpt > 0)
    {
        var randNb1 = Math.floor(Math.random() * taille);
        var randNb2 = Math.floor(Math.random() * taille);
        var randTeam1 = arrayTeam[randNb1];
        var randTeam2 = arrayTeam[randNb2];

        if(!(randNb1 == randNb2))
        {
            
            if(arrayMatchRes.length == 0)
            {
                var comb1 = randTeam1+'-'+randTeam2;
                arrayMatchRes.push(comb1);
                cpt--;
            }
            else
            {
                var check = false;
                for(var i=0; !check && i < arrayMatchRes.length; i++)
                {
                    var comb1 = randTeam1+'-'+randTeam2;
                    var comb2 = randTeam2+'-'+randTeam1;
                    if((arrayMatchRes[i] == comb1)||(arrayMatchRes[i] == comb2))
                    {
                        check = true;
                        
                    }
                }
                if(!check)
                {
                    arrayMatchRes.push(comb1);
                    cpt--;
                }
            }
        }

    }

    return arrayMatchRes;

}


function createSubmitButton()
{
    var subButton = document.createElement('button');
    subButton.setAttribute('id', 'type', 'name');
    subButton.id = 'confirmMatch';
    subButton.name = 'confirmMatch';
    subButton.type = 'button';
    subButton.innerHTML = "Confirm the matches </br>";
    subButton.onclick = function(){sendAllMatchs();};


    document.getElementById('subButton').appendChild(subButton);

}





function $_GET(param) {
    var vars = {};
    window.location.href.replace( location.hash, '' ).replace( 
        /[?&]+([^=&]+)=?([^&]*)?/gi, 
        function( m, key, value ) { 
            vars[key] = value !== undefined ? value : '';
        }
    );

    if ( param ) {
        return vars[param] ? vars[param] : null;	
    }
    return vars;
}



function showbutton()
{
    window.location = 'PoolConfirm.php?tourneyId='+$_GET('tourneyId')+'&nbPls='+nb_pool()+'&nbEq='+nb_eq();

}
