# 💰 Projeto de Carteira Digital (Wallet System)

## 📌 **Descrição**
Este é um sistema de **carteira digital** desenvolvido em **Laravel**, com suporte a depósitos, saques, transferências e reversões de transações.  
O projeto foi arquitetado para seguir rigorosamente os princípios **SOLID**, visando escalabilidade, manutenção e boas práticas de desenvolvimento.

---

## ✅ **Principais Funcionalidades**

- 👤 **Cadastro e autenticação de usuários** com perfis **cliente** e **admin**  
- 💵 **Depósito e saque** em carteira digital  
- 🔄 **Transferência entre carteiras**  
- ⬅️ **Reversão de transações** (funcionalidade prevista)  
- 📊 **Dashboard para clientes** com histórico de transações  
- 🛠 **Dashboard para administradores** com visão gerencial  

---

## 🏗 **Arquitetura e Princípios SOLID**

O projeto foi estruturado com **Services**, **Controllers** e **Models**, respeitando cada princípio:

### 1. **S - Single Responsibility Principle (Responsabilidade Única)**
- Cada **Service** (ex.: `DepositService`, `WalletService`, `TransferService`) tem apenas uma responsabilidade.  
- O **Controller** apenas orquestra requisições, sem regras de negócio.

### 2. **O - Open/Closed Principle (Aberto/Fechado)**
- Para adicionar um novo tipo de transação, basta criar um **novo Service**, sem modificar os já existentes.

### 3. **L - Liskov Substitution Principle**
- Todos os serviços podem ser substituídos ou estendidos sem quebrar o sistema, desde que respeitem as assinaturas.

### 4. **I - Interface Segregation Principle**
- Cada classe expõe apenas os métodos necessários para sua função (ex.: `DepositService` não conhece métodos de saque ou transferência).

### 5. **D - Dependency Inversion Principle**
- Os **Controllers** não instanciam diretamente os Services. Eles recebem via **injeção de dependência** (DI do Laravel).

---

## ⚙ **Tecnologias Utilizadas**
- **Laravel 10+**  
- **PHP 8.1+**  
- **MySQL**  
- **Bootstrap 5**  
- **Blade Components**  
- **Arquitetura baseada em Services e Repositories**  

---

## 🚀 **Instalação e Execução**

### **1. Clone o repositório**
```bash
git clone https://github.com/seu-usuario/wallet-system.git
cd wallet-system
```

### **2. Instale as dependências**
```bash
composer install
npm install && npm run dev
```

### **3. Configure o `.env`**
```env
DB_DATABASE=wallet_db
DB_USERNAME=root
DB_PASSWORD=
```

### **4. Rode as migrations e seeders**
```bash
php artisan migrate --seed
```

### **5. Inicie o servidor**
```bash
php artisan serve
```

Acesse: **[http://localhost:8000](http://localhost:8000)**

---

## 🔑 **Usuários de Teste**
| Perfil   | Email              | Senha     |
|----------|--------------------|-----------|
| Admin    | admin@wallet.com   | password  |
| Cliente  | cliente@wallet.com | password  |

---

## 🧪 **Testes**
O projeto conta com testes unitários e de feature:
```bash
php artisan test
```

---

## 📊 **Próximas Funcionalidades**
- ✅ Relatórios gerenciais no dashboard do admin  
- ✅ Reversão de transações  
- ✅ Notificações em tempo real (broadcasting)

---

## 👨‍💻 **Autor**
Desenvolvido por **[Seu Nome]**  
**LinkedIn:** [seu-linkedin](#)  
**Email:** seuemail@dominio.com  
