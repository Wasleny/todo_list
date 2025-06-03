# To do list

## Como rodar o projeto?

### Pré-requisitos
* composer
* php >=8.2

### Comandos
* Clone do repositório: `git clone <path>`
* Rodar `composer install`
* Rodar `npm install`
* Criar arquivo .env (.env_example possui todas as informações) com informações de acesso ao banco de dados
* Criar banco de dados com o mesmo nome que está no .env
* Rodar `php artisan key:generate`
* Rodar `php artisan migrate --seed`
* Rodar `composer run dev`
* Acessar a rota pelo navegador
* Para acessar as tarefas e utilizar o CRUD, faça login com o user:
  * email: test@example.com
  * senha: user@123
  * ou crie seu próprio usuário na tela de cadastro


## Decisões tomadas
* Optei por utilizar o laravel/ui com bootstrap para apresentar a autenticação sem instalar pacotes mais robustos e com mais configurações para acesso via API, já que o propósito é uma aplicação com autenticação simples. Contudo, caso a aplicação aumentasse e fosse necessário uma robustez maior em nível de autenticação e roles, migrar para outra ferramenta pode ser vantajoso
* Optei por criar um seeder de tarefas para facilitar os testes, já que para ter uma visualização melhor da paginação e do filtro, seria necessário criar muitas tarefas manualmente
* Decidi criar um enum para os tipos de status, já que se repetem em vários ambientes e são valores constantes
* Por decidir utilizar autenticação, optei por deixar que somente o usuário que criou a tarefa possa acessá-la e modificada.
* Adicionei um filtro por status via parâmetro `GET`, para permitir que o usuário filtre suas tarefas de forma dinâmica, algo que pode ser melhorado é, caso queira amplicar os tipos de filtros, talvez via `GET` não seja a melhor opção
- Garanti que o filtro persista durante a navegação entre páginas com `appends(request()->only('status'))`, já que o paginate utiliza parâmetro na url para fazer a paginação
