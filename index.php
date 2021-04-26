<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

</head>
<body>
<!-- require the file containing the logic -->
<?php require_once 'process.php';?>
<!-- printing session variables -->
<?php
  if(isset($_SESSION['message'])):?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
      <?php
          echo $_SESSION['message'];
          unset($_SESSION['message']);

      ?>
    </div>
<?php endif?>
<!-- connecting to database -->
<?php
$mysqli = new mysqli('localhost', 'root', '', 'crudapp' ) or die(mysqli_error($mysqli));
$result = $mysqli->query("SELECT * FROM data ") or die($mysqli->error);
//printing results
//pre_r($result);
pre_r($result->fetch_assoc());

function pre_r($array){
  echo '<pre>';
  //print_r($array);
  echo '</pre>';
}

?>
<div class="container row justify-content-center">

  <div class="row justify-content-center">

    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th colspan="2">Action</th>
        </tr>
      </thead>
      <?php while($row=$result->fetch_assoc()):?>
        <tr>
          <td><?php echo $row['name'];?></td>
          <td><?php echo $row['email'];?></td>
          <td>
              <a href="index.php?edit=<?php $row['id'];?>">Edit</a>
              <a href="process.php?delete=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a>
          </td>
        </tr>
      <?php endwhile
      //endwhile
      ?>

    </table>

  </div>





  <form action="process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" name="name" placeholder="Enter your name" value="<?php echo $name?>">
    </div>
    <div class="form-group">
      <label for="email">Password</label>
      <input type="email" class="form-control" name="email" placeholder="Enter your Email" value="<?php echo $email?>"> 
    </div>
    <div>
    <?php
    if($update==true):
    ?>
        <button type="submit" class="btn btn-info" name="update">Update</button>
        <?php else:?>
      <button type="submit" class="btn btn-primary" name="save">Save</button>
      <?php endif?>
    </div>

  </form>




</div>
    
</body>
</html>