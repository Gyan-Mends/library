<?php
session_start();

//database connection
include("dbConnection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- ASSETS -->
    <!-- ASSETS -->
    <link rel="stylesheet" href="Assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="Assets/fonts/fonts.css">
    <link rel="stylesheet" href="daisyui.css">
    <script src="Assets/chart.min.js"></script>
    
</head>

<body class="bg-[#525289] overflow-x-hidden overflow-y-hidden" style="font-family:poppins;">
    <!-- side navigation bar -->
    <!-- side navigation bar -->
    <?php
    include("side_nav.php");
    ?>

    <div class="pt-3 pr-40">
    
        <div class="ml-[150px]  bg-[#525289] w-[88vw] h-[97vh] rounded-[20px] p-8">
            <!-- top navigation bar-->
            <!-- top navigation bar-->
            <div class="h-[60px] rounded-xl bg-[#1D2041] p-4 grid grid-cols-1 lg:grid-cols-2">
                <div>
                    <h2 class="text-xl text-white">BOOKLOVERS CORNER</h2>
                </div>
                <div class="ml-[430px] -mt-1 flex">
                    <img class="h-[40px] w-[40px] rounded-full" src="images/sony-ericsson-logo.jpg" alt="">
                    <P class="text-white ml-4 mt-2">
                        <?php
                        $admin_name = mysqli_query($connection, "SELECT * FROM libarian WHERE EMAIL='$_SESSION[email]'");
                        while ($row = mysqli_fetch_array($admin_name)) {
                            echo $row["NAME"];
                        }
                        ?>
                    </P>
                </div>
            </div>

            <div class="pt-10 grid grid-cols-1 lg:grid-cols-2 ">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <!-- libarians  overview -->
                    <!-- libarians  overview -->
                    <a href="libarians.php">
                        <div class="stat h-[120px] w-60  bg-[#1D2041] rounded-lg p-4">
                            <div class="stat-figure text-primary">
                                <svg xmlns="" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <div class="stat-title text-blue-50">Return Books</div>
                            <div class="stat-value text-primary"> <?php
                                                                    $sql = "SELECT COUNT(ID) FROM borrowed WHERE DUE_DATE<=CURDATE() && STATUS = 'Returned'";
                                                                    $query = mysqli_query($connection, $sql);
                                                                    $row = mysqli_fetch_array($query);
                                                                    echo $row[0];
                                                                    ?></div>
                            <div class="stat-desc">21% more than last month</div>
                        </div>
                    </a>
                    <!-- borrowed books overview -->
                    <!-- borrowed books overview -->
                    <a href="borrowed.php">
                        <div class="stat h-[120px] w-60  bg-[#1D2041] rounded-lg p-4">
                            <div class="stat-figure text-secondary">
                                <svg xmlns="" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div class="stat-title text-blue-50">Borrowed books</div>
                            <div class="stat-value text-secondary"> <?php
                                                                    $sql = "SELECT COUNT(ID) FROM borrowed WHERE DUE_DATE<=CURDATE() &&STATUS = 'Borrowed'";
                                                                    $query = mysqli_query($connection, $sql);
                                                                    $row = mysqli_fetch_array($query);
                                                                    echo $row[0];
                                                                    ?></div>
                            <div class="stat-desc">58% more than last month</div>
                        </div>

                    </a>
                </div>
                <!-- users overview -->
                <!-- users overview -->
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <a href="users.php">
                        <div class="stat h-[120px] w-60  bg-[#1D2041] rounded-lg p-4">
                            <div class="stat-figure text-[#2AD073]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                                </svg>
                            </div>
                            <div class="stat-title text-blue-50"> Users</div>
                            <div class="stat-value text-[#2AD073]"> <?php
                                                                    $sql = "SELECT COUNT(ID) FROM users";
                                                                    $query = mysqli_query($connection, $sql);
                                                                    $row = mysqli_fetch_array($query);
                                                                    echo $row[0];
                                                                    ?></div>
                            <div class="stat-desc">↗︎ 400 (22%)</div>
                        </div>
                    </a>

                    <!-- books overview -->
                    <!-- books overview -->
                    <a href="books.php">
                        <div class="stat h-[120px] w-60  bg-[#1D2041] rounded-lg p-4  ">
                            <div class="stat-figure text-primary">
                                <svg xmlns="" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                </svg>
                            </div>
                            <div class="stat-title text-blue-50">Books</div>
                            <div class="stat-value text-primary"><?php
                                                                    $sql = "SELECT COUNT(ID) FROM books";
                                                                    $query = mysqli_query($connection, $sql);
                                                                    $row = mysqli_fetch_array($query);
                                                                    echo $row[0];
                                                                    ?></div>
                            <div class="stat-desc">↘︎ 90 (14%)</div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 mt-20 gap-20">
                <!-- graph chart -->
                <!-- graph chart -->
                <div class="h-[300px] bg-[#1D2041] rounded-md">
                    <canvas id="myChart">

                    </canvas>
                </div>
                <div class="h-[300px] bg-[#1D2041] -ml-10 rounded-md px-10">
                    <div class="grid grid-cols-1 lg:grid-cols-3 ">
                        <!--notifications -->
                        <!--notifications -->
                        <div class="pt-4">
                            <a href="unreturned.php">
                                <div class="indicator  mt-4">
                                    <span class="indicator-item badge badge-secondary"><?php
                                                                    $sql = "SELECT COUNT(ID) FROM borrowed WHERE DUE_DATE<=CURDATE() && STATUS = 'Borrowed'";
                                                                    $query = mysqli_query($connection, $sql);
                                                                    $row = mysqli_fetch_array($query);
                                                                    echo $row[0];
                                                                    ?></span>
                                    <button class="btn hover:bg-primary bg-primary rounded-full text-white">Notifications</button>
                                </div>
                            </a>

                            <div class="h-14 w-[200px] rounded-lg  pt-3 -ml-6 mt-4 grid grid-cols-1 grid-cols-2 px-2">
                                <div class="h-8 w-8  rounded-full">
                                    <img class="h-8 w-8 rounded-full" src="images/tree-growing-from-open-book-vector-isolated-white_1284-41909.webp" alt="">
                                </div>
                                <div class="-ml-8">
                                   You have one new message
                                </div>
                               
                            </div>

                        </div>
                        <div class="h-[300px] w-[1px] ml-8 bg-secondary"></div>

                        <!-- radial progress -->
                        <!-- radial progress -->
                        <div>
                            <h3 class="text-blue-50">Our Perfomance</h3>
                            <div class="radial-progress text-[#2AD073] mt-6 -ml-20" style="--thickness: 2px; --value:95 ;--size:12rem; ">95%
                                <div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <script src="Assets/tailwind.js"></script>
        <!-- script for the graph-->
        <!-- script for the graph-->
        <script>
            // Define the data for the chart
            const data = {
                labels: ["January", "February", "March", "April", "May", "June", "July", "Augest", "September", "October", "Novemer", "December"],
                
                datasets: [{
                    label: "2022 Summery",
                    data: [80, 40, 70, 50, 65, 20, 70, 40, 30, 60, 40, 90],
                    borderColor: "#2AC46D",
                    backgroundColor: "#1D2041",
                    fill: true,
                    tension: 0.4,
                    borderJoinStyle: "round",
                    borderCapStyle: "round",
                }, ],
            };

            // Configure the options for the chart
            const options = {
                plugins: {
                    filler: {
                        propagate: true,
                    },
                },
            };

            // Create the chart
            const ctx = document.getElementById("myChart").getContext("2d");
            const chart = new Chart(ctx, {
                type: "line",
                data: data,
                options: options,
            });
        </script>
</body>

</html>