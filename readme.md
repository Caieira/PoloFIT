# Projeto PoloFIT - Sistema de Gerenciamento de Academia

## Visão Geral

O PoloFIT é um sistema web para gerenciamento de academias, desenvolvido como um projeto de aprendizado em PHP. A aplicação permite o cadastro, autenticação e, futuramente, o gerenciamento completo de alunos e suas atividades. O foco do projeto é construir uma base sólida de back-end com PHP e MySQL, seguindo boas práticas de segurança e organização de código.

## Funcionalidades Implementadas

* **Sistema de Cadastro de Usuários:** Permite que novos alunos se cadastrem no sistema.
* **Validação de Dados:** Verificações no lado do cliente (HTML5) e do servidor (PHP) para garantir a integridade dos dados.
* **Sistema de Login Seguro:** Autenticação de usuários com senhas criptografadas.
* **Gerenciamento de Sessão:** Mantém o usuário logado entre as páginas e protege páginas restritas.
* **Recuperação de Senha:** Funcionalidade completa para redefinição de senha via e-mail, utilizando tokens seguros e PHPMailer.
* **Logout:** Permite que o usuário encerre sua sessão de forma segura.

## Tecnologias Utilizadas

* **Back-end:** PHP
* **Front-end:** HTML5, CSS3, JavaScript (para interatividade futura)
* **Banco de Dados:** MySQL
* **Servidor Local:** XAMPP (Apache)
* **Gerenciador de Dependências:** Composer
* **Biblioteca de E-mail:** PHPMailer