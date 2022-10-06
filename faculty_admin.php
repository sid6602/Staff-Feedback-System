<?php 
include("connection.php");
// session_start();
?>


<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<link rel="stylesheet" href="css/style1.css">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> 
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 
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
    $faculty_id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($connection, "SELECT * FROM faculty WHERE id=$faculty_id");

    if (count((array)$record)) 
    {
      $n = mysqli_fetch_array($record);
      $name = $n['name'];
    }
  }

  if (isset($_GET['delete'])) {

    $faculty_id1 = $_GET['delete'];
    $record = mysqli_query($connection, "DELETE FROM faculty WHERE id=$faculty_id1");
    
  }
?>



<div class="container">
<br><br>
   
<nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" style="color: white;">Home</a>
        </div>
    </nav> <br>






              <div class="col-md-9 grid-margin stretch-card" style="margin-left: 10%; ">
                <div class="card">
                  <div class="card-body">
                    <center><h4 class="card-title">Add Faculty</h4></center>
      
                    <form class="forms-sample" method="post" action="database_controller.php">
                      
                      <input type="hidden" name="faculty_id" value="<?php echo $faculty_id; ?>">

                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Faculty Name </label>
                        <div class="col-sm-9">
                          <input type="text" name="faculty_name" class="form-control" id="exampleInputUsername2" placeholder="Enter Name Here" value="<?php if (isset($_GET['edit'])) { echo $name ; } ?>">
                        </div>
                      </div>


                  
                      <div class="form-group form-control-md row">
                        <label for="" class="col-sm-3 col-form-label">Department</label>
                        <div class="col-sm-9 " >
                            <select class="js-example-basic-single form-control" 
                            name="faculty_branch" >
                              <option value="" disabled="disabled" selected >Select Department</option>
                              <option value="Chemical Engineering">Chemical Engineering</option>
                              <option value="Civil Engineering">Civil Engineering</option>
                              <option value="Computer Engineering">Computer Engineering</option>
                              <option value="Information Technology">Information Technology</option>
                              <option value="Electronics and Telecommunication Engineering">Electronics and Telecommunication Engineering</option>
                              <option value="Electronics Engineering">Electronics Engineering</option>
                              <option value="Mechanical Engineering">Mechanical Engineering</option>
                            </select>
                        </div>
                      </div>

                      <center>

        
                    <?php  
                              if (isset($_GET['edit']) && $update == true): ?>
                        <button style="padding-left: 80px; padding-right: 80px;" type="submit"   class="btn btn-primary mr-6" name="submit_edit_faculty" value="submit_edit_faculty">Update
                        </button>
                    <?php  else:  ?>
                        <button style="padding-left: 80px; padding-right: 80px;" type="submit" name="submit_add_faculty" value="submit_add_faculty" class="btn btn-primary mr-6" >Submit
                        </button>
                    <?php endif ?>
                  </center>
                      
                    </form>
                  </div>
                </div>
              </div><br>

    <?php   

      $sql_course="SELECT * FROM faculty";

      $result_course=mysqli_query($connection,$sql_course) or die("Query Uncessfull");

      if(mysqli_num_rows($result_course) > 0){
      
      
       ?>
   <table class="table table-bordered table-striped table-responsive-stack" id="tableOne">
      <thead class="thead-dark">
       <tr>

        <th scope="col">Sr. No</th>
        <th scope="col">Faculty Name</th>
        <th scope="col">Department</th>
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
            <td><?php echo $row_course['name']; ?></td>
            <td><?php echo $row_course['department']; ?></td>
            <td>
              <div class="row">
                  <div class="col-md-3">
                    <a href="faculty_admin.php?edit=<?php echo $row_course['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                  </div>
                  <div class="col-md-9">
                    <!-- <form method="post" action="database_controller.php"> -->
                        <a href="del/faculty_del.php?del_faculty_id=<?php echo $row_course['id']; ?>" type="button" class="btn btn-secondary btn-sm">
                          Delete
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