<?php
include 'connection.php';

function fetchMembers($conn) {
    $sql = "SELECT * FROM member";
    $result = $conn->query($sql);

    $members = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $members[] = $row;
        }
    }
    echo json_encode($members);
}

function deleteMember($conn, $member_id) {
    $sql = "DELETE FROM member WHERE member_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $member_id);
    $stmt->execute();
    $stmt->close();
}

function insertMember($conn, $member_id, $firstname, $lastname, $birthday, $email) {
    $sql = "INSERT INTO member (member_id, first_name, last_name, birthday, email) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssss', $member_id, $firstname, $lastname, $birthday, $email);
    if($stmt->execute()){
        echo "<script>
        alert('Record inserted successfully');
        window.location.href = 'index.php';
        </script>";
    }else{
        echo "<script>
        alert('Error occured while record inserting');
        window.location.href = 'index.php';
        </script>";
    }
    $stmt->close();
}

function updateMember($conn, $member_id, $firstname, $lastname, $birthday, $email) {
    $sql = "UPDATE member SET first_name = ?, last_name = ?, birthday = ?, email = ? WHERE member_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssss', $firstname, $lastname, $birthday, $email, $member_id);
    if($stmt->execute()){
        echo "<script>
        alert('Record updated successfully');
        window.location.href = 'index.php';
        </script>";
    }else{
        echo "<script>
        alert('Error occured while record updating');
        window.location.href = 'index.php';
        </script>";
    
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action == 'fetch') {
        fetchMembers($conn);
    } elseif ($action == 'delete') {
        $member_id = $_POST['member_id'];
        deleteMember($conn, $member_id);
    } elseif ($action == 'get_member') {
        $member_id = $_POST['member_id'];
        $sql = "SELECT * FROM member WHERE member_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $member_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $member = $result->fetch_assoc();
        echo json_encode($member);
    } elseif ($action == 'update') {
        $member_id = $_POST['member_id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $birthday = $_POST['birthday'];
        $email = $_POST['email'];
        updateMember($conn, $member_id, $firstname, $lastname, $birthday, $email);
    } else {
        $member_id = $_POST['member_id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $birthday = $_POST['birthday'];
        $email = $_POST['email'];
        insertMember($conn, $member_id, $firstname, $lastname, $birthday, $email);
    }
}
?>
