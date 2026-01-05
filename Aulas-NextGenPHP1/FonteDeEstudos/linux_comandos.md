# Aqui alguns comandos Linux importantes

## Comandos compartilhados por um usuário do Linkedin

A única lista de comandos do Linux que você precisa marcar:

Daily Heroes:
- **ps aux | grep {process}** - Encontre aquele processo furtivo
- **lsof -i :{port}** - Quem está monopolizando aquela porta?
- **df -h** - O clássico verificador de "estamos sem espaço"
- **netstat -tulpn** - Detetive de conexão de rede
- **kubectl get pods | grep -i error** - Localizador de problemas do K8s

Log Warriors:
- **tail -f /var/log/*** - Observador de log em tempo real
- **journalctl -fu service-name** - Perseguidor de log do SystemD
- **grep -r "error" .** - O caçador de erros
- **zcat access.log.gz | grep "500"** - Ninja de log compactado
- **less +F** - O melhor comando tail

Container Whisperers:
- **docker ps --format '{{.Names}} {{.Status}}'** - Verificação de status limpa
- **docker stats --no-stream** - Verificação rápida de recursos
- **crictl logs {container}** - Histórias brutas de contêineres
- **docker exec -it** - O backdoor do contêiner
- **podman top** - Espiada de processos dentro de contêineres

System Detectives:
- **htop** - Contador de histórias de recursos do sistema
- **iostat -xz 1** - Poeta de desempenho de disco
- **free -h** - Solucionador de mistérios de memória
- **vmstat 1** - Sinais vitais do sistema
- **dmesg -T | tail** - Fofocas recentes do Kernel

Network Ninjas:
- **curl -v** - Depurador de conversação HTTP
- **dig +short** - Pesquisa rápida de DNS
- **ss -tunlp** - Estatísticas de socket simplificadas
- **iptables -L** - Leitor de regras de firewall
- **traceroute** - Localizador de caminho

File Jugglers:
- **find . -name "*.yaml" -type f** - Caçador de YAML
- **rsync -avz** - Melhor copiador de arquivos
- **tar -xvf** - O descompactador (sim, todos nós pesquisamos isso no Google)
- **ln -s** - Assistente de Symlink
- **chmod +x** - Torna executável

Performance Profilers:
- **strace -p {pid}** - Espião de chamada de sistema
- **tcpdump -i any** - Farejador de pacotes de rede
- **sar -n DEV 1** - Monitoramento de estatísticas de rede
- **uptime** - Média de carga em resumo
- **top -c** - Visualizador de processos clássico

Git Essentials:
- **git log --oneline** - Histórico simplificado
- **git reset --hard HEAD^** - Apagador de "oops"
- **git stash** - O ocultador de trabalho
- **git diff --cached** - O que é preparado?
- **git blame** - O resolvedor "quem fez isso?"

Correções rápidas:
- **sudo !!** - Execute o último comando com sudo
- **ctrl+r** - Pesquisa de histórico de comandos
- **history | grep** - Máquina do tempo de comando
- **alias** - Criador de atalhos de comando
- **watch** - Repetidor de comandos

Autor: Lauriano Elmiro Duarte
source: https://www.linkedin.com/posts/laurianops_a-%C3%BAnica-lista-de-comandos-do-linux-que-voc%C3%AA-activity-7258250586595217409-YC_y?utm_source=share&utm_medium=member_desktop

## Docker Compose comandos
- **docker compose log {nome_servico}** - mostra todo o log do serviço
- **docker compose log -f {nome_servico}** - fica aguardando novos logs
- **docker compose log -f -t 20 {nome_servico}** - mostra as ultimas 20 linhas e fica aguardando novos logs

- **docker compose up** - Sobe os containers na pasta do projeto
- **docker compose up -d** - Sobe os containers na pasta do projeto em background
- **docker compose up -d --build** - Sobe os containers na pasta do projeto em background e compila o Dockerfile
- **docker-compose up -d --build --force-recreate** - Sobe os containers do projeto e força o rebuild da imagem do Dockerfile

- **docker compose ps** - mostra todos containers do projeto(na pasta)

- **docker compose exec {nome_servico} {comando}** - executa o comando dentro do container
- **docker compose exec {nome_servico} sh** - entra dentro do container depende do bash instalado(sh, ash ou bash)
- **docker compose exec -u 1000:1000 {nome_servico} sh** - entra dentro do container como usuario/grupo default(1000), depende do bash instalado(sh, ash ou bash)
- **docker compose exec -u $UID:$GID {nome_servico} sh** - entra dentro do container como seu usuario/grupo(funciona no linux), depende do bash instalado(sh, ash ou bash)

- **docker compose stop** - para os containers do projeto, mantendo seu estado(mudanças)
- **docker compose down** - destroi os containers do projeto(pasta)
