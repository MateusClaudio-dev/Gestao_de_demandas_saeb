<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css"> 
    <link rel="stylesheet" href="css/modal.css">
    <title>RegistraAI</title>
</head>
<body>
    <div class="modal-opened hidden">

        <div class="modal">

            <div class="modal-header">
                <div class="modal-title">
                    <h2>Cadastrar agendamento</h2>
                </div>
                <div class="modal-close">X</div>

            </div>

            <form action="action-event.php" method="post">

                <div class="modal-body">
                    <input type="hidden" name="id" id="id">                    
                    <input type="hidden" name="action" value="">

                    <label for="title">Titulo</label>
                    <input type="text" name="title" id="title">

                    <label for="description">Descrição </label>
                    <textarea name="description" id="descrption" cols="30" rows="5"></textarea>

                    <label for="start">Data de início</label>
                    <input type="datetime-local" name="start" id="start">

                    <label for="end">Data de termino</label>
                    <input type="datetime-local" name="end" id="end">
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn-saave">Salvar</button>
                    <button type="hidden" class="btn-delete hidden">Deletar</button>
                </div>

            </form>
        </div> 
    </div>

        <div class="calendar-area">
            <div class="calendar-area-header">
                <?php if (!empty($_SESSION['msg'])) echo $_SESSION['msg']; unset($_SESSION['msg']);?>
            </div>
            <div id='calendar'></div>
        </div> 
    


    <script src="core/locales/pt-br.global.min.js"></script>
    <script src="dist/index.global.min.js"></script>
    <script src="scripts/script.js"></script>
</body>
</html>