function tirage() {

    
    if(document.getElementById('backTeam').innerText != "")
    {
        var i=1;
        var nbP = $_GET('nbPls');
        var nbE = $_GET('nbEq');
        var lim = Math.ceil(nbE / nbP);

        for(var i=1; i <= nbE ; i++)
        {
            var actualTeam = 'teamdrag'+i;
            var rand = Math.floor(Math.random() * nbP) +1;
            var check = false;

            while(!check)
            {
                if(!isFull(rand, lim))
                {
                    putIn(rand,actualTeam, lim);
                    check = true;
                }
                else
                {
                    rand = Math.floor(Math.random() * nbP) + 1;
                }
            }
                
        }
    }
    else
    {
        alert("Return the teams to the depot before you can do a random draw again!");
    }
    

}

function level() {

    
    if(document.getElementById('backTeam').innerText != "")
    {
        var nbP = $_GET('nbPls');
        var nbE = $_GET('nbEq');
        var lim = Math.ceil(nbE / nbP);
		var pool = 1;
		var check = false;
		var direction = 0;

        for(var i=1; i <= nbE ; i++)
        {
            var actualTeam = 'teamdrag'+i;
            putIn(pool,actualTeam, lim);
			if(pool != nbP && direction == 0 && check==false){
				pool++;
			}else{
				if(pool == nbP && direction == 0 && check==false){
				   check = true;
				   }
				else{
					if(pool == nbP && direction == 0 && check==true){
						pool--;
						direction = 1;
						check = false;
					}
					else{
						if(pool != 1 && direction == 1 && check==false){
							pool--;
						}else{
							if(pool == 1 && direction == 1 && check==false)
								{
									check = true;
								}
							else{
								if(pool == 1 && direction == 1 && check==true){
									pool++;
									direction = 0;
									check = false;
								}
							}
						}
					}
				}
			}
			
			
                
        }
    }
    else
    {
        alert("Return the teams to the depot before you can do a random draw again!");
    }
    

}

    

function isFull(i, limit)
{
    for(var j=1 ; j<=limit; j++)
    {
    var pl = document.getElementById('poulecol'+i+'_'+j);

        if(pl.textContent== " ")
        {
            return false;
        }
    }

    return true;
}


function putIn(rand,actualTeam, limit)
{
    for(var i=1; i<=limit; i++)
    {
        var idcell = 'poulecol'+rand+'_'+i;
        var cell = document.getElementById(idcell);
        if(cell.textContent == " ")
        {
            cell.append(document.getElementById(actualTeam));
        }
    }
}