function loadFragment(name = 'dashboard') {
    fetch(`./fragments/${name}.html`)
        .then((response) => {
            if (!response.ok) {
                const error = new Error('Response is not ok');
                error.response = response;
                throw response;
            }
            return response.text();
        })
        .then((html) => {
            document.getElementById('main-content').innerHTML = html;
            updateCharts();
        })
        .catch(console.error);
}

loadFragment();

[...document.getElementsByClassName('link-content')].forEach((element) => {
    element.addEventListener('click', () => {
        loadFragment(element.dataset.fragment);
    });
});