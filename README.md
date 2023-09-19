# Sumário
- [Pacotes Utilizado](#pact)
- [Rotas](#route)



## TI Test
 
O Case consiste em criar uma API voltada para um sistema de agendamento de consultas
#

## Solução

Criar CRUDS para cadastros de usuários de três tipos ['admin', 'medical', 'patient'] onde esses usuários terão funções epecíficas dentro do sistema;


<h2 id="pact">Pacotes Utilizado</h2>

## JWT:
Para melhor utilização do sistema será nescessário realizar alguns passos

Primeiramente a instalação do JWT </br>
<code>composer require php-open-source-saver/jwt-auth</code>

Apos a instalação do jwt-auth </br>
<code>php artisan vendor:publish --provider="PHPOpenSourceSaver\JWTAuth\Providers\LaravelServiceProvider"</code>

Pra finalizar </br>
<code>php artisan jwt:secret</code>

Será criado uma chave no seu arquivo .env </br>
<code>JWT_SECRET=TIfwzvlyoyDLMTnuYvZ771DeYcv0HmJvyFgajlGezgWU0cekfY0dLGJfvoL3AkjE </code> </br>
<code>JWT_ALGO=HS256</code>

<h2 id="route">Rotas</h2>

As unicas rotas que não prcisam de envio de envio do token são as rotas de register e login.

Para teste do sistema foi criado uma documentação via swagger </br>

<code>http://localhost:8000/api/documentation#/</code>

<img src="https://user-images.githubusercontent.com/29145254/268828976-0fd69a3b-211b-468b-adec-7c07c860c397.png" />

Você encontrará todas as rotas disponíveis para utilização do fluxo completo do sistema.

## User Routes And Authentications

Para registrar o usuário só é nescessário o preechimento dos campos requeridos, de preferência a criação de um user_type 'admin', pois seu token terá acesso ao restante das rotas.

<img src="https://user-images.githubusercontent.com/29145254/268829801-25ddec78-d478-4194-93a8-6a9f0817c7e1.png" />

### Login

Utilize o email e senha para autenticar o usuário na rota login </br>

<img src="https://user-images.githubusercontent.com/29145254/268831245-3f44f149-af2f-46bc-992e-24a732b5163f.png" /> </br>

O retorno de sucesso será um jason com esses campos </br>
``` json
{
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNjk1MDkzMDQ1LCJleHAiOjE2OTUxNzk0NDUsIm5iZiI6MTY5NTA5MzA0NSwianRpIjoiaEZUSXlyTWt4dFhqcG1wUCIsInN1YiI6ImQ5OGM1ODhhLTBjMmMtNDU5NC04ZjMxLTM1MjQzMjIyOGVjZiIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjciLCJ1c2VyX3R5cGUiOiJhZG1pbiJ9.GNm0LguFlX03VVg0ST4BPRuD8-YDL6xSvBNCRa8KZH0",
  "token_type": "Bearer",
  "expires_in": 2073600,
  "user": {
    "id": "d98c588a-0c2c-4594-8f31-352432228ecf",
    "name": "Wilk Caetano",
    "email": "wilk@mail.com",
    "email_verified_at": null,
    "user_type": "admin",
    "medical_crm": null,
    "date_of_birth_patient": null,
    "phone_number_patient": null,
    "created_at": "2023-09-18T15:28:47.000000Z",
    "updated_at": "2023-09-18T15:28:47.000000Z"
  },
  "user_type": "admin"
}

```

Adicione o token no header da requisição apartir de agora ou adicione no Authorize do swagger

### User Routes

Rotas reponsáveis pela atualização busca e exclusão dos usuários, as rotas estão protegidas por Middleware de autenticação.

<img src="https://user-images.githubusercontent.com/29145254/268831644-c0f6f78d-3e4c-400f-94cb-543fcd94ebc9.png" />

### Specialties 
Rota de criação das especialidades referente ao usuário medical </br>
<img src="https://user-images.githubusercontent.com/29145254/268832491-30fa6ce5-867e-4c1c-8f31-a0fe9d0a647f.png" />

### Medical Specialtire
Serve para referênciar as epecialidade ao medico </br>

<img src="https://user-images.githubusercontent.com/29145254/268833033-a36bcfad-3450-4a7f-a8f1-d24630cd401c.png" />

### Health Insurance
Serve para criação e referencia do plano de saúde para um usuário paciente... </br>
OBS: Terá que ter um usuário do tipo patient cadastrado em sua base de dados. </br>

<img src="https://user-images.githubusercontent.com/29145254/268833362-31c9b448-7142-47ea-b015-9abb97b5e5e0.png" />

### Appointments
Lida com as consultas </br>

<img src="https://user-images.githubusercontent.com/29145254/268833845-bd1cc48c-7b99-4e2d-91ac-96ff6de680f9.png" />

### Procedures

Lida com os procedimentos relacinados a consulta. </br>

<img src="https://user-images.githubusercontent.com/29145254/268834254-c3003beb-b3b3-46f1-9128-7de8aa24740f.png" />