let form = document.getElementById('search');
let input = form.querySelector('input[name="query"]');
var timer;
input.addEventListener( 'keyup', function(){
    clearTimeout( timer );
    timer = setTimeout( search, 500 );
});

function search(){
    let xhr = new XMLHttpRequest();

    let value = input.value;
    if( value.length < 3 ){
        return;
    }

    let address = encodeURIComponent( value );
    let url = 'https://api-adresse.data.gouv.fr/search/?q=' + address + '&limit=10';
    xhr.open( 'GET', url );

    xhr.onload = function(){
        let response = JSON.parse( xhr.response );
        proccess( response );
    };

    xhr.send();
}

function proccess( response ){
    let list = document.getElementById( 'result' );
    list.innerHTML = '';

    for( let i in response.features ){
        let address = response.features[ i ];

        let li = document.createElement('li');
        let a = document.createElement('a');
        a.innerText = address.properties.label;
        a.href = '/salles/list?query='+encodeURIComponent(address.properties.label);
        li.appendChild(a);

        list.appendChild( li );
    }
}


var map = L.map('map').setView([48.85, 2.34], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

var cleApi = 'd74b4d980c75e01effb74117dece1e33afba94c2'
var url = 'https://api.jcdecaux.com/vls/v1/stations?contract=creteil&apiKey=' + cleApi

$.get(url)
.done(function(data) {
    //console.log(listeStation);
    data.forEach(station => {   //fonction flechée équivau à function (station) {}
        L.marker([station.position.lat, station.position.lng]).addTo(map)
        .bindPopup(station.name)
    });
})
.fail(function() {
    alert( "error : le serveur ne répond pas" );
})
