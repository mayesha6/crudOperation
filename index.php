<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- bootstrap css  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php
        $db = mysqli_connect('localhost', 'root', '', 'crud');
        if($db){
            // echo 'connect';
        }
        else{
            echo 'error';
        }
    
       
    
       
    ?>
    <section>
        <div class="container">
            <div class="registration">
                <h2 class="my-3 text-success">Registration</h2>
                <form action="" method="POST">
                    <input type="text" name="name" placeholder="Enter your name" class="form-control mb-3">
                    <input type="email" name="email" placeholder="Enter your email" class="form-control mb-3">
                    <input type="password" name="password" placeholder="Enter your password" class="form-control mb-3">
                    <input type="password" name="confirmPassword" placeholder="Re-enter your password" class="form-control mb-3">
                    <input type="submit" name="submit" value="SUBMIT" class="btn btn-success mb-3">
                </form>
            </div>
        
            <?php
                // insert operation 
                if(isset($_POST["submit"])){
                    // echo 'click';
                    $name = $_POST["name"];
                    $email = $_POST["email"];
                    $password = $_POST["password"];
                    $confirmPassword = $_POST["confirmPassword"];
                    $encryptPass = sha1($password); //sha1() function used here for password encryption
                    $length = strlen($password);
                    if($length>=8 && $password == $confirmPassword){
                        $insertSQL = "INSERT INTO users(Name, Email, Password) VALUES('$name', '$email', '$encryptPass')";

                        $trans = mysqli_query($db, $insertSQL);
                        if($trans){
                            echo 'insert';
                        }
                        else{
                            echo 'error 3';
                        }
                    }
                    else{
                        echo 'error 4';
                    }
                    
                            
                }
                
                // delete operation 
                if(isset($_GET["delete"])){
                    // echo 'click';
                    $del_id = $_GET['delete'];
                    $delSQL = "DELETE FROM users WHERE ID = '$del_id'";
                    $trans3 = mysqli_query($db, $delSQL);
                    if($trans3){
                        header('Location: index.php');
                    }
                    else{
                        echo 'error 5';
                    }
                    
                            
                }

                
                
                // else{
                //     echo 'error2';
                // }
            ?>
            <table class="table table-success table-hover">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                <?php
                    // read operation 
                    $readSQL = "SELECT * FROM users";
                    $trans2 = mysqli_query($db, $readSQL);
                    $a = 1;
                    while($row = mysqli_fetch_assoc($trans2)){
                        $ID = $row['ID'];
                        $name = $row['Name'];
                        $email = $row['Email']; 
                        $a++; 
                    
                ?>
                <tr>
                    <td><?php echo $ID?></td>
                    <td><?php echo $name?></td>
                    <td><?php echo $email?></td>
                    <td>
                        <a href="index.php?delete=<?php echo $ID;?>" class="btn btn-danger">Del</a>
                        <a href="index.php?edit=<?php echo $ID;?>" class="btn btn-warning">Edit</a>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </table>
            <?php  
                // Edit operation 
                if(isset($_GET["edit"])){
                    // echo 'click';
                    $edit_id = $_GET['edit'];
                    $editSQL = "SELECT * FROM users WHERE ID = '$edit_id'";
                    $trans4 = mysqli_query($db, $editSQL);
                    
                    while($row2 = mysqli_fetch_assoc($trans4)){
                        $ID = $row2['ID'];
                        $name = $row2['Name'];
                        $email = $row2['Email']; }
            ?>
                        
            <h2 class="my-3 text-success">Update Information</h2>
            <form action="" method="POST">
                <input type="text" name="name" value="<?php echo $name;?>" class="form-control mb-3">
                <input type="email" name="email" value="<?php echo $email;?>" class="form-control mb-3">
                <input type="submit" name="update" value="UPDATE" class="btn btn-success mb-3">
            </form>
            <?php   
                }
                if(isset($_POST["update"])){
                    $name = $_POST["name"];
                    $email = $_POST["email"];
                    $updateSQL = "UPDATE users SET Name = '$name', Email = '$email'  WHERE ID = '$edit_id'";
                    $trans5 = mysqli_query($db, $updateSQL);
                }
            ?>
        </div>
    </section>
    <!-- bootstrap js  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>