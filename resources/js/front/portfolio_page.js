import {getCsrfToken} from "../helpers/getCsrfToken.js"

const portfolioTextCollection = document.getElementsByClassName ('portfolio_text');
const albumCover = document.getElementsByClassName ('portfolio_albums_title');
const sliderContainer = document.getElementById('container_for_slider');
const scrollLeft = document.getElementById('scroll_left');
const scrollRight = document.getElementById('scroll_right');

const portfolioSlider = {
    // position: 0,
    // width: 0,
    activeFrame: 0,
    arrayWithURL:[]
}

// portfolioSlider.width = Number((window.getComputedStyle(sliderContainer).width).replace('px', ''));

// function renderGallery (arrayURL) {

//     const sliderContainer = document.getElementById('container_for_slider');
//     sliderContainer.innerHTML = '';
//     arrayURL.forEach((element) => {
//         let newImg = document.createElement('img');
//         newImg.classList.add('img_for_slider');
//         newImg.setAttribute('src',element.file_url);
//         sliderContainer.append(newImg);
//     });

// }

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
    // if (direction) {
    //     portfolioSlider.activeFrame += 1;
    //     if (portfolioSlider.activeFrame === portfolioSlider.arrayWithURL.length) {
    //         portfolioSlider.activeFrame = 0;
    //     }
    // }
    // else {
    //     portfolioSlider.activeFrame -= 1;
    //     if (portfolioSlider.activeFrame === -1) {
    //         portfolioSlider.activeFrame = portfolioSlider.arrayWithURL.length - 1;
    //     }
    // }
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
    // sliderContainer.style.left = `0px`;
    const albumArray = ['wedding','session','people','nature'];
    let activeCover1 = index + 1;
    let activeCover2 = index + 2;
    let activeCover3 = index + 3;
    function correctIndex (presentIndex) {
        let newIndex  = presentIndex;
        if (presentIndex>3) {
            newIndex = presentIndex - 4;
        }
        return newIndex
    };
    activeCover1 = correctIndex(activeCover1);
    activeCover2 = correctIndex(activeCover2);
    activeCover3 = correctIndex(activeCover3);
    albumCover[index].classList.add('album_title_display_none');
    albumCover[activeCover1].classList.remove('album_title_display_none');
    albumCover[activeCover2].classList.remove('album_title_display_none');
    albumCover[activeCover3].classList.remove('album_title_display_none');
    portfolioTextCollection[index].classList.remove('album_title_display_none');
    portfolioTextCollection[activeCover1].classList.add('album_title_display_none');
    portfolioTextCollection[activeCover2].classList.add('album_title_display_none');
    portfolioTextCollection[activeCover3].classList.add('album_title_display_none');

    let activeAlbum = albumArray[index];
    return activeAlbum;
}

export async function getCurrentAlbum(albumName){
    return fetch(`/api/component-get-current-album/${albumName}`, )
        .then(data => data.json())
        .then(data => {
            fillArrayURL(data.data[0].images);
          //  renderGallery(data.data[0].images);
            })
}

// function scrollToX (direction) {

//     const imgCollection = document.getElementsByClassName('img_for_slider');
//     const imgCollectionLength = imgCollection.length;
//     if (direction) {
//         portfolioSlider.position += portfolioSlider.width;
//         if (portfolioSlider.position>0) {
//             portfolioSlider.position = (imgCollectionLength-1)*portfolioSlider.width*Math.sign(-1);
//         };
//     }
//     else {
//         portfolioSlider.position -= portfolioSlider.width;
//         if (portfolioSlider.position<((imgCollectionLength-1)*portfolioSlider.width*Math.sign(-1))) {
//             portfolioSlider.position = 0;
//         };
//     };
//     sliderContainer.style.left = `${portfolioSlider.position}px`;
// }

document.addEventListener('DOMContentLoaded', async () => {
    await getCurrentAlbum(selectAlbum(0));
})


albumCover[0].addEventListener('click', async () => {
    await getCurrentAlbum(selectAlbum(0));
             });
albumCover[1].addEventListener('click', async () => {
    await getCurrentAlbum(selectAlbum(1));
});
albumCover[2].addEventListener('click', async () => {
    await getCurrentAlbum(selectAlbum(2));
});
albumCover[3].addEventListener('click', async () => {
    await getCurrentAlbum(selectAlbum(3));
});
scrollLeft.addEventListener('click', () => {
   // scrollToX(0);
    slideDirection(0);
});
scrollRight.addEventListener('click', () => {
   // scrollToX(1);
    slideDirection(1);
});

// window.addEventListener('resize', () => {
//     portfolioSlider.position = 0;
//     portfolioSlider.width = Number((window.getComputedStyle(sliderContainer).width).replace('px', ''));
//     sliderContainer.style.left = `0px`;
// });

