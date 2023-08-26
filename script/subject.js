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
                <td class='border p-[10px] cursor-pointer' onclick='showSubjectUpdateModal(${row.sId})'>
                
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.8577 5.65576L12.4828 2.31158L13.7962 0.998133C14.0834 0.710966 14.4372 0.567383 14.8577 0.567383C15.2782 0.567383 15.6321 0.710966 15.9192 0.998133L17.1558 2.23466C17.4429 2.52182 17.5917 2.87053 17.6019 3.28078C17.6122 3.69103 17.4737 4.03974 17.1865 4.32691L15.8577 5.65576ZM14.7731 6.75573L4.02886 17.5H0.653931V14.125L11.3982 3.38078L14.7731 6.75573Z" fill="#0000FF"/>
             </svg>

                </td>
                <td class='border p-[10px] cursor-pointer' onclick='openSubjectDeleteModal(${row.sId})'>
                <svg width="10" height="12" viewBox="0 0 10 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.87183 11.6666C1.53507 11.6666 1.25003 11.55 1.0167 11.3166C0.783364 11.0833 0.666697 10.7983 0.666697 10.4615V1.99999H3.05176e-05V1.00001H3.00001V0.410278H7.00001V1.00001H10V1.99999H9.33333V10.4615C9.33333 10.7983 9.21667 11.0833 8.98333 11.3166C8.75 11.55 8.46495 11.6666 8.1282 11.6666H1.87183ZM3.26926 9.33333H4.26925V3.33333H3.26926V9.33333ZM5.73078 9.33333H6.73076V3.33333H5.73078V9.33333Z" fill="#D2382D"/>
                </svg>
                </td>
                </tr>
            `;
            rows+=tr;
            srno+=1;            
        })

        // console.log("called")
        $("#subjectTableTbody").html(rows);
    })
}


function showSubjectUpdateModal(id){
    $("#updateSubjectModal").show();
    fetchClassesInSubject("UpdateClassInSubject",id);
    updateSubId = id;
    fetch(`http://localhost/qpg/Partials/fetchSpecificSubject.php?id=${id}`)
    .then(res=>res.json())
    .then(res=>{
        // console.log(res)
        let data = res.data[0];
        $("#updateSubject").val(data.subject);
        $("#updateSubType").val(data.type);
        fetchClassesInSubject("UpdateClassInSubject",data.cId);
    });
}

function closeSubjectUpdateModal(){
    $("#updateSubjectModal").hide();
    updateSubId = undefined;
}

function removeSubUpdMsg(){
    $("#successSubUpdMessage").hide();

}

function updateSubject(){
    let data = {
        'id':updateSubId,
        'subject':$("#updateSubject").val(),
        'type':$("#updateSubType").val(),
        'class':$("#UpdateClassInSubject").val(),
    }

    fetch("http://localhost/qpg/Partials/updateSubject.php",{
        method:"POST",
        headers: {
            'Content-Type': 'application/json' // Set the content type to JSON for sending data as JSON
          },        
        body:JSON.stringify(data),
    })
    .then(res=>res.json())
    .then(res=>{
        if(res.result){
            fetchSubjects();
            closeSubjectUpdateModal();
            $("#successSubUpdMessage").show();

            setTimeout(()=>{
                removeSubUpdMsg();
            },3000);
        }
        else{
            closeClassUpdateModal();
            // alert(res.message);
        }
    })
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

function removeSIMsg(){
    $("#successSIMessage").hide();
}

function removeSDMsg(){
    $("#successSDMessage").hide();
}

function checkSubjectExists(){
    fetch()
    .then(res=>res.json())
    .then(res=>{
        
    })
}

function fetchClassesInSubject(ctrlId,sid){
    fetch("http://localhost/qpg/Partials/fetchClasses.php")
    .then(res=>res.json())
    .then(res=>{
        let data = res?.data;
        let rows = `<option value=""   <?php if($class=="") echo "selected"; ?>-------- Select Class -----------</option>`;
        // console.log(res)

        data.forEach((row)=>{
            let tr = sid && sid == row.cId ? `<option value="${row.cId}"  selected>${row.class}</option>`: `<option value="${row.cId}" >${row.class}</option>` ;
            rows+=tr;         
        })
        // console.log("called")
        $("#viewClass").html(rows);
        $("#"+ctrlId).html(rows);
    })
}
