import {readFile} from 'fs/promises';
import {defaultDirScss, defaultFilePathScss} from "../env.js";

const imports = await getScssImports(defaultFilePathScss);

async function getScssImports(filePath) {
    const content = await readFile(filePath, 'utf-8');
    const importMatches = content.match(/@use "(.*?)";/g);
    if (importMatches) {
        const a = importMatches.map(match => {
            const file = match.split(/['"]/)[1];
            return `"${defaultDirScss}/${file}.scss"`
        });
        return a;
    } else {
        return [];
    }
}

export async function validateScssFile(filePath) {
    const a = imports.includes(filePath);
    return a;
}
