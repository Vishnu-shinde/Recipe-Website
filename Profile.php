<?php include('server.php')
?>
<?php

$errors = array();
$_SESSION['success'] = "";

$db = mysqli_connect('localhost', 'root', '', 'recipe');
$username = $_SESSION['username'];
$query = "SELECT * FROM `post` WHERE username='$username'";
$result = mysqli_query($db, $query); 

$sql ="SELECT * FROM `users` WHERE username='$username'";
$results = mysqli_query($db, $sql);
$db->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Swadisht</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    <script>
      var myModal = document.getElementById('myModal')
      var myInput = document.getElementById('myInput')
      myModal.addEventListener('shown.bs.modal', function () {
      myInput.focus()
      })
    </script>
  </head>
<style>
    .box{
        margin-top: 70px;
        height: 100%;
        width: 600px;
        padding: 30px 50px 20px 50px;
        box-shadow: 0 4px 6px 0 rgba(0,0,0,0.3);
    }

    nav li
    {
        color: black;
        font-size: large;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        font-weight: 600;
    }

    .inp-control
      {
          margin: 5px 5px 5px 5px;
          width: 68%;
          height: 40px;
          padding-left: 15px;
          background-color: rgb(235, 225, 225);
          border-radius:5px;
          border: none;
      }

    .modal-style{
        padding: 20px 50px 20px 50px;
      }

      .text-area{
        width:100%;
      }

      .button
    {
        height: 35px;
        width: 80px;
        margin-left: 40%;
        margin-top: 20px;
        background-color:  #C5CBE3;
        border: none;
        border-radius: 5px;
    }

    .button:hover{
        height: 35px;
        width: 90px;
        background-color:orange;
        font-weight: 700;
    }

    
  .scroll-text {
    height:80px; 
    overflow:scroll; 
    text-align:center;
  }
  
  .scroll-text::-webkit-scrollbar {
    -webkit-appearance: none;
 }

</style>

<body>
    <nav
      class="navbar navbar-expand-lg navbar-light container-fluid" style="background-color: #dbe2fd;" >
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="Logo.png" alt="Logo" height="40px" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item mx-2">
              <a class="nav-link active" aria-current="page" href="Adminpage.php">Home</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div style="display: flex;">

        <div class="box" style="margin-left:15%; margin-right:10%; width: auto;height:410px;">
            <img src="data:image/jpeg;base64,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" alt="">
            <br><br><h3 style="text-align: center;">Chef</h3>
        </div>
    
        <div class="box">
            <div>
              <p className="small text-muted mb-1">Username : <strong style="margin-left:10px"><?php echo $_SESSION['username'];?></strong></p>
            </div>
            <div className="px-3">
              <p className="small text-muted mb-1">
                About : <strong style="margin-left:10px">
                          <?php 
                            $rows=$results->fetch_assoc();
                            echo $rows['about'];
                          ?>
                          <button style="text-decoration: none; height:30px; margin-left:50px; width: 60px; color: black; font-size: 14px; font-weight:700;" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="zmdi zmdi-edit"></i> Edit
                          </button>
                        </strong>
                
                <form action="server.php" method="post">
                  <div class="modal fade modal-style" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <textarea class="text-area" placeholder="Enter about yourself!" name="about" id="about" cols="30" rows="5" Required></textarea>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" name="edit" class="btn btn-danger">Save</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </p>
            </div>
            <div>
              <p className="small text-muted mb-1">Followers: <strong style="margin-left:10px">800</strong></p>
            </div>
            <div>
              <p className="small text-muted mb-1">Following: <strong style="margin-left:10px">0</strong></p>
            </div>
            <div>
                <a style="text-decoration: none; height:50px; width: 150px; background-color:red; color: black; font-size: 16px; font-weight:700;" type="button" class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                  Add New post
                </a>
                <form action="server.php" method="post">
                          <div class="modal fade modal-style" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <label style="font-weight:700; font-size:18px" for="title">Post Title:</label>
                                  <input type="text" id="title" name="title" class="inp-control" placeholder="Enter Post Title..." Required>
                                  <label style="font-weight:700; font-size:18px" for="items">Recipe Details:</label>
                                  <textarea class="text-area" placeholder="Enter Recipe details (Recipe list, Procedure etc.)" name="details" id="details" cols="30" rows="5" Required></textarea>
                                  <label style="font-weight:700; font-size:18px" for="file">Upload Image, Audio or Video:</label>
                                  <input type="file" id="file" name="file" accept="audio/*,video/*,image/*">
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button type="submit" name="post" class="btn btn-danger">Post</button>
                                </div>
                              </div>
                            </div>
                          </div>
                </form>
            </div>
            <div style="margin-top:50px; border: solid 1px red; padding: 2% 2% 2% 2%;">
              <h4 style="text-align:center; background-color:red; height:50px; padding-top:10px">Your Posts</h4>
              <?php
                while($rows=$result->fetch_assoc())
                {
                ?>
                  <div style="border:solid 1px gray; box-shadow: 0 4px 6px 0 rgba(0,0,0,0.3); margin-bottom:20px">
                    <div style="height:50px; text-align:center; font-weight:700; font-size:18px">
                      <tr><?php echo $rows['title'];?></tr>
                    </div>
                    <div class="scroll-text">
                      <tr><?php echo $rows['details'];?></tr>
                    </div>
                    <div style="height:fit-content; padding:2px 2px 2px 2px; text-align:center; border: solid 1px gray; margin:5px 5px 5px 5px;">
                      <tr><img src="<?php echo $rows['file'];?>" alt="image" height="100px"></tr>
                    </div>
                  </div>
                <?php
                }
              ?>
            </div>
        </div>
    </div>
</body>
</html>