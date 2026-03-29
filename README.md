# Nexora Payment Platform

A secure, feature-rich international payment platform built with PHP, JavaScript, CSS, HTML, and MySQL 8.2. Integrated with the Interswitch API for processing payments across multiple currencies.

## Features

### Core Features
- **User Authentication**: Secure registration and login system with session management
- **Multi-Currency Wallets**: Support for NGN, USD, EUR, GBP, GHS, KES, ZAR, XOF
- **International Transfers**: Send money across borders instantly
- **Payment Processing**: Card payments, bank transfers, USSD payments
- **Transaction History**: Complete audit trail of all transactions
- **Real-time Exchange Rates**: Currency conversion with competitive rates

### Security Features
- CSRF token protection
- Password hashing with bcrypt
- Session security with HTTP-only cookies
- Input sanitization and validation
- SQL injection prevention with prepared statements
- XSS protection

### Admin Features
- Dashboard with platform statistics
- User management
- KYC verification
- Transaction monitoring
- Audit logs

## Technology Stack

- **Backend**: PHP 8.2+
- **Database**: MySQL 8.2
- **Frontend**: HTML5, CSS3, JavaScript (ES6+)
- **Payment Gateway**: Interswitch API
- **Security**: CSRF tokens, bcrypt hashing, prepared statements

## Installation

### Prerequisites
- PHP 8.2 or higher
- MySQL 8.2 or higher
- Apache/Nginx web server
- SSL certificate (recommended for production)

### Step 1: Clone/Download
Place the project files in your web server directory (e.g., `/var/www/html/payment-platform/`)

### Step 2: Database Setup
1. Create a MySQL database:
```sql
CREATE DATABASE interswitch_payments CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

2. Import the database schema:
```bash
mysql -u root -p interswitch_payments < database/schema.sql
```

### Step 3: Configuration
1. Edit `config/config.php` with your settings:
   - Database credentials
   - Interswitch API credentials (get from Interswitch developer portal)
   - Application URL
   - Email settings

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'interswitch_payments');
define('DB_USER', 'your_db_user');
define('DB_PASS', 'your_db_password');

// Interswitch API Configuration
define('INTERSWITCH_MERCHANT_CODE', 'YOUR_MERCHANT_CODE');
define('INTERSWITCH_TERMINAL_ID', 'YOUR_TERMINAL_ID');
define('INTERSWITCH_CLIENT_ID', 'YOUR_CLIENT_ID');
define('INTERSWITCH_CLIENT_SECRET', 'YOUR_CLIENT_SECRET');
define('INTERSWITCH_API_KEY', 'YOUR_API_KEY');
```

### Step 4: File Permissions
Ensure the web server has write permissions to:
- `logs/` directory (for error logging)

### Step 5: Web Server Configuration

#### Apache (.htaccess)
Create `.htaccess` file in the root:
```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]
```

#### Nginx
```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /var/www/html/payment-platform;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
    }
}
```

### Step 6: Access the Application
- Main site: `http://your-domain.com/payment-platform/`
- Admin panel: `http://your-domain.com/payment-platform/admin/`
- Default admin credentials:
  - Email: `admin@interswitchpay.com`
  - Password: `Admin@123` (change immediately after first login)

## Interswitch API Integration

### Sandbox Environment
The application comes pre-configured with Interswitch sandbox credentials for testing:
- Use test cards provided by Interswitch
- No real money is processed

### Production Environment
To switch to production:
1. Update `config/config.php`:
```php
define('ENVIRONMENT', 'production');
define('INTERSWITCH_BASE_URL', 'https://api.interswitchng.com');
```

2. Replace sandbox credentials with production credentials from Interswitch

## Project Structure

```
payment-platform/
├── admin/                  # Admin panel
│   └── index.php
├── api/                    # API endpoints
│   └── payments/
│       ├── deposit.php
│       └── withdraw.php
├── assets/                 # Static assets
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── main.js
│   └── images/
├── config/                 # Configuration files
│   └── config.php
├── database/               # Database files
│   └── schema.sql
├── includes/               # PHP classes
│   ├── Database.php
│   ├── InterswitchAPI.php
│   ├── Transaction.php
│   └── User.php
├── pages/                  # User pages
│   ├── dashboard.php
│   ├── login.php
│   ├── register.php
│   ├── send-money.php
│   ├── transactions.php
│   └── ...
├── index.php              # Landing page
└── README.md
```

## API Endpoints

### Payment Endpoints
- `POST /api/payments/deposit.php` - Initialize deposit
- `POST /api/payments/withdraw.php` - Process withdrawal

### Request Format
All API requests require:
- `Content-Type: application/x-www-form-urlencoded` or `multipart/form-data`
- `X-Requested-With: XMLHttpRequest` header
- `csrf_token` parameter

### Response Format
```json
{
    "success": true|false,
    "message": "Human readable message",
    "data": { ... }
}
```

## Supported Currencies

| Code | Currency | Country |
|------|----------|---------|
| NGN | Nigerian Naira | Nigeria |
| USD | US Dollar | United States |
| EUR | Euro | European Union |
| GBP | British Pound | United Kingdom |
| GHS | Ghanaian Cedi | Ghana |
| KES | Kenyan Shilling | Kenya |
| ZAR | South African Rand | South Africa |
| XOF | West African CFA | West Africa |

## Transaction Fees

| Transaction Type | Fee |
|-----------------|-----|
| Deposit (Card) | 1.5% (max ₦2,000) |
| Withdrawal | 1.5% (max ₦2,000) |
| Wallet Transfer | Free |
| Currency Exchange | 0.5% |

## Security Considerations

1. **Change default admin password** immediately after installation
2. **Enable HTTPS** in production
3. **Set strong database passwords**
4. **Keep PHP and MySQL updated**
5. **Regular backups** of database
6. **Monitor logs** for suspicious activity
7. **Use environment variables** for sensitive credentials in production

## Troubleshooting

### Database Connection Error
- Verify database credentials in `config/config.php`
- Ensure MySQL is running
- Check database exists

### Payment Processing Error
- Verify Interswitch API credentials
- Check API logs in `api_logs` table
- Ensure cURL is enabled in PHP

### Session Issues
- Check PHP session configuration
- Ensure cookies are enabled in browser
- Clear browser cookies and cache

## Development

### Adding New Currencies
1. Add to `currencies` table
2. Add exchange rates to `exchange_rates` table
3. Update currency symbols in `config.php`

### Customizing Theme
- Edit `assets/css/style.css`
- CSS variables are defined at the top for easy customization

## License

This project is for educational and development purposes. For production use, ensure compliance with:
- PCI DSS (Payment Card Industry Data Security Standard)
- Local financial regulations
- Data protection laws (GDPR, etc.)

## Support

For issues and questions:
1. Check the troubleshooting section
2. Review error logs in `logs/error.log`
3. Contact Interswitch support for API-related issues

## Credits

- Built with [Interswitch API](https://developer.interswitchng.com/)
- Icons and design inspired by modern fintech applications
