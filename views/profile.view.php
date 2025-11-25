<?php
require "templates/header.php";

$userBalance = 1250;
$recentTransactions = [
    ['type' => 'received', 'from' => 'user123', 'amount' => 500, 'time' => '10 мин назад'],
    ['type' => 'sent', 'to' => 'user456', 'amount' => 200, 'time' => '1 час назад'],
    ['type' => 'received', 'from' => 'admin', 'amount' => 100, 'time' => '3 часа назад'],
    ['type' => 'sent', 'to' => 'user789', 'amount' => 50, 'time' => 'вчера']
];

// Данные пользователя (пример)
$userData = [
    'username' => $_SESSION['user']['username'],
    'email' => 'user@example.com',
    'join_date' => '15 января 2024',
    'user_id' => 'PB' . rand(10000, 99999),
    'status' => 'Активный'
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
        max-width: 1000px;
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
        border-bottom: 1px solid #2d3748;
    }

    .profile-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        padding: 30px;
    }

    @media (max-width: 768px) {
        .profile-container {
            grid-template-columns: 1fr;
        }
    }

    .profile-card {
        background: #2d3748;
        border-radius: 12px;
        padding: 25px;
        border: 1px solid #4a5568;
    }

    .profile-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
    }

    .avatar {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #667086, #4299e1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: bold;
    }

    .user-info h2 {
        margin: 0 0 5px 0;
        color: white;
        font-size: 1.5rem;
    }

    .user-id {
        color: #a0aec0;
        font-size: 0.9rem;
    }

    .info-grid {
        display: grid;
        gap: 15px;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #4a5568;
    }

    .info-label {
        color: #a0aec0;
        font-size: 0.9rem;
    }

    .info-value {
        color: white;
        font-weight: 500;
    }

    .status-badge {
        background: #48bb78;
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: bold;
    }


    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-top: 20px;
    }

    .stat-item {
        text-align: center;
        padding: 15px;
        background: #1a202c;
        border-radius: 8px;
    }

    .stat-number {
        font-size: 1.5rem;
        font-weight: bold;
        color: #4299e1;
        display: block;
    }

    .stat-label {
        color: #a0aec0;
        font-size: 0.8rem;
        margin-top: 5px;
    }

    .btn-ac {
        background: #1a202c;
        padding: 15px;
        width: 100%;
        display: inline-block;
        text-align: center;
        border-radius: 10px;
        font-size: 1rem;
        transition: 0.3s ease;
    }

    .btn-ac:hover {
        transform: translateY(2px);
        background-color: #4299e1;
    }
</style>
<main>
    <div class="dashboard">
        <div class="dashboard-header">
            <h1 style="margin: 0; color: white;">User profile</h1>
            <p style="margin: 10px 0 0 0; color: #a0aec0;">Manage your PointsBank account</p>
        </div>

        <div class="profile-container">
            <div class="profile-card">
                <div class="profile-header">
                    <div class="avatar">
                    </div>
                    <div class="user-info">
                        <h2><?= htmlspecialchars($user->username) ?></h2>
                        <div class="user-id ">ID: <span <?= ($user->status == "Banned") ? "style=\"filter: blur(5px);\"" : ""; ?>><?= ($user->status == "Banned") ? "XXXX" : $user->id; ?></span></div>
                    </div>
                </div>

                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Email</span>
                        <span class="info-value"><?= htmlspecialchars($user->email) ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Register Date</span>
                        <span class="info-value" <?= ($user->status == "Banned") ? "style=\"filter: blur(5px);\"" : ""; ?>><?= ($user->status == "Banned") ? "XXXX-XX-XX XX:XX:XX" : $user->reg_date; ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Status</span>
                        <span class="status-badge" <?= ($user->status == "Banned") ? "style=\"background: #d1757d;\"" : ""; ?>><?= htmlspecialchars($user->status) ?></span>
                    </div>
                </div>

                <div class="stats-grid">
                    <div class="stat-item">
                        <span class="stat-number">12</span>
                        <span class="stat-label">Транзакций</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">8</span>
                        <span class="stat-label">Контактов</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">95%</span>
                        <span class="stat-label">Успешно</span>
                    </div>
                </div>
            </div>
            <div class="profile-card">
                <h3 style="text-align: center; margin-bottom: 10px">Account actions</h3>
                <a class="btn-ac" href="/logout">Log out</a>
            </div>


        </div>
    </div>
</main>

<?php
require "templates/footer.php";
?>