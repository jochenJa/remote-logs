var shell = {
    init: function (container, title) {
        this.container = container;
        this.container
            .append($('<div />', {class: 'title'})
                .append($('<span />', {html: title}))
            )
            .append('<br />')
        ;
    },

    add: function (line, stamp) {
        this.container.append(
            $('<div />', {class: 'line'})
                .append($('<span />', {class: 'prefix', html: stamp + '>'}))
                .append(line)
        );
    },

    clean: function () {
        this.container.find('.line').remove();
    },

    listen: function (url) {
        var poll = setInterval(function () {
            $.getJSON(url, function (json) {
                if (json.finished) clearInterval(poll);
                shell.clean();
                json.lines.map(function (line) {
                    shell.add(line[0], line[1]);
                });
            }.bind(shell))
        }, 1000);
    }
};
