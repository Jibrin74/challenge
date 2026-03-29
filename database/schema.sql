-- Schema for Nexora Payment Platform Database

-- Table for Users
CREATE TABLE IF NOT EXISTS users (
    user_id SERIAL PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP,
    is_active BOOLEAN DEFAULT TRUE
);

-- Table for Transactions
CREATE TABLE IF NOT EXISTS transactions (
    transaction_id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users(user_id),
    amount DECIMAL(10, 2) NOT NULL,
    currency_id INT REFERENCES currencies(currency_id),
    transaction_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(20) DEFAULT 'pending',
    UNIQUE(user_id, transaction_date) -- to avoid duplicate transactions
);

-- Table for Wallets
CREATE TABLE IF NOT EXISTS wallets (
    wallet_id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users(user_id),
    balance DECIMAL(10, 2) DEFAULT 0,
    currency_id INT REFERENCES currencies(currency_id)
);

-- Table for Currencies
CREATE TABLE IF NOT EXISTS currencies (
    currency_id SERIAL PRIMARY KEY,
    currency_code VARCHAR(10) NOT NULL UNIQUE,
    currency_name VARCHAR(50) NOT NULL
);

-- Table for Exchange Rates
CREATE TABLE IF NOT EXISTS exchange_rates (
    rate_id SERIAL PRIMARY KEY,
    currency_from INT REFERENCES currencies(currency_id),
    currency_to INT REFERENCES currencies(currency_id),
    exchange_rate DECIMAL(10, 6) NOT NULL,
    rate_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(currency_from, currency_to)
);

-- Table for Admin Logs
CREATE TABLE IF NOT EXISTS admin_logs (
    log_id SERIAL PRIMARY KEY,
    admin_id INT REFERENCES users(user_id),
    action VARCHAR(255) NOT NULL,
    action_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for KYC Verification
CREATE TABLE IF NOT EXISTS kyc_verification (
    kyc_id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users(user_id),
    verification_status VARCHAR(20) DEFAULT 'pending',
    verification_date TIMESTAMP,
    uploaded_documents JSONB,
    UNIQUE(user_id)
);