const input = document.querySelector('input');
const img = document.querySelector('img');
let isFile = false;

input.addEventListener('change',(e)=>{
    const file = input.files[0];
    if(file){
        img.src = URL.createObjectURL(file);
        isFile = true;
        document.querySelector('.container').style.border= 'none';
    }
})

let settings = {
    rotate: 0,
    flipTB: 1,
    flipLR: 1,
    isGrayScale: false
}

document.querySelector('.left-turn').addEventListener('click',()=>{
    settings.rotate += -90;
    update();
})
document.querySelector('.right-turn').addEventListener('click',()=>{
    settings.rotate += 90;
    update();
})
document.querySelector('.switch-side').addEventListener('click',()=>{
    settings.flipLR *= -1;
    update();
})
document.querySelector('.upside-down').addEventListener('click',()=>{
    settings.flipTB *= -1;
    update();
})
document.querySelector('.grayscale').addEventListener('click',()=>{
    settings.isGrayScale = !settings.isGrayScale;
    update();
})

document.querySelector('.reset').addEventListener('click',()=>{
    settings = {
        rotate: 0,
        flipTB: 1,
        flipLR: 1,
        isGrayScale: false
    };
    update();
})

const update = ()=>{
    img.style.transform = `rotate(${settings.rotate}deg) scale(${settings.flipLR},${settings.flipTB})`;
    if (settings.isGrayScale) img.style.filter = `grayscale(100%)`;
    else img.style.filter = `grayscale(0%)`;
}

document.querySelector('.download').addEventListener('click',()=>{
    if(!isFile) return;
    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext("2d");
    canvas.width = img.naturalWidth;
    canvas.height = img.naturalHeight;
    if(settings.isGrayScale){
        ctx.filter = `grayscale(100%)`;
    }
    ctx.translate(canvas.width / 2, canvas.height / 2);
    ctx.rotate((settings.rotate * Math.PI)/180);
    ctx.scale(settings.flipLR, settings.flipTB);
    ctx.drawImage(img, -canvas.width/2, -canvas.height/2);
    const link = document.createElement('a');
    link.download = 'editImage.png';
    link.href = canvas.toDataURL('image/png');
    link.click();
})