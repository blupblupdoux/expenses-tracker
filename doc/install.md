# Installation informations

## setup symfony

Install symfony project -> `composer create-project symfony/website-skeleton symfony_app`  
Create a .env.local file and config db user, password and db name  
Create db -> `bin/console d:d:c`  

For run back-end part -> in the back-end folder run `php -S localhost:8000 -t public`

## setup vue.js and some package

The following install commands use vue CLI, check if install with `vue --version` if not install run `sudo npm install -g @vue/cli`

Install vue.js project -> `vue create vuejs_app`  
Install vue router  -> `vue add router`
Install vuex -> `vue add vuex`  
Install vutify -> `vue add vuetify`
Install vue-chartjs -> not install yet

For run front-end part : in the front-end folder run `npm run serve`

## authentication with JWT

Install JWT package -> `composer require "lexik/jwt-authentication-bundle"`  
Configure JWT ->  
`mkdir -p config/jwt`  
`bin/console lexik:jwt:generate-keypair`  
In config/packages/security.yaml between add in the firewall section, between dev and main :
```yaml
login:
    pattern:  ^/api/login
    stateless: true
    anonymous: true
    json_login:
        check_path:               /api/login_check
        success_handler:          lexik_jwt_authentication.handler.authentication_success
        failure_handler:          lexik_jwt_authentication.handler.authentication_failure

api:
    pattern:   ^/api
    stateless: true
    guard:
        authenticators:
            - lexik_jwt_authentication.jwt_token_authenticator
```
In config/routes.yaml add : 
```yaml
api_login_check:
    path: /api/login_check
```
Create user entity -> `bin/console make:user`  
Send user connected in the token payload -> go to modify-jwt-payload.md

## manage cors

Install Nelmio Cors => `composer require nelmio/cors-bundle`

Then go to config/packages/nelmio_cors.yaml and replace the actual code by the following one :

```yaml 
nelmio_cors:
    defaults:
        allow_credentials: false
        allow_origin: []
        allow_headers: []
        allow_methods: []
        expose_headers: []
        max_age: 0
        hosts: []
        origin_regex: false
        # forced_allow_origin_value: ~
    paths:
        '^/api/':
            allow_origin: ['*']
            allow_headers: ['*']
            allow_methods: ['POST', 'PUT', 'GET', 'DELETE']
            max_age: 3600
```

Note : don't forget to clear symfony cache with `bin/console cache:clear` and to clear browser cache by checking the "disable cache" checkbox