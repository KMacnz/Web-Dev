<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <meta name="description" content="COMP721 Assignment 1">
        <meta name="keywords" content="Web Development, Assignment 1">
        <link rel="stylesheet" href="styles.css">
        <title>Web Dev Assignment 1</title>
    </head>
    <body>
        <div class="tab">
            <a href="http://hvm1158.cmslamp14.aut.ac.nz/assign1/index.html">Home</a>
            <a href="http://hvm1158.cmslamp14.aut.ac.nz/assign1/about.html">About the Assignment</a>
            <a href="http://hvm1158.cmslamp14.aut.ac.nz/assign1/poststatusform.php">Post a new Status</a>
            <a href="http://hvm1158.cmslamp14.aut.ac.nz/assign1/searchstatusform.html">Search Status</a>
        </div>

        <div class="main">
            <h1>Post a New Status</h1>

            <?php
                //session start
                session_start();
                // If the success variable is set to success, display a success message
                if (isset($_GET['success'])) {
                     echo "<h5 style='color: #D62246;'>Congratulations! The status has been posted!</h5>";
                // If the codeerr variable is set to codeerr, display an error message
                } else if (isset($_GET['codeerr'])) {
                    echo "<h5><u>Status Code Wrong Format!</u> The status code must start with an 'S' followed by four digits, like 'S0001'</h5>";
                // If the matcherr variable is set to matcherr, display an error message
                } else if (isset($_GET['matcherr'])) {
                    echo "<h5><u>Status Code Already Exists!</u> Please try another one! </h5>";
                // If the staterr variable is set to staterr, display an error message
                } else if (isset($_GET['staterr'])) {
                    echo "<h5><u>Your status is in a wrong format!</u><br> The status can only contain  
                    alphanumericals and spaces, comma, period, exclamation point and question mark and cannot be blank! </h5>";
                } else if (isset($_GET['droperr'])) {
                    echo "<h5><u>Table doesnt exist and cannot be dropped!</u><br> Try adding an entry before dropping the table! </h5>";
                } else if (isset($_GET['tableerr'])) {
                    echo "<h5><u>Table no longer exists!</u><br> Try adding an entry before searching! </h5>";
                }
            ?>
            
            <div class="statcon">
                <form action="poststatusprocess.php" method="post">
                    <h4><label for="statuscode">Enter Status Code:</label>
                    <input type=”text” name="statuscode" placeholder="S0000" pattern="^S\d{4}$" maxlength="5" required oninput="this.value = this.value.toUpperCase()">
                    <p><label for="status">Enter Status:</label>
                    <input type=”text” name="status" placeholder="Doing my Assignment" required></p>

                    <p><label for="share">Who do you want to Share with:</label></h4>
                    <input type="radio" name="share" value="public" checked> Public
                    <input type="radio" name="share" value="private"> Private
                    <input type="radio" name="share" value="friends"> Friends</p>

                    <h4><p><label for="date">Date:</label>
                    <!-- input type date with place holder as the current date -->
                    <input type="date" name="date" value="<?php echo date('d-m-Y'); ?>"></p>

                    <p><label for="perm">Check Permissions:</label></h4>
                    <input type="checkbox" name="perm[]" value="like"> Allow Like
                    <input type="checkbox" name="perm[]" value="comment"> Allow Comment
                    <input type="checkbox" name="perm[]" value="share"> Allow Share</p>

                    <h4><p style="text-align: center;"><input type="submit" value="Submit"></h4></p>
                </form>
            </div>
        </div>
    </body>

    <footer>
        <p>Keanna Mackereth 20119705<p>
    </footer>
</html>