import {getCsrfToken} from "../helpers/getCsrfToken.js"

const portfolioTextCollection = document.getElementsByClassName ('portfolio_text');
const albumCover = document.getElementsByClassName ('portfolio_albums_title');
const albumCoverNames = document.getElementsByClassName ('album_cover_name');
const sliderContainer = document.getElementById('container_for_slider');
const scrollLeft = document.getElementById('scroll_left');
const scrollRight = document.getElementById('scroll_right');

const portfolioSlider = {
    activeFrame: 0,
    arrayWithURL:[],
    arrayTitle:[]
}

for (let i = 0; i < albumCoverNames.length; i += 1) {
    const str = albumCoverNames[i].textContent;
    const strMain = str[0].toLowerCase() + str.slice(1);
    portfolioSlider.arrayTitle.push(strMain);
}

function fillArrayURL (arrayURL) {
    portfolioSlider.activeFrame = 0;
    scrollLeft.style.display = 'none';
    scrollRight.style.display = 'block';
    portfolioSlider.arrayWithURL.splice(0, portfolioSlider.arrayWithURL.length);
    arrayURL.forEach((element)=>{
        portfolioSlider.arrayWithURL.push(element)
    })
    sliderContainer.style.backgroundImage = `url(${portfolioSlider.arrayWithURL[0].file_url})`
}

function slideDirection (direction) {

    if (direction) {
        portfolioSlider.activeFrame += 1;
        if (portfolioSlider.activeFrame === portfolioSlider.arrayWithURL.length-1) {
            scrollRight.style.display = 'none';
        }
        if (portfolioSlider.activeFrame === 1) {
            scrollLeft.style.display = 'block';
        }
    }
    else {
        portfolioSlider.activeFrame -= 1;
        if (portfolioSlider.activeFrame === 0) {
            scrollLeft.style.display = 'none';
        }
        if (portfolioSlider.activeFrame === portfolioSlider.arrayWithURL.length-2) {
            scrollRight.style.display = 'block';
        }
    }
    sliderContainer.style.backgroundImage = `url(${portfolioSlider.arrayWithURL[portfolioSlider.activeFrame].file_url})`
}

function selectAlbum (index) {
    const numAlbums = portfolioSlider.arrayTitle.length;

    for (let i = 0; i < numAlbums; i += 1) {
        if (i === index) {
            albumCover[i].classList.add('album_title_display_none');
        }
        else {
            albumCover[i].classList.remove('album_title_display_none');
        }
    }

    for (let i = 0; i < portfolioTextCollection.length; i += 1) {
        if (i === index) {
            portfolioTextCollection[i].classList.remove('album_title_display_none');
        }
        else {
            portfolioTextCollection[i].classList.add('album_title_display_none');
        }
    }

    let activeAlbum = portfolioSlider.arrayTitle[index];
    if (!activeAlbum) {
        activeAlbum = 'wedding'
    }
    return activeAlbum;
}

export async function getCurrentAlbum(albumName){
    return fetch(`/api/component-get-current-album/${albumName}`, )
        .then(data => data.json())
        .then(data => {
            fillArrayURL(data.data[0].images);
            })
}

document.addEventListener('DOMContentLoaded', async () => {
    await getCurrentAlbum(selectAlbum(0));
})

for (let i = 0; i < portfolioSlider.arrayTitle.length; i += 1) {
    albumCover[i].addEventListener('click', async () => {
        await getCurrentAlbum(selectAlbum(i));
    });
}

scrollLeft.addEventListener('click', () => {
    slideDirection(0);
});
scrollRight.addEventListener('click', () => {
    slideDirection(1);
});

