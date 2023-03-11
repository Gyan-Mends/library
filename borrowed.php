<?php
session_start();

//database connection
include("dbConnection.php");
//deleting arow from a table
//deleting arow from a table
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $update  = mysqli_query($connection, "UPDATE borrowed	SET status = (CASE	WHEN status = 'Borrowed' THEN 'Returned'	WHEN status = 'Returned' THEN 'Borrowed'	ELSE 	status	END)	WHERE id = '$id'");
   }

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

    <div class="pt-3 pr-40">
        <div class="ml-[150px]  bg-[#525289] w-[88vw] h-[97vh] rounded-[20px] p-8">
            <!-- top navigation bar -->
            <!-- top navigation bar -->
            <div class="h-[60px] rounded-xl bg-[#1D2041] p-4 grid grid-cols-1 lg:grid-cols-3">
                <div class="flex">
                    <h2 class="text-xl text-white">Borrowed Books</h2>
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
            <div class="mt-10 flex items-center justify-center">
                <table id="myTable">
                    <thead class=" bg-[#1D2041] pl-4 text-blue-100  h-9 ">
                        <tr class="text-center text-[14px]">
                            <th class="pr-[40px] pl-5">ID</th>
                            <th class="pr-[40px]">NAME</th>
                            <th class="pr-[40px]"> BORROWED DATE</th>
                            <th class="pr-[40px]">ADDRESS</th>
                            <th class="pr-[40px]">PHONE</th>
                            <th class="pr-[40px]">EMAIL</th>
                            <th class="pr-[40px]">CARD ID</th>
                            <th class="pr-[40px]">DUE DATE</th>
                            <th class="pr-[40px]">TITTLE</th>
                            <th class="pr-[40px]">STATUS</th>
                            <th class="pr-5">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //selecting data from the database
                        //selecting data from the database
                        $select_query = mysqli_query($connection, "SELECT * FROM borrowed");
                        while ($row = mysqli_fetch_assoc($select_query)) {
                        ?>
                            <tr class="even:bg-[#1D2041] text-blue-50 h-8 text-[14px]">
                                <td><?php echo $row["ID"] ?></td>

                                <td><?php echo $row["NAME"]; ?></td>

                                <td><?php echo $row["BORROWED_DATE"]; ?></td>

                                <td><?php echo $row["ADDRESS"]; ?></td>

                                <td><?php echo $row["PHONE"]; ?></td>

                                <td class="pr-4 pl-4"><?php echo $row["EMAIL"]; ?></td>

                                <td><?php echo $row["CARD_ID"]; ?></td>

                                <td><?php echo $row["DUE_DATE"]; ?></td>

                                <td><?php echo $row["TITTLE"]; ?></td>

                                <td><?php echo $row["STATUS"]; ?></td>

                                <?php echo '<td> <a href="borrowed.php?id=' . $row['ID'] . '"><button id="button" class="bg-red-600 h-7 w-7 rounded-sm"><i class="fa fa-check"></i></button></a> <a href="borrowed_edit.php?edit=' . $row['ID'] . '"><button id= "button" class= "bg-green-600 h-7 w-7 rounded-sm"><i class="fa fa-edit"></i></button></a> </td>'; ?>

                            </tr>


                        <?php
                        }
                        ?>


                    </tbody>
                </table>
            </div>

            <!--registration form -->
            <!--registration form -->
            <div class="h-sreen  w-screen flex items-center justify-center bg-white">
                <div id="form_container" class="m-auto top-[0%] absolute h-[490px] w-[400px] bg-gray-600 rounded-md hidden inset-0 ">
                    <div class="text-right p-3">
                        <button onclick="closeModal()"><i class="fa fa-times text-red-500"></i></button>
                    </div>
                    <div class="text-center text-xl -mt-6 pb-4 text-blue-50">
                        <h2>Borrow a Book</h2>
                    </div>
                    <hr>
                    <form action="borrowed.php" method="post" class="grid grid-cols-1 lg:grid-cols-2 pt-4 pl-8 ">
                        <div>
                            <label class="text-blue-100" for=""> NAME</label><br>
                            <input type="text" name="fname" class="p-2 h-9 w-40 rounded-sm bg-blue-50 outline-none"><br><br>
                            <label class="text-blue-100" for="">ADDRESS</label><br>
                            <input type="text" name="address" class="p-2 h-9 w-40 rounded-sm bg-blue-50"><br><br>
                            <label class="text-blue-100" for="">PHONE</label><br>
                            <input type="text" name="phone" class="p-2 h-9 w-40 rounded-sm bg-blue-50"><br><br>
                            <label class="text-blue-100" for="">BORROWED DATE</label><br>
                            <input type="date" name="bdate" class="p-2 h-9 w-40 rounded-sm bg-blue-50 outline-none"><br><br>
                        </div>
                        <div>
                            <label class="text-blue-100" for="">EMAIL</label><br>
                            <input type="text" name="email" class="p-2 h-9 w-40 rounded-sm bg-blue-50"><br><br>
                            <label class="text-blue-100" for="">CARD ID</label><br>
                            <input type="text" name="card" class="p-2 h-9 w-40 rounded-sm bg-blue-50"><br><br>
                            <label class="text-blue-100" for="">BOOK TITTLE</label><br>
                            <input type="text" name="tittle" class="p-2 h-9 w-40 rounded-sm bg-blue-50"><br><br>
                            <label class="text-blue-100" for="">DUE DATE</label><br>
                            <input type="date" name="ddate" class="p-2 h-9 w-40 rounded-sm bg-blue-50"><br><br>

                        </div>

                        <div class="text-center ml-20">
                            <input type="submit" name="submit" class="bg-violet-300 h-9 w-40 rounded-sm text-white">
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

<?php
if (isset($_POST["submit"])) {


    //Reading data from the input field
    //Reading data from the input field
    $name = $_POST["fname"];
    $bdate = $_POST["bdate"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $card_id = $_POST["card"];
    $tittle = $_POST["tittle"];
    $ddate = $_POST["ddate"];
    $date = date("Y-m-d");


    //checking if user card id is the same as the one he/she was given during registeration
    //checking if user card id is the same as the one he/she was given during registeration
    $check_query = mysqli_query($connection, "SELECT CARD_ID FROM users WHERE CARD_ID ='$card_id'");
    $row = mysqli_fetch_array($check_query);
    if (is_array($row)) {
        //checking if the user has not borrowed a book that he has not returned
        //checking if the user has not borrowed a book that he has not returned
        $check_query = mysqli_query($connection, "SELECT CARD_ID FROM users WHERE CARD_ID ='$card_id'");
        $row = mysqli_fetch_array($check_query);
         //inserting data into  the database
        //inserting data into  the database
        $insert_query = mysqli_query($connection, "INSERT INTO borrowed (`NAME`, `BORROWED_DATE`, `ADDRESS`, `PHONE`,`EMAIL`,`CARD_ID`,`TITTLE`,`DUE_DATE`,`DATE`,`STATUS`)VALUES ('$name', '$bdate', '$address', '$phone','$email','$card_id','$tittle','$ddate','$date','Borrowed')");

        if ($insert_query) {
            echo "
            <script>;
            alert('Book has has been inserted successfully');
            window.location.href='borrowed.php';
            </script>;
       ";
        } else {
            echo "<script>";
            echo  "alert('unable to insert data');";
            echo  "</script>";
        }
       
    } else {
        echo "
            <script>;
            alert('This user can not borrow a book because he/she is not registered');
            window.location.href='borrowed.php';
            </script>;
       ";
    }
}


?>