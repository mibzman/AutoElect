<?php
session_start();
$message = "";

if (!isset($_SESSION['user_id'])) $message = "You have not logged in";
else {

    // Logout

    session_destroy();
    session_id("");
    $message = "You have logged out successfully!";
}

require "front_header.html";

?>

<meta title="Crowd Diet: Log Out"></meta>

<div class="intro">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="intro-message" style="padding-top: 10%">
                    <h1 style="padding-bottom: 5%"><?php echo $message; ?></h1>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "front_footer.html"; ?>