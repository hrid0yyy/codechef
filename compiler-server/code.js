// Read input from standard input
process.stdin.resume();
process.stdin.setEncoding('utf8');

let input = '';
process.stdin.on('data', function (chunk) {
    input += chunk;
});

process.stdin.on('end', function () {
    const number = parseInt(input.trim());

    // Check if the number is even or odd
    if (number % 2 === 0) {
        console.log("Even"); // Output "Even" if divisible by 2
    } else {
        console.log("Odd");  // Output "Odd" otherwise
    }
});
