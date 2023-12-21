
    /**
     * Set a cookie with the given name and value.
     * @param name - The name of the cookie.
     * @param value - The value to be stored in the cookie.
     * @param days - The number of days until the cookie expires (optional).
     */
    export function set(name, value, days) {
        let expires;
        if (days) {
            let time = new Date();
            const now = time.getUTCDate();
            time.setUTCDate(now + days);
            expires = `expires=${time.toUTCString()}`;
        }
        else
            expires = `expires=`;
        document.cookie = `${encodeURIComponent(name)}=${encodeURIComponent(value)}; ${expires}; path=/`;
    }
    /**
     * Get the value of a cookie with the given name.
     * @param name - The name of the cookie.
     * @returns The value of the cookie, or null if the cookie does not exist.
     */
    export function get(name) {
        let matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"));
        return matches ? decodeURIComponent(matches[1]) : null;
    }
    /**
     * Delete a cookie with the given name.
     * @param name - The name of the cookie to be deleted.
     */
    export function deleteCookie(name) {
        set(name, '', -1);
    }
    /**
     * Delete all cookies from domain.
     */
    export function clearAllCookie() {
        let cookies = document.cookie.split("; ");

        for (let c = 0; c < cookies.length; c += 1) {
            const name = cookies[c].split(";")[0].split("=")[0];
            set(name, '', -1);
        }
    }

