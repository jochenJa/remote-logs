var shell = {
    init: function (container, title) {
        this.container = $('<div />', {id: 'shell'})
            .append($('<div />', {class: 'title'})
                .append($('<span />', {html: title}))
            )
            .append('<br />');

        container.html(this.container);
    },

    add: function (line, stamp) {
        this.container.append(
            $('<div />', {class: 'line'})
                .append($('<span />', {class: 'prefix', html: stamp + ' >'}))
                .append(line)
        );
    },

    clean: function () {
        this.container.find('.line').remove();
    },

    flush: function (lines) {
        this.clean();
        lines.map(function (line) {
            shell.add(line[0], line[1]);
        });
    },

    listen: function () {
        //var poll = setInterval(function () {
        //    $.getJSON('shell.php', function (json, status) {
        //        if (status != "success") {
        //            clearInterval(poll);
        //            console.log('reading shell stopped.');
        //            console.log(json);
        //        }
        //        if(json.finished) clearInterval(poll);
        //        this.flush(json.lines);
        //    }.bind(this))
        //}, 1000);
        //
        //return poll;

        $.getJSON('shell.php', function (json, status) {
            this.flush(json.lines);
        }.bind(this))
    },

    execute: function (script, data) {
        //setTimeout(function() { this.listen()}.bind(this), 2000);
        $.getJSON('shell.php', function (json, status) {
            this.flush(json.lines);
        }.bind(this));
        $.get(script, data);
        $.getJSON('shell.php', function (json, status) {
            this.flush(json.lines);
        }.bind(this))

    }
};
