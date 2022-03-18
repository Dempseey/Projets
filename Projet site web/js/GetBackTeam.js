function goBack()
{
    var i=1;
    var allTeamHere = true;
    while(i <= $_GET('nbEq') && allTeamHere)
    {
        var id = 'teamdrag'+i;
        var eq = document.getElementById(id).parentElement.id;
        if(!(eq == 'backTeam'))
        {
            allTeamHere = false;
        }
        i++;
    }

    if(!allTeamHere)
    {
        for(var j=1; j<= $_GET('nbEq'); j++)
        {
            var id = 'teamdrag'+j;
            var eq = document.getElementById(id).parentElement.id
            var depot = document.getElementById('backTeam');
            if(!(eq == 'backTeam'))
            {
                depot.append(document.getElementById(id));
            }
        }

    }
    else
    {
        alert("All the teams are already in the repository!");
    }
}