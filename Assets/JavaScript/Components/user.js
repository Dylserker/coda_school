import {toggleUser} from "../Services/user.js";

    export const eventUsers = () => {
        const toggleEnabledLinkElements = document.querySelectorAll('.toggle-enable-link')
        const spinnerStatusElement = document.querySelector('#statut-spinner')
        for (let i = 0; i < toggleEnabledLinkElements.length; i++){
            toggleEnabledLinkElements[i].addEventListener('click',(event) =>{
                spinnerStatusElement.classList.remove('d-none')
                const idToToggle = event.target.getAttribute('data-id')
                toggleUser(idToToggle)
                if (event.target.classList.contains('fa-user-check')){
                    event.target.classList.remove('fa-user-check', 'text-success')
                    event.target.classList.add('fa-user-lock', 'text-danger')
                }else if (event.target.classList.contains('fa-user-lock')){
                    event.target.classList.remove('fa-user-lock', 'text-danger')
                    event.target.classList.add('fa-user-check', 'text-success')
                }
                spinnerStatusElement.classList.add('d-none')
            })
        }
    }

