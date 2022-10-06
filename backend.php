<?php

// To start the session
session_start();

$student_data = [];
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // if($_POST['data']){
    // $data = json_decode($_POST['data'],true);
    // print_r( $data['feedback']);
    // echo $data['feedback'][0]['course_id'];
    // echo implode(",",$data['feedback']);
    // echo $data['request'];
    // echo $data['feedback'];
    // echo implode(",",$data);
    // }
    if($_POST['request'] == 'student_form'){
        $email= $_POST['email'];

        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $db = 'mitaoe';
        $connection = new mysqli($servername, $username, $password, $db);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        $query = 'select * from students where email = "'.$email.'"';
        $result = $connection->query($query);
        if($result->num_rows>0){
            $student_data = $result->fetch_row();
            if($student_data[8] == 0){
                $student_detail_form = '
                <form class="student-details row g-3 mt-3 p-3" id="student-details" autocomplete="off">
                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control" id="floatingName"  value="'.$student_data[1].'"  disabled required>
                    <label for="floatingName">Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="PRN" class="form-control" id="floatingPRN" placeholder="12 digit" minlength="12" maxlength="12"  value="'.$student_data[2].'" disabled>
                    <label for="floatingPRN">PRN number</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="floatingEmail" value="'.$student_data[3].'"  disabled>
                    <label for="floatingEmail">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="branch" class="form-control" id="floatingBranch" placeholder="12 digit" value="'.$student_data[4].'" disabled>
                    <label for="floatingPRN">Branch</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="division" class="form-control" id="floatingDiv" value="'.$student_data[5].'" disabled>
                    <label for="floatingEmail">Division</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="batch" class="form-control" id="floatingBatch"  value=""  placeholder="Enter your batch" required>
                    <label for="floatingName">Batch</label>
                </div>

                <button aria-label="Next" class="stud_info_btn btn btn-outline-primary btn-sm mt-3">Next</button>
                </form>
                
                <script>
                $(".student-details .stud_info_btn").click(function(e) {
                    e.preventDefault()
                    // To keep track of current visible form
                    let formCounter = 1;
            
                    $.ajax({
                        datatype: "json",
                        type: "post",
                        url: "backend.php",
                        data: {"request":"feedback_form","batch":$("#student-details #floatingBatch").val(), "branch":$("#student-details #floatingBranch").val(),"division":$("#student-details #floatingDiv").val()},
                        success: function(response) {
                            if (!response) {
                                alert("error")
                            } else {
                                console.log(response)
                                let data = response.split("/,");
                                $(".student-info").addClass("d-none")
                                $(".feedback .feedback-forms").removeClass("d-none");
                                $(".feedback .feedback-forms").html(data[0]);
            
                                for (let j = 2; j <= data[1]; j++) {
                                    $("#ratingForm" + j).addClass("d-none");
                                }
                            }
                        }
                    })
                });
                </script>
                ';
                $_SESSION['email'] = $email;
                echo $student_detail_form;
            }
            else{
                echo 0; 
                echo '<div class="outer-box">
                <div class="inner-box">
                <h1>You have already responded</h1>
                <p>Your response has been recorded.</p>
                </div>   
                </div>';   
            }
        }
        else{
            echo 0;
            echo '<div class="outer-box">
            <div class="inner-box">
            <h1>Access denied</h1>
            <p>You can access the feedback form using your official mail id only. <a href="">Re-enter email</a></p>
            </div>
            </div>';
        }

    }
    
    elseif($_POST['request'] == 'feedback_form'){
        $batch = $_POST['batch'];
        $branch = $_POST['branch'];
        $division = $_POST['division'];
        $data = getforms($branch, $batch,$division);
        echo $data['forms'].','.$data['count'];
    }


    elseif($_POST['request'] == 'feedback-data')
    {
        $feedback = $_POST['feedback'];
        save_feedback($feedback);        
    }
     
    else {
        echo false;
    }
}
 
function createConn()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mitaoe";
    global $connection;
    $connection = new mysqli($servername, $username, $password, $dbname);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    return $connection;
}

function fetch_courses($branch, $batch, $division)
{
    $conn = createConn();
    $query = mysqli_query($conn, "SELECT * FROM course_allocation where branch = '$branch' and (batch = '$division' or batch = '$batch')");
    $feedback = array();
    while ($row = mysqli_fetch_assoc($query)) {
        $course_name = get_course_name($row['course_id']);
            $faculty_name = get_faculty_name($row['faculty_id']);
            $form_row = array($row['course_id'],$course_name, $row['faculty_id'],$faculty_name);
            array_push($feedback, $form_row);
  
        }
        return $feedback;
}



function get_course_name($course_id)
{
    $conn = createConn();
    $sql = mysqli_query($conn,"SELECT name FROM course where id = '$course_id'");
    $row = mysqli_fetch_row($sql);
    
    return $row[0];
} 

function get_faculty_name($faculty_id)
{
    $conn = createConn();
    $sql = mysqli_query($conn,"SELECT name FROM faculty where id = '$faculty_id'");
    $row = mysqli_fetch_row($sql);
    return $row[0];
    
}

function get_course_id($course_name, $branch)
{
    $conn = createConn();
    $sql = mysqli_query($conn,"SELECT id FROM course where name = '$course_name' and branch = '$branch'");
    
    $row = mysqli_fetch_row($sql);
    return $row[0];
}
function get_faculty_id($faculty_name)
{
    $conn = createConn();
    $sql = $conn->prepare("SELECT id FROM faculty where name = ?");
    $sql->bind_param("s", $faculty_name);
    $sql->execute();
    if ($sql->num_rows > 0) {
        $result = $sql->get_result();
        while ($data = $result->fetch_assoc()) {
            return $data['id'];
        }
    } else {
        return -1;
    }
}

function save_feedback($feedback)
{
    $conn = createConn();
    $success = 0;
    for ($i=0; $i < sizeof($feedback); $i++) { 
        $sql = mysqli_query($conn," UPDATE feedback set 
                                q1 = q1 + ".(int)$feedback[$i][4].", 
                                q2 = q2 + ".(int)$feedback[$i][5].", 
                                q3 = q3 + ".(int)$feedback[$i][6].", 
                                q4 = q4 + ".(int)$feedback[$i][7].", 
                                q5 = q5 + ".(int)$feedback[$i][8].", 
                                q6 = q6 + ".(int)$feedback[$i][9].", 
                                q7 = q7 + ".(int)$feedback[$i][10].", 
                                responses = responses + 1,
                                average = (q1+q2+q3+q4+q5+q6+q7)/7
                                where course_id = ".(int)$feedback[$i][3]." 
                                and faculty_id = ".(int)$feedback[$i][2]);
        if ($sql) {
            $success =  1;
        } else {
            $success =  0;
        }
    }
    if($success){
        $sql = mysqli_query($conn, 'update students set response = 1 where email = "'.$_SESSION['email'].'"');
        echo 1;
    }
    else{
        echo 0;
    }
    
}


function getforms($branch,$batch,$division)
{

    $formData = fetch_courses($branch, $batch, $division);
    // $formData = array(
    //     array('Teacher 1','Subject 1'),
    //     array('Teacher 2','Subject 2'),
    //     array('Teacher 3','Subject 3')
    // );

    $forms = '';
    $i = 0;
    for($i; $i < sizeof($formData); $i++)
    {
        $forms.='
        <form method="post" class="row mt-3" id="ratingForm'.($i+1).'"  autocomplete="off">
                    <div class="course-details mt-4">
                        <div>'.($i+1).'</div>
                        <div class="cid">'.$formData[$i][0].'</div>
                        <div class="cname">'.$formData[$i][1].'</div>
                        <div class="tid">'.$formData[$i][2].'</div>
                        <div class="tname">'.$formData[$i][3].'</div>
                    </div>
                    <div class="heading mt-3">
                        <h5></h5>
                        <h5>Poor</h5>
                        <h5>Satisfactory</h5>
                        <h5>Good</h5>
                        <h5>Very Good</h5>
                        <h5>Excellent</h5>
                    </div>
                    <div class="all-ratings">
                        <div class="ratings">
                            <div class="title">
                                Depth of knowledge <span>*</span>
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions1" id="inlineRadio1" value="1" required>
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions1" id="inlineRadio2" value="2">
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions1" id="inlineRadio3" value="3">
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions1" id="inlineRadio4" value="4">
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions1" id="inlineRadio5" value="5">
                            </div>
                        </div>
                        <div class="ratings">
                            <div class="title">
                                Way of presentation<span>*</span>
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions2" id="inlineRadio1" value="1" required>
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions2" id="inlineRadio2" value="2">
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions2" id="inlineRadio3" value="3">
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions2" id="inlineRadio4" value="4">
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions2" id="inlineRadio5" value="5">
                            </div>
                        </div>
                        <div class="ratings">
                            <div class="title">
                                Attitude / Behaviour<span>*</span>
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions3" id="inlineRadio1" value="1" required>
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions3" id="inlineRadio2" value="2">
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions3" id="inlineRadio3" value="3">
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions3" id="inlineRadio4" value="4">
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions3" id="inlineRadio5" value="5">
                            </div>
                        </div>
                        <div class="ratings">
                            <div class="title">
                                Lectures conducted with involvement<span>*</span>
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions4" id="inlineRadio1" value="1" required>
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions4" id="inlineRadio2" value="2">
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions4" id="inlineRadio3" value="3">
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions4" id="inlineRadio4" value="4">
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions4" id="inlineRadio5" value="5">
                            </div>
                        </div>
                        <div class="ratings">
                            <div class="title">
                                Syllabus covered<span>*</span>
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions5" id="inlineRadio1" value="1" required>
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions5" id="inlineRadio2" value="2">
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions5" id="inlineRadio3" value="3">
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions5" id="inlineRadio4" value="4">
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions5" id="inlineRadio5" value="5">
                            </div>
                        </div>
                        <div class="ratings">
                            <div class="title">
                                Innovative teaching techniques<span>*</span>
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions6" id="inlineRadio1" value="1" required>
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions6" id="inlineRadio2" value="2">
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions6" id="inlineRadio3" value="3">
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions6" id="inlineRadio4" value="4">
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions6" id="inlineRadio5" value="5">
                            </div>
                        </div>
                        <div class="ratings">
                            <div class="title">
                                Attractive and clean board writing<span>*</span>
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions7" id="inlineRadio1" value="1" required>
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions7" id="inlineRadio2" value="2">
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions7" id="inlineRadio3" value="3">
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions7" id="inlineRadio4" value="4">
                            </div>
                            <div class="rating form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RadioOptions7" id="inlineRadio5" value="5">
                            </div>
                        </div>
                        <div class="navigateBtn ">
                        ';
                        if($i != 0)
                        {
                        $forms.='                       
                            <button class=" btn btn-outline-primary btn-sm prev mt-5">Previous</button>'
                            ;
                        }
                        if($i == sizeof($formData)-1){
                            $forms.='<button class=" btn btn-outline-primary btn-sm submitForm mt-5">Submit</button>';
                            
                        }
                        else{
                        $forms.='<button class=" btn btn-outline-primary btn-sm next mt-5">Next</button>';
                        }
                    $forms.='</div>
                    </div>
                    <span class="pageNumber">'.($i+1).'/'.sizeof($formData).'</span>
                </form>

                ';
            }
            
            $forms.='
            <script>
            let formCounter = 1;
      
            $(".feedback .feedback-forms .next").click(function(e) {
                if($("#ratingForm"+formCounter+" input[name='."RadioOptions1".']").is(":checked") && $("#ratingForm"+formCounter+" input[name='."RadioOptions2".']").is(":checked") && $("#ratingForm"+formCounter+" input[name='."RadioOptions3".']").is(":checked") && $("#ratingForm"+formCounter+" input[name='."RadioOptions4".']").is(":checked") && $("#ratingForm"+formCounter+" input[name='."RadioOptions5".']").is(":checked") && $("#ratingForm"+formCounter+" input[name='."RadioOptions6".']").is(":checked") && $("#ratingForm"+formCounter+" input[name='."RadioOptions7".']").is(":checked")){
          
                    e.preventDefault();     
                    $("#ratingForm" + formCounter).addClass("d-none");
                    $("#ratingForm" + (++formCounter)).removeClass("d-none");
                }else{ 
                    alert("All questions are mandetory")    
                    $("#ratingForm" + formCounter).focus();
                    return;
                }
                
            })
        
            $(".feedback .feedback-forms .prev").click(function(e) {
                e.preventDefault();
                $("#ratingForm" + formCounter).addClass("d-none");
                $("#ratingForm" + (--formCounter)).removeClass("d-none");
            })
        
            $(".feedback .feedback-forms .submitForm").click(function(e) {
                if($("#ratingForm"+formCounter+" input[name='."RadioOptions1".']").is(":checked") && $("#ratingForm"+formCounter+" input[name='."RadioOptions2".']").is(":checked") && $("#ratingForm"+formCounter+" input[name='."RadioOptions3".']").is(":checked") && $("#ratingForm"+formCounter+" input[name='."RadioOptions4".']").is(":checked") && $("#ratingForm"+formCounter+" input[name='."RadioOptions5".']").is(":checked") && $("#ratingForm"+formCounter+" input[name='."RadioOptions6".']").is(":checked") && $("#ratingForm"+formCounter+" input[name='."RadioOptions7".']").is(":checked")){
          
                    e.preventDefault();
                    let feedback = [];
                    for(let j=1;j<='.$i.';j++){
                        console.log($("#ratingForm"+j))
                        console.log($("#ratingForm"+j+" .tname").text())
                        
                        let arr = [];
                        arr[0] = $("#ratingForm"+j+" .tname").text();
                        arr[1] = $("#ratingForm"+j+" .cname").text();
                        arr[2] = $("#ratingForm"+j+" .tid").text();
                        arr[3] = $("#ratingForm"+j+" .cid").text();
                        arr[4] = $("#ratingForm"+j+" input[name="+"RadioOptions1"+"]:checked").val();
                        arr[5] = $("#ratingForm"+j+" input[name="+"RadioOptions2"+"]:checked").val();
                        arr[6] = $("#ratingForm"+j+" input[name="+"RadioOptions3"+"]:checked").val();
                        arr[7] = $("#ratingForm"+j+" input[name="+"RadioOptions4"+"]:checked").val();
                        arr[8] = $("#ratingForm"+j+" input[name="+"RadioOptions5"+"]:checked").val();
                        arr[9] = $("#ratingForm"+j+" input[name="+"RadioOptions6"+"]:checked").val();
                        arr[10] = $("#ratingForm"+j+" input[name="+"RadioOptions7"+"]:checked").val();
                        feedback[j-1] = arr;
                    };

                    if(confirm("Confirm submit feedback ?"))
                    {
                        $.ajax({
                            type: "post",
                            url:"backend.php",
                            data:{"request":"feedback-data","feedback":feedback},
                            success:function(response){
                                console.log(response)
                                if(response)
                                {
                                    $("#feedback").addClass("d-none");
                                    $(".errorPage").html(`<div class="outer-box"><div class="inner-box"><h1>Feedback submitted successfully</h1><p>Your response has been recorded.</p></div></div>`);
                                }
                                else{
                                    alert("Oops something went wrong!! Try re-submitting the form.")
                                }
                            }
                        })
                    }
                }else{ 
                    alert("All questions are mandetory")    
                    $("#ratingForm" + formCounter).focus();
                    return;
                }
                
            })
    </script>/';
    $data = array("forms"=>$forms,"count"=>$i);
    return $data;
}
?>