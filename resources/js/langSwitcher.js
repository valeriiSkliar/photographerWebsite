import {set, get} from "@/helpers/cookie.js";

const allLocale = document.querySelectorAll('.navbar__switcher__availableLocale');
console.log(get('selected_location'));

allLocale.forEach((el) => {

    el.addEventListener('click', (e) => {
        e.preventDefault();
        const defaultUrl = window.location.origin;
        const lang = (() => {
            const curLang = e.target.getAttribute('data-lang') || e.target.closest('[data-lang]').getAttribute('data-lang');
            if (!curLang || curLang === 'en') {
                return 'en';
            }
            return curLang;
        })();
        const pathName = window.location.pathname;
        const isNotDefaultLang = pathName.match(/^(\/\w+\/)/);
        if(isNotDefaultLang) {
            const newPathName = pathName.replace(/^(\/\w+)\//,  `/`);
            set('selected_location', lang, 900);
            window.location.href = defaultUrl + newPathName;
        } else {
            set('selected_location', lang, 900);
            window.location.href = `${defaultUrl}/` + lang + pathName;
        }
    });
});
