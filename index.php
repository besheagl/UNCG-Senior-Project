<!DOCTYPE html>
<!--Ian Baxter-->

<html lang="en">
	<head>
		<meta charset ="utf-8"/>
		<meta http-equiv="x-ua-compatible" content="ie=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
	</head>
	<body>
	    <?php
            $sname = 	"localhost";
            $uname = 	"id12568920_armchairadmin";
            $password = 	"Csc218armchaiR";
            $database = 	"id12568920_armchair";
            
            $con = mysqli_connect($sname, $uname, $password, $database);
            if (!$con) {
            	die("failed to connect: " . mysqli_connect_error());
            }?>
	    <div id = "top"><form action = "#"  id = "topForm">
	        Table: 
	        <select id = "selTable" onChange = "changeTable(this.value);">
	            <option value = "employeetable">Employees</option>
	            <option value = "departmenttable">Departments</option>
	            <option value = "projecttable">Projects</option>
	        </select>
	        </form>
            <script type="text/JavaScript">
                function changeTable(inval) {
                    if (inval == "employeetable"){
                        document.getElementById("mainTable").innerHTML = "<?php viewEmps($con, $sort); ?>";
                    } else if (inval == "departmenttable") {
                        document.getElementById("mainTable").innerHTML = "<?php viewDepts($con, $sort); ?>";
                    } else {
                        document.getElementById("mainTable").innerHTML = "<?php viewProjs($con, $sort); ?>";
                    }
                }
            </script>
        </div>
	    
	    
	    
	    <div id = "mainTable">
    	    <?php
            
            function viewEmps($con, $s) {
                $retval = array();
                $sqlstr = "select * from employeetable";
                $result = $con->query($sqlstr);
                
                if ($result->num_rows > 0){
                    $fields = array("ssn", "First Name", "Middle Init", "Last Name");
                    while ($row = $result->fetch_assoc()){
                        $record = array();
                        array_push($record, $row["ssn"], $row["Fname"], $row["Minit"], $row["Lname"]);
                        array_push($retval, $record);
                    }
                }
                makeTable($retval, $s, $fields);
                return $retval;
            }
            
            function viewDepts($con, $s) {
                $retval = array();
                $sqlstr = "select * from departmenttable";
                $result = $con->query($sqlstr);
                
                if ($result->num_rows > 0){
                    $fields = array("Num", "Department", "Manager");
                    while ($row = $result->fetch_assoc()){
                        $record = array();
                        array_push($record, $row["deptNum"], $row["deptName"], $row["manager"]);
                        array_push($retval, $record);
                    }
                }
                makeTable($retval, $s, $fields);
                return $retval;
            }
            
            function viewProjs($con, $s) {
                $retval = array();
                $sqlstr = "select * from projecttable";
                $result = $con->query($sqlstr);
                
                if ($result->num_rows > 0){
                    $fields = array("Num", "Project", "Description");
                    while ($row = $result->fetch_assoc()){
                        $record = array();
                        array_push($record, $row["projNum"], $row["projName"], $row["projDesc"]);
                        array_push($retval, $record);
                    }
                }
                makeTable($retval, $s, $fields);
                return $retval;
            }
            
            function makeTable($input, $s, $f) {
                array_multisort(array_column($input, $s), SORT_ASC, $input);
                
                echo "<table><tr>";
                for ($h = 0; $h < count($f); $h++){
                        echo "<td>" . $f[$h] . "</td>";
                }
                echo "</tr>";
                for ($i = 0; $i < count($input); $i++){
                    echo "<tr>";
                    for ($j = 0; $j < count($input[$i]); $j++){
                        echo "<td style = 'border:1px solid black; margin:0px; padding:0px;'>" . $input[$i][$j] . "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
                /*
                echo "<br>Sort: <select id = 'sortTable' onChange = 'sortTable(this.value);'>";
    	        for ($i = 0; $i < count($f); $i++){
    	            echo "<option value = " . $i . ">" . $f[$i] . "</option>";
    	        }
    	        echo "</select><br><br>";
    	        */
            }
            
            function dummy() {
                echo "ur dum";
            }
            
            viewEmps($con, $sort);
            ?>
        </div>
        <a href = "addEmp.php">Add Employee</a><br>
        <a href = "addDept.php">Add Department</a><br>
        <a href = "addProj.php">Add Project</a><br>
        <a href = "remove.php">Remove Records</a><br>
	</body>
</html>