## Pré-requisitos para rodar o projeto
Ter o [Docker](https://docs.docker.com/engine/install/) e o [Docker Compose](https://docs.docker.com/compose/install/), instalados e configurados.

### Rodando o projeto
* Duplicar o arquivo .env.example renomeando-o para .env: `cp .env.example .env`  
* Preencher as informações do novo arquivo .env com os dados de acesso a api. O campo de token deve ser preenchido no formato: `login:senha` encodado em base64  
* Preencher as informações do novo arquivo .env com os dados do MySQL. Ex:

```bash
STPLAPP_MONGO_HOST=192.168.15.13 (substituir pelo seu ip - não adiantar ser localhost ou 127.0.0.1)
STPLAPP_MONGO_USER=root
STPLAPP_MONGO_PWD=r00tZ
STPLAPP_MONGO_PORT=27017
```

* No diretório raiz executar o comando: `docker-compose up -d --build`  
* Na sequência rodar o comando: `docker-compose exec php bash` para entrar no container em modo bash  
* Executar o comando: `composer install && composer dumpautoload -o` de dentro do container e abandona-lo na sequência: `exit`  

### Acessando a aplicação
* A aplicação roda na porta 8080, para acessa-la, através do browser, a url é a: `http://localhost:8080`  

### Parando a aplicação
* Para parar a aplicação, executar o comando `docker-compose down --remove-orphans`  

### Interface web para administração da base de dados
* Para acessar os dados persistidos pela aplicação na base de dados, acessar: `http://localhost:8090`  