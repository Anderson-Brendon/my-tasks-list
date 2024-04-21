const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

let anchorTags = document.querySelectorAll('a:not(.dropdown-toggle)');

document.addEventListener('DOMContentLoaded', ()=>{
    for (const anchor of anchorTags) {
        if(anchor.href == window.location.href){
            anchor.classList.remove('btn-secondary');
            anchor.classList.remove('btn-dark');
            anchor.classList.add('btn-warning');
        }
    }
})


