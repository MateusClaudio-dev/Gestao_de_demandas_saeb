// Arquivo padrão do Laravel
import './bootstrap';
import { Modal } from 'bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            // left: 'prev, next today',
            left: '',
            center: 'title',
            right: 'prev timeGridWeek dayGridMonth timeGridDay today next'
        },
        initialView: 'dayGridMonth',
        locale: 'pt-br',
        navLinks: true,
        selectable: true,
        selectMirror: true,
        editable: true,
        dayMaxEvents: true,
        dateClick: function(info) {
            console.log('dateClick disparou', info.dateStr);
            abrirModalAgendamento(info);
        },
        eventClick: function(info) {
            abrirModalEdicao(info)
        },
        eventDrop: function(info) {
            moverEvento(info)
        },
        eventResize: function(info) {
            console.log(info)
        },
        // events: 'event-list.php',

        events: [
            { id: 1, title: 'Reunião SAEB', start: '2026-10-28T09:00:00', end: '2026-10-28T11:00:00', color: '#e94b4b' },
            { id: 2, title: 'Entrega de relatório', start: '2026-10-30', color: '#64ee64' },
        ],

    });

    calendar.render();

    const modalEvento = new Modal(document.getElementById('modalEvento'));
    const caledarArea = document.querySelector('.calendar-area');

    function abrirModalAgendamento(info) {
        
        // Deixa horario pré-definido no modal
        document.querySelector('#start').value = info.dateStr + " 08:00";
        document.querySelector('#end').value = info.dateStr + " 18:00";
        modalEvento.show();
  
    }
    
    function abrirModalEdicao(info) {

        // Formata data/hora 
        let data_start = [
            info.event.start.toLocaleString().replace(',', '').split(' ')[0].split('/').reverse().join('-'),
            info.event.start.toLocaleString().replace(',', '').split(' ')[1]
        ].join('T');
        
        let data_end = '';
        if (info.event.end) {
            data_end = [
            info.event.end.toLocaleString().replace(',', '').split(' ')[0].split('/').reverse().join('-'),
            info.event.end.toLocaleString().replace(',', '').split(' ')[1]
            ].join('T');
        } else {
            data_end = '';
        }
        
        // Carrega os inputs com os valores pré-defindos
        document.querySelector('.modal-title h2').innerHTML = 'Editar evento';
        document.querySelector('#id').value = info.event.id;
        document.querySelector('#title').value = info.event.title;

        document.querySelectorAll('input[name="color"]').forEach(radio => {
            radio.checked = false
        });

        const radioCor = document.querySelector(`input[name="color"][value="${info.event.backgroundColor}"]`);
        if (radioCor) radioCor.checked = true;

        document.querySelector('#start').value = data_start;
        document.querySelector('#end').value = data_end;
        modalEvento.show();
    };

    // Determina os campos obrigatórios
    let form_add_event = document.querySelector('#form-add-event');
    form_add_event.addEventListener('submit', function(event) {
        event.preventDefault();
        let title = document.querySelector('#title');
        let start = document.querySelector('#start');

        if (title.value == '') {
            title.placeholder = 'Campo obrigatório*';
            title.style.borderColor = 'red';
            title.focus();
            return false;
        } 
        if (start.value == '') {
            start.style.borderColor = 'red';
            start.focus();
            return false;
        }
        this.submit();
    });

    // Exigir confirmação do utilizador para deletar evento
    document.querySelector('.btn-delete').addEventListener('click', function() {
        modalConfirmacaoExclusao();
    })
    
    function modalConfirmacaoExclusao() {
        modal.style.pointerEvents = 'none';
        caledarArea.style.pointerEvents = 'none';


        let modalConfirmacao = document.getElementById('modal-confirmacao');
        var buttonSim = document.getElementById('button-sim');
        var buttonNao = document.getElementById('button-nao');

        // Checa o estado real do elemento (mesmo que ele venha do CSS).
        let estadoDisplay = window.getComputedStyle(modalConfirmacao).display;

        if (estadoDisplay === 'none') {
            modalConfirmacao.style.display = 'block';
        } else {
            modalConfirmacao.style.display = 'none';
        };

        buttonSim.addEventListener('click', () =>{
            document.querySelector('#action').value = 'delete';
            form_add_event.submit();
            modal.style.pointerEvents = 'auto';
            caledarArea.style.pointerEvents = 'auto';
            return true;
            
        });
        
        buttonNao.addEventListener('click', () => {
            fecharModalConfirmacao();
            modal.style.pointerEvents = 'auto';
            caledarArea.style.pointerEvents = 'auto';
        })
    }

    function fecharModalConfirmacao() {
        let modalConfirmacao = document.getElementById('modal-confirmacao');
        modalConfirmacao.style.display = 'none';
        caledarArea.style.pointerEvents = 'auto';
    }

    function moverEvento(info) {
        let id = info.event.id
        let title = info.event.title
        let start = info.event.startStr
        let end = info.event.endStr ? info.event.endStr : '';

        let data = {id, title, start, end};

        let urlEncodeData = Object.keys(data).map(key => encodeURIComponent(key) + '=' + encodeURIComponent
        (data[key])).join('&');

        
         
        var ajax = new XMLHttpRequest();
        // Configura para onde vai o pedido: (método, arquivo, e true para ser assíncrono)
        ajax.open('POST', 'action-event.php', true);

        // Define o formato em que os dados estão sendo enviados
        ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        // Envia os dados para o servidor
        ajax.send(urlEncodeData);

        // Fica monitorando o momento em que a resposta do servidor fica pronta
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) var data = ajax.responseText;
        }
    }

    // Configurar o tempo de exibição das (_$SSESION) - Resposta das interações dos usúarios.
    let alerts = document.querySelector('.calendar-area-header');
    if (!alerts.innerHTML == '') {
        setTimeout(() => {
            alerts.style.transition = 'opacity 0.5 ease';
            alerts.style.transition = 0;
            setTimeout(() => {alerts.style.display = 'none';})
        }, 3000);
    }
});