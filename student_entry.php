<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<!-- <link rel="stylesheet" href="css/style.css"> -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> 
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 
<body>

<nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" style="color: white;">Home</a>
        </div>
    </nav> <br><br><br>
<div class="col-md-9 grid-margin stretch-card" style="margin-left: 10%; ">
                <div class="card">
                  <div class="card-body">
                    <center><h4 class="card-title">Student Information</h4></center>
      
                    <form class="forms-sample" method="post" action="database_controller.php">
                   

                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Student Email</label>
                        <div class="col-sm-9">
                          <input type="text" name="student_email" class="form-control" id="exampleInputUsername2" placeholder="eg someone@mitaoe.ac.in" >
                        </div>
                      </div>
                      <center>
                      	<button style="padding-left: 80px; padding-right: 80px;" type="submit" name="restrict_student" class="btn btn-primary mr-6" >Proceed
                        </button>
                      </center>
                  
                    </form>
                  </div>
                </div>
              </div><br>


</body>

