# The Drinks 🍹

Bem-vindo ao repositório de código fonte do The Drinks, desenvolvido em Laravel! The Drinks é um site de receita de drinks separado por categorias. Com acesso de administrador, você pode cadastrar, editar e deletar drinks.

## Licença

Este projeto é distribuído sob a licença MIT - veja o arquivo [LICENSE](LICENSE) para obter mais detalhes. Isso significa que você pode fazer o que quiser com o código fonte, mas deve incluir o aviso de copyright e a licença no software ou na documentação.

## Tecnologias Utilizadas

- **Laravel**
- **Jetstream**
- **MySQL**
- **Javascript**
- **Bootstrap**

1. Clone este repositório (`git clone https://github.com/seu-usuario/laravel-drink-recipes.git`)
2. Instale as dependências usando o Composer (`composer install`)
3. Copie o arquivo de ambiente (`cp .env.example .env`) e configure as variáveis de ambiente, incluindo as configurações do banco de dados.
3. Configure as variáveis de ambiente, incluindo as configurações do banco de dados.
4. Gere a chave de aplicativo (`php artisan key:generate`)
5. Execute as migrações do banco de dados (`php artisan migrate`) antes de rodar este comando verifique sua conexão com o bd no arquivo.
6. Inicie o servidor de desenvolvimento Vite ('npm run dev')
7. Inicie o servidor de desenvolvimento (`php artisan serve`)

Acesse o aplicativo em `http://localhost:8000` e comece a explorar as receitas!
6. Execute as inserções dos dados de teste ('php artisan db:seed')
7. Inicie o servidor de desenvolvimento Vite ('npm run dev')
8. Inicie o servidor de desenvolvimento (`php artisan serve`)

Após executar todos os comandos serão criados os seguintes dados:
**Usuário**
- Login: teste@teste.com
- Senha: 12345678
**Categorias**
- Alcoólico
- Batido
- Mexido
- Montado
- Não alcoólico

Acesse o aplicativo em `http://localhost:8000` e comece a cadastrar as receitas!

## Estrutura do Projeto

- `/app`: Este diretório contém os arquivos principais do Laravel.
- `/database`: Aqui você encontrará as migrações e seeders do banco de dados.
- `/resources`: Contém as views, estilos e scripts do frontend.
- `/routes`: As rotas da aplicação.
- `/public`: Os assets públicos, como imagens e arquivos CSS.
