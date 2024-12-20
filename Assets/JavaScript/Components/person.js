import {createPerson, updatePerson} from "../Services/person.js";
import {showToast} from "./Shared/toast.js";

export const GetRow = (person) => {
        const body = `
            <tr>
              <th>${person.id}</th>
              <td>${person.last_name}</td>
              <td>${person.first_name}</td>
              <td>${person.address}</td>
              <td>${person.type === 1 ? "Student" : "Professor"}</td>
              <td><a href="index.php?component=person&action=modify&id=${person.id}"><i class="fa-solid fa-user-pen"></i></a></td>
            </tr>
        `
        return body
    }

    export const handlePersonForm =  () => {
        const validBtnElement = document.querySelector('#valid-btn-form')
        validBtnElement.addEventListener('click', async (event) => {
            const form = document.querySelector('#person-form')
            let result
            let color
            if (!form.checkValidity()){
                form.reportValidity()
                return false
            }
            switch (event.target.name){
                case 'valid_button':
                    result = await createPerson(form)
                    if (result['result']){
                        showToast("L utilisateur a été créer", "bg-success")
                    } else {
                        color = "bg-danger"
                        showToast("Une erreur est survenue", "bg-danger")
                    }
                    break;
                case 'edit_button' :
                    const url = new URLSearchParams(window.location.href)
                    const id = url.get("id")
                    result = await updatePerson(form,id)
                    if (result['result'] === true){
                        showToast("L utilisateur a été modifié","bg-success")
                    } else {
                        color = "bg-danger"
                        showToast("Une erreur est survenue","bg-danger")
                    }
                    break;

            }


        })
    }