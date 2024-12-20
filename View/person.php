<?php
/**
 * @var array $unlikedUser
 */
?>
<form id="person-form">
    <div class="row">
        <div class="col-6">
            <label for="first_name" class="form-label">Prénom</label>
            <input type="text" name="first_name" id="first_name" class="form-control"
                   value="<?php echo isset($person['first_name']) ? $person['first_name'] : ""; ?>" required>
        </div>
        <div class="col-6">
            <label for="last_name" class="form-label">Nom</label>
            <input type="text" class="form-control" name="last_name" id="last_name"
                   value="<?php echo isset($person['last_name']) ? $person['last_name'] : ""; ?>" required>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <label for="address" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="address" name="address"
                   value="<?php echo isset($person['address']) ? $person['address'] : ""; ?>" required>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6">
            <label for="zip_code" class="form-label">Zip code</label>
            <input type="text" class="form-control" id="zip_code" name="zip_code"
                   value="<?php echo isset($person['zip_code']) ? $person['zip_code'] : ""; ?>" required>
        </div>
        <div class="col-6">
            <label for="city" class="form-label">Ville</label>
            <input type="text" class="form-control" id="city" name="city"
                   value="<?php echo isset($person['city']) ? $person['city'] : ""; ?>" required>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6">
            <label for="phone" class="form-label">N° de Tel</label>
            <input type="tel" class="form-control" id="phone" name="phone"
                   value="<?php echo isset($person['phone']) ? $person['phone'] : ""; ?>" required>
        </div>
    </div>
    <div class="row mt-2">
        <div class="form-check">
            <input class="form-check-input" type="radio"  value="1"  id="student" name="type" <?php echo !isset($person['type']) || $person['type'] === 1 ? "checked" : "";?>>
            <label class="form-check-label" for="flexCheckDefault">
                Student
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" value="2" id="prof" name="type" <?php echo isset($person['type'])&&$person['type']===2 ? "checked" : "" ?>>
            <label class="form-check-label" for="flexCheckChecked">
                Prof
            </label>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <label for="linked_user_id" class="form-check-label">Compte utilisateur lié</label>
            <select name="linked_user_id" id="linked_user_id" class="form-control" <?php echo isset($person) && $person['user_id']!== null ? "disabled" : ""?>
                <option value="">Veuillez choisir un Utilisateur</option>
                <?php foreach ($unlikedUser as $user) :?>
                    <option
                            value="<?php echo $user["id"]?>"
                        <?php echo isset($person) && $person['user_id'] === $user['id'] ? "selected" : ""?>
                    >
                        <?php echo $user["username"]?>
                    </option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <div class=" mt-2 text-end">
        <button type="button" id="valid-btn-form" class="btn <?php echo isset($id) ? "btn-success" : "btn-primary" ?>"
                name="<?php echo isset($id) ? "edit_button" : "valid_button"; ?>"> <?php echo isset($id) ? "Modifier" : "Créer"; ?></button>
    </div>

</form>

<script src="./Assets/JavaScript/Services/person.js" type="module"></script>
<script type="module">
    import {handlePersonForm} from "./Assets/JavaScript/Components/person.js";


    document.addEventListener('DOMContentLoaded', () =>{
        handlePersonForm()

    })
</script>