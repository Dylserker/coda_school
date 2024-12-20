
    export const getPersons = async (page,limit) => {
        const response = await fetch(`index.php?component=persons&page=${page}&limit=${limit}`, {
            headers:{
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        return await response.json()
    }

    export const createPerson = async (form) => {
        const data = new FormData(form)

        const response = await fetch(`index.php?component=person&action=create`, {
            method: "POST",
            headers:{
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: data
        })
        return response.json()

    }
    export const updatePerson = async (form,id) => {
        const data = new FormData(form)

        const response = await fetch(`index.php?component=person&action=update&id=${id}`, {
            method: "POST",
            headers:{
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: data
        })
        return response.json()

    }