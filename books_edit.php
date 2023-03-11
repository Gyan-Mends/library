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
    <?php
    include("side_nav.php");
    ?>

    <div class="pt-3 pr-40">
        <div class="ml-[150px]  bg-[#525289] w-[88vw] h-[97vh] rounded-[20px] p-8">
            <div class="h-[60px] rounded-xl bg-[#1D2041] p-4 grid grid-cols-1 lg:grid-cols-3">
                <div class="flex">
                    <h2 class="text-xl text-white">Books Management</h2>
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
                    <thead class=" bg-[#1D2041] pl-4 text-blue-100 w-[800px]  h-9 ">
                        <tr class="text-center">
                            <th class="pr-[90px] pl-5">ID</th>
                            <th class="pr-[100px]">TITTLE</th>
                            <th class="pr-[70px]"> AUTHOR</th>
                            <th class="pr-[70px]">EDITION</th>
                            <th class="pr-[70px]">PAGES</th>
                            <th class="pr-[70px]">DESCRIPTION</th>
                            <th class="pr-[70px]">IMAGE</th>
                            <th class="pr-[70px]">DATE</th>
                            <th class="pr-5">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //selecting data from the database
                        //selecting data from the database
                        $select_query = mysqli_query($connection, "SELECT * FROM books");
                        while($row = mysqli_fetch_assoc($select_query)) {
                        ?>
                            <tr class="even:bg-[#1D2041] text-blue-50 h-8">
                                <td><?php echo $row["ID"] ?></td>
                            
                                <td><?php echo $row["TITTLE"]; ?></td>
                            
                                <td><?php echo $row["AUTHOR"]; ?></td>
                            
                                <td><?php echo $row["EDITION"]; ?></td>
                            
                                <td><?php echo $row["PAGES"]; ?></td>

                                <td><?php echo $row["DESCRIPTIONS"]; ?></td>

                                <td><?php echo $row["IMAGES"]; ?></td>

                                <td><?php echo $row["DATE"]; ?></td>
                               
                                <?php echo '<td> 
                                <a href="books.php?id='.$row['ID'].'"><button id="button" class="bg-red-600 h-7 w-7 rounded-sm"><i class="fa fa-trash"></i></button></a> 
                                
                                <a href="books_edit.php?edit='.$row['ID'].'"><button onclick="edit()" id= "button" class= "bg-[#2AD073] h-7 w-7 rounded-sm"><i class="fa fa-edit"></i></button></a> </td>';?>
                                
                            </tr>

                            
                        <?php
                        }
                        ?>


                    </tbody>
                </table>
            </div>


            <?php
            //editing details
            if (isset($_GET["edit"])) {
                $edit = $_GET["edit"];

                include("dbConnection.php");
                $select_query = mysqli_query($connection, "SELECT*FROM books WHERE ID='$edit'");
                $row = mysqli_fetch_array($select_query);
                //selecting details to be edited from the database
                if (is_array($row)) {
                    $tittle = $row["TITTLE"];
                    $author = $row["AUTHOR"];
                    $edition = $row["EDITION"];
                    $pages = $row["PAGES"];
                    $description = $row["DESCRIPTIONS"];
                    $image = $row["IMAGES"];
                }
            }
            if (isset($edit)) {
                $update_id = $edit;
            }

            if (isset($_POST["update"])) {

                //Reading data from the input field
                //Reading data from the input field
                $book_name = $_POST["bname"];
                $book_author = $_POST["bauthor"];
                $edition = $_POST["bedition"];
                $pages = $_POST["bpages"];
                $description = $_POST["bdescription"];
                $image = $_POST["bimage"];


                //inserting data into  the database
                //inserting data into  the database

                $update_query = mysqli_query($connection, "UPDATE  books SET `TITTLE`='$book_name', `AUTHOR`='$book_author', `EDITION`='$edition', `PAGES`='$pages',`DESCRIPTIONS`='$description',`IMAGES`='$image' WHERE ID = '$edit'");

                if ($update_query) {
                    echo "
                      <script>;
                      alert('Changes has been saved successfully')
                      window.location.href='books.php';
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
                <div id="form_container" class="m-auto top-[0%] absolute h-[400px] w-[400px] bg-gray-600 rounded-md  inset-0 ">
                    <div class="text-right p-3">
                        <button onclick="closeModal()"><i class="fa fa-times text-red-500"></i></button>
                    </div>
                    <div class="text-center text-xl -mt-6 pb-4 text-blue-50">
                        <h2>Add New Book</h2>
                    </div>
                    <hr>
                    <form action="" method="post" class="grid grid-cols-1 lg:grid-cols-2 pt-4 pl-8 ">
                        <div>
                            <label class="text-blue-100" for="">BOOK TITLE</label><br>
                            <input value="<?php if (isset($row["TITTLE"])) {
                                                echo $tittle;
                                            } ?>" type="text" name="bname" class="p-2 h-9 w-40 rounded-sm bg-blue-50 outline-none" required><br><br>

                            <label class="text-blue-100" for="">AUTHOR</label><br>
                            <input value="<?php if (isset($row["AUTHOR"])) {
                                                echo $row["AUTHOR"];
                                            } ?>" type="text" name="bauthor" class="p-2 h-9 w-40 rounded-sm bg-blue-50 outline-none"><br><br>

                            <label class="text-blue-100" for="">EDITION</label><br>
                            <input value="<?php if (isset($row["EDITION"])) {
                                                echo $row["EDITION"];
                                            } ?>" type="text" name="bedition" class="p-2 h-9 w-40 rounded-sm bg-blue-50 outline-none"><br><br>
                        </div>
                        <div>
                            <label class="text-blue-100" for="">PAGES</label><br>
                            <input value="<?php if (isset($row["PAGES"])) {
                                                echo $row["PAGES"];
                                            } ?>" type="text" name="bpages" class="p-2 h-9 w-40 rounded-sm bg-blue-50 outline-none"><br><br>

                            <label class="text-blue-100" for="">DESCRIPTION</label><br>
                            <input value="<?php if (isset($row["DESCRIPTIONS"])) {
                                                echo  $row["DESCRIPTIONS"];
                                            } ?>" type="text" name="bdescription" class="p-2 h-9 w-40 rounded-sm bg-blue-50 outline-none"><br><br>

                            <label class="text-blue-100" for="">IMAGE</label><br>
                            <input value="<?php if (isset($row["IMAGES"])) {
                                                echo $row["IMAGES"];
                                            } ?>" type="file" name="bimage" class="p-2 h-9 w-40 rounded-sm bg-blue-50 outline-none"><br><br>

                        </div>

                        <div class="text-center ml-20">
                            <input value="Save" type="submit" name="update" class="bg-green-600 h-9 w-40 rounded-sm text-white">
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

        function edit() {
            document.getElementById("edit").style.display = "block";
        }

        function closeModal() {
            document.getElementById("form_container").style.display = "none";
            window.location.href = "books.php"
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
    </script>
    <script src="Assets/tailwind.js"></script>
</body>

</html>