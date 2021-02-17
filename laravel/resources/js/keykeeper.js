let map = {};
let listeners = [];
let bootstrapped = false;

export function listen(keys, cb) {
    listeners.push({
        keys: keys,
        callback: cb
    });
}

window.onkeydown = window.onkeyup = function (e) {
    if (e.type === 'keydown') {
        map[e.keyCode] = e.type == 'keydown';

        listeners.map((listener) => {
            const isPressed = listener.keys.every((keyCode) => map[keyCode] === true);
            if (isPressed) {
                e.preventDefault();
                e.stopPropagation();
                console.log(map);
                listener.callback();
                map = {};
            }
        })
    } else { // keyup
        if (e.keyCode === 224) { /// cmd key
            map = {};
        }
    }
}

