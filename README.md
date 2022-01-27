## Project time tracker

---

### Start application using [Docker](https://docs.docker.com/get-docker/)

1. Clone project `git clone https://github.com/usanzadunje/itc.git` or for SSH `git clone git@github.com:usanzadunje/itc.git`
2. Position yourself inside root folder of this application inside terminal `cd itc`.
3. Install dependencies `composer install` and `npm install`
4. Make .env file and set it up `cp .env.example .env`. Make sure to set DB_USER and DB_PASSWORD to any value
5. Generate encryption key `php artisan key:generate`.
6. Run `docker-compose up -d`.
7. Address on which application is hosted is: http://localhost:3000/
8. Port exposed for DB is 3310 if you need to connect it using DB client.
9. You are ready. Application credentials are below. Seeders are run automatically.
10. To access docker app container you can run `docker exec -it itc-app bash`

**NOTE**: If you are running docker on Windows(purely and not inside WSL2), container that starts npm processes will not start since it needs linux builds(this is due to npm docker image used...). You can overcome this by going into itc-app container(shown above) and run `npm run dev` comand to start npm services manually. Or just dont use Docker.

### Start application without Docker

1. Clone project `git clone https://github.com/usanzadunje/itc.git` or for SSH `git clone git@github.com:usanzadunje/itc.git`
2. Position yourself inside root folder of this application inside terminal `cd itc`.
3. Install dependencies `composer install` and `npm install`
4. Make .env file and set it up `cp .env.example .env`
5. Generate encryption key `php artisan key:generate`
6. Create a database called  `itc`
7. Run migrations and seed database `php artisan migrate --seed`
8. Run `php artisan serve` and `npm run dev` to start server and dev server for frontend resources.
9. You are ready. Application credentials are below.

---

### Testing application using [Postman](https://www.postman.com/downloads/)

1. Use collection in this project to generate requests inside Postman.
2. If you changed URL where application is hosted go to variables section and set `path` to app url and `api_path` to `you_url/api`. If you are using Docker default should work fine.
3. If for some reason CORS does not work, you will need to whitelist domain so Postman can access cookies from it in pre-request-scripts. Click on `Cookies` on the right then whitelist the domain app is hosted on. For Docker, it should be set to `localhost`.
4. CSRF token protection is automatically applied to routes that need it during pre-request-scripts.
5. If CSRF mismatch occurs, make `GET` request to `{{path}}/sanctum/csrf-cookie`. Check cookie and copy value of X-XSRF-TOKEN one and paste it into request header you are trying to send with same header name. Make sure to remove `%D3` signs from cookie value.

---

### Application credentials

If seeders run properly there should be account with following credentials.

- Email: `admin@admin.com`
- Password: `password`

<br>