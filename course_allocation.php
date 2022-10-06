<!-- student and faculty allocation..... crud.. excel .. student response limit -->

<?php 
session_start();
include("connection.php");
// session_start();
?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<link rel="stylesheet" href="css/style2.css">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> 
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
   </script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script>
 
<body>
<script type="text/javascript">
	
	$(document).ready(function() {

   
   // inspired by http://jsfiddle.net/arunpjohny/564Lxosz/1/
   $('.table-responsive-stack').each(function (i) {
      var id = $(this).attr('id');
      //alert(id);
      $(this).find("th").each(function(i) {
         $('#'+id + ' td:nth-child(' + (i + 1) + ')').prepend('<span class="table-responsive-stack-thead">'+             $(this).text() + ':</span> ');
         $('.table-responsive-stack-thead').hide();
         
      });
      

      
   });

   
   
   
   
$( '.table-responsive-stack' ).each(function() {
  var thCount = $(this).find("th").length; 
   var rowGrow = 100 / thCount + '%';
   //console.log(rowGrow);
   $(this).find("th, td").css('flex-basis', rowGrow);   
});
   
   
   
   
function flexTable(){
   if ($(window).width() < 768) {
      
   $(".table-responsive-stack").each(function (i) {
      $(this).find(".table-responsive-stack-thead").show();
      $(this).find('thead').hide();
   });
      
    
   // window is less than 768px   
   } else {
      
      
   $(".table-responsive-stack").each(function (i) {
      $(this).find(".table-responsive-stack-thead").hide();
      $(this).find('thead').show();
   });
      
      

   }
// flextable   
}      
 
flexTable();
   
window.onresize = function(event) {
    flexTable();
};
   
   
   
   

  
// document ready  
});

</script>


<?php 
  if (isset($_GET['edit'])) {
    $course_allocation_id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($connection, "SELECT * FROM course_allocation WHERE id=$course_allocation_id");

    if (count((array)$record)) {
      $n = mysqli_fetch_array($record);
              $faculty_name= $n['faculty_name'];
             $faculty_email= $n['faculty_email'];
             $subject_name= $n['subject_name'];
             $subject_short_name= $n['subject_short_name'];
             $subject_type= $n['subject_type'];
             $division= $n['division'];
             $batch= $n['batch'];
      
    }
  }

  if (isset($_GET['delete'])) {
    $course_id1 = $_GET['delete'];
   
    $record = mysqli_query($connection, "DELETE FROM course WHERE id=$course_id1");
    
  }
?>



<div class="container">
<br><br>
   
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" style="color: white;">Home</a>
        </div>
    </nav>
    <br>






              <div class="col-md-9 grid-margin stretch-card" style="margin-left: 10%; ">
                <div class="card">
                  <div class="card-body">
                    <center><h4 class="card-title">Allocate Cource to Faculty</h4></center>
      
                    <form class="forms-sample" method="post" action="database_controller.php">
                      
                      <input type="hidden" name="course_allocation_id" value="<?php echo $course_allocation_id; ?>">

                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Faculty Name </label>
                        <div class="col-sm-9">
                          <input type="text" name="faculty_name" class="form-control" id="exampleInputUsername2" placeholder="" value="<?php if (isset($_GET['edit'])) { echo $faculty_name ; } ?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Faculty Email</label>
                        <div class="col-sm-9">
                          <input type="text" name="faculty_email" class="form-control" id="exampleInputUsername2" placeholder="" value="<?php if (isset($_GET['edit'])) { echo $faculty_email ; } ?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Subject Name </label>
                        <div class="col-sm-9">
                          <input type="text" name="subject_name" class="form-control" id="exampleInputUsername2" placeholder="" value="<?php if (isset($_GET['edit'])) { echo $subject_name ; } ?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Subject Short Name </label>
                        <div class="col-sm-9">
                          <input type="text" name="subject_short_name" class="form-control" id="exampleInputUsername2" placeholder="" value="<?php if (isset($_GET['edit'])) { echo $subject_short_name ; } ?>">
                        </div>
                      </div>
                  
                      <div class="form-group form-control-md row">
                        <label for="" class="col-sm-3 col-form-label">Subject Type</label>
                        <div class="col-sm-9 " >
                            <select class="js-example-basic-single form-control" 
                            name="subject_type" >
                              <option value="" disabled="disabled" selected >Select Subject Type</option>
                              <option value="Core Lab">Core Lab</option>
                              <option value="Core Theory">Core Theory</option>
                              
                            </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Division</label>
                        <div class="col-sm-9">
                          <input type="text" name="division" class="form-control" id="exampleInputUsername2" placeholder="" value="<?php if (isset($_GET['edit'])) { echo $division ; } ?>">
                        </div>
                      </div>  
                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Batch</label>
                        <div class="col-sm-9">
                          <input type="text" name="batch" class="form-control" id="exampleInputUsername2" placeholder="" value="<?php if (isset($_GET['edit'])) { echo $batch ; } ?>">
                        </div>
                      </div>


                      <center>

        
                    <?php  
                              if (isset($_GET['edit']) && $update == true): ?>
                        <button style="padding-left: 80px; padding-right: 80px;" type="submit"   class="btn btn-primary mr-6" name="submit_edit_course_allocation" value="submit_edit_course_allocation">Update
                        </button>
                    <?php  else:  ?>
                        <button style="padding-left: 80px; padding-right: 80px;" type="submit" name="submit_add_course_allocation" value="submit_add_course_allocation" class="btn btn-primary mr-6" >Submit
                        </button>
                    <?php endif ?>
                  </center>
                      
                    </form>
                  </div>
                </div>
              </div>

      <div class="container" style="margin-left: 10%; ">
        <div class="row">
          <div class="col-md-9 mt-4">

              <?php 
                if (isset($_SESSION['message'])) {
                  echo "<h4>".$_SESSION['message']."</h4>";
                  unset($_SESSION['message']);
                }
              ?>

            <div class="card">
              <div class="card-body">
                <form action="course_allocation_excel.php" method="POST" enctype="multipart/form-data">
                  <input type="file" name="import_file" class="form-control">
                  <center>
                  <button type="submit" name="course_allocation_excel_data" class="btn btn-primary mt-3" style="padding-left: 80px; padding-right: 80px;">Import</button>
                  </center>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div><br>        

              
    <?php   

      $sql_course="SELECT * FROM course_allocation";

      $result_course=mysqli_query($connection,$sql_course) or die("Query Uncessfull");

      if(mysqli_num_rows($result_course) > 0){
      
      
       ?>
   <table class="table table-bordered table-striped" id="tableOne">
    <thead class="thead-dark">
       <tr>
        <th scope="col">Id</th>
        <th scope="col">Faculty Name</th>
        <th scope="col">Faculty email</th>
        <th scope="col">Subject Name</th>
        <th scope="col">Subject Short Name</th>
        <th scope="col">Subject Type</th>
        <th scope="col">Batch</th>
        <th scope="col">Division</th>
        <th scope="col">Action</th>
      </tr>
      </thead>
      <tbody>

        <tr>
          <?php 
          $counter=0;
            while ($row_course=mysqli_fetch_assoc($result_course)) {
              $counter++;
          ?>
            <th scope="row"><?php echo $counter  ?></th>
            <td><?php echo $row_course['faculty_name']; ?></td>
            <td><?php echo $row_course['faculty_email']; ?></td>
            <td><?php echo $row_course['subject_name']; ?></td>
            <td><?php echo $row_course['subject_short_name']; ?></td>
            <td><?php echo $row_course['subject_type']; ?></td>
            <td><?php echo $row_course['batch']; ?></td>
            <td><?php echo $row_course['division']; ?></td>
            <td>
              <div class="row">
                  <div class="col-md-6">
                    <a href="course_allocation.php?edit=<?php echo $row_course['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                  </div>
                  <div class="col-md-6">
                    <!-- <form method="post" action="database_controller.php"> -->
                       <a href="del/course_allocation.php?del_course_id=<?php echo $row_course['id']; ?>" type="button" class="btn btn-secondary btn-sm">
                          Del
                        </a>
                    <!-- </form> -->
                </div>
              </div>
            </td>
        </tr>
        <?php } }?>
      </tbody>
    </div>
   

  
</body>
</html>