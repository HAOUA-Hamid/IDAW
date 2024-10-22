const grid = document.querySelector('#tetris');
const width = 20;
const height = 10;
let squares = [];
let currentPosition = 4;
let currentRotation = 0;
let timerId;

for (let i = 0; i < width * height; i++) {
    let square = document.createElement('div');
    grid.appendChild(square);
    squares.push(square);
}

const lTetromino = [
    [1, width+1, width*2+1, 2], 
    [width, width+1, width+2, width*2+2],
    [1, width+1, width*2+1, width*2],
    [width, width*2, width*2+1, width*2+2]
];

const zTetromino = [
    [0, width, width+1, width*2+1],
    [width+1, width+2, width*2, width*2+1],
    [0, width, width+1, width*2+1],
    [width+1, width+2, width*2, width*2+1]
];

const tTetromino = [
    [1, width, width+1, width+2],
    [1, width+1, width+2, width*2+1],
    [width, width+1, width+2, width*2+1],
    [1, width, width+1, width*2+1]
];

const oTetromino = [
    [0, 1, width, width+1],
    [0, 1, width, width+1],
    [0, 1, width, width+1],
    [0, 1, width, width+1]
];

const iTetromino = [
    [1, width+1, width*2+1, width*3+1],
    [width, width+1, width+2, width+3],
    [1, width+1, width*2+1, width*3+1],
    [width, width+1, width+2, width+3]
];

const theTetrominoes = [lTetromino, zTetromino, tTetromino, oTetromino, iTetromino];

let random = Math.floor(Math.random() * theTetrominoes.length);
let current = theTetrominoes[random][currentRotation];
draw();

function draw() {
    current.forEach(index => {
        squares[currentPosition + index].classList.add('tetromino');
    });
}

function undraw() {
    current.forEach(index => {
        squares[currentPosition + index].classList.remove('tetromino');
    });
}

function moveDown() {
    undraw();
    currentPosition += width; 
    draw();
    freeze();
}

function freeze() {
    if (current.some(index => squares[currentPosition + index + width].classList.contains('taken'))) {
        current.forEach(index => squares[currentPosition + index].classList.add('taken'));
        random = Math.floor(Math.random() * theTetrominoes.length);
        current = theTetrominoes[random][currentRotation];
        currentPosition = 4;
        draw();
        checkForCompleteRows();
    }
}

function moveLeft() {
    undraw();
    const isAtLeftEdge = current.some(index => (currentPosition + index) % width === 0);
    if (!isAtLeftEdge) currentPosition -= 1;
    if (current.some(index => squares[currentPosition + index].classList.contains('taken'))) {
        currentPosition += 1;
    }
    draw();
}

function moveRight() {
    undraw();
    const isAtRightEdge = current.some(index => (currentPosition + index) % width === width - 1);
    if (!isAtRightEdge) currentPosition += 1;
    if (current.some(index => squares[currentPosition + index].classList.contains('taken'))) {
        currentPosition -= 1;
    }
    draw();
}

function rotate() {
    undraw();
    currentRotation = (currentRotation + 1) % 4;
    current = theTetrominoes[random][currentRotation];
    draw();
}

document.addEventListener('keydown', event => {
    if (event.keyCode === 37) moveLeft();
    else if (event.keyCode === 39) moveRight();
    else if (event.keyCode === 38) rotate();
    else if (event.keyCode === 40) moveDown();
});

function checkForCompleteRows() {
    for (let i = 0; i < 199; i += width) {
        const row = [i, i+1, i+2, i+3, i+4, i+5, i+6, i+7, i+8, i+9];

        if (row.every(index => squares[index].classList.contains('taken'))) {
            row.forEach(index => {
                squares[index].classList.remove('taken');
                squares[index].classList.remove('tetromino');
            });
            const removedSquares = squares.splice(i, width);
            squares = removedSquares.concat(squares);
            squares.forEach(cell => grid.appendChild(cell));
        }
    }
}

timerId = setInterval(moveDown, 1000);
