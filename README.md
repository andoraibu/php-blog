## Ansible
- запускаю команду, она создает юзера `deploy` и ставит докер:

`make site`

- устанавливаю `ssh` ключ в директорию пользователя `deploy`:

`make authorize`

- клонирую репозиторий в директорию `/app`:

`make clone`

## Изменить права доступа к директории /public/images/

`make perm-access`

## Собрать и развернуть проект

`make up`

- остановить контейнеры 

`make down`

- обновить репозиторий из Github

`make git-update`

## Скриншоты
![img1](https://github.com/elbroandrew/php-blog/blob/master/screenshots/Screenshot%202024-11-26%20at%2000-00-05%20%D0%91%D0%BB%D0%BE%D0%B3.png)

![img2](https://github.com/elbroandrew/php-blog/blob/master/screenshots/Screenshot%202024-11-26%20at%2000-00-27%20%D0%91%D0%BB%D0%BE%D0%B3.png)

![img3](https://github.com/elbroandrew/php-blog/blob/master/screenshots/Screenshot%202024-11-26%20at%2000-00-40%20%D0%91%D0%BB%D0%BE%D0%B3.png)
