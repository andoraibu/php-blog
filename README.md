## Ansible
- первый раз захожу по паролю

`ansible-playbook -i hosts.yml authorize.yml -k`

- затем уже по `ssh`, создав юзера `deploy` и установив ключ через `make authorize` для него
