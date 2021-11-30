function loadFragment(name = 'dashboard', onThen = () => {}) {
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
        .then(onThen)
        .catch(console.error);
}

loadFragment();

[...document.getElementsByClassName('link-content')].forEach((element, _, elements) => {
    element.addEventListener('click', () => {
        loadFragment(element.dataset.fragment, () => {
            element.classList.add('active');
            elements.forEach((e) => e.classList.remove('active'));
        });
    });
});