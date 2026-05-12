# Render.com Deployment Guide

This guide will help you deploy the **Custom Login Reset Pass** application to Render.com.

## Prerequisites

- GitHub account with access to this repository
- Render.com account (free tier available)
- Database (MySQL or PostgreSQL) for production use

## Deployment Steps

### 1. Connect Repository to Render.com

1. Go to [Render.com Dashboard](https://dashboard.render.com)
2. Click **New** → **Web Service**
3. Select **Deploy an existing repository**
4. Connect your GitHub account and select `khokoon/Custom_login_reset_pass`
5. Select the **deployment** branch

### 2. Configure the Web Service

- **Name**: `custom-login-reset-pass` (or your preferred name)
- **Runtime**: Docker
- **Region**: Oregon (or your preferred region)
- **Plan**: Free tier or Starter
- **Branch**: `deployment`

### 3. Set Environment Variables

In the Render.com dashboard, add the following environment variables under **Environment**:

```
APP_NAME=Custom Login Reset Pass
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_KEY_HERE (generate in local environment)
APP_URL=https://your-app-name.onrender.com

DB_CONNECTION=mysql
DB_HOST=your_database_host
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password

LOG_CHANNEL=single
CACHE_DRIVER=file
SESSION_DRIVER=file

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=your_email@mailtrap.io
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
```

### 4. Configure Build & Start Commands

These are already configured in `render.yaml`:

- **Build Command**: `composer install --no-dev --optimize-autoloader && php artisan migrate --force`
- **Start Command**: `php -S 0.0.0.0:8000 -t public`

### 5. Add Database (Optional but Recommended)

For production, use a managed database:

1. Go to **Databases** in Render.com
2. Create a new PostgreSQL or MySQL database
3. Copy the connection string
4. Update your environment variables with the database credentials

### 6. Deploy

1. Click **Create Web Service**
2. Render.com will automatically build and deploy from the `deployment` branch
3. Monitor the deployment logs in the Dashboard

### 7. Post-Deployment

After successful deployment:

1. Visit your app URL: `https://your-app-name.onrender.com`
2. Run migrations: `php artisan migrate` (if not done automatically)
3. Clear cache: `php artisan cache:clear`
4. Generate application key if needed: `php artisan key:generate`

## Auto-Deploy Configuration

The `render.yaml` file has `autoDeployOnPush: true`, which means:
- Every push to the `deployment` branch will trigger an automatic deployment
- You can watch the deployment progress in the Render.com Dashboard

## Troubleshooting

### Application Not Starting

Check the logs in Render.com Dashboard:
1. Go to **Logs** tab
2. Look for error messages
3. Common issues:
   - Missing environment variables
   - Database connection errors
   - Composer dependency issues

### Database Connection Failed

- Verify `DB_HOST`, `DB_USERNAME`, and `DB_PASSWORD` in environment variables
- Ensure your database is accessible from Render.com
- Check database firewall rules

### Storage/Cache Permissions

The Dockerfile handles this, but if issues occur:
- Ensure `storage/` and `bootstrap/cache/` directories are writable
- Run: `chmod -R 775 storage bootstrap/cache`

## Important Notes

⚠️ **Security**:
- Never commit `.env` file to version control
- Use Render.com's environment variables for sensitive data
- Change `APP_KEY` for production
- Set `APP_DEBUG=false` in production

⚠️ **File Uploads**:
- Use cloud storage (AWS S3, etc.) for file uploads
- Local file storage may be lost when Render.com restarts the service

⚠️ **Database**:
- Set up regular backups for your production database
- Use strong passwords for database credentials

## Support

- [Render.com Documentation](https://render.com/docs)
- [Laravel Deployment Guide](https://laravel.com/docs/deployment)
- Check application logs in Render.com Dashboard for debugging

---

**Deployment Branch**: `deployment`  
**Last Updated**: 2026-05-12
