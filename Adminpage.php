<?php include('server.php') ?>
<?php

$errors = array();
$_SESSION['success'] = "";

$db = mysqli_connect('localhost', 'root', '', 'recipe');
$username = $_SESSION['username'];
$query = "SELECT * FROM `post` WHERE username!='$username'";
$result = mysqli_query($db, $query); 
$db->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome to Swadisht</title>
    <link rel="stylesheet" href="Index.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <script src="https://kit.fontawesome.com/a9a0efeadc.js" crossorigin="anonymous"></script>
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
    <style>
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
          width: 100%;
      }

      .scroll-text {
        height:80px; 
        overflow:scroll; 
        text-align:center;
        font-size:16px;
      }
  
      .scroll-text::-webkit-scrollbar {
        -webkit-appearance: none;
       }

    </style>
  </head>
  <body style="background-color: #fefefe">
    <nav
      class="navbar navbar-expand-lg navbar-light container-fluid" style="background-color: #dbe2fd;">
      <div class="container-fluid">
        <a class="navbar-brand" href="Index.html">
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
              <a class="nav-link active" aria-current="page" href="#">All</a>
            </li>
            <li class="nav-item mx-2">
              <a class="nav-link" href="#">Special</a>
            </li>
            <li class="nav-item mx-2">
                <a class="nav-link" href="#popular">Popular</a>
              </li>
            <li class="nav-item dropdown mx-2">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdownMenuLink"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Categories
              </a>
              <ul
                class="dropdown-menu"
                aria-labelledby="navbarDropdownMenuLink"
              >
                <li><a class="dropdown-item" href="#">Veg</a></li>
                <li><a class="dropdown-item" href="#">Non-veg</a></li>
                <li><a class="dropdown-item" href="#">Snacks</a></li>
                <li><a class="dropdown-item" href="#">Bakery Items</a></li>
                <li><a class="dropdown-item" href="#">Sweets</a></li>
                <li><a class="dropdown-item" href="#">Fast Special</a></li>
                <li><a class="dropdown-item" href="#">South Indian</a></li>
                <li><a class="dropdown-item" href="#">Chinese Special</a></li>
                <li><a class="dropdown-item" href="#">Sea Food</a></li>
                <li><a class="dropdown-item" href="#">Salad</a></li>
              </ul>
            </li>
            <li class="nav-item mx-2">
                <a class="nav-link" href="#">Offers and More</a>
              </li>
            <li class="nav-item mx-2">
              <a class="nav-link" href="#">Setting</a>
            </li>
            <li>
                <a type="button" class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Add post
                </a>
                <form action="server.php" method="post">
                          <div class="modal fade modal-style" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <label for="title">Post Title:</label>
                                  <input type="text" id="title" name="title" class="inp-control" placeholder="Enter Post Title..." Required>
                                  <label for="items">Recipe Details:</label>
                                  <textarea class="text-area" placeholder="Enter Recipe details (Recipe list, Procedure etc.)" name="details" id="details" cols="30" rows="5" Required></textarea>
                                  <label for="file">Upload Image, Audio or Video:</label>
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
            </li>
            <li class="nav-item mx-2">
              <a class="nav-link" href="Profile.php">Profile</a>
            </li>
            <li class="nav-item mt-2 ms-5">
              <h5>
              WELCOME  
              <strong>
                  <?php 
                    echo $_SESSION['username'];
                    if (!isset($_SESSION['username'])) {
                        $_SESSION['msg'] = "You have to log in first";
                        header('location: Login.php');
                    }
                    ?>
              </strong>
              </h5>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <section class="container sect1">
        <div class="container" style="text-align: center;">
          <img src="Logo.png" alt="Logo" height="300px"/><br>
          <span style="font-size: larger;">Welcome to Swadisht</span>
        </div>
      
      <div style="display: flex; margin-top: 2%">
        <input
          type="text"
          placeholder="Search Recipe..."
          class="search"
          style="margin-right: 1%; margin-left: 20%"
        />
        <button type="submit" class="search-but">Search</button>
      </div>
    </section>

  <section id="popular" class="container sect2">
    <p style="text-align: center; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; margin-bottom:40px;">
      Try Popular Recipe!!!
    </p>

    <div class="container">
      <div class="row">           
      <?php
        while($rows=$result->fetch_assoc())
        {
        ?>
        <div class="col">
          <div class="card" style="width: 22rem;  box-shadow: 0 4px 6px 0 rgba(0,0,0,0.3); overflow:hidden; margin-bottom:20px">
              <div style="height:50px; margin-left:10px; font-weight:700; font-size:16px">
                <tr>
                  <i class="fa-solid fa-user" style="font-size:16px; margin-right:5px"></i>
                  <a href="#" style="text-decoration:none; color:black;">
                    <?php 
                      // $_SESSION['userprofile']=$rows['username'];
                      echo $rows['username'];
                    ?>
                  </a>
                  <button style="float:right; border-radius:2px; font-size:small; margin: 2px 2px 0px 0px">Follow</button>
                </tr>
              </div>    
              <div style="height:50px; text-align:center; font-weight:700; font-size:16px">
                <tr><?php echo $rows['title'];?></tr>
              </div>
              <div class="scroll-text">
                <tr><?php echo $rows['details'];?></tr>
              </div>
              <div style="height:fit-content; padding:2px 2px 2px 2px; text-align:center; border: solid 1px gray; margin:5px 5px 5px 5px;">
                <tr><img src="<?php echo $rows['file'];?>" alt="image" height="100px"></tr>
              </div>
              <div class="row container">
                <div class="col-6" style="text-align:center; font-size:28px;">
                  <button style="background-color:white; border:none" onclick="likebutton()">
                    <i id="like" class="fa-sharp fa-regular fa-heart"></i>
                  </button>
                  <p id="likes"></p>
                </div>
                <div class="col-6" style="text-align:center; font-size:28px;">
                  <i class="fa-sharp fa-solid fa-share-nodes"></i>
                </div>
              </div>
          </div>
        </div>
        <?php
        }
        ?>
      </div>
    </div>
  </section>

<script>
  function likebutton()
  {
      document.getElementById("like").style.color = "red";
      const element = document.getElementById("like");
      if (element.className == "fa-sharp fa-regular fa-heart")
      {
        element.className = "fa-solid fa-heart";
      }
      else
      {
        element.className = "fa-sharp fa-regular fa-heart";
      }
  }
</script>




    <section class="container sect 2">
      <p style="text-align: center; font-size:36px; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; margin-top:40px; margin-bottom:40px;">
        Categorywise Recipe!!!
      </p>

      <div class="container">
        <div class="row">
          
          <div class="col">
            <div class="card" style="width: 12rem">
              <img src="..." class="card-img-top" alt="..." />
                <div class="card-body">
                    <p class="card-text">
                        ...
                    </p>
                </div>
            </div>
          </div>

          <div class="col">
            <div class="card" style="width: 12rem">
              <img src="..." class="card-img-top" alt="..." />
              <div class="card-body">
                <p class="card-text">
                    ...
                </p>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card" style="width: 12rem">
              <img src="..." class="card-img-top" alt="..." />
              <div class="card-body">
                <p class="card-text">
                    ...
                </p>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card" style="width: 12rem">
              <img src="..." class="card-img-top" alt="..." />
              <div class="card-body">
                <p class="card-text">
                    ...
                </p>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card" style="width: 12rem">
              <img src="..." class="card-img-top" alt="..." />
              <div class="card-body">
                <p class="card-text">
                  ...
                </p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <footer class="container-fluid footer">
        <div class="container row px-5 py-5" style="margin:auto;">
            <div class="col">
                Help
            </div>
            <div class="col">
                Privacy
            </div>
            <div class="col">
                About us
            </div>
            <div class="col">
                Terms & Services
            </div>
            <div class="col">
                Feedback
            </div>
            <div class="col">
                Customer care
            </div>
            <div class="col">
                Contact Us
            </div>
            <div class="col">
                FAQs
            </div>
        </div>

        <p style="text-align: center;">
            ©copyright 1999-2023, Swadisht.com, Inc. All rights reserved. <br>
            Swadisht Recipes is part of the I Square IT, YB family.
        </p>
    </footer>

  </body>
</html>
