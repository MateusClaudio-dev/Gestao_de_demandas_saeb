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
                    <h2>Cadastrar demanda</h2>
                </div>
                <div class="modal-close">X</div>

            </div>

            <form action="action-event.php" method="post">

                <div class="modal-body">

                    <label for="title">Titulo da demanda</label>
                    <input type="text" name="title" id="title"  required>

                    <label for="description">Descrição </label>
                    <textarea name="description" id="descrption" cols="30" rows="5"></textarea>

                    <label for="start">Data de início</label>
                    <input type="datetime-local" name="start" id="start"  required>

                    <label for="end">Data de termino</label>
                    <input type="datetime-local" name="end" id="end" required>

                    <!-- <label for="color">Selecione a prioridade da demanda</label>
                    <div class="container-priority hidden">

                        <div class="container-color">
                            <input type="color" name="color" id="color" value="red">
                            <label for="color">Urgente</label>
                        </div>

                        <div class="container-color">
                            <input type="color" name="color" id="color" value="yellow">
                            <label for="color">Atenção</label>
                        </div>
                        <div class="container-color">
                            <input type="color" name="color" id="color" value="green">
                            <label for="color">No prazo</label>
                        </div>
                        
                    </div> -->

                </div>

                <div class="modal-footer">
                    <button type="submit">Salvar</button>
                    <button type="hidden">Deletar</button>
                </div>

            </form>
        </div> 
    </div>

        <div class="calendar-area">
            <div id='calendar'></div>
        </div> 
    


    <script src="core/locales/pt-br.global.min.js"></script>
    <script src="dist/index.global.min.js"></script>
    <script src="scripts/script.js"></script>
</body>
</html>