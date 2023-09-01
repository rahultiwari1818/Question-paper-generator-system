<?php
    session_start();
    include("../Partials/connection.php");


    if(!isset($_SESSION["uId"])){
        header("location: ../login.php");
        exit();
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../script/jquery-3.6.3.js"></script>
    <script src="../script/script.js"></script>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <?php
                    include("../Partials/navbar.php");

                    $uid = $_SESSION["uId"];

                    $sql = "select * from tbl_users where uId = $uid";
                    $result = mysqli_query($conn,$sql);
                    $row = mysqli_fetch_assoc($result);
                    $fname =  $row["fname"]; 
                    $lname =  $row["lname"]; 
                    $username =  $row["username"]; 
                    $email =  $row["email"]; 
                    $phno =  $row["phno"]; 
                    $role =  $row["role"]; 
                    $institute =  $row["institute_name"]; 
                    $gender =  $row["gender"]; 

    ?>




        <section class='p-[1vw] w-[100vw]  z-30 bg-green-500 absolute top-0 shadow-xl' id='successProUpdMessage'>
                <p class='  absolute lg:top-5 md:top-4 top-3  right-5 cursor-pointer' onclick='removeProUpdMsg()'>
                <img src='../Assets/Icons/close.svg' alt='Close Icon'/>
            </p>
        
                    <p class='flex justify-center items-center'> Profile Updated Successfully</p>
        </section> 


        <section class='p-[1vw] w-[100vw]  z-30 bg-green-500 fixed top-0 shadow-xl' id='successPasswdUpdMsg'>
                <p class='  absolute lg:top-5 md:top-4 top-3  right-5 cursor-pointer' onclick='removePswdUpdMsg()'>
                <img src='../Assets/Icons/close.svg' alt='Close Icon'/>
            </p>
        
                    <p class='flex justify-center items-center text-white'> Password Updated Successfully</p>
        </section> 

<main>
        <section class="flex justify-center items-center   px-2 my-5">

            <div id="profile" class="  p-2 max-w-2/3 min-w-fit md:p-5 bg-blue-500 shadow-xl rounded-2xl">

                <div class="bg-white  sm:flex items-center justify-center flex-col gap-y-3 rounded-2xl">

                    <div class="w-full flex items-center justify-center flex-col py-1 px-10 py-5 ">
                        <h1
                            class="block text-center text-2xl font-bold text-black px-20 py-1 my-1 border-b-2 border-gray-300 sm: py-4 my-5 md:text-3xl ">
                            <?php echo $username;?>
                        </h1>
                        <b class="text-center md:text-md w-full text-lg">Welcome !! <?php echo $username;?></b>
                    </div>

                    <div class="w-full py-3 ">
                        <p class="text-center text-xl text-red-500 bg-gray-200  shadow-xl p-2 font-bold">Your Profile</p>
                    </div>
                    
                    <div class="flex flex-col justify-evenly items-left sm:gap-y-3 my-5 items-left">

                        <div class="block border-b-2 border-gray-200 sm:grid grid-cols-2 gap-5 px-5 ">
                            <div class="py-1 my-1">
                                <p class="text-md font-bold sm:text-md text-center md:text-lg "> Fname &nbsp; : </p>
                            </div>
                            <div class="py-1 px-5 text-left">
                                <p class="text-md block text-center sm:text-md md:text-lg"> <?php echo $fname;?></p>
                            </div>
                        </div>

                        <div class="block border-b-2 border-gray-200 sm:grid grid-cols-2 gap-5 px-5 ">
                            <div class="py-1 my-1">
                                <p class="text-center font-bold text-md sm:text-md md:text-lg"> Lname &nbsp; : </p>
                            </div>
                            <div class="py-1 px-5">
                                <p class="text-md text-center sm:text-md md:text-lg"> <?php echo $lname;?></p>
                            </div>
                        </div>

                        <div class="block border-b-2 border-gray-200 sm:grid grid-cols-2 gap-5 px-5">
                            <div class="py-1 my-1">
                                <p class="text-md font-bold sm:text-md text-center md:text-lg"> Email &nbsp; : </p>
                            </div>
                            <div class="py-1 px-5">
                                <p class="text-md break-all text-center sm:text-md md:text-lg"> <?php echo $email;?></p>
                            </div>
                        </div>

                        <div class="block border-b-2 border-gray-200 sm:grid grid-cols-2 gap-5 px-5">
                            <div class="py-1 my-1">
                                <p class="text-md font-bold sm:text-md text-center md:text-lg"> Role &nbsp; : </p>
                            </div>
                            <div class="py-1 px-5">
                                <p class="text-md text-center sm:text-md md:text-lg"> <?php echo $role;?></p>
                            </div>
                        </div>

                        <div class="block border-b-2 border-gray-200 sm:grid grid-cols-2 gap-5 px-5">
                            <div class="py-1 my-1">
                                <p class="text-md font-bold sm:text-md text-center md:text-lg"> Phone No &nbsp; : </p>
                            </div>
                            <div class="py-1 px-5">
                                <p class="text-md text-center sm:text-md md:text-lg"> <?php echo $phno;?></p>
                            </div>
                        </div>

                        <div class="block border-b-2 border-gray-200 sm:grid grid-cols-2 gap-5 px-5">
                            <div class="py-1 my-1">
                                <p class="text-md font-bold sm:text-md text-center md:text-lg"> Gender &nbsp; : </p>
                            </div>
                            <div class="py-1 px-5">
                                <p class="text-md text-center sm:text-md md:text-lg"><?php echo $gender; ?></p>
                            </div>
                        </div>

                        <div class="block border-b-2 border-gray-200 sm:grid grid-cols-2 gap-5 px-5">
                            <div class="py-1 my-1">
                                <p class="text-md font-bold sm:text-md text-center md:text-lg"> Institute &nbsp; : </p>
                            </div>
                            <div class="py-1 px-5">
                                <p class="text-md text-center sm:text-md md:text-lg word-break"><?php echo $institute; ?></p>
                            </div>
                        </div>

                        <div class="md:flex justify-end items-center px-10 gap-5 my-5">
                            <button  class=" w-fit my-2 flex  justify-around items-center gap-5 px-5 py-2 bg-[#FFA500] text-white border border-white hover:bg-red-500 hover:text-white rounded-lg shadow-lg" id="passwdUpdBtn">
                                <p>Change Password</p>
                                 <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M15.8577 5.65576L12.4828 2.31158L13.7962 0.998133C14.0834 0.710966 14.4372 0.567383 14.8577 0.567383C15.2782 0.567383 15.6321 0.710966 15.9192 0.998133L17.1558 2.23466C17.4429 2.52182 17.5917 2.87053 17.6019 3.28078C17.6122 3.69103 17.4737 4.03974 17.1865 4.32691L15.8577 5.65576ZM14.7731 6.75573L4.02886 17.5H0.653931V14.125L11.3982 3.38078L14.7731 6.75573Z" fill="#fff"/>
                                   </svg>
                            </button>

                            <a href="../Partials/updateProfile.php" class="my-2 w-fit flex  justify-around items-center gap-5 px-5 py-2 bg-[#FFA500] text-white border border-white hover:bg-red-500 hover:text-white rounded-lg shadow-lg">
                                <p>Update Profile</p>
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M15.8577 5.65576L12.4828 2.31158L13.7962 0.998133C14.0834 0.710966 14.4372 0.567383 14.8577 0.567383C15.2782 0.567383 15.6321 0.710966 15.9192 0.998133L17.1558 2.23466C17.4429 2.52182 17.5917 2.87053 17.6019 3.28078C17.6122 3.69103 17.4737 4.03974 17.1865 4.32691L15.8577 5.65576ZM14.7731 6.75573L4.02886 17.5H0.653931V14.125L11.3982 3.38078L14.7731 6.75573Z" fill="#fff"/>
                                   </svg>
                            </a>
                        </div>



                    </div>
                    <div class="w-full py-3 ">
                        <p class="text-center text-xl text-red-500 bg-gray-200 p-2 shadow-xl font-bold ">Thank You</p>
                    </div>
                    
                </div>
                
            </div>
        </section>
    </main>

         <!--------------------------------------------------------- PreLoader ---------------------------------------------------- -->



         <div id="preLoader" class="absolute h-[100vh] z-50 w-[100vw] top-0 bg-white"></div>

<!--------------------------------------------------------- ------------------------------- ---------------------------------------------------- -->

            <!--------------------------------------------------------- Update Modal ---------------------------------------------------- -->

            <div id="passwordUpdateModal" class="flex justify-center items-center top-0 w-[100vw] h-[100vh] fixed bg-opacity-80  bg-gray-100">
                <div class="bg-white lg:p-10 p-5 rounded-xl shadow-xl max-w-2/3">

                    <div class="float-right lg:-mt-7 mt-4 -mr-3 cursor-pointer" onclick="closeUpdatePasswordModal()">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.40002 13.6534L0.346191 12.5995L5.94619 6.99953L0.346191 1.39953L1.40002 0.345703L7.00002 5.9457L12.6 0.345703L13.6538 1.39953L8.05384 6.99953L13.6538 12.5995L12.6 13.6534L7.00002 8.05335L1.40002 13.6534Z" fill="#000000"/>
                        </svg>

                    </div>
                    <div class=" lg:p-10 p-5 rounded-xl shadow-xl bg-blue-500">
                        <form action="" id="updatePasswordForm">
                        <div class="my-2">
                            <input type="password" name="subject" id="currentPassword"  value="" required  placeholder="Current Password" class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300" >
                            <p class='text-red-500 my-3 ' id='currentPasswordErr'>      </p>
                        </div>
                        <div class="my-2">
                             <input type="password" name="subject" id="newPassword"  value="" required  placeholder="New Password" class="block shadow-xl  my-1 appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300"  >
                            <p class='text-red-500 my-3 ' id='newPasswordErr'>      </p>
                        </div>
                        <div class="my-5">
                            <input type="submit" value="Change Password" name="updatehojabhai" class="px-5 w-full py-2 bg-white text-red-500 border border-red-500 hover:bg-red-500 hover:text-white rounded-lg shadow-xl">
                        </div>
                        <div class="my-5">
                            <p class='text-red-500 my-3 ' id='errorMsg'>      </p>

                        </div>
                        </form>
                    </div>
                </div>

            </div>

    <!--------------------------------------------------------- ------------------------------- ---------------------------------------------------- -->


    <script type="text/javascript">

        $(document).ready(()=>{

            $("#successProUpdMessage").hide();
            $("#successPasswdUpdMsg").hide();
            $("#passwordUpdateModal").hide();



            function removeParamFromCurrentURL(paramToRemove) {
                    try {
                        const urlWithoutParam = window.location.href.replace(
                        new RegExp(`([?&])${paramToRemove}=[^&#]*(#.*)?$`), '$1');  

                        window.history.replaceState({}, document.title, urlWithoutParam);
                    } catch (error) {
                        
                    }

                }
                // setTimeout(()=>{

                // },2000)

                try {
                    const params = new URLSearchParams(window.location.search);
                    const success = params.get("success");
                    if(success){
                        $("#successProUpdMessage").show();

                        setTimeout(()=>{
                            $("#successProUpdMessage").hide();
                            const paramToRemove = "success";
                            removeParamFromCurrentURL(paramToRemove);
                        },3000)
                    }
                } catch (error) {
                    
                }

                $("#preLoader").hide();

                $("#passwdUpdBtn").click(()=>{
                    openUpdatePasswordModal();
                })


                $("#updatePasswordForm").submit(function(e){
                    e.preventDefault();
                    let error = false;
                    if($("#currentPassword").val().trim()==""){
                        error=true;
                        $("#currentPasswordErr").text("Current Password Is Not Empty");
                        
                    }
                    if($("#newPassword").val().trim()==""){
                        $("#newPasswordErr").text("New Password Cannot be Empty");
                        error=true;
                        
                    }


                    // validation of type and class is remaining

                    if(!error){
                        updatePassword();
                    }
                })

        })

    </script>
    <footer class="bg-white bottom-0  p-[1vh] fixed w-screen  ">
            <section class="flex justify-center items-center">
                <p class="font-serif antialiased font-black lg:text-xl text-base	"></p>
                Developed With <img src="../Assets/Icons/HeartIcon.svg" class="h-5 w-5 mx-2" alt="Heart Icon">
                 By Team LinkedList
            </section>
        </footer>

</body>
</html>