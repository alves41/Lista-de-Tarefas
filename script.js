  const formsDelete = document.querySelectorAll('form');

        formsDelete.forEach(form => {

            form.addEventListener('submit', (event) => {

                const botao = event.submitter;

                if (botao && botao.name === 'deletar') {

                    const confirmar = confirm('Deseja deletar essa tarefa?');

                    if (!confirmar) {
                        event.preventDefault();
                    }

                }

            });

        });