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
                <div class="user-data-header">
                    <h3 id="user-crud-title">Add User</h3>
                </div>
                <form action="users" method="POST" id="user-form" name="user-form-el">
                    <div class="form-element">
                        <input type="text" name="fname" id="fname" autocomplete="off" placeholder="First name...">
                    </div>
                    <div class="form-element">
                        <input type="text" name="lname" id="lname" autocomplete="off" placeholder="Last name...">
                    </div>
                    <div class="form-element">
                        <input type="text" name="email" id="email" autocomplete="off" placeholder="Email address...">
                    </div>
                    <div class="form-element">
                        <input type="text" name="country" id="country" autocomplete="off" placeholder="Country...">
                    </div>
                    <div class="form-element">
                        <input type="text" name="city" id="city" autocomplete="off" placeholder="City...">
                    </div>
                    <div class="form-element" id="add-user-btn-box">
                        <input type="submit" value="ADD" id="add-user-btn" name="add_user">
                    </div>
                </form>
            </div>
            <div id="user-table">
                <?php if($users->num_rows > 0): ?>
                    <div class="user-data-header">
                        <h3>User List</h3>
                    </div>
                    <div>
                        <table style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>FIRST NAME</th>
                                    <th>LAST NAME</th>
                                    <th>EMAIL</th>
                                    <th>COUNTRY</th>
                                    <th>CITY</th>
                                    <th>CREATED</th>
                                    <th>UPDATED</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $users->fetch_object()): ?>
                                    <tr>
                                        <td>
                                            <?php echo $row->ID; ?>
                                        </td>
                                        <td>
                                            <?php echo $row->FirstName; ?>
                                        </td>
                                        <td>
                                            <?php echo $row->LastName; ?>
                                        </td>
                                        <td>
                                            <?php echo $row->Email; ?>
                                        </td>
                                        <td>
                                            <?php echo $row->Country; ?>
                                        </td>
                                        <td>
                                            <?php echo $row->City; ?>
                                        </td>
                                        <td>
                                            <?php echo $row->Created; ?>
                                        </td>
                                        <td>
                                            <?php echo $row->Updated; ?>
                                        </td>
                                        <td>
                                            <form action="user" method="POST">
                                                <input type="hidden" name="userID" value="<?php echo $row->ID; ?>">
                                                <input type="submit" value="show">
                                            </form>
                                            <form action="user" method="POST">
                                                <input type="hidden" name="method" value="DELETE">
                                                <input type="hidden" name="userID" value="<?php echo $row->ID; ?>">
                                                <input type="submit" value="delete">
                                            </form>
                                            <form>
                                                <input type="button" value="update" class="update-user-btn" data-user='<?php echo json_encode($row); ?>'>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>    
                            </tbody>
                        </table>
                    </div> 
                <?php else: ?>
                    <h3>No users found.</h3>    
                <?php endif; ?>
            </div>
        </div>
        <script src="/assets/js/app.js"></script>
    </body>
</html>