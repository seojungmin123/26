const display = document.querySelector('.display');
const prevBtn = document.querySelector('.prev');
const nextBtn = document.querySelector('.next');
const days = document.querySelector('.days');

const dateToday = new Date();

let year = dateToday.getFullYear();
let month = dateToday.getMonth();

const displayCalendar = ()=>{
    display.innerHTML = '';
    days.innerHTML = '';

    const firstDay = new Date(year, month, 1);
    const firstDayIndex = firstDay.getDay();
    const lastDay = new Date(year, month+1, 0);
    const numbersOfDays = lastDay.getDate();

    display.innerHTML = `${year}년 ${month+1}월`;

    for(let i=1; i<=firstDayIndex; i++){
        const div = document.createElement('div');
        div.classList.add('empty');
        days.appendChild(div);
    }
    for(let i=1; i<=numbersOfDays; i++){
        const div = document.createElement('div');
        div.innerHTML = i;
        days.appendChild(div);

        const currentDate = new Date(year, month, i);
        
        if(
            currentDate.getFullYear() === new Date().getFullYear() &&
            currentDate.getMonth() === new Date().getMonth()&&
            currentDate.getDate() === new Date().getDate()
        ){
            div.classList.add('today');
        }
        if(currentDate.getDay()=== 0){
            div.classList.add('sunday');
        }else if(currentDate.getDay()=== 6){
            div.classList.add('saturday');
        }
    }
}

displayCalendar();

prevBtn.addEventListener('click',()=>{
    dateToday.setMonth(dateToday.getMonth() - 1);
    year = dateToday.getFullYear();
    month = dateToday.getMonth();
    displayCalendar();
})
nextBtn.addEventListener('click',()=>{
    dateToday.setMonth(dateToday.getMonth() + 1);
    year = dateToday.getFullYear();
    month = dateToday.getMonth();

    displayCalendar();
})