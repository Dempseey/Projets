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
    
    

    var i = 1;
    var check = false;

    while(i<= $_GET('nbPls') && !check)
    {

        if(dropzone.id.startsWith("poulecol"+i))
        {
            fillPoule(i,draggableElement);
            check = true;
            break;
        }
        else if(dropzone.id.startsWith("teamdrag"))
        {
            fillPouleTouchTeam(draggableElement, dropzone.id);
            check = true;
            break;
        }
        else
        {
            i++;
        }

    }
}


function onDropBack(event){
    const id = event.dataTransfer.getData('text');
    const draggableElement = document.getElementById(id);
    const dropzone = document.getElementById('backTeam');
    dropzone.appendChild(draggableElement);
    event.dataTransfer.clearData();
}




function fillPoule(x,dragE)
{
    var empty = false;
    for(var i=1; i<= Math.ceil($_GET('nbEq') / $_GET('nbPls')); i++)
    {
        if(document.getElementById('poulecol'+x+'_'+i).textContent == " ")
        {
            document.getElementById('poulecol'+x+'_'+i).append(dragE);
            empty = true;
            break;
        }
    }

    if(!empty)
    {
        alert("This pool is full!");
    }

}


function fillPouleTouchTeam(dragEl, id)
{
    var p = document.getElementById(id).parentElement.id;
    var check = false;
    var i = 1;

    while(i<= $_GET('nbPls') && !check)
    {
        if(p.startsWith("poulecol"+i))
        {
            fillPoule(i,dragEl);
            check = true;
            break;
        }
        else
        {
            i++;
        }
    }

    if(!check)
    {
        alert("This pool is full!");
    }
    
}