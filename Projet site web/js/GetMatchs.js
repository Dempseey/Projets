function sendAllMatchs()
{
    var nbPool = nb_pool();

    var nbPoolHid = document.createElement('input');
    nbPoolHid.setAttribute('name', 'value', 'type');
    nbPoolHid.name = 'numberofpool';
    nbPoolHid.value = nbPool;
    nbPoolHid.type = 'hidden';

    document.getElementById('sendMatch').append(nbPoolHid);

    var cptPool = 1;

    while(cptPool <= nbPool)
    {
        var t = howManyTeamsIn(cptPool);
        var nbTeamsInThatPool = new Number(t);
        var nbMatchInThatPool = nbMatchInPool('divPfM_'+cptPool);


        var nbMatchIn = document.createElement('input');
        nbMatchIn.setAttribute('name', 'value', 'type');
        nbMatchIn.name = 'pool'+cptPool+'_nbmatch';
        nbMatchIn.value = nbMatchInThatPool;
        nbMatchIn.type = 'hidden';

        document.getElementById('sendMatch').append(nbMatchIn);



        var cptNbMatch = 1;

        while(cptNbMatch <= nbMatchInThatPool)
        {
            var i = 0;
            var tempId = 'caseteam_table_divM_divPfM_'+cptPool+'_'+cptNbMatch;
            var firstTeamId = getTeamWithClass(tempId, i);
            i++;
            var secondTeamId = getTeamWithClass(tempId, i);

            for(var j=1; j<=2; j++)
            {
                if(j==1)
                {
                    var hidInp = document.createElement('input');
                    hidInp.setAttribute('name', 'value', 'type');
                    hidInp.name = 'pool'+cptPool+'_match'+cptNbMatch+'_team'+j;
                    hidInp.value = firstTeamId;
                    hidInp.type = 'hidden';

                    document.getElementById('sendMatch').append(hidInp);
                }
                else
                {
                    var hidInp = document.createElement('input');
                    hidInp.setAttribute('name', 'value', 'type');
                    hidInp.name = 'pool'+cptPool+'_match'+cptNbMatch+'_team'+j;
                    hidInp.value = secondTeamId;
                    hidInp.type = 'hidden';
    
                    document.getElementById('sendMatch').append(hidInp);
                }

            }
            
            cptNbMatch++;

        }


        
        cptPool ++;

    }

    document.getElementById('confirmMatch').remove();



    //showRensMatch();

    var subButton = document.createElement('button');
    subButton.setAttribute('id', 'type', 'name');
    subButton.id = 'invisisub';
    subButton.name = 'invisisub';
    subButton.type = 'submit';
    subButton.innerHTML = "Start</br>";

    document.getElementById('sendMatch').appendChild(subButton);

}




function getNbPool()
{
    document.writeln(nb_pool());
}


function nbMatchInPool(divPoolId)
{
    return document.getElementById(divPoolId).childElementCount - 2;
}


function getTeamWithClass(incId, i)
{
    var temp = document.getElementsByClassName(incId)[i];
    var id = temp.id;

    var ind = 0;

    for(var j=0; j < id.length ; j++)
    {
        if(id[j] == '_')
        {
            var r = j+1;
        }
    }

    var idRes = id.substring(r);

    return idRes;
}











/*
function showRensMatch()
{
    var nbOfPool = nb_pool();
    var cptOfPool = 1;

    while(cptOfPool <= nbOfPool)
    {
        var nbOfMatchIn = nbMatchInPool('divPfM_'+cptOfPool);
        var cptOfMatch = 1;
        var tempIdMatch = 'divM_divPfM_';

        while(cptOfMatch <= nbOfMatchIn)
        {
            var actualIdMatch = tempIdMatch+cptOfPool+'_'+cptOfMatch;

            var divMatch = document.createElement('div');
            divMatch.setAttribute('id', 'class');
            divMatch.id = actualIdMatch+'_div';
            divMatch.className = 'buttonDiv';
            document.getElementById('sendMatch').append(divMatch);

            

            var lab = document.createElement('label');
            var text = document.createTextNode('How long the match n°'+cptOfMatch+' of the pool n°'+cptOfPool+' will last ? (in minutes) : ');
            lab.append(text);
            document.getElementById(divMatch.id).append(lab);


            var mints = document.createElement('input');
            mints.setAttribute('name', 'type', 'min', 'max');
            mints.name = actualIdMatch+'_minutes';
            mints.type = 'number';
            mints.min = '1';
            mints.max = '90';
            mints.required = 'required';

            document.getElementById(divMatch.id).append(mints);



            cptOfMatch ++;


        }

        cptOfPool++;

    }




}*/