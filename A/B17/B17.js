const input = document.querySelector('input');
const container = document.querySelector('.container');
const fileList = document.querySelector('.file-list');
let draggingItem = null;
let startIndex = null;

container.addEventListener('dragover',(e)=>{
    e.preventDefault();
    container.classList.add('dragover');
})
container.addEventListener('dragleave',(e)=>{
    e.preventDefault();
    container.classList.remove('dragover');
})
container.addEventListener('drop',(e)=>{
    e.preventDefault();
    container.classList.remove('dragover');
    handleFiles(e.dataTransfer.files);
})
input.addEventListener('change',(e)=>{
    handleFiles(e.target.files);
})

const createItem = (file)=>{
    const li = document.createElement('li');
    li.className = 'file';
    li.draggable = true;
    const fileSize = (file.size / 1024).toFixed(1) + "KB";
    li.innerHTML = `${file.name}(${fileSize})`

    dragEvent(li);
    fileList.appendChild(li);
}

const handleFiles = (files) =>{
    [...files].forEach(file =>{
        createItem(file);
    })
}

const dragEvent = (item)=>{
    item.addEventListener('dragstart',()=>{
        draggingItem = item;
        item.classList.add('dragging');

        const listArr = [...fileList.children];
        startIndex = listArr.indexOf(item);
    })
    item.addEventListener('dragend',()=>{
        draggingItem = null;
        item.classList.remove('dragging');
    })
    item.addEventListener('dragover',(e)=>{
        e.preventDefault();
        item.classList.add('dragover-item');
    })
    item.addEventListener('dragleave',(e)=>{
        e.preventDefault();
        item.classList.remove('dragover-item');
    })
    item.addEventListener('drop',(e)=>{
        e.preventDefault();
        item.classList.remove('dragover-item');
        if(item === draggingItem) return;
        const listArr = [...fileList.children];
        const endIndex = listArr.indexOf(item);

        if(startIndex < endIndex){
            item.after(draggingItem);
        }else{
            item.before(draggingItem);
        }
    })
}