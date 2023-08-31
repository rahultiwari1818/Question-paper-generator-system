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
                    <section class='flex justify-between items-center'>
                        <a href='./addClass.php' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-2  text-white'>Classes</a>
                        <a href='./addSubject.php' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-2 text-white'>Subjects</a>
                        <a href='./viewUsers.php' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-2 text-white'>Users</a>
                        <a href='./profile.php' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-2 text-white'>Profile</a>
                        <a href='../Partials/logout.php' class='px-4 py-3 bg-white outline-red-500 text-red-500 hover:outline-white hover:bg-red-500 hover:text-white outline shadow-xl rounded-xl mx-1 my-2 flex justify-around items-center gap-5  '>
                            <p>  Logout</p>
                            <svg xmlns='http://www.w3.org/2000/svg'  height='1em' viewBox='0 0 512 512'>
                            <!--! Font Awesome Pro 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path d='M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z' fill=''/>
                            </svg>
                        </a>
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
                        <a href='./addClass.php' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-3 text-white block'>Classes</a>
                        <a href='./addSubject.php' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-3 text-white block'>Subjects</a>
                        <a href='./viewUsers.php' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-3 text-white block'>Users</a>
                        <a href='./profile.php' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-3 text-white block'>Profile</a>
                        <a href='./logout.php' class='px-4 py-3 bg-white outline-red-500 text-red-500 hover:outline-white hover:bg-red-500 hover:text-white outline shadow-xl rounded-xl mx-1 my-3  flex justify-around items-center gap-5'>

                            <p>  Logout</p>
                            <svg xmlns='http://www.w3.org/2000/svg'  height='1em' viewBox='0 0 512 512'><!--! Font Awesome Pro 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d='M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z' fill=''/></svg>
                        </a>
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
            <img src='../Assets/images/QPG_Logo.png' alt='' srcset='' class='lg:h-[80px] lg:w-[400px] md:h-[70px] md:w-[80%] h-[50px] w-[80%]'>

                <!-- for Logo -->
            </section>

            <section>
                <section class='lg:block hidden'>
                    <section class='flex justify-between items-center'>
                        <a href='./uploadQuestions.php' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-2  text-white'>Upload Questions</a>
                        <a href='./viewQuestions.php' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-2  text-white'>Questions</a>
                        <a href='#' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-2 text-white'>Generate Question Paper</a>
                        <a href='./profile.php' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-2 text-white'>Profile</a>
                        <a href='../Partials/logout.php' class='px-4 py-3 bg-white outline-red-500 text-red-500 hover:outline-white hover:bg-red-500 hover:text-white outline shadow-xl rounded-xl mx-1 my-2 flex justify-around items-center gap-5'>

                            <p>  Logout</p>
                            <svg xmlns='http://www.w3.org/2000/svg'  height='1em' viewBox='0 0 512 512'><!--! Font Awesome Pro 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d='M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z' fill=''/></svg>
                        
                        </a>
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
                        <a href='./uploadQuestions.php' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-3 text-white block'>Upload Questions</a>
                        <a href='./viewQuestions.php' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-3 text-white block'>View Questions</a>
                        <a href='#' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-3 text-white block'>Generate Question Paper</a>
                        <a href='./profile.php' class='px-4 py-3 bg-blue-500 outline-white outline shadow-xl rounded-xl mx-1 my-3 text-white block'>Profile</a>
                        <a href='../Partials/logout.php' class='px-4 py-3 bg-white outline-red-500 text-red-500 hover:outline-white hover:bg-red-500 hover:text-white outline shadow-xl rounded-xl mx-1 my-3  flex justify-around items-center gap-5'>

                            <p>  Logout</p>
                            <svg xmlns='http://www.w3.org/2000/svg'  height='1em' viewBox='0 0 512 512'><!--! Font Awesome Pro 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d='M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z' fill=''/></svg>
                        
                        </a>
                    </section>
                </section>
                <!-- for Menu -->
            </section>

        </section>
    </nav>
        ";
    }

?>

<!-- <script src="../script/jquery-3.6.3.js"></script> -->

<script type="text/javascript">

    $(document).ready(()=>{
            $("#hamburgerSection").hide();
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