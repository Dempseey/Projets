var pool_array = new Array();
pool_array = JSON.parse(window.localStorage.getItem("pool_array")); // Retrieving

window.onload = function() { affpoules(); fillPoolWithArray(); DispMatchs(); UpScore(); checkMatchs(); classPools();}

function affpoules()
{

    var nbPoules = nb_pool();
    var nbEq = nb_eq();
    var nomDePoule = 'Pool n°';
    var pouleId = 'poulenumber';
    var lineNumberPoule = 'pouleline';
    var colNumberPoule = 'poulecol';
    var divPouleId = 'divPoule';
    

    document.querySelector("#def_pool").innerHTML = '';

    for(var z=0; z < nbPoules; z++)
    {
        
        var divPoule = document.createElement('div');
        divPoule.setAttribute('id', 'name');
        divPoule.id = divPouleId + (z+1);
        divPoule.name = divPouleId + (z+1);
        

        document.getElementById("def_pool").append(divPoule);
    }


    for(var i = 0; i < nbPoules; i++) {

        var poule = document.createElement('table');
        poule.setAttribute('id', 'name');
        poule.style.width = '150px';
        poule.style.height = 'fit-content';
        poule.style.minHeight = '100px';
        poule.style.marginRight = '10px';
        poule.style.backgroundColor = 'white';
        poule.id = pouleId +  (i+1);
        poule.name = pouleId + (i+1);
        
        
        
        document.getElementById(divPouleId+(i+1)).append(poule);

        var wichPool = new Number(i+1);

        var counter = howManyTeamsIn(wichPool);

        for(var j = 0; j <= counter; j++)
        {
            if(j==0)
            {
                var l_poule = document.createElement('tr');
                l_poule.setAttribute('id', 'name');
                l_poule.id = 'pouletitleline' + (i+1);
                l_poule.name = 'pouletitleline' + (i+1);
    
                document.getElementById(poule.id).append(l_poule);

    
                var col_poule = document.createElement('th');
                col_poule.innerHTML = '<center>'+nomDePoule+(i+1)+'</center>';
                col_poule.setAttribute('id', 'name', 'class', 'colspan');
                col_poule.id = 'pouletitlecol' + (i+1);
                col_poule.name = 'pouletitlecol' + (i+1);
                col_poule.className = "namePoule";
                col_poule.colSpan = '2';
    
                document.getElementById(l_poule.id).append(col_poule);
            }
            
            else if (j!=0)
            {

            var l_poule = document.createElement('tr');
            l_poule.setAttribute('id', 'name');
            l_poule.id = lineNumberPoule + (i+1) + '_' + j;
            l_poule.name = lineNumberPoule + (i+1) + '_' + j;

            document.getElementById(poule.id).append(l_poule);

            var col_poule = document.createElement('td');  
            col_poule.setAttribute('id', 'name');
            col_poule.id = colNumberPoule + (i+1) + '_' + j;
            col_poule.name = colNumberPoule + (i+1) + '_' + j;
            col_poule.innerHTML = " ";
            col_poule.style.Height = 'fit-content';
            col_poule.style.minHeight = '20px';
            col_poule.style.backgroundColor = '#DF2121';
            col_poule.style.color = '#FFF';


            var col_poule_score = document.createElement('td');  
            col_poule_score.setAttribute('id', 'name');
            col_poule_score.id = 'scoreof_'+col_poule.id;
            col_poule_score.name = 'scoreof_'+col_poule.id;
            col_poule_score.innerHTML = "";
            col_poule_score.style.Height = 'fit-content';
            col_poule_score.style.minHeight = '20px';

            document.getElementById(l_poule.id).append(col_poule);
            document.getElementById(l_poule.id).append(col_poule_score);
            
            }

        }


        

    }

}



function nb_pool()
{
    var cpt = 0;
    for(var i=0; i< pool_array.length; i++)
    {
        if(pool_array[i].startsWith('P'))
        {
            cpt++;
        }
    }

    return cpt;
}

function nb_eq()
{
    var cpt = 0;
    for(var i=0; i< pool_array.length; i++)
    {
        if(! (pool_array[i].startsWith('P')))
        {
            cpt++;
        }
    }

    return cpt;
}

function howManyTeamsIn(x)
{
    var pnb = 'P'+x;

    for(var i=0; i < pool_array.length ; i++)
    {
        if(pool_array[i] == pnb)
        {
            var j = new Number(i);
        }
    }

    var cpt = 0;
    j += 1;

    for( j; j < pool_array.length ; j++)
    {
        if(pool_array[j].startsWith('P'))
        {
            return cpt;
        }
        else
        {
            cpt++;
        }
    }

    return cpt;
}


function fillPoolWithArray()
{
    var poolcpt = 1;
    var colcpt = 1;

    var actualPoolNumber = 'P'+poolcpt;
    var actualColPool = 'poulecol'+poolcpt+'_'+colcpt;

    for(var i=1; i < pool_array.length ; i++)
    {
        if(pool_array[i].startsWith('P'))
        {
            poolcpt++;
            actualPoolNumber = 'P'+poolcpt;
            colcpt = 1;
        }
        else
        {
            actualColPool = 'poulecol'+poolcpt+'_'+colcpt;

            idTeam = findTeam(pool_array[i]);

            teamElement = document.getElementById(idTeam);

            document.getElementById(actualColPool).append(teamElement);

            colcpt++;

        }

    }
    

}


function findTeam(x){
    for(var i=1; i <= nb_eq() ; i++)
    {
        var elmt = document.getElementById('teamdrag'+i);
        var elmtName = elmt.getAttribute("name");
        if(elmtName == x)
        {
            return 'teamdrag'+i;
        }

    }
}



function classPools()
{
    var nb_pools = $_GET('nbPls');
    var id_temp = 'poulecol';

    for(var i=1; i <= nb_pools; i++)
    {
        var nbCols = 0;
        for(var j=1; document.getElementById(id_temp+i+'_'+j); j++)
        {
            nbCols++;
        }

        triPool(i, nbCols);
    }

}


function triPool(poolNb, nbColPool)
{
    var tabCol = new Array();
    var cptArray = 0;
    var idT = 'poulecol'+poolNb+'_';

    for(var i=1; i<= nbColPool; i++)
    {
        tabCol[cptArray] = document.getElementById(idT+i);
        cptArray++;
    }

    var tabDecroiss = new Array();
    var cptArray2 = 0;
    var done = false;

    while(!done)
    {
        done = true;

        for(var j=1; j<=nbColPool; j++)
        {
            if(!IsInTab(document.getElementById(idT+j), tabDecroiss))
            {
                var maxCol = document.getElementById(idT+j);
                j = 5000;
                done = false;
            }
        }

        if(!done)
        {
            for(var z=1; z<=nbColPool; z++)
            {
                if(document.getElementById(idT+z) != maxCol)
                {
                    if(Number(document.getElementById(idT+z).nextSibling.innerText) >= Number(maxCol.nextSibling.innerText))
                    {
                        if(!IsInTab(document.getElementById(idT+z), tabDecroiss))
                        {
                            maxCol = document.getElementById(idT+z);
                        }
                    }
                }
            }

            tabDecroiss[cptArray2] = maxCol;
            cptArray2++;
        }

    }

    var tabScore = new Array();

    for(var m=0; m<tabDecroiss.length; m++)
    {
        tabScore[m] = tabDecroiss[m].nextSibling.childNodes[0].cloneNode(true);
        tabDecroiss[m] = tabDecroiss[m].childNodes[1].cloneNode(true);
    }

    var indArray = 0;

    for(var i=1; i<= nbColPool; i++)
    {
        document.getElementById(idT+i).childNodes[1].replaceWith(tabDecroiss[indArray]);
        document.getElementById(idT+i).nextSibling.childNodes[0].replaceWith(tabScore[indArray]);

        indArray++;
    }

}


function IsInTab(elmt, tab)
{
    for(var i=0; i<tab.length ; i++)
    {
        if(tab[i] == elmt)
        {
            return true;
        }
    }

    return false;
}