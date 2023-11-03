/**
 * Extracts the extension and path from a string containing a file path with optional "❋❋/❋" wildcard.
*
* @param {string} inputString - The input string containing the file path with optional "❋❋/❋" wildcard.
* @returns {Object|null} An object containing the extracted path and extension, or null if no match is found.
* @property {string} path - The extracted path, or an empty string if no path is present.
* @property {string} extension - The extracted file extension.
*
* @example
* // Example usage:
* const inputString = 'resources/js/❋❋/❋.js';
* const result = extractExtensionAndPath(inputString);
* console.log(result);
* Output: { path: 'resources/js', extension: 'js' }
*/
export function extractExtensionAndPath(inputString) {
    // Use a regular expression to match the path and extension
    const regex = /^(.*\/)?(?:\*\*\/)?(.*(?=\.[^.]+(\*|\?)?$))/;

    // Use the regex to extract the path and extension
    const match = inputString.match(regex);

    // Check if there's a match
    if (match) {
        const path = match[1] || ''; // If no path is present, default to an empty string
        const extension = match[2];
        return { path, extension };
    } else {
        // Return null or handle the case where there's no match
        return null;
    }
}
