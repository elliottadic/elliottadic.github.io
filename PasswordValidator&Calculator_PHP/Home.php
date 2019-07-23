<?php ob_start(); ?><!DOCTYPE html>
<!--
The home page will prompt users for a students name, number, and subject grades.
The page will determine if the value of the input is set and check its validity 
against conditions. Once input is considered valid, a calculation will run to
determine the students final grade based on the average of his/her subjects.
The page will display all student information at the bottom of the page.

Created By: Elliot Tadic 



-->

<html>
    <head>
        <meta charset="UTF-8">
        <title>Calculator</title>
        <link rel="stylesheet" href="css/home.css">
    </head>
    <body>
        <?php
        $studentName = ""; //Global variable used in multiple methods carrying student name
        $studentNumber = "";//Global variable used in multiple methods carrying student number
        $g1 = ""; //Global variable used in multiple methods carrying grade for subject1
        $g2 = "";//Global variable used in multiple methods carrying grade for subject2
        $g3 = "";//Global variable used in multiple methods carrying grade for subject3
        $g4 = "";//Global variable used in multiple methods carrying grade for subject4
        $g5 = "";//Global variable used in multiple methods carrying grade for subject5
        $errName = "";//Global variable used in multiple methods carrying an error message for student name
        $errNumber = "";//Global variable used in multiple methods carrying an error message for student number
        $errg1 = "";//Global variable used in multiple methods carrying an error message for Subject1
        $errg2 = "";//Global variable used in multiple methods carrying an error message for Subject2
        $errg3 = "";//Global variable used in multiple methods carrying an error message for Subject3
        $errg4 = "";//Global variable used in multiple methods carrying an error message for Subject4
        $errg5 = "";//Global variable used in multiple methods carrying an error message for Subject5
        $totalGrade = "";//Global variable used on page load and calculateGrade() holding the average of the students marks
        $response = "";//Global variable used on page load and calculateGrade() for displaying student inormation at bottom of page

        
        //Function validateUserInput() makes sure that fields are not left empty, and sets variables accordingly 
      
        function validateUserInput() {

            global $studentName;
            global $studentNumber;
            global $g1;
            global $g2;
            global $g3;
            global $g4;
            global $g5;
            global $errName;
            global $errNumber;
            global $errg1;
            global $errg2;
            global $errg3;
            global $errg4;
            global $errg5;


            if ($_SERVER["REQUEST_METHOD"] == "POST") {



                if (empty($_POST["name"])) {
                    $errName = "Field cannot be empty";
                } else if (isset($_POST["name"])) {
                    $studentName = $_POST["name"];
                } 

                if (empty($_POST["number"]) && !strlen($_POST["number"])) {
                    $errNumber = "Field cannot be empty";
                } else if ((isset($_POST["number"])) || strlen($_POST["number"])) {
                    $studentNumber = $_POST["number"];
                }

                if (empty($_POST["grade1"]) && !strlen($_POST["grade1"])) {
                    $errg1 = "Field cannot be empty";
                } else if ((isset($_POST["grade1"])) || strlen($_POST["grade1"])) {
                    $g1 = $_POST["grade1"];
                }

                if (empty($_POST["grade2"]) && !strlen($_POST["grade2"])) {
                    $errg2 = "Field cannot be empty";
                } else if ((isset($_POST["grade2"])) || strlen($_POST["grade2"])) {
                    $g2 = $_POST["grade2"];
                }

                if (empty($_POST["grade3"]) && !strlen($_POST["grade3"])) {
                    $errg3 = "Field cannot be empty";
                } else if ((isset($_POST["grade3"])) || strlen($_POST["grade3"])) {
                    $g3 = $_POST["grade3"];
                }

                if (empty($_POST["grade4"]) && !strlen($_POST["grade4"])) {
                    $errg4 = "Field cannot be empty";
                } else if ((isset($_POST["grade4"])) || strlen($_POST["grade4"])) {
                    $g4 = $_POST["grade4"];
                }

                if (empty($_POST["grade5"]) && !strlen($_POST["grade5"])) {
                    $errg5 = "Field cannot be empty";
                } else if ((isset($_POST["grade5"])) || strlen($_POST["grade5"])) {
                    $g5 = $_POST["grade5"];
                }
            }
        }

        validateUserInput();

        
        //Function validateisNaN() Determines whether input is a number or text and sets error messages accordingly
        
        function validateisNaN() {
            global $g1;
            global $g2;
            global $g3;
            global $g4;
            global $g5;
            global $errg1;
            global $errg2;
            global $errg3;
            global $errg4;
            global $errg5;
            global $studentNumber;
            global $errNumber;


            if ($g1 !== "") {
                if ((ctype_digit($g1) == true) && ($g1 >= 0) && ($g1 <= 100)) {

                    $g1 = $g1;
                } else {
                    $g1 = "";
                    $errg1 = "Must be a number (0-100)";
                }
            }
            if ($g2 !== "") {
                if ((ctype_digit($g2) == true) && ($g2 >= 0) && ($g2 <= 100)) {

                    $g2 = $g2;
                } else {
                    $g2 = "";
                    $errg2 = "Must be a number (0-100)";
                }
            }
            if ($g3 !== "") {
                if ((ctype_digit($g3) == true) && ($g3 >= 0) && ($g3 <= 100)) {

                    $g3 = $g3;
                } else {
                    $g3 = "";
                    $errg3 = "Must be a number (0-100)";
                }
            }
            if ($g4 !== "") {
                if ((ctype_digit($g4) == true) && ($g4 >= 0) && ($g4 <= 100)) {

                    $g4 = $g4;
                } else {
                    $g4 = "";
                    $errg4 = "Must be a number (0-100)";
                }
            }
            if ($g5 !== "") {
                if ((ctype_digit($g5) == true) && ($g5 >= 0) && ($g5 <= 100)) {

                    $g5 = $g5;
                } else {
                    $g5 = "";
                    $errg5 = "Must be a number (0-100)";
                }
            }

            if ($studentNumber !== "") {
                if (ctype_digit($studentNumber) == true) {

                    $studentNumber = $studentNumber;
                } else {
                    $studentNumber = "";
                    $errNumber = "Must be a number";
                }
            }
        }

        validateisNaN();

        
        //Function calculateGrade() uses the subject grades to produce a final grade
        
        function calculateGrade() {
            global $g1;
            global $g2;
            global $g3;
            global $g4;
            global $g5;
            global $totalGrade;
            global $response;
            global $studentName;
            global $studentNumber;


            $totalGrade = ($g1 + $g2 + $g3 + $g4 + $g5) / 5;

            if (90 <= $totalGrade) {
                $totalGrade = "A";
            } else if ((70 <= $totalGrade) && ($totalGrade < 90)) {
                $totalGrade = "B";
            } else if ((55 <= $totalGrade) && ($totalGrade < 70)) {
                $totalGrade = "C";
            } else if ((40 <= $totalGrade) && ($totalGrade < 55)) {
                $totalGrade = "D";
            } else if ((40 > $totalGrade)) {

                $totalGrade = "F";
            }


            $response = "<table> <tr> <td>Student Name: </td> <td>Student Number: </td> <td>Final Grade: </td> </tr> <tr><td> $studentName</td><td> $studentNumber</td><td> $totalGrade</td></tr></table> ";
        }

        if (($studentName != "") && ($studentNumber != "") && ($g1 != "") && ($g2 != "") && ($g3 != "") && ($g4 != "") && ($g5 != "")) {
            calculateGrade();
        }
        ?>
        <div class="title"><h1>Student Grade Calculator</h1><br></div>

        <div class="container">




            <div class="containerForm">
                <h2>Student Information</h2>
                <form name="studentInfo" method="POST" action="<?php $_SERVER["PHP_SELF"] ?>">
                    <table>
                        <tr>
                            <td><p>Student Name</p></td>
                            <td> <input type="text" name="name" placeholder="Student Name" ><br>
                                <span class="error"><?php echo $errName; ?></span> </td>
                        </tr>

                        <tr>
                            <td><p>Student Number</p></td>
                            <td><input type="text" name="number" placeholder="Student Number" ><br>
                                <span class="error"><?php echo $errNumber; ?></span> </td>
                        </tr>

                        <tr>
                            <td><p>Grade / Subject 1</p></td>
                            <td> <input type="text" name="grade1" placeholder="Between 0 and 100" ><br>
                                <span class="error"><?php echo $errg1; ?></span> </td>
                        </tr>

                        <tr>
                            <td> <p>Grade / Subject 2</p></td>
                            <td><input type="text" name="grade2" placeholder="Between 0 and 100" ><br>
                                <span class="error"><?php echo $errg2; ?></span> </td>
                        </tr>

                        <tr>
                            <td><p>Grade / Subject 3</p></td>
                            <td><input type="text" name="grade3" placeholder="Between 0 and 100" ><br>
                                <span class="error"><?php echo $errg3; ?></span> </td>
                        </tr>

                        <tr>
                            <td> <p>Grade / Subject 4</p></td>
                            <td><input type="text" name="grade4" placeholder="Between 0 and 100" ><br>
                                <span class="error"><?php echo $errg4; ?></span> </td>
                        </tr>

                        <tr>
                            <td><p>Grade / Subject 5</p></td>
                            <td><input type="text" name="grade5" placeholder="Between 0 and 100" ><br>
                                <span class="error"><?php echo $errg5; ?></span> </td>
                        </tr>
                    </table>
                    <input type="Submit" Value ="Submit">
                    <h2> Result </h2>
                </form>

                <div class="info">



                <p><?php echo $response ?></p>

                </div>



            </div>



    </body>
</html>
<?php ob_flush(); ?>