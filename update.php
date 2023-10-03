<?php
session_start();
 if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: .index.php");
    exit;
}
?>
<html>
    <head>
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script><title>
Todo List
</title>
<style>
  #logreg-forms{
    width:412px;
    margin:10vh auto;
    background-color:#f3f3f3;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  transition: all 0.3s cubic-bezier(.25,.8,.25,1);
}
#logreg-forms form {
    width: 100%;
    max-width: 410px;
    padding: 15px;
    margin: auto;
}
#logreg-forms .form-control {
    position: relative;
    box-sizing: border-box;
    height: auto;
    padding: 10px;
    font-size: 16px;
}
#logreg-forms .form-control:focus { z-index: 2; }
#logreg-forms .form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
}
#logreg-forms .form-signin input[type="password"] {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}

#logreg-forms .social-login{
    width:390px;
    margin:0 auto;
    margin-bottom: 14px;
}
#logreg-forms .social-btn{
    font-weight: 100;
    color:white;
    width:190px;
    font-size: 0.9rem;
}

#logreg-forms a{
    display: block;
    padding-top:10px;
    color:lightseagreen;
}

#logreg-form .lines{
    width:200px;
    border:1px solid red;
}


#logreg-forms button[type="submit"]{ margin-top:10px; }

#logreg-forms .facebook-btn{  background-color:#3C589C; }

#logreg-forms .google-btn{ background-color: #DF4B3B; }

#logreg-forms .form-reset, #logreg-forms .form-signup{ display: none; }

#logreg-forms .form-signup .social-btn{ width:210px; }

#logreg-forms .form-signup input { margin-bottom: 2px;}

.form-signup .social-login{
    width:210px !important;
    margin: 0 auto;
}

/* Mobile */

@media screen and (max-width:500px){
    #logreg-forms{
        width:300px;
    }
    
    #logreg-forms  .social-login{
        width:200px;
        margin:0 auto;
        margin-bottom: 10px;
    }
    #logreg-forms  .social-btn{
        font-size: 1.3rem;
        font-weight: 100;
        color:white;
        width:200px;
        height: 56px;
        
    }
    #logreg-forms .social-btn:nth-child(1){
        margin-bottom: 5px;
    }
    #logreg-forms .social-btn span{
        display: none;
    }
    #logreg-forms  .facebook-btn:after{
        content:'Facebook';
    }
  
    #logreg-forms  .google-btn:after{
        content:'Google+';
    }
    
}
  </style>
     </head>
     <body>
 <?php
     $message="";
 define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'todolist');
 
/* Attempt to connect to MySQL database */
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$id=$_GET['id'];
$query1 = mysqli_query($conn, "SELECT * FROM list where id='$id'");
$res = mysqli_fetch_array($query1);
$aname = $res['aname'];
$adate = $res['adate'];
 

       if (isset($_POST['btn-up']))
{
    $activity=$_POST['activity'];
    $adate=$_POST['adate'];
      $sql = "UPDATE list SET aname='$activity',adate='$adate' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        $message = '  <div class="alert alert-success"> Todo List Updated  </div>  ';
    }
     
    else    {
        $message = '  <div class="alert alert-danger">  Error occurred  </div>  ';
    }
}
?>
      <div id="logreg-forms">
      <div>Welcome, <?php echo htmlspecialchars($_SESSION["username"]);  $username=$_SESSION["username"]?></div>
     <div align="middle"> <h2>TODO LIST</h2>
     <p class="float-right"><a href="logout.php">Logout</a></p>
     </div>
         <form action="" method="POST" class="form-signin">
             <input type="text" id="activity" name="activity" class="form-control" value="<?php echo $aname; ?>" autofocus="">
            <br>
            <input type="date" id="adate" name="adate" class="form-control"   value="<?php echo $adate; ?>" >
            
            <button class="btn btn-primary btn-block" type="submit" name="btn-up" id="btn-up"><i class="fas fa-user-plus"></i> Update List</button>
             <hr>
            </form>
 <?php echo  $message; ?>
<div align="middle"> <a   href="./mylist.php">Back To List</a></div>
    </div> 
        </body>
    </html>