import {postLang} from "@/helpers/cookie.js";

const allLocale = document.querySelectorAll('.navbar__switcher__availableLocale');

function getLanguage(el) {
    const curLang = el.getAttribute('data-lang') || el.closest('[data-lang]').getAttribute('data-lang');
    if (!curLang || curLang === 'en') {
        return 'en';
    }
    return curLang;
}

function updateLocation(lang, path) {
    const defaultUrl = window.location.origin;

    if (lang === 'en') {
        return window.location.href = `${defaultUrl}${path}`;
    }
    return window.location.href = `${defaultUrl}/${lang}${path}`;
}

allLocale.forEach((el) => {
    el.addEventListener('click', (e) => {
        e.preventDefault();
        const lang = getLanguage(e.target);
        const pathName = window.location.pathname === '/' ? '' : window.location.pathname;
        const isCurrentLangEN = pathName.match(/^(\/\w+)\//) || 'en';

        try {
            if (isCurrentLangEN !== 'en' || pathName.length === 3) {
                const newPathName = pathName.replace(/^(\/\w+)\/?/, `/`);

                postLang(lang).then(() => updateLocation(lang, newPathName));
            } else {
                postLang(lang).then(() => updateLocation(lang, pathName));
            }
        } catch (e) {
            console.log(e);
        }
    });
});
