document.addEventListener('DOMContentLoaded',() =>{
    const lookup_button1 = document.getElementById('lookup1'); // country
    const lookup_button2 = document.getElementById('lookup2'); // city
    const resultdiv = document.getElementById('result');
    const search_input = document.getElementById('search');

    lookup_button1.addEventListener('click',() =>{
        const country = search_input.value.trim(); // get user input

        fetch(`world.php?country=${encodeURIComponent(search)}`)
            .then(response => response.text())
            .then(data =>{
                resultdiv.innerHTML = data; // Display results in the html div
            })
            .catch(error =>{
                console.error('Error fetching data:', error);
                resultdiv.innerHTML = '<p>Error fetching data.</p>';
            });
    });

    lookup_button2.addEventListener('click',() =>{
        const search = search_input.value.trim(); // get user input

        fetch(`world.php?city=${encodeURIComponent(search)}`)
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