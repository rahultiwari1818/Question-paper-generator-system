<?php 
    if(isset($_SESSION["role"]) && $_SESSION["role"]=="ADMIN"){
        echo "

        <nav class='flex justify-between items-center  lg:py-5 md:py-4 bg-white  shadow-xl top-0 sticky' id='navbar'>
        <section>
            <section class='lg:block hidden'>

                <div class=''>
        
                    <button class='px-5 py-3 rounded-xl shadow-xl bg-red-500' id='logoutBtn'>Logout</button>
        
                    
                </div>
                <div>
                    
                </div>
            </section>
            <section class='lg:hidden'>
                <img src='../Assets/Icons/MenuIcon.svg' class='top-2 absolute right-2 cursor-pointer ' id='menuIcon'/>
            </section>
        </section>


    </nav>
        <div class='lg:hidden block'>
            <img src='../Assets/Icons/close.svg' class='top-5 z-10 absolute right-2 cursor-pointer ' id='closeIcon'/>
            <div id='navbarDiv' class='fixed w-[80vw] p-10 right-0 h-screen bg-blue-500 rounded-l-[100px]'>
                <div class='flex justify-center items-center '>
                    <button class='px-7 rounded-lg shadow-xl bg-white py-3 outline outline-red-500 text-red-500 hover:text-white hover:bg-red-500 w-full' id='logoutBtn'>Logout</button>
                </div>
            </div>
        </div>
        ";
    }
    else if(isset($_SESSION["role"]) && $_SESSION["role"]=="USER"){
        echo "
        <nav class='flex justify-between items-center  lg:py-5 md:py-4 bg-white  shadow-xl top-0 sticky' id='navbar'>
        <section class='lg:block hidden'>

            <div class=''>
    
                <button class='px-5 py-3 rounded-xl shadow-xl bg-red-500' id='logoutBtn'>Logout</button>
    
                
            </div>
            <div>
                
            </div>
        </section>
        <section class='lg:hidden'>
            <img src='../Assets/Icons/MenuIcon.svg' class='top-2 absolute right-2 cursor-pointer ' id='menuIcon'/>
        </section>


    </nav>
        <div class='lg:hidden block'>
            <img src='../Assets/Icons/close.svg' class='top-5 z-10 absolute right-2 cursor-pointer ' id='closeIcon'/>
            <div id='navbarDiv' class='fixed w-[80vw] p-10 right-0 h-screen bg-blue-500 rounded-l-[100px]'>
                <div class='flex justify-center items-center '>
                    <button class='px-7 rounded-lg shadow-xl bg-white py-3 outline outline-red-500 text-red-500 hover:text-white hover:bg-red-500 w-full' id='logoutBtn'>Logout</button>
                </div>
            </div>
        </div>
        ";
    }

?>

<script src="../script/jquery-3.6.3.js"></script>

<script type="text/javascript">


        $('#navbarDiv').hide();
        $('#closeIcon').hide();
        $(document).ready(()=>{

            $('#menuIcon').click(()=>{
                $('#navbarDiv').show();
                $('#closeIcon').show();
                $('#menuIcon').hide();
                $('#navbar').hide();
            });

            $('#closeIcon').click(()=>{
                $('#navbarDiv').hide();
                $('#closeIcon').hide();
                $('#menuIcon').show();
                $('#navbar').show();
            })


            $("#logoutBtn").click(()=>{
                window.location.href="../Partials/logout.php";
            })

        })

</script>