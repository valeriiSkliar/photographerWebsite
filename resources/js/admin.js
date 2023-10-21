import axios from "axios";
const add_meta_tegs_btn = document.getElementById('add_meta_tegs_btn');
document.addEventListener('DOMContentLoaded', () => {
    add_meta_tegs_btn.addEventListener('click', () => {
        addMetaTeg()
    })
})
function addMetaTeg() {
    const allTegs= axios.get('/api/meta-tags')
        .then(data => console.log(data))
}
console.log('admin panel')
console.log(axios)
