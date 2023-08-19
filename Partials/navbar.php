<?php 
    if(isset($_SESSION["role"]) && $_SESSION["role"]=="ADMIN"){
        echo "

        <nav class='flex justify-between items-center py-7 shadow-xl top-0 sticky'>
            <div class=''>
            
            <button class='px-5 py-3 rounded-xl shadow-xl bg-red-500' id='logoutBtn'>Logout</button>
            
                
            </div>
            <div>
            
            </div>
        
        </nav>
        ";
    }
    else if(isset($_SESSION["role"]) && $_SESSION["role"]=="USER"){
        echo "

    <nav class='flex justify-between items-center py-7 shadow-xl top-0 sticky'>
        <div class=''>

        <button class='px-5 py-3 rounded-xl shadow-xl bg-red-500' id='logoutBtn'>Logout</button>

            
        </div>
        <div>

        </div>

    </nav>
        ";
    }

?>

<script src="../script/jquery-3.6.3.js"></script>

<script type="text/javascript">
    $(document).ready(()=>{
        $("#logoutBtn").click(()=>{
            window.location.href="../Partials/logout.php";
        })
    })
</script>