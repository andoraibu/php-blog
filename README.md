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

