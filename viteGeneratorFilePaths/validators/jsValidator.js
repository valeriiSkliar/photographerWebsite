import {readFile} from 'fs/promises';
import {defaultDirJs} from "../env.js";

/**
 * Resolves the directory path of the provided file path.
 *
 * @param {string} filePath - The path to the file.
 * @returns {string} The directory path.
 * @private
 */
const getCurrentDir = (filePath) => filePath.replace(/\/\w+\.js/i, '');

/**
 * Asynchronously reads a JavaScript file and extracts the imported JavaScript files using the `import` statement.
 *
 * @param {string} filePath - The path to the JavaScript file to analyze.
 * @returns {Promise<string[]>} A Promise that resolves to an array of paths to the imported JavaScript files.
 * @throws {Error} If there is an issue reading the file or parsing the imports.
 *
 * @example
 * // Usage:
 * try {
 *    const imports = await getJsImports('path/to/your/file.js');
 *    console.log(imports);
 * } catch (error) {
 *    console.error(error.message);
 * }
 */
export async function getJsImports(filePath) {
    try {
        const currentDir = getCurrentDir(filePath);
        const content = await readFile(filePath, 'utf-8');

        // Use a regular expression with capturing groups to extract import statements.
        const importMatches = content.match(/import\s+(?:{?[\s\w,]*}?\s*from\s*)?["'](.+?)["']/g);

        if (importMatches) {
            return importMatches.map((match) => {
                let file = match.split(/['"]/)[1].replace(/^\.\//g, '').replace(/\.js/, '');
                let resultPath = currentDir;
                // Resolve aliases paths.
                if (/^@\//.test(file)) {
                    resultPath = file.replace(/^@/, defaultDirJs);
                    return `"${resultPath}.js"`
                }
                // Resolve relative paths.
                while (/^\.\.\//.test(file)) {
                    file = file.replace(/^\.\.\//, '');
                    resultPath = resultPath.replace(/\/[^/]+$/, '');
                }
                return `"${resultPath}/${file}.js"`;
            });
        }

        return [];
    } catch (error) {
        throw new Error(`Error in getJsImports: ${error.message}`);
    }
}
