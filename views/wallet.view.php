<?php
require "templates/header.php";
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
        padding: 25px;
        color: white;
        border-bottom: 1px solid #2d3748;
    }

    .balance-section {
        background: #2d3748;
        padding: 25px;
        border-bottom: 1px solid #4a5568;
    }

    .balance-card {
        background: #1a202c;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid #4299e1;
        text-align: center;
    }

    .balance-amount {
        font-size: 2rem;
        font-weight: bold;
        color: #4299e1;
        margin-bottom: 5px;
    }

    .balance-currency {
        color: #a0aec0;
        font-size: 1rem;
    }

    .transfer-section {
        background: #2d3748;
        padding: 25px;
        border-bottom: 1px solid #4a5568;
    }

    .transfer-form {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr auto;
        gap: 15px;
        align-items: end;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-label {
        color: #a0aec0;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .form-input {
        background: #1a202c;
        border: 1px solid #4a5568;
        border-radius: 8px;
        padding: 12px;
        color: white;
        font-size: 0.9rem;
    }

    .form-input:focus {
        outline: none;
        border-color: #4299e1;
    }

    .btn-transfer {
        background: #4299e1;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 12px 25px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .btn-transfer:hover {
        background: #3182ce;
    }

    .transactions-section {
        padding: 25px;
    }

    .transactions-table {
        width: 100%;
        border-collapse: collapse;
        background: #2d3748;
        border-radius: 10px;
        overflow: hidden;
    }

    .transactions-table th {
        background: #1a202c;
        color: #e2e8f0;
        padding: 15px 12px;
        text-align: left;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #4299e1;
    }

    .transactions-table td {
        padding: 12px;
        border-bottom: 1px solid #4a5568;
        color: #cbd5e0;
        font-size: 0.9rem;
    }

    .transactions-table tr:hover {
        background: rgba(66, 153, 225, 0.05);
    }

    .type-badge {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .type-transfer {
        background: rgba(66, 153, 225, 0.2);
        color: #4299e1;
    }

    .type-system {
        background: rgba(159, 122, 234, 0.2);
        color: #9f7aea;
    }

    .amount-positive {
        color: #48bb78;
        font-weight: 600;
    }

    .amount-negative {
        color: #f56565;
        font-weight: 600;
    }

    .account-cell {
        font-family: sans-serif;
        font-size: 0.85rem;
    }

    .account-you {
        color: #4299e1;
        font-weight: 600;
    }

    .no-transactions {
        text-align: center;
        padding: 40px;
        color: #a0aec0;
        background: #2d3748;
        border-radius: 10px;
        border: 2px dashed #4a5568;
    }

    @media (max-width: 768px) {
        .transfer-form {
            grid-template-columns: 1fr;
        }

        .transactions-table {
            font-size: 0.8rem;
        }

        .transactions-table th,
        .transactions-table td {
            padding: 8px 6px;
        }
    }
</style>

<main>
    <div class="dashboard">
        <div class="dashboard-header">
            <h1 style="margin: 0; color: white; font-size: 1.5rem;">Wallet #<?= $wallet->id ?></h1>
            <p style="margin: 8px 0 0 0; color: #a0aec0; font-size: 0.9rem;">Manage your funds and transactions</p>
        </div>
        <div class="balance-section">
            <div class="balance-card">
                <div class="balance-amount"><?= number_format($wallet->balance, 2) ?></div>
                <div class="balance-currency"><?= strtoupper($wallet->currency) ?></div>
            </div>
        </div>

        <div class="transfer-section">
            <h3 style="color: white; margin-bottom: 20px;">Transfer Funds</h3>
            <form method="POST" action="/transfer/?id=<?= $wallet->id ?>" class="transfer-form">
                <div class="form-group">
                    <label class="form-label">Recipient Wallet ID</label>
                    <input type="number" name="destination" class="form-input" placeholder="Enter wallet ID" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Amount</label>
                    <input type="number" step="0.01" name="amount" class="form-input" placeholder="0.00" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Comment</label>
                    <input type="text" name="comment" class="form-input" placeholder="-" required>
                </div>
                <button type="submit" class="btn-transfer">Send</button>
            </form>
        </div>

        <div class="transactions-section">
            <h3 style="color: white; margin-bottom: 20px;">Transaction History</h3>

            <?php if (!empty($transactions)): ?>
                <table class="transactions-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Currency</th>
                            <th>Sender</th>
                            <th>Recipient</th>
                            <th>Amount</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transactions as $item):
                            $isSent = $item->sender == $wallet->id;
                            $isSystem = $item->sender == 1;
                        ?>
                            <tr>
                                <td>#<?= $item->id ?></td>
                                <td><?= date('M j, Y H:i', strtotime($item->date)) ?></td>
                                <td>
                                    <span class="type-badge <?= $isSystem ? 'type-system' : 'type-transfer' ?>">
                                        <?= $isSystem ? 'SYSTEM' : 'TRANSFER' ?>
                                    </span>
                                </td>
                                <td><?= strtoupper($item->currency) ?></td>
                                <td class="account-cell <?= $item->sender == $wallet->id ? 'account-you' : '' ?>">
                                    <?= $item->sender == $wallet->id ? 'You' : '#' . $item->sender ?>
                                </td>
                                <td class="account-cell <?= $item->destination == $wallet->id ? 'account-you' : '' ?>">
                                    <?= $item->destination == $wallet->id ? 'You' : '#' . $item->destination ?>
                                </td>
                                <td class="<?= $isSent ? 'amount-negative' : 'amount-positive' ?>">
                                    <?= $isSent ? '-' : '+' ?><?= number_format($item->amount, 2) ?>
                                </td>
                                <td><?= $item->comment ?: '-' ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="no-transactions">
                    <h3 style="color: #a0aec0; margin: 0 0 10px 0;">No transactions yet</h3>
                    <p style="margin: 0; color: #718096;">Your transaction history will appear here</p>
                </div>
            <?php endif ?>
        </div>
    </div>
</main>

<?php
require "templates/footer.php";
?>