function filterByType(){
    let type = $('#viewtype').val();
    fetch(`http://localhost/qpg/Partials/filterByType.php?type=${type}`)
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
                    </tr>
                `;
                tbodyHtml+=row;
            });
            $("#questionsTbody").html(tbodyHtml);
        }
    })
}




function searchQuestion(){
    let searchString = $("#searchQuestion").val();
    fetch(`http://localhost/qpg/Partials/searchQuestion.php?question=${searchString}`)
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
                    </tr>
                `;
                tbodyHtml+=row;
            });
            $("#questionsTbody").html(tbodyHtml);
        }
    })
}