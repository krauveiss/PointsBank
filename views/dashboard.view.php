<?php
require "templates/header.php";
$availableCurrencies = [
    'points' => 'Simple Points',
    'gold' => 'Gold Points',
    'silver' => 'Silver Points',
    'premium' => 'Premium Points'
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
        display: flex;
        flex-direction: column;
        gap: 15px;
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
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        cursor: pointer;
        border: none;
        color: white;
    }

    .btn-ac:hover {
        transform: translateY(2px);
        background-color: #4299e1;
    }

    .wallet-item {
        background-color: #202531;
        padding: 20px;
        border-radius: 12px;
        border: 1px solid #2d3748;
        position: relative;
        transition: all 0.3s ease;
        min-width: 200px;
    }

    .wallet-item:hover {
        border-color: #4299e1;
        box-shadow: 0 4px 12px rgba(66, 153, 225, 0.15);
    }

    .status {
        position: absolute;
        top: 12px;
        right: 12px;
        background: #48bb78;
        color: white;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 0.7rem;
        font-weight: 600;
    }

    .balance {
        font-size: 1.8rem;
        font-weight: bold;
        color: #e2e8f0;
        margin-bottom: 5px;
    }

    .currency {
        color: #a0aec0;
        font-size: 0.9rem;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
    }

    .modal-content {
        background-color: #202531;
        margin: 10% auto;
        padding: 0;
        border-radius: 15px;
        width: 90%;
        max-width: 500px;
        box-shadow: 0 4px 20px rgba(92, 139, 215, 0.3);
        border: 1px solid #2d3748;
    }

    .modal-header {
        padding: 20px 30px;
        border-bottom: 1px solid #2d3748;
    }

    .modal-header h3 {
        margin: 0;
        color: white;
        font-size: 1.3rem;
    }

    .modal-body {
        padding: 30px;
    }

    .currency-options {
        display: grid;
        gap: 15px;
        margin-bottom: 25px;
    }

    .currency-option {
        background: #2d3748;
        border: 2px solid #4a5568;
        border-radius: 10px;
        padding: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .currency-option:hover {
        border-color: #4299e1;
        background: #2d3748;
    }

    .currency-option.selected {
        border-color: #48bb78;
        background: rgba(72, 187, 120, 0.1);
    }

    .currency-icon {
        width: 40px;
        height: 40px;
        background: #4299e1;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .currency-info {
        flex-grow: 1;
    }

    .currency-name {
        color: white;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .currency-desc {
        color: #a0aec0;
        font-size: 0.8rem;
    }

    .modal-actions {
        display: flex;
        gap: 15px;
        justify-content: flex-end;
    }

    .btn-cancel {
        background: #4a5568;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .btn-cancel:hover {
        background: #2d3748;
    }

    .btn-create {
        background: #4299e1;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .btn-create:hover {
        background: #3182ce;
    }

    .btn-create:disabled {
        background: #4a5568;
        cursor: not-allowed;
    }

    #walletForm {
        display: none;
    }
</style>

<form id="walletForm" action="/new_wallet" method="POST">
    <input type="hidden" name="currency" id="selectedCurrency">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
</form>

<main>
    <div class="dashboard">
        <div class="dashboard-header">
            <h1 style="margin: 0; color: white;">Bank Dashboard</h1>
            <p style="margin: 10px 0 0 0; color: #a0aec0;">Manage your Transactions</p>
        </div>

        <div class="profile-container">
            <div class="profile-card">
                <div>
                    <button class="btn-ac" onclick="openModal()">
                        <svg width="30px" height="30px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" style="background-color: transparent">
                            <path d="M11.002 11.2502C10.5878 11.2502 10.252 11.586 10.252 12.0002C10.252 12.4145 10.5878 12.7502 11.002 12.7502V11.2502ZM13.002 12.7502C13.4162 12.7502 13.752 12.4145 13.752 12.0002C13.752 11.586 13.4162 11.2502 13.002 11.2502V12.7502ZM13.002 11.2502C12.5878 11.2502 12.252 11.586 12.252 12.0002C12.252 12.4145 12.5878 12.7502 13.002 12.7502V11.2502ZM15.002 12.7502C15.4162 12.7502 15.752 12.4145 15.752 12.0002C15.752 11.586 15.4162 11.2502 15.002 11.2502V12.7502ZM13.752 12.0002C13.752 11.586 13.4162 11.2502 13.002 11.2502C12.5878 11.2502 12.252 11.586 12.252 12.0002H13.752ZM12.252 14.0002C12.252 14.4145 12.5878 14.7502 13.002 14.7502C13.4162 14.7502 13.752 14.4145 13.752 14.0002H12.252ZM12.252 12.0002C12.252 12.4145 12.5878 12.7502 13.002 12.7502C13.4162 12.7502 13.752 12.4145 13.752 12.0002H12.252ZM13.752 10.0002C13.752 9.58603 13.4162 9.25024 13.002 9.25024C12.5878 9.25024 12.252 9.58603 12.252 10.0002H13.752ZM11.002 12.7502H13.002V11.2502H11.002V12.7502ZM13.002 12.7502H15.002V11.2502H13.002V12.7502ZM12.252 12.0002V14.0002H13.752V12.0002H12.252ZM13.752 12.0002V10.0002H12.252V12.0002H13.752Z" fill=white />
                        </svg>
                        Create a new wallet
                    </button>
                </div>
                <div class="wallet-item">
                    <div class="status">Active</div>
                    <div class="balance">0,3</div>
                    <div class="currency">Simple Points</div>
                </div>
                <div class="wallet-item">
                    <div class="status">Active</div>
                    <div class="balance">0,3</div>
                    <div class="currency">Simple Points</div>
                </div>
                <div class="wallet-item">
                    <div class="status">Active</div>
                    <div class="balance">0,3</div>
                    <div class="currency">Simple Points</div>
                </div>
            </div>
            <div class="profile-card">
            </div>
        </div>
    </div>
</main>

<div id="currencyModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Select Currency</h3>
        </div>
        <div class="modal-body">
            <div class="currency-options" id="currencyOptions">
                <?php foreach ($availableCurrencies as $key => $name): ?>
                    <div class="currency-option" data-currency="<?= $key ?>">
                        <div class="currency-icon">
                            <?= $key === 'points' ? '💰' : ($key === 'gold' ? '🥇' : ($key === 'silver' ? '🥈' : '💎')) ?>
                        </div>
                        <div class="currency-info">
                            <div class="currency-name"><?= $name ?></div>
                            <div class="currency-desc">
                                <?= $key === 'points' ? 'Основная валюта системы' : ($key === 'gold' ? 'Премиальная валюта' : ($key === 'silver' ? 'Серебряные баллы' : 'Эксклюзивная валюта')) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="modal-actions">
                <button class="btn-cancel" onclick="closeModal()">Cancel</button>
                <button class="btn-create" id="createBtn" disabled onclick="createWallet()">Create Wallet</button>
            </div>
        </div>
    </div>
</div>

<script>
    let selectedCurrency = null;

    function openModal() {
        document.getElementById('currencyModal').style.display = 'block';
        selectedCurrency = null;
        updateCreateButton();
    }

    function closeModal() {
        document.getElementById('currencyModal').style.display = 'none';
        document.querySelectorAll('.currency-option').forEach(option => {
            option.classList.remove('selected');
        });
        selectedCurrency = null;
    }

    function selectCurrency(currency) {
        selectedCurrency = currency;
        document.querySelectorAll('.currency-option').forEach(option => {
            if (option.dataset.currency === currency) {
                option.classList.add('selected');
            } else {
                option.classList.remove('selected');
            }
        });

        updateCreateButton();
    }

    function updateCreateButton() {
        const createBtn = document.getElementById('createBtn');
        createBtn.disabled = !selectedCurrency;
    }

    function createWallet() {
        if (!selectedCurrency) return;
        document.getElementById('selectedCurrency').value = selectedCurrency;

        document.getElementById('walletForm').submit();
    }

    window.onclick = function(event) {
        const modal = document.getElementById('currencyModal');
        if (event.target === modal) {
            closeModal();
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.currency-option').forEach(option => {
            option.addEventListener('click', function() {
                selectCurrency(this.dataset.currency);
            });
        });
    });
</script>

<?php
require "templates/footer.php";
?>