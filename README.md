# Docker for backend internships

1. Скопируйте репозиторий командой `git clone https://github.com/vshvarev/STEP3_Symfony.git`
2. Перейдите в директорию `docker` командой `cd docker`
3. Скопируйте файл `.env.example` в `.env` командой `cp .env.example .env`
4. Если у вас не ноутбук на процессоре М1, то удалите строку номер 31  platform: 'linux/x86_64' из файла docker/docker-compose.yml
5. Запустите docker контейнеры командой `docker-compose up -d --build`
6. Вернитесь в рабочую директорию `cd ..`
7. Запустите composer командой `docker exec -ti container name composer install`
8. Запустите миграции командой `docker exec -ti container name php bin/console doctrine:migrations:migrate`
9. Запустите фикстуры командой `docker exec -ti container name php bin/console doctrine:fixtures:load`
10. Перейдите на [страницу приложения](http://localhost/movie)
