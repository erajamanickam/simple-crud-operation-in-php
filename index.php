
<?php 
    include "database.php";
    $update = false;
    // adding user
    if (isset($_POST['save-task'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $query = "INSERT INTO task(name, email) VALUES ('$name', '$email')";
        $result = mysqli_query($conn, $query);
        if(!$result) {
          die("Query Failed.");
        } else {echo "Connection Fail".mysqli_connect_error();
    }
        // redirecting
        header('Location: index.php');
    }

    // update task
    $name = '';
    $email= '';
    if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $update = true;
    $query = "SELECT * FROM task WHERE id=$id";
    $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result) == 1) {
          $row = mysqli_fetch_array($result);
          $name = $row['name'];
          $email = $row['email'];
      }
    }

    if (isset($_POST['update'])) {
      $id = $_GET['id'];
      $name= $_POST['name'];
      $email = $_POST['email'];
      $query = "UPDATE task set name = '$name', email = '$email' WHERE id=$id";
      mysqli_query($conn, $query);
      $_SESSION['message'] = 'Task Updated Successfully';
      $_SESSION['message_type'] = 'warning';
      header('Location: index.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#deeaff" />
    <meta name="description" content="We have create a Simple CRUD (Create/Read/Update/Delete) Application in PHP that is easy to understand" />
    <meta name="keywords" content="PHP crud operation, how to create simple crud operation in php" />
    <meta name="author" content="Rajamanickam">
    <link rel="apple-touch-icon" href="%PUBLIC_URL%/favicon-rajamanickam.png" />

    <title>Simple CRUD Operation using PHP</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.6.0/css/all.min.css" />
</head>
    <main>
        <div class="container">
            <div class="row vh-100 align-items-center">
                <div class="col-lg-4 col-md-12">
                <form class="mb-3 card-body" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input placeholder="Enter Name" name="name" value="<?php echo $name; ?>" type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input placeholder="Enter Email Address" value="<?php echo $email;?>" name="email" type="text" class="form-control">
                        </div>
                        <?php if($update == true) { ?>
                        <button class="btn btn-primary" type="submit" name="update"> Update </button>
                        <?php } elseif ($update == false) { ?>
                          <button class="btn btn-success" type="submit" name="save-task"> Submit </button>
                        <?php } ?> 
                     </form>
                </div>
                <div class="col-lg-8 col-md-12">
                <table class="table card-body">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM task";
                        $result_tasks = mysqli_query($conn, $query);
                        $cnt = 1;
                        while($row = mysqli_fetch_assoc($result_tasks)) {
                        ?>
                        <tr>
                        <td><?php echo ($cnt); ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td>
                            <a href="index.php?id=<?php echo $row['id']?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                            <a href="delete-task.php?id=<?php echo $row['id']?>"  class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
</body>
</html>