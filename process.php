<?php
//Gestion des sessions pour faciliter le refresh et redirection vers l'accueil
session_start();

//By default, edit mode isn't activated
$update = false;

//by default, content of varaibles 
$firstname = "";
$lastname = "";
$email = "";
$mobile = "";

$id=0;


//CONNEXION db
$mysqli = new mysqli ('localhost', 'sharvani_crud', '070689Sharvani', 'sharvani_crud')
or 

die(mysqli_error($mysqli));


//INSERT in db
//listen/look at tjhose fields in the table and take them
if (isset($_POST ['save'])){
    $firstname = $_POST['firstname']; 
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    $mysqli->query("INSERT INTO sharvani (firstname, lastname, email, mobile) VALUES ('$lastname','$firstname', '$email', '$mobile')") or die ($mysqli_error($mysqli));

    $_SESSION['message'] = "Contact saved";
    $_SESSION['msg_type'] = "success";

//Redirection to homepage
    header("location:index.php");
}



// DELETE a row in the db 
if (isset($_GET ['delete'])){
    $id = $_GET['delete'];   //we store the delete in var $id
    $mysqli->query("DELETE FROM sharvani WHERE id=$id") or die ($mysqli->error);

    $mysqli->query("DELETE FROM sharvani WHERE id=$id") or die($mysqli->error);

    $_SESSION['message']="Contact supprimé";
    $_SESSION['msg_type']="danger";

     //Redirection vers la page d'accueil
     header("location:index.php");
}


//EDIT the db
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM sharvani WHERE id=$id") or die ($mysqli->error);

    if($result->num_rows) {
        $row = $result->fetch_array();
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $email = $row['email'];
        $mobile = $row['mobile'];
    }
}

//Send to db the update of edit
if (isset($_POST['update'])) {
    $id =$_POST['id'];
    $firstname =$_POST['firstname'];
    $lastname =$_POST['lastname'];
    $email =$_POST['email'];
    $mobile =$_POST['mobile'];
   
    $result = $mysqli->query("UPDATE sharvani SET lastname='$lastname', firstname='$firstname', email='$email', mobile='$mobile' WHERE id=$id") or die ($mysqli->error);

    $_SESSION['message']="Contact updated";
    $_SESSION['msg_type']="warning";

     //Redirection vers la page d'accueil
     header("location:index.php"); 
}
?>

