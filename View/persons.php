<?php
/**
 * @var array   $persons
 */
?>
    <h1 class="text-center">Liste des personnes</h1>
    <div class="d-flex justify-content-center">
        <div class="spinner-grow text-warning d-none" id="spinner" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="text-end me-5">
        <a href="index.php?component=person&action=create">
            <i class="fa-solid fa-user-plus fa-2xl" style="color: black"></i>
        </a>
    </div>
    <table class="table" id="list-persons">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Last Name</th>
            <th scope="col">First Name</th>
            <th scope="col">Address</th>
            <th scope="col">Type</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <div id="footer-table" class="row">
        <button id="prev-page" type="button" class="col-1 btn ">|<</button>
        <p class="col-10 text-center" id="page-count">Hello</p>
        <button id="next-page" type="button" class="col-1 btn">>|</button>
    </div>

    <script src="./Assets/JavaScript/Services/person.js" type="module"></script>
    <script type="module">
        import {getPersons} from "./Assets/JavaScript/Services/person.js";
        import {GetRow} from "./Assets/JavaScript/Components/person.js";

        document.addEventListener('DOMContentLoaded', async () => {
            const listPersonsElement = document.querySelector('#list-persons')
            const tbody = document.querySelector('#list-persons tbody')

            const nextBtnElement = document.querySelector('#next-page')
            const prevBtnElement = document.querySelector('#prev-page')
            let page = 1
            const limit = 20
            let data = await getPersons(page)
            let  maxPage = Math.ceil((data.personCount.idCount) /limit)

            const displayPersons = async () => {
                const counterPage = document.querySelector('#page-count')
                const spinner = document.querySelector('#spinner')
                spinner.classList.remove('d-none')
                data = await getPersons(page,limit)
                tbody.innerHTML = ""
                for (let i = 0; i < data.persons.length; i++){
                    tbody.innerHTML += GetRow(data.persons[i])
                }
                counterPage.innerHTML = ""
                for ( let i = 1; i <= maxPage; i++){
                    counterPage.innerHTML += `<button type="button" data-page='${i}' class="button-change-page btn m-1 btn-primary">${i}</button>`
                }
                const btnPages = document.querySelectorAll('.button-change-page')
                for ( let u = 0; u < btnPages.length; u++){
                    btnPages[u].addEventListener('click', (event) => {
                        page = event.target.getAttribute('data-page')
                        displayPersons()
                    })
                }
                spinner.classList.add('d-none')
            }

            await displayPersons()

            nextBtnElement.addEventListener('click',async () => {
                if (page < maxPage){
                    page ++
                    await  displayPersons()
                }
            })

            prevBtnElement.addEventListener('click',async () => {
                if (page  > 1){
                    page --
                    await displayPersons()
                }
            })
        })
    </script>