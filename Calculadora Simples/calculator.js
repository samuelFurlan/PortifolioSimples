var operations = []
const operators = ['*', '/', '-', '+']
const resultDisplay = document.getElementById("result")

function addNumber(newNumber) {
    operations.push(newNumber)
    resultDisplay.value += newNumber
}

function addOperator(newOperator) {
    if (operations.length == 0) {
        operations[0] = 0
        operations[1] = newOperator
        resultDisplay.value += 0 + newOperator
    } else if (operations[operations.length - 1] == ".") {
        operations.push(0)
        operations.push(newOperator)
        resultDisplay.value += 0 + newOperator
    } else {
        operations.push(newOperator)
        resultDisplay.value += newOperator
    }
}

function addFloat() {
    if (operations.length == 0) {
        operations[0] = 0
        operations[1] = "."
        resultDisplay.value += 0 + "."
    } else if (operations[operations.length - 1] == ".") {
        return false
    } else {
        var exist = false
        for (var i = operations.length; i > 0; i--) {
            if (operations[i] == ".") {
                exist = true
                break
            }
            if (operators.includes(operations[i])) {
                if (operators.includes(operations[operations.length - 1])) {
                    operations.push(0)
                    operations.push('.')
                    resultDisplay.value += 0 + "."
                    exist = true
                    break
                } else {
                    operations.push('.')
                    resultDisplay.value += "."
                    exist = true
                    break
                }
            }
        }
        if (!exist) {
            operations.push('.')
            resultDisplay.value += "."
        }

    }
}

function clean() {
    operations = []
    resultDisplay.value = ""
}

function resolve() {
    if (operations.length == 0) {
        return false
    } else if (operations[operations.length - 1] == "." || operators.includes(operations[operations.length -
            1])) {
        operations.push(0)
        resultDisplay.value += 0
    }
    var result = document.getElementById("result").value
    resultDisplay.value = eval(result)
}

function inProgress() {
    alert("Em desenvolvimento")
}