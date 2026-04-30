# Security Notes (Namecheap cPanel + PHP/MySQL)

- Use SSL/HTTPS for the full site and force HTTPS redirects.
- Keep PHP version updated in cPanel.
- Use strong, unique cPanel, FTP, and database passwords.
- Do not expose `config.php`; if possible store secrets outside public web root.
- Use PDO prepared statements for all SQL queries.
- Never store payment card information in this website database.
- Make regular full backups (files + database).
- Use Namecheap/cPanel SSL certificate tools and renew certificates on time.
- Use phpMyAdmin only for admin database work with least-privilege DB users.
