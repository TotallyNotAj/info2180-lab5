document.addEventListener('DOMContentLoaded',() =>{
    const lookup_button = document.getElementById('lookup');
    const resultdiv = document.getElementById('result');
    const country_input = document.getElementById('country');

    lookup_button.addEventListener('click',() =>{
        const country = country_input.value.trim(); // get user input

        fetch(`world.php?country=${encodeURIComponent(country)}`)
            .then(response => response.text())
            .then(data =>{
                resultdiv.innerHTML = data; // Display results in the html div
            })
            .catch(error =>{
                console.error('Error fetching data:', error);
                resultdiv.innerHTML = '<p>Error fetching data.</p>';
            });
    });
});