# Teste Grupo Allo
- Foi construído uma API de Tarefas
## Requisitos
- Tenha o docker instalado na sua maquina

### Para inicializar o projeto

1 - Clone Repositório
```sh
git clone 
``` 
```sh
cd my-project/
```

2 - Crie o Arquivo .env
```sh
cp .env.example .env
```

3 - Suba os containers do projeto
```sh
docker-compose up -d
```
4 - 
Acesse o container app com o bash
```sh
docker-compose exec app bash
```
5 - Instale as dependências do projeto
```sh
composer install
```

6 - Gere a key do projeto Laravel
```sh
php artisan key:generate
```


### Rotas da aplicação

- <a href='https://documenter.getpostman.com/view/18812289/2s93JqTQyQ'>Link Docmeuntação da API</a>