

let deleteId = undefined;
let updateId = undefined;


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
    updateId = id;
}   


function closeUpdateModal(){
    $("#updateModal").hide();
    updateId = undefined;
}




function showDeleteModal(id){
        $("#deleteCnfBox").show();
        deleteId = id;
}

function closeDeleteModal(){
    $("#deleteCnfBox").hide();
    deleteId = undefined;
}


function deleteQuestion(){

    let data = {
        id:deleteId
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
            alert(res.message);
            deleteId = undefined;
            searchQuestion();
        }
    })
    .finally(()=>{
        closeDeleteModal();
    })


}

