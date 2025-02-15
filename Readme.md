# Requirements
## Before you begin, ensure your system meets the following requirements:
- PHP: Version 8.0 or higher
- MySQL: Version 5.6 or higher
- Composer: 2.0
- Server: Apache2 / NGINX

# Manual Installation
### Follow steps to install
Install Composer 
``` 
composer install 
```
Copy and set environment variables
```
cp .env.example .env
```
Import ```db.sql```  to your database

# Auto Installation

Give execution permission to ```setup.sh```
```
sudo chmod -R 777 setup.sh
```
Run shell scrpt ```setup.sh```
```
sudo ./setup.sh
```

THANK YOU