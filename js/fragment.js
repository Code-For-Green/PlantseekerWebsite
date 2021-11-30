
fetch('./fragments/dashboard.html')
.then((response) => {
    if (!response.ok) {

    }
    return response.text();
})
.then((html) => document.getElementById('main-content').innerHTML = html);