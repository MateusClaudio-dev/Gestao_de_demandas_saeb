<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css"> 
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/modal-confirmacao.css">
    <title>RegistraAI</title>
</head>
<body>
    <div class="modal-opened hidden">

        <div class="modal">

            <div class="modal-header">
                <div class="modal-title">
                    <h2>Cadastrar evento</h2>
                </div>
                <div class="modal-close">X</div>

            </div>

            <form action="action-event.php" method="post" id="form-add-event">

                <div class="modal-body">
                    <input type="hidden" name="id" id="id">                    
                    <input type="hidden" name="action" id="action" value="">

                    <label for="title">Titulo</label>
                    <input type="text" name="title" id="title" required>

                    
                    <label for="title">Selecione a prioridade</label>
                    <div class="container-prioridade">

                        <div class="prioridade baixa">
                            <label for="priority-baixa">Baixa</label>
                            <input type="radio" value="#64ee64" name="color" id="priority-baixa">
                        </div>

                        <div class="prioridade media">
                            <label for="priority-media">Média</label>
                            <input type="radio" value="#e9a558" name="color" id="priority-media">
                        </div>
                        <div class="prioridade alta">
                            <label for="priority-alta">Alta</label>
                            <input type="radio" value="#e94b4b" name="color" id="priority-alta">
                        </div>
                    </div>

                    <label for="start">Data de início</label>
                    <input type="datetime-local" name="start" id="start" required>

                    <label for="end">Data de termino</label>
                    <input type="datetime-local" name="end" id="end">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-delete hidden" style="background: red;">
                        <svg style="width: 1rem; height: 1rem; fill: white;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free v7.3.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M136.7 5.9C141.1-7.2 153.3-16 167.1-16l113.9 0c13.8 0 26 8.8 30.4 21.9L320 32 416 32c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 8.7-26.1zM32 144l384 0 0 304c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-304zm88 64c-13.3 0-24 10.7-24 24l0 192c0 13.3 10.7 24 24 24s24-10.7 24-24l0-192c0-13.3-10.7-24-24-24zm104 0c-13.3 0-24 10.7-24 24l0 192c0 13.3 10.7 24 24 24s24-10.7 24-24l0-192c0-13.3-10.7-24-24-24zm104 0c-13.3 0-24 10.7-24 24l0 192c0 13.3 10.7 24 24 24s24-10.7 24-24l0-192c0-13.3-10.7-24-24-24z"/></svg>
                    <span class="sr-only">Deletar</span></button>
                    <button type="submit" class="btn-saave">Salvar</button>
                </div>
            </form>
        </div> 
    </div>

    <div class="container-modal-confirmacao">
        <div class="modal-confirmacao" id="modal-confirmacao">
            <div class="title-confirmacao">
                <h4>Você confirma exclusão do evento? <br>Esta ação não pode ser desfeita!</h4>
            </div>
            <div class="buttons-confirmacao">
                <button type="submit" id="button-sim">SIM</button>
                <button type="submit" id="button-nao">NÃO</button>
            </div>
        </div>
    </div>

    <div class="calendar-area">
        <div class="calendar-area-header">
            <?php if (!empty($_SESSION['msg'])) echo $_SESSION['msg']; unset($_SESSION['msg']);?>
        </div>
        <div id='calendar'></div>
    </div>

    <script src="dist/index.global.min.js"></script>
    <script src="core/locales/pt-br.global.min.js"></script>
    <script src="scripts/script.js"></script>
</body>
</html>