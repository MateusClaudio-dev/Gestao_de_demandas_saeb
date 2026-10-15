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
                            <label for="baixa">Baixa</label>
                            <input type="radio" value="#64ee64" name="color" id="priority-baixa">
                        </div>

                        <div class="prioridade media">
                            <label for="media">Média</label>
                            <input type="radio" value="#e9a558" name="color" id="priority-media">
                        </div>
                        <div class="prioridade alta">
                            <label for="alta">Alta</label>
                            <input type="radio" value="#e94b4b" name="color" id="priority-alta">
                        </div>
                    </div>

                    <label for="start">Data de início</label>
                    <input type="datetime-local" name="start" id="start" required>

                    <label for="end">Data de termino</label>
                    <input type="datetime-local" name="end" id="end">
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn-saave">Salvar</button>
                    <button type="button" class="btn-delete hidden">Deletar</button>
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