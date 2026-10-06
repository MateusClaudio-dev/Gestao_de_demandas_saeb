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
            console.log(info)
        },
        eventClick: function(info) {
            console.log(info)
        },
        eventDrop: function(info) {
            console.log(info)
        },
        eventResize: function(info) {
            console.log(info)
        },
         events: 'event-list.php',
         event: 'modal.js',
    });

    const modal = document.querySelector('.modal-opened');
    function abrirModal(info) {
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
                
            // modal.style.transition = 'opacity 300ms';
            // setTimeout(() => modal.style.opacity = 1, 100);
        }
    }

    document.querySelector('.modal-close').addEventListener('click', () => fecharModal());
    modal.addEventListener('click', function(event) {
        if (event.target === this) fecharModal();
    });

    document.addEventListener('keydown', function(event) {
        console.log(event);
        if (event.key === 'Escape') {
            fecharModal();
        }
    });

    function fecharModal() {
        // alert('fechou');
        modal.classList.add('hidden');
    }
    calendar.render();
    
});