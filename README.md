# Outrasformacoes_ETEC

Este é um projeto web desenvolvido como parte das atividades de aprendizado na ETEC. Ele segue uma estrutura básica de Model-View-Controller (MVC) para organização do código.

## Estrutura de Pastas

O projeto está organizado nas seguintes pastas principais:

* **`config/`**: Contém arquivos de configuração, como configurações de banco de dados, rotas, etc.
* **`controller/`**: Lógica de controle da aplicação. Recebe as requisições do usuário, interage com o model e escolhe a view a ser exibida.
* **`dao/`** (Data Access Object): Camada responsável pela comunicação com o banco de dados. Contém classes para realizar operações de CRUD (Criar, Ler, Atualizar, Deletar).
* **`model/`**: Representação dos dados da aplicação. Contém classes que modelam as entidades do sistema.
* **`view/`**: Camada de apresentação. Contém os arquivos de template (geralmente em PHP e HTML) que são exibidos ao usuário.

## Como Usar (Desenvolvimento Local)

Para executar este projeto localmente, você precisará de um servidor web com suporte a PHP (como o USBwebserver que estou configurando!):

1.  **Clone o repositório:**

    ```bash
    git clone [https://github.com/SeuNomeDeUsuario/Outrasformacoes_ETEC.git](https://github.com/SeuNomeDeUsuario/Outrasformacoes_ETEC.git)
    ```

    *(Substitua `SeuNomeDeUsuario` pelo seu nome de usuário do GitHub)*

2.  **Copie os arquivos para a pasta raiz do seu servidor web.** No caso do USBwebserver, esta pasta geralmente é `root/`. Certifique-se de copiar a estrutura de pastas completa (`config`, `controller`, `dao`, `model`, `view`).

3.  **Configure o banco de dados (se aplicável).** Edite os arquivos de configuração em `config/` com as informações do seu banco de dados.

4.  **Acesse o projeto pelo seu navegador web.** Geralmente, você pode acessar a página inicial digitando `http://localhost/` na barra de endereços.

## Contribuição

Se você quiser contribuir para este projeto, sinta-se à vontade para abrir issues para relatar bugs ou sugerir melhorias. Pull requests com contribuições são bem-vindos!


## Autor

Marcelo Américo de Oliveira 

## Status do Projeto

Em desenvolvimento para fins de aprendizado.

---
