<!-- 
    PHP Find the working day of the Employee 
    Holiday Included :  
    1. Sunday
    2. Half Saturday
    3. 7th January
    4. 13th, 14th, 15th April
    5. 1st May
    6. 14th May
    7. 29th October
    8. 9th November
 -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="year">Enter Year : </label>
        <input type="text" name="year" id="year">
        <button type="submit">submit</button>
    </form>
    <?php

    function formHandle() {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $year = filter_input(INPUT_POST, "year", FILTER_SANITIZE_NUMBER_INT);
            if(!empty($year)){
                $Holiday = count_working_days($year);
                echo "<br><br><br><br>Year : " . $Holiday['year'] . "<br>";
                echo "Days in one year : " . $Holiday['days in one year'] . "<br>";
                echo "Work Days : " . $Holiday['Work Days'] . "<br>";
                echo "Saturday : " . $Holiday['Saturday'] . "<br>";
                echo "Sunday : " . $Holiday['Sunday'] . "<br>";
                echo "<br><br><br><br>";
                foreach ($Holiday['Saturday Date'] as $Sat) {
                    echo $Sat . "<br>";
                }
            }
            else {
                echo "<br><br><br><br>INVALID INPUT";
            }
        }
    }
    formHandle();

    function count_working_days($year) {

        $Holiday = ['7 january', '13 April', '14 April', '15 April', '1 May', '14 May', '29 October', '9 November'];

        $Sdate = "{$year}/01/01/";

        $numberOfDays = ($year % 4 === 0 && $year % 100 > 0) || $year % 400 == 0 ? 366 : 365;

        $countSaturday  = 0;
        $countSunday = 0;

        $dateSat = [];
        $dateSun = [];

        for ($i = 0; $i < $numberOfDays + 1; $i++) {
            $temp = date('Y-m-d', strtotime('+' . $i . ' day', strtotime($Sdate)));
            $temp2 = date('l', strtotime($temp));

            if (($temp2 == 'Saturday')) {
                $countSaturday++;
                array_push($dateSat, date('l d m Y', strtotime($temp)));
            } elseif ($temp2 == 'Sunday') {
                $countSunday++;
                array_push($dateSun, date('l d m Y', strtotime($temp)));
            }
        }

        $List = [
            'year' => $year,
            'days in one year' => $numberOfDays,
            'Saturday' => $countSaturday,
            'Sunday' => $countSunday,
            'Saturday Date' => $dateSat,
            'Sunday Date' => $dateSun,
            'Holiday' => $Holiday,
            'Work Days' => ($numberOfDays - ($countSaturday + $countSunday + count($Holiday)))
        ];

        return ($List);
    }
    
    ?>
</body>

</html>