<?php
session_start();
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

<body class="bg-[#525289] " style="font-family:poppins;">
    <!-- LOGIN -->
    <!-- LOGIN -->
    <div class="grid grid-cols-1 lg:grid-cols-2">
        <div class=" border-tr-md">
            <img src="images/HOW-DO-YOU-DESIGN-A-LIBRARY-MANAGEMENT-SYSTEM-min-768x768.png" alt="">
        </div>
        <div class="flex items-center justify-center">
            <form action="index.php" method="POST">
                <div class="-mt-8 mb-10 text-center">
                    <h1 class="text-white text-[25px] mb-4">
                        ADMIN LOGIN
                    </h1>
                    <hr class="border border-violet-400">
                </div>
                <label class="text-white" for="">Email</label><br>
                <input type="email" class="h-9 w-60 rounded-md !bg-white outline-none pl-2" name="email"><br><br>

                <label class="text-white" for="">Password</label><br>
                <input type="password" name="password" class="h-9 w-60 rounded-md  outline-none pl-2"><br><br><br>

                <div class="text-center">
                    <input class="bg-violet-400 w-60 h-9 rounded-md text-white " name="submit" type="submit" value="LOGIN">
                </div>
            </form>
        </div>
    </div>

    <script>
        function closeModal() {
            document.getElementById("myMode").style.display = "none";
        }
    </script>
    <script src="Assets/tailwind.js"></script>
</body>

</html>

<?php
if (isset($_POST["submit"])) {
    //Database connection
    //Database connection
    $connection = mysqli_connect("localhost", "root", "", "library");

    //fetching data from the forms
    //fetching data from the forms
    $email = $_POST["email"];
    $password = $_POST["password"];

    //checking if admin details exist in the database
    //checking if admin details exist in the database
    $select_qury = mysqli_query($connection, "SELECT * FROM `admin_login` WHERE EMAIL='$email' AND `PASSWORD`='$password'");
    $row = mysqli_fetch_array($select_qury);
    if (is_array($row)) {
        $_SESSION["email"] = $row["EMAIL"];
        $_SESSION["password"] = $row["PASSWORD"];
    }

    if (isset($row["EMAIL"])) {
        header("location:admin_dashboard.php");
    } else {
        echo " 
<div id='myMode' class='flex items-center justify-center '>
  <div class='h-48 w-80 rounded-md bg-[#1D2041] -mt-[50%] text-center'>    
  <h3 class='font-bold text-lg'><i class='fa fa-times fa-5x text-red-400'></i></h3>
    <p class='text-white'>Invalid email or password</p>
    <div class=''>
      <button onclick='closeModal()' for='my-modal' class='bg-violet-400 h-8 text-white rounded-sm mt-4 w-20'>OHK</button>
    </div>
  </div>
</div>
          ";
    }
}

?>