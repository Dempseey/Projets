function DispMatchs()
{
    var beginId = 'matchnumber';
    var nbMatch = document.getElementById('cptM').childElementCount;
    var cptMatch = 1;
    var exist = true;

    var state0 = 0;
    var state1 = 1;
    var state2 = 2;
    var state3 = 3;

    while(cptMatch <= nbMatch)
    {
        var actualMatch = document.getElementById(beginId+cptMatch+'_'+state0);
        

        if(actualMatch)
        {
            var divLigne = document.createElement('div');
            divLigne.id = 'div_'+cptMatch;
            divLigne.style.clear = 'both';
            document.getElementById('notStarted').append(divLigne);

            document.getElementById(divLigne.id).append(actualMatch);
        }

        cptMatch++;
    }


    var cptMatch = 1;
    while(cptMatch <= nbMatch)
    {
        var actualMatch = document.getElementById(beginId+cptMatch+'_'+state1);
        

        if(actualMatch)
        {
            actualMatch.style.backgroundColor = 'darkseagreen';


            var divLigne = document.createElement('div');
            divLigne.id = 'div_'+cptMatch;
            divLigne.style.clear = 'both';
            document.getElementById('started').append(divLigne);

            document.getElementById(divLigne.id).append(actualMatch);
        }
        cptMatch++;
    }


    var cptMatch = 1;
    while(cptMatch <= nbMatch)
    {
        var actualMatch = document.getElementById(beginId+cptMatch+'_'+state2);

        if(actualMatch)
        {
            actualMatch.style.backgroundColor = 'darksalmon';


            var divLigne = document.createElement('div');
            divLigne.id = 'div_'+cptMatch;
            divLigne.style.clear = 'both';
            document.getElementById('onWait').append(divLigne);

            document.getElementById(divLigne.id).append(actualMatch);
        }
        cptMatch++;
    }


    var cptMatch = 1;
    while(cptMatch <= nbMatch)
    {
        var actualMatch = document.getElementById(beginId+cptMatch+'_'+state3);
        

        if(actualMatch)
        {
            actualMatch.style.backgroundColor = 'grey';


            var divLigne = document.createElement('div');
            divLigne.id = 'div_'+cptMatch;
            divLigne.style.clear = 'both';
            document.getElementById('done').append(divLigne);

            document.getElementById(divLigne.id).append(actualMatch);
        }
        cptMatch++;
    }

    if(! (document.getElementById('notStarted').childNodes[3]))
    { document.getElementById('notStarted').append("No match are waiting to go.") }

    if(! (document.getElementById('started').childNodes[3]))
    { document.getElementById('started').append("No match in course.") }

    if(! (document.getElementById('onWait').childNodes[3]))
    { document.getElementById('onWait').append("No match is waiting for a winner.") }

    if(! (document.getElementById('done').childNodes[3]))
    { document.getElementById('done').append("No even a match is done.") }
    


}