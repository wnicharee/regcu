<?php
	include "session.php";
	$role = $_SESSION['user_role'];
   	if(!isset($_SESSION['user_role']) | $_SESSION['user_role'] != 'student' ){
      	header("Location: login.php");
   	}
?>

<!-- <html>
	
	<head>
		<title>ดูรายวิชาที่ลงทะเบียนเรียน</title>
		
		<link rel = "stylesheet" href = "form.css" >
		 <link rel= "stylesheet" href = "backbutton.css">
		 <link rel = "stylesheet" href= "sidebar.css">
		 <link rel = "stylesheet" href = "tablee.css">
	</head>
	<body style="background-image: url('https://images.pexels.com/photos/242236/pexels-photo-242236.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260');"> -->

		<?php 
		include 'templates\header.php';
		include 'splitleft.html'; ?>
		
		<div class = "splitright" style="background-image: none;">
		<?php include "backbuttonstudent.html"; ?>
		<div style="padding-left: 20px;">
		
		<h1 style = "font-size: 30px"> Show Enrolled Course </h1>
         <p align = "center"> ดูรายวิชาที่ลงทะเบียนเรียน เลือกปีการศึกษาและภาคเรียนที่ต้องการ </p>
      	</div>
      <div align = "center">
         <div class="form"  align = "left">
            <div class="formtitle"><b>select semester and year</b></div>
				
            <div style = "margin:30px; width: 300px;">
               
               <form action = "" method = "post" style="width: 400px;">
                  <label>YEAR  :</label>
                  <input type = "number" value="2017" min="2000" max="2018" name = "year" class = "box" /><br><br>
               
                  <label>SEMESTER  :</label>
                  <br>

                  &emsp;<input type = "radio" name = "semester" class = "box" value="1" /><label> ภาคต้น </label><br>
                  &emsp;<input type = "radio" name = "semester" class = "box" value="2" /><label> ภาคปลาย </label><br>
                  &emsp;<input type = "radio" name = "semester" class = "box" value="3" /><label> ภาคฤดูร้อน </label><br>
                  <input class="submitbutton" type = "submit" value = " Show "/><br /><br>
               </form>
              
					
            </div>
				
         </div>
			
      </div>
      
   

<?php
//showEnrolledCourse.php
	
	if(isset($_POST['semester']) and isset($_POST['year'])){
	$SEM = $_POST['semester'];
	$YEAR = $_POST['year'];
	$query = "SELECT S.cid, C.cname, C.credits, T.tname FROM section S, course C, teacher T, enroll E WHERE S.cid = E.cid and E.cid = C.cid  and E.sec_id = S.sec_id and T.tid = S.tid and S.sem = " .$SEM." and S.yearr = ".$YEAR. ' and E.sid = "' . $user_check . '";';
	$result = mysqli_query($db, $query);
	if(!$result){
		$error = "Error fetching";
		include 'error.html.php';
		exit();
	}
	
	include "showEnrolledCourse.html.php";

	}

?>
</div>
</body>
</html>