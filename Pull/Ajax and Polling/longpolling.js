$(document).ready(function() {
    function doLongPoll() {
        $.ajax({
            type: "Get",
            url: "http://127.0.0.1/php/LabFour/users.php",
            success: function(response) {
                console.log(response)
                $("#container").html(displayUsers(response));
                doLongPoll();
            },
            error: function(xhr, status, error) {
                console.error("Request failed: " + error);

            }
        });
    }

    doLongPoll();
});
function displayUsers(users) {
    var html = "<table class='table'>";
    html += "<tr><th>ID</th><th>Name</th><th>Email</th><th>Image</th><th>Room</th><th>Password</th><th>Actions</th></tr>";
    users.forEach(function(user) {
        html += "<tr>";
        html += "<td>" + user.user_id + "</td>";
        html += "<td>" + user.name + "</td>";
        html += "<td>" + user.email + "</td>";
        html += "<td>" + user.image + "</td>";
        html += "<td>" + user.room + "</td>";
        html += "<td>" + user.password + "</td>";
        html += "</tr>";
    });
    html += "</table>";

    return html;
}

