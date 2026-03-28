let chartDatas = {
    label:[],
    data:[],
    color:[]
};

const labelInput = document.querySelector('#labelInput');
const valueInput = document.querySelector('#valueInput');
const legendContainer = document.querySelector('.legend');
const addBtn = document.querySelector('button:not(.clear-btn)');
const clearBtn = document.querySelector('.clear-btn');

addBtn.addEventListener('click',()=>{
    if(labelInput.value != '' && valueInput.value != ''){
        chartDatas.label.push(labelInput.value);
        chartDatas.data.push(Number(valueInput.value));
        chartDatas.color.push(randomColor());
        labelInput.value = '';
        valueInput.value = '';
        draw();
    }
})

clearBtn.addEventListener('click',()=>{
    chartDatas.data = [];
    chartDatas.label = [];
    chartDatas.color = [];

    draw();
})

const draw = ()=>{
    legendContainer.innerHTML ='';

    const ctx = canvas.getContext("2d");

    ctx.clearRect(0,0,canvas.width, canvas.height);
    const total = chartDatas.data.reduce((a,b)=> a + b, 0);
    let startAngle = -Math.PI / 2;

    chartDatas.data.forEach((value,index)=>{
        const sliceAngle = (value/total) * (Math.PI * 2) ;
        const percent = Math.round((value/total) * 100);

        ctx.beginPath();
        ctx.moveTo(canvas.width / 2, canvas.height /2);
        ctx.arc(canvas.width / 2, canvas.height / 2, 150, startAngle, startAngle + sliceAngle);
        ctx.closePath();
        ctx.fillStyle = chartDatas.color[index];
        ctx.fill();

        startAngle += sliceAngle;

        const legend = document.createElement('div');
        legend.className = 'legend-item';
        legend.innerHTML = `<div class="legend-color" style="background-color: ${chartDatas.color[index]}"></div><span>${chartDatas.label[index]} (${percent}%)</span>`
        legendContainer.appendChild(legend);

    })
}

const randomColor = ()=>{
    const rgb = `rgb(${Math.floor(Math.random()*256)}, ${Math.floor(Math.random()*256)}, ${Math.floor(Math.random()*256)})`
    return rgb;
}   
