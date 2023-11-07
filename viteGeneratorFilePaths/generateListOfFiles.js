import {stat, readdir, writeFile} from 'fs/promises';
import path from "path";
import {defaultDirScss, defaultDirJs } from "./env.js";
import {getScssImports} from './validators/scssValidator.js';
import {getJsImports} from "./validators/jsValidator.js";
/**
 * Recursively retrieves all file paths with a given extension in a directory.
 *
 * @param {string} directory - The directory to start searching from.
 * @param {string} extension - The file extension to filter by.
 * @returns {Promise<string[]>} - A promise that resolves to an array of file paths.
 */
async function getAllFilePaths(directory, extension) {
    const files = await readdir(directory);
    const filePaths = [];

    for (const file of files) {
        const filePath = path.join(directory, file);
        const stats = await stat(filePath);

        if (stats.isDirectory()) {
            // If it's a directory, recursively get file paths from the subdirectory.
            const subDirectoryFiles = await getAllFilePaths(filePath, extension);
            filePaths.push(...subDirectoryFiles);
        } else if (file.endsWith(`.${extension}`)) {
            // If it's a file with the specified extension, add it to the file paths array.
            filePaths.push(`"${filePath}"`);
        }
    }

    // Convert backslashes to forward slashes and return the array of file paths.
    return filePaths.map((el) => el.replaceAll('\\', '/'));
}

/**
 * Generates an array of file paths for SCSS and JS files, excluding invalid files.
 * Writes the result to a file named 'file-paths.js'.
 *
 * @returns {Promise<void>} - A promise that resolves when the file paths are generated and written.
 */
async function generateFilePaths() {
    let scssFilePaths = await getAllFilePaths(defaultDirScss, 'scss');
    let jsFilePaths = await getAllFilePaths(defaultDirJs, 'js');

    // Arrays to store excluded files based on validation.
    const excludedScssFiles = [];
    const excludedJsFiles = [];

    // Validate each SCSS file, and add valid ones to the excludedScssFiles array.
    for (const filePath of scssFilePaths) {
        const path = filePath.slice(1, filePath.length - 1);
        const res = await getScssImports(path);
        excludedScssFiles.push(...res);
    }

    // Validate each JS file, and add valid ones to the excludedJsFiles array.
    for (const filePath of jsFilePaths) {
        const path = filePath.slice(1, filePath.length - 1);
        const res = await getJsImports(path);
        excludedJsFiles.push(...res);
    }

    scssFilePaths = scssFilePaths.filter((file) => !excludedScssFiles.includes(file));
    jsFilePaths = jsFilePaths.filter((file) => !excludedJsFiles.includes(file));

    // Combine SCSS and JS file paths into a single array.
    const filePaths = `[\n${scssFilePaths.join(',\n')},\n${jsFilePaths.join(',\n')}\n]`;

    // Write the combined file paths array to 'file-paths.js'.
    await writeFile('./viteGeneratorFilePaths/file-paths.js', `export default ${filePaths};`);
}

// Invoke the file path generation process.
generateFilePaths();
