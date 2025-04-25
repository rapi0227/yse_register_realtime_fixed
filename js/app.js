let currentInput = ''; // To track the current input
let previousInput = '';
let operator = '';

const display = document.getElementById('display');
const totalDisplay = document.getElementById('totalDisplay');

function addNumber(num) {
    currentInput += num;
    display.value = currentInput;
}

function clearAll() {
    currentInput = '';
    previousInput = '';
    operator = '';
    display.value = '';
    totalDisplay.textContent = "売上: ￥0";
}

function calculate(op) {
    if (currentInput === '') return;
    
    if (previousInput === '') {
        previousInput = currentInput;
        currentInput = '';
    }
    
    operator = op;
}

function calculateTax() {
    if (currentInput === '') return;
    const price = parseFloat(currentInput);
    const tax = price * 0.1;
    currentInput = (price + tax).toFixed(2);
    display.value = currentInput;
}

function calculateTotal() {
    if (previousInput === '' || currentInput === '') return;
    
    let total = 0;
    switch (operator) {
        case '+':
            total = parseFloat(previousInput) + parseFloat(currentInput);
            break;
        case '*':
            total = parseFloat(previousInput) * parseFloat(currentInput);
            break;
        default:
            return;
    }
    
    totalDisplay.textContent = `売上: ￥${total.toFixed(2)}`;
    display.value = total.toFixed(2);
    currentInput = '';
    previousInput = '';
    operator = '';
}
