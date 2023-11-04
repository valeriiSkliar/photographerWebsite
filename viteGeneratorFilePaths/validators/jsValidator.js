import {readFile} from 'fs/promises';

export async function getJsImports(filePath) {
    const currentPath = filePath.replace(/\/\w+\.js/i, '');
    const content = await readFile(filePath, 'utf-8');
    // const importMatches = content.match(/import\s+(?:{?\w+}?\s+from\s+)?["'](.+?)["']/g);
    const importMatches = content.match(/import\s+(?:{?[\s \w ,]*}?\s*from\s*)?["'](.+?)["']/g);
    if (importMatches) {
        const a = importMatches.map(match => {
            let file = match.split(/['"]/)[1].replace(/^\.\//g, '');
            file = file.replace(/\.js/, '');
            let resultPath = currentPath;
            while (/^\.\.\//.test(file)) {
                file = file.replace(/^\.\.\//, '');
                resultPath = resultPath.replace(/\/[A-z \w \d \s \.]+$/, '');
            }
            return `"${resultPath}/${file}.js"`
        });
        return a;
    } else {
        return [];
    }
}
