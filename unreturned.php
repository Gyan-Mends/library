<?php
session_start();

//database connection
include("dbConnection.php");
//deleting arow from a table
//deleting arow from a table
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $delete_query = mysqli_query($connection, "DELETE FROM borrowed WHERE ID ='$id'");
    if ($delete_query) {
        echo "
        <script>;
            alert('Record has been deleted successfully');
            </script>;
        ";
    }
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
                    <h2 class="text-xl text-white">Unreturned Books</h2>

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
                    <thead class=" bg-[#1D2041] pl-4 text-blue-100 w-[800px]  h-9 ">
                        <tr class="text-center">
                            <th class="pr-[90px] pl-5">ID</th>
                            <th class="pr-[40px]">NAME</th>
                            <th class="pr-[40px]"> BORROWED DATE</th>
                            <th class="pr-[40px]">ADDRESS</th>
                            <th class="pr-[40px]">PHONE</th>
                            <th class="pr-[40px]">EMAIL</th>
                            <th class="pr-[40px]">CARD ID</th>
                            <th class="pr-[40px]">DUE DATE</th>
                            <th class="pr-[40px]">TITTLE</th>
                            <th class="pr-5">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                         $select = mysqli_query($connection, "SELECT * FROM borrowed WHERE  `DUE_DATE`<= CURDATE() && STATUS = 'Borrowed'");
                        while ($row = mysqli_fetch_assoc($select)) {
                        ?>
                            <tr class="even:bg-[#1D2041] text-blue-50 h-8">
                                <td><?php echo $row["ID"] ?></td>

                                <td><?php echo $row["NAME"]; ?></td>

                                <td><?php echo $row["BORROWED_DATE"]; ?></td>

                                <td><?php echo $row["ADDRESS"]; ?></td>

                                <td><?php echo $row["PHONE"]; ?></td>

                                <td><?php echo $row["EMAIL"]; ?></td>

                                <td><?php echo $row["CARD_ID"]; ?></td>

                                <td><?php echo $row["DUE_DATE"]; ?></td>

                                <td><?php echo $row["TITTLE"]; ?></td>

                                <?php echo '<td> <a href="borrowed.php?id=' . $row['ID'] . '"><button id="button" class="bg-red-600 h-7 w-7 rounded-sm"><i class="fa fa-trash"></i></button></a> <a href="libarian.php?edit_id=' . $row['ID'] . '"><button id= "button" class= "bg-green-600 h-7 w-7 rounded-sm"><i class="fa fa-edit"></i></button></a> </td>'; ?>

                            </tr>


                        <?php
                        }
                        ?>


                    </tbody>
                </table>
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
    //selecting data from the database
    //selecting data from the database
    $select_query = mysqli_query($connection, "SELECT * FROM borrowed WHERE  `DUE_DATE`= CURDATE()");
    $rows = mysqli_fetch_array($select_query);
    if(is_array($rows)){
        //fetching data from the database
        //fetching data from the database
        $name =$rows["NAME"];
        $bdate =$rows["BORROWED_DATE"];
        $address =$rows["ADDRESS"];
        $phone =$rows["PHONE"];
        $email =$rows["EMAIL"];
        $card_id =$rows["CARD_ID"];
        $tittle =$rows["TITTLE"];
        $due_date =$rows["DUE_DATE"];

        $select_queries = mysqli_query($connection, "SELECT * FROM unreturned_books WHERE  `CARD_ID`= '$card_id'");
        if($select_queries){

        }else{
            //inserting into the unreturned table
        //inserting into the unreturned table
        $insert_query = mysqli_query($connection,"INSERT INTO unreturned_books (`NAME`,BORROWED_DATE,`ADDRESS`,PHONE,EMAIL,CARD_ID,TITTLE,DUE_DATE) VALUES ('$name','$bdate','$address','$phone','$email','$card_id','$tittle','$due_date')");
        }
        
    }
?>
