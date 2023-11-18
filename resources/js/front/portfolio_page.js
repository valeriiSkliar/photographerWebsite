import {getCsrfToken} from "../helpers/getCsrfToken.js"

const albumCover = document.getElementsByClassName ('portfolio_albums_title');

function selectAlbum (index) {
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
    let activeAlbum = albumArray[index];
    console.log(activeAlbum);
    return activeAlbum;
}

selectAlbum(0);

albumCover[0].addEventListener('click', () => {
    selectAlbum(0);
             });
albumCover[1].addEventListener('click', () => {
    selectAlbum(1);
});
albumCover[2].addEventListener('click', () => {
    selectAlbum(2);
});
albumCover[3].addEventListener('click', () => {
    selectAlbum(3);
});
