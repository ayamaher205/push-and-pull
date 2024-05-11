<?php
include('./base.php');
require('./connct_db.php');
function insert_user($usr_name, $usr_email, $usr_image, $usr_pass, $usr_room)
{
    try {
        $pdo = connect_to_database();
        $query = "INSERT INTO users (`name`, `email`, `image`,`password`,`room`) 
            VALUES (:user_name,:user_email,:user_image,:user_password,:user_room);";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":user_name", $usr_name, PDO::PARAM_STR);
        $stmt->bindParam(":user_email", $usr_email, PDO::PARAM_STR);
        $stmt->bindParam(":user_image", $usr_image, PDO::PARAM_STR);
        $stmt->bindParam(":user_password", $usr_pass, PDO::PARAM_STR);
        $stmt->bindParam(":user_room", $usr_room, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
    } catch (\PDOException $e) {
        echo "<h3 style='color:red'>{$e->getMessage()}</h3>";
    }
}
//insert_user('ahmed','alaa@gmail.com','ahmed.jpg','123456','application 1');

function retrieve_data()
{
    try {
        $pdo = connect_to_database();
        $query = "select * from `users`";
        $stmt = $pdo->prepare($query);
        $res = $stmt->execute();
        if ($res)
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
     return $rows; 
    } catch (Exception $e) {
        echo "<h3 style='color:red'>{$e->getMessage()}</h3>";
    }
}
//retrieve_data();

function delete_user($user_id)
{
    try {
        $pdo = connect_to_database();
        $query = "DELETE FROM users WHERE user_id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $res = $stmt->execute();
        header("Location: users.php");
    } catch (Exception $e) {
        echo "<h3 style='color:red'>{$e->getMessage()}</h3>";
    }
}
//delete_user(4);
function update_user($user_id, $name, $email, $image, $password, $room)
{
    try {
        $pdo = connect_to_database();
        $query = "UPDATE users SET `name`=:name, `email`=:email, `image`=:image, `password`=:password, `room`=:room WHERE user_id=:user_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":name", $name, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":image", $image, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->bindParam(":room", $room, PDO::PARAM_STR);
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (Exception $e) {
        echo "<h3 style='color:red'>{$e->getMessage()}</h3>";
    }
}

function display_in_table($rows)
{
    echo "<table class='table' id='users-table'> <tr>
    <th class='text-center'>ID</th>
    <th class='text-center'>Name</th>
    <th class='text-center'>Email</th>
    <th class='text-center'>image</th> 
    <th class='text-center'>Room</th>
    <th class='text-center'>password</th> 
    <th class='text-center'>Actions</th>
    </tr>";
    foreach ($rows as $row) {
        $url = "user_id={$row['user_id']}";
        $delete_url = "delete_user.php?" . $url;
        $user_data['id'] = $row['user_id'];
        $user_data['name'] = $row['name'];
        $user_data['email'] = $row['email'];
        $user_data['image'] = $row['image'];
        $user_data['room'] = $row['room'];
        $user_data['password'] = $row['password'];
        $data = json_encode($user_data);
        $url_data = "user_data={$data}";
        $update_url = "update_user.php?" . $url_data;
        echo "<tr id='user-row-${user_data['id']}'>";
        foreach ($row as $value) {
            echo "<td class='text-center'>{$value}</td>";
        }
        echo "
        <td class='text-center'><button class='btn btn-danger delete-btn' data-userid='{$row['user_id']}'>
        <i class='fa-solid fa-trash-can'></i>
    </button>
        &nbsp &nbsp || &nbsp &nbsp 
        <a class='text-info' href='{$update_url}'><i class='fa-solid fa-user-pen'></i></a></td>;";
        echo "</tr>";
    }
    echo "</table>";
}
?>


<script>
    $(document).ready(function() {
        $('.delete-btn').click(function() {
            var userId = $(this).data('userid');
            $.ajax({
                method: "DELETE",
                url: `http://127.0.0.1/php/LabFour/delete_user.php?user_id=${userId}`,
                data: {
                    user_id: userId,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(res) {
                    console.log("Request succeeded", res);
                    var deletedRow = document.getElementById('user-row-' + userId);
                    if (deletedRow) {
                        deletedRow.remove();
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error:", error);
                }
            });
        });
    });

</script>