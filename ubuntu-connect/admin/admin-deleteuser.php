<?php
session_start();
require_once '../includes/database.php';

// Checks the roles of the user to make sure they are an admin
if (!isset($_SESSION['userID']) || $_SESSION['userRole'] !== 'admin') {
    header("Location: " . base_URL . "/connect-login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    if ($id == $_SESSION['userID']) // Avoid accidentally deleting the admin account that is logged in
    { 
       die("User can not be deleted");
    }
    else
    {
         $stmt = $pdo->prepare("DELETE FROM tblusers WHERE userID = ?");
        $stmt->execute([$id]);
    }
}
header("Location: " . base_URL . "admin/admin-manageusers.php");
exit;