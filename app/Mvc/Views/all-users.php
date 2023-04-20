<!DOCTYPE html>
<html lang="<?php echo APP_LANG; ?>">
    <head>
        <meta charset="<?php echo APP_CHARSET; ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Users</title>
        <link rel="stylesheet" href="/assets/css/app.css">
    </head>
    <body>
        <div id="user-data-container">
            <div id="user-form">
                <div>
                    <h3>Add User</h3>
                </div>
                <form action="users" method="POST">
                    <div class="form-element">
                        <input type="text" name="fname" autocomplete="off" placeholder="First name...">
                    </div>
                    <div class="form-element">
                        <input type="text" name="lname" autocomplete="off" placeholder="Last name...">
                    </div>
                    <div class="form-element">
                        <input type="text" name="email" autocomplete="off" placeholder="Email address...">
                    </div>
                    <div class="form-element">
                        <input type="text" name="country" autocomplete="off" placeholder="Country...">
                    </div>
                    <div class="form-element">
                        <input type="text" name="city" autocomplete="off" placeholder="City...">
                    </div>
                    <div class="form-element">
                        <input type="submit" value="ADD" id="add-user-btn" name="add_user">
                    </div>
                </form>
            </div>
            <div id="user-table">
                123
            </div>
        </div>
        <?php
            // var_dump($users);
        ?>
        <script src="/assets/js/app.js"></script>
    </body>
</html>