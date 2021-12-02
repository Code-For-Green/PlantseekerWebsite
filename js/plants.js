getPlants = function getPlants() {
    return fetch('../api/all.php')
        .then((response) => {
            if (!response.ok) {
                const error = new Error('Response is not ok');
                error.response = response;
                throw response;
            }
            return response.json();
        })
        .then((json) => json.plants);
}

setPlants = function plantsToTable() {
    const table = document.getElementById('table-plants');
    if (!table) return;

    getPlants()
        .then((plants) => {
            table.innerHTML = plants.map((plant) => `<tr><td>${plant.id}</td><td>${plant.name}</td><td>${plant.description}</td></tr>`).join('');
        });
}