<?php
require "templates/header.php";
?>
<style>
    main {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 70vh;
    }

    .main-container {
        height: 500px;
        width: 400px;
        background-color: rgba(32, 37, 49);
        border-radius: 15px;
        backdrop-filter: blur(10px);
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 40px;
        box-shadow: 0 4px 200px rgba(92, 139, 215, 0.2);
    }

    form {
        margin-top: 50px;
        display: flex;
        flex-direction: column;
        gap: 30px;

    }

    input {
        background-color: #202531;
        padding: 10px;
        border-radius: 10px;
        outline: none;
        font-size: 17px;
        border: 1px solid white;

        font-family: sans-serif;
        transition: 0.3s ease;


    }

    input:focus {
        transform: translateY(-2px);
        border: 1px solid rgba(92, 139, 215);
        box-shadow: 4px 4px 8px rgba(92, 139, 215, 0.2);
    }

    #head-text {
        margin-top: 30px;
        font-size: 30px;
    }

    #btn-sbmt {
        height: 40px;
        background-color: #8eb2ea;
        color: black;
        outline: none;
        border-radius: 10px;
        font-size: 17px;
        font-weight: 700;
        border: 0;
        cursor: pointer;
        transition: 0.3s ease;
    }

    #btn-sbmt:hover {
        transform: translateY(5px);
        transform: scale(1.05);
        box-shadow: 0px 8px 16px rgba(92, 139, 215,0.5);
    }
</style>
<main>
    <div class="main-container">
        <div id="head-text">
            Register
        </div>
        <form action="/register" method="POST">
            <input type="text" name="username" id="username" placeholder="Username">
            <input type="email" name="email" id="email" placeholder="E-mail">
            <input type="password" name="password" id="password" placeholder="Password">
            <button type="submit" id="btn-sbmt">Submit</button>
        </form>
    </div>
</main>
<?php
require "templates/footer.php";
?>