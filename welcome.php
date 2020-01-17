<?php

#starts a new session

include "./engine/connection.php";

session_start();

if(!isset($_SESSION["email"])){
    header("location: ../../index.php");
}

if(isset($_SESSION["employeeID"]) && isset($_SESSION["email"]) && isset($_SESSION["f_name"]) && isset($_SESSION["l_name"])){
    $empid = $_SESSION['employeeID'];
    $mail = $_SESSION['email'];
    $name = $_SESSION['f_name'];
    $surname = $_SESSION['l_name'];
}
//$empid=$row['employeeID'];


$date=date_default_timezone_set("South Africa/Johannesburg");
//$date=date('Y-m-d');

$sql=("SELECT OATPosts.post_date,OATPosts.messages,OATPosts.title,Employees.email 
FROM OATPosts 
INNER JOIN Employees ON OATPosts.employeeID = Employees.employeeID 
ORDER BY post_date DESC");
$stmt = sqlsrv_query( $conn, $sql );

//$rst = array();
$smg = array();
$title= array();
$time= array();
$date= array();
$email= array();
//echo "<span style ='margin-bottom:55px;font-size: 17px;'>" . $row['message'].'</span><br>';
while($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))
    {
        
        $smg[] =  $row['messages'];
        $title[]= $row['title'];
        $time[]= date_format($row['post_date'], 'H:i:s ');
        $date[]= date_format($row['post_date'], 'Y-m-d ');
        $email[]=  $row['email'];
        
        //$rst[] = $row['email'], $row['message'], $row['tittle'], date_format($row['post_date'], 'Y-m-d '), date_format($row['post_date'], 'H:i:s ');
    }


  sqlsrv_close($conn);

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/src/css/Calender.css">


        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/src/css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <link rel="stylesheet" href="/src/css/Custom.css">
        <script src="/src/js/bootstrap/bootstrap.min.js"></script>
        <script src="/src/js/Calender.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


        <title>Welcome</title>

    </head>

    <body class="container contain">
        <?php include("header.php") ?>
    </body>

    <body class="container">
        <!--Heading-->
        <div class="container pt-2">
            <div style="margin-top: 55px;">
                <div class="text-white" style="border-radius: 20px; background: linear-gradient(rgba(0, 0, 0, 0.799), rgba(0, 0, 0, 0.799));">
                    <div style="margin-top: auto;">
                        <h1 class="title text-center"><strong>Welcome Page</strong></h1>
                    </div>
                </div>
            </div>
        </div>

        <main class="main pt-1" role="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                         <!-- /.card -->
                         <article class="card mb-4 text-white" style="border-radius: 20px; background: linear-gradient(rgba(0, 0, 0, 0.799), rgba(0, 0, 0, 0.799));">
                            <header class="card-header" style="border-radius: 20px; background: linear-gradient(rgba(0, 0, 0, 0.799), rgba(0, 0, 0, 0.799));">
                                <div class="card-meta">
                                    <span style="float: left;">
                                        <img class="rounded-circle smaller-img" src="/src/img/david-beckham-lede.jpg" alt="Profile Picture">
                                    
                                    </span>
                                    <strong style="padding-left: 20px; top: -100px;"><?php echo $email[0] ?></strong>
                                    <span style="float: right;">
                                        <h3><strong><?php echo $title[0] ?></strong></h3>
                                        <strong>Posted on</strong>&nbsp;&nbsp;
                                        <?php echo $date[0] ?>&nbsp;&nbsp;<strong>at</strong>&nbsp;&nbsp;<?php echo $time[0] ?>
                                    </span>
                                </div>
                            </header>
                            <div class="card-body" style="float: right;">
                                <?php echo $smg[0] ?>
                            </div>
                        </article>
               
                        <!-- /.card -->
                        <article class="card mb-4 text-white" style="border-radius: 20px; background: linear-gradient(rgba(0, 0, 0, 0.799), rgba(0, 0, 0, 0.799));">
                            <header class="card-header" style="border-radius: 20px; background: linear-gradient(rgba(0, 0, 0, 0.799), rgba(0, 0, 0, 0.799));">
                                <div class="card-meta">
                                    <span style="float: left;">
                                        <img class="rounded-circle smaller-img" src="/src/img/david-beckham-lede.jpg" alt="Profile Picture">
                                    
                                    </span>
                                    <strong style="padding-left: 20px; top: -100px;"><?php echo $email[1] ?></strong>
                                    <span style="float: right;">
                                        <h3><strong><?php echo $title[1] ?></strong></h3>
                                        <strong>Posted on</strong>&nbsp;&nbsp;
                                        <?php echo $date[1] ?>&nbsp;&nbsp;<strong>at</strong>&nbsp;&nbsp;<?php echo $time[1] ?>
                                    </span>
                                </div>
                            </header>
                            <div class="card-body" style="float: right;">
                                <?php echo $smg[1] ?>
                            </div>
                        </article>
                        <!-- /.card -->
                        <article class="card mb-4 text-white" style="border-radius: 20px; background: linear-gradient(rgba(0, 0, 0, 0.799), rgba(0, 0, 0, 0.799));">
                            <header class="card-header" style="border-radius: 20px; background: linear-gradient(rgba(0, 0, 0, 0.799), rgba(0, 0, 0, 0.799));">
                                <div class="card-meta">
                                    <span style="float: left;">
                                        <img class="rounded-circle smaller-img" src="/src/img/david-beckham-lede.jpg" alt="Profile Picture">
                                    </span>
                                    <strong style="padding-left: 20px; top: -100px;"><?php echo $email[2] ?></strong>
                                    <span style="float: right;">
                                        <h3><strong><?php echo $title[2] ?></strong></h3>
                                        <strong>Posted on</strong>&nbsp;&nbsp;
                                        <?php echo $date[2] ?>&nbsp;&nbsp;<strong>at</strong>&nbsp;&nbsp;<?php echo $time[2] ?>
                                    </span>
                                </div>
                            </header>
                            <div class="card-body" style="float: right;">
                                <?php echo $smg[2] ?>
                            </div>
                        </article>
                        <article class="card mb-4 text-white" style="border-radius: 20px; background: linear-gradient(rgba(0, 0, 0, 0.799), rgba(0, 0, 0, 0.799));">
                            <header class="card-header" style="border-radius: 20px; background: linear-gradient(rgba(0, 0, 0, 0.799), rgba(0, 0, 0, 0.799));">
                                <div class="card-meta">
                                    <span style="float: left;">
                                        <img class="rounded-circle smaller-img" src="/src/img/david-beckham-lede.jpg" alt="Profile Picture">
                                    
                                    </span>
                                    <strong style="padding-left: 20px; top: -100px;"><?php echo $email[3] ?></strong>
                                    <span style="float: right;">
                                        <h3><strong><?php echo $title[3] ?></strong></h3>
                                        <strong>Posted on</strong>&nbsp;&nbsp;
                                        <?php echo $date[3] ?>&nbsp;&nbsp;<strong>at</strong>&nbsp;&nbsp;<?php echo $time[3] ?>
                                    </span>
                                </div>
                            </header>
                            <div class="card-body" style="float: right;">
                                <?php echo $smg[3] ?>
                            </div>
                        </article>
                        <!-- /.card -->
                        <article class="card mb-4 text-white" style="border-radius: 20px; background: linear-gradient(rgba(0, 0, 0, 0.799), rgba(0, 0, 0, 0.799));">
                            <header class="card-header" style="border-radius: 20px; background: linear-gradient(rgba(0, 0, 0, 0.799), rgba(0, 0, 0, 0.799));">
                                <div class="card-meta">
                                    <span style="float: left;">
                                        <img class="rounded-circle smaller-img" src="/src/img/david-beckham-lede.jpg" alt="Profile Picture">
                                    
                                    </span>
                                    <strong style="padding-left: 20px; top: -100px;"><?php echo $email[4] ?></strong>
                                    <span style="float: right;">
                                        <h3><strong><?php echo $title[4] ?></strong></h3>
                                        <strong>Posted on</strong>&nbsp;&nbsp;
                                        <?php echo $date[4] ?>&nbsp;&nbsp;<strong>at</strong>&nbsp;&nbsp;<?php echo $time[4] ?>
                                    </span>
                                </div>
                            </header>
                            <div class="card-body" style="float: right;">
                                <?php echo $smg[4] ?>
                            </div>
                        </article>
                        <!-- /.card -->
                    </div>

                    <!--Side Cards-->
                    <div class="col-md-3 ml-auto">
                        <aside class="sidebar">
                            <div class="card mb-4 text-white text-center" style="border-radius:20px; background: linear-gradient(rgba(0, 0, 0, 0.799), rgba(0, 0, 0, 0.799));">
                                <div class="card-header">
                                    <h1 class="card-text" style="margin-bottom: -35px;">Calender</h1>
                                </div>
                                <div class="card-body">
                                    <div class="calendar-wrapper" style="align-content: auto;">
                                        <button id="btnPrev" type="button">Prev</button>
                                        <button id="btnNow" type="button">Now</button>
                                        <button id="btnNext" type="button">Next</button>
                                        <div id="divCal"></div>
                                    </div>
                                </div>
                            </div>

                        </aside>

                        <aside class="sidebar sidebar-sticky">
                            <!-- /.card -->
                            <div class="card mb-4 text-white text-center" style="border-radius:20px; background: linear-gradient(rgba(0, 0, 0, 0.799), rgba(0, 0, 0, 0.799));">
                                <div class="card-body">
                                    <h1 class="card-title">Special days of this month</h1>
                                </div>
                            </div>
                            <!-- /.card -->
                            <div class="card mb-4 text-white text-center" style="border-radius:20px; background: linear-gradient(rgba(0, 0, 0, 0.799), rgba(0, 0, 0, 0.799));">
                                <div class="card-body">
                                    <h1>Things to do today</h1>
                                </div>
                            </div>
                            <!-- /.card -->
                        </aside>
                    </div>

                </div>
            </div>
        </main>

        <script>
            var today = new Date();
            document.getElementById("today").innerHTML = today;
        </script>
        <script src="/Welcome/src/js/Calender.js"></script>

    </body>
    <?php include("footer.php") ?>

    </html>