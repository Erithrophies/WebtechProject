document.addEventListener('DOMContentLoaded', function() {
    const bellIcon = document.getElementById('bellIcon');
    const unreadCount = document.getElementById('unreadCount');
    const notifications = document.querySelectorAll('.notification.unread');

    bellIcon.addEventListener('click', function() {
        notifications.forEach(n => n.classList.remove('unread'));
        unreadCount.style.display = 'none';
    });
});
