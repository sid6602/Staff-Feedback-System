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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script>

<body>
    <script type="text/javascript">
    $(document).ready(function() {


        // inspired by http://jsfiddle.net/arunpjohny/564Lxosz/1/
        $('.table-responsive-stack').each(function(i) {
            var id = $(this).attr('id');
            //alert(id);
            $(this).find("th").each(function(i) {
                $('#' + id + ' td:nth-child(' + (i + 1) + ')').prepend(
                    '<span class="table-responsive-stack-thead">' + $(this).text() +
                    ':</span> ');
                $('.table-responsive-stack-thead').hide();

            });



        });





        $('.table-responsive-stack').each(function() {
            var thCount = $(this).find("th").length;
            var rowGrow = 100 / thCount + '%';
            //console.log(rowGrow);
            $(this).find("th, td").css('flex-basis', rowGrow);
        });




        function flexTable() {
            if ($(window).width() < 768) {

                $(".table-responsive-stack").each(function(i) {
                    $(this).find(".table-responsive-stack-thead").show();
                    $(this).find('thead').hide();
                });


                // window is less than 768px   
            } else {


                $(".table-responsive-stack").each(function(i) {
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

    <!-- To send mail -->
    <?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function sendMail($emails)
{
$mail = new PHPMailer(true);
print_r($emails);
try {
 
                  
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'prajval.gandhi@mitaoe.ac.in';                    
    $mail->Password   = '31052002';                             
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                    

  
    $mail->setFrom('prajval.gandhi@mitaoe.ac.in', 'MIT Academy of Engineering');
    
    foreach($emails as $email)
    {
        $mail->addAddress($email);             
    }
        
        $mail->isHTML(true);                                 
        $mail->Subject = 'Feedback form filling'.time();
        $mail->Body    = '<pre><h4 style = "font-size:.8rem">Dear students,<br><br>   Fill out the faculty feedback form<br><a href="http://localhost/erp/feedback.html">Click here to fill feedback form</a><br><br>Thanks and regards,</h4></pre>';

        
        $mail->send();
        echo '<script>alert("Message has been sent")</script>';
        } catch (Exception $e) {
            echo '<script>alert("Message could not be sent. Mailer Error: {$mail->ErrorInfo}")<script>';
        }
    }

    ?>


    <?php 
  if (isset($_GET['edit'])) {
    $student_id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($connection, "SELECT * FROM students WHERE student_id=$student_id")or die("Query Uncessfull");

    if (count((array)$record)) {
      $n = mysqli_fetch_array($record);

      
             $student_name= $n['name'];
             $student_prn= $n['prn'];
             $student_email= $n['email'];
             $branch= $n['branch'];
             $division= $n['division'];
             $year= $n['year'];
             $addmission_year= $n['addmission_year'];
             $response= $n['response'];
             
          
      
    }
  }

  if (isset($_GET['delete'])) {
    $course_id1 = $_GET['delete'];
   
    $record = mysqli_query($connection, "DELETE FROM course WHERE id=$course_id1");
    
  }

  if(isset($_POST['sendFeedback']))
  {
    $emails = mysqli_query($connection, 'select email from students where response = 0');
    print_r(mysqli_fetch_array($emails));
    sendMail(mysqli_fetch_array($emails));
  }
  
?>



    <div class="container">
        <br><br>

        <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" style="color: white;">Home</a>
                <form method="post">
                    <button type="submit" class="btn btn-primary" name="sendFeedback">Send feedback form</button>
                </form>
            </div>
        </nav>
        <br>






        <div class="col-md-9 grid-margin stretch-card" style="margin-left: 10%; ">
            <div class="card">
                <div class="card-body">
                    <center>
                        <h4 class="card-title">Add Students</h4>
                    </center>

                    <form class="forms-sample" method="post" action="database_controller.php">

                        <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">

                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Student Name </label>
                            <div class="col-sm-9">
                                <input type="text" name="student_name" class="form-control" id="exampleInputUsername2"
                                    placeholder="" value="<?php if (isset($_GET['edit'])) { echo $student_name ; } ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Student PRN </label>
                            <div class="col-sm-9">
                                <input type="text" name="student_prn" class="form-control" id="exampleInputUsername2"
                                    placeholder="" value="<?php if (isset($_GET['edit'])) { echo $student_prn ; } ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Student Email</label>
                            <div class="col-sm-9">
                                <input type="text" name="student_email" class="form-control" id="exampleInputUsername2"
                                    placeholder="" value="<?php if (isset($_GET['edit'])) { echo $student_email ; } ?>">
                            </div>
                        </div>


                        <div class="form-group form-control-md row">
                            <label for="" class="col-sm-3 col-form-label">Department</label>
                            <div class="col-sm-9 ">
                                <select class="js-example-basic-single form-control" name="branch">
                                    <option value="" disabled="disabled" selected>Select Department</option>
                                    <option value="Chemical Engineering">Chemical Engineering</option>
                                    <option value="Civil Engineering">Civil Engineering</option>
                                    <option value="Computer Engineering">Computer Engineering</option>
                                    <option value="Information Technology">Information Technology</option>
                                    <option value="Electronics and Telecommunication Engineering">Electronics and
                                        Telecommunication Engineering</option>
                                    <option value="Electronics Engineering">Electronics Engineering</option>
                                    <option value="Mechanical Engineering">Mechanical Engineering</option>
                                </select>
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Division</label>
                            <div class="col-sm-9">
                                <input type="text" name="division" class="form-control" id="exampleInputUsername2"
                                    placeholder="" value="<?php if (isset($_GET['edit'])) { echo $division ; } ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Current Study
                                Year</label>
                            <div class="col-sm-9">
                                <input type="number" name="year" class="form-control" id="exampleInputUsername2"
                                    placeholder="" value="<?php if (isset($_GET['edit'])) { echo $year ; } ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Addmission Year</label>
                            <div class="col-sm-9">
                                <input type="number" name="addmission_year" class="form-control"
                                    id="exampleInputUsername2" placeholder=""
                                    value="<?php if (isset($_GET['edit'])) { echo $addmission_year ; } ?>">
                            </div>
                        </div>

                        <!-- <div class="form-group row" hidden="">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Response</label>
                        <div class="col-sm-9">
                          <input type="text"  name="response" class="form-control" id="exampleInputUsername2" placeholder="" value="<?php if (isset($_GET['edit'])){ } else { echo '0'; }?>">
                        </div>
                      </div> -->

                        <center>


                            <?php  
                              if (isset($_GET['edit']) && $update == true): ?>
                            <button style="padding-left: 80px; padding-right: 80px;" type="submit"
                                class="btn btn-primary mr-6" name="submit_edit_student"
                                value="submit_edit_student">Update
                            </button>
                            <?php  else:  ?>
                            <button style="padding-left: 80px; padding-right: 80px;" type="submit"
                                name="submit_add_student" value="submit_add_student" class="btn btn-primary mr-6">Submit
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
                            <form action="student_excel.php" method="POST" enctype="multipart/form-data">
                                <input type="file" name="import_file" class="form-control">
                                <center>
                                    <button type="submit" name="student_excel_data" class="btn btn-primary mt-3"
                                        style="padding-left: 80px; padding-right: 80px;">Import</button>
                                </center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><br>

        <?php   

      $sql_course="SELECT * FROM students";

      $result_course=mysqli_query($connection,$sql_course) or die("Query Uncessfull");

      if(mysqli_num_rows($result_course) > 0){
      
      
       ?>
        <table class="table table-bordered table-striped" id="tableOne">
            <thead class="thead-dark">
                <tr>

                    <th scope="col">Id</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Student PRN</th>
                    <th scope="col">Student email</th>
                    <th scope="col">Branch</th>
                    <th scope="col">Division</th>
                    <th scope="col">Year</th>
                    <th scope="col">Addmission Year</th>
                    <th scope="col">Response</th>
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
                    <td><?php echo $row_course['prn']; ?></td>
                    <td><?php echo $row_course['email']; ?></td>
                    <td><?php echo $row_course['branch']; ?></td>
                    <td><?php echo $row_course['division']; ?></td>
                    <td><?php echo $row_course['year']; ?></td>
                    <td><?php echo $row_course['addmission_year']; ?></td>
                    <td><?php echo $row_course['response']; ?></td>
                    <td>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="students.php?edit=<?php echo $row_course['student_id']; ?>"
                                    class="btn btn-primary btn-sm">Edit</a>
                            </div>
                            <div class="col-md-6">
                                <!-- <form method="post" action="database_controller.php"> -->
                                <a href="del/students_del.php?del_student_id=<?php echo $row_course['student_id']; ?>"
                                    type="button" class="btn btn-secondary btn-sm">
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