window.onload = function() { placeBracketMatch(); updateUpOrDown(); updateAttribute(); isThereAwinner(); }



function placeBracketMatch()
{
    var howManyRounds = document.getElementById('temp_allT').childElementCount;

    if(howManyRounds > 0)
    {
        var nb_matchs = document.getElementById('temp_allT').childNodes[0].childElementCount;

        for(var j=1; j<= howManyRounds; j++)
        {
            for(var i=1; i<=nb_matchs; i++)
            {
                var div_id_match = j+'_matchNb'+i;
    
                if(document.getElementById(div_id_match))
                {
                    if(document.getElementById(div_id_match).childNodes[0])
                    {
                        if(document.getElementById(div_id_match).childNodes[1])
                        {
                            if(j!=1) {var correct_i = findCorrectI(document.getElementById(div_id_match).childNodes[0].innerText, j, nbMatchsPrec);}
                            else {var correct_i = i;}
                            var team1 = document.getElementById(div_id_match).childNodes[0];
                            var div_match_1 = document.getElementById(j+'_match'+correct_i+'_1');
                            div_match_1.append(team1);
                
                            placeBracketScoreMatch(j,i,correct_i,1);
                        
        
                            if(j!=1) {var correct_i = findCorrectI(document.getElementById(div_id_match).childNodes[0].innerText, j, nbMatchsPrec);}
                            else {var correct_i = i;}
                            var team2 = document.getElementById(div_id_match).childNodes[0];
                            var div_match_2 = document.getElementById(j+'_match'+correct_i+'_2');
                            div_match_2.append(team2);
                
                            placeBracketScoreMatch(j,i,correct_i,2);
                        }
                        else
                        {
                            if(j!=1) {var correct_i = findCorrectI(document.getElementById(div_id_match).childNodes[0].innerText, j, nbMatchsPrec);}
                            else {var correct_i = i;}
                            var team1 = document.getElementById(div_id_match).childNodes[0];
                            var correct_place = findCorrectPlace(document.getElementById(div_id_match).childNodes[0].innerText, j, nbMatchsPrec);
                            var div_match_1 = document.getElementById(j+'_match'+correct_i+'_'+correct_place);
                            div_match_1.append(team1);
                
                            placeBracketScoreMatch(j,i,correct_i,1);
                        }
                        
                    } 
                }
                
                
            }
    
            var nbMatchsPrec = nb_matchs;
            if(j == (howManyRounds - 1)) {nb_matchs = 1;}
            else {nb_matchs = nb_matchs / 2;}
        }
    }
    
    
}


function placeBracketScoreMatch(j,i,correct_i,place)
{
    var div_id_score = j+'_scoreof_matchNb'+i;

    if(place == 1)
    {
        if(document.getElementById(div_id_score).childNodes[0])
        {
            var steam1 = document.getElementById(div_id_score).childNodes[0];
            var div_score_1 = document.getElementById('s_'+j+'_match'+correct_i+'_1');
            div_score_1.append(steam1);
        }
    }
    else
    {
        if(document.getElementById(div_id_score).childNodes[0])
        {
            var steam2 = document.getElementById(div_id_score).childNodes[0];
            var div_score_2 = document.getElementById('s_'+j+'_match'+correct_i+'_2');
            div_score_2.append(steam2);
        }
        
    }

}


function updateAttribute()
{
    if($_GET('bracketR') != 0)
    {
        var b_nb = findBnb();

        switch(b_nb)
        {
            case '2' :
                var i_cpt = 1;
            break;

            case '4' :
                var i_cpt = 2;
            break;

            case '8' :
                var i_cpt = 3;
            break;

            case 16 :
                var i_cpt = 4;
            break;
        }

        var cptMatch = 1;

        for(var i=i_cpt ; i>= 1; i--)
        {

            for(var j=1; j<=cptMatch; j++)
            {

                var actualId1 = i+'_match'+j+'_1';
                var actualId2 = i+'_match'+j+'_2';

                var teamIn1 = document.getElementById(actualId1);
                var teamIn2 = document.getElementById(actualId2);

                if(teamIn1.childNodes[1])
                {
                    var mid1 = teamIn1.childNodes[1].getAttribute('name');
                    var tname = teamIn1.childNodes[1].innerText;

                    var newCpt = new Number(cptMatch*2);
                    var newI = new Number(i-1);

                    if(!(newI <= 0))
                    {
                        for(var z=1; z<= newCpt; z++)
                        {
                            if(document.getElementById(newI+'_match'+z+'_1').childNodes[1])
                            {
                                if(document.getElementById(newI+'_match'+z+'_1').childNodes[1].innerText == tname)
                                {
                                    if(z%2 == 0)
                                    {
                                        changeAttributeTo(newI+'_match'+(z-1)+'_1', mid1);
                                        changeAttributeTo(newI+'_match'+(z-1)+'_2', mid1);
                                    }   
                                    else
                                    {
                                        var newZ = new Number(z);
                                        newZ = newZ + 1;
                                        changeAttributeTo(newI+'_match'+newZ+'_1', mid1);
                                        changeAttributeTo(newI+'_match'+newZ+'_2', mid1);
                                    }
                                    
                                }
                            }
                            if(document.getElementById(newI+'_match'+z+'_2').childNodes[1])
                            {
                                if(document.getElementById(newI+'_match'+z+'_2').childNodes[1].innerText == tname)
                                {
                                    if(z%2 == 0)
                                    {
                                        changeAttributeTo(newI+'_match'+(z-1)+'_1', mid1);
                                        changeAttributeTo(newI+'_match'+(z-1)+'_2', mid1);
                                    }   
                                    else
                                    {
                                        var newZ = new Number(z);
                                        newZ = newZ + 1;
                                        changeAttributeTo(newI+'_match'+newZ+'_1', mid1);
                                        changeAttributeTo(newI+'_match'+newZ+'_2', mid1);
                                    }
                                    
                                }
                            }
                            
                        }
                    }
                    

                }

                if(teamIn2.childNodes[1])
                {
                    var mid2 = teamIn2.childNodes[1].getAttribute('name');
                    var tname = teamIn2.childNodes[1].innerText;

                    var newCpt = new Number(cptMatch*2);
                    var newI = new Number(i-1);

                    if(!(newI <= 0))
                    {
                        for(var z=1; z<= newCpt; z++)
                        {
                            if(document.getElementById(newI+'_match'+z+'_1').childNodes[1])
                            {
                                if(document.getElementById(newI+'_match'+z+'_1').childNodes[1].innerText == tname)
                                {
                                    if(z%2 == 0)
                                    {
                                        changeAttributeTo(newI+'_match'+(z-1)+'_1', mid2);
                                        changeAttributeTo(newI+'_match'+(z-1)+'_2', mid2);
                                    }   
                                    else
                                    {
                                        var newZ = new Number(z);
                                        newZ = newZ - 1;
                                        changeAttributeTo(newI+'_match'+newZ+'_1', mid2);
                                        changeAttributeTo(newI+'_match'+newZ+'_2', mid2);
                                    }
                                    
                                }
                            }
                            if(document.getElementById(newI+'_match'+z+'_2').childNodes[1])
                            {
                                if(document.getElementById(newI+'_match'+z+'_2').childNodes[1].innerText == tname)
                                {
                                    if(z%2 == 0)
                                    {
                                        changeAttributeTo(newI+'_match'+(z-1)+'_1', mid2);
                                        changeAttributeTo(newI+'_match'+(z-1)+'_2', mid2);
                                    }   
                                    else
                                    {
                                        var newZ = new Number(j);
                                        newZ = newZ - 1;
                                        changeAttributeTo(newI+'_match'+newZ+'_1', mid2);
                                        changeAttributeTo(newI+'_match'+newZ+'_2', mid2);
                                    }
                                    
                                }
                            }
                            
                        }
                    }

                }
                
            }

            var newCpt = new Number(cptMatch);
            cptMatch = newCpt * 2;
            
        }

    }
    

}

function updateUpOrDown()
{
    var bracket_nb = findBnb();

    switch(bracket_nb)
    {
        case 2 :
            var maxM = 1;
            var maxR = 1;
        break;

        case 4 :
            var maxM = 2;
            var maxR = 2;
        break;

        case 8 :
            var maxM = 4;
            var maxR = 3;
        break;

        case 16 :
            var maxM = 8;
            var maxR = 4;
        break;
    }

    for(var i=1; i<=maxR; i++)
    {
        for(var j=1; j<=maxM; j++)
        {
            var actualMatch_1 = document.getElementById(i+'_match'+j+'_1');
            var actualMatch_2 = document.getElementById(i+'_match'+j+'_2');

            if(j%2 == 0)
            {
                if(actualMatch_1) checkOrChange(actualMatch_1, actualMatch_2, 'down');
            }
            else
            {
                if(actualMatch_2) checkOrChange(actualMatch_1, actualMatch_2, 'up');
            }
        }

        maxM = maxM * 2;
    }

}

function checkOrChange(elmt1, elmt2, pos)
{
    if(pos == 'down') {var checkPos = 2;}
    else if (pos == 'up') {var checkPos = 1;}

    if(elmt1.childNodes[1])
    {
        var str = elmt1.childNodes[1].getAttribute('onclick');
        var indofpar = str.indexOf('(');

        for(var i=indofpar; i<str.length; i++)
        {
            if(str[i] == ',')
            {
                var goodI = new Number(i);
                goodI = goodI + 1;
                i = str.length;
            }
        }

        if(str[goodI] != checkPos)
        {
            var firstPart = str.substring(0,goodI);
            goodI = goodI + 1;
            var lastPart = str.substring(goodI,50);
            var goodOnClick = firstPart+checkPos+lastPart;
            elmt1.childNodes[1].setAttribute('onclick', goodOnClick);
        }
        else
        {
            return;
        }

    }

    if(elmt2.childNodes[1])
    {
        var str = elmt2.childNodes[1].getAttribute('onclick');
        var indofpar = str.indexOf('(');

        for(var i=indofpar; i<str.length; i++)
        {
            if(str[i] == ',')
            {
                var goodI = new Number(i);
                goodI = goodI + 1;
                i = str.length;
            }
        }

        if(str[goodI] != checkPos)
        {
            var firstPart = str.substring(0,goodI);
            goodI = goodI + 1;
            var lastPart = str.substring(goodI,50);
            var goodOnClick = firstPart+checkPos+lastPart;
            elmt2.childNodes[1].setAttribute('onclick', goodOnClick);
        }
        else
        {
            return;
        }
    }
    



}


function changeAttributeTo(idOfDivToChange, matchId)
{
    if(document.getElementById(idOfDivToChange))
    {
        if(document.getElementById(idOfDivToChange).childNodes[1])
        {
            var div_tc = document.getElementById(idOfDivToChange).childNodes[1].getAttribute("onclick");
            var ind_bef_par = div_tc.indexOf(")");
    
            var i=ind_bef_par;
    
            while(div_tc[i] != ',')
            {
                i--;
            }
    
            var newI = new Number(i);
            var indToSub = i+1;
    
            var subS = div_tc.substring(0,indToSub);
            
            document.getElementById(idOfDivToChange).childNodes[1].setAttribute("onclick", subS+matchId+')');
        }   
    }
    else
    {
        return;
    }

}


function findCorrectI(teamName, ind, nbM)
{
    var ind_to_search = new Number(ind-1);
    var tempId = ind_to_search+'_match';
    
    for(var i=1 ; i<= nbM; i++)
    {
        var actId1 = tempId+i+'_1';
        var actId2 = tempId+i+'_2';
        var t1 = document.getElementById(actId1);
        var t2 = document.getElementById(actId2);

        if(t1.childNodes[1])
        {
            if(t1.childNodes[1].innerText == teamName)
            {
                return new Number(Math.ceil(i/2));
            }
        }

        if(t2.childNodes[1])
        {
            if(t2.childNodes[1].innerText == teamName)
            {
                return new Number(Math.ceil(i/2));
            }
        }
        
    
    }
}

function findCorrectPlace(tn, ind, nbM)
{
    var ind_to_search = new Number(ind-1);
    var tempId = ind_to_search+'_match';
    
    for(var i=1 ; i<= nbM; i++)
    {
        var actId1 = tempId+i+'_1';
        var actId2 = tempId+i+'_2';
        var t1 = document.getElementById(actId1);
        var t2 = document.getElementById(actId2);

        if(t1.childNodes[1])
        {
            if(t1.childNodes[1].innerText == tn)
            {
                if(i%2 == 0)
                {
                    return 2;
                }
                else
                {
                    return 1;
                }
            }
        }

        if(t2.childNodes[1])
        {
            if(t2.childNodes[1].innerText == tn)
            {
                if(i%2 == 0)
                {
                    return 2;
                }
                else
                {
                    return 1;
                }
            }
        }
        
    
    }
}


function findCorrectI_s(teamName, ind, nbM)
{
    var ind_to_search = new Number(ind-1);
    var tempId = ind_to_search+'_match';
    
    for(var i=1 ; i<= nbM; i++)
    {
        var actId1 = tempId+i+'_1';
        var actId2 = tempId+i+'_2';
        var t1 = document.getElementById(actId1);
        var t2 = document.getElementById(actId2);

        if(t1.childNodes[1].innerText == teamName || t2.childNodes[1].innerText == teamName)
        {
            return new Number(Math.ceil(i/2));
        }   
    }
}


function isThereAwinner()
{
    var b = findBnb();

    switch(b)
    {
        case '2' :
            var id = '2_match1_1';
        break;

        case '4' :
            var id = '3_match1_1';
        break;

        case '8' :
            var id = '4_match1_1';
        break;

        case 16 : 
            var id = '5_match1_1';
        break;
    }

    if(document.getElementById(id).childNodes[1])
    {
        var winnerName = document.getElementById(id).childNodes[1].innerText;

        var divWinner = document.createElement('div');
        divWinner.innerHTML = '<h1> Congratulations to : </br> "'+winnerName+'" </br> for winning this tournament ! </h1>';
        document.getElementsByClassName('rightside')[0].append(divWinner);
    }
}







function matchDetails(matchId, uOd, matchIdForUp)
{
    if(uOd == 1)
    {
        window.location = "MatchDetailsB.php?matchId="+matchId+"&pos=u"+"&secMid="+matchIdForUp;
    }
    else
    {
        window.location = "MatchDetailsB.php?matchId="+matchId+"&pos=d"+"&secMid="+matchIdForUp;
    }
    
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