$(document).ready(function() {
    $('#create-task').submit(function(event) {
        event.preventDefault();

        var form = $(this);

        var formData = form.serialize();

        $.ajax({
            url: 'create.php',
            method: 'POST',
            data: formData,

            success: function(data) {
                $('#ajax_msg').css("display", "block").delay(3000).slideUp(300).html(data);
                document.getElementById("create-task").reset();
            }
        });
    });
});

function makeElementEditable(div){
    div.style.border = "1px solid lavender";
    div.style.padding = "5px";
    div.style.background = "white";
    div.contentEditable = true;
}

function upadateTaskName(div, taskID) {
    var data = div.textContent;
    div.style.border = "none";
    div.style.padding = "2px";
    div.style.background = "#ececec";
    div.contentEditable = false;

    $.ajax({
        url: 'update.php',
        method: 'POST',
        data: {name: data, id: taskID},

        success: function(data) {
            $('#ajax_msg').css("display", "block").delay(3000).slideUp(300).html(data);
        }
    });
}

function upadateTaskDescription(div, taskID) {
    var data = div.textContent;
    div.style.border = "none";
    div.style.padding = "2px";
    div.style.background = "#ececec";
    div.contentEditable = false;

    $.ajax({
        url: 'update.php',
        method: 'POST',
        data: {description: data, id: taskID},

        success: function(data) {
            $('#ajax_msg').css("display", "block").delay(3000).slideUp(300).html(data);
        }
    });
}

function deleteTask(taskID) {
    if(confirm("Вы действительно ходите удалить это задание ?")){
        $.ajax({
            url: 'delete.php',
            method: 'POST',
            data: {id: taskID},

            success: function(data) {
                $('.' + taskID).fadeOut();
                $('#ajax_msg').css("display", "block").delay(3000).slideUp(300).html(data);
            }
        });
    }

    return false;
}
