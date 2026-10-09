document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev, next today',
            center: 'title',
            right: 'dayGridMonth, timeGridWeek, timeGridDay'
        },
        initialView: 'dayGridMonth',
        locale: 'pt-br',
        navLinks: true,
        selectable: true,
        selectMirror: true,
        editable: true,
        dayMaxEvents: true,
        dateClick: function(info) {
            abrirModal(info);
        },
        eventClick: function(info) {
            abrirModalEdicao(info)
        },
        eventDrop: function(info) {
            console.log(info)
        },
        eventResize: function(info) {
            console.log(info)
        },
        events: 'event-list.php',
    });

    calendar.render();

    // Exibi Modal
    const modal = document.querySelector('.modal-opened');
    function abrirModal(info) {
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
                
            modal.style.transition = 'opacity 300ms';
            setTimeout(() => modal.style.opacity = 1, 100);
        }
        
        // Deixa horario pré-definido no modal
        document.querySelector('#start').value = info.dateStr + " 8:00";
        document.querySelector('#end').value = info.dateStr + " 18:00";
    }
    
    function abrirModalEdicao(info) {
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
                
            modal.style.transition = 'opacity 300ms';
            setTimeout(() => modal.style.opacity = 1, 100);
        }

        let data_start = [
            info.event.start.toLocaleString().replace(',', '').split(' ')[0].split('/').reverse().join('-'),
            info.event.start.toLocaleString().replace(',', '').split(' ')[1]
        ].join(' ');

        let data_end = [
            info.event.end.toLocaleString().replace(',', '').split(' ')[0].split('/').reverse().join('-'),
            info.event.end.toLocaleString().replace(',', '').split(' ')[1]
        ].join(' ');

        document.querySelector('.modal-title h2').innerHTML = 'Editar evento';
        document.querySelector('#id').value = info.event.id;
        document.querySelector('#title').value = info.event.title
        // document.querySelector('#color').value = info.event.backgroundColor;
        document.querySelector('#start').value = data_start;
        document.querySelector('#end').value = data_end;
        document.querySelector('.btn-delete').classList.remove('hidden');
    };

    // Fecha Modal clicando no (X)
    document.querySelector('.modal-close').addEventListener('click', () => fecharModal());

    // Fecha Modal clicando em área fora do modal
    modal.addEventListener('click', function(event) {
        if (event.target === this) fecharModal();
    });

    // Fecha Modal com a tecla (esc)
    document.addEventListener('keydown', function(event) {
        console.log(event);
        if (event.key === 'Escape') {
            fecharModal();
        }
    });

    function fecharModal() {
        modal.classList.add('hidden');
    }

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
    document.querySelector('.btn-delete').addEventListener('click', function() {
        if (confirm('Você confirma a exclusão do evento? Esta ação não pode ser desfeita!')) {
            document.querySelector('#action').value = 'delete';
            form_add_event.submit();
            return true;
        }
        return false;
    })
});