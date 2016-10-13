/**
 * Created by Evan McCall on 10/12/2016.
 */
var draggedElement;
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev,obj) {
    ev.dataTransfer.setData("text", ev.target.id);

    draggedElement = obj;
}



function drop(ev) {
    ev.preventDefault();
    $.post('php/ProcessQuestion.php', {questionID: draggedElement.id,answer: ev.target.id}, function(){
            //successful ajax request
        //alert("Success");
          }).error(function(){
            alert('error... ohh no!');
          });
    $("#"+draggedElement.id).remove();
}