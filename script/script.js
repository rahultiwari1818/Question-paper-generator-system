

let deleteQuesId = undefined;
let updateQuesId = undefined;
let deleteSubId = undefined;
let updateSubId = undefined;
let deleteClassId = undefined;
let updateClassId = undefined;
let deleteUserId = undefined;
let updateUserId = undefined;



// --------------------- Debouoncing Function for Db search ----------------------------------

// function debouncedSearch(){
//     let timeoutId;

//     return function(...args) {
//         clearTimeout(timeoutId);
//         timeoutId = setTimeout(() => {
//             searchQuestion.apply(this, args); 
//         }, 800);
//     };
// }

// -----------------------------------------------------------------------------------------------

// ----------------------- Functions Related to Users -----------------------------------------

function fetchUsers() {

    fetch("http://localhost/qpg/Partials/fetchUsers.php")
        .then(res => res.json())
        .then(res => {
            let data = res?.data;
            if (data.length == 0) {
                $("#viewUsersTbody").html("<tr><td colspan='9'><p class='text-xl text-center'>No Users Found</p></td></tr>");
            }
            else {
                let srno = 1;
                let rows = "";
                // console.log(res)
                data.forEach((row) => {
                    let tr = `<tr>
                    <td class="border p-[10px]">${srno}</td>
                    <td class="border p-[10px]">${row.fname}</td>
                    <td class="border p-[10px]">${row.lname}</td>
                    <td class="border p-[10px]">${row.phno}</td>
                    <td class="border p-[10px]">${row.email}</td>
                    <td class="border p-[10px]">${row.gender}</td>
                    <td class="border p-[10px]">${row.username}</td>
                    
                <td class='border p-[10px] cursor-pointer' onclick=''>
                <a href="../Partials/updateProfile.php?user=${row.uId}">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.8577 5.65576L12.4828 2.31158L13.7962 0.998133C14.0834 0.710966 14.4372 0.567383 14.8577 0.567383C15.2782 0.567383 15.6321 0.710966 15.9192 0.998133L17.1558 2.23466C17.4429 2.52182 17.5917 2.87053 17.6019 3.28078C17.6122 3.69103 17.4737 4.03974 17.1865 4.32691L15.8577 5.65576ZM14.7731 6.75573L4.02886 17.5H0.653931V14.125L11.3982 3.38078L14.7731 6.75573Z" fill="#0000FF"/>
                                </svg>
                </a>
                </td>
                    <td class='border p-[10px] cursor-pointer' onclick='openUserDeleteModal(${row.uId})'>
                    <svg width="10" height="12" viewBox="0 0 10 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.87183 11.6666C1.53507 11.6666 1.25003 11.55 1.0167 11.3166C0.783364 11.0833 0.666697 10.7983 0.666697 10.4615V1.99999H3.05176e-05V1.00001H3.00001V0.410278H7.00001V1.00001H10V1.99999H9.33333V10.4615C9.33333 10.7983 9.21667 11.0833 8.98333 11.3166C8.75 11.55 8.46495 11.6666 8.1282 11.6666H1.87183ZM3.26926 9.33333H4.26925V3.33333H3.26926V9.33333ZM5.73078 9.33333H6.73076V3.33333H5.73078V9.33333Z" fill="#D2382D"/>
                    </svg>
                    </td>

                    </tr>
                `;
                    rows += tr;
                    srno += 1;
                })
                // console.log("called")
                $("#viewUsersTbody").html(rows);

            }
        })

}

function openUserDeleteModal(id) {
    $("#deleteUserCnfModal").show();
    deleteUserId = id;
}

function closeUserDeleteModal() {
    $("#deleteUserCnfModal").hide();
    deleteUserId = undefined;
}


function deleteUser() {

    let data = {
        id: deleteUserId
    };

    // console.log(data);

    fetch("http://localhost/qpg/Partials/deleteUser.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json' // Set the content type to JSON for sending data as JSON
        },
        body: JSON.stringify(data),
    })
        .then((res) => res.json())
        .then((res) => {
            if (res?.result == true) {
                // alert(res.message);
                deleteUserId = undefined;
                fetchUsers();
                $("#successUserDeletionMessage").show();

                setTimeout(() => {
                    removeUDMsg();
                }, 3000)

            }
        })
        .finally(() => {
            closeUserDeleteModal();
        })
}

function removeUDMsg() {
    $("#successUserDeletionMessage").hide();
}

function removeProUpdMsg(){
    $("#successProUpdMessage").hide();
}

function removeUserProUpdMsg(){
    $("#successUserProUpdMessage").hide();
}

function checkEmailExists() {
    let email = $('#userEmail').val();

    fetch(`http://localhost/qpg/Partials/checkEmailExists.php?email=${email}`)
        .then(res => res.json())
        .then((res) => {
            if (res.exists) {
                $("#userEmailErr").text(res.message);
                $("#submitBtn").attr("disabled", true);
            }
            else {
                $("#userEmailErr").text("");
                $("#submitBtn").attr("disabled", false);
            }
        })
}

function checkUsernameExists() {
    let username = $("#username").val();

    fetch(`http://localhost/qpg/Partials/checkUserName.php?username=${username}`)
        .then((res) => res.json())
        .then((res) => {
            if (res.exists) {
                $("#usernameErr").text(res.message);
                $("#submitBtn").attr("disabled", true);
            }
            else {
                $("#usernameErr").text("");
                $("#submitBtn").attr("disabled", false);
            }
        })
}


function searchUser(){
   let searchVal =  $("#searchUser").val();

   fetch(`http://localhost/qpg/Partials/searchUser.php?search=${searchVal}`)
   .then(res=>res.json())
   .then(res=>{
    let data = res?.data;
    if (data.length == 0) {
        $("#viewUsersTbody").html("<tr><td colspan='9'><p class='text-xl text-center'>No Users Found</p></td></tr>");
    }
    else {
        let srno = 1;
        let rows = "";
        // console.log(res)
        data.forEach((row) => {
            let tr = `<tr>
            <td class="border p-[10px]">${srno}</td>
            <td class="border p-[10px]">${row.fname}</td>
            <td class="border p-[10px]">${row.lname}</td>
            <td class="border p-[10px]">${row.phno}</td>
            <td class="border p-[10px]">${row.email}</td>
            <td class="border p-[10px]">${row.gender}</td>
            <td class="border p-[10px]">${row.username}</td>
            <td class='border p-[10px] cursor-pointer' onclick=''>
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.8577 5.65576L12.4828 2.31158L13.7962 0.998133C14.0834 0.710966 14.4372 0.567383 14.8577 0.567383C15.2782 0.567383 15.6321 0.710966 15.9192 0.998133L17.1558 2.23466C17.4429 2.52182 17.5917 2.87053 17.6019 3.28078C17.6122 3.69103 17.4737 4.03974 17.1865 4.32691L15.8577 5.65576ZM14.7731 6.75573L4.02886 17.5H0.653931V14.125L11.3982 3.38078L14.7731 6.75573Z" fill="#0000FF"/>
            </svg>
            </td>
            <td class='border p-[10px] cursor-pointer' onclick='openUserDeleteModal(${row.uId})'>
            <svg width="10" height="12" viewBox="0 0 10 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.87183 11.6666C1.53507 11.6666 1.25003 11.55 1.0167 11.3166C0.783364 11.0833 0.666697 10.7983 0.666697 10.4615V1.99999H3.05176e-05V1.00001H3.00001V0.410278H7.00001V1.00001H10V1.99999H9.33333V10.4615C9.33333 10.7983 9.21667 11.0833 8.98333 11.3166C8.75 11.55 8.46495 11.6666 8.1282 11.6666H1.87183ZM3.26926 9.33333H4.26925V3.33333H3.26926V9.33333ZM5.73078 9.33333H6.73076V3.33333H5.73078V9.33333Z" fill="#D2382D"/>
            </svg>
            </td>

            </tr>
        `;
            rows += tr;
            srno += 1;
        })
        // console.log("called")
        $("#viewUsersTbody").html(rows);
    }
   })
}

function openUpdatePasswordModal(){
    $("#passwordUpdateModal").show();
}

function closeUpdatePasswordModal(){
    $("#passwordUpdateModal").hide();

    $("#currentPassword").val("");
   $("#newPassword").val("");
}

function removePswdUpdMsg(){
    $("#successPasswdUpdMsg").hide();
}

function updatePassword(){
    let currentPassword = $("#currentPassword").val();
    let newPassword = $("#newPassword").val();

    let data = {
        oldPassword:currentPassword,
        newPassword:newPassword,
    };


    fetch("http://localhost/qpg/Partials/updatePassword.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json' // Set the content type to JSON for sending data as JSON
        },
        body: JSON.stringify(data),
    })
        .then(res => res.json())
        .then(res => {
            if (res.result) {
                $("#successPasswdUpdMsg").show();

                setTimeout(() => {
                    removePswdUpdMsg();
                }, 3000);
                closeUpdatePasswordModal();

            }
            else {
                $("#errorMsg").text(res.message);
            }
        })
        .finally(()=>{
        })
}

// -----------------------------------------------------------------------------------------------


// ------------------------------ Functions Related to Classes -----------------------------------------------

function displayClassesInTable() {
    fetch("http://localhost/qpg/Partials/fetchClasses.php")
        .then(res => res.json())
        .then(res => {
            let data = res?.data;
            let srno = 1;
            let rows = "";
            // console.log(res)
            data.forEach((row) => {
                let tr = `<tr>
                <td class="border p-[10px]">${srno}</td>
                <td class="border p-[10px]">${row.class}</td>
                <td class='border p-[10px] cursor-pointer' onclick='openClassUpdateModal(${row.cId})'>
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.8577 5.65576L12.4828 2.31158L13.7962 0.998133C14.0834 0.710966 14.4372 0.567383 14.8577 0.567383C15.2782 0.567383 15.6321 0.710966 15.9192 0.998133L17.1558 2.23466C17.4429 2.52182 17.5917 2.87053 17.6019 3.28078C17.6122 3.69103 17.4737 4.03974 17.1865 4.32691L15.8577 5.65576ZM14.7731 6.75573L4.02886 17.5H0.653931V14.125L11.3982 3.38078L14.7731 6.75573Z" fill="#0000FF"/>
             </svg>                </td>
                <td class='border p-[10px] cursor-pointer' onclick='openClassDeleteModal(${row.cId})'>
                    <svg width="10" height="12" viewBox="0 0 10 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.87183 11.6666C1.53507 11.6666 1.25003 11.55 1.0167 11.3166C0.783364 11.0833 0.666697 10.7983 0.666697 10.4615V1.99999H3.05176e-05V1.00001H3.00001V0.410278H7.00001V1.00001H10V1.99999H9.33333V10.4615C9.33333 10.7983 9.21667 11.0833 8.98333 11.3166C8.75 11.55 8.46495 11.6666 8.1282 11.6666H1.87183ZM3.26926 9.33333H4.26925V3.33333H3.26926V9.33333ZM5.73078 9.33333H6.73076V3.33333H5.73078V9.33333Z" fill="#D2382D"/>
                     </svg>           
                
                </td>
                </tr>

            `;
                rows += tr;
                srno += 1;
            })
            // console.log("called")
            $("#classTableTbody").html(rows);
        })
}

function openClassDeleteModal(id) {
    $("#deleteClassCnfBox").show();
    deleteClassId = id;
}

function closeClassDeleteModal() {
    $("#deleteClassCnfBox").hide();
    deleteClassId = undefined;
}

function deleteClass() {

    let data = {
        id: deleteClassId
    };

    fetch("http://localhost/qpg/Partials/deleteClass.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json' // Set the content type to JSON for sending data as JSON
        },
        body: JSON.stringify(data),
    })
        .then((res) => res.json())
        .then((res) => {
            if (res?.result == true) {
                // alert(res.message);
                deleteClassId = undefined;
                displayClassesInTable();
                $("#successCDMessage").show();
                setTimeout(() => {
                    removeCDMsg();
                }, 3000)
            }
        })
        .finally(() => {
            closeClassDeleteModal();
        })

}


function openClassUpdateModal(id) {
    $("#updateClassModal").show();
    updateClassId = id;
    fetch(`http://localhost/qpg/Partials/fetchSpecificClass.php?id=${updateClassId}`)
        .then(res => res.json())
        .then(res => {
            if (res.result) {
                console.log(res)
                let data = res.data[0];
                // console.log(data.class)
                $("#updateClassName").val(data.class);
            }
        })

}



function closeClassUpdateModal() {
    $("#updateClassModal").hide();
    updateClassId = undefined;
}

function removeCUpdMsg() {
    $("#successCUpdMessage").hide();
}

function updateClass() {
    // console.log("function")
    let data = {
        id: updateClassId,
        class: $("#updateClassName").val(),
    }

    fetch("http://localhost/qpg/Partials/updateClass.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json' // Set the content type to JSON for sending data as JSON
        },
        body: JSON.stringify(data),
    })
        .then(res => res.json())
        .then(res => {
            if (res.result) {
                displayClassesInTable();
                closeClassUpdateModal();
                $("#successCUpdMessage").show();

                setTimeout(() => {
                    removeCUpdMsg();
                }, 3000);
            }
            else {
                closeClassUpdateModal();
                // alert(res.message);
            }
        })
}

function removeCDMsg() {
    $("#successCDMessage").hide();
}

function checkClassExists(txtId, errId) {
    let className = $("#" + txtId).val();
    className = className.trim();
    fetch(`http://localhost/qpg/Partials/checkClassExists.php?className=${className}`)
        .then(res => res.json())
        .then((res) => {
            if (res?.exists) {
                $("#" + errId).text(res.message);
            }
            else {
                $("#" + errId).text("");
            }
        })
}


// -----------------------------------------------------------------------------------------------------------
// --------------------------------- Functions Related to Subjects ------------------------------------------------------

function fetchSubjects() {
    fetch("http://localhost/qpg/Partials/fetchSubjects.php")
        .then(res => res.json())
        .then(res => {
            let data = res?.data;
            let srno = 1;
            let rows = "";
            console.log(res)
            data.forEach((row) => {
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
                rows += tr;
                srno += 1;
            })

            // console.log("called")
            $("#subjectTableTbody").html(rows);
        })
}


function showSubjectUpdateModal(id) {
    $("#updateSubjectModal").show();
    fetchClassesInSubject("UpdateClassInSubject", id);
    updateSubId = id;
    fetch(`http://localhost/qpg/Partials/fetchSpecificSubject.php?id=${id}`)
        .then(res => res.json())
        .then(res => {
            // console.log(res)
            let data = res.data[0];
            $("#updateSubject").val(data.subject);
            $("#updateSubType").val(data.type);
            fetchClassesInSubject("UpdateClassInSubject", data.cId);
        });
}

function closeSubjectUpdateModal() {
    $("#updateSubjectModal").hide();
    updateSubId = undefined;
}

function removeSubUpdMsg() {
    $("#successSubUpdMessage").hide();

}

function updateSubject() {
    let data = {
        'id': updateSubId,
        'subject': $("#updateSubject").val(),
        'type': $("#updateSubType").val(),
        'class': $("#UpdateClassInSubject").val(),
    }

    fetch("http://localhost/qpg/Partials/updateSubject.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json' // Set the content type to JSON for sending data as JSON
        },
        body: JSON.stringify(data),
    })
        .then(res => res.json())
        .then(res => {
            if (res.result) {
                fetchSubjects();
                closeSubjectUpdateModal();
                $("#successSubUpdMessage").show();

                setTimeout(() => {
                    removeSubUpdMsg();
                }, 3000);
            }
            else {
                closeClassUpdateModal();
                // alert(res.message);
            }
        })
}


function openSubjectDeleteModal(id) {
    $("#deleteSubjectCnfBox").show();
    deleteSubId = id;
}


function closeSubjectDeleteModal() {
    $("#deleteSubjectCnfBox").hide();
    deleteSubId = undefined;
}

function deleteSubject() {

    let data = {
        id: deleteSubId
    };

    fetch("http://localhost/qpg/Partials/deleteSubject.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json' // Set the content type to JSON for sending data as JSON
        },
        body: JSON.stringify(data),
    })
        .then((res) => res.json())
        .then((res) => {
            if (res?.result == true) {
                // alert(res.message);
                deleteSubId = undefined;
                fetchSubjects();
                $("#successSDMessage").show();
                setTimeout(() => {
                    removeSDMsg();
                }, 3000)
            }
        })
        .finally(() => {
            closeSubjectDeleteModal();
        })

}

function removeSIMsg() {
    $("#successSIMessage").hide();
}

function removeSDMsg() {
    $("#successSDMessage").hide();
}

function checkSubjectExists() {
    fetch()
        .then(res => res.json())
        .then(res => {

        })
}

function fetchClassesInSubject(ctrlId, sid) {
    fetch("http://localhost/qpg/Partials/fetchClasses.php")
        .then(res => res.json())
        .then(res => {
            let data = res?.data;
            let rows = `<option value=""    <?php if($class=="") echo "selected"; ?>-------- Select Class -----------</option>`;
            // console.log(res)

            data.forEach((row) => {
                let tr = sid && sid == row.cId ? `<option value="${row.cId}"  selected>${row.class}</option>` : `<option value="${row.cId}" >${row.class}</option>`;
                rows += tr;
            })
            // console.log("called")
            $("#viewClass").html(rows);
            $("#" + ctrlId).html(rows);
        })
}


// -----------------------------------------------------------------------------------------------------------

// ---------------------------------- Functions Realted to Questions --------------------------------------------------

function searchQuestion() {
    let searchString = $("#searchQuestion").val();
    let type = $('#viewtype').val();
    let _class = $("#viewClass").val();
    let subject = $("#viewSubject").val();

    fetch(`http://localhost/qpg/Partials/searchQuestion.php?question=${searchString}&type=${type}&class=${_class}&subject=${subject}`)
        .then((res) => res.json())
        .then((res) => {
            console.log(res)
            if (res?.data) {
                data = res.data;
                let tbodyHtml = "";
                console.log(data);
                if (data.length == 0) {
                    console.log("hey")
                    $("#questionsTbody").html("<tr><td colspan='9'><p class='text-xl text-center'>No Data Found</p></td></tr>");
                }
                else {
                    data.forEach((question, idx) => {
                        let row = "";
                        if (question.q_type != "mcqs") {
                            row = `<tr>
                           <td class='border p-[10px]' >${idx + 1}</td>
                           <td class='border p-[10px]' >${question.q_type}</td>
                           <td class='border p-[10px]' >${question.question}</td>
                           <td class='border p-[10px]' >${question.option1}</td>
                           <td class='border p-[10px]' >${question.chapter}</td>
                           <td class='border p-[10px]' >${question.subject}</td>
                           <td class='border p-[10px]' >${question.class}</td>
                           <td class='border p-[10px]' >${question.level}</td>
                           <td class='border p-[10px]' >${question.weightage}</td>
                           <td class='border p-[10px]' >${question.date_added}</td>
                           <td class='border p-[10px] cursor-pointer' onclick='redirectToUpdate(${question.qId})'>
                           <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                               <path d="M15.8577 5.65576L12.4828 2.31158L13.7962 0.998133C14.0834 0.710966 14.4372 0.567383 14.8577 0.567383C15.2782 0.567383 15.6321 0.710966 15.9192 0.998133L17.1558 2.23466C17.4429 2.52182 17.5917 2.87053 17.6019 3.28078C17.6122 3.69103 17.4737 4.03974 17.1865 4.32691L15.8577 5.65576ZM14.7731 6.75573L4.02886 17.5H0.653931V14.125L11.3982 3.38078L14.7731 6.75573Z" fill="#0000FF"/>
                            </svg>
           
                           </td>
                           <td class='border p-[10px] cursor-pointer' onclick='showDeleteModal(${question.qId})'>
                           <svg width="10" height="12" viewBox="0 0 10 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                               <path d="M1.87183 11.6666C1.53507 11.6666 1.25003 11.55 1.0167 11.3166C0.783364 11.0833 0.666697 10.7983 0.666697 10.4615V1.99999H3.05176e-05V1.00001H3.00001V0.410278H7.00001V1.00001H10V1.99999H9.33333V10.4615C9.33333 10.7983 9.21667 11.0833 8.98333 11.3166C8.75 11.55 8.46495 11.6666 8.1282 11.6666H1.87183ZM3.26926 9.33333H4.26925V3.33333H3.26926V9.33333ZM5.73078 9.33333H6.73076V3.33333H5.73078V9.33333Z" fill="#D2382D"/>
                               </svg>
                           </td>
                       </tr>
                   `;
                        }
                        else {
                            row = `<tr>
                               <td class='border p-[10px]' >${idx + 1}</td>
                               <td class='border p-[10px]' >${question.q_type}</td>
                               <td class='border p-[10px]' >${question.question}</td>
                               <td class='border ' >
                               <div  class='border p-[4px]' >${question.option1}</div>
                               <div  class='border p-[4px]'>${question.option2}</div>
                               <div  class='border p-[4px]'>${question.option3}</div>
                               <div  class='border p-[4px]'>${question.option4}</div>
                               </td>
                           <td class='border p-[10px]' >${question.chapter}</td>
                           <td class='border p-[10px]' >${question.subject}</td>
                           <td class='border p-[10px]' >${question.class}</td>
                               <td class='border p-[10px]' >${question.level}</td>
                               <td class='border p-[10px]' >${question.weightage}</td>
                               <td class='border p-[10px]' >${question.date_added}</td>
                               <td class='border p-[10px] cursor-pointer' onclick='redirectToUpdate(${question.qId})'>
                               <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                   <path d="M15.8577 5.65576L12.4828 2.31158L13.7962 0.998133C14.0834 0.710966 14.4372 0.567383 14.8577 0.567383C15.2782 0.567383 15.6321 0.710966 15.9192 0.998133L17.1558 2.23466C17.4429 2.52182 17.5917 2.87053 17.6019 3.28078C17.6122 3.69103 17.4737 4.03974 17.1865 4.32691L15.8577 5.65576ZM14.7731 6.75573L4.02886 17.5H0.653931V14.125L11.3982 3.38078L14.7731 6.75573Z" fill="#0000FF"/>
                               </svg>
                               </td>
                               <td class='border p-[10px] cursor-pointer' onclick='showDeleteModal(${question.qId})'>
                               <svg width="10" height="12" viewBox="0 0 10 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                               <path d="M1.87183 11.6666C1.53507 11.6666 1.25003 11.55 1.0167 11.3166C0.783364 11.0833 0.666697 10.7983 0.666697 10.4615V1.99999H3.05176e-05V1.00001H3.00001V0.410278H7.00001V1.00001H10V1.99999H9.33333V10.4615C9.33333 10.7983 9.21667 11.0833 8.98333 11.3166C8.75 11.55 8.46495 11.6666 8.1282 11.6666H1.87183ZM3.26926 9.33333H4.26925V3.33333H3.26926V9.33333ZM5.73078 9.33333H6.73076V3.33333H5.73078V9.33333Z" fill="#D2382D"/>
                               </svg>
                               </td>
                           </tr>
                       `;
                        }
                        tbodyHtml += row;
                    });
                    $("#questionsTbody").html(tbodyHtml);
                }
            }
        })

    // }


}



function showDeleteModal(id) {
    $("#deleteCnfBox").show();
    deleteQuesId = id;
}

function closeDeleteModal() {
    $("#deleteCnfBox").hide();
    deleteQuesId = undefined;
}

function redirectToUpdate(id) {
    window.location.href = `http://localhost/qpg/Faculties/updateQuestion.php?question=${id}`;
}


function deleteQuestion() {

    let data = {
        id: deleteQuesId
    };

    fetch("http://localhost/qpg/Partials/deleteQuestion.php", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json' // Set the content type to JSON for sending data as JSON
        },
        body: JSON.stringify(data),
    })
        .then((res) => res.json())
        .then((res) => {
            if (res?.result == true) {
                // alert(res.message);
                deleteQuesId = undefined;
                searchQuestion();
                $("#successQDMessage").show();

                setTimeout(() => {
                    removeQDMsg();
                }, 3000)

            }
        })
        .finally(() => {
            closeDeleteModal();
        })


}


function removeMsg() {
    // console.log("clicked")
    $("#successMessage").remove();
}



function fetchClassesInUploadQuestion(id) {
    fetch("http://localhost/qpg/Partials/fetchClasses.php")
        .then(res => res.json())
        .then(res => {
            let data = res?.data;
            let rows = `<option value=""    <?php if($class=="") echo "selected"; ?>-------- Select Class -----------</option>`;
            // console.log(res)

            data.forEach((row) => {
                let tr = (id && id == row.cId) ? `<option value="${row.cId}" selected >${row.class}</option>` : `<option value="${row.cId}" >${row.class}</option>`;
                rows += tr;
            })
            $("#classUPQ").html(rows);
            $("#updateClassUPQ").html(rows);
        })
}



function fetchSubjectsClassWise(cId, subId) {
    console.log(subId, cId)
    let classId = (cId) ? cId : $("#classUPQ").val();
    console.log(subId, classId)

    fetch(`http://localhost/qpg/Partials/fetchSubjectsClassWise.php?class=${classId}`)
        .then(res => res.json())
        .then(res => {
            let data = res?.data;
            let rows = `<option value=""    <?php if($sub=="") echo "selected"; ?>-------- Select Subject -----------</option>`;
            // console.log(res)
            console.log(res)
            data.forEach((row) => {
                console.log(subId, subId == row.sId)
                let tr = subId && subId == row.sId ? `<option value="${row.sId}" selected >${row.subject}</option>` : `<option value="${row.sId}" >${row.subject}</option>`;
                rows += tr;
            })
            $("#subUPQ").html(rows)
            $("#updateSubUPQ").html(rows)
        })
}

function fetchSubjectsForView(divId,classId) {
    // let classId = $("#viewClass").val();



    fetch(`http://localhost/qpg/Partials/fetchSubjectsClassWise.php?class=${classId}`)
        .then(res => res.json())
        .then(res => {
            let data = res?.data;
            let rows = `<option value=""    <?php if($sub=="") echo "selected"; ?>-------- Select Subject -----------</option>`;
            // console.log(res)
            console.log(res)
            data.forEach((row) => {
                let tr = `
            <option value="${row.sId}" >
        ${row.subject}</option>
        `;
                rows += tr;
            })
            $("#"+divId).html(rows)
        })
}



function removeQDMsg() {
    $("#successQDMessage").hide();
}


function getQuestionData(id) {
    fetch(`http://localhost/qpg/Partials/getSpecificQuestion.php?qid=${id}`)
        .then(res => res.json())
        .then(res => {
            if (res.result) {
                // console.log(res)
                let data = res.data[0];
                $("#updateQuestion").text(data.question);
                $("#updateType").val(data.q_type);
                if (data.q_type == "mcqs") {
                    $("#updateOption1").val(data.option1);
                    $("#updateOption2").val(data.option2);
                    $("#updateOption3").val(data.option3);
                    $("#updateOption4").val(data.option4);
                }
                $("#updateWeightage").val(data.weightage);
                $("#updateChapter").val(data.chapter);
                $("#updateLevel").val(data.level);
                // console.log(data.weightage,"weightage")
                //to fetch classes
                fetchClassesInUploadQuestion(data.classId);
                fetchSubjectsClassWise(data?.classId, data?.subId)
            }
        })
}



// -----------------------------------------------------------------------------------------------------------



