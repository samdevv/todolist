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
    width:800px;
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
      <div id="logreg-forms">
      <div>Welcome, <?php echo htmlspecialchars($_SESSION["username"]);  $username=$_SESSION["username"]?>
      <p class="float-right"><a href="logout.php">Logout</a></p>
      </div>
      <div align="middle"><h2>TODO LIST</h2></div>  
      <table class="table table-bordered" width="100%"  border="0" style="padding-left:40px">
                                <thead>
                                    <tr>
 
                       <th>Activity Name </th>
                       <th>Activity Date</th>
                       <th>Status</th>
                       <th>Delete</th>
                       <th>Update</th>
                       <th>Mark as Done</th>
                       </tr>
                     



                                </thead>
                                <?php
 include 'config.php';                               
$ret=mysqli_query($link,"select* from list ");
$num=mysqli_num_rows($ret);
if($num>0){
$cnt=1;
while ($data=mysqli_fetch_array($ret)) {
    $status=$data['aname']; 
   ?>
                                <tbody>
                           <tr data-expanded="true">
                           <td><?php echo $data['aname']; ?></td>
                          <td><?php echo $data['adate']; ?></td>
                          
       <?php if ($data['status'] =='new') { ?>
    <td style="color:blue"><?php echo $data['status']; ?></td>
<?php } else { ?>
    <td style="color:green" class="label label-success"><?php echo $data['status']; ?></td>
<?php } ?>
<td align="center">
<a href="delete.php?id=<?php echo $data["id"]; ?>">Delete</a>
</td>                 
<td align="center">
<a href="update.php?id=<?php echo $data["id"]; ?>">Update</a>
</td> 

<?php if ($data['status'] =='new') { ?>
    <td>
<a href="done.php?id=<?php echo $data["id"]; ?>"><?php echo $data['status']; ?></a>
</td> <?php } else { ?>
    <td style="color:green" class="label label-success"><?php echo $data['status']; ?></td>
<?php } ?>

 
</tr>
                  <?php 
$cnt=$cnt+1;
} } else { ?>
  <tr>
 
    </tr>
   
<?php }?>
  </tbody>
 

                            </table>
   <div align="middle">  <a   href="./dashboard.php">Back</a></div>

    </div> 
        </body>
    </html>