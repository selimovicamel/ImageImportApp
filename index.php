<?php
    
   $msg = "";
    // Connection with database 
  
    define("DB_SERVER", "localhost");
    define("DB_USER", "seebatest_sebatest");
    define("DB_PASSWORD", "90testseba09!");
    define("DB_DATABASE", "seebatest_db");

    $db = mysqli_connect(DB_SERVER , DB_USER, DB_PASSWORD, DB_DATABASE);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    };
    
    // Initialize message variable
    $msg = "";

?>

<!DOCTYPE html>

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <header>
        <div>
            <h1 id="title">Import image application</h1>
            <p id="description">Based on a client-server architecture</p>
        </div>
    </header>
    <div class="container">
        <div class="left">
            <div id="import">
                <label id="name-label">Upload image </label><br>
                <?php 
                // If upload button is clicked ...
                    if (isset($_POST['upload'])) {
                        
                        // the path to store images into folder
                          $target = "upload/".basename($_FILES['image']['name']);
                      
                          // Get image name
                          $image = $_FILES['image']['name'];
                      
                          // Get text
                          $image_text = $_POST['image_text'];
                          
                          if($_FILES['image']['name'] == "") {
                            // No file was selected for upload, your (re)action goes here
                            echo "<label id='name-label'>No file was selected for upload</label>";
                        }else {
                             $sql = "INSERT INTO images (image, text) VALUES ('$image', '$image_text')";
                        }
                          
                          // execute query
                          mysqli_query($db, $sql);
                          
                          // image file directory
                          $target = "upload/".basename($_FILES['image']['name']);
                          
                          
                        // Move uploaded image to the folder img
                          if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                      	    $msg = "Image uploaded successfully";
                          }else{
                      	    $msg = "Failed to upload image";
                          }
                    };
                    
                    $result = mysqli_query($db, "SELECT * FROM images");
                
                ?>
                <form method="POST" action="index.php" enctype="multipart/form-data" id="addImage">
  	                <div id="inputForm">
      	                <input type="hidden" name="size" value="1000000">
      	                <div class="input-group mb-3" id="inputForm">
      	                    <input type="file" name="image" class="custom-file-input">
      	                    <input type="text" id="text" name="image_text" placeholder="Attach the image..." class="custom-file-label">
      	                    <div class="input-group-append">
      		                <button type="submit" name="upload" class="input-group-text">Upload</button>
      	                    </div>
      	                </div>
      	                
  	                </div>
                </form>
            </div>
            <button class="btn btn-primary" id="btnAddImage" >Add new Image</button>
        </div>
        <div class="right">
            <label id="name-label">Liste of images > [ From Database ]</label>
                <table>
                    <tr style="text-align: left;">
                        <th width="20px" >ID</th>
                        <th width="400px">How the picture looks</th>
                        <th width="300px">Remove image from database</th>
                    </tr>
                    <?php
                        $db = mysqli_connect(DB_SERVER , DB_USER, DB_PASSWORD, DB_DATABASE);
        
                        $sql = "SELECT * FROM images";
                        $result = mysqli_query($db,$sql);
                        
                        while ($row = mysqli_fetch_array($result)) {
                        echo "<tr class='show'>";
                            echo "<td><p>".$row['id']."</p></td>";
                          	echo "<td><p><img width='200px' src='upload/".$row['Image']."'></p></td>"; 
                            echo "<td><p><a id='removeImage' href='index.php?id=".$row['id']."'>Remove image</a></p></td>";
                            
                            $sql = "DELETE FROM images WHERE ID='$_GET[id]'";
    
                            //Excecute the query 
                            mysqli_query($db, $sql);
                        }
                    ?>
                </table>
        </div>
    </div>
    <script src="app.js"></script>
</body>