const portfolioTextCollection = document.getElementsByClassName ('portfolio_text');
const albumCover = document.getElementsByClassName ('portfolio_albums_title');
const albumCoverNames = document.getElementsByClassName ('album_cover_name');
const sliderContainer = document.getElementById('container_for_slider');
const swiperPortfolio = document.getElementById('swiper_portfolio');
const scrollLeft = document.getElementById('scroll_left');
const scrollRight = document.getElementById('scroll_right');

function myDevices () {

    const devices = new RegExp('Android|webOS|iPhone|iPad|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Kindle|Silk|Opera Mini', "i");

    if (devices.test(navigator.userAgent)) {
     scrollLeft.style.display = 'none';
     scrollRight.style.display = 'none';
    }
    else {
     scrollLeft.style.display = 'block';
     scrollRight.style.display = 'block';
    }
}

myDevices();

const portfolioSlider = {
    activeFrame: 0,
    arrayWithURL:[],
    arrayTitle:[],
    touchStart: 0,
    fillArrayAlbumsTitle: function (collection) {
        for (let i = 0; i < collection.length; i += 1) {
            this.arrayTitle.push(collection[i].textContent.trim());
        }
    }
}

portfolioSlider.fillArrayAlbumsTitle(albumCoverNames);

function fillArrayURL (arrayURL) {
    portfolioSlider.activeFrame = 0;
    portfolioSlider.arrayWithURL.splice(0, portfolioSlider.arrayWithURL.length);
    arrayURL.forEach((element)=>{
        portfolioSlider.arrayWithURL.push(element)
    })
    sliderContainer.style.backgroundImage = `url(${portfolioSlider.arrayWithURL[0].file_url})`
}

function slideDirection (direction) {

    if (direction) {
        portfolioSlider.activeFrame += 1;
        if (portfolioSlider.activeFrame === portfolioSlider.arrayWithURL.length) {
            portfolioSlider.activeFrame = 0;
        }
    }
    else {
        portfolioSlider.activeFrame -= 1;
        if (portfolioSlider.activeFrame === -1) {
            portfolioSlider.activeFrame = portfolioSlider.arrayWithURL.length - 1;
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
        activeAlbum = 'Wedding';
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

swiperPortfolio.addEventListener('touchstart',(event)=>{
    event.preventDefault();
    portfolioSlider.touchStart = event.touches[0].clientX;
});

swiperPortfolio.addEventListener('touchend', (event)=>{
    event.preventDefault();
    const touchEnd = event.changedTouches[0].clientX;
    const pathX = touchEnd - portfolioSlider.touchStart;
    if (pathX > 10) {
        slideDirection(1);
    };
    if (pathX < -10) {
        slideDirection(0);
    };
});

const setIntervalGallery = setInterval(() => {slideDirection(1)}, 7000);

