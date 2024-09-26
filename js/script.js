function getUpdates(userId) {
    fetch('/php/getUpdates.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ userId: userId })
    })
    .then(response => response.json())
    .then(data => {
        updateNotifications(data.notifications);
        updateMessages(data.messages);
    })
    .catch(error => console.error('Error:', error));
}

// Regularnie wywołuj funkcję getUpdates()
setInterval(() => getUpdates(document.getElementById('user_id').value), 1000); // Wywołaj co 1 sekundę

function updateNotifications(notifications) {
    const notificationList = document.getElementById('notifications');
    notificationList.innerHTML = '';
    notifications.forEach(notification => {
        const notificationItem = document.createElement('li');
        notificationItem.textContent = notification.type === 'invite' ? 'Zaproszenie do sesji zdalnej' : notification.message;
        notificationList.appendChild(notificationItem);
    });
}

function updateMessages(messages) {
    const messageList = document.getElementById('messages');
    messageList.innerHTML = '';
    messages.forEach(message => {
        const messageItem = document.createElement('li');
        messageItem.textContent = message.message + ' od ' + message.from;
        messageList.appendChild(messageItem);
    });
}

function blockUser(userId) {
    fetch('/php/blockUser.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ userId: userId })
    })
    .then(response => response.json())
    .then(data => {
        // Odśwież tabelę użytkowników po zaktualizowaniu danych
        // np. wywołaj funkcję updateUsersTable()
        console.log(data);
    })
    .catch(error => console.error('Error:', error));
}

function banUser(userId) {
    fetch('/php/banUser.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ userId: userId })
    })
    .then(response => response.json())
    .then(data => {
        // Odśwież tabelę użytkowników po zaktualizowaniu danych
        // np. wywołaj funkcję updateUsersTable()
        console.log(data);
    })
    .catch(error => console.error('Error:', error));
}

function viewSession(userId) {
    fetch('/php/viewSession.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ userId: userId })
    })
    .then(response => response.json())
    .then(data => {
        // Wyświetl dane sesji w modalnym okienku
        console.log(data);
    })
    .catch(error => console.error('Error:', error));
}

function changeRole(userId) {
    fetch('/php/changeRole.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ userId: userId })
    })
    .then(response => response.json())
    .then(data => {
        // Odśwież tabelę użytkowników po zaktualizowaniu danych
        // np. wywołaj funkcję updateUsersTable()
        console.log(data);
    })
    .catch(error => console.error('Error:', error));
}

function changePassword(userId) {
    fetch('/php/changePassword.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ userId: userId })
    })
    .then(response => response.json())
    .then(data => {
        // Odśwież tabelę użytkowników po zaktualizowaniu danych
        // np. wywołaj funkcję updateUsersTable()
        console.log(data);
    })
    .catch(error => console.error('Error:', error));
}

function changeUserPassword(userId, oldPassword, newPassword, confirmNewPassword) {
    fetch('/php/changeUserPassword.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ userId: userId, oldPassword: oldPassword, newPassword: newPassword, confirmNewPassword: confirmNewPassword })
    })
    .then(response => response.json())
    .then(data => {
        // Odśwież tabelę użytkowników po zaktualizowaniu danych
        // np. wywołaj funkcję updateUsersTable()
        console.log(data);
    })
    .catch(error => console.error('Error:', error));
}
