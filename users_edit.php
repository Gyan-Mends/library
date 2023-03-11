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
</head>

<body class="bg-[#525289] overflow-x-hidden overflow-y-hidden" style="font-family:poppins;">
    <!-- side navigation bar -->
    <!-- side navigation bar -->
    <?php
    include("side_nav.php");
    ?>

    <div class="pt-3 ">
        <div class="ml-[150px]  bg-[#525289] h-[97vh] rounded-[20px] p-8">
            <!-- top navigation bar -->
            <!-- top navigation bar -->
            <div class="h-[60px] rounded-xl bg-[#1D2041] p-4 grid grid-cols-1 lg:grid-cols-3">
                <div class="flex">
                    <h2 class="text-xl text-white">Users Management</h2>
                    <button class="bg-[#2AD073] h-8 w-8 rounded-sm ml-3 text-white"><i onclick="show()" class="fa fa-plus"></i></button>
                </div>

                <div class=" -mt-1 flex">
                    <form action="" method="post">
                        <input type="search" class="h-9 w-60 rounded-md outline-none p-2" placeholder="Search by book name" id="myInput" onkeyup="mySearch()">
                    </form>
                </div>

                <div class="ml-60 -mt-1 flex">
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

            <!--table -->
            <!--table -->
            <div class="mt-10  flex items-center justify-center">
                <table id="myTable">
                    <thead class=" bg-[#1D2041]  text-blue-100   h-9 ">
                        <tr class="text-center text-[14px]">
                            <th class="pr-[55px] ">ID</th>
                            <th class="pr-[55px]">FIRST NAME</th>
                            <th class="pr-[55px]"> LAST NAME</th>
                            <th class="pr-[55px]">ADDRESS</th>
                            <th class="pr-[55px]">PHONE</th>
                            <th class="pr-[55px]">EMAIL</th>
                            <th class="pr-[55px]">CARD ID</th>
                            <th class="pr-[55px]">DOB</th>
                            <th class="pr-[55px]">IMAGE</th>
                            <th class="pr-[55px]">DATE</th>
                            <th class="pr-5">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //selecting data from the database
                        //selecting data from the database
                        $select_query = mysqli_query($connection, "SELECT * FROM users");
                        while ($row = mysqli_fetch_assoc($select_query)) {
                        ?>
                            <tr class="even:bg-[#1D2041] text-blue-50 h-8 text-[14px]">
                                <td class="pr-4"><?php echo $row["ID"] ?></td>

                                <td class="pr-4"><?php echo $row["FIRST_NAME"]; ?></td>

                                <td class="pr-4"><?php echo $row["LAST_NAME"]; ?></td>

                                <td class="pr-4"><?php echo $row["ADDRESS"]; ?></td>

                                <td class="pr-4"><?php echo $row["PHONE"]; ?></td>

                                <td class="pr-4"><?php echo $row["EMAIL"]; ?></td>

                                <td class="pr-none"><?php echo $row["CARD_ID"]; ?></td>

                                <td class="pr-4"><?php echo $row["DOB"]; ?></td>

                                <td class="pr-4"><?php echo $row["IMAGE"]; ?></td>

                                <td class="pr-4"><?php echo $row["DATE"]; ?></td>

                                <?php echo '
                                <td class="pr-4 flex"> 
                                <a href="users.php?id=' . $row['ID'] . '"><button id="button" class="bg-red-600 h-7 w-7 rounded-sm"><i class="fa fa-trash"></i></button></a> 
                                <a href="libarian.php?edit_id=' . $row['ID'] . '"><button id= "button" class= "bg-green-600 h-7 w-7 ml-2 rounded-sm"><i class="fa fa-edit"></i></button></a> 
                                </td>'; ?>

                            </tr>


                        <?php
                        }
                        ?>


                    </tbody>
                </table>
            </div>

            <?php
            function generateRandomPassword($length = 10)
            {
                $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                $charsLength = strlen($chars);
                $randomPassword = '';

                for ($i = 0; $i < $length; $i++) {
                    $randomPassword .= $chars[rand(0, $charsLength - 1)];
                }

                return $randomPassword;
            }

            ?>

            <?php
            //editing details
            if (isset($_GET["edit"])) {
                $edit = $_GET["edit"];

                include("dbConnection.php");
                $select_query = mysqli_query($connection, "SELECT*FROM users WHERE ID='$edit'");
                $row = mysqli_fetch_array($select_query);
                //selecting details to be edited from the database
                if (is_array($row)) {
                    $fname = $row["FIRST_NAME"];
                    $lname = $row["LAST_NAME"];
                    $address = $row["ADDRESS"];
                    $phone = $row["PHONE"];
                    $email = $row["EMAIL"];
                    $card_id = $row["CARD_ID"];
                    $dob = $row["DOB"];
                    $image = $row["IMAGE"];
                }
            }
            if (isset($edit)) {
                $update_id = $edit;
            }

            if (isset($_POST["update"])) {

                //Reading data from the input field
                //Reading data from the input field
                $first_name = $_POST["fname"];
                $last_name = $_POST["lname"];
                $address = $_POST["address"];
                $phone = $_POST["phone"];
                $email = $_POST["email"];
                $card_id = $_POST["card"];
                $dob = $_POST["dob"];
                $image = $_POST["image"];


                //inserting data into  the database
                //inserting data into  the database

                $update_query = mysqli_query($connection, "UPDATE  users SET `FIRST_NAME`='$first_name', `LAST_NAME`='$last_name', `ADDRESS`='$address', `PHONE`='$phone',`EMAIL`='$email',`CARD_ID`='$card_id',`DOB`='$dob',`IMAGE`='$image' WHERE ID = '$edit'");

                if ($update_query) {
                    echo "
                      <script>;
                      alert('Changes has been saved successfully')
                      window.location.href='users.php';
                        </script>;
                    ";
                } else {
                    echo "<script>";
                    echo  "alert('unable to insert data');";
                    echo  "</script>";
                }
            }

            ?>

            <!--registration form -->
            <!--registration form -->
            <div class="h-sreen  w-screen flex items-center justify-center bg-white">
                <div id="form_container" class="m-auto top-[0%] absolute h-[490px] w-[400px] bg-gray-600 rounded-md  inset-0 ">
                    <div class="text-right p-3">
                        <button onclick="closeModal()"><i class="fa fa-times text-red-500"></i></button>
                    </div>
                    <div class="text-center text-xl -mt-6 pb-4 text-blue-50">
                        <h2>Register Users</h2>
                    </div>
                    <hr>
                    <form action="" method="post" class="grid grid-cols-1 lg:grid-cols-2 pt-4 pl-8 ">
                        <div>
                            <label class="text-blue-100" for="">FIRST NAME</label><br>
                            <input value="<?php if (isset($row["FIRST_NAME"])) {
                                                echo $row["FIRST_NAME"];
                                            } ?>" type="text" name="fname" class="p-2 h-9 w-40 rounded-sm bg-blue-50 outline-none"><br><br>

                            <label class="text-blue-100" for="">LAST NAME</label><br>
                            <input value="<?php if (isset($row["LAST_NAME"])) {
                                                echo $row["LAST_NAME"];
                                            } ?>" type="text" name="lname" class="p-2 h-9 w-40 rounded-sm bg-blue-50 outline-none"><br><br>

                            <label class="text-blue-100" for="">ADDRESS</label><br>
                            <input value="<?php if (isset($row["ADDRESS"])) {
                                                echo $row["ADDRESS"];
                                            } ?>" type="text" name="address" class="p-2 h-9 w-40 rounded-sm bg-blue-50 ouyline-none"><br><br>

                            <label class="text-blue-100" for="">PHONE</label><br>
                            <input value="<?php if (isset($row["PHONE"])) {
                                                echo $row["PHONE"];
                                            } ?>" type="text" name="phone" class="p-2 h-9 w-40 rounded-sm bg-blue-50 outline-none"><br><br>
                        </div>
                        <div>
                            <label class="text-blue-100" for="">EMAIL</label><br>
                            <input value="<?php if (isset($row["EMAIL"])) {
                                                echo $row["EMAIL"];
                                            } ?>" type="email" name="email" class="p-2 h-9 w-40 rounded-sm bg-blue-50 outline-none"><br><br>

                            <label class="text-blue-100" for="">CARD ID</label><br>
                            <input value="<?php if (isset($row["CARD_ID"])) {
                                                echo $row["CARD_ID"];
                                            } ?>" type="text" name="card" class="p-2 h-9 w-40 rounded-sm bg-blue-50 outline-none"><br><br>

                            <label class="text-blue-100" for="">DATE OF BIRTH</label><br>
                            <input value="<?php if (isset($row["DOB"])) {
                                                echo $row["DOB"];
                                            } ?>" type="text" name="dob" class="p-2 h-9 w-40 rounded-sm bg-blue-50 outline-none"><br><br>

                            <label class="text-blue-100" for="">IMAGE</label><br>
                            <input value="<?php if (isset($row["IMAGE"])) {
                                                echo $row["IMAGE"];
                                            } ?>" type="file" name="image" class="p-2 h-9 w-40 rounded-sm bg-blue-50 outline-none"><br><br>

                        </div>

                        <div class="text-center ml-20">
                            <input type="submit" name="update" value="Save" class="bg-green-600 h-9 w-40 rounded-sm text-white">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Scripts -->
    <!-- Scripts -->
    <script type="text/javascript">
        function show() {
            document.getElementById("form_container").style.display = "block";
        }

        function closeModal() {
            document.getElementById("form_container").style.display = "none";
            window.location.href = "users.php"
        }

        function mySearch() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput"); //getting the search input
            filter = input.value.toUpperCase(); //converting the input to upper case
            table = document.getElementById("myTable"); //getting the data in the table
            tr = table.getElementsByTagName("tr");
            // Loop through all table rows, and hide those who don't match the search query
            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function edit() {
            document.getElementById("edit").style.display = "block";
        }
    </script>
    <script src="Assets/tailwind.js"></script>
</body>

</html>