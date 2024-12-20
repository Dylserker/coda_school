
    export const toggleUser = async (userId) => {
        const response = await fetch(`index.php?component=users&action=toggle-enabled&id=${userId}`, {
            headers:{
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        return await response.json()
    }