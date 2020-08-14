(function () {
    'use strict';

    //
    // configuration
    //
    const wsUrl = 'ws://localhost:1234/events';

    //
    // get element to manipulate
    //
    const $users = document.getElementById('users');
    const $events = document.getElementById('events');

    function onAnyEvent(event) {
        const li = document.createElement('li');
        li.setAttribute('class', 'list-group-item');
        li.innerHTML = event.type;

        $events.prepend(li);
    }

    function updateUserRow($user, event) {
        $user.setAttribute('id', event.uid);
        $user.setAttribute('class', 'list-group-item');
        $user.innerHTML = event.uid + ': ' + event.name;
        return $user;
    }

    function createSavedUser(event) {
        const li = updateUserRow(document.createElement('li'), event);
        $users.append(li);
    }

    function onUserWasSaved(event) {
        const li = document.getElementById(event.uid);
        if (li) {
            updateUserRow(li, event);
        } else {
            createSavedUser(event);
        }
    }

    function onUserWasDeleted(event) {
        const li = document.getElementById(event.uid);
        li.remove();
    }

    function onNewConnection(event) {
        event.users.forEach(user => createSavedUser(user));
    }

    function onWsMessage(messageEvent) {
        const event = JSON.parse(messageEvent.data);
        onAnyEvent(event);

        switch (event.type) {
            case 'Domain\\Event\\UserWasSaved':
                onUserWasSaved(event);
                break;
            case 'Domain\\Event\\UserWasDeleted':
                onUserWasDeleted(event);
                break;
            case 'new-connection':
                onNewConnection(event);
                break;
        }
    }

    function init() {
        const ws = new WebSocket(wsUrl);
        ws.onmessage = onWsMessage
    }

    //
    // start!
    //

    init();

}());
