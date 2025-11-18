<?php
require "templates/header.php";

$userBalance = 1250;
$recentTransactions = [
    ['type' => 'received', 'from' => 'user123', 'amount' => 500, 'time' => '10 мин назад'],
    ['type' => 'sent', 'to' => 'user456', 'amount' => 200, 'time' => '1 час назад'],
    ['type' => 'received', 'from' => 'admin', 'amount' => 100, 'time' => '3 часа назад'],
    ['type' => 'sent', 'to' => 'user789', 'amount' => 50, 'time' => 'вчера']
];
?>
<style>
    main {
        display: flex;
        flex-direction: column;
        align-items: center;
        min-height: 70vh;
        padding: 20px 0;
    }

    .dashboard {
        background-color: #202531;
        width: 90%;
        max-width: 1200px;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(92, 139, 215, 0.2);
        margin-bottom: 20px;
    }

    .dashboard-header {
        background: rgba(32, 37, 49);
        padding: 30px;
        color: white;
        position: relative;
    }

    .text-block {
        background-color: #fcfffd;
        color: #0b0e16;
        font-weight: 600;
        border-radius: 5px;
        padding: 10px;
        display: inline-flex;
        align-items: center;
        text-align: center;
        justify-content: center;
    }
</style>
<main>
    <div class="dashboard">
        <div class="dashboard-header">
            <h1>Hi, <?= htmlspecialchars($user->username); ?></h1>
        </div>
    </div>
</main>

<?php
require "templates/footer.php";
?>