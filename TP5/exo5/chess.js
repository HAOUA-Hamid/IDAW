const chessboard = document.getElementById('chessboard');
const board = [];
let selectedSquare = null;
let isWhiteTurn = true;

// Path to chess piece images
const pieceImages = {
    'P': 'images/white_pawn.png',
    'R': 'images/white_rook.png',
    'N': 'images/white_knight.png',
    'B': 'images/white_bishop.png',
    'Q': 'images/white_queen.png',
    'K': 'images/white_king.png',
    'p': 'images/black_pawn.png',
    'r': 'images/black_rook.png',
    'n': 'images/black_knight.png',
    'b': 'images/black_bishop.png',
    'q': 'images/black_queen.png',
    'k': 'images/black_king.png',
};

// Chess piece symbols (uppercase = white, lowercase = black)
const initialBoardSetup = [
    ['r', 'n', 'b', 'q', 'k', 'b', 'n', 'r'],
    ['p', 'p', 'p', 'p', 'p', 'p', 'p', 'p'],
    ['', '', '', '', '', '', '', ''],
    ['', '', '', '', '', '', '', ''],
    ['', '', '', '', '', '', '', ''],
    ['', '', '', '', '', '', '', ''],
    ['P', 'P', 'P', 'P', 'P', 'P', 'P', 'P'],
    ['R', 'N', 'B', 'Q', 'K', 'B', 'N', 'R'],
];

// Create the chessboard
function createChessboard() {
    for (let row = 0; row < 8; row++) {
        board[row] = [];
        for (let col = 0; col < 8; col++) {
            const square = document.createElement('div');
            square.classList.add('square');
            square.classList.add((row + col) % 2 === 0 ? 'white' : 'black');
            square.dataset.row = row;
            square.dataset.col = col;

            const piece = initialBoardSetup[row][col];
            if (piece) {
                const img = document.createElement('img');
                img.src = pieceImages[piece];
                square.appendChild(img);
                square.classList.add('piece');
            }

            square.addEventListener('click', handleSquareClick);
            chessboard.appendChild(square);
            board[row][col] = square;
        }
    }
}

// Handle square clicks
function handleSquareClick(event) {
    const row = event.target.dataset.row;
    const col = event.target.dataset.col;
    const piece = board[row][col].querySelector('img');

    // Selecting a piece
    if (!selectedSquare && piece && isCorrectTurn(piece)) {
        selectedSquare = board[row][col];
        selectedSquare.classList.add('selected');
    } else if (selectedSquare) {
        // Attempt to move the selected piece to the clicked square
        movePiece(selectedSquare, board[row][col]);
        selectedSquare.classList.remove('selected');
        selectedSquare = null;
    }
}

// Move a piece
function movePiece(fromSquare, toSquare) {
    const fromPiece = fromSquare.querySelector('img');
    const toPiece = toSquare.querySelector('img');

    if (isValidMove(fromSquare, toSquare)) {
        if (toPiece) toPiece.remove(); // Capture the opponent's piece if any
        toSquare.appendChild(fromPiece); // Move the piece
        isWhiteTurn = !isWhiteTurn; // Switch turns
    }
}

// Basic movement validation
function isValidMove(fromSquare, toSquare) {
    const fromPiece = fromSquare.querySelector('img');
    const toPiece = toSquare.querySelector('img');

    // Prevent moving to a square occupied by a piece of the same color
    if (toPiece && isSameColor(fromPiece, toPiece)) {
        return false;
    }

    // TODO: Add piece-specific movement rules here (e.g., pawn moves, rook moves)

    return true;
}

// Check if it's the correct turn
function isCorrectTurn(piece) {
    const pieceName = piece.src.split('/').pop();
    return isWhiteTurn ? pieceName.startsWith('white') : pieceName.startsWith('black');
}

// Check if two pieces are the same color
function isSameColor(piece1, piece2) {
    return piece1.src.includes('white') === piece2.src.includes('white');
}
// Check if a move is valid for a pawn
function isValidPawnMove(fromSquare, toSquare) {
    const fromRow = parseInt(fromSquare.dataset.row);
    const toRow = parseInt(toSquare.dataset.row);
    const fromCol = parseInt(fromSquare.dataset.col);
    const toCol = parseInt(toSquare.dataset.col);

    const direction = isWhiteTurn ? -1 : 1; // White moves up, black moves down
    const startingRow = isWhiteTurn ? 6 : 1;

    // Moving forward
    if (toCol === fromCol && !toSquare.querySelector('img')) {
        if (toRow === fromRow + direction) {
            return true; // Single step forward
        } else if (toRow === fromRow + 2 * direction && fromRow === startingRow) {
            return true; // Double step forward from starting position
        }
    }

    // Capturing diagonally
    if (Math.abs(toCol - fromCol) === 1 && toRow === fromRow + direction) {
        if (toSquare.querySelector('img')) {
            return true; // Diagonal capture
        }
    }

    return false;
}


// Initialize the chessboard
createChessboard();
