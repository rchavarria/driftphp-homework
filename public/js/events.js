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

    function onUserWasSaved(event) {
        const li = document.createElement('li');
        li.setAttribute('id', event.uid);
        li.setAttribute('class', 'list-group-item');
        li.innerHTML = event.uid + ': ' + event.name;

        $users.append(li);
    }

    function onUserWasDeleted(event) {
        const li = document.getElementById(event.uid);
        li.remove();
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
