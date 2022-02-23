<?php
require_once "databaseContr.php"?>
<body>
<link rel="stylesheet" type="text/css" href="style.css">

<div class="upperDiv">
<div>
    ADD TO REGISTRY
    <form method="post">
        <label>
            <input id="name" type="text" name="name" placeholder="Name">
        </label>
        <br>
        <label>
            <input  id="surname" type="text" name="surname" placeholder="Surname">
        </label>
        <br>
        <label>
            <input id="personCode" type="text" name="personCode" placeholder="Person Code">
        </label>
        <br>
        <button type="submit" name="submit">Add</button>
    </form>
</div>

<div>
    REMOVE FROM REGISTRY BY ID
    <form method="post">
        <label>
            <input type="text" name="id" placeholder="ID">
        </label>
        <button type="submit" name="delete">Remove</button>
    </form>
</div>

</div>


    <table>
        <thead>
        <tr>
            <th class="id">
                ID
            </th>
            <th>
                Name
            </th>
            <th>
                Surname
            </th>
            <th>
                Person Code
            </th>
        </tr>
        </thead>
        <tbody id="DataRestart" >
        <?php $dataBase->displayInfo(); ?>
        </tbody>
    </table>

</body>