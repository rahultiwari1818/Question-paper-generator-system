

let deleteQuesId = undefined;
let updateQuesId = undefined;
let deleteSubId = undefined;
let updateSubId = undefined;
let deleteClassId = undefined;
let updateClassId = undefined;
let deleteUserId = undefined;
let updateUserId = undefined;

// function debouncedSearch(){
//     let timeoutId;
    
//     return function(...args) {
//         clearTimeout(timeoutId);
//         timeoutId = setTimeout(() => {
//             searchQuestion.apply(this, args); 
//         }, 800);
//     };
// }

function searchQuestion(){
             let searchString = $("#searchQuestion").val();
             let type = $('#viewtype').val();
             fetch(`http://localhost/qpg/Partials/searchQuestion.php?question=${searchString}&type=${type}`)
             .then((res)=>res.json())
             .then((res)=>{
                 if(res?.data){
                     data = res.data;
                     let tbodyHtml = "";
                     if(data.length == 0){
                         tbodyHtml = " <p class='text-lg text-dark p-5'>No Data Found</p>";
                     }
                     data.forEach((question,idx) => {
                         let row = `<tr>
                                 <td class='border p-[10px]' >${idx+1}</td>
                                 <td class='border p-[10px]' >${question.q_type}</td>
                                 <td class='border p-[10px]' >${question.question}</td>
                                 <td class='border p-[10px]' >${question.options}</td>
                                 <td class='border p-[10px]' >${question.level}</td>
                                 <td class='border p-[10px]' >${question.weightage}</td>
                                 <td class='border p-[10px]' >${question.date_added}</td>
                                 <td class='border p-[10px]' onclick='showUpdateModal(${question.qId})'><img src='../Assets/Icons/EditIcon.svg' alt='' class='cursor-pointer' srcset=''></td>
                                 <td class='border p-[10px]' onclick='showDeleteModal(${question.qId})'><img src='../Assets/Icons/DeleteIcon.svg' alt='' class='cursor-pointer' srcset=''></td>
                             </tr>
                         `;
                         tbodyHtml+=row;
                     });
                     $("#questionsTbody").html(tbodyHtml);
                 }
             })
     
    // }
  
   
}


function showUpdateModal(id){
    $("#updateModal").show();
    updateQuesId = id;
}   


function closeUpdateModal(){
    $("#updateModal").hide();
    updateQuesId = undefined;
}




function showDeleteModal(id){
        $("#deleteCnfBox").show();
        deleteQuesId = id;
}

function closeDeleteModal(){
    $("#deleteCnfBox").hide();
    deleteQuesId = undefined;
}


function deleteQuestion(){

    let data = {
        id:deleteQuesId
    };

    fetch("http://localhost/qpg/Partials/deleteQuestion.php",{
        method:"POST",
        headers: {
            'Content-Type': 'application/json' // Set the content type to JSON for sending data as JSON
          },        
        body:JSON.stringify(data),
    })
    .then((res)=>res.json())
    .then((res)=>{
        if(res?.result == true){
            // alert(res.message);
            deleteQuesId = undefined;
            searchQuestion();
        }
    })
    .finally(()=>{
        closeDeleteModal();
    })


}


function checkEmailExists(){
    let email = $('#userEmail').val();

    fetch(`http://localhost/qpg/Partials/checkEmailExists.php?email=${email}`)
    .then(res=>res.json())
    .then((res)=>{
        if(res.exists){
            $("#userEmailErr").text(res.message);
            $("#submitBtn").attr("disabled",true);
        }
        else{
            $("#userEmailErr").text("");
            $("#submitBtn").attr("disabled",false);
        }
    })
}


function removeMsg(){
    console.log("clicked")
    $("#successMessage").remove();
}


function checkUsernameExists(){
    let username = $("#username").val();

    fetch(`http://localhost/qpg/Partials/checkUserName.php?username=${username}`)
    .then((res)=>res.json())
    .then((res)=>{
        if(res.exists){
            $("#usernameErr").text(res.message);
            $("#submitBtn").attr("disabled",true);
        }
        else{
            $("#usernameErr").text("");
            $("#submitBtn").attr("disabled",false);
        }
    })
}

function checkClassExists(){
    let className = $("#className").val();
    className = className.trim();
    fetch(`http://localhost/qpg/Partials/checkClassExists.php?className=${className}`)
    .then(res=>res.json())
    .then((res)=>{
        if(res?.exists){
            $("#classNameErr").text(res.message);
        }
        else{
            $("#classNameErr").text("");
        }
    })
}

function fetchClassesInSubject(){
    fetch("http://localhost/qpg/Partials/fetchClasses.php")
    .then(res=>res.json())
    .then(res=>{
        let data = res?.data;
        let rows = `<option value=""   <?php if($class=="") echo "selected"; ?>-------- Select Class -----------</option>`;
        // console.log(res)

        data.forEach((row)=>{
            let tr = `
                <option value="${row.cId}" >
            ${row.class}</option>
            `;
            rows+=tr;         
        })
        // console.log("called")
        $("#classInSubject").html(rows);
    })
}

function fetchClassesInUploadQuestion(){
    fetch("http://localhost/qpg/Partials/fetchClasses.php")
    .then(res=>res.json())
    .then(res=>{
        let data = res?.data;
        let rows = `<option value=""   <?php if($class=="") echo "selected"; ?>-------- Select Class -----------</option>`;
        // console.log(res)

        data.forEach((row)=>{
            let tr = `
                <option value="${row.cId}" >
            ${row.class}</option>
            `;
            rows+=tr;         
        })
        $("#classUPQ").html(rows)
    })
}







function checkSubjectExists(){
    fetch()
    .then(res=>res.json())
    .then(res=>{
        
    })
}

function fetchSubjectsClassWise(){
    let classId = $("#classUPQ").val();



    fetch(`http://localhost/qpg/Partials/fetchSubjectsClassWise.php?class=${classId}`)
    .then(res=>res.json())
    .then(res=>{
        let data = res?.data;
        let rows = `<option value=""   <?php if($sub=="") echo "selected"; ?>-------- Select Subject -----------</option>`;
        // console.log(res)
        console.log(res)
        data.forEach((row)=>{
            let tr = `
                <option value="${row.sId}" >
            ${row.subject}</option>
            `;
            rows+=tr;         
        })
        $("#subUPQ").html(rows)
    })
}

function fetchSubjects(){
    fetch("http://localhost/qpg/Partials/fetchSubjects.php")
    .then(res=>res.json())
    .then(res=>{
        let data = res?.data;
        let srno  = 1;
        let rows = "";
        console.log(res)
        data.forEach((row)=>{
            let tr = `<tr>
                <td class="border p-[10px]">${srno}</td>
                <td class="border p-[10px]">${row.subject}</td>
                <td class="border p-[10px]">${row.class}</td>
                <td class='border p-[10px]' onclick='showUpdateModal(${row.sId})'><img src='../Assets/Icons/EditIcon.svg' alt='' class='cursor-pointer' srcset=''></td>
                <td class='border p-[10px]' onclick='openSubjectDeleteModal(${row.sId})'><img src='../Assets/Icons/DeleteIcon.svg' alt='' class='cursor-pointer' srcset=''></td>
                </tr>
            `;
            rows+=tr;
            srno+=1;            
        })
        // console.log("called")
        $("#subjectTableTbody").html(rows);
    })
}


function displayClassesInTable(){
    fetch("http://localhost/qpg/Partials/fetchClasses.php")
    .then(res=>res.json())
    .then(res=>{
        let data = res?.data;
        let srno  = 1;
        let rows = "";
        // console.log(res)
        data.forEach((row)=>{
            let tr = `<tr>
                <td class="border p-[10px]">${srno}</td>
                <td class="border p-[10px]">${row.class}</td>
                <td class='border p-[10px]' onclick='showUpdateModal(${row.cId})'><img src='../Assets/Icons/EditIcon.svg' alt='' class='cursor-pointer' srcset=''></td>
                <td class='border p-[10px]' onclick='openClassDeleteModal(${row.cId})'><img src='../Assets/Icons/DeleteIcon.svg' alt='' class='cursor-pointer' srcset=''></td>
                </tr>
            `;
            rows+=tr;
            srno+=1;            
        })
        // console.log("called")
        $("#classTableTbody").html(rows);
    })
}
 
function openClassDeleteModal(id){
    $("#deleteClassCnfBox").show();
    deleteClassId = id;
}

function closeClassDeleteModal(){
    $("#deleteClassCnfBox").hide();
    deleteClassId = undefined;
}


function openSubjectDeleteModal(id){
    $("#deleteSubjectCnfBox").show();
    deleteSubId = id;
}


function closeSubjectDeleteModal(){
    $("#deleteSubjectCnfBox").hide();
    deleteSubId = undefined;
}

function deleteSubject(){

    let data = {
        id:deleteSubId
    };

    fetch("http://localhost/qpg/Partials/deleteSubject.php",{
        method:"POST",
        headers: {
            'Content-Type': 'application/json' // Set the content type to JSON for sending data as JSON
          },        
        body:JSON.stringify(data),
    })
    .then((res)=>res.json())
    .then((res)=>{
        if(res?.result == true){
            // alert(res.message);
            deleteSubId = undefined;
            fetchSubjects();
            $("#successSDMessage").show();
            setTimeout(()=>{
                removeSDMsg();
            },3000)
        }
    })
    .finally(()=>{
        closeSubjectDeleteModal();
    })

}


function deleteClass(){

    let data = {
        id:deleteClassId
    };

    fetch("http://localhost/qpg/Partials/deleteClass.php",{
        method:"POST",
        headers: {
            'Content-Type': 'application/json' // Set the content type to JSON for sending data as JSON
          },        
        body:JSON.stringify(data),
    })
    .then((res)=>res.json())
    .then((res)=>{
        if(res?.result == true){
            // alert(res.message);
            deleteClassId = undefined;
            displayClassesInTable();
            $("#successCDMessage").show();
            setTimeout(()=>{
                removeCDMsg();
            },3000)
        }
    })
    .finally(()=>{
        closeClassDeleteModal();
    })

}

function fetchUsers(){

    fetch("http://localhost/qpg/Partials/fetchUsers.php")
    .then(res=>res.json())
    .then(res=>{
        let data = res?.data;
        let srno  = 1;
        let rows = "";
        // console.log(res)
        data.forEach((row)=>{
            let tr = `<tr>
                <td class="border p-[10px]">${srno}</td>
                <td class="border p-[10px]">${row.fname}</td>
                <td class="border p-[10px]">${row.lname}</td>
                <td class="border p-[10px]">${row.phno}</td>
                <td class="border p-[10px]">${row.email}</td>
                <td class="border p-[10px]">${row.gender}</td>
                <td class="border p-[10px]">${row.username}</td>
                <td class='border p-[10px]' onclick=''><img src='../Assets/Icons/EditIcon.svg' alt='' class='cursor-pointer' srcset=''></td>
                <td class='border p-[10px]' onclick='openUserDeleteModal(${row.uId})'><img src='../Assets/Icons/DeleteIcon.svg' alt='' class='cursor-pointer' srcset=''></td>
                </tr>
            `;
            rows+=tr;
            srno+=1;            
        })
        // console.log("called")
        $("#viewUsersTbody").html(rows);
    })

}

function openUserDeleteModal(id){
    $("#deleteUserCnfModal").show();
    deleteUserId = id;
}

function closeUserDeleteModal(){
    $("#deleteUserCnfModal").hide();
    deleteUserId = undefined;
}


function deleteUser(){

    let data = {
        id:deleteUserId
    };

    // console.log(data);

    fetch("http://localhost/qpg/Partials/deleteUser.php",{
        method:"POST",
        headers: {
            'Content-Type': 'application/json' // Set the content type to JSON for sending data as JSON
          },        
        body:JSON.stringify(data),
    })
    .then((res)=>res.json())
    .then((res)=>{
        if(res?.result == true){
            // alert(res.message);
            deleteUserId = undefined;
            fetchUsers();
            $("#successUserDeletionMessage").show();

            setTimeout(()=>{
                removeUDMsg();
            },3000)

        }
    })
    .finally(()=>{
        closeUserDeleteModal();
    })
}

function removeUDMsg(){
    $("#successUserDeletionMessage").hide();

}

function removeSIMsg(){
    $("#successSIMessage").hide();
}

function removeSDMsg(){
    $("#successSDMessage").hide();
}
function removeCDMsg(){
    $("#successCDMessage").hide();
}