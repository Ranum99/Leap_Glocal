window.onload = start;

function start() {
    let specInput = document.getElementById('testSpec');
    let specOutput = document.getElementById('specOutput');


    specInput.addEventListener('input', (event) => {
        let arrayWithSpecs = event.target.value.split(' ');
        let uniq = [...new Set(arrayWithSpecs)];
        let output = '';

        for (let i = 0; i < uniq.length; i++) {
            if (uniq[i] !== '')
                output += '<p class="specsForUser">' + uniq[i] + '</p>';
        }

        specOutput.innerHTML = output;
    })
}