import axios from "axios";
// Дождёмся загрузки API и готовности DOM.
let myMap;
let places = [];

function editPlace () {
    const buttons = document.querySelectorAll('._edit');
    buttons.forEach((button) => {
        button.addEventListener('click', function () {
            this.parentElement.parentElement.classList.toggle('change');
        })
    });
}
function deletePlace () {
    const buttons = document.querySelectorAll('._delete');
    buttons.forEach((button) => {
        button.addEventListener('click', function () {
            places.splice(parseInt(this.dataset.id), 1);
            axios.post('http://127.0.0.1:8000/map', places).catch((e) => console.log(e));
            document.location.reload();
        })
    });
}

function addNewPlace (name, x, y) {
    const myGeoObject = new ymaps.GeoObject({
        // Описание геометрии.
        geometry: {
            type: "Point",
            coordinates: [x, y]
        },
        // Свойства.
        properties: {
            // Контент метки.
            iconContent: name,
            hintContent: name
        }
    });
    myMap.geoObjects.add(myGeoObject);
}
function addNewPlaceByClick () {
    document.querySelector('#addPoint').addEventListener('click', event => {
        const placeName = document.querySelector('#namepos');
        const xPos = document.querySelector('#xpos');
        const yPos = document.querySelector('#ypos');

        addNewPlace(placeName.value, xPos.value, yPos.value);
        places.push({
            name: placeName.value,
            x: xPos.value,
            y: yPos.value
        })

        axios.post('http://127.0.0.1:8000/map', places).catch((e) => console.log(e));
    });
}


function init () {
    // Создание экземпляра карты и его привязка к контейнеру с
    // заданным id ("map").
    myMap = new ymaps.Map('myMap', {
        // При инициализации карты обязательно нужно указать
        // её центр и коэффициент масштабирования.
        center: [55.76, 37.64], // Москва
        zoom: 10
    }, {
        searchControlProvider: 'yandex#search'
    },
        axios.get('http://127.0.0.1:8000/ymgeo').then((response) => {
            if (Object.keys(response.data).length !== 0) {
                response.data.forEach((place) => {
                    addNewPlace(place.name, place.x, place.y)
                    places.push({name: place.name, x: place.x, y: place.y});
                });
            }
        })
    );

}

document.addEventListener("DOMContentLoaded", () => {
    ymaps.ready(init);
    addNewPlaceByClick();
    deletePlace();
    editPlace();
});
