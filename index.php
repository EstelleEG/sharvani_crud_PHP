<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=form, initial-scale=1.0">
    <title>Sharvani Studio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <!-- when index.php is loaded, the db connects -->
    <?php require_once 'process.php'; ?>

    <?php if (isset($_SESSION ['message'])): ?>
        <div class="alert alert-<?=$_SESSION['msg_type'] ?>">

        <?php 
        echo $_SESSION['message'];
        //unset($_SESSION['message']);
        ?>
        </div>
        <?php endif; ?>

    <div class='container'>
            <br>
            <h1>Sharvani Studio</h1>
            <br>

        <!-- ce file can connect to the db -->
        <?php
            $mysqli = new mysqli ('localhost', 'sharvani_crud', '070689Sharvani', 'sharvani_crud') or die ($mysqli_error($mysqli));

        // get all in table
            $result = $mysqli->query("SELECT * FROM sharvani") or die ($mysqli->error);
        ?>

        <table>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th colspan=2>Action</th>
                </tr>
                <?php 
                    while ($row = $result->fetch_assoc()):
                    //in row you store all datas
                    //fetch on $results
                ?>
                <tr>
                    <!-- in td, you show that data -->
                    <td><?php echo $row ['firstname']?></td>
                    <td><?php echo $row ['lastname']?></td>
                    <td><?php echo $row ['email']?></td>
                    <td><?php echo $row ['mobile']?></td>

                    <td>
                    <a href="index.php?edit=<?php echo $row['id']; ?>"class="btn btn-info">Edit</a>

                    <a href="index.php?delete=<?php echo $row['id']; ?>"class="btn btn-danger">Delete</a>

                    <a href="index.php?show=<?php echo $row['id']; ?>"class="btn btn-success">Show</a>
                    </td>
                </tr>
                <?php endwhile; ?>
        </table>
        <br>
        <br>
        <div class="row justify-content-center">
        
            <form action="process.php" method="POST">
                <!--  display id in front in the URL  -->
                <input type="hidden" name="id" value="<?php echo $id ?>">

                <div class="form-group">
                <label>Firstname</label>
                <input type="text" name="firstname" class="form-control" value="<?php echo $firstname ?>" placeholder="Please type your fistname">
                </div>

                <div class="form-group">
                <label>Lastname</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo $lastname ?>" placeholder="Please type your lastname">
                </div>

                <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email ?>" placeholder="Please type your email">
                </div>

                <div class="form-group">
                <label>Mobile</label>
                <input type="tel" name="mobile" class="form-control" value="<?php echo $mobile?>" placeholder="Please type your mobile number">
                </div>

                <div class="form-group">
                    <!-- switch from btn save to btn update -->
                    <?php if($update == true): ?>
                    
                        <button type="submit" class="btn btn-primary" name="save">Update</button>
                    
                    <?php else:  ?>
                    <button type="submit" class="btn btn-primary" name="save">Save</button>
                    <?php endif; ?>

                </div>
            </form>
        </div>
</div>
</body>
</html>