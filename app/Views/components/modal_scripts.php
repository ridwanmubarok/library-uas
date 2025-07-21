<script>
    let currentItemId = null;
    
    // Open modal
    function openModal(modalId, itemId, itemTitle, titleElementId) {
        currentItemId = itemId;
        if (titleElementId) {
            document.getElementById(titleElementId).textContent = itemTitle;
        }
        document.getElementById(modalId).classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }
    
    // Close modal
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        currentItemId = null;
    }
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modals = document.querySelectorAll('.fixed.inset-0.z-50:not(.hidden)');
            modals.forEach(modal => {
                if (!modal.classList.contains('hidden')) {
                    closeModal(modal.id);
                }
            });
        }
    });
</script>