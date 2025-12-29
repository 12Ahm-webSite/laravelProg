# Laravel Nova Setup for Shaheq

## Installation Steps

### 1. Install Laravel Nova
```bash
composer require laravel/nova
```

### 2. Publish Nova Assets
```bash
php artisan nova:install
```

### 3. Create Nova User
```bash
php artisan nova:user
```

### 4. Run Migrations
```bash
php artisan migrate
```

## Admin Access

### Default Admin User
- Email: `admin@shaheq.com`
- Password: Set during `php artisan nova:user` command

### Access URL
- Nova Admin Panel: `http://your-domain.com/nova`

## Available Resources

### 1. Trips
- **Fields**: Title, Description, Price, Duration, Location, Category, Guide, etc.
- **Actions**: Toggle Featured, Toggle Active, Duplicate Trip
- **Filters**: Status, Category, Difficulty Level

### 2. Trip Categories
- **Fields**: Name, Description, Icon, Color, Sort Order
- **Relationships**: Has many Trips

### 3. Guides
- **Fields**: Name, Email, Bio, Specialties, Experience, Languages
- **Relationships**: Has many Trips

### 4. Bookings
- **Fields**: Trip, User, Participants Count, Total Amount, Status
- **Actions**: Confirm Booking, Cancel Booking, Mark as Paid
- **Filters**: Status, Payment Status

### 5. Trip Reviews
- **Fields**: Trip, User, Rating, Comment, Approval Status
- **Actions**: Approve Review, Reject Review
- **Filters**: Status, Rating

### 6. Users
- **Fields**: Name, Email, Password
- **Relationships**: Has many Bookings, Has many Reviews

## Dashboard Cards

### 1. Trip Stats Card
- Total Trips
- Active Trips
- Featured Trips
- Total Bookings
- Pending Bookings
- Confirmed Bookings
- Total Reviews
- Approved Reviews
- Average Rating

### 2. Recent Bookings Card
- Latest 10 bookings with trip details
- Status and payment information

### 3. Upcoming Trips Card
- Next 10 upcoming trips
- Location, price, and availability

## Features

### Bulk Actions
- Toggle featured status for multiple trips
- Toggle active status for multiple trips
- Duplicate trips
- Confirm multiple bookings
- Cancel multiple bookings
- Approve/reject multiple reviews

### Advanced Filtering
- Filter trips by status, category, difficulty
- Filter bookings by status and payment status
- Filter reviews by approval status and rating

### Search Functionality
- Full-text search across all resources
- Search by title, description, location, etc.

## Security

### Access Control
- Only users with `admin@shaheq.com` email can access Nova
- Configured in `NovaServiceProvider.php`

### Data Protection
- All sensitive data is properly protected
- User passwords are hashed
- Payment information is secured

## Customization

### Branding
- Logo and colors can be customized in `config/nova.php`
- Primary color: Teal (24, 182, 155, 0.5)

### Localization
- Arabic language support for field labels
- RTL text direction support

## Troubleshooting

### Common Issues
1. **Nova not accessible**: Check if NovaServiceProvider is registered
2. **Permission denied**: Verify user email in NovaServiceProvider
3. **Assets not loading**: Run `php artisan nova:publish`

### Support
- Check Laravel Nova documentation
- Verify all migrations are run
- Ensure proper file permissions
