# Notes - Bloco de Notas Online

## Descrição

O **Notes** é um bloco de notas online desenvolvido em Laravel. Com uma interface intuitiva, ele permite que os usuários criem, editem e organizem suas anotações de maneira eficiente.

## Imagem do Projeto 📸

![Screenshot do Notes](../Notes-Laravel/public/assets/images/notes.png)

## Pré-requisitos

Antes de começar, certifique-se de ter os seguintes pré-requisitos instalados em sua máquina:

- **PHP** (versão 7.4 ou superior) - [Download PHP](https://www.php.net/downloads)
- **Composer** (para gerenciar dependências do PHP) - [Download Composer](https://getcomposer.org/download/)
- **MySQL** - [Download MySQL](https://dev.mysql.com/downloads/)
- **Laragon** (para ambiente local) - [Download Laragon](https://laragon.org/download/)


## Instalação

Siga os passos abaixo para configurar o projeto em sua máquina local:

1. **Clone o repositório**
   - Abra o terminal e execute:
     ```bash
     git clone https://github.com/Gugaluis/Notes-Laravel.git
     cd notes
     ```

2. **Instale as dependências com Composer**
   - Execute o seguinte comando na pasta do projeto:
     ```bash
     composer install
     ```

3. **Configuração do Ambiente**
   - Renomeie o arquivo `.env.example` para `.env`:
     ```bash
     cp .env.example .env
     ```
   - Abra o arquivo `.env` e configure as informações do banco de dados, como:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=nome_do_banco (Por padrão utilizei laravel_notes)
     DB_USERNAME=seu_usuario
     DB_PASSWORD=sua_senha
     ```

4. **Crie o banco de dados**
   - Use o HeidiSQL para criar um banco de dados com o nome especificado em `DB_DATABASE`.

5. **Gere a chave de aplicativo**
   - Execute o comando a seguir para gerar uma chave única para o aplicativo:
     ```bash
     php artisan key:generate
     ```

6. **Executar as migrações**
   - Para criar as tabelas necessárias no banco de dados, execute:
     ```bash
     php artisan migrate
     ```

7. **Inicie o servidor**
   - Você pode iniciar o servidor integrado do Laravel com o seguinte comando:
     ```bash
     php artisan serve
     ```
   - O aplicativo estará disponível em `http://localhost:8000`.

## Utilização

1. **Acessando o Aplicativo**
   - Abra o navegador e vá para `http://localhost:8000`.

2. **Login**
   - Para logar na aplicação você pode usar um dos três usuários já criados.

   - Eles são:

   - user1@gmail.com
   - user2@gmail.com
   - user3@gmail.com

   - Todos os usuários possuem uma senha padrão (abc123456)

3. **Criando Anotações**
   - Após o login, você verá a interface principal.
   - Clique em "Nova Nota" para criar uma nova anotação.
   - Preencha o título e o conteúdo da nota e clique em "Salvar".

4. **Editando e Excluindo Anotações**
   - Para editar uma nota, clique no ícone de edição ao lado da nota.
   - Para excluir, clique no ícone de exclusão.

## Contribuição

Se você deseja contribuir para o projeto, sinta-se à vontade para abrir uma issue ou enviar um pull request.
