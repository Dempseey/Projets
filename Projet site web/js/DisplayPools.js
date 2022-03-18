window.onload = function() { affpoules(); }



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


    var nbPoules = $_GET('nbPls');




function affpoules()
{

    var nomDePoule = 'Pool n°';
    var pouleId = 'poulenumber';
    var lineNumberPoule = 'pouleline';
    var colNumberPoule = 'poulecol';
    var divPouleId = 'divPoule';
    
    document.querySelector("#add_poules").innerHTML = '';

    for(var z=0; z < nbPoules; z++)
    {
        var divPoule = document.createElement('div');
        divPoule.setAttribute('id', 'name');
        divPoule.id = divPouleId + (z+1);
        divPoule.name = divPouleId + (z+1);

        document.getElementById("add_poules").append(divPoule);
    }


    for(var i = 0; i < nbPoules; i++) {

        var poule = document.createElement('table');
        poule.setAttribute('id', 'name');
        poule.style.width = '20%';
        poule.style.height = '250px';
        poule.style.marginRight = '10px';
        poule.style.marginLeft = '10px';
        poule.style.backgroundColor = '#DF2121';
        poule.style.borderRadius = '6px';
        poule.id = pouleId +  (i+1);
        poule.name = pouleId + (i+1);
        
        
        
        document.getElementById(divPouleId+(i+1)).append(poule);

        for(var j = 0; j <= Math.ceil($_GET('nbEq') / $_GET('nbPls')); j++)
        {
            if(j==0)
            {
                var l_poule = document.createElement('tr');
                l_poule.setAttribute('id', 'name');
                l_poule.id = 'pouletitleline' + (i+1);
                l_poule.name = 'pouletitleline' + (i+1);
    
                document.getElementById(poule.id).append(l_poule);

    
                var col_poule = document.createElement('td');
                col_poule.innerHTML = '<center>'+nomDePoule+(i+1)+'</center>';
                col_poule.setAttribute('id', 'name', 'class');
                col_poule.style.minHeight = '55px';
                col_poule.id = 'pouletitlecol' + (i+1);
                col_poule.name = 'pouletitlecol' + (i+1);
                col_poule.className = "namePoule";
    
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
            col_poule.setAttribute('ondragover', 'onDragOver(event)');
            col_poule.setAttribute('ondrop', 'onDrop(event)');
            col_poule.setAttribute('id', 'name');
            col_poule.id = colNumberPoule + (i+1) + '_' + j;
            col_poule.name = colNumberPoule + (i+1) + '_' + j;
            col_poule.innerHTML = " ";

            document.getElementById(l_poule.id).append(col_poule);
            
            }

        }


        

    }

}




