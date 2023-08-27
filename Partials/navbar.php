<?php 
    if(isset($_SESSION["role"]) && $_SESSION["role"]=="ADMIN"){
        echo "

        <nav class='top-0 z-20 sticky py-4 px-2 bg-white'>
        <section class='lg:flex justify-around items-center'>

            <section>
                <img src='../Assets/images/QPG_Logo.png' alt='' srcset='' class='lg:h-[80px] lg:w-[400px] md:h-[70px] md:w-[80%] h-[50px] w-[80%] '>                <!-- for Logo -->
            </section>

            <section>
                <section class='lg:block hidden'>
                    <section>
                        <a href='./addClass.php' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-2  text-white'>Classes</a>
                        <a href='./addSubject.php' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-2 text-white'>Subjects</a>
                        <a href='./viewUsers.php' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-2 text-white'>Users</a>
                        <a href='../Partials/logout.php' class='px-4 py-3 bg-white outline-red-500 text-red-500 hover:outline-white hover:bg-red-500 hover:text-white outline shadow-xl rounded-xl mx-1 my-2 '>Logout</a>
                    </section>
                </section>
                <section class='lg:hidden block'>

                    <section class='cursor-pointer top-7 right-4 absolute' id='hamburgerIcon'>
                        <svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 448 512'><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path d='M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z' fill='#0000FF'/>
                        </svg>
                    </section>
                    <section id='hamburgerSection' class='mt-10'>
                        <section class='cursor-pointer top-7 right-4 absolute' id='closeIcon'>
                            <svg width='14' height='14' viewBox='0 0 14 14' fill='none' xmlns='http://www.w3.org/2000/svg'>
                                <path d='M1.40002 13.6534L0.346191 12.5995L5.94619 6.99953L0.346191 1.39953L1.40002 0.345703L7.00002 5.9457L12.6 0.345703L13.6538 1.39953L8.05384 6.99953L13.6538 12.5995L12.6 13.6534L7.00002 8.05335L1.40002 13.6534Z' fill='#000fff'/>
                                </svg>
                                
                        </section>
                        <a href='#' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-3 text-white block'>Home</a>
                        <a href='#' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-3 text-white block'>Home</a>
                        <a href='#' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-3 text-white block'>Home</a>
                        <a href='./logout.php' class='px-4 py-3 bg-white outline-red-500 text-red-500 hover:outline-white hover:bg-red-500 hover:text-white outline shadow-xl rounded-xl mx-1 my-3  block'>Logout</a>
                    </section>
                </section>
                <!-- for Menu -->
            </section>

        </section>
    </nav>

        ";
    }
    else if(isset($_SESSION["role"]) && $_SESSION["role"]=="USER"){
        echo "
        <nav class='top-0 z-20 sticky py-4 px-2 bg-white'>
        <section class='lg:flex justify-around items-center'>

            <section>
            <img src='../Assets/images/QPG_Logo.png' alt='' srcset='' class='lg:h-[80px] lg:w-[400px]'>

                <!-- for Logo -->
            </section>

            <section>
                <section class='lg:block hidden'>
                    <section>
                        <a href='./uploadQuestions.php' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-2  text-white'>Upload Questions</a>
                        <a href='./viewQuestions.php' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-2  text-white'>Questions</a>
                        <a href='#' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-2 text-white'>Generate Question Paper</a>
                        <a href='../Partials/logout.php' class='px-4 py-3 bg-white outline-red-500 text-red-500 hover:outline-white hover:bg-red-500 hover:text-white outline shadow-xl rounded-xl mx-1 my-2 '>Logout</a>
                    </section>
                </section>
                <section class='lg:hidden block'>

                    <section class='cursor-pointer top-4 right-2 absolute' id='hamburgerIcon'>
                        <svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 448 512'><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path d='M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z' fill='#0000FF'/>
                        </svg>
                    </section>
                    <section id='hamburgerSection' class='mt-10'>
                        <section class='cursor-pointer top-4 right-2 absolute' id='closeIcon'>
                            <svg width='14' height='14' viewBox='0 0 14 14' fill='none' xmlns='http://www.w3.org/2000/svg'>
                                <path d='M1.40002 13.6534L0.346191 12.5995L5.94619 6.99953L0.346191 1.39953L1.40002 0.345703L7.00002 5.9457L12.6 0.345703L13.6538 1.39953L8.05384 6.99953L13.6538 12.5995L12.6 13.6534L7.00002 8.05335L1.40002 13.6534Z' fill='#000fff'/>
                                </svg>
                                
                        </section>
                        <a href='./viewQuestions.php' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-3 text-white block'>Home</a>
                        <a href='#' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-3 text-white block'>Home</a>
                        <a href='#' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-3 text-white block'>Home</a>
                        <a href='../Partials/logout.php' class='px-4 py-3 bg-white outline-red-500 text-red-500 hover:outline-white hover:bg-red-500 hover:text-white outline shadow-xl rounded-xl mx-1 my-3  block'>Logout</a>
                    </section>
                </section>
                <!-- for Menu -->
            </section>

        </section>
    </nav>
        ";
    }

?>

<script src="../script/jquery-3.6.3.js"></script>

<script type="text/javascript">

        $("#hamburgerSection").hide();
        $(document).ready(()=>{
            $("#hamburgerIcon").click(()=>{
                $("#hamburgerSection").show();
                $("#hamburgerIcon").hide();
            })
            $("#closeIcon").click(()=>{
                $("#hamburgerSection").hide();
                $("#hamburgerIcon").show();
            })
        })        

</script>