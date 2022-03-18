function onDragStart(event) {
    event.dataTransfer.setData('text/plain', event.target.id);
}


function onDragOver(event) {
  event.preventDefault();
}


function onDrop(event){

    const id = event.dataTransfer.getData('text');
    const draggableElement = document.getElementById(id);
    const dropzone = event.target;
    const idDrop = dropzone.id;
   
    
    document.getElementById(idDrop).append(draggableElement);
}


function dropBack(event){
    const id = event.dataTransfer.getData('text');
    const draggableElement = document.getElementById(id);
    const dropzone = document.getElementById('backTeam');
    dropzone.appendChild(draggableElement);
    event.dataTransfer.clearData();
}

function goBack()
{
    var i=1;
    var allTeamHere = true;
    while(i <= 16 && allTeamHere)
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
        for(var j=1; j<= 16; j++)
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

function tirage() {

    
    if(document.getElementById('backTeam').innerText != "")
    {
        var nbP = 16;
        var nbE = 16;

        for(var i=1; i <= nbE ; i++)
        {
            var actualTeam = 'teamdrag'+i;
            var rand = Math.floor(Math.random() * nbP) +1;
            var check = false;

            while(!check)
            {
                if(!isFull(rand))
                {
                    putIn(rand,actualTeam);
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
        var nbE = 16;
        for(var i=1; i <= nbE ; i++)
        {
			var actualTeam = 'teamdrag'+i;
			 
			if(i == 1 || i == 12 || i == 15 ){
				putIn(i,actualTeam);
			}
			if(i == 2){
				putIn(16,actualTeam);
			}
			if(i == 3){
				putIn(8,actualTeam);
			}
			if(i == 4){
				putIn(9,actualTeam);
			}
			if(i == 5){
				putIn(11,actualTeam);
			}
			if(i == 6){
				putIn(5,actualTeam);
			}
			if(i == 7){
				putIn(13,actualTeam);
			}
			if(i == 8){
				putIn(3,actualTeam);
			}
			if(i == 9){
				putIn(4,actualTeam);
			}
			if(i == 10){
				putIn(14,actualTeam);
			}
			if(i == 11){
				putIn(6,actualTeam);
			}
			if(i == 13){
				putIn(10,actualTeam);
			}
			if(i == 14){
				putIn(7,actualTeam);
			}
			if(i == 16){
				putIn(2,actualTeam);
			}      
        }
    }
    else
    {
        alert("Return the teams to the depot before you can do a level draw again!");
    }
    

}

function isFull(i)
{
    
    var pl = document.getElementById('Drag'+i);

        if(pl.textContent== "")
        {
            return false;
        }

    return true;
}


function putIn(rand,actualTeam)
{
    
        var idcell = 'Drag'+rand;
        var cell = document.getElementById(idcell);
        if(cell.textContent == "")
        {
            cell.append(document.getElementById(actualTeam));
        }
}