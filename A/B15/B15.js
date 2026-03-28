let datas = [];
let currentPage = 1;

const loadCSV = ()=>{
    fetch('sample-data.csv')
    .then((res)=> res.text())
    .then(csvText=>{
        const lines = csvText.trim().split('\n');
    
        datas = lines.slice(1).map(line=>{
            const [name, age, job, city, salary] = line.split(',');
            return {name, age, job, city, salary};
        })
        
        table();
    })
}

const table = ()=>{
    const tableBody = document.querySelector('#tableBody');
    tableBody.innerHTML = '';
    const startIndex = ((currentPage-1)*10);
    const endIndex = startIndex + 10;

    const pageDatas = datas.slice(startIndex, endIndex);

    pageDatas.forEach(data=>{
        const row = `<tr><td>${data.name}</td><td>${data.age}</td><td>${data.job}</td><td>${data.city}</td><td>${data.salary}</td></tr>`;
        tableBody.innerHTML += row;
    })
    buttonEvent();
}

const buttonEvent = ()=>{
    const btns = document.querySelectorAll('button');

    btns.forEach(btn =>{
        const btnText = btn.textContent;
        btn.classList.remove('active');

        if(btnText === "이전"){
            btn.onclick = ()=>{
                currentPage -= 1;                    
                table();
            }
            btn.disabled = (currentPage === 1);
        }
        else if(btnText === "다음"){
            btn.onclick = ()=>{
                currentPage += 1;
                table();
            }
            btn.disabled = (currentPage === 5);
        }
        else{
            const pageNum = Number(btnText);
            if(currentPage===pageNum) btn.classList.add('active');
            btn.onclick = ()=>{
                currentPage = pageNum;
                table();
            }
        }
    })
}


window.onload = loadCSV;