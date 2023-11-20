import 'jquery-ui-dist/jquery-ui.js';
import {getCsrfToken} from "@/helpers/getCsrfToken.js";
import {sendUnpinRequest} from "@/functions.js";
import {makeImagesSortable} from "@/admin/gallery/function.js";

document.addEventListener('DOMContentLoaded', makeImagesSortable)

