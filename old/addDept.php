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
                $sql = "INSERT INTO departmenttable(deptNum, deptName, manager) VALUES(" . $_POST["deptNum"] . ",'" . $_POST["deptName"] . "'," . $_POST["manager"] . ")";
                if ($con->query($sql) === TRUE){
                    echo "Did it!";
                } else {
                    echo $con->error . "<br><br>" . $sql . "<br>";
                }
            }
            ?>
        <div id = 'addstuff'>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <fieldset><legend>Employee info</legend>
                  Department Number: <input type="text" name="deptNum" value=""><br><br>
                  Department Name: <input type="text" name="deptName" value=""><br><br>
                  Manager:<select name = 'manager'>
                <?php
                $sql = "SELECT Fname, Lname, ssn FROM employeetable;";
                $result = $con->query($sql);
                while ($row = $result->fetch_assoc()){
                        echo "<option value = '" . $row["ssn"] . "'>" . $row["Fname"] . " " . $row["Lname"] . "</option>";
                    }
                ?>
                  </select><br><br>
                  <input type="submit" name="submit" value="Submit">
              </fieldset>
            </form>
            <?php
            ?>
        </div>
        <a href = "index.php">Back</a>
    </body>
</html>
