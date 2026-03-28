let player = 'X';
const cells = document.querySelectorAll('.cell');

let board = [
    ["", "", ""],
    ["", "", ""],
    ["", "", ""]
];
let isFinished = false;
let isDraw = false;

cells.forEach(cell =>{
    cell.addEventListener('click',()=>{
        const index = cell.dataset.index;

        const row = Math.floor(index / 3); 
        const col = index % 3;             

        if(cell.textContent !== "" || isFinished || isDraw) return;

        cell.classList.add(player.toLowerCase());
        cell.textContent = player;
        board[row][col] = player;

        const winLines = ckWin(row,col,player);

        if(winLines){
            winLines.forEach(winLine=>{
                const [winRow, winCol] = winLine;
                const winIndex = (winRow * 3) + winCol;
                cells[winIndex].classList.add('winning');
            })
            setTimeout(()=>{
                alert(`${player}가 승리하였습니다`);
            },500); 
            
            isFinished = true;
            return;
        }else{
            isDraw = board.flat().every(v => v !== "");

            if(isDraw){
                setTimeout(()=>{
                    alert(`무승부입니다`);
                },500);
            }

            player = (player === 'X') ? 'O' : 'X';
        }
    })
})

const ckWin = (row, col, player)=>{
    if(
        board[row][0] === player &&
        board[row][1] === player &&
        board[row][2] === player
    ) return [[row,0],[row,1],[row,2]];
    if(
        board[0][col] === player &&
        board[1][col] === player &&
        board[2][col] === player
    ) return [[0,col],[1,col],[2,col]];
    if(
        board[0][0] === player &&
        board[1][1] === player &&
        board[2][2] === player
    ) return [[0,0],[1,1],[2,2]];
    if(
        board[0][2] === player &&
        board[1][1] === player &&
        board[2][0] === player
    ) return [[0,2],[1,1],[2,0]];

    return false;
}

const reset = ()=>{
    board = [
        ["", "", ""],
        ["", "", ""],
        ["", "", ""]
    ];
    cells.forEach(cell=>{
        cell.classList.remove('x','o','winning');
        cell.textContent = "";
        isFinished = false;
        isDraw = false;
    })
}

document.querySelector('#resetGame').addEventListener('click',()=>{
    player = 'X';
    reset();
})