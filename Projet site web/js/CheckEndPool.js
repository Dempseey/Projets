
function checkMatchs()
{
    var notStartedDiv = document.getElementById('notStarted');
    var startedDiv = document.getElementById('started');
    var onWaitDiv = document.getElementById('onWait');
    
    if(
        (notStartedDiv.childNodes[3].textContent == "No match are waiting to go.") &&
        (startedDiv.childNodes[3].textContent == "No match in course.") && 
        (onWaitDiv.childNodes[3].textContent == "No match is waiting for a winner.")
    )
    {
        var getWin = document.createElement('button');
        getWin.name = 'getWinButton';
        getWin.id = 'getWinButton';
        getWin.innerHTML = "End pools";
        getWin.onclick = function() {
            getWinnerHidden();
        };

        document.getElementById('getWinner').append(getWin);

    }
}


function getWinnerHidden()
{
    document.getElementById('getWinButton').remove();

    var div = document.createElement('div');
    div.id = 'inputHidden';
    div.className = 'buttonDiv';
    document.getElementById('getWinner').append(div);

    var getForm = document.createElement('form');
    getForm.method = 'post';
    getForm.id = 'form_id';
    document.getElementById(div.id).append(getForm);

    var divdiv = document.createElement('div');
    divdiv.id = 'div_div';
    divdiv.className = 'buttonDiv';
    document.getElementById(getForm.id).append(divdiv);

    var labSel = document.createElement('label');
    labSel.innerHTML = "<p>How many winners do you want ?</p>";
    document.getElementById(divdiv.id).append(labSel);

    var howManyWinner = document.createElement('select');
    howManyWinner.name = 'winnerNumber';
    howManyWinner.id = 'winner_select';
    document.getElementById(divdiv.id).append(howManyWinner);


    var nb_pool_for_select = $_GET('nbPls');
    var nb_eqs = $_GET('nbEq');

    if(nb_pool_for_select <= 2)
    {
        if(nb_eqs > 2)
        {
            var option2w = document.createElement('option');
            option2w.value = '2w';
            option2w.innerHTML = '2 winners';
            document.getElementById(howManyWinner.id).append(option2w);
        }

        if(nb_eqs > 4)
        {
            var option4w = document.createElement('option');
            option4w.value = '4w';
            option4w.innerHTML = '4 winners';
            document.getElementById(howManyWinner.id).append(option4w);
        }

        if(nb_eqs > 8)
        {
            var option8w = document.createElement('option');
            option8w.value = '8w';
            option8w.innerHTML = '8 winners';
            document.getElementById(howManyWinner.id).append(option8w);
        }

        if(nb_eqs > 16)
        {
            var option16w = document.createElement('option');
            option16w.value = '16w';
            option16w.innerHTML = '16 winners';
            document.getElementById(howManyWinner.id).append(option16w);
        }
    }
    
    else if(nb_pool_for_select <= 4)
    {
        if(nb_eqs > 4)
        {
            var option4w = document.createElement('option');
            option4w.value = '4w';
            option4w.innerHTML = '4 winners';
            document.getElementById(howManyWinner.id).append(option4w);
        }

        if(nb_eqs > 8)
        {
            var option8w = document.createElement('option');
            option8w.value = '8w';
            option8w.innerHTML = '8 winners';
            document.getElementById(howManyWinner.id).append(option8w);
        }

        if(nb_eqs > 16)
        {
            var option16w = document.createElement('option');
            option16w.value = '16w';
            option16w.innerHTML = '16 winners';
            document.getElementById(howManyWinner.id).append(option16w);
        }

    }
    else if(nb_pool_for_select <= 8)
    {
        if(nb_eqs > 8)
        {
            var option8w = document.createElement('option');
            option8w.value = '8w';
            option8w.innerHTML = '8 winners';
            document.getElementById(howManyWinner.id).append(option8w);
        }

        if(nb_eqs > 16)
        {
            var option16w = document.createElement('option');
            option16w.value = '16w';
            option16w.innerHTML = '16 winners';
            document.getElementById(howManyWinner.id).append(option16w);
        }

    } 
    else if(nb_pool_for_select <= 16)
    {
        if(nb_eqs > 16)
        {
            var option16w = document.createElement('option');
            option16w.value = '16w';
            option16w.innerHTML = '16 winners';
            document.getElementById(howManyWinner.id).append(option16w);
        }
    }

    var subButtonWin = document.createElement('button');
    subButtonWin.type = 'button';
    subButtonWin.name = 'getwin_button';
    subButtonWin.id = 'getwin_button';
    subButtonWin.innerHTML = 'Get winners';
    subButtonWin.onclick = function() {
        showWinner();
    };

    document.getElementById(getForm.id).append(subButtonWin);

}




function showWinner()
{
    document.getElementById('getwin_button').remove();

    var nb_win = document.getElementById('winner_select').value;

    document.getElementById('div_div').remove();

    var nb_pool_for_win = $_GET('nbPls');
    var cpt_winner = 1;


    switch(nb_win)
    {
        case '2w' :

            var winner_cpt = 1;

            var nb_winner_input = document.createElement('input');
            nb_winner_input.type = 'hidden';
            nb_winner_input.value = '2';
            nb_winner_input.name = 'nb_winner';
            document.getElementById('form_id').append(nb_winner_input);
            
            var tab_Winner = new Array();
            var cpt_array_winner = 0;
            var pool_count = 1;

            while(tab_Winner.length <= 1)
            {
                if(pool_count > nb_pool_for_win) pool_count = 1;
                
                var winner_id = findWinnerNb(pool_count, tab_Winner);
                var team_id = document.getElementsByName(winner_id)[0].innerHTML;
                tab_Winner[cpt_array_winner] = team_id;
                cpt_array_winner++;

                var untouch_input = document.createElement('input');
                untouch_input.name = 'winnernb_'+winner_cpt;
                untouch_input.value = team_id;
                untouch_input.readOnly = 'readonly';

                document.getElementById('form_id').append(untouch_input);

                pool_count++;
                cpt_winner++;
                winner_cpt++;

            }
            break;


        case '4w' :

            var winner_cpt = 1;

            var nb_winner_input = document.createElement('input');
            nb_winner_input.type = 'hidden';
            nb_winner_input.value = '4';
            nb_winner_input.name = 'nb_winner';
            document.getElementById('form_id').append(nb_winner_input);

            var tab_Winner = new Array();
            var cpt_array_winner = 0;
            var pool_count = 1;

            while(tab_Winner.length <= 3)
            {
                if(pool_count > nb_pool_for_win) pool_count = 1;
                
                var winner_id = findWinnerNb(pool_count, tab_Winner);
                var team_id = document.getElementsByName(winner_id)[0].innerHTML;
                tab_Winner[cpt_array_winner] = team_id;
                cpt_array_winner++;

                var untouch_input = document.createElement('input');
                untouch_input.name = 'winnernb_'+winner_cpt;
                untouch_input.value = team_id;
                untouch_input.readOnly = 'readonly';

                document.getElementById('form_id').append(untouch_input);

                pool_count++;
                cpt_winner++;
                winner_cpt++;

            }
            break;



        case '8w' :

            var winner_cpt = 1;

            var nb_winner_input = document.createElement('input');
            nb_winner_input.type = 'hidden';
            nb_winner_input.value = '8';
            nb_winner_input.name = 'nb_winner';
            document.getElementById('form_id').append(nb_winner_input);

            var tab_Winner = new Array();
            var cpt_array_winner = 0;
            var pool_count = 1;

            while(tab_Winner.length <= 7)
            {
                if(pool_count > nb_pool_for_win) pool_count = 1;
                
                var winner_id = findWinnerNb(pool_count, tab_Winner);
                var team_id = document.getElementsByName(winner_id)[0].innerHTML;
                tab_Winner[cpt_array_winner] = team_id;
                cpt_array_winner++;

                var untouch_input = document.createElement('input');
                untouch_input.name = 'winnernb_'+winner_cpt;
                untouch_input.value = team_id;
                untouch_input.readOnly = 'readonly';

                document.getElementById('form_id').append(untouch_input);

                pool_count++;
                cpt_winner++;
                winner_cpt++;

            }
            break;



        case '16w' :
            var winner_cpt = 1;

            var nb_winner_input = document.createElement('input');
            nb_winner_input.type = 'hidden';
            nb_winner_input.value = '16';
            nb_winner_input.name = 'nb_winner';
            document.getElementById('form_id').append(nb_winner_input);

            var tab_Winner = new Array();
            var cpt_array_winner = 0;
            var pool_count = 1;

            while(tab_Winner.length <= 15)
            {
                if(pool_count > nb_pool_for_win) pool_count = 1;
                
                var winner_id = findWinnerNb(pool_count, tab_Winner);
                var team_id = document.getElementsByName(winner_id)[0].innerHTML;
                tab_Winner[cpt_array_winner] = team_id;
                cpt_array_winner++;

                var untouch_input = document.createElement('input');
                untouch_input.name = 'winnernb_'+winner_cpt;
                untouch_input.value = team_id;
                untouch_input.readOnly = 'readonly';

                document.getElementById('form_id').append(untouch_input);

                pool_count++;
                cpt_winner++;
                winner_cpt++;

            }
            break;

    }

    var divButtonBracket = document.createElement('div');
    divButtonBracket.id = 'bracketb_div';
    divButtonBracket.className = 'buttonDiv';
    divButtonBracket.innerHTML = '</br></br>';
    
    document.getElementById('form_id').append(divButtonBracket);


    var startMiniBracket = document.createElement('button');
    startMiniBracket.type = 'submit';
    startMiniBracket.name = 'startBracket';
    startMiniBracket.innerText = 'Start bracket';

    document.getElementById(divButtonBracket.id).append(startMiniBracket);

}





function findWinnerNb(wichPool_nb, tab)
{
    var tabScoreCroissant = new Array();
    var cpt_array = 0;
    var temp_id = 'poulecol'+wichPool_nb+'_';
    var pool_length = 0;

    for(var i=1; document.getElementById(temp_id+i); i++)
    {
        pool_length++;
        tabScoreCroissant[cpt_array] = document.getElementById(temp_id+i);
        cpt_array++;
    }

    var tabScoreTrie = triTableau(tabScoreCroissant);

    var x = 0;

    while(x < tabScoreTrie.length)
    {
        var actualElt = tabScoreTrie[x].childNodes[1].getAttribute('name');
        var comp_elt = document.getElementsByName(actualElt)[0].innerHTML;
        if(!inTab(comp_elt, tab))
        {
            return actualElt;
        }

        x++;
    }

}



function inTab(elmt, tab)
{
    for(var i=0; i<tab.length-1 ; i++)
    {
        if(tab[i] == elmt)
        {
            return true;
        }
    }

    return false;
}


function triTableau(tab)
{
    var check = false;
    var taille = tab.length;

    while(!check)
    {
        check = true;
        for(var i=0 ; i < taille-1 ; i++)
        {
            var i_n = new Number(i);
            var val_i = new Number(tab[i].nextSibling.innerText)
            var val_i2 = new Number(tab[i_n+1].nextSibling.innerText);
            if(val_i < val_i2)
            {
                var ech = tab[i];
                tab[i] = tab[i_n+1];
                tab[i_n+1] = ech;
                
                check = false;
            }
        }
        taille--;
    }

    return tab;

}