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



<div class="container">
<br><br>
   <h2>MIT Academy of engineering</h2>
   <table class="table table-bordered table-striped table-responsive-stack" id="tableOne">
      <thead class="thead-dark">
       <tr>
        <th scope="col">Staff Id</th>
        <th scope="col">Staff Name</th>
        <th scope="col">Course</th>
        <th scope="col">Department</th>
        <th scope="col">Action</th>
      </tr>
      </thead>
      <tbody>
         <tr>
        <th scope="row">1</th>
        <td>Siddhi</td>
        <td>DBMS</td>
        <td>Information Technology</td>
        <td><button type="button" class="btn btn-primary btn-sm">Edit</button>
            <button type="button" class="btn btn-secondary btn-sm">Delete</button>
        </td>
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>Siddhi</td>
        <td>DBMS</td>
        <td>Information Technology</td>
        <td><button type="button" class="btn btn-primary btn-sm">Edit</button>
            <button type="button" class="btn btn-secondary btn-sm">Delete</button>
        </td>
      </tr>
      <tr>
        <th scope="row">3</th>
        <td>Siddhi</td>
        <td>DBMS</td>
        <td>Information Technology</td>
        <td><button type="button" class="btn btn-primary btn-sm">Edit</button>
            <button type="button" class="btn btn-secondary btn-sm">Delete</button>
        </td>
      </tr>
      </tbody>
    </div>
   <br><Br><br><Br>

   <div class="col-lg-12 grid-margin stretch-card">
                <!-- <div class="card"> -->
                  <!-- <div class="card-body"> -->
                    <div class="table-responsive">
                      <table class="table table-striped table-responsive-stack">
                        <thead>
                          <tr>
                            
                            <th> First name </th>
                            <th> Course </th>
                            <th> Feedback </th>
                            <th> Total Students</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr> 
                            <td> Siddhi Mankar </td>
                            <td> Data Structures </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td> 75/80 </td>
                          </tr>
                          

                          <tr> 
                            <td> Prajval Gandhi </td>
                            <td> Database Management System </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td> 75/80 </td>
                          </tr>

                          <tr> 
                            <td> Himanshu Sangale </td>
                            <td> Linux Operating System </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            <td> 75/80 </td>
                          </tr>


                        </tbody>
                      </table>
</div>
<!-- </div> -->
<!-- </div> -->
</div>



<!-- /.container -->


</body>
</html>