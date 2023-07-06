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
        <h2>List of Clients</h3>
       <a class="btn btn-primary btn-sm"  href="/crud_operation/create.php" role="button" >New Clients</a>
       <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $servername="localhost";
            $username="root";
            $password="";
            $databasename="myshop";
        // CREATE A CONNECTION 
            $connection = new mysqli($servername, $username, $password, $databasename);
            //check connection
            if($connection->connect_error){
                die("Connection failed: ". $connection->connect_error);
            }

            //read all data from database
            $sql="SELECT*FROM clients";
            $result=$connection->query($sql);

            //read data for each row
            while ($row = $result->fetch_assoc()) {
                echo "
                    <tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['address']}</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='/crud_operation/edit.php?id={$row['id']}'>Edit</a>
                            <a class='btn btn-primary btn-sm' href='/crud_operation/delete.php?id={$row['id']}'>Delete</a>
                        </td>
                    </tr>
                ";
            }
            
        ?>
           
        </tbody>
       </table>
        

    </div>
</body>
</html>