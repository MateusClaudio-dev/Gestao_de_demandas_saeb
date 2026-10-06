const modal = document.querySelector('.modal-opened');
     function abrirModal(info) {
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
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
        modal.classList.add('hidden');
    }