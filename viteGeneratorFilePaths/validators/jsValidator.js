import {readFile} from 'fs/promises';
import {defaultDirJs, defaultFilePathJs} from "../env.js";

const imports = await getJsImports(defaultFilePathJs);

async function getJsImports(filePath) {
    const content = await readFile(filePath, 'utf-8');
    const importMatches = content.match(/import\s+(?:\w+\s+from\s+)?["'](.+?)["']/g);
    if (importMatches) {
        const a = importMatches.map(match => {
            const file = match.split(/['"]/)[1].replace('./', '');
            return `"${defaultDirJs}/${file}.js"`
        });
        return a;
    } else {
        return [];
    }
}

export async function validateJsFile(filePath) {
    const a = imports.includes(filePath);
    return a;
}
