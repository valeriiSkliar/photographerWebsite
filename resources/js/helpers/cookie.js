import {getCsrfToken} from "@/helpers/getCsrfToken.js";

export async function postLang(lang) {
    try {
        const response = await fetch('/api/set-lang', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
            },
            body: JSON.stringify({lang: lang})
        });

        if (!response.ok) {
            const {error: {status, message}} = await response.json();
            throw new Error(`--> Status:${status}. ${message} <--`);
        }
        return response.json();
    } catch (e) {
        return e;
    }
}
