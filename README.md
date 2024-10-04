## Ansible
- первый раз захожу по паролю и устанавливаю ключ через `authorize.yml` для него

`ansible-playbook -i hosts.yml authorize.yml -k`

- затем уже по `ssh`, создав юзера `and`: 

`make site`
