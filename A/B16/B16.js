let todos = [];

const loadData = ()=>{
    fetch('todos.json')
    .then((res)=>res.json())
    .then(data=>{
        todos = data.todos;

        const counts = countTodo(todos);

        document.querySelector('#totalCount').textContent = counts.total;
        document.querySelector('#completedCount').textContent = counts.complete;
        document.querySelector('#pendingCount').textContent = counts.pending;

        createItem(todos);

        const filterBtn = document.querySelectorAll('button');
        filterBtn.forEach(e =>{
            e.onclick = () =>{
                filterBtn.forEach(b => {
                    b.classList.remove('active');
                })
                e.classList.add('active');

                if (e.textContent === "전체") {
                    createItem(todos);
                }else if (e.textContent === "진행중"){
                    createItem(todos.filter(row => row.completed === false));
                }else if(e.textContent === "완료"){
                    createItem(todos.filter(row => row.completed === true));
                }else if(e.textContent === "높은 우선순위"){
                    createItem(todos.filter(row => row.priority === 'high'));
                }
            }
        })
    })
}

window.onload = loadData;

const countTodo = (todos)=>{
    const total = todos.length;
    const complete = todos.filter(row => row.completed == true).length;
    const pending = todos.filter(row => row.completed == false).length;

    return {total, complete, pending};
}

const createItem = (todos) =>{
    document.querySelector('.todo-list').innerHTML = "";
    todos.forEach(element => {
        document.querySelector('.todo-list').innerHTML += `
                <div class="todo-item ${element.completed ? 'completed' : ''}">
                    <div class="todo-header">
                        <h3 class="todo-title">${element.title}</h3>
                        <div class="todo-badges">
                            <span class="badge priority-${element.priority}">${element.priority ==='high'? '높음' : element.completed ==='medium' ? '보통' : '낮음'}</span>
                            <span class="badge status-badge">${element.completed ? '완료' : '진행중'}</span>
                        </div>
                    </div>
                    <p class="todo-description">${element.description}</p>
                    <div class="todo-footer">
                        <div class="date-info">
                            <span>📅 마감: ${element.dueDate}</span>
                            <span>📝 생성: ${element.createdAt}</span>
                        </div>
                    </div>
                </div>`
    });
}