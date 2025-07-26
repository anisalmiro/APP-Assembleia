# Sistema de Gerenciamento da Igreja

Uma aplicação web completa desenvolvida em Laravel para gerenciar todas as atividades de uma igreja, incluindo membros, patrimônio, finanças e relatórios.

## 📋 Funcionalidades

### 👥 Gerenciamento de Membros
- Cadastro completo de membros (crentes) com informações pessoais
- Registro de esposa (quando casado)
- Cadastro de filhos com informações detalhadas
- Histórico de transações financeiras por membro
- Relatórios de membros

### 🏛️ Controle de Patrimônio
- Cadastro de itens da igreja (cadeiras, mesas, equipamentos de som, etc.)
- Controle de quantidade e valor dos itens
- Status dos itens (novo, bom, danificado, descartado)
- Data de aquisição e descrição detalhada

### 💰 Gestão Financeira
- Registro de dízimos por membro
- Controle de doações (identificadas ou anônimas)
- Registro de coletas especiais
- Controle de despesas com categorização
- Motivos detalhados para cada saída financeira

### 📊 Dashboard e Relatórios
- Dashboard com estatísticas em tempo real
- Resumo financeiro mensal
- Relatórios detalhados de membros, patrimônio e finanças
- Visualização de últimas transações e despesas

## 🛠️ Tecnologias Utilizadas

- **Backend**: Laravel 10.x
- **Banco de Dados**: SQLite (configurável para MySQL/PostgreSQL)
- **Frontend**: Bootstrap 5.3, Font Awesome 6.0
- **PHP**: 8.1+
- **Composer**: Gerenciamento de dependências

## 📦 Estrutura do Banco de Dados

### Tabelas Principais

1. **members** - Informações dos membros da igreja
2. **spouses** - Dados das esposas (relacionamento 1:1 com members)
3. **children** - Informações dos filhos (relacionamento 1:N com members)
4. **assets** - Patrimônio da igreja
5. **financial_transactions** - Dízimos, doações e coletas
6. **expenses** - Despesas e saídas financeiras

### Relacionamentos

- Um membro pode ter uma esposa (1:1)
- Um membro pode ter vários filhos (1:N)
- Um membro pode ter várias transações financeiras (1:N)
- Transações podem ser anônimas (member_id nullable)

## 🚀 Instalação e Configuração

### Pré-requisitos

- PHP 8.1 ou superior
- Composer
- Extensões PHP: sqlite3, mbstring, xml, curl, zip

### Passos de Instalação

1. **Clone ou baixe o projeto**
```bash
# Se usando Git
git clone <repository-url>
cd igreja-management

# Ou extraia o arquivo ZIP baixado
```

2. **Instale as dependências**
```bash
composer install
```

3. **Configure o ambiente**
```bash
# Copie o arquivo de configuração
cp .env.example .env

# Gere a chave da aplicação
php artisan key:generate
```

4. **Configure o banco de dados**
```bash
# Crie o arquivo do banco SQLite
touch database/database.sqlite

# Execute as migrations
php artisan migrate
```

5. **Inicie o servidor**
```bash
php artisan serve
```

A aplicação estará disponível em `http://localhost:8000`

## 📱 Como Usar

### Primeiro Acesso

1. Acesse `http://localhost:8000`
2. Você verá o dashboard com estatísticas zeradas
3. Comece cadastrando os primeiros membros da igreja
4. Adicione itens do patrimônio
5. Registre transações financeiras

### Cadastro de Membros

1. Vá para **Membros** > **Novo Membro**
2. Preencha as informações pessoais obrigatórias
3. Se casado, adicione informações da esposa
4. Adicione filhos usando o botão "Adicionar Filho"
5. Salve o cadastro

### Registro Financeiro

1. Acesse **Dízimos & Doações** > **Nova Transação**
2. Selecione o tipo (dízimo, doação ou coleta)
3. Escolha o membro (opcional para doações anônimas)
4. Informe o valor e data
5. Adicione observações se necessário

### Controle de Despesas

1. Vá para **Despesas** > **Nova Despesa**
2. Descreva a despesa detalhadamente
3. Informe o valor e categoria
4. Especifique o motivo (construção, manutenção, etc.)
5. Registre a data da despesa

## 🔧 Configurações Avançadas

### Mudança de Banco de Dados

Para usar MySQL ou PostgreSQL, edite o arquivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=igreja_db
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

### Personalização

- **Layout**: Edite `resources/views/layouts/app.blade.php`
- **Cores**: Modifique as variáveis CSS no layout
- **Logo**: Substitua o ícone na sidebar

## 📊 Relatórios Disponíveis

### Relatório Financeiro
- Todas as transações de entrada
- Histórico de despesas
- Filtros por período e tipo

### Relatório de Membros
- Lista completa com informações familiares
- Dados de contato
- Histórico de participação

### Relatório de Patrimônio
- Inventário completo
- Valores e status dos itens
- Datas de aquisição

## 🛡️ Segurança

- Validação de dados em todos os formulários
- Proteção CSRF em formulários
- Sanitização de entradas
- Relacionamentos com integridade referencial

## 🤝 Suporte

Para dúvidas ou problemas:

1. Verifique se todas as dependências estão instaladas
2. Confirme se as migrations foram executadas
3. Verifique as permissões do arquivo de banco de dados
4. Consulte os logs em `storage/logs/laravel.log`

## 📄 Licença

Este projeto foi desenvolvido para uso em igrejas e organizações religiosas. Livre para uso e modificação conforme necessário.

---

**Desenvolvido com ❤️ para servir à comunidade cristã**

