import {readFile} from 'fs/promises';

/**
 * Extracts the directory path of the provided file path.
 *
 * @param {string} filePath - The path to the file.
 * @returns {string} The directory path.
 * @private
 */
const getCurrentDir = (filePath) => {
    return filePath.replace(/\/\w+\.scss/i, '');
};

/**
 * Asynchronously reads a SCSS file and extracts the imported SCSS files using the `@use` rule.
 *
 * @param {string} filePath - The path to the SCSS file to analyze.
 * @returns {Promise<string[]>} A Promise that resolves to an array of paths to the imported SCSS files.
 * @throws {Error} If there is an issue reading the file or parsing the imports.
 *
 * @example
 * // Usage:
 * try {
 *    const imports = await getScssImports('path/to/your/file.scss');
 *    console.log(imports);
 * } catch (error) {
 *    console.error(error.message);
 * }
 */
export async function getScssImports(filePath) {
    try {
        // Read the content of the SCSS file.
        const currentDir = getCurrentDir(filePath);
        const content = await readFile(filePath, 'utf-8');

        // Extract import statements using the @use rule.
        const importMatches = content.match(/@use\s*"(.*?)";/g);

        if (importMatches) {
            // Map each import statement to a resolved file path.
            return importMatches.map((match) => {
                let file = match.split(/['"]/)[1];
                let resultPath = currentDir;

                // Resolve relative paths.
                while (/^\.\.\//.test(file)) {
                    file = file.replace(/^\.\.\//, '');
                    resultPath = resultPath.replace(/\/[A-z \w \d \s \.]+$/, '');
                }

                // Return the resolved file path.
                return `"${resultPath}/${file}.scss"`;
            });
        }

        // Return an empty array if no import statements found.
        return [];
    } catch (error) {
        // Throw an error if there is an issue reading the file or parsing imports.
        throw new Error(`Error in getScssImports: ${error.message}`);
    }
}
