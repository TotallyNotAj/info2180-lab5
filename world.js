document.addEventListener('DOMContentLoaded',() =>{
    const lookup_button1 = document.getElementById('lookup1');
    const lookup_button2 = document.getElementById('lookup2');
    const resultdiv = document.getElementById('result');
    const country_input = document.getElementById('country');

    lookup_button1.addEventListener('click', () => {  // lookup countries
        const country = country_input.value.trim(); // get user input

        fetch(`world.php?country=${encodeURIComponent(country)}`)
            .then(response => response.text())
            .then(data => {
                // Display results in the div
                resultdiv.innerHTML = data;
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                resultdiv.innerHTML = '<p>Error fetching data.</p>';
            });
    });

    lookup_button2.addEventListener('click', () => {  // lookup cities
        const country = country_input.value.trim(); // get user input

        fetch(`world.php?country=${encodeURIComponent(country)}&lookup=cities`)
            .then(response => response.text())
            .then(data => {
                // Display results in the div
                resultdiv.innerHTML = data;
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                resultdiv.innerHTML = '<p>Error fetching data.</p>';
            });
    });
});