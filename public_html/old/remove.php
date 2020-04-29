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
            $uname = 	"id11798007_root";
            $password = 	"csc471";
            $database = 	"id11798007_companydb";
            
            $con = mysqli_connect($sname, $uname, $password, $database);
            if (!$con) {
            	die("failed to connect: " . mysqli_connect_error());
            }
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($_POST["selTable"] == "departmenttable"){
                    $sql = "DELETE FROM departmenttable WHERE deptNum=" . $_POST["key"];
                    if ($con->query($sql) === TRUE){
                        echo "Did it!";
                    } else {
                        echo $con->error . "<br><br>" . $sql . "<br>";
                    }
                } else if ($_POST["selTable"] == "employeetable"){
                    $sql = "DELETE FROM employeetable WHERE ssn=" . $_POST["key"];
                    if ($con->query($sql) === TRUE){
                        echo "Did it!";
                    } else {
                        echo $con->error . "<br><br>" . $sql . "<br>";
                    }
                } else if ($_POST["selTable"] == "projecttable"){
                    $sql = "DELETE FROM projecttable WHERE projNum=" . $_POST["key"];
                    if ($con->query($sql) === TRUE){
                        echo "Did it!";
                    } else {
                        echo $con->error . "<br><br>" . $sql . "<br>";
                    }
                }
            }
            ?>
        <div id = 'addstuff'>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <fieldset><legend>Employee info</legend>
    	        Table: 
    	        <select id = "selTable" name = "selTable" onChange = "">
    	            <option value = "employeetable">Employees</option>
    	            <option value = "departmenttable">Departments</option>
    	            <option value = "projecttable">Projects</option>
    	        </select><br><br>
                  Key (ssn for employee, number for project or department): <input type="text" name="key" value=""><br><br>
                  <input type="submit" name="submit" value="Submit">
              </fieldset>
            </form>
            <?php
                
            ?>
        </div>
        <a href = "index.php">Back</a>
    </body>
</html>