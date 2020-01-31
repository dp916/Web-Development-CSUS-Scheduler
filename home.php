<?php
session_start();
include 'dbConnect.php';
include 'log_config.php';
?>
<!DOCTYPE html>

<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<head>

    <style>
        body {
            margin: 0;
        }

        table, th, td {

            border: 1px solid black;

            border-collapse: collapse;

        }

        th, td {

            padding: 50px;

            text-align: left;

        }

        table#t1 {

            width: 100%;

        }

        table#t1 head {
            overflow-y: auto;
            overflow-x: hidden;
        }

        table#t1 th {

            background-color: black;

            color: white;

            padding: 5px;
            width: 200px;
            text-align: left;

        }

        table#t1 td {

            padding: 5px;
            text-align: left;
            width: 200px;

        }

        table#t1 tr:nth-child(even) {

            background-color: #eee;

        }

        table#t1 tr:nth-child(odd) {

            background-color: #fff;

        }

        .card {

            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);

            transition: 0.3s;

            width: 200px;
            padding-top: 60px;

            border-radius: 5px;

        }

        .card:hover {

            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);

        }

        img {
            border-radius: 5px 5px 0 0;
        }

        .flex-container {
            display: flex;
            height: 100%;
            padding-top: 60px;
            padding-bottom: 60px;
        }

        .flex-container > div {
            border: 50px;
            height: 100%;
            border-color: black;
        }

        .topnav .search-container {
            float: right;
        }

        .topnav input[type=text] {

            padding: 6px;

            margin-top: 8px;

            font-size: 17px;

            border: none;

        }

        .topnav .search-container button:hover {
            background: #ccc;
        }
        header{
            float: right;
            position: absolute;
            left: 0;
            right: 0;
            white-space: nowrap;
        }

    </style>

</head>

<body>

<script>

    /* When the user clicks on the button,

    toggle between hiding and showing the dropdown content */

    function myFunction() {

        document.getElementById("myDropdown").classList.toggle("show");

    }


    function filterFunction() {

        var input, filter, ul, li, a, i;

        input = document.getElementById("myInput");

        filter = input.value.toUpperCase();

        div = document.getElementById("myDropdown");

        a = div.getElementsByTagName("a");

        for (i = 0; i < a.length; i++) {

            if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {

                a[i].style.display = "";

            } else {

                a[i].style.display = "none";

            }

        }

    }

</script>

<header>

    <div class="topnav" style=" padding-top: 5px; padding-left:5px; overflow: hidden;">
        <div style="display:inline-block;" >
            <a class="active" href="http://athena.ecs.csus.edu/~deliver/home.php">Home</a>
        </div>

        <div style="display:inline-block;">
            <a href="http://athena.ecs.csus.edu/~deliver/calendar.php">Appointments</a>
        </div>

        <div style="display:inline-block;">
            <a href="http://www.csus.edu/acaf/calendars">Academic Calendar</a>
        </div>

        <div style="display:inline-block; ">
            <a href="https://www.ecs.csus.edu/index.php?content=keyfob">Request Key Fob</a>
        </div>

        <div style="display:inline-block; ">
            <a href="http://athena.ecs.csus.edu/~deliver/logout.php">Logout</a>
        </div>

        <div class="search-container" style="position:absolute; right:1px; top:10px">

            <form action="/action_page.php">

                <input type="text" placeholder="Search.." name="search">

                <button type="submit"><i class="fa fa-search"></i></button>

            </form>

        </div>

    </div>
</header>

<footer>
    <div class="navbar" style="padding-top: 5px; padding-left: 5px; overflow: hidden" ;>

        <div style="display:inline-block; ">
            <a href="#help" class="active">Advising Resources</a>
        </div>
        <div style="display:inline-block; ">
            <a href="http://www.ecs.csus.edu/wcm/ce/resources.html">Civil Engineering</a>
        </div>
        <div style="display:inline-block; ">
            <a href="http://www.ecs.csus.edu/wcm/cpe/cpe%20forms.html">Computer Engineering</a>
        </div>
        <div style="display:inline-block; ">
            <a href="http://www.ecs.csus.edu/wcm/csc/forms.html">Computer Science</a>
        </div>
        <div style="display:inline-block; ">
            <a href="http://catalog.csus.edu/academic-calendar/#fall2017text">Electrical Engineering</a>
        </div>
        <div style="display:inline-block; ">
            <a href="http://www.ecs.csus.edu/wcm/me/student%20resources.html">Mechanical Engineering</a>
        </div>

    </div>


</footer>
<div>




    <div class="flex-container" style="padding-top: 60px">

        <div style="width: 200px; height: 70%; padding-left:2px; ">

            <div class="card">

                <div class="container">

                    <h4><b>Rachel Garcia</b></h4>

                    <p>ECS Administrator</p>

                    <p>Username: rgarcia</p>

                    <p>Email: rgarcia@csus.edu</p>

                </div>
            </div>
        </div>

        <div>
            <div style="width: 100%; height: 50%; padding: 0px">
                <div style="background-color: #e4e0ce; width: 100%; height: 85%; text-align: center; ">

                    <?php

                    $temptime = new DateTime();
                    //gets current time
                    if (isset($_SESSION['time'])) {
                        $temptime = getFirstDayOfWeek($_SESSION['time']);
                        $_SESSION['time'] = $temptime->format("Y-m-d");
                    } else {
                        $temptime = new DateTime(firstDayOfWeek());
                        $_SESSION['time'] = $temptime->format("Y-m-d");
                    }
                    //DateTime date_create_from_format()
                    //sets time to 7am for current time
                    $startTime = new DateTime($temptime->format("Y-m-d") . '07:00:00');
                    //$startTime = new DateTime($startTime->format("Y-m-d H:i:s"));
                    //sets time to 7:59 for current time
                    $endTime = new DateTime($temptime->format("Y-m-d") . '07:59:00');
                    //$endTime = new DateTime($endTime->format("Y-m-d H:i:s"));
                    $startClone = clone $startTime;
                    $endClone = clone $endTime;
                    
                    //gets calendar name for selected advisor
                    //echo $_SESSION['calName']. "hello";
                    $calName = $_SESSION['calName'];
                    //echo $calName;
                    $getCalendar = "SELECT * FROM " . $calName;
                    
                    $query = mysqli_query($con, $getCalendar);
                    $username = $_SESSION['username'];
                    $advQuerry = mysqli_query($con, "SELECT * FROM advisors WHERE username='$username'");
                    $resultsAd = mysqli_fetch_array($advQuerry);
                    //echo $calName;
                    //change calendar
                    echo '<form action="setCal.php" method="post" style="padding-top: 10px;">';
                    echo '<select name="calName">';
                    echo '<option value="' . $calName . '">' . $resultsAd['l_name'] . ', ' . $resultsAd['f_name'] . '</option>';
                    foreach (mysqli_query($con, "SELECT * FROM advisors") as $item){
                        if($item['username'] != $usernameAd){
                            echo '<option value="' . $item['calendarname'] . '">' . $item['l_name'] . ', ' . $item['f_name'] . '</option>';
                        }
                    }
                    echo '</select>';
                    echo '<button type="submit" name="changecal" style"width: 200px; height: 40px; font-size: 12px;">View Calendar</button>';
                    echo '</form>';

                    if ($query == false) {
                        echo "Connection Error" . $usernameAd;
                        return;
                    }

                    //Week navigation
                    echo '<h1>' . $temptime->format("F Y") . '</h1>';
                    echo '<div class="w3-containter" style="display:inline-block; padding: 5px;">';
                    $previousWeek = previousWeek();
                    echo '<div style="display:inline-block; padding: 5px;>';
                    echo '<form method="post" action="home.php"><input type="button" value="Previous Week" style="width: 150px" class="w3-button w3-green w3-border w3-border-black" onclick="window.location.href=\'changeWeek.php?time=' .
                        $previousWeek . '\'"></form>';
                    echo '</div>';
                    $currentWeek = firstDayOfWeek();
                    echo '<div style="display:inline-block; padding: 5px;>';
                    echo '<form method="post" action="home.php"><input type="button" value="Current Week" style="width: 150px" class="w3-button w3-green w3-border w3-border-black" onclick="window.location.href=\'changeWeek.php?time=' .
                        $currentWeek . '\'"></form>';
                    echo '</div>';
                    $nextWeek = nextWeek();


                    echo '<div style="display:inline-block; padding: 5px;>';
                    echo '<form method="post" action="home.php"><input type="button" value="Next Week" style="width: 150px" class="w3-button w3-green w3-border w3-border-black" onclick="window.location.href=\'changeWeek.php?time=' .
                        $nextWeek . '\'"></form>';
                    echo '</div>';

                    echo '</div>';
                    echo '<table id="t1">';
                    echo '<head>';
                    $daysOfWeek = array('Time:', 'Sun', 'Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat');
                    $cloneTime = $temptime;
                    foreach ($daysOfWeek as $day) {
                        if ($day === 'Time:') {
                            echo '<th>' . $day . '</th>';
                        } else {
                            echo '<th>' . $day . '  ' . $cloneTime->format("m-d") . '</th>';
                            $cloneTime->add(new DateInterval('P1D'));
                        }
                    }

                    $meridiem = 'am';
                    $appHours = array(7, 8, 9, 10, 11, 12, 1, 2, 3, 4, 5, 6, 7);
                    for ($i = 0; $i < count($appHours); $i++) {
                        echo '<tr>';
                        if ($appHours[$i] == 12) {
                            $meridiem = 'pm';
                        }
                        echo '<td>' . $appHours[$i] . ' ' . $meridiem . '</td>';


                        for ($j = 0; $j < 7; $j++) {
                            echo '<td>';
                            foreach ($query as $item) {
                                $currentHour = new DateTime($item['appStart']);
                                if ($currentHour >= $startClone && ($currentHour < $endClone)) {
                                    $std_id = $item['std_id'];
                                    //echo $std_id;
                                    //echo $currentHour;
                                    $stdQuery = mysqli_query($con, "SELECT * FROM userprofile WHERE std_id = $std_id");
                                    if ($stdQuery == false) {
                                        echo "nothing found";
                                    }
                                    $stdResults = mysqli_fetch_assoc($stdQuery);
                                    //echo $item['type'];

                                    echo '<button type="button" onclick="alert(\'' . $stdResults['l_name'] . ', ' . $stdResults['f_name'] .
                                        '\n' . 'SacID:' . $stdResults['std_id'] . '\n' . 'Advising Type: ' . $item['type'] . '\n' .
                                        '\')">' . $currentHour->format("g:i A") . ' ' . $stdResults['l_name'] . '</button>';

                                }
                                //echo "start: " . $startClone->format("Y-m-d h:i") . "\n";
                                //echo "End: " . $endClone->format("Y-m-d h:i") . "\n";
                            }
                            echo '</td>';
                            $startClone->add(new DateInterval('P1D'));
                            $endClone->add(new DateInterval('P1D'));

                        }

                        echo '</tr>';
                        $startClone->add(new DateInterval('PT1H'));
                        $endClone->add(new DateInterval('PT1H'));
                        $startClone->sub(new DateInterval('P7D'));
                        $endClone->sub(new DateInterval('P7D'));
                    }
                    echo '</head>';
                    echo '</table>';
                    function nextWeek()
                    {
                        $currentWeek = $_SESSION['time'];
                        $time = new DateTime($currentWeek);
                        // number of day
                        $day = date('w');
                        $time->add(new DateInterval('P7D'));
                        return $time->format("Y-m-d");

                    }

                    function previousWeek()
                    {
                        $currentWeek = $_SESSION['time'];
                        $time = new DateTime($currentWeek);
                        // number of day
                        $day = date('w');
                        $time->sub(new DateInterval('P7D'));
                        return $time->format("Y-m-d");

                    }

                    //gets first day of current week. Starts on Sunday
                    function firstDayOfWeek()
                    {
                        $currentWeek = new DateTime();
                        $curDate = date_format($currentWeek, "Y-m-d");
                        $time = new DateTime($curDate);
                        //echo $time->format("Y-m-d") . "\n";
                        // number of day
                        $day = date('w');
                        $time->sub(new DateInterval('P' . $day . 'D'));
                        return $time->format("Y-m-d");
                    }

                    //gets first day of given week. Starts on sunday
                    function getFirstDayOfWeek($x)
                    {
                        $time = new DateTime($x);
                        $day = date_format($time, 'w');
                        $time->sub(new DateInterval('P' . $day . 'D'));
                        return $time;
                    }

                    ?>

                </div>
            </div>
        </div>

</body>


</html>

