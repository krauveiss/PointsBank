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

    #main-text {
        font-size: 100px;
        text-align: center;
    }

    h2 {
        color: #e1e5ea;
        font-weight: 400;
        margin-top: 20px;
        text-align: center;
    }

    #try-btn {
        margin-top: 80px;
        background-color: rgba(119, 161, 227, 1);
        padding: 20px;
        border: 0;
        color: #0A0E15;
        font-size: 20px;
        border-radius: 20px;
        box-shadow: 0 4px 70px #8eb2ea;
        transition: 0.3s ease;
        cursor: pointer;
    }

    #try-btn:hover {
        transform: translateY(5px);
    }
</style>
<main>
    <h1 id="main-text">Control your Points transactions.</h1>
    <h2>App can help you to make your online points transactions fast, easy, secure.</h2>
    <button id="try-btn">Try it now</button>
</main>
<?php
require "templates/footer.php";
?>