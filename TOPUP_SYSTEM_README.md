# TOPUP GAME SYSTEM - Random Community

## Overview
A comprehensive game top-up system built with Laravel that allows users to purchase in-game currency and items for various popular games. The system features manual admin verification, email notifications, and a user-friendly interface.

## Key Features

### 🎮 Supported Games (10 Games)
1. **Valorant** - Riot Games (VP - Valorant Points)
2. **Genshin Impact** - miHoYo (Primogems)
3. **Roblox** - Roblox Corporation (Robux)
4. **Zenless Zone Zero** - miHoYo (Denny)
5. **Mobile Legends Bang Bang** - Moonton (Diamonds)
6. **PUBG Mobile** - PUBG Corporation (UC - Unknown Cash)
7. **Honkai Star Rail** - miHoYo (Stellar Jade)
8. **Free Fire** - Garena (Diamonds)
9. **Call of Duty Mobile** - Activision (CP - COD Points)
10. **Magic Chess Go Go** - Moonton (Diamonds)

### 🔍 User Features
- **Search Functionality**: Users can search for games by name or publisher
- **Responsive Design**: Lightweight UI optimized for mobile devices
- **Dynamic Package Loading**: Packages load based on selected game
- **Multiple Payment Methods**: Support for QRIS and Bank Transfer
- **Guest User Support**: Non-registered users can make purchases

### 👨‍💼 Admin Features
- **Transaction Management**: View, approve, and reject transactions
- **Game Management**: Add, edit, and delete games with CRUD operations
- **Package Management**: Manage top-up packages with filtering and search
- **Payment Method Management**: Configure payment options
- **Email Notifications**: Automatic emails for approvals and rejections

### 💳 Payment System
- **QRIS Integration**: Uses provided QRIS image for payments
- **Manual Verification**: Admin must manually verify payments
- **Status Tracking**: Pending → Paid → Processed/Rejected
- **Email Confirmations**: Sent after admin verification

## Database Structure

### Tables
- `games` - Game information (name, publisher)
- `topup_packages` - Package details (name, amount, price, game_id)
- `payment_methods` - Payment options (name, type)
- `transactions` - Purchase records (user, game, package, payment, status)

### Key Fields
- **Status Flow**: `pending` → `paid` → `processed`/`rejected`
- **Payment Types**: `qris`, `bank`, `ewallet`
- **Timestamps**: `created_at`, `updated_at` for all tables

## File Structure

### Controllers
- `TopupController` - User-facing top-up operations
- `AdminTopupController` - Admin management operations

### Views
- `topup/index.blade.php` - Main top-up page with search
- `topup/payment.blade.php` - Payment confirmation page
- `topup/success.blade.php` - Success confirmation page
- `admin/topup/index.blade.php` - Transaction management
- `admin/topup/games.blade.php` - Game management
- `admin/topup/packages.blade.php` - Package management
- `admin/topup/payment_methods.blade.php` - Payment method management

### Models
- `Game` - Game entity with packages relationship
- `TopupPackage` - Package entity with game relationship
- `PaymentMethod` - Payment method entity
- `Transaction` - Transaction entity with relationships

### Mail
- `TopupConfirmation` - Approval email template
- `TopupRejection` - Rejection email template

## Installation & Setup

### 1. Database Setup
```bash
# Run migrations (if not already done)
php artisan migrate

# Seed initial data
php artisan db:seed --class=TopupSeeder
```

### 2. Email Configuration
Configure SMTP settings in `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email
MAIL_FROM_NAME="Random Community"
```

### 3. Routes
All routes are automatically registered in `routes/web.php`:
- User routes: `/topup`, `/topup/payment/{id}`, `/topup/success/{id}`
- Admin routes: `/admin/topup/*`

## Usage Guide

### For Users

#### 1. Select Game
- Visit `/topup`
- Use search bar to find games quickly
- Select desired game from the list

#### 2. Choose Package
- Browse available packages for selected game
- View amount and price details
- Select preferred package

#### 3. Payment
- Choose payment method (QRIS recommended)
- Enter player information (ID, server)
- Complete payment via QRIS

#### 4. Confirmation
- Click "Aku sudah bayar" after payment
- Wait for admin verification (1x24 hours)

### For Admins

#### 1. Transaction Management
- Access `/admin/topup`
- View all transactions with status
- Click "View" to see details
- Use "Proses" to approve or "Tolak" to reject

#### 2. Game Management
- Access `/admin/topup/games`
- Add new games with publisher information
- Edit existing game details
- Manage packages for each game

#### 3. Package Management
- Access `/admin/topup/packages`
- Add/edit/delete top-up packages
- Filter by game, search by name, filter by price
- Bulk operations for package management

#### 4. Payment Method Management
- Access `/admin/topup/payment-methods`
- Configure payment options
- Support for QRIS, Bank Transfer, E-Wallet

## Search Functionality

### Game Search
- **Real-time Search**: Instant filtering as user types
- **Multi-field Search**: Search by game name or publisher
- **Case-insensitive**: Works regardless of capitalization
- **Auto-clear**: Search resets when form is reset

### Package Filtering
- **Game Filter**: Filter packages by specific game
- **Text Search**: Search package names
- **Price Range**: Filter by minimum/maximum price
- **Combined Filters**: Multiple filters work together

## Admin Management Features

### Game Management
- **CRUD Operations**: Create, Read, Update, Delete games
- **Package Integration**: Manage packages directly from game view
- **Validation**: Required fields with proper validation
- **Bulk Operations**: Manage multiple packages per game

### Package Management
- **Advanced Filtering**: Multiple filter options
- **Price Management**: Set and update package prices
- **Game Association**: Link packages to specific games
- **Validation**: Ensure data integrity

### Transaction Processing
- **Manual Verification**: Admin reviews each payment
- **Email Notifications**: Automatic customer communication
- **Status Tracking**: Clear transaction lifecycle
- **Audit Trail**: Complete transaction history

## Email Notifications

### Approval Email
- Sent when admin clicks "Proses"
- Includes transaction details
- Delivery timeline (1x24 hours)
- Professional formatting

### Rejection Email
- Sent when admin clicks "Tolak"
- Requires rejection reason
- Professional communication
- Clear next steps

## Security Features

### Input Validation
- Server-side validation for all forms
- SQL injection protection
- XSS protection
- CSRF token validation

### Access Control
- Admin middleware protection
- Route-level security
- User authentication checks
- Guest user support

### Data Integrity
- Foreign key constraints
- Transaction rollback on errors
- Input sanitization
- Proper error handling

## Customization Options

### Adding New Games
1. Access admin panel → Games
2. Click "Add New Game"
3. Enter name and publisher
4. Add packages for the game

### Adding New Packages
1. Access admin panel → Packages
2. Click "Add New Package"
3. Select game, enter details
4. Set amount and price

### Payment Methods
1. Access admin panel → Payment Methods
2. Add new payment types
3. Configure payment options
4. Update existing methods

## Troubleshooting

### Common Issues

#### Seeder Errors
```bash
# If you get column errors, check table structure
DESCRIBE games;
DESCRIBE topup_packages;
DESCRIBE payment_methods;
```

#### Search Not Working
- Check JavaScript console for errors
- Ensure Bootstrap Icons are loaded
- Verify CSS classes are correct

#### Admin Access Issues
- Check admin middleware configuration
- Verify user has admin role
- Check route permissions

### Performance Tips
- Use database indexes on frequently searched fields
- Implement caching for game/package data
- Optimize database queries with eager loading
- Use pagination for large transaction lists

## Future Enhancements

### Planned Features
- **Automated Delivery**: Integration with game APIs
- **Bulk Operations**: Mass package management
- **Analytics Dashboard**: Sales and transaction reports
- **Multi-language Support**: Internationalization
- **Mobile App**: Native mobile application

### Integration Possibilities
- **Payment Gateways**: Midtrans, Xendit integration
- **Game APIs**: Direct game server integration
- **CRM Integration**: Customer relationship management
- **Inventory System**: Stock management for packages

## Support & Maintenance

### Regular Tasks
- Monitor transaction statuses
- Review and process pending payments
- Update game packages as needed
- Backup transaction data

### Monitoring
- Check email delivery status
- Monitor payment method availability
- Review admin activity logs
- Track system performance

---

**Last Updated**: August 13, 2025
**Version**: 2.0.0
**Developer**: Random Community Team 