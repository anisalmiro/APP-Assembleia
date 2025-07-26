# 🚀 Guia de Instalação - Sistema de Gerenciamento da Igreja

## 📋 Pré-requisitos

Antes de instalar o sistema, certifique-se de que seu servidor atende aos seguintes requisitos:

### Requisitos do Sistema
- **PHP**: 8.1 ou superior
- **Composer**: Última versão
- **Banco de Dados**: SQLite (padrão) ou MySQL/PostgreSQL
- **Servidor Web**: Apache ou Nginx (opcional para desenvolvimento)

### Extensões PHP Necessárias
```bash
# Ubuntu/Debian
sudo apt install php8.1-cli php8.1-sqlite3 php8.1-mbstring php8.1-xml php8.1-curl php8.1-zip php8.1-gd php8.1-bcmath

# CentOS/RHEL
sudo yum install php81-cli php81-sqlite3 php81-mbstring php81-xml php81-curl php81-zip php81-gd php81-bcmath
```

## 📦 Instalação Passo a Passo

### 1. Baixar o Projeto
```bash
# Opção 1: Se usando Git
git clone <repository-url> igreja-management
cd igreja-management

# Opção 2: Se baixou o arquivo ZIP
unzip igreja-management.zip
cd igreja-management
```

### 2. Instalar Dependências
```bash
# Instalar dependências do Composer
composer install

# Se não tiver o Composer instalado:
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### 3. Configurar Ambiente
```bash
# Copiar arquivo de configuração
cp .env.example .env

# Gerar chave da aplicação
php artisan key:generate
```

### 4. Configurar Banco de Dados

#### Opção A: SQLite (Recomendado para início)
```bash
# Criar arquivo do banco
touch database/database.sqlite

# O arquivo .env já está configurado para SQLite
```

#### Opção B: MySQL
```bash
# Editar o arquivo .env
nano .env

# Alterar as configurações:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=igreja_db
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

### 5. Executar Migrations
```bash
# Criar as tabelas do banco
php artisan migrate

# Opcional: Popular com dados de exemplo
php artisan db:seed
```

### 6. Configurar Permissões
```bash
# Dar permissões para os diretórios de cache e logs
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 7. Iniciar o Servidor
```bash
# Para desenvolvimento
php artisan serve

# Para produção, configure seu servidor web (Apache/Nginx)
```

## 🌐 Configuração para Produção

### Apache
Crie um arquivo `.htaccess` na pasta `public`:
```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

### Nginx
Configuração do virtual host:
```nginx
server {
    listen 80;
    server_name seu-dominio.com;
    root /caminho/para/igreja-management/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

## 🔧 Configurações Adicionais

### Configurar Email (Opcional)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=seu-email@gmail.com
MAIL_PASSWORD=sua-senha-app
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=seu-email@gmail.com
MAIL_FROM_NAME="Igreja Manager"
```

### Configurar Timezone
No arquivo `config/app.php`:
```php
'timezone' => 'America/Sao_Paulo',
'locale' => 'pt_BR',
```

## 🔒 Segurança

### 1. Configurar HTTPS
```bash
# Instalar certificado SSL (Let's Encrypt)
sudo apt install certbot python3-certbot-apache
sudo certbot --apache -d seu-dominio.com
```

### 2. Configurar Firewall
```bash
# UFW (Ubuntu)
sudo ufw allow 22
sudo ufw allow 80
sudo ufw allow 443
sudo ufw enable
```

### 3. Backup Automático
Crie um script de backup:
```bash
#!/bin/bash
# backup.sh
DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="/backups/igreja-management"
APP_DIR="/caminho/para/igreja-management"

# Criar diretório de backup
mkdir -p $BACKUP_DIR

# Backup do banco de dados
cp $APP_DIR/database/database.sqlite $BACKUP_DIR/database_$DATE.sqlite

# Backup dos arquivos
tar -czf $BACKUP_DIR/files_$DATE.tar.gz $APP_DIR

# Manter apenas os últimos 30 backups
find $BACKUP_DIR -name "*.sqlite" -mtime +30 -delete
find $BACKUP_DIR -name "*.tar.gz" -mtime +30 -delete
```

## 🚨 Solução de Problemas

### Erro: "Permission denied"
```bash
sudo chown -R www-data:www-data /caminho/para/igreja-management
sudo chmod -R 755 /caminho/para/igreja-management
sudo chmod -R 775 storage bootstrap/cache
```

### Erro: "Database file not found"
```bash
# Verificar se o arquivo existe
ls -la database/database.sqlite

# Se não existir, criar:
touch database/database.sqlite
php artisan migrate
```

### Erro: "Class not found"
```bash
# Recriar autoload
composer dump-autoload
php artisan config:clear
php artisan cache:clear
```

### Erro: "Key not found"
```bash
# Gerar nova chave
php artisan key:generate
```

## 📞 Suporte

Se encontrar problemas durante a instalação:

1. Verifique os logs em `storage/logs/laravel.log`
2. Confirme se todas as extensões PHP estão instaladas
3. Verifique as permissões dos arquivos
4. Consulte a documentação do Laravel: https://laravel.com/docs

## ✅ Verificação da Instalação

Após a instalação, acesse:
- `http://seu-dominio.com` - Página principal
- Verifique se o dashboard carrega corretamente
- Teste o cadastro de um membro
- Verifique se as estatísticas são atualizadas

**Instalação concluída com sucesso!** 🎉

