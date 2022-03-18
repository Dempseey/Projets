
function getTeamStart()
{
    var deposit = document.getElementById('backTeam').innerText;

    if(deposit == "")
    {
        var bracketNb = findBnb();
        var t_id = 'Drag';

        switch (bracketNb)
        {
            case '2' :
                var nbT = document.createElement('input');
                nbT.type = 'hidden';
                nbT.name = 'nbTeams';
                nbT.value = '2';
                document.getElementById('get_ts').append(nbT);

                for(var i=1; i<=2; i++)
                {
                    var team_div = document.getElementById(t_id+i);
                    
                    var hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'team'+i;
                    hiddenInput.value = team_div.childNodes[1].getAttribute('name');
                    document.getElementById('get_ts').append(hiddenInput);
                }
            break;

            case '4' :
                var nbT = document.createElement('input');
                nbT.type = 'hidden';
                nbT.name = 'nbTeams';
                nbT.value = '4';
                document.getElementById('get_ts').append(nbT);

                for(var i=1; i<=4; i++)
                {
                    var team_div = document.getElementById(t_id+i);
                    
                    var hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'team'+i;
                    hiddenInput.value = team_div.childNodes[1].getAttribute('name');
                    document.getElementById('get_ts').append(hiddenInput);
                }
            break;

            case '8' :
                var nbT = document.createElement('input');
                nbT.type = 'hidden';
                nbT.name = 'nbTeams';
                nbT.value = '8';
                document.getElementById('get_ts').append(nbT);

                for(var i=1; i<=8; i++)
                {
                    var team_div = document.getElementById(t_id+i);
                    
                    var hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'team'+i;
                    hiddenInput.value = team_div.childNodes[1].getAttribute('name');
                    document.getElementById('get_ts').append(hiddenInput);
                }
            break;

            case 16 :
                var nbT = document.createElement('input');
                nbT.type = 'hidden';
                nbT.name = 'nbTeams';
                nbT.value = '16';
                document.getElementById('get_ts').append(nbT);

                for(var i=1; i<=16; i++)
                {
                    var team_div = document.getElementById(t_id+i);
                    
                    var hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'team'+i;
                    hiddenInput.value = team_div.childNodes[1].getAttribute('name');
                    document.getElementById('get_ts').append(hiddenInput);
                }
            break;

        }

        document.getElementById('conf_choices').remove();

        var startButton = document.createElement('button');
        startButton.type = 'submit';
        startButton.name = 'confirm_b_s';
        startButton.innerText = 'Start Bracket';

        document.getElementById('get_ts').append(startButton);

    }

    else
    {
        alert("There is at least one team left in the repository !");
    }

    


}





function findBnb()
{
    var url = window.location.href;
    var ind_nb = 0;

    for(var i=0; i<url.length; i++)
    {
        var actualI = i;
        if(url[i] == 'B')
        {
            i++;
            if(url[i] == 'r')
            {
                i++;
                if(url[i] == 'a')
                {
                    i++;
                    if(url[i] == 'c')
                    {
                        i++;
                        if(url[i] == 'k')
                        {
                            i++;
                            if(url[i] == 'e')
                            {
                                i++;
                                if(url[i] == 't')
                                {
                                    i++;
                                    ind_nb = i;
                                }
                                else i = actualI;
                            }
                            else i = actualI;
                        }
                        else i = actualI;
                    }
                    else i = actualI;
                }
                else i = actualI;
            }
            else i = actualI;
        }



    }

    var newI = new Number(ind_nb);
    newI +=1;
    if(url[newI] == '6') return 16;
    return url[ind_nb];


}