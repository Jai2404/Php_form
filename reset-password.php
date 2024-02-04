<?php


$token = $_GET ["token"];

$token_hash = hash("sha256", $token);

include ("db.php");

$sql = "SELECT *FROM form
WHERE reset_token_hash = ?";

$stmt = $con->prepare($sql);

$stmt->bind_param("s",$token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if($user === null){
    die("token not found");
}

if(strtotime($user["reset_token_expires_at"]) <= time())
{

    die("token has expired");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel ="stylesheet" href="style.css">
</head>
<body>
    
<div class="form-box1"><br>
    <h1> Reset Password</h1><br>
    
    <form id="reset-password-form" method="POST" action="process-reset-password.php">
        <input type="hidden" name="token" class="input-field" value="<?=htmlspecialchars($token) ?>">

        <i class="fa-solid fa-lock"></i><label for="passsword">New Passsword</label>
        <input type="password" class="input-field" name="password">
        <br>


        <i class="fa-solid fa-lock"></i><label for="password_confirm">Confirm Password</label>
        <input type="password" class="input-field" name="password_confirm">
<button class="submit-btn">Submit</button>
    </form>
</div>
</body>
</html>