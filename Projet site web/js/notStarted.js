function checkedState()
{
    var no = document.getElementById('notOverMatch');

    if(no.checked)
    {

        var lab_dur = document.createElement('label');
        lab_dur.innerHTML = "How long the match will last ? </br>";
        document.getElementById('duration_div').append(lab_dur);

        var duration = document.createElement('input');
        duration.setAttribute('type', 'name', 'id');
        duration.type = 'number';
        duration.name = 'duration_n';
        duration.id = 'duration_n';
        duration.min = 1;
        duration.max = 120;

        document.getElementById('duration_div').append(duration);

    }

    else
    {
        document.getElementById('duration_div').innerHTML = "";
    }

}