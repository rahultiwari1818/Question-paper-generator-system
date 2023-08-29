<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Question Paper</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../script/jquery-3.6.3.js"></script>
    <script src="../script/script.js"></script>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <?php
        include("../Partials/navbar.php");
    ?>

    <main class="my-3">
        <section class="flex justify-center items-center">

            <section class="bg-white shadow-xl rounded-xl p-10">

                <section class="flex justify-center items-center">
                    <p class="lg:text-2xl  text-center px-20 py-5 text-white  bg-blue-500 rounded-xl shadow-xl ">Generate Question Paper</p>
                </section>
                <form id="multiStepForm" class="lg:my-5 my-3"> 
                    <section id="section1">
                        <select name="class"  required id="selectedClass" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">
                           <div class="bg-white my-2">
   
                           </div>
                       </select>        
                    </section>
                    <section id="section2">
                        <select name="type" id="selectedSubject" class="my-2 mx-2 shadow-xl appearance-none  py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300 disabled:z-0"  onchange="searchQuestion()">
                                <option value=""> ------- Select Subject ----------</option>
                            
                        </select>
                    </section>
                    <section id="section3">
                        <select name="type" id="selectedType" class="block shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300" required>
                            <div class="bg-white p-2">
                                <option value=""  > ------- Select a Question Type ----------</option>
                                <option value="mcqs"> MCQS </option>
                                <option value="fib"> Fill In The Blanks</option>
                                <option value="tf">True Or False</option>
                                <option value="atf"> Answer The Following Question. </option>
                            </div>
                        </select>
                    </section>
                    <section id="section4">
                        <section class="md:flex justify-between items-center gap-5">

                            <select name="" id="selectedChapter" class=" shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">

                            </select>
                            <select name="" id="selectedMarks" class=" shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">

                            </select>
                            <select name="level"  id="selectedLevel" class=" shadow-xl appearance-none w-full py-2 px-4 pr-8 rounded-lg border focus:outline-none focus:ring focus:border-blue-300">
                                <div class="bg-white my-2">
                                    <option value=""  > Level </option>
                                    <option value="easy" >Easy</option>
                                    <option value="medium" >Medium</option>
                                    <option value="hard" >Hard</option>
                               </div>
                            </select>
                        </section>
                    </section>
                </form>
                <!-- <section class="my-4 flex justify-between items-center">

                    <button id="backButton" class="bg-blue-500 text-white px-5 py-3 rounded-xl shadow-xl flex justify-around items-center gap-5">
                        <p>Back</p>    
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
    <path d="M459.5 440.6c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29V96c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4L288 214.3V256v41.7L459.5 440.6zM256 352V256 128 96c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4l-192 160C4.2 237.5 0 246.5 0 256s4.2 18.5 11.5 24.6l192 160c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29V352z" fill="black"/>
</svg>

                    </button>
                    <button id="nextButton" class="bg-blue-500 text-white px-5 py-3 rounded-xl shadow-xl  flex justify-around items-center gap-5">
                        <p>Next</p>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
    <path d="M52.5 440.6c-9.5 7.9-22.8 9.7-34.1 4.4S0 428.4 0 416V96C0 83.6 7.2 72.3 18.4 67s24.5-3.6 34.1 4.4L224 214.3V256v41.7L52.5 440.6zM256 352V256 128 96c0-12.4 7.2-23.7 18.4-29s24.5-3.6 34.1 4.4l192 160c7.3 6.1 11.5 15.1 11.5 24.6s-4.2 18.5-11.5 24.6l-192 160c-9.5 7.9-22.8 9.7-34.1 4.4s-18.4-16.6-18.4-29V352z" fill="black"/>
</svg>

                    </button>
                </section> -->
               
                
            </section>
        </section>



    </main>

<!--------------------------------------------------------- PreLoader ---------------------------------------------------- -->

                <div id="preLoader" class="absolute h-[100vh] z-50 w-[100vw] top-0 bg-white"></div>

<!--------------------------------------------------------- ------------------------------- ---------------------------------------------------- -->
    

    <!-- Script to Prevent Form Submission during Page Reload -->

    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>

    <script type="text/javascript">
        $(document).ready(()=>{
            $("#multiStepForm").children().hide();
            $("#multiStepForm").children().first().show();
            // $("#nextButton").attr("disabled",true);
            // $("#backButton").attr("disabled",true);
            fetchClassesInSubject("selectedClass");
            $("#preLoader").hide();

            $("#selectedClass").change(function(){
                
                    // $("#nextButton").attr("disabled");
                    let selectedValue = $(this).val();
                    if(selectedValue!=""){

                        sessionStorage.setItem("selectedClass",selectedValue);
                        fetchSubjectsForView("selectedSubject",$(this).val());
                        $(this).parent().hide();
                        $(this).parent().next().show();
                    }

                    
            })

            $("#selectedSubject").change(function(){

                    let selectedValue = $(this).val();
                    if(selectedValue!=""){

                        sessionStorage.setItem("selectedSubject",selectedValue);
                         fetchSubjectsForView("selectedSubject",$(this).val());
                        $(this).parent().hide();
                        $(this).parent().next().show();
                    }
            })

            $("#selectedType").change(function(){
                    let selectedValue = $(this).val();
                    if(selectedValue!=""){
                        
                        sessionStorage.setItem("selectedType",selectedValue);
    
                        $(this).parent().hide();
                        $(this).parent().next().show();
                        fetch(``)
                        .then(res=>res.json())
                        .then(res=>{
                            
                        })
                    }
            })


            setTimeout(()=>{

                
                if(sessionStorage.getItem("selectedClass")){
                    $("#selectedClass").val(sessionStorage.getItem("selectedClass"));
                }
                if(sessionStorage.getItem("selectedSubject")){
                    $("#selectedSubject").val(sessionStorage.getItem("selectedSubject"));
                }
                if(sessionStorage.getItem("selectedType")){
                    let selectedType = sessionStorage.getItem("selectedType");
                    $("#selectedType").val(selectedType);
                    if(["mcqs","fib","tf"].includes(selectedType)){
                        $("#selectedMarks").html(`                        <option value = "" disabled> Weightage <\option>
                         <option value="1" selected>1</option>`);
                        
                    }
                    else if(selectedType=="atf"){
                        let options = `
                            <option value = "" disabled>-------- Select Weightage of Your Question -----------</option>
                            <option value="1" >1</option>
                            <option value="2" >2</option>
                            <option value="3" >3</option>
                            <option value="4" >4</option>
                            <option value="5" >5</option>
                            <option value="7" >7</option>
                        `;
                        $("#selectedMarks").html(options);
                    }
                }
            },800)






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