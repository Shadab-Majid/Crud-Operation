<?php
 $servername="localhost";
 $username="root";
 $password="";
 $databasename="myshop";
// CREATE A CONNECTION 
 $connection = new mysqli($servername, $username, $password, $databasename);

$id="";
$name = "";
$email = "";
$phone = "";
$address = "";
$errorMessage = "";
$successMessage = "";

if($_SERVER['REQUEST_METHOD']=='GET'){
    //GET method : show the data of the client
    if(!isset($_GET["id"])){
        header("location:/crud_operation/index.php");
        exit;
    }
    
    $id = $_GET["id"];

    //read teh row of the selected client from database table
    $sql = "SELECT * FROM clients WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location:/crud_operation/index.php");
    }
    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $address = $row["address"];
}
else{
    //Post method: update the data of the client
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    do {
        if (empty($name) || empty($email) || empty($phone) || empty($address)) {
            $errorMessage = "All the fields are require";
            break;
        }

        $sql = "UPDATE clients " . 
               "SET name = '$name', email = '$email', phone = '$phone', address = '$address'" .
               "WHERE id = $id";

        $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "Invalid query :" . $connection->error;
            break;

        }

        $successMessage = "Client updated correctly";

        header("location:/crud_operation/index.php");
        exit;

        } while (true);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container my-5">
        <h2>New Client</h2>
        <?php
        if (!empty($errorMessage)) {
            echo "
          <div class ='alert alert-warning alert-dismissible fade show' role='alert'>
          <strong>$errorMessage</strong>
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
          </div>
            ";
        }
        ?>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address;?>">
                </div>
            </div>

            <!-- succes message -->
            <?php
            if (!empty($successMessage)) {
                echo "
                <div class ='offset-sm-3 col-sm-6'>
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>$successMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                </div>
                </div>
                </div>
                ";
            }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <div class="btn btn-outline-primary" href="/crud_operation/index.php" role="button">Cancel</div>
                </div>
            </div>
        </form>
    </div>

</body>

</html>