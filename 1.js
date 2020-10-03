const checkArray = (value, input) => {
    let count = 0;
    for (let i = 0; i < input.length; i++) {
        if (value != input[i]) {
            count += input[i];
        }
    }

    return count;
}

const input = [1, 2, 3, 4, 5];
let result = [];
let biggest = 0;
let smallest = 0;

console.log('Input: [' + input.join(', ') + ']')

input.map((value) => {
    const count = checkArray(value, input);
    console.log('Angka ' + value + ' : '+ count);
    result.push(count);
})

for (let i = 0; i <= result.length; i++) {
    if (result[i] > result[i] + 1 || result[i] > biggest)
        biggest = result[i];

    if (result[i] < result[i] + 1 || result[i] < smallest)
        smallest = result[i];
}

console.log('Maka angka terbesarnya adalah ' + biggest + ' dan terkecilnya adalah ' + smallest);