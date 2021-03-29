window.onload = start;

function start() {
    let specInput = document.getElementById('specification_register');

    updateSpecsView();

    specInput.addEventListener('input', (event) => {
        updateSpecsView();
    })
}

function updateSpecsView() {
    let specInput = document.getElementById('specification_register');
    let specOutput = document.getElementById('specOutput');

    let arrayWithSpecs = specInput.value.split(' ');
    let uniq = [...new Set(arrayWithSpecs)];
    let output = '';

    for (let i = 0; i < uniq.length; i++) {
        if (uniq[i] !== '')
            output += '<p class="specsForUser">' + uniq[i] + '</p>';
    }

    specOutput.innerHTML = output;
}